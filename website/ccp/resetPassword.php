<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("USERNAME_FIELD_NAME", "username");
define("EMAIL_FIELD_NAME", "email");
define("PASSWORD_FIELD_NAME", "password");
define("CONFIRM_PASSWORD_FIELD_NAME", "confirmPassword");
define("SEND_REQUEST_FIELD_NAME", "send");
define("RESET_PASSWORD_FIELD_NAME", "resetPassword");
$smarty->assign("title", "Chip Chair and a Prayer Reset Password");
$smarty->assign("heading", "Reset Password");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmPasswordReset");
if (isset($_GET["nav"])) {
  require_once "navigation.php";
} else {
  $smarty->assign("navigation", "");
}
$emailAddress = isset($_POST[EMAIL_FIELD_NAME]) ? $_POST[EMAIL_FIELD_NAME] : (isset($_GET[EMAIL_FIELD_NAME]) ? $_GET[EMAIL_FIELD_NAME] : DEFAULT_VALUE_BLANK);
$username = isset($_POST[USERNAME_FIELD_NAME]) ? $_POST[USERNAME_FIELD_NAME] : (isset($_GET[USERNAME_FIELD_NAME]) ? $_GET[USERNAME_FIELD_NAME] : DEFAULT_VALUE_BLANK);
$password = isset($_POST[PASSWORD_FIELD_NAME]) ? $_POST[PASSWORD_FIELD_NAME] : DEFAULT_VALUE_BLANK;
if (Constant::$MODE_RESET_PASSWORD_REQUEST == $mode) {
  $output .= 
    "<script type=\"module\">\n" .
    "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
    "  let aryMessages = [];\n" .
    "  let aryErrors = [];\n";
  $params = array($username, $emailAddress, time());
  $resultList = $databaseResult->updateUserReset(params: $params);
  if (!is_array($resultList)) {
    $output .= "  aryErrors.push(\"Unable to change password for username <span class='bold'>" . $username . "</span> and email <span class='bold'>" . $emailAddress . "</span>. Please try again.\");";
    $mode = Constant::$MODE_VIEW;
  } else {
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), toName: array(Constant::$NAME_STAFF), toEmail: array(Constant::EMAIL_STAFF()), fromName: array($username), fromEmail: array($emailAddress), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
    $output .= "  aryMessages.push(\"" . $email->sendPasswordResetRequestEmail(info: $params, selectorAndToken: $resultList) . "<br>You will be redirected to the login page in 5 seconds\");";
    header("refresh:5;url=login.php");
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}";
  $output .= "  if (aryErrors.length > 0) {display.showErrors({errors: aryErrors});}</script>";
} else if (Constant::$MODE_RESET_PASSWORD == $mode) {
  $selector = filter_input(INPUT_GET, "selector");
  $validator = filter_input(INPUT_GET, "validator");
  if (false !== ctype_xdigit($selector) && false !== ctype_xdigit($validator)) {
    $calc = hash('sha256', hex2bin($validator));
    $params = array($username, $emailAddress);
    $resultList = $databaseResult->getUserPasswordReset(params: $params);
    if (hash_equals($calc, $resultList[0])) {
      $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
      $textBoxPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PASSWORD, autoComplete: "new-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PASSWORD_FIELD_NAME, maxLength: null, name: PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: $password, wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxPassword->getId() . "\">New:</label></div>";
      $output .= " <div class=\"responsive-cell responsive-cell--value\">" . $textBoxPassword->getHtml() . "</div>";
      $textBoxConfirmPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_PASSWORD, autoComplete: "new-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: CONFIRM_PASSWORD_FIELD_NAME, maxLength: null, name: CONFIRM_PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: null, wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxConfirmPassword->getId() . "\">Confirm New:</label></div>";
      $output .= " <div class=\"responsive-cell responsive-cell--value\">" . $textBoxConfirmPassword->getHtml() . "</div>";
      $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: RESET_PASSWORD_FIELD_NAME, maxLength: null, name: RESET_PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(implode(" ", preg_split('/(?=[A-Z])/', RESET_PASSWORD_FIELD_NAME))), wrap: null);
      $output .= $buttonReset->getHtml();
      $output .= "</div>";
    } else {
      $output .= "  aryErrors.push(\"Username <strong><u>" . $username . "</u></strong> and email <strong><u>" . $emailAddress . "</u></strong> are not a valid combination. Please try again.\");";
      $mode = Constant::$MODE_VIEW;
    }
  }
} else if (Constant::$MODE_RESET_PASSWORD_CONFIRM == $mode) {
  $output .= 
    "<script type=\"module\">\n" .
    "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
    "  let aryMessages = [];\n" .
    "  let aryErrors = [];\n";
  $params = array($username, $emailAddress, $password);
  $resultList = $databaseResult->updateUserChangePassword(params: $params);
  if (0 == $resultList) {
    $output .= "  aryErrors.push(\"Unable to change password for username <span class='bold'>" . $username . "</span> and email <span class='bold'>" . $emailAddress . "</span>. Please try again.\");";
    $mode = "";
  } else {
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($username), toEmail: array($emailAddress), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
    $output .= "  aryMessages.push(\"" . $email->sendPasswordResetSuccessfulEmail() . "<br>You will be redirected to the login page in 5 seconds\");";
    session_destroy();
    header("refresh:5;url=login.php");
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}";
  $output .= "  if (aryErrors.length > 0) {display.showErrors({errors: aryErrors});}</script>";
}
if (Constant::$MODE_VIEW == $mode) {
  $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
  $textBoxUsername = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_USERNAME, autoComplete: "off", autoFocus: true, checked: null, class: null, cols: null, disabled: false, id: USERNAME_FIELD_NAME, maxLength: 30, name: USERNAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $username, wrap: null);
  $output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxUsername->getId() . "\">Username:</label></div>";
  $output .= " <div class=\"responsive-cell responsive-cell--value\">" . $textBoxUsername->getHtml() . "</div>";
  $textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: "email", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: EMAIL_FIELD_NAME, maxLength: 50, name: EMAIL_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $emailAddress, wrap: null);
  $output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxEmail->getId() . "\">Email:</label></div>";
  $output .= " <div class=\"responsive-cell responsive-cell--value\">" . $textBoxEmail->getHtml() . "</div>";
  $output .= " <div class=\"responsive-cell\">\n";
  $buttonEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SIGN_UP, autoComplete: null, autoFocus: false, checked: null, class: array("button-icon button-icon-separator icon-border-caret-right"), cols: null, disabled: true, id: SEND_REQUEST_FIELD_NAME, maxLength: null, name: SEND_REQUEST_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(implode(" ", preg_split('/(?=[A-Z])/', SEND_REQUEST_FIELD_NAME))), wrap: null);
  $output .= $buttonEmail->getHtml() . "</div>\n";
  $output .= "</div>";
}
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("resetPassword.tpl");
<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("NAME_FIELD_NAME", "name");
define("EMAIL_FIELD_NAME", "email");
define("USERNAME_FIELD_NAME", "username");
define("PASSWORD_FIELD_NAME", "password");
define("CONFIRM_PASSWORD_FIELD_NAME", "confirmPassword");
define("SIGN_UP_FIELD_NAME", "signUp");
define("SIGN_UP_TEXT", "Sign Up");
$name = isset($_POST[NAME_FIELD_NAME]) ? $_POST[NAME_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$emailAddress = isset($_POST[EMAIL_FIELD_NAME]) ? $_POST[EMAIL_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$username = isset($_POST[USERNAME_FIELD_NAME]) ? $_POST[USERNAME_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$password = isset($_POST[PASSWORD_FIELD_NAME]) ? $_POST[PASSWORD_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$confirmPassword = isset($_POST[CONFIRM_PASSWORD_FIELD_NAME]) ? $_POST[CONFIRM_PASSWORD_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$classUsername = DEFAULT_VALUE_BLANK;
$classEmail = DEFAULT_VALUE_BLANK;
$autoFocusName = true;
$autoFocusUserName = false;
$autoFocusEmail = false;
if (Constant::$MODE_SIGNUP == $mode) {
  $params = array($username);
  $resultList = $databaseResult->getUserByUsername(params: $params);
  if (0 < count($resultList)) {
    $failMessage = "Username <span class='bold'>" . $username . "</span> already exists. Please choose another.";
    $classUsername = "errors";
    $autoFocusUserName = true;
    $autoFocusName = false;
  } else {
    $params = array($emailAddress);
    $resultList = $databaseResult->getUserByEmail(params: $params);
    if (0 < count($resultList)) {
      $failMessage = "Email <span class='bold'>" . $emailAddress . "</span> already exists. Please choose another.";
      $classEmail = "errors";
      $autoFocusEmail = true;
      $autoFocusName = false;
    } else {
      $output .= 
        "<script type=\"module\">\n" .
        "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
        "  let aryMessages = [];\n";
      $nameValues = explode(" ", $name);
      $params = array(null, $nameValues[0], $nameValues[1], $username, $password, $emailAddress, 0, null, null, null, null, null, null, null, null, null, null, null, null);
      $databaseResult->insertUser(params: $params);
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), toName: array(Constant::$NAME_STAFF), toEmail: array(Constant::EMAIL_STAFF()), fromName: array($name), fromEmail: array($emailAddress), ccName: array(Constant::$NAME_STAFF), ccEmail: array(Constant::EMAIL_STAFF()), bccName: null, bccEmail: null, subject: null, body: null);
      $output .= "  aryMessages.push(\"" . $email->sendSignUpEmail() . "\");";
      // send email to staff for approval
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), toName: array($name), toEmail: array($emailAddress), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), ccName: array(Constant::$NAME_STAFF), ccEmail: array(Constant::EMAIL_STAFF()), bccName: null, bccEmail: null, subject: null, body: null);
      $output .= "  aryMessages.push(\"" . $email->sendSignUpApprovalEmail() . "\");";
      $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}</script>";
      $name = DEFAULT_VALUE_BLANK;
      $emailAddress = DEFAULT_VALUE_BLANK;
      $username = DEFAULT_VALUE_BLANK;
      $password = DEFAULT_VALUE_BLANK;
      $confirmPassword = DEFAULT_VALUE_BLANK;
    }
  }
}
$smarty->assign("title", "Chip Chair and a Prayer New User Sign Up");
$smarty->assign("heading", "New User Sign Up");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmSignup");
if (isset($failMessage)) {
  $output .= 
    "<script type=\"module\">\n" .
    "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
    "  display.showErrors({errors: [ \"" . $failMessage . "\" ]});" . 
    "</script>";
}
$output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
$textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_NAME, autoComplete: "off", autoFocus: $autoFocusName, checked: null, class: null, cols: null, disabled: false, id: NAME_FIELD_NAME, maxLength: 60, name: NAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $name, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxName->getId() . "\">Name:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxName->getHtml() . "</div>";
$textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: "off", autoFocus: $autoFocusEmail, checked: null, class: array($classEmail), cols: null, disabled: false, id: EMAIL_FIELD_NAME, maxLength: 50, name: EMAIL_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $emailAddress, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxEmail->getId() . "\">Email:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxEmail->getHtml() . "</div>";
$textBoxUsername = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_USERNAME, autoComplete: "off", autoFocus: $autoFocusUserName, checked: null, class: array($classUsername), cols: null, disabled: false, id: USERNAME_FIELD_NAME, maxLength: 30, name: USERNAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $username, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxUsername->getId() . "\">Username:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxUsername->getHtml() . "</div>";
$textBoxPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PASSWORD, autoComplete: "off", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PASSWORD_FIELD_NAME, maxLength: null, name: PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: $password, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxPassword->getId() . "\">Password:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxPassword->getHtml() . "</div>";
$textBoxConfirmPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_PASSWORD, autoComplete: "off", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: CONFIRM_PASSWORD_FIELD_NAME, maxLength: null, name: CONFIRM_PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: $confirmPassword, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxConfirmPassword->getId() . "\">Confirm Password:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxConfirmPassword->getHtml() . "</div>";
$buttonSignup = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SIGN_UP, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: SIGN_UP_FIELD_NAME, maxLength: null, name: SIGN_UP_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: SIGN_UP_TEXT, wrap: null);
$output .= " <div class=\"responsive-cell\">" . $buttonSignup->getHtml() . "</div>";
$output .= "</div>";
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("signup.tpl");
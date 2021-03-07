<?php
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
define("SEND_REQUEST_FIELD_NAME", "sendRequest");
define("RESET_PASSWORD_FIELD_NAME", "resetPassword");
$smarty->assign("title", "Chip Chair and a Prayer Reset Password");
$smarty->assign("heading", "Reset Password");
$smarty->assign("style", "");
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
  $output .= "<script type=\"text/javascript\">\n aryMessages = []; aryErrors = [];\n";
  $params = array($username, $emailAddress, time());
  $resultList = $databaseResult->updateUserReset($params);
  if (!is_array($resultList)) {
    $output .= "  aryErrors.push(\"Username <strong><u>" . $username . "</u></strong> and email <strong><u>" . $emailAddress . "</u></strong> are not a valid combination. Please try again.\");\n";
    $mode = Constant::$MODE_VIEW;
  } else {
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($username), array($emailAddress), null, null, null, null, null, null);
    $output .= "  aryMessages.push(\"" . $email->sendPasswordResetRequestEmail($params, $resultList) . "<br>You will be redirected to the login page in 5 seconds\");\n";
    header("refresh:5;url=login.php");
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n";
  $output .= "  if (aryErrors.length > 0) {display.showErrors(aryErrors);}\n</script>\n";
} else if (Constant::$MODE_RESET_PASSWORD == $mode) {
  $selector = filter_input(INPUT_GET, "selector");
  $validator = filter_input(INPUT_GET, "validator");
  if (false !== ctype_xdigit($selector) && false !== ctype_xdigit($validator)) {
    $calc = hash('sha256', hex2bin($validator));
    $params = array($username, $emailAddress);
    $resultList = $databaseResult->getUserPasswordReset($params);
    if (hash_equals($calc, $resultList[0])) {
      $output .= "<div class=\"label\">\nNew Password:\n</div>\n";
      $output .= "<div class=\"input\">\n";
      $textBoxPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PASSWORD, "new-password", false, null, null, null, false, PASSWORD_FIELD_NAME, null, PASSWORD_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_PASSWORD, $password, null);
      $output .= $textBoxPassword->getHtml();
      $output .= "</div>\n";
      $output .= "<div class=\"clear\"></div>\n";
      $output .= "<div class=\"label\">\nConfirm New Password:\n</div>\n";
      $output .= "<div class=\"input\">\n";
      $textBoxConfirmPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_PASSWORD, "new-password", false, null, null, null, false, CONFIRM_PASSWORD_FIELD_NAME, null, CONFIRM_PASSWORD_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_PASSWORD, null, null);
      $output .= $textBoxConfirmPassword->getHtml();
      $output .= "</div>\n";
      $output .= "<div class=\"clear\"></div>\n";
      $output .= "<div class=\"label\">&nbsp;</div>\n";
      $output .= "<div class=\"input\">\n";
      $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, true, RESET_PASSWORD_FIELD_NAME, null, RESET_PASSWORD_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(implode(" ", preg_split('/(?=[A-Z])/', RESET_PASSWORD_FIELD_NAME))), null);
      $output .= $buttonReset->getHtml();
      $output .= "</div>\n";
    } else {
      $output .= "  aryErrors.push(\"Username <strong><u>" . $username . "</u></strong> and email <strong><u>" . $emailAddress . "</u></strong> are not a valid combination. Please try again.\");\n";
      $mode = Constant::$MODE_VIEW;
    }
  }
} else if (Constant::$MODE_RESET_PASSWORD_CONFIRM == $mode) {
  $output .= "<script type=\"text/javascript\">\n aryMessages = []; aryErrors = [];\n";
  $params = array($username, $emailAddress, $password);
  $resultList = $databaseResult->updateUserChangePassword($params);
  if (0 == $resultList) {
    $output .= "  aryErrors.push(\"Unable to change password for username <strong><u>" . $username . "</u></strong> and email <strong><u>" . $emailAddress . "</u></strong>. Please try again.\");\n";
    $mode = "";
  } else {
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($username), array($emailAddress), null, null, null, null, null, null);
    $output .= "  aryMessages.push(\"" . $email->sendPasswordResetSuccessfulEmail() . "<br>You will be redirected to the login page in 5 seconds\");\n";
    session_destroy();
    header("refresh:5;url=login.php");
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n";
  $output .= "  if (aryErrors.length > 0) {display.showErrors(aryErrors);}\n</script>\n";
}
if (Constant::$MODE_VIEW == $mode) {
  $output .= "<div class=\"label\">Username:</div>\n";
  $output .= "<div class=\"input\">\n";
  $textBoxUsername = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_USERNAME, "username", true, null, null, null, false, USERNAME_FIELD_NAME, 30, USERNAME_FIELD_NAME, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_TEXTBOX, $username, null);
  $output .= $textBoxUsername->getHtml();
  $output .= "</div>\n";
  $output .= "<div class=\"clear\"></div>\n";
  $output .= "<div class=\"label\">\nEmail Address:\n</div>\n";
  $output .= "<div class=\"input\">\n";
  $textBoxEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_EMAIL, "email", false, null, null, null, false, EMAIL_FIELD_NAME, 50, EMAIL_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_TEXTBOX, $emailAddress, null);
  $output .= $textBoxEmail->getHtml();
  $output .= "</div>\n";
  $output .= "<div class=\"clear\"></div>\n";
  $output .= "<div class=\"input\">\n";
  $buttonEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SIGN_UP, null, false, null, null, null, true, SEND_REQUEST_FIELD_NAME, null, SEND_REQUEST_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(implode(" ", preg_split('/(?=[A-Z])/', SEND_REQUEST_FIELD_NAME))), null);
  $output .= $buttonEmail->getHtml();
  $output .= "</div>\n";
}
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("resetPassword.tpl");
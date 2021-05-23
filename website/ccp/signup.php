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
    $failMessage = "Username <strong><u>" . $username . "</u></strong> already exists. Please choose another.";
    $classUsername = "errors";
    $autoFocusUserName = true;
    $autoFocusName = false;
  } else {
    $params = array($emailAddress);
    $resultList = $databaseResult->getUserByEmail(params: $params);
    if (0 < count($resultList)) {
      $failMessage = "Email <strong><u>" . $emailAddress . "</u></strong> already exists. Please choose another.";
      $classEmail = "errors";
      $autoFocusEmail = true;
      $autoFocusName = false;
    } else {
      $output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
      $nameValues = explode(" ", $name);
      $params = array(null, $nameValues[0], $nameValues[1], $username, $password, $emailAddress, 0, null, null, null, null, null, null, null, null, null, null, null, null);
      $databaseResult->insertUser(params: $params);
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), toName: array(Constant::$NAME_STAFF), toEmail: array(Constant::EMAIL_STAFF()), fromName: array($name), fromEmail: array($emailAddress), ccName: array(Constant::$NAME_STAFF), ccEmail: array(Constant::EMAIL_STAFF()), bccName: null, bccEmail: null, subject: null, body: null);
      $output .= "  aryMessages.push(\"" . $email->sendSignUpEmail() . "\");\n";
      // send email to staff for approval
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), toName: array($name), toEmail: array($emailAddress), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), ccName: array(Constant::$NAME_STAFF), ccEmail: array(Constant::EMAIL_STAFF()), bccName: null, bccEmail: null, subject: null, body: null);
      $output .= "  aryMessages.push(\"" . $email->sendSignUpApprovalEmail() . "\");\n";
      $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
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
$style =
  "<style type=\"text/css\">\n" .
  "div.label, div.input {\n" .
  "  height: 17px;\n" .
  "  line-height: 17px;\n" .
  "  margin: 5px;\n" . "}\n" .
  "div.label {\n" .
  "  float: left;\n" .
  "  width: 100px;\n" .
  "}\n" .
  "div.input {\n" .
  "  float: left;\n" .
  "  margin: 0;\n" .
  "}\n" .
  "div.clear {\n" .
  "  clear: both;\n" .
  "  height: 0;\n" .
  "  line-height: 0;\n" .
  "}\n" .
  "</style>\n";
$smarty->assign("style", $style);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmSignup");
if (isset($failMessage)) {
  $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $failMessage . "\" ]);\n" . "</script>\n";
}
$output .= "<div class=\"label\">Name:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_NAME, autoComplete: "name", autoFocus: $autoFocusName, checked: null, class: null, cols: null, disabled: false, id: NAME_FIELD_NAME, maxLength: 60, name: NAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $name, wrap: null);
$output .= $textBoxName->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">Email:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: "email", autoFocus: $autoFocusEmail, checked: null, class: array($classEmail), cols: null, disabled: false, id: EMAIL_FIELD_NAME, maxLength: 50, name: EMAIL_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $emailAddress, wrap: null);
$output .= $textBoxEmail->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">Username:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxUsername = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_USERNAME, autoComplete: "username", autoFocus: $autoFocusUserName, checked: null, class: array($classUsername), cols: null, disabled: false, id: USERNAME_FIELD_NAME, maxLength: 30, name: USERNAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $username, wrap: null);
$output .= $textBoxUsername->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">\nPassword:\n</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PASSWORD, autoComplete: "new-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PASSWORD_FIELD_NAME, maxLength: null, name: PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: $password, wrap: null);
$output .= $textBoxPassword->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">\nConfirm Password:\n</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxConfirmPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_PASSWORD, autoComplete: "new-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: CONFIRM_PASSWORD_FIELD_NAME, maxLength: null, name: CONFIRM_PASSWORD_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: $confirmPassword, wrap: null);
$output .= $textBoxConfirmPassword->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">&nbsp;</div>\n";
$output .= "<div class=\"input\">\n";
$buttonSignup = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SIGN_UP, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: SIGN_UP_FIELD_NAME, maxLength: null, name: SIGN_UP_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: SIGN_UP_TEXT, wrap: null);
$output .= $buttonSignup->getHtml();
$output .= "</div>\n";
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("signup.tpl");
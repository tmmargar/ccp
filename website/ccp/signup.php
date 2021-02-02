<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("NAME_FIELD_NAME", "name");
define("EMAIL_FIELD_NAME", "email");
define("USERNAME_FIELD_NAME", "username");
define("PASSWORD_FIELD_NAME", "password");
define("CONFIRM_PASSWORD_FIELD_NAME", "confirmPassword");
define("SIGN_UP_FIELD_NAME", "signUp");
define("SIGN_UP_TEXT", "Sign Up");
$output = "";
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : "";
$name = isset($_POST[NAME_FIELD_NAME]) ? $_POST[NAME_FIELD_NAME] : "";
$emailAddress = isset($_POST[EMAIL_FIELD_NAME]) ? $_POST[EMAIL_FIELD_NAME] : "";
$username = isset($_POST[USERNAME_FIELD_NAME]) ? $_POST[USERNAME_FIELD_NAME] : "";
$password = isset($_POST[PASSWORD_FIELD_NAME]) ? $_POST[PASSWORD_FIELD_NAME] : "";
$confirmPassword = isset($_POST[CONFIRM_PASSWORD_FIELD_NAME]) ? $_POST[CONFIRM_PASSWORD_FIELD_NAME] : "";
$classUsername = "";
$classEmail = "";
if (Constant::$MODE_SIGNUP == $mode) {
  $databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
  $params = array($username);
  $resultList = $databaseResult->getUserByUsername($params);
  if (0 < count($resultList)) {
    $failMessage = "Username <strong><u>" . $username . "</u></strong> already exists. Please choose another.";
    $classUsername = "errors";
  } else {
    $params = array($emailAddress);
    $resultList = $databaseResult->getUserByEmail($params);
    if (0 < count($resultList)) {
      $failMessage = "Email <strong><u>" . $emailAddress . "</u></strong> already exists. Please choose another.";
      $classEmail = "errors";
    } else {
      $nameValues = explode(" ", $name);
      $params = array(null, $nameValues[0], $nameValues[1], $username, $password, $emailAddress, 0, null, null, null, null, null, null, null, null, null, null, null, null);
      $databaseResult->insertUser($params);
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($name), array($emailAddress), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), null, null, null, null);
      $output .= $email->sendSignUpEmail();
      // send email to staff for approval
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array($name), array($emailAddress), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), null, null, null, null);
      $output .= $email->sendSignUpApprovalEmail();
    }
  }
}
$smarty->assign("title", "Chip Chair and a Prayer New User Sign Up");
// $smarty->assign("script", "<script src=\"scripts/signup.js\" type=\"text/javascript\"></script>");
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
  $output .= "<script type=\"text/javascript\">\n" . "  display.showErrorsPersist([ \"" . $failMessage . "\" ]);\n" . "</script>\n";
}
$output .= "<div class=\"label\">Name:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_NAME, "name", true, null, null, null, false, NAME_FIELD_NAME, 60, NAME_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_TEXTBOX, $name, null);
$output .= $textBoxName->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">Email:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_EMAIL, "email", false, null, array($classEmail), null, false, EMAIL_FIELD_NAME, 50, EMAIL_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_TEXTBOX, $emailAddress, null);
$output .= $textBoxEmail->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">Username:</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxUsername = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_USERNAME, "username", false, null, array($classUsername), null, false, USERNAME_FIELD_NAME, 30, USERNAME_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_TEXTBOX, $username, null);
$output .= $textBoxUsername->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">\nPassword:\n</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PASSWORD, "new-password", false, null, null, null, false, PASSWORD_FIELD_NAME, null, PASSWORD_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_PASSWORD, $password, null);
$output .= $textBoxPassword->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">\nConfirm Password:\n</div>\n";
$output .= "<div class=\"input\">\n";
$textBoxConfirmPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_PASSWORD, "new-password", false, null, null, null, false, CONFIRM_PASSWORD_FIELD_NAME, null, CONFIRM_PASSWORD_FIELD_NAME, null, null, false, null, null, 20, null, FormControl::$TYPE_INPUT_PASSWORD, $confirmPassword, null);
$output .= $textBoxConfirmPassword->getHtml();
$output .= "</div>\n";
$output .= "<div class=\"clear\"></div>\n";
$output .= "<div class=\"label\">&nbsp;</div>\n";
$output .= "<div class=\"input\">\n";
$buttonSignup = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SIGN_UP, null, false, null, null, null, true, SIGN_UP_FIELD_NAME, null, SIGN_UP_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, SIGN_UP_TEXT, null);
$output .= $buttonSignup->getHtml();
$output .= "</div>\n";
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("signup.tpl");
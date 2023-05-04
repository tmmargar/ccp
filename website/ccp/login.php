<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\Login;
use ccp\classes\model\Security;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
use tidy;
require_once "init.php";
define("NAME_FIELD_USERNAME", "username");
define("NAME_FIELD_PASSWORD", "password");
define("NAME_FIELD_REMEMBER_ME", "rememberMe");
define("NAME_FIELD_LOGIN", "login");
$smarty->assign("title", "Chip Chair and a Prayer Login");
$smarty->assign("heading", "Login");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmLogin");
$output = "";
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : "";
if (Constant::$MODE_LOGIN == $mode) {
  $login = new Login(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, username: $_POST["username"], password: $_POST["password"]);
  $user = new User(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: 0, name:"", username: "", password: "", email: "", phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: 0, approvalName: null, rejectionDate: null, rejectionUserid: 0, rejectionName: null, active: 0, address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
  $security = new Security(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, login: $login, user: $user);
  if ($security->login()) {
    $pageName = "home.php";
    if (! empty($_SERVER["QUERY_STRING"])) {
      $pageName = $_SERVER["QUERY_STRING"];
    }
    header("Location:" . $pageName);
    exit();
  } else {
    $output .=
      "<script type=\"module\">" .
      "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
      "  display.showErrors({errors: [\"Login failed. Please try again\"]});" .
    "</script>";
  }
}
$output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
$textBoxUsername = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_USERNAME, autoComplete: "username", autoFocus: true, checked: null, class: null, cols: null, disabled: false, id: NAME_FIELD_USERNAME, maxLength: 30, name: NAME_FIELD_USERNAME, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 10, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: null, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxUsername->getId() . "\">Username:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxUsername->getHtml() . "</div>";
$textBoxPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PASSWORD, autoComplete: "current-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: NAME_FIELD_PASSWORD, maxLength: null, name: NAME_FIELD_PASSWORD, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 10, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: null, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell--head\"><label class=\"label\" for=\"" . $textBoxPassword->getId() . "\">Password:</label></div>";
$output .= " <div class=\"responsive-cell\">" . $textBoxPassword->getHtml() . "</div>";
// $output .= "<div class=\"label\">Remember Me:</div>";
// $output .= "<div class=\"input\">";
// $output .= HtmlUtility::buildCheckbox(false, false, false, null, false, Base::build(NAME_FIELD_REMEMBER_ME, null), Base::build(NAME_FIELD_REMEMBER_ME, null), null, null);
// $output .= "</div>";
// $output .= "<div class=\"clear\"></div>";
$buttonLogin = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_LOGIN, autoComplete: null, autoFocus: false, checked: null, class: array("button-icon button-icon-separator icon-border-caret-right"), cols: null, disabled: false, id: NAME_FIELD_LOGIN, maxLength: null, name: NAME_FIELD_LOGIN, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(NAME_FIELD_LOGIN), wrap: null);
$output .= $buttonLogin->getHtml();
$output .= " <div class=\"responsive-cell\"></div>";
$output .= " <div class=\"responsive-cell\"><a href=\"resetPassword.php\">Forgot Password</a>&nbsp;&nbsp;&nbsp;<a href=\"signup.php\">New User</a></div>";
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$output .= "</div>";
$smarty->assign("content", $output);
$outputTemplate = $smarty->fetch("login.tpl");
$outputTidy = new tidy;
$outputTidy->parseString($outputTemplate, $configTidy, "utf8");
$outputTidy->cleanRepair();
echo $outputTidy;
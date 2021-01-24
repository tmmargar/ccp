<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\Login;
use ccp\classes\model\Security;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("NAME_FIELD_USERNAME", "username");
define("NAME_FIELD_PASSWORD", "password");
define("NAME_FIELD_REMEMBER_ME", "rememberMe");
define("NAME_FIELD_LOGIN", "login");
$smarty->assign("title", "Chip Chair and a Prayer Login");
$style =
  "<style type=\"text/css\">\n" .
  ".form_content {\n" .
  "  width: 500px;\n" .
  "}\n" .
"</style>\n";
$smarty->assign("style", $style);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmLogin");
$output = "";
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : "";
if (Constant::$MODE_LOGIN == $mode) {
  $login = new Login(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $_POST["username"], $_POST["password"]);
  $security = new Security(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $login, new User());
  if ($security->login()) {
    $pageName = "home.php";
    if (! empty($_SERVER["QUERY_STRING"])) {
      $pageName = $_SERVER["QUERY_STRING"];
    }
    header("Location:" . $pageName);
    exit();
  } else {
    $output .=
      "<script type=\"text/javascript\">\n" .
      "  display.showErrors([ \"Login failed. Please try again\" ]);\n" .
      "</script>\n";
  }
}
$output .= "<div class=\"form_content\">\n";
$output .= " <div class=\"label\">Username:</div>\n";
$output .= " <div class=\"input\">\n";
$textBoxUsername = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_USERNAME, "username", true, null, null, null, false, NAME_FIELD_USERNAME, 30, NAME_FIELD_USERNAME, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_TEXTBOX, null, null);
$output .= $textBoxUsername->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">\nPassword:\n</div>\n";
$output .= " <div class=\"input\">\n";
$textBoxPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PASSWORD, "current-password", false, null, null, null, false, NAME_FIELD_PASSWORD, null, NAME_FIELD_PASSWORD, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_PASSWORD, null, null);
$output .= $textBoxPassword->getHtml();
$output .= " </div>\n";
// $output .= "<div class=\"label\">Remember Me:\n</div>\n";
// $output .= "<div class=\"input\">\n";
// $output .= HtmlUtility::buildCheckbox(false, false, false, null, false, Base::build(NAME_FIELD_REMEMBER_ME, null), Base::build(NAME_FIELD_REMEMBER_ME, null), null, null);
// $output .= "</div>\n";
// $output .= "<div class=\"clear\"></div>\n";
$output .= " <div class=\"label\">&nbsp;</div>\n";
$output .= " <div class=\"input\">\n";
$buttonLogin = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOGIN, null, false, null, null, null, true, NAME_FIELD_LOGIN, null, NAME_FIELD_LOGIN, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(NAME_FIELD_LOGIN), null);
$output .= $buttonLogin->getHtml();
$output .= "&nbsp;&nbsp;<a href=\"resetPassword.php\">Forgot Password</a>\n";
$output .= "&nbsp;&nbsp;<a href=\"signup.php\">New User</a>\n";
$output .= " </div>\n";
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("login.tpl");
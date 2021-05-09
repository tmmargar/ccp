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
$style =
  "<style type=\"text/css\">" .
  ".form_content {" .
  "  width: 30%;" .
  "}" .
"</style>";
$smarty->assign("style", $style);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmLogin");
$output = "";
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : "";
if (Constant::$MODE_LOGIN == $mode) {
  $login = new Login(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $_POST["username"], $_POST["password"]);
  $user = new User(false, 0, "", "", "", "", "", null, 0, "", "", 0, "", "", 0, "", 0, null, null, null, null, null, null, null);
  $security = new Security(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $login, $user);
  if ($security->login()) {
    $pageName = "home.php";
    if (! empty($_SERVER["QUERY_STRING"])) {
      $pageName = $_SERVER["QUERY_STRING"];
    }
    header("Location:" . $pageName);
    exit();
  } else {
    $output .=
      "<script type=\"text/javascript\">" .
      "  display.showErrors([ \"Login failed. Please try again\" ]);" .
      "</script>";
  }
}
$output .= "<div class=\"form_content\">";
$output .= " <div class=\"label\">Username:</div>";
$output .= " <div class=\"input\">";
$textBoxUsername = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_USERNAME, "username", true, null, null, null, false, NAME_FIELD_USERNAME, 30, NAME_FIELD_USERNAME, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_TEXTBOX, null, null);
$output .= $textBoxUsername->getHtml();
$output .= " </div>";
$output .= " <div class=\"label\">Password:</div>";
$output .= " <div class=\"input\">";
$textBoxPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PASSWORD, "current-password", false, null, null, null, false, NAME_FIELD_PASSWORD, null, NAME_FIELD_PASSWORD, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_PASSWORD, null, null);
$output .= $textBoxPassword->getHtml();
$output .= " </div>";
// $output .= "<div class=\"label\">Remember Me:</div>";
// $output .= "<div class=\"input\">";
// $output .= HtmlUtility::buildCheckbox(false, false, false, null, false, Base::build(NAME_FIELD_REMEMBER_ME, null), Base::build(NAME_FIELD_REMEMBER_ME, null), null, null);
// $output .= "</div>";
// $output .= "<div class=\"clear\"></div>";
$output .= " <div class=\"label\">&nbsp;</div>";
$output .= " <div class=\"input\">";
$buttonLogin = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOGIN, null, false, null, null, null, true, NAME_FIELD_LOGIN, null, NAME_FIELD_LOGIN, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(NAME_FIELD_LOGIN), null);
$output .= $buttonLogin->getHtml();
$output .= "&nbsp;&nbsp;<a href=\"resetPassword.php\">Forgot Password</a>";
$output .= "&nbsp;&nbsp;<a href=\"signup.php\">New User</a>";
$output .= " </div>";
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$output .= "</div>";
// $configTidy = [ "clean" => true, "coerce-endtags" => true, "doctype" => "omit", "drop-proprietary-attributes" => true, "indent" => true, "indent-spaces" => 1, "output-html" => true, "show-body-only" => true, "sort-attributes" => "alpha", "wrap" => 0 ];
// $outputTidy = new tidy;
// $outputTidy->parseString($output, $configTidy, "utf8");
// $outputTidy->cleanRepair();
$smarty->assign("content", $output);
// $smarty->assign("content", $outputTidy);
//$smarty->display("login.tpl");
$outputTemplate = $smarty->fetch("login.tpl");
$outputTidy = new tidy;
$outputTidy->parseString($outputTemplate, $configTidy, "utf8");
$outputTidy->cleanRepair();
echo $outputTidy;
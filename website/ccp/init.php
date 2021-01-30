<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\utility\SessionUtility;
require_once "autoload.php";
// TODO: NOT SURE WHERE TO PUT THIS
date_default_timezone_set(Constant::$NAME_TIME_ZONE);
if (strpos($_SERVER["SCRIPT_NAME"], "index.php") === false) {
  require_once "initSmarty.php";
}
if (strpos($_SERVER["SCRIPT_NAME"], "index.php") === false && strpos($_SERVER["SCRIPT_NAME"], "logout.php") === false) {
  SessionUtility::startSession();
  // if no session and not login or password reset pages capture page to redirect after login
  if (!SessionUtility::existsSecurity() && strpos($_SERVER["SCRIPT_NAME"], "login.php") === false && strpos($_SERVER["SCRIPT_NAME"], "resetPassword.php") === false && strpos($_SERVER["SCRIPT_NAME"], "signup.php") === false) {
    $scriptName = explode("/", $_SERVER["SCRIPT_NAME"]);
    // echo $scriptName[count($scriptName) - 1];
    header("Location: login.php?" . $scriptName[count($scriptName) - 1]);
  }
}
// if any auto or manage pages and not administrator display not authorized message
if (strpos($_SERVER["SCRIPT_NAME"], "auto") !== false || strpos($_SERVER["SCRIPT_NAME"], "manage") !== false) {
  if (SessionUtility::getValue(SessionUtility::$OBJECT_NAME_ADMINISTRATOR) != 1 && SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID) != $_GET["id"]) {
    echo "<h1 style=\"color: red;\">You are not authorized to access this page!!</h1>";
    die();
  }
}
$outputTop = "";
if (strpos($_SERVER["SCRIPT_NAME"], "login.php") === false && strpos($_SERVER["SCRIPT_NAME"], "logout.php") === false && strpos($_SERVER["SCRIPT_NAME"], "resetPassword.php") === false) {
  require_once "navigation.php";
  $databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
  // $databaseResult = new DatabaseResult(true);
  $now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
  $params = array($now->getDatabaseDateTimeFormat());
  $resultList = $databaseResult->getNotification($params, false);
  foreach ($resultList as $notification) {
    if ("" != $outputTop) {
      $outputTop .= "<br>";
    }
    $outputTop .= "***" . $notification->getDescription() . "***";
  }
}
$smarty->assign("contentTop", $outputTop);
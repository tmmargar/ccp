<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\utility\SessionUtility;
require_once "../autoload.php";
// check if site is down
$file_handle = fopen("../status.txt", "a+");
$contents = file_get_contents("../status.txt");
//fwrite($file_handle, "status=503.php");
$values = explode("=", $contents);
// echo $values[0] . " = " . $values[1];
if ($values[1] != "") {
  header("Location: " . $values[1]);
}
// TODO: NOT SURE WHERE TO PUT THIS
date_default_timezone_set(Constant::$NAME_TIME_ZONE);
if (strpos($_SERVER["SCRIPT_NAME"], "index.php") === false) {
  require_once "../initDefine.php";
  require_once "initSmarty.php";
  require_once "../initTidy.php";
}
require_once "initDefaults.php";
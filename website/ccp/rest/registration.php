<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
require_once "init.php";
define("TOURNAMENT_ID_PARAMETER_NAME", "tournamentId");
define("USER_ID_PARAMETER_NAME", "userId");
define("FOOD_FIELD_NAME", "food");
define("REGISTERED_FIELD_NAME", "registered");
define("REGISTERED_LABEL", "Registered");
define("UPDATE_REGISTER_TEXT", "Update");
define("WAIT_LIST_COUNT_FIELD_NAME", "waitListCount");
$smarty->assign("title", "Chip Chair and a Prayer Registration");
$output = "";
$output2 = "";
$smarty->assign("formName", "frmRegistration");
$tournamentId = (isset($_POST[TOURNAMENT_ID_PARAMETER_NAME]) ? $_POST[TOURNAMENT_ID_PARAMETER_NAME] : isset($_GET[TOURNAMENT_ID_PARAMETER_NAME])) ? $_GET[TOURNAMENT_ID_PARAMETER_NAME] : "";
$urlAction = $_SERVER["SCRIPT_NAME"] . "?tournamentId=" . $tournamentId;
$smarty->assign("action", $urlAction);
$smarty->assign("heading", "Registration");
$output .= "<script type=\"module\">\n" . "  import { dataTable, display, input } from \"../scripts/import.js\";\n" . "  let aryMessages = [];\n" . "  let aryErrors = [];\n" . "</script>\n";
$mode = isset($_POST[Constant::FIELD_NAME_MODE]) ? $_POST[Constant::FIELD_NAME_MODE] : Constant::MODE_VIEW;
$tournamentDate = isset($_GET["tournamentDate"]) ? $_GET["tournamentDate"] : "";
$max = $_GET["max"] == "Y" ? true : false;
$params = array($tournamentDate,$max);
// date (YYYY-MM-DD) and true if max false if not
$resultList = $databaseResult->getRegistrationList(params: $params);
if (0 < count($resultList)) {
  $count = 0;
  $registered = false;
  $output2 .= " <table id=\"output\">\n <tbody>\n";
  foreach ($resultList as $result) {
    $output2 .= "  <tr>\n";
    $output2 .= "   <td>" . $result[0] . " " . $result[1] . "</td>\n";
    $output2 .= "   <td>" . $result[2] . "</td>\n";
    $output2 .= "   <td>" . $result[3] . "</td>\n";
    $output2 .= "  </tr>\n";
    $count ++;
  }
  $output2 .= "</tbody>\n</table>\n";
} else {
  $output2 .= "  None\n";
}
$output .= $output2;
$smarty->assign("content", $output);
$smarty->display("registration_svc.tpl");
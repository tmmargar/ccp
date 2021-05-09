<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\DatabaseResult;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
if (!defined("USER_ID_PARAM_NAME")) {define("USER_ID_PARAM_NAME", "userId");}
$smarty->assign("title", "Chip Chair and a Prayer My Stats");
$style =
  " <style type=\"text/css\">\n" .
  " div {\n" .
  "   margin: 0 auto;\n" .
  "   text-align: center;\n" .
//   "   width: 100%;\n" .
  " }\n" .
  " div.title {\n" .
  "   font-weight: bold;\n" .
  " }\n" .
  " div#widget1,\n" .
  " div#widget2,\n" .
  " div#widget3,\n" .
  " div#widget4,\n" .
  " div#widget5,\n" .
  " div#widget6,\n" .
  " div#widget7,\n" .
  " div#widget8 {\n" .
  "  height: 70px;\n" .
  " }\n" .
  " div#widget9,\n" .
  " div#widget10,\n" .
  " div#widget11,\n" .
  " div#widget12 {\n" .
  "  height: 170px;\n" .
  " }\n" .
  " div#widget13,\n" .
  " div#widget14 {\n" .
  "  height: 250px;\n" .
  " }\n" .
  " div#widget1,\n" .
  " div#widget2,\n" .
  " div#widget3,\n" .
  " div#widget4,\n" .
  " div#widget5,\n" .
  " div#widget6,\n" .
  " div#widget7,\n" .
  " div#widget8,\n" .
  " div#widget9,\n" .
  " div#widget10,\n" .
  " div#widget11,\n" .
  " div#widget12,\n" .
  " div#widget13,\n" .
  " div#widget14 {\n" .
  "  float: left;\n" .
  "  font-size: smaller;\n" .
  "  margin: 0 auto;\n" .
  "  overflow: auto;\n" .
  "  width: 25%;\n" .
  " }\n" .
  "div#widgetTitle {\n" .
  "  font-size: 1.5em;\n" .
  "  font-weight: bold;\n" .
  "}\n" .
  " </style>\n";
$smarty->assign("style", $style);
$outputPersonalize = "<div id=\"widgetTitle\">\n";
$userId = (isset($_POST[USER_ID_PARAM_NAME]) ? $_POST[USER_ID_PARAM_NAME] : isset($_GET[USER_ID_PARAM_NAME])) ? $_GET[USER_ID_PARAM_NAME] : "";
if ($userId == "" || SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID) == $userId) {
  $outputPersonalize .= "My";
} else {
  $databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
  $params = array($userId);
  $resultList = $databaseResult->getUserById($params);
  $outputPersonalize .= $resultList[0]->getName() . "'s";
}
$outputPersonalize .= " Stats</div>\n";
$outputPersonalize .=
  " <div id=\"widgetContainer\">\n" .
  "  <div id=\"widget1\">\n";
$reportId = "tournamentsPlayedForUser";
$parentObjectId = "widget1";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget2\">\n";
$reportId = "winsForUser";
$parentObjectId = "widget2";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget3\">\n";
$reportId = "pointsTotalForUser";
$parentObjectId = "widget3";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget4\">\n";
$reportId = "earningsTotalForUser";
$parentObjectId = "widget4";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget5\">\n";
$reportId = "pointsTotalForSeasonForUser";
$parentObjectId = "widget5";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget6\">\n";
$reportId = "earningsTotalForSeasonForUser";
$parentObjectId = "widget6";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget7\">\n";
$reportId = "winsTotalForSeasonForUser";
$parentObjectId = "widget7";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget8\">\n";
$reportId = "knockoutsTotalForSeasonForUser";
$parentObjectId = "widget8";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget9\">\n";
$reportId = "knockoutsTotalForUser";
$parentObjectId = "widget9";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget10\">\n";
$reportId = "nemesisForUser";
$parentObjectId = "widget10";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget11\">\n";
$reportId = "bullyForUser";
$parentObjectId = "widget11";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget12\">\n";
  // $reportId = "tournamentsWonForUser";
  // $parentObjectId = "widget12";
  // include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget13\">\n";
$reportId = "tournamentsWonForUser";
$parentObjectId = "widget13";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n" .
  "  <div id=\"widget14\">\n";
$reportId = "finishesForUser";
$parentObjectId = "widget14";
$outputPersonalize .= include "top5.php";
$outputPersonalize .=
  "  </div>\n".
  " </div>\n";
$smarty->assign("content", $outputPersonalize);
$smarty->display("home.tpl");
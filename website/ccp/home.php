<?php
namespace ccp;
require_once "init.php";
$smarty->assign("title", "Chip Chair and a Prayer Home");
$style =
  " <style type=\"text/css\">\n" .
  " div {\n" .
  "   margin: 0 auto;\n" .
  "   text-align: center;\n" .
  "   width: 100%;\n" .
  " }\n" .
  " div.title {\n" .
  "   font-weight: bold;\n" .
  " }\n" .
  " div#widget1,\n" .
  " div#widget2,\n" .
  " div#widget3,\n" .
  " div#widget4,\n" .
  " div#widget5Wrapper,\n" .
  " div#widget5,\n" .
  " div#widget6 ,\n" .
  " div#widget7 {\n" .
  "  float: left;\n" .
  "  margin: 0 auto;\n" .
  "  overflow: auto;\n" .
  "  padding: 2px;\n" .
  " }\n" .
  " div#widget1,\n" .
  " div#widget2,\n" .
  " div#widget3,\n" .
  " div#widget4,\n" .
  " div#widget5Wrapper,\n" .
  " div#widget6 {\n" .
  "  width: 33%;\n" .
  " }\n" .
  " div#widget1,\n" .
  " div#widget2,\n" .
  " div#widget3 {\n" .
  "  height: 215px;\n" .
  " }\n" .
  " div#widget5  {\n" .
  "  height: 80px;\n" .
  " }\n" .
  " div#widget7 {\n" .
  "  font-size: 1.5em;\n" .
  " }\n" .
  " </style>";
$smarty->assign("style", $style);
$outputHome =
  " <div id=\"widgetContainer\">\n" .
  "  <div id=\"widget1\">\n";
$reportId = "pointsTotalForSeason";
$parentObjectId = "widget1";
$outputHome .= include "top5.php";
$outputHome .=
  "  </div>\n" .
  "  <div id=\"widget2\">\n";
$reportId = "earningsTotalForSeason";
$parentObjectId = "widget2";
$outputHome .= include "top5.php";
$outputHome .=
  "  </div>\n" .
  "  <div id=\"widget3\">\n";
$reportId = "knockoutsTotalForSeason";
$parentObjectId = "widget3";
$outputHome .= include "top5.php";
$outputHome .=
  "  </div>\n" .
  "  <div id=\"widget7\">\n";
$reportId = "prizePoolForSeason";
$parentObjectId = "widget7";
$outputHome .= include "top5.php";
$outputHome .=
  "  </div>\n" .
  "  <div id=\"widget4\">\n";
$reportId = "winnersForSeason";
$parentObjectId = "widget4";
$outputHome .= include "top5.php";
$outputHome .=
  "  </div>\n" .
  "  <div id=\"widget5Wrapper\">\n" .
  "   <div id=\"widget5\">\n";
$reportId = "bountiesForSeason";
$parentObjectId = "widget5";
$outputHome .= include "top5.php";
$outputHome .=
  "   </div>\n";
$outputHome .= include "chartGauge.php";
$outputHome .=
  "  </div>\n";
$outputHome .=
  "  <div id=\"widget6\">\n";
// $reportId = "earningsTotalForSeasonForUser";
// $parentObjectId = "widget6";
$limitCount = 4;
$outputHome .= include "registrationList.php";
$outputHome .=
  "  </div>\n".
  " </div>\n";
$smarty->assign("content", $outputHome);
$smarty->display("home.tpl");
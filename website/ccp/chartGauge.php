<?php
namespace ccp;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
if (!defined("REPORT_ID_PARAM_NAME")) {define("USER_ID_PARAM_NAME", "userId");}
$userId = (isset($_POST[USER_ID_PARAM_NAME]) ? $_POST[USER_ID_PARAM_NAME] : isset($_GET[USER_ID_PARAM_NAME])) ? $_GET[USER_ID_PARAM_NAME] : SessionUtility::getValue("userid");
// $userId = 91; //13590;
// $now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
// $output = "<!doctype html>\n";
// $output .= "<html>\n";
// $output .= "<head>\n";
// $output .= " <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">\n";
// $output .= " <style type=\"text/css\">\n";
// $output .= " @import url(\"css/menu.css\");\n";
// $output .= " @import url(\"css/jquery-ui.css\");\n";
// $output .= " @import url(\"css/display.css\");\n";
// $output .= " @import url(\"css/datatables.css\");\n";
// $output .= " </style>\n";
// $output .= " <script src=\"scripts/jquery/jquery.js\" type=\"text/javascript\"></script>\n";
// $output .= " <script src=\"scripts/jquery/jquery-ui.js\" type=\"text/javascript\"></script>\n";
// $output .= " <script src=\"scripts/jquery/datatables.js\" type=\"text/javascript\"></script>\n";
// $output .= " <script src=\"scripts/scripts.js\" type=\"text/javascript\"></script>\n";
// $output .= " <script src=\"scripts/reports.js\" type=\"text/javascript\"></script>\n";
$output = "";
$output .= " <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>\n";
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $year = $now->getYearFormat();
// $startDate = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $year . DateTime::$DATE_START_SEASON);
// $endDate = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $year . DateTime::$DATE_END_SEASON);
$startDate = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat();
$endDate = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat();
$params = array($startDate, $endDate, null, false);
$resultList = $databaseResult->getCountTournamentForDates($params);
if (0 < count($resultList)) {
  $tournamentsTotal = $resultList[0] == 0 ? 1 : $resultList[0];
  $labelIncrement = $tournamentsTotal / 4;
  $labelPlayed1 = $labelIncrement;
  $labelPlayed2 = $labelIncrement * 2;
  $labelPlayed3 = $labelIncrement * 3;
  $labelPlayed4 = $tournamentsTotal;
}
$params = array($startDate, $endDate, $userId, true);
$resultList = $databaseResult->getCountTournamentForDates($params);
if (0 < count($resultList)) {
  $tournamentsPlayed = $resultList[0];
}
// $startDate = "2019-10-01";
$params = array($startDate, $endDate, null, false);
$resultList = $databaseResult->getCountTournamentForDates($params);
if (0 < count($resultList)) {
  $tournamentsLeft = $resultList[0] == 0 ? 1 : $resultList[0];
  $yellowFrom = 0;
  $yellowTo = $tournamentsLeft / 2;
  $redFrom = $yellowTo;
  $redTo = $tournamentsLeft;
  $labelIncrement = $tournamentsLeft / 4;
  $labelNeed1 = $labelIncrement;
  $labelNeed2 = $labelIncrement * 2;
  $labelNeed3 = $labelIncrement * 3;
  $labelNeed4 = $tournamentsLeft;
}
$output .= " <script type=\"text/javascript\">\n";
$output .= "  google.charts.load('current', {'packages':['gauge']});\n";
$output .= "  google.charts.setOnLoadCallback(drawGauge);\n";
// $output .= " var gaugeOptions = {min: 0, max: 20, yellowFrom: 5, yellowTo: 10, redFrom: 0, redTo: 5, majorTicks: [\"0\", \"5\", \"10\", \"15\", \"20\"], minorTicks: 5, greenFrom: 10, greenTo: 20};\n";
$output .= "  var gaugeOptions = {min: 0, max: $tournamentsTotal, yellowFrom: 5, yellowTo: 10, redFrom: 0, redTo: 5, majorTicks: [\"0\", \"$labelPlayed1\", \"$labelPlayed2\", \"$labelPlayed3\", \"$labelPlayed4\"], minorTicks: 5, greenFrom: 10, greenTo: $tournamentsTotal};\n";
// $output .= " var gaugeOptions2 = {min: 0, max: $tournamentsLeft, yellowFrom: 0, yellowTo: 4, redFrom: 4, redTo: $tournamentsLeft, majorTicks: [\"0\", \"2\", \"4\", \"6\", \"8\"], minorTicks: 2};\n";
$output .= "  var gaugeOptions2 = {min: 0, max: $tournamentsLeft, yellowFrom: $yellowFrom, yellowTo: $yellowTo, redFrom: $redFrom, redTo: $redTo, majorTicks: [\"0\", \"$labelNeed1\", \"$labelNeed2\", \"$labelNeed3\", \"$labelNeed4\"], minorTicks: 2};\n";
//$output .= "  var gaugeOptions2 = {min: 0, max: 4, yellowFrom: 0, yellowTo: 0, redFrom: 0, redTo: 0, majorTicks: [\"0\", \"0\", \"2\", \"3\", \"4\"], minorTicks: 2};\n";
$output .= "  function drawGauge() {\n";
$output .= "   gaugeData = new google.visualization.DataTable();\n";
$output .= "   gaugeData.addColumn('number', 'Played');\n";
$output .= "   gaugeData.addRows(1);\n";
$output .= "   gaugeData.setCell(0, 0, $tournamentsPlayed);\n";
$output .= "   var gauge = new google.visualization.Gauge(document.getElementById('gaugePlayed'));\n";
$output .= "   gauge.draw(gaugeData, gaugeOptions);\n";
$output .= "   // make table width 100% so it centers\n";
$output .= "   $(\"#gaugePlayed\").find(\"table\").css(\"width\", \"100%\");\n";
$output .= "   gaugeData2 = new google.visualization.DataTable();\n";
$output .= "   gaugeData2.addColumn('number', 'Needed');\n";
$output .= "   gaugeData2.addRows(1);\n";
$output .= "   gaugeData2.setCell(0, 0, (10 - $tournamentsPlayed > 0 ? 10 - $tournamentsPlayed : 0));\n";
$output .= "   var gauge2 = new google.visualization.Gauge(document.getElementById('gaugeNeed'));\n";
$output .= "   gauge2.draw(gaugeData2, gaugeOptions2);\n";
$output .= "   // make table width 100% so it centers\n";
$output .= "   $(\"#gaugeNeed\").find(\"table\").css(\"width\", \"100%\");\n";
$output .= "  }\n";
$output .= " </script>\n";
// $output .= " </style>\n";
// $output .= "</head>\n";
// $output .= "<body>\n";
// $output .= HtmlUtility::buildNavigation();
// $output .= " <form action=\"\" method=\"POST\" id=\"frmCharts\" name=\"frmCharts\">\n";
// $output .= " <fieldset>\n";
// $output .= " <div id=\"gaugeNeed\" style=\"width:560px; height: 280px;\"></div>\n";
// $output .= " <div id=\"gaugePlayed\" style=\"width:560px; height: 280px;\"></div>\n";
$output .= "   <div class=\"title\">Championship Qualification</div>\n";
$output .= "   <div id=\"gaugeNeed\" style=\"overflow: hidden;\"></div>\n";
$output .= "   <div id=\"gaugePlayed\" style=\"overflow: hidden;\"></div>\n";
// $output .= " </fieldset>\n";
// $output .= " </form>\n";
// $output .= "</body>\n";
// $output .= "</html>\n";
// echo $output;
return $output;
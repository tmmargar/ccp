<?php
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\utility\HtmlUtility;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("REPORT_ID_PARAM_NAME", "reportId");
define("TOURNAMENT_ID_PARAM_NAME", "tournamentId");
define("YEAR_PARAM_NAME", "year");
define("YEAR_SELECTION_PARAM_NAME", "yearSelection");
define("REPORT_ID_TOURNAMENT_RESULTS", "results");
define("REPORT_ID_TOTAL_POINTS", "pointsTotal");
define("REPORT_ID_EARNINGS", "earnings");
define("REPORT_ID_KNOCKOUTS", "knockouts");
define("REPORT_ID_SUMMARY", "summary");
define("REPORT_ID_SUMMARY_STATS", "summaryStats");
define("REPORT_ID_WINNERS", "winners");
define("REPORT_ID_FINISHES", "finishes");
define("REPORT_ID_BOUNTIES", "bounties");
define("ALL_USERS_INFO", "allUsersInfo");
define("REPORT_ID_FIELD_NAME", "reportId");
if (! isset($reportId)) {
  $reportId = isset($_POST[REPORT_ID_PARAM_NAME]) ? $_POST[REPORT_ID_PARAM_NAME] : isset($_GET[REPORT_ID_PARAM_NAME]) ? $_GET[REPORT_ID_PARAM_NAME] : null;
}
if (! isset($tournamentId)) {
  $tournamentId = isset($_POST[TOURNAMENT_ID_PARAM_NAME]) ? $_POST[TOURNAMENT_ID_PARAM_NAME] : isset($_GET[TOURNAMENT_ID_PARAM_NAME]) ? $_GET[TOURNAMENT_ID_PARAM_NAME] : null;
}
if (! isset($yearSelection)) {
  $yearSelection = isset($_POST[YEAR_SELECTION_PARAM_NAME]) ? $_POST[YEAR_SELECTION_PARAM_NAME] : isset($_GET[YEAR_SELECTION_PARAM_NAME]) ? $_GET[YEAR_SELECTION_PARAM_NAME] : null;
}
if (! isset($yearSelection)) {
  $yearSelection = "hide";
}
if (! isset($year)) {
  $year = isset($_POST[YEAR_PARAM_NAME]) ? $_POST[YEAR_PARAM_NAME] : isset($_GET[YEAR_PARAM_NAME]) ? $_GET[YEAR_PARAM_NAME] : null;
}
$now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
if (! isset($year)) {
  $year = $now->getCurrentYearFormat();
}
if ("ALL" == $year) {
  $startDate = null;
  $endDate = null;
} else {
//   $startDate = DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate($year . DateTime::$DATE_START_SEASON, null));
  $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $year . DateTime::$DATE_START_SEASON);
  $startDate = $dateTime->getDatabaseFormat();
//   $endDate = DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate($year . Constant::$DATE_END_SEASON, null));
  $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $year . Constant::$DATE_END_SEASON);
  $endDate = $dateTime->getDatabaseFormat();
}
if (! isset($reportId)) {
  echo "Unable to identify report to view";
  die();
}
switch ($reportId) {
  case REPORT_ID_TOURNAMENT_RESULTS:
    if (! isset($tournamentId)) {
      echo "Unable to identify tournament to view results for";
      die();
    }
    break;
}
switch ($reportId) {
  case REPORT_ID_TOURNAMENT_RESULTS:
    $title = "Tournament results";
    break;
  case REPORT_ID_TOTAL_POINTS:
    $title = "Total points";
    break;
  case REPORT_ID_EARNINGS:
    $title = "Earnings";
    break;
  case REPORT_ID_KNOCKOUTS:
    $title = "Knockouts";
    break;
  case REPORT_ID_SUMMARY:
  case REPORT_ID_SUMMARY_STATS:
    $title = "Summary";
    break;
  case REPORT_ID_WINNERS:
    $title = "Winners";
    break;
  case REPORT_ID_FINISHES:
    $title = "Finishes";
    break;
  case REPORT_ID_BOUNTIES:
    $title = "Bounties";
    break;
  case ALL_USERS_INFO:
    $title = "Nemesises and bullies";
    break;
  default:
    echo "No value provided for report id";
    die();
}
$smarty->assign("prefix", Constant::PREFIX());
$smarty->assign("title", $title);
$smarty->assign("lastModified", HtmlUtility::buildLastModified());
$smarty->assign("formName", "frmReports");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . htmlentities($_SERVER["QUERY_STRING"], ENT_NOQUOTES, "UTF-8"));
$smarty->assign("script", "<script src=\"" . Constant::PREFIX() . "scripts/reports.js\" type=\"text/javascript\"></script>");
  $databaseResult = new DatabaseResult();
  $databaseResult->setDebug(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
  $output = "";
  $mode = "";
  $classNames = null;
  if (! isset($caption)) {
    $caption = null;
  }
  $colFormats = null;
  $hiddenId = null;
  $selectedColumnVals = "";
  $delimiter = Constant::$DELIMITER_DEFAULT;
  $foreignKeys = null;
  $headerRow = true;
  $html = NULL;
  $showNote = false;
  $hiddenAdditional = null;
  $hideColIndexes = null;
  $colSpan = null;
  switch ($reportId) {
    case REPORT_ID_TOURNAMENT_RESULTS:
      $prizePool = null;
      $aryChampionships = $databaseResult->getTournamentChampionships();
      $ctr = 0;
      while ($ctr < count($aryChampionships)) {
        $aryChampionshipIds[$ctr] = $aryChampionships[$ctr][0];
        $aryChampionshipYears[$ctr] = $aryChampionships[$ctr][1];
        if ($tournamentId == $aryChampionshipIds[$ctr]) {
//           $startDateChampionship = DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate($aryChampionshipYears[$ctr] . DateTime::$DATE_START_SEASON, null));
          $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $aryChampionshipYears[$ctr] . DateTime::$DATE_START_SEASON);
          $startDateChampionship = $dateTime->getDatabaseFormat();
//           $endDateChampionship = DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate($aryChampionshipYears[$ctr] . DateTime::$DATE_END_SEASON, null));
          $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $aryChampionshipYears[$ctr] . DateTime::$DATE_START_SEASON);
          $endDateChampionship = $dateTime->getDatabaseFormat();
          $params = array($startDateChampionship, $endDateChampionship);
          $resultList = $databaseResult->getPrizePoolForSeason($params, false);
          if (0 < count($resultList)) {
            $prizePool = $resultList[0];
            break;
          }
        }
        $ctr ++;
      }
      $params = array(
        $tournamentId);
      $resultList = $databaseResult->getTournamentById($params);
      if (0 < count($resultList)) {
        $tournament = $resultList[0];
        $output .= "<strong>Game details: " . $tournament->getDescription() . ", " . $tournament->getLimitType()->getName() . " " . $tournament->getGameType()->getName() . " " . $tournament->getComment() . " at " . $tournament->getLocation()->getName() . "</strong>";
      }
      $params = array($prizePool, $tournamentId);
      $query = $databaseResult->getResultByTournamentId($params);
      $colFormats = array(array(0, "number", 0), array(2, "currency,negative", 0), array(3, "currency,negative", 0), array(4, "currency", 0), array(5, "number", 0));
      $width = Constant::FLAG_LOCAL() ? "50%" : "100%";
      break;
    case REPORT_ID_TOTAL_POINTS:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getResultOrderedTotalPoints($params);
      $colFormats = array(array(1, "number", 0), array(2, "number", 2), array(3, "number", 0));
      $width = Constant::FLAG_LOCAL() ? "28%" : "100%";
      break;
    case REPORT_ID_EARNINGS:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getResultOrderedEarnings($params);
      $colFormats = array(array(1, "currency", 0), array(2, "currency", 2), array(3, "currency", 0), array(4, "number", 0));
      $width = Constant::FLAG_LOCAL() ? "35%" : "100%";
      break;
    case REPORT_ID_KNOCKOUTS:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getResultOrderedKnockouts($params);
      $colFormats = array(array(1, "number", 0), array(2, "number", 2), array(3, "number", 0), array(4, "number", 0));
      $width = Constant::FLAG_LOCAL() ? "30%" : "100%";
      break;
    case REPORT_ID_SUMMARY:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getResultOrderedSummary($params);
      $colFormats = array(array(1, "number", 0), array(2, "number", 0), array(3, "number", 0), array(4, "percentage", 2), array(5, "number", 2), array(6, "number", 0), array(7, "number", 0), array(8, "currency", 0), array(9, "currency", 0), array(10, "currency", 0), array(12, "currency", 0), array(13, "currency", 0));
      $hideColIndexes = array(11);
      $colSpan = array(array("Final Tables", "Finish", "Money Out", "Money In"), array(3, 5, 8, 12), array(array(4), array(6, 7), array(9, 10), array(13)));
      $width = Constant::FLAG_LOCAL() ? "80%" : "100%";
      break;
    case REPORT_ID_SUMMARY_STATS:
      $params = array($startDate, $endDate);
      $resultListStats = $databaseResult->getResultOrderedSummaryStats($params);
      break;
    case REPORT_ID_WINNERS:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getWinnersForSeason($params, true, null);
      $colFormats = array(array(2, "number", 0), array(3, "percentage", 2), array(4, "number", 0));
      $hideColIndexes = array(0);
      $width = Constant::FLAG_LOCAL() ? "25%" : "75%";
      break;
    case REPORT_ID_FINISHES:
      $params = array($userId, $startDate, $endDate);
      $query = $databaseResult->getFinishesForUser($params);
      $colFormats = array(array(0, "number", 0), array(1, "number", 0), array(2, "percentage", 2));
      $caption = "";
      $width = Constant::FLAG_LOCAL() ? "15%" : "100%";
      break;
    case REPORT_ID_BOUNTIES:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getBountyEarnings($params);
      $colFormats = array(array(2, "currency", 0), array(3, "currency,negative", 0));
      $hideColIndexes = array(0);
      $caption = "";
      $width = Constant::FLAG_LOCAL() ? "25%" : "100%";
      break;
    case ALL_USERS_INFO:
      // $query = $databaseResult->getUsersAll();
      $hideColIndexes = array(0, 2, 3, 4, 5);
      $width = Constant::FLAG_LOCAL() ? "15%" : "100%";
      break;
  }
  $style = "<style type=\"text/css\">\n" .
  // $style .= " td {\n text-align: center;\n }\n";
  " .dataTables_length {\n" . "   width: " . ($width - 13) . "%;\n" . "   float: left;\n" . " }\n" . " .dataTables_info {\n" . "   width: " . ($width - 8) . "%;\n" . " }\n</style>";
  $smarty->assign("style", $style);
  if ("show" == $yearSelection) {
//     $output .= HtmlUtility::buildSelect(Constant::$ACCESSKEY_YEAR, null, false, HtmlUtility::buildId("year"), false, HtmlUtility::buildId("year"), false, 1, null);
    $output .= HtmlUtility::buildSelect(Constant::$ACCESSKEY_YEAR, null, false, "year", false, HtmlUtility::buildId("year"), false, 1, null);
    $output .= HtmlUtility::buildOption(false, "", "Overall", "ALL");
    $resultList = $databaseResult->getTournamentYearsPlayed();
    if (0 < count($resultList)) {
      $ctr = 0;
      while ($ctr < count($resultList)) {
        $output .= HtmlUtility::buildOption(false, $year == $resultList[$ctr] ? $resultList[$ctr] : "", $resultList[$ctr], $resultList[$ctr]);
        $ctr ++;
      }
    }
    $output .= "</select>\n";
  }
  if (ALL_USERS_INFO == $reportId) {
    $output .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"" . Constant::$ID_TABLE_DATA . "Info\">\n" . " <thead>\n  <tr>\n   <th>Name</th>\n</tr>\n</thead>\n" . " <tbody>\n";
    $resultList = $databaseResult->getUsersAll();
    $url = "javascript:void(0);";
    foreach ($resultList as $user) {
      $output .= "  <tr>\n   <td><a href=\"" . $url . (Constant::FLAG_LOCAL() ? "" : "&amp;userId=" . $user->getId()) . "\">" . $user->getName() . "'s stats</a></td>\n  </tr>\n";
    }
    $output .= " </tbody>\n</table>\n";
  } else if (REPORT_ID_SUMMARY_STATS == $reportId) {
    // print_r($resultListStats);die();
    foreach ($resultListStats as $resultListStatsKey => $resultListStatsValue) {
      $outputKeys = "";
      foreach ($resultListStatsValue as $resultListStatsValueKey => $resultListStatsValueValue) {
        $outputKeys .= $resultListStatsValueKey . ", ";
      }
      $outputKeys = substr($outputKeys, 0, - 2) . "<br>";
      // echo "<br>" . strlen($outputKeys) . " > " . strlen($outputKeysFinal);
      if (strlen($outputKeys) > strlen($outputKeysFinal)) {
        $outputKeysFinal = $outputKeys;
        // echo "<br>" . $outputKeysFinal;
      }
    }
    $output .= $outputKeysFinal;
    foreach ($resultListStats as $resultListStatsKey => $resultListStatsValue) {
      $output .= implode(",", $resultListStatsValue) . "<br>";
    }
  } else {
    $output .= HtmlUtility::buildTable($query, $mode, $classNames, $caption, $colFormats, $hiddenId, $selectedColumnVals, $delimiter, $foreignKeys, $html, $headerRow, $showNote, $hiddenAdditional, $hideColIndexes, $colSpan, str_replace(" ", "", ucwords($title)), $width);
  }
  $output .= HtmlUtility::buildHidden(HtmlUtility::buildId(REPORT_ID_FIELD_NAME) . "2", HtmlUtility::buildId(REPORT_ID_FIELD_NAME), HtmlUtility::buildId(REPORT_ID_FIELD_NAME), $reportId);
$smarty->assign("content", $output);
$smarty->display("reports.tpl");
?>
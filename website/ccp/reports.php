<?php
namespace ccp;
use ccp\classes\model\Base;
use ccp\classes\model\Constant;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("REPORT_ID_PARAM_NAME", "reportId");
define("USER_ID_PARAM_NAME", "userId");
define("TOURNAMENT_ID_PARAM_NAME", "tournamentId");
define("SEASON_PARAM_NAME", "season");
define("SEASON_SELECTION_PARAM_NAME", "seasonSelection");
define("REPORT_ID_TOURNAMENT_RESULTS", "results");
define("REPORT_ID_TOTAL_POINTS", "pointsTotal");
define("REPORT_ID_EARNINGS", "earnings");
define("REPORT_ID_EARNINGS_CHAMPIONSHIP", "earningsChampionship");
define("REPORT_ID_KNOCKOUTS", "knockouts");
define("REPORT_ID_SUMMARY", "summary");
define("REPORT_ID_WINNERS", "winners");
define("REPORT_ID_FINISHES", "finishes");
define("REPORT_ID_BOUNTIES", "bounties");
define("REPORT_ID_LOCATIONS_HOSTED_COUNT", "locationsHostedCount");
define("REPORT_ID_CHAMPIONSHIP", "championship");
define("SORT_ID_PARAM_NAME", "sort");
define("GROUP_PARAM_NAME", "group");
define("SEASON_START_DATE_PARAM_NAME", "seasonStartDate");
define("SEASON_END_DATE_PARAM_NAME", "seasonEndDate");
define("ALL_USERS_INFO", "allUsersInfo");
define("REPORT_ID_FIELD_NAME", "reportId");
define("SEASON_START_DATE_FIELD_NAME", "seasonStartDate");
define("SEASON_END_DATE_FIELD_NAME", "seasonEndDate");
$output = "";
if (!isset($reportId)) {
  $reportId = (isset($_POST[REPORT_ID_PARAM_NAME]) ? $_POST[REPORT_ID_PARAM_NAME] : isset($_GET[REPORT_ID_PARAM_NAME])) ? $_GET[REPORT_ID_PARAM_NAME] : null;
}
$userId = (isset($_POST[USER_ID_PARAM_NAME]) ? $_POST[USER_ID_PARAM_NAME] : isset($_GET[USER_ID_PARAM_NAME])) ? $_GET[USER_ID_PARAM_NAME] : SessionUtility::getValue("userid");
if (!isset($tournamentId)) {
  $tournamentId = (isset($_POST[TOURNAMENT_ID_PARAM_NAME]) ? $_POST[TOURNAMENT_ID_PARAM_NAME] : isset($_GET[TOURNAMENT_ID_PARAM_NAME])) ? $_GET[TOURNAMENT_ID_PARAM_NAME] : null;
}
if (!isset($seasonSelection)) {
  $seasonSelection = (isset($_POST[SEASON_SELECTION_PARAM_NAME]) ? $_POST[SEASON_SELECTION_PARAM_NAME] : isset($_GET[SEASON_SELECTION_PARAM_NAME])) ? $_GET[SEASON_SELECTION_PARAM_NAME] : "hide";
}
if (!isset($seasonId)) {
  $seasonTemp = (isset($_POST[SEASON_PARAM_NAME]) ? $_POST[SEASON_PARAM_NAME] : isset($_GET[SEASON_PARAM_NAME])) ? $_GET[SEASON_PARAM_NAME] : null;
  $arySeason = explode("::", $seasonTemp);
  $seasonId = $arySeason[0];
  if (count($arySeason) > 1) {
    $seasonStartDate = $arySeason[1];
    $seasonEndDate = $arySeason[2];
  } else {
    $seasonStartDate = null;
    $seasonEndDate = null;
  }
}
if ("ALL" == $seasonId) {
  $startDate = null;
  $endDate = null;
  $year = $seasonId;
} else {
  $startDate = isset($seasonStartDate) ? new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonStartDate) : SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE);
  $endDate = isset($seasonEndDate) ? new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonEndDate) : SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE);
  $year = $startDate->getYearFormat();
}
$group = (isset($_POST[GROUP_PARAM_NAME]) ? $_POST[GROUP_PARAM_NAME] : isset($_GET[GROUP_PARAM_NAME])) ? $_GET[GROUP_PARAM_NAME] : null;
$style = " <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">\n";
$smarty->assign("heading", "");
$smarty->assign("style", $style);
$smarty->assign("formName", "frmReports");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
if (!isset($reportId)) {
  $output .= "Unable to identify report to view";
} else {
  switch ($reportId) {
    case REPORT_ID_TOURNAMENT_RESULTS:
      if (! isset($tournamentId)) {
        $output .= "Unable to identify tournament to view results for";
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
    case REPORT_ID_EARNINGS_CHAMPIONSHIP:
      $title = "Earnings (Championship)";
      break;
    case REPORT_ID_KNOCKOUTS:
      $title = "Knockouts";
      break;
    case REPORT_ID_SUMMARY:
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
    case REPORT_ID_LOCATIONS_HOSTED_COUNT:
      $title = "Locations hosted count";
      break;
    case REPORT_ID_CHAMPIONSHIP:
      $title = "Championship";
      break;
    default:
      $output = "No value provided for report id";
  }
  $smarty->assign("title", "Chip Chair and a Prayer " . $title . " Report");
  $classNames = null;
  $caption = null;
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
      $params = array($tournamentId, Constant::$DESCRIPTION_CHAMPIONSHIP);
      $resultList = $databaseResult->getSeasonByIdAndDesc($params);
      if (0 < count($resultList)) {
        $params = array($resultList[0]->getStartDate()->getDatabaseFormat(), $resultList[0]->getEndDate()->getDatabaseFormat());
        $resultList2 = $databaseResult->getPrizePoolForSeason($params, false);
        $prizePool = $resultList2[0];
      }
      $params = array();
      $resultListIds = $databaseResult->getTournamentIdList($params);
      $params = array($tournamentId);
      $resultList = $databaseResult->getTournamentById($params);
      if (0 < count($resultList)) {
        $tournament = $resultList[0];
        $arrayIndex = array_keys($resultListIds, $tournament->getId());
        $width = "50%";
        $output .= "<div class=\"center\" style=\"width: " . $width . ";\">\n";
        if (count($arrayIndex) > 0) {
          $output .= "<a title=\"Previous\" href=\"reports.php?reportId=results&amp;tournamentId=" . $resultListIds[$arrayIndex[0] - 1] . "\"><i class=\"material-icons\">chevron_left</i></a>\n";
        }
        if ($arrayIndex[0] < (count($resultListIds) - 1)) {
          $output .= "<a title=\"Next\" href=\"reports.php?reportId=results&amp;tournamentId=" . $resultListIds[$arrayIndex[0] + 1] . "\"><i class=\"material-icons\">chevron_right</i></a>\n";
        }
        $output .= "</div>\n<br>\n";
        $output .= "<strong>Game details: " . $tournament->getDescription() . ", " . $tournament->getLimitType()->getName() . " " . $tournament->getGameType()->getName() . " " . $tournament->getComment() . " at " . $tournament->getLocation()->getName() . "</strong>";
      }
      $params = array($prizePool, $tournamentId);
      $query = $databaseResult->getResultByTournamentId($params);
      $colFormats = array(array(0, "number", 0), array(2, "currency,negative", 0), array(3, "currency,negative", 0), array(4, "currency", 0), array(5, "number", 0));
      $hideColIndexes = array(8); // hide 2 actives
            // $width = Constant::FLAG_LOCAL() ? "50%" : "100%";
//       $width = "60%";
      break;
    case REPORT_ID_TOTAL_POINTS:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getResultOrderedTotalPoints($params);
      $colFormats = array(array(1, "number", 0), array(2, "number", 2), array(3, "number", 0));
      $hideColIndexes = array(4);
      // $width = Constant::FLAG_LOCAL() ? "28%" : "100%";
      $width = "28%";
      break;
    case REPORT_ID_EARNINGS:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getResultOrderedEarnings($params);
      $colFormats = array(array(1, "currency", 0), array(2, "currency", 2), array(3, "currency", 0), array(4, "number", 0));
      $hideColIndexes = array(5);
      // $width = Constant::FLAG_LOCAL() ? "35%" : "100%";
      $width = "35%";
      break;
    case REPORT_ID_EARNINGS_CHAMPIONSHIP:
      $params = array("ALL" == $seasonId ? null : $year);
      $query = $databaseResult->getEarningsTotalForChampionship($params);
      $colFormats = array(array(2, "currency", 0));
      $hideColIndexes = array(0);
      // $width = Constant::FLAG_LOCAL() ? "35%" : "100%";
      $width = "20%";
      break;
    case REPORT_ID_KNOCKOUTS:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getResultOrderedKnockouts($params);
      $colFormats = array(array(2, "number", 0), array(3, "number", 2), array(4, "number", 0), array(5, "number", 0));
      $hideColIndexes = array(0, 6);
      // $width = Constant::FLAG_LOCAL() ? "30%" : "100%";
      $width = "30%";
      break;
    case REPORT_ID_SUMMARY:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getResultOrderedSummary($params);
      // name, tourneys, points, AvgPoints, count, %, avg, best, worst, buyins, rebuys, addons, bounties, earnings, net(+/-)
      // name, tourneys, points, count, %, avg, best, worst, buyins, rebuys, addons, bounties, earnings, net(+/-)
      $colFormats = array(array(1, "number", 0), array(2, "number", 0), array(3, "number", 0), array(4, "number", 0), array(5, "percentage", 2), array(6, "number", 2), array(7, "number", 0), array(8, "number", 0), array(9, "currency", 0), array(10, "currency", 0), array(11, "currency", 0), array(12, "currency", 0), array(13, "currency", 0), array(14, "currency", 0), array(15, "currency", 0), array(16, "currency", 0), array(17, "currency", 0));
      $hideColIndexes = array(3, 13, 18);
      $colSpan = array(array("Final Tables", "Finish", "Money Out", "Money In"), array(4, 6, 9, 14), array(array(5), array(7, 8), array(10, 11, 12), array(15, 16, 17)));
      // $width = Constant::FLAG_LOCAL() ? "80%" : "100%";
      $width = "100%";
      break;
    case REPORT_ID_WINNERS:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getWinnersForSeason($params, true, null);
      $colFormats = array(array(2, "number", 0), array(3, "percentage", 2), array(4, "number", 0));
      $hideColIndexes = array( 0, 5);
      $width = Constant::FLAG_LOCAL() ? "25%" : "75%";
      break;
    case REPORT_ID_FINISHES:
      $params = array($userId, $startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getFinishesForUser($params);
      $colFormats = array(array(0, "number", 0), array(1, "number", 0), array(2, "percentage", 2));
      $caption = "";
      // $width = Constant::FLAG_LOCAL() ? "15%" : "100%";
      $width = "15%";
      break;
    case REPORT_ID_BOUNTIES:
      $params = array($startDate == null ? null : $startDate->getDatabaseFormat(), $endDate == null ? null : $endDate->getDatabaseFormat());
      $query = $databaseResult->getBountyEarnings($params);
      $colFormats = array(array(2, "currency", 0), array(3, "currency,negative", 0));
      $hideColIndexes = array(0, 4, 5);
      $caption = "";
      // $width = Constant::FLAG_LOCAL() ? "25%" : "100%";
      $width = "25%";
      break;
    case REPORT_ID_LOCATIONS_HOSTED_COUNT:
      $query = $databaseResult->getLocationsHostedCount();
      $colFormats = array(array(10, "number", 0));
      $hideColIndexes = array(0, 2);
      // $width = Constant::FLAG_LOCAL() ? "65%" : "100%";
      $width = "65%";
      break;
    case REPORT_ID_CHAMPIONSHIP:
      // $params = array(null, null, "yr desc, earnings desc");
      // $params = array(null, null, $sort);
      $params = array(null, null, null, $group); // from date, to date, sort, group
      $query = $databaseResult->getChampionshipByYearByEarnings($params);
      $colFormats = array(array($group ? 1 : 3, "currency", 0));
      $hideColIndexes = $group ? null : array(
        1);
      // $width = Constant::FLAG_LOCAL() ? "30%" : "100%";
      $width = "30%";
      break;
  }
  if ("show" == $seasonSelection) {
    $output .= "<div>\n";
    $selectSeason = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SEASON, null, false, Base::build("season", null), false, Base::build("season", null), null, false, 1, null, null);
    $output .= "Season: " . $selectSeason->getHtml();
    $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, "", null, "Overall", "ALL");
    $output .= $option->getHtml();
    $params = array(null, false);
    $resultList = $databaseResult->getSeason($params);
    if (0 < count($resultList)) {
      $ctr = 0;
      while ($ctr < count($resultList)) {
        $seasonText = $resultList[$ctr]->getDescription() . " (" . $resultList[$ctr]->getStartDate()->getDisplayFormat() . " - " . $resultList[$ctr]->getEndDate()->getDisplayFormat() . ")";
        $seasonValue = $resultList[$ctr]->getId() . "::" . $resultList[$ctr]->getStartDate()->getDatabaseFormat() . "::" . $resultList[$ctr]->getEndDate()->getDatabaseFormat();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $year == $resultList[$ctr]->getStartDate()->getYearFormat() || $year == $resultList[$ctr]->getEndDate()->getYearFormat() ? $seasonValue : "", null, $seasonText, $seasonValue);
        $output .= $option->getHtml();
        $ctr++;
      }
    }
    $output .= "</select>\n";
    $hiddenSeasonStartDate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SEASON_START_DATE_FIELD_NAME, null, SEASON_START_DATE_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $seasonStartDate, null);
    $output .= $hiddenSeasonStartDate->getHtml();
    $hiddenSeasonEndDate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SEASON_END_DATE_FIELD_NAME, null, SEASON_END_DATE_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $seasonEndDate, null);
    $output .= $hiddenSeasonEndDate->getHtml();
    $output .= "</div>\n";
  }
  $htmlTable = new HtmlTable($caption, $classNames, $colSpan, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), $delimiter, $foreignKeys, $headerRow, $hiddenAdditional, $hiddenId, $hideColIndexes, $html, null, null, $showNote, $query, $selectedColumnVals, str_replace(" ", "", ucwords($title)), $width);
  $outputTable = $htmlTable->getHtml();
  if (REPORT_ID_TOURNAMENT_RESULTS == $reportId && $outputTable == "") {
    $output .= "<br>No results because not yet entered/played";
  } else {
    $output .= $outputTable;
  }
  $hiddenReportId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, array(REPORT_ID_FIELD_NAME . "2"), null, false, REPORT_ID_FIELD_NAME, null, REPORT_ID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $reportId, null);
  $output .= $hiddenReportId->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("reports.tpl");
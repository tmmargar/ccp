<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\HtmlUtility;
use ccp\classes\utility\SessionUtility;
use PDO;
require_once "init.php";
if (!defined("REPORT_ID_PARAM_NAME")) {
  define("REPORT_ID_PARAM_NAME", "reportId");
}
if (!defined("USER_ID_PARAM_NAME")) {
  define("USER_ID_PARAM_NAME", "userId");
}
if (!defined("NAVIGATION_PARAM_NAME")) {
  define("NAVIGATION_PARAM_NAME", "navigation");
}
if (!defined("PRIZE_POOL_FOR_SEASON")) {
  define("PRIZE_POOL_FOR_SEASON", "prizePoolForSeason");
}
if (!defined("POINTS_TOTAL_FOR_SEASON")) {
  define("POINTS_TOTAL_FOR_SEASON", "pointsTotalForSeason");
}
if (!defined("POINTS_TOTAL_FOR_SEASON_FOR_USER")) {
  define("POINTS_TOTAL_FOR_SEASON_FOR_USER", "pointsTotalForSeasonForUser");
}
if (!defined("POINTS_TOTAL_FOR_USER")) {
  define("POINTS_TOTAL_FOR_USER", "pointsTotalForUser");
}
if (!defined("POINTS_AVERAGE_FOR_SEASON")) {
  define("POINTS_AVERAGE_FOR_SEASON", "pointsAverageForSeason");
}
if (!defined("POINTS_AVERAGE_FOR_SEASON_FOR_USER")) {
  define("POINTS_AVERAGE_FOR_SEASON_FOR_USER", "pointsAverageForSeasonForUser");
}
if (!defined("POINTS_AVERAGE_FOR_USER")) {
  define("POINTS_AVERAGE_FOR_USER", "pointsAverageForUser");
}
if (!defined("KNOCKOUTS_TOTAL_FOR_SEASON")) {
  define("KNOCKOUTS_TOTAL_FOR_SEASON", "knockoutsTotalForSeason");
}
if (!defined("KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER")) {
  define("KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER", "knockoutsTotalForSeasonForUser");
}
if (!defined("KNOCKOUTS_TOTAL_FOR_USER")) {
  define("KNOCKOUTS_TOTAL_FOR_USER", "knockoutsTotalForUser");
}
if (!defined("KNOCKOUTS_AVERAGE_FOR_SEASON")) {
  define("KNOCKOUTS_AVERAGE_FOR_SEASON", "knockoutsAverageForSeason");
}
if (!defined("KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER")) {
  define("KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER", "knockoutsAverageForSeasonForUser");
}
if (!defined("KNOCKOUTS_AVERAGE_FOR_USER")) {
  define("KNOCKOUTS_AVERAGE_FOR_USER", "knockoutsAverageForUser");
}
if (!defined("EARNINGS_TOTAL_FOR_SEASON")) {
  define("EARNINGS_TOTAL_FOR_SEASON", "earningsTotalForSeason");
}
if (!defined("EARNINGS_TOTAL_FOR_SEASON_FOR_USER")) {
  define("EARNINGS_TOTAL_FOR_SEASON_FOR_USER", "earningsTotalForSeasonForUser");
}
if (!defined("EARNINGS_TOTAL_FOR_USER")) {
  define("EARNINGS_TOTAL_FOR_USER", "earningsTotalForUser");
}
if (!defined("EARNINGS_AVERAGE_FOR_SEASON")) {
  define("EARNINGS_AVERAGE_FOR_SEASON", "earningsAverageForSeason");
}
if (!defined("EARNINGS_AVERAGE_FOR_SEASON_FOR_USER")) {
  define("EARNINGS_AVERAGE_FOR_SEASON_FOR_USER", "earningsAverageForSeasonForUser");
}
if (!defined("EARNINGS_AVERAGE_FOR_USER")) {
  define("EARNINGS_AVERAGE_FOR_USER", "earningsAverageForUser");
}
if (!defined("WINNERS_FOR_SEASON")) {
  define("WINNERS_FOR_SEASON", "winnersForSeason");
}
if (!defined("WINS_FOR_USER")) {
  define("WINS_FOR_USER", "winsForUser");
}
if (!defined("WINS_TOTAL_FOR_SEASON_FOR_USER")) {
  define("WINS_TOTAL_FOR_SEASON_FOR_USER", "winsTotalForSeasonForUser");
}
if (!defined("WINS_AVERAGE_FOR_SEASON_FOR_USER")) {
  define("WINS_AVERAGE_FOR_SEASON_FOR_USER", "winsAverageForSeasonForUser");
}
if (!defined("BOUNTIES_FOR_SEASON")) {
  define("BOUNTIES_FOR_SEASON", "bountiesForSeason");
}
if (!defined("NEMESIS_FOR_USER")) {
  define("NEMESIS_FOR_USER", "nemesisForUser");
}
if (!defined("BULLY_FOR_USER")) {
  define("BULLY_FOR_USER", "bullyForUser");
}
if (!defined("TOURNAMENTS_WON_FOR_USER")) {
  define("TOURNAMENTS_WON_FOR_USER", "tournamentsWonForUser");
}
if (!defined("FINISHES_FOR_USER")) {
  define("FINISHES_FOR_USER", "finishesForUser");
}
if (!defined("TOURNAMENTS_PLAYED_FOR_USER")) {
  define("TOURNAMENTS_PLAYED_FOR_USER", "tournamentsPlayedForUser");
}
if (!defined("TOURNAMENTS_PLAYED_BY_TYPE_FOR_USER")) {
  define("TOURNAMENTS_PLAYED_BY_TYPE_FOR_USER", "tournamentsPlayedByTypeForUser");
}
if (!defined("TOURNAMENTS_PLAYED_FIRST_FOR_USER")) {
  define("TOURNAMENTS_PLAYED_FIRST_FOR_USER", "tournamentsPlayedFirstForUser");
}
$smarty->assign("title", "Chip Chair and a Prayer Top 5");
$smarty->assign("heading", "");
if (!isset($reportId)) {
  $reportId = (isset($_POST[REPORT_ID_PARAM_NAME]) ? $_POST[REPORT_ID_PARAM_NAME] : isset($_GET[REPORT_ID_PARAM_NAME])) ? $_GET[REPORT_ID_PARAM_NAME] : "";
}
if (!isset($parentObjectId)) {
  $output = "<div class=\"contentTop5";
  // $footerClass = PRIZE_POOL_FOR_SEASON == $reportId || POINTS_TOTAL_FOR_SEASON == $reportId || POINTS_AVERAGE_FOR_SEASON == $reportId || KNOCKOUTS_TOTAL_FOR_SEASON == $reportId || KNOCKOUTS_AVERAGE_FOR_SEASON == $reportId || EARNINGS_TOTAL_FOR_SEASON == $reportId || EARNINGS_AVERAGE_FOR_SEASON == $reportId || WINNERS_FOR_SEASON == $reportId ? "Mini" : "Medium";
  $footerClass = TOURNAMENTS_WON_FOR_USER == $reportId || TOURNAMENTS_PLAYED_BY_TYPE_FOR_USER == $reportId ? "Small" : "Mini";
  // (REPORT_ID_TOTAL_POINTS == $reportId || REPORT_ID_EARNINGS == $reportId || REPORT_ID_EARNINGS_CHAMPIONSHIP == $reportId || REPORT_ID_KNOCKOUTS == $reportId || REPORT_ID_WINNERS == $reportId ? "Small" : (REPORT_ID_SUMMARY == $reportId ? "Large" : "Medium"));
  $output .= $footerClass . "\">\n";
} else {
  $output = "";
  $footerClass = "";
}
$userId = (isset($_POST[USER_ID_PARAM_NAME]) ? $_POST[USER_ID_PARAM_NAME] : isset($_GET[USER_ID_PARAM_NAME])) ? $_GET[USER_ID_PARAM_NAME] : SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID);
if (!isset($navigation)) {
  $navigation = (isset($_POST[NAVIGATION_PARAM_NAME]) ? $_POST[NAVIGATION_PARAM_NAME] : isset($_GET[NAVIGATION_PARAM_NAME])) ? $_GET[NAVIGATION_PARAM_NAME] : null;
}
if (isset($navigation)) {
  $smarty->assign("style", "");
  $smarty->assign("formName", "frmTop5");
  $smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
}
if (!isset($parentObjectId)) {
  $parentObjectId = "container";
}
$classNames = array();
switch ($reportId) {
  case PRIZE_POOL_FOR_SEASON:
    $title = "Prize pool for season";
    break;
  case POINTS_TOTAL_FOR_SEASON:
    $title = "Total points for season";
    break;
  case POINTS_TOTAL_FOR_SEASON_FOR_USER:
    $title = "Total points for season for user";
    break;
  case POINTS_TOTAL_FOR_USER:
    $title = "Total points for user";
    break;
  case POINTS_AVERAGE_FOR_SEASON:
    $title = "Average points for season";
    break;
  case POINTS_AVERAGE_FOR_SEASON_FOR_USER:
    $title = "Average points for season for user";
    break;
  case POINTS_AVERAGE_FOR_USER:
    $title = "Average points for user";
    break;
  case EARNINGS_TOTAL_FOR_SEASON:
    $title = "Total earnings for season";
    break;
  case EARNINGS_TOTAL_FOR_SEASON_FOR_USER:
    $title = "Total earnings for season for user";
    break;
  case EARNINGS_TOTAL_FOR_USER:
    $title = "Total earnings for user";
    break;
  case EARNINGS_AVERAGE_FOR_SEASON:
    $title = "Average earnings for season";
    break;
  case EARNINGS_AVERAGE_FOR_SEASON_FOR_USER:
    $title = "Average earnings for season for user";
    break;
  case EARNINGS_AVERAGE_FOR_USER:
    $title = "Average earnings for user";
    break;
  case KNOCKOUTS_AVERAGE_FOR_SEASON:
    $title = "Average knockouts for season";
    break;
  case KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER:
    $title = "Average knockouts for season for user";
    break;
  case KNOCKOUTS_AVERAGE_FOR_USER:
    $title = "Average knockouts for user";
    break;
  case KNOCKOUTS_TOTAL_FOR_SEASON:
    $title = "Total knockouts for season";
    break;
  case KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER:
    $title = "Total knockouts for season for user";
    break;
  case KNOCKOUTS_TOTAL_FOR_USER:
    $title = "Total knockouts for user";
    break;
  case WINNERS_FOR_SEASON:
    $title = "Winners for season";
    break;
  case WINS_FOR_USER:
    $title = "Wins for User";
    break;
  case WINS_TOTAL_FOR_SEASON_FOR_USER:
    $title = "Total Wins for season for user";
    break;
  case WINS_AVERAGE_FOR_SEASON_FOR_USER:
    $title = "Average Wins for season for user";
    break;
  case BOUNTIES_FOR_SEASON:
    $title = "Bounties for season";
    break;
  case NEMESIS_FOR_USER:
    $title = "Nemesis for user";
    break;
  case BULLY_FOR_USER:
    $title = "Bully for user";
    break;
  case TOURNAMENTS_WON_FOR_USER:
    $title = "Tournaments won";
    break;
  case FINISHES_FOR_USER:
    $title = "Finishes";
    break;
  case TOURNAMENTS_PLAYED_FOR_USER:
    $title = "Tournaments played";
    break;
  case TOURNAMENTS_PLAYED_BY_TYPE_FOR_USER:
    $title = "Tournaments played by type";
    break;
  case TOURNAMENTS_PLAYED_FIRST_FOR_USER:
    $title = "Tournaments played first";
    break;
  default:
    $output .= "No value provided for report id";
}
if (!isset($reportId) || "" == $reportId) {
  $output .= "Unable to identify report to view";
} else {
  $startDate = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat();
  $endDate = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat();
  $width = "100%";
  $colFormats = null;
  $hideColIndexes = null;
  switch ($reportId) {
    case PRIZE_POOL_FOR_SEASON:
      $params = array($startDate, $endDate);
      $resultList = $databaseResult->getPrizePoolForSeason(params: $params, returnQuery: false);
      $titleText = "Prize Pool";
      break;
    case POINTS_TOTAL_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(1);
      $query = $databaseResult->getPointsTotalForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(2, "number", 0));
      $hideColIndexes = array(0, 3, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 Points";
      break;
    case POINTS_AVERAGE_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(2);
      $query = $databaseResult->getPointsAverageForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(3, "number", 2));
      $hideColIndexes = array(0, 2, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 Avg Points";
      break;
    case EARNINGS_TOTAL_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(1);
      $query = $databaseResult->getEarningsTotalForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(2, "currency", 0), array(3, "currency", 0));
      $hideColIndexes = array(0, 3, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 Money";
      break;
    case EARNINGS_AVERAGE_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(2);
      $query = $databaseResult->getEarningsAverageForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(2, "currency", 0), array(3, "currency", 0));
      $hideColIndexes = array(0, 2, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 Avg Money";
      break;
    case KNOCKOUTS_TOTAL_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(1);
      $query = $databaseResult->getKnockoutsTotalForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(2, "number", 0), array(3, "number", 2), array(4, "number", 0));
      $hideColIndexes = array(0, 3, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 KO";
      break;
    case KNOCKOUTS_AVERAGE_FOR_SEASON:
      $params = array($startDate, $endDate);
      $orderBy = array(2);
      $query = $databaseResult->getKnockoutsAverageForSeason(params: $params, orderBy: $orderBy, limitCount: 5);
      $colFormats = array(array(2, "number", 0), array(3, "number", 2), array(4, "number", 0));
      $hideColIndexes = array(0, 2, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Top 5 Avg KO";
      break;
    case BOUNTIES_FOR_SEASON:
      $params = array($startDate, $endDate);
      $resultList = $databaseResult->getBountiesForSeason(params: $params);
      $titleText = "Bounties";
      break;
    case WINNERS_FOR_SEASON:
      $params = array($startDate, $endDate);
      $query = $databaseResult->getWinnersForSeason(params: $params, returnQuery: true, limitCount: null);
      $colFormats = array(array(2, "number", 0));
      $hideColIndexes = array(0, 3, 4, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Season Winners";
      break;
    case POINTS_TOTAL_FOR_SEASON_FOR_USER:
    case POINTS_AVERAGE_FOR_SEASON_FOR_USER:
      $params = array($startDate, $endDate, $userId);
      if (POINTS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getPointsTotalAndAverageForSeasonForUser(params: $params, orderBy: $orderBy, rank: true);
      // $width = isset($navigation) ? "20%" : "100%";
      $value = array(array("number", "center"), array(4, "number", $formatPlaces), "Points", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER:
    case KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER:
      $params = array($startDate, $endDate, $userId);
      if (KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getKnockoutsTotalAndAverageForSeasonForUser(params: $params, orderBy: $orderBy, rank: true);
      $value = array(array("number", "center"), array(3, "number", $formatPlaces), "Knockouts", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case EARNINGS_TOTAL_FOR_SEASON_FOR_USER:
    case EARNINGS_AVERAGE_FOR_SEASON_FOR_USER:
      $params = array($startDate, $endDate, $userId);
      if (EARNINGS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getEarningsTotalAndAverageForSeasonForUser(params: $params, orderBy: $orderBy, rank: true);
      $hideColIndexes = array(0, 1, 2, 3, 5);
      // $width = isset($navigation) ? "20%" : "100%";
      $value = array(array("currency", "center"), array(4, "currency", $formatPlaces), "Earnings", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      $hideColIndexes = array(0, 2);
      break;
    case WINS_TOTAL_FOR_SEASON_FOR_USER:
    case WINS_AVERAGE_FOR_SEASON_FOR_USER:
      $params = array($startDate, $endDate, $userId);
      if (WINS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getWinsTotalAndAverageForSeasonForUser(params: $params, orderBy: $orderBy, rank: true);
      $hideColIndexes = array(0, 1, 2, 3, 5);
      $value = array(array("number", "center"), array(4, "number", $formatPlaces), "Wins", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case POINTS_AVERAGE_FOR_USER:
    case POINTS_TOTAL_FOR_USER:
      $params = array($userId);
      if (POINTS_TOTAL_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getPointsTotalAndAverageForUser(params: $params, orderBy: $orderBy, rank: true);
      $value = array(array("number", "center"), array(3, "number", $formatPlaces), "Points", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case KNOCKOUTS_AVERAGE_FOR_USER:
    case KNOCKOUTS_TOTAL_FOR_USER:
      $params = array($userId);
      if (KNOCKOUTS_TOTAL_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getKnockoutsTotalAndAverageForUser(params: $params, orderBy: $orderBy, rank: true);
      $value = array(array("number", "center"), array(3, "number", $formatPlaces), "Knockouts", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case EARNINGS_AVERAGE_FOR_USER:
    case EARNINGS_TOTAL_FOR_USER:
      $params = array($userId);
      if (EARNINGS_TOTAL_FOR_USER == $reportId) {
        $orderBy = array(1);
        $valueIndex = 3;
        $formatPlaces = 0;
      } else {
        $orderBy = array(2);
        $valueIndex = 4;
        $formatPlaces = 2;
      }
      $query = $databaseResult->getEarningsTotalAndAverageForUser(params: $params, orderBy: $orderBy, rank: true);
      $value = array(array("currency", "center"), array(3, "currency", $formatPlaces), "Earnings", $valueIndex);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case WINS_FOR_USER:
      $params = array($startDate, $endDate, $userId);
      $orderBy = array(1);
      $query = $databaseResult->getWinsForUser(params: $params, orderBy: $orderBy, rank: true);
      $value = array(array("number", "center"), array(3, "number", 0), "Wins", 3);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case NEMESIS_FOR_USER:
      $params = array($userId);
      $query = $databaseResult->getNemesisForUser(params: $params);
      $colFormats = array(array(1, "number", 0));
      $hideColIndexes = array(1);
      // $width = isset($navigation) ? "20%" : "100%";
      break;
    case BULLY_FOR_USER:
      $params = array($userId);
      $query = $databaseResult->getBullyForUser(params: $params);
      $colFormats = array(array(1, "number", 0));
      $hideColIndexes = array(1);
      // $width = isset($navigation) ? "20%" : "100%";
      break;
    case FINISHES_FOR_USER:
      $params = array($userId);
      $query = $databaseResult->getFinishesForUser(params: $params);
      // $colFormats = array(array(0, "number", 0), array(1, "number", 0), array(2, "percentage", 2));
      $colFormats = array(array(2, "percentage", 2));
      // $width = isset($navigation) ? "20%" : "100%";
      $titleText = "Place of Finish";
      break;
    case TOURNAMENTS_PLAYED_FOR_USER:
      $params = array($userId);
      $query = $databaseResult->getTournamentsPlayed(params: $params);
      $value = array(array("number", "center"), array(4, "number", 0), "Tourneys", 3);
      $rank = array(array("center"), null, "Rank", 0);
      break;
    case TOURNAMENTS_PLAYED_BY_TYPE_FOR_USER:
      $params = array($userId);
      $query = $databaseResult->getTournamentsPlayedByTypeByPlayerId(params: $params);
      $colFormats = array(array(4, "number", 0));
      $hideColIndexes = array(0, 2);
      // $width = Constant::FLAG_LOCAL() ? "30%" : "100%";
      $titleText = "Played by type by user";
      break;
  }
  if (PRIZE_POOL_FOR_SEASON != $reportId && BOUNTIES_FOR_SEASON != $reportId) {
    array_push($classNames, "top5");
    $headerRow = true;
  }
//   if (isset($navigation)) {
//     $output .= "<div id=\"container\">\n";
//   }
  if (BOUNTIES_FOR_SEASON == $reportId) {
    $ctr = 1;
    foreach ($resultList as $resultBounty) {
      $bounty = $resultBounty->getBounty();
      $aryData[$ctr] = array($bounty->getName() . " (" . $bounty->getDescription() . ")", $resultBounty->getUser()->getName());
      $ctr ++;
    }
    if (! isset($aryData)) {
      $aryData[1] = array("Bounty A (points)", "None");
      $aryData[2] = array("Bounty A (points)", "None");
      $aryData[3] = array("Bounty B (tourney)", "None");
    }
    // if bounty a and bounty b match then move bounty a to next
    if ($aryData[1][1] == $aryData[3][1]) {
      // array, index, length
      array_splice($aryData, 0, 1);
    } else {
      // array, index, length
      array_splice($aryData, 1, 1);
    }
    $output .= "<div class=\"center title\" id=\"title" . ucfirst($reportId) . "\">" . $titleText . "</div>\n";
    foreach ($aryData as $data) {
      $output .= "<div style=\"float:left; text-align: left; width: 40%;\">" . $data[0] . "</div>\n<div style=\"float:left; text-align: left; width: 60%;\">" . $data[1] . "</div>\n";
    }
  } else if (PRIZE_POOL_FOR_SEASON == $reportId) {
    $output .= "<div class=\"center title\" id=\"title" . ucfirst($reportId) . "\">" . $titleText . "</div>\n";
    $output .= "<div class=\"center number positive\">" . Constant::$SYMBOL_CURRENCY_DEFAULT . number_format((float) $resultList[0], 0) . "</div>\n";
  } else {
    $mode = "";
    $caption = "";
    $hiddenId = null;
    $selectedColumnVals = null;
    $delimiter = Constant::$DELIMITER_DEFAULT;
    $foreignKeys = null;
    $html = NULL;
    $showNote = false;
    $hiddenAdditional = null;
    $colSpan = null;
    $tableIdSuffix = null;
    switch ($reportId) {
      case POINTS_TOTAL_FOR_SEASON_FOR_USER:
      case POINTS_AVERAGE_FOR_SEASON_FOR_USER:
      case EARNINGS_TOTAL_FOR_SEASON_FOR_USER:
      case EARNINGS_AVERAGE_FOR_SEASON_FOR_USER:
      case KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER:
      case KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER:
      case WINS_TOTAL_FOR_SEASON_FOR_USER:
      case WINS_AVERAGE_FOR_SEASON_FOR_USER:
      case POINTS_TOTAL_FOR_USER:
      case POINTS_AVERAGE_FOR_USER:
      case EARNINGS_TOTAL_FOR_USER:
      case EARNINGS_AVERAGE_FOR_USER:
      case KNOCKOUTS_TOTAL_FOR_USER:
      case KNOCKOUTS_AVERAGE_FOR_USER:
      case WINS_FOR_USER:
      case TOURNAMENTS_PLAYED_FOR_USER:
        if (POINTS_TOTAL_FOR_SEASON_FOR_USER == $reportId || POINTS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0), array(5, "number", 2));
          $hideColIndexes = array(0, 2, 5);
          if (POINTS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Points";
          } else if (POINTS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Avg Points";
          }
          $dialogParameters = array($titleText, 500, 460, $parentObjectId);
        } else if (KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER == $reportId || KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0), array(5, "number", 2));
          $hideColIndexes = array(0, 2, 5);
          if (KNOCKOUTS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Knockouts";
          } else if (KNOCKOUTS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Avg Knockouts";
          }
          $dialogParameters = array($titleText, 500, 400, $parentObjectId);
        } else if (EARNINGS_TOTAL_FOR_SEASON_FOR_USER == $reportId || EARNINGS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "currency", 0), array(5, "currency", 2));
          $hideColIndexes = array(0, 2, 5);
          if (EARNINGS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Earnings";
          } else if (EARNINGS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Avg Earnings";
          }
          $dialogParameters = array($titleText, 500, 460, $parentObjectId);
        } else if (WINS_TOTAL_FOR_SEASON_FOR_USER == $reportId || WINS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0), array(5, "percentage", 2));
          $hideColIndexes = array(0, 2, 5);
          if (WINS_TOTAL_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Wins";
          } else if (WINS_AVERAGE_FOR_SEASON_FOR_USER == $reportId) {
            $titleText = "Season Avg Wins";
          }
          $dialogParameters = array($titleText, 500, 400, $parentObjectId);
        } else if (POINTS_TOTAL_FOR_USER == $reportId || POINTS_AVERAGE_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0), array(5, "number", 2));
          if (POINTS_TOTAL_FOR_USER == $reportId) {
            $titleText = "Lifetime Points";
            $hideColIndexes = array(0, 2, 5);
          } else if (POINTS_AVERAGE_FOR_USER == $reportId) {
            $titleText = "Lifetime Avg Points";
            $hideColIndexes = array(0, 2, 4);
          }
          $dialogParameters = array($titleText, 500, 400, $parentObjectId);
        } else if (EARNINGS_TOTAL_FOR_USER == $reportId || EARNINGS_AVERAGE_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "currency", 0), array(5, "currency", 2));
          if (EARNINGS_TOTAL_FOR_USER == $reportId) {
            $titleText = "Lifetime Earnings";
            $hideColIndexes = array(0, 2, 5);
          } else if (EARNINGS_AVERAGE_FOR_USER == $reportId) {
            $titleText = "Lifetime Avg Earnings";
            $hideColIndexes = array(0, 2, 4);
          }
          $dialogParameters = array($titleText, 500, 400, $parentObjectId);
        } else if (KNOCKOUTS_TOTAL_FOR_USER == $reportId || KNOCKOUTS_AVERAGE_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0), array(5, "number", 2));
          if (KNOCKOUTS_TOTAL_FOR_USER == $reportId) {
            $titleText = "Lifetime KO";
            $hideColIndexes = array(0, 2, 5);
          } else if (KNOCKOUTS_AVERAGE_FOR_USER == $reportId) {
            $titleText = "Lifetime Avg KO";
            $hideColIndexes = array(0, 2, 4);
          }
          $dialogParameters = array($titleText, 500, 400, $parentObjectId);
        } else if (WINS_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(5, "percentage", 2));
          $hideColIndexes = array(0, 2, 5);
          $dialogParameters = array("Lifetime Wins", 500, 400, $parentObjectId);
          $titleText = "Lifetime Wins";
        } else if (TOURNAMENTS_PLAYED_FOR_USER == $reportId) {
          $colFormats = array(array(1, "number", 0), array(4, "number", 0));
          $hideColIndexes = array(0, 2);
          $dialogParameters = array("Lifetime Tourneys", 500, 400, $parentObjectId);
          $titleText = "Lifetime Tourneys";
        }
        $output .= "<div class=\"center title\" id=\"title" . ucfirst($reportId) . "\">" . $titleText . "</div>\n";
        $suffix = str_replace(" ", "", $dialogParameters[0]);
        // if format provided then adjust indexes to add 1 for rownum used for ranking
        if (isset($value[1])) {
          $value[1][0] += 1;
        }
        // adjust index to add 1 for rownum used for ranking
        $value[3] += 1;
        $rank[3] += 1;
        $result = $databaseResult->getConnection()->query($query);
//         $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
        $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: $delimiter, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: null, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: null, note: true, query: $query, selectedRow: null, suffix: "Rank" . $suffix, width: "100%");
        $outputTemp = $htmlTable->getHtml();
        if (0 < $result->rowCount()) {
          // unable to get ranking to use where clause so loop through and find matching user
          while ($row = $result->fetch(PDO::FETCH_BOTH)) {
            // find user and exit
            if ($row[2] == $userId) {
              $rowUser = $row;
            }
          }
          $valueClasses = HtmlUtility::buildClasses(aryClasses: $value[0], value: $rowUser[$value[3]]);
          $rowUser[$value[3]] = HtmlUtility::formatData(format: $value[1], value: $rowUser[$value[3]]);
          $output .= "<div " . (($valueClasses != "") ? "class=\"" . $valueClasses . "\"" : "") . " id=\"value\">" . $rowUser[$value[3]] . "</div>\n";
          $rankClasses = HtmlUtility::buildClasses(aryClasses: $rank[0], value: $rowUser[$rank[3]]);
          $output .= "<div " . (($rankClasses != "") ? "class=\"" . $rankClasses . "\"" : "") . " id=\"rank_" . $userId . "\"><a href=\"javascript:inputLocal.showFullList('rank_" . $userId . "', '" . $dialogParameters[0] . "', " . $dialogParameters[1] . ", " . $dialogParameters[2] . ", '" . $dialogParameters[3] . "');\">" . $rank[2] . ": " . $rowUser[$rank[3]] . "</a></div>\n";
          $output .= 
            "<dialog class=\"dialog\" id=\"dialogRankAll" . str_replace(" ", "", $titleText) . "\">\n" .
            " <form method=\"dialog\">\n" .
            "  <header>\n" .
            "   <h2>" . $titleText . "</h2>\n" .
            "   <button class=\"dialogButton\" id=\"dialogRankAll" . str_replace(" ", "", $titleText) . "-header--cancel-btn\">X</button>\n" .
            "  </header>\n" .
            "  <main>\n" .
            $outputTemp .
            "  </main>\n" .
            " </form>\n" .
            "</dialog>\n";
        }
        $result->closeCursor();
        if (isset($navigation)) {
          $output .= "</div>\n";
        }
        break;
      case TOURNAMENTS_WON_FOR_USER:
        $titleText = "Tournaments Won";
        $output .= "<div class=\"center title\" id=\"title" . ucfirst($reportId) . "\">" . $titleText . "</div>\n";
        $params = array($userId);
        $resultList = $databaseResult->getTournamentsWonByPlayerId(params: $params);
        if (0 < count($resultList)) {
          $output .= "<script type=\"text/javascript\">$(document).ready(function() {\$(\"#title" . ucfirst($reportId) . "\").text($(\"#title" . ucfirst($reportId) . "\").text() + ' (' + " . count($resultList) . " + ')');});</script>\n";
          $ctr = 0;
          foreach ($resultList as $tournament) {
            $ctr ++;
            $tournamentInfo = $tournament->getDate()->getDisplayFormat() . ", " . $tournament->getStartTime()->getDisplayAmPmFormat() . " " . $tournament->getLimitType()->getName() . " " . $tournament->getGameType()->getName() . " " . " " . $tournament->getMaxRebuys() . "r " . (0 < $tournament->getAddonAmount() ? "+a" : "") . " " . $tournament->getChipCount() . " chips " . $tournament->getEnteredCount() . " played";
            $output .= "<div style=\"display: inline-block; vertical-align: top; width: 10%;\">" . $ctr . "</div>\n<div style=\"display: inline-block; text-align: left; width: 80%;\">" . $tournamentInfo . "</div>\n";
          }
        }
        break;
      case TOURNAMENTS_PLAYED_FIRST_FOR_USER:
        $titleText = "Member since";
        $output .= "<div class=\"center title\" id=\"title" . ucfirst($reportId) . "\">" . $titleText . "</div>\n";
        $params = array($userId);
        $resultList = $databaseResult->getTournamentsPlayedFirstByPlayerId(params: $params);
        if (0 < count($resultList)) {
          $output .= "<div class=\"center\">Member since " . $resultList[0]->getDisplayFormat() . "</div>\n";
        }
        break;
      default:
        if (NEMESIS_FOR_USER == $reportId || BULLY_FOR_USER == $reportId) {
          if (NEMESIS_FOR_USER == $reportId) {
            $tableIdSuffix = "Nemesis";
            $titleText = "Your Nemesis";
          } else if (BULLY_FOR_USER == $reportId) {
            $tableIdSuffix = "Bully";
            $titleText = "Your Victims";
          }
          array_push($classNames, $tableIdSuffix);
        } else {
          $tableIdSuffix = ucfirst($reportId);
        }
        $output .= "<div class=\"center title\" id=\"title" . $tableIdSuffix . "\">" . $titleText . "</div>\n";
        $htmlTable = new HtmlTable(caption: $caption, class: $classNames, colspan: $colSpan, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: $delimiter, foreignKeys: $foreignKeys, header: $headerRow, hiddenAdditional: $hiddenAdditional, hiddenId: $hiddenId, hideColumnIndexes: $hideColIndexes, html: $html, id: null, link: null, note: $showNote, query: $query, selectedRow: $selectedColumnVals, suffix: $tableIdSuffix, width: $width);
        $output .= $htmlTable->getHtml();
        $htmlTable2 = new HtmlTable(caption: $caption, class: $classNames, colspan: $colSpan, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: $delimiter, foreignKeys: $foreignKeys, header: $headerRow, hiddenAdditional: $hiddenAdditional, hiddenId: $hiddenId, hideColumnIndexes: $hideColIndexes, html: $html, id: null, link: null, note: $showNote, query: $query, selectedRow: $selectedColumnVals, suffix: "All" . $tableIdSuffix, width: $width);
        $outputTemp = $htmlTable2->getHtml();
        if (NEMESIS_FOR_USER == $reportId || BULLY_FOR_USER == $reportId) {
          if (NEMESIS_FOR_USER == $reportId) {
            $title = "Nemesises";
            $tableIdSuffix = "Nemesis";
            $titleText = "Nemesis";
          } else if (BULLY_FOR_USER == $reportId) {
            $title = "Bullies";
            $tableIdSuffix = "Bullies";
            $titleText = "Bullies";
          }
          $output .= "<div class=\"center\" id=\"showList\"><a id=\"showFullList" . $tableIdSuffix . "\" href=\"javascript:inputLocal.showFullList" . $tableIdSuffix . "('showFullList" . $tableIdSuffix . "', '" . $title . "', '" . $parentObjectId . "');\">See full list</a></div>";
          // this div is used for modal dialog
//           $output .= "<div id=\"dialog" . $tableIdSuffix . "\" style=\"display: none;\"></div>";
          $output .=
          "<dialog class=\"dialog\" id=\"dialogRankAll" . str_replace(" ", "", $titleText) . "\">\n" .
          " <form method=\"dialog\">\n" .
          "  <header>\n" .
          "   <h2>" . $titleText . "</h2>\n" .
          "   <button class=\"dialogButton\" id=\"dialogRankAll" . str_replace(" ", "", $titleText) . "-header--cancel-btn\">X</button>\n" .
          "  </header>\n" .
          "  <main>\n" .
          $outputTemp .
          "  </main>\n" .
          " </form>\n" .
          "</dialog>\n";
        }
        break;
    }
  }
  $hiddenReportId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: array(REPORT_ID_PARAM_NAME), cols: null, disabled: false, id: REPORT_ID_PARAM_NAME, maxLength: null, name: REPORT_ID_PARAM_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $reportId, wrap: null);
  $output .= $hiddenReportId->getHtml();
  if (!isset($parentObjectId)) {
    $output .= "</div>\n";
  }
}
if (isset($navigation)) {
  $smarty->assign("content", $output);
  $smarty->assign("footerClass", "footer" . $footerClass);
  $smarty->display("top5.tpl");
} else {
  return $output;
}
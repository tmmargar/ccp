<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\HtmlLink;
use ccp\classes\model\HtmlMenu;
use ccp\classes\utility\SessionUtility;
// $accessKey, $class, $debug, $href, $id, $paramName, $paramValue, $tabIndex, $text, $title)
$htmlLinkHome = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "home.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Home", title: null);
$htmlLinkEvents = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "registrationList.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Events", title: null);
$htmlLinkChampionship = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "championship.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Championship Seating", title: null);
// $debug, $id, $items, $text
$htmlMenuResults = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Results");
$params = array("desc");
$queryResultYears = $databaseResult->getTournamentYearsPlayed(params: $params);
$counterOverall = count($queryResultYears);
$counterLoop = 1;
$counterResultSeasonGroup = 0;
$counterResultSeason = 0;
foreach ($queryResultYears as $rowYears) {
  $htmlLinkResultArray = array();
  $htmlLinkResultArrayCounter = 0;
  if ($counterLoop == 1) {
//     $htmlLinkResultArray = array();
//     $htmlLinkResultArrayCounter = 0;
    $htmlMenuResultSeasonGroup = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Seasons " . $counterOverall . " to " . ($counterOverall - 4 == 0 ? 1 : $counterOverall - 4));
    $htmlMenuResultSeasonGroupArray[$counterResultSeasonGroup] = $htmlMenuResultSeasonGroup;
    $counterResultSeasonGroup++;
    $htmlMenuResultSeasonArray = array();
  }
  $htmlMenuResultSeason = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: $rowYears . " (Season " . ($rowYears - DateTime::$YEAR_FIRST_SEASON) . ")");
  $htmlMenuResultSeasonArray[$counterResultSeason] = $htmlMenuResultSeason;
  $counterResultSeason++;
  $htmlMenuResultSeasonGroup->setItems($htmlMenuResultSeasonArray);
  $params = array($rowYears);
  $queryResultAll = $databaseResult->getTournamentAll(params: $params);
  if (0 < count($queryResultAll)) {
    foreach ($queryResultAll as $rowAll) {
      $description = null !== $rowAll->getDescription() ? count(explode(" - ", $rowAll->getDescription())) > 1 ? explode(" - ", $rowAll->getDescription())[1] : explode(" - ", $rowAll->getDescription())[0] : "";
      $htmlLinkResult = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "tournamentId"), paramValue: array("results", $rowAll->getId()), tabIndex: -1, text: $description . " (" . $rowAll->getDate()->getDisplayFormat() . ")", title: null);
      $htmlLinkResultArray[$htmlLinkResultArrayCounter] = $htmlLinkResult;
      $htmlLinkResultArrayCounter++;
    }
  }
  $htmlMenuResultSeason->setItems($htmlLinkResultArray);
  if ($counterLoop == 5 || $counterOverall == 1) {
    $counterLoop = 1;
    $counterResultSeason = 0;
  } else {
    $counterLoop++;
  }
  $counterOverall--;
}
$htmlMenuResults->setItems($htmlMenuResultSeasonGroupArray);
$htmlMenuStats = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Stats");
$htmlLinkMyStats = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "personalize.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "My Stats", title: null);
$params = array(false);
$resultListUsers = $databaseResult->getUsersAll(params: $params);
$counterOverall = 1;
$counterLoop = 1;
$counterUserGroup = 0;
foreach ($resultListUsers as $user) {
  if ($counterLoop == 1) {
    $htmlLinkUserArray = array();
    $htmlLinkUserArrayCounter = 0;
    $htmlMenuUserGroup = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Users " . $counterOverall . " to " . ($counterOverall + 9));
    $htmlMenuUserGroupArray[$counterUserGroup] = $htmlMenuUserGroup;
    $counterUserGroup++;
  }
  $htmlLinkUser = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "personalize.php", id: null, paramName: array("userId"), paramValue: array($user->getId()), tabIndex: -1, text: $user->getName() . "'s stats", title: null);
  $htmlLinkUserArray[$htmlLinkUserArrayCounter] = $htmlLinkUser;
  $htmlLinkUserArrayCounter++;
  if ($counterLoop == 10 || $counterOverall == count($resultListUsers)) {
    $htmlMenuUserGroup->setItems($htmlLinkUserArray);
    $counterLoop = 1;
  } else {
    $counterLoop++;
  }
  $counterOverall++;
}
// echo "<br>" . print_r($htmlLinkUsers, true);
// echo "<br>" . print_r($htmlLinkUserArray, true);
$htmlMenuOtherStats = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Other Users");
$htmlMenuOtherStats->setItems($htmlMenuUserGroupArray);
$htmlStatsArray = array($htmlLinkMyStats, $htmlMenuOtherStats);
$htmlMenuStats->setItems($htmlStatsArray);
$htmlMenuReports = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Reports");
$htmlMenuReportStandard = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Standard");
$queryResult = $databaseResult->getResultIdMax(null);
$htmlLinkResults = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "tournamentId"), paramValue: array("results", $queryResult[0]), tabIndex: -1, text: "Results", title: null);
$htmlLinkTotalPoints = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("pointsTotal", "show"), tabIndex: -1, text: "Total pts", title: null);
$htmlLinkEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("earnings", "show"), tabIndex: -1, text: "Earnings", title: null);
$htmlLinkEarningsChampionship = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("earningsChampionship", "show"), tabIndex: -1, text: "Earnings (Championship)", title: null);
$htmlLinkKnockouts = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("knockouts", "show"), tabIndex: -1, text: "KOs", title: null);
$htmlLinkSummary = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("summary", "show"), tabIndex: -1, text: "Summary", title: null);
$htmlLinkWinners = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("winners", "show"), tabIndex: -1, text: "Winners", title: null);
$htmlLinkFinishes = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "seasonSelection"), paramValue: array("finishes", "show"), tabIndex: -1, text: "Finishes", title: null);
$htmlLinkFees = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId"), paramValue: array("fees", "show"), tabIndex: -1, text: "Fees", title: null);
$htmlLinkStandardArray = array($htmlLinkResults, $htmlLinkTotalPoints, $htmlLinkEarnings, $htmlLinkEarningsChampionship, $htmlLinkKnockouts, $htmlLinkSummary, $htmlLinkWinners, $htmlLinkFinishes, $htmlLinkFees);
$htmlMenuReportStandard->setItems($htmlLinkStandardArray);
$htmlMenuReportSeason = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Season");
$htmlLinkPrizePool = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("prizePoolForSeason", "Y"), tabIndex: -1, text: "Prize pool", title: null);
$htmlLinkTotalPoints = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("pointsTotalForSeason", "Y"), tabIndex: -1, text: "Total points", title: null);
$htmlLinkAveragePoints = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("pointsAverageForSeason", "Y"), tabIndex: -1, text: "Average points", title: null);
$htmlLinkTotalEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("earningsTotalForSeason", "Y"), tabIndex: -1, text: "Total Earnings", title: null);
$htmlLinkAverageEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("earningsAverageForSeason", "Y"), tabIndex: -1, text: "Average Earnings", title: null);
$htmlLinkTotalKnockouts = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("knockoutsTotalForSeason", "Y"), tabIndex: -1, text: "Total knockouts", title: null);
$htmlLinkAverageKnockouts = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("knockoutsAverageForSeason", "Y"), tabIndex: -1, text: "Average knockouts", title: null);
$htmlLinkWinners = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("winnersForSeason", "Y"), tabIndex: -1, text: "Winners", title: null);
$htmlLinkSeasonArray = array($htmlLinkPrizePool, $htmlLinkTotalPoints, $htmlLinkAveragePoints, $htmlLinkTotalEarnings, $htmlLinkAverageEarnings, $htmlLinkTotalKnockouts, $htmlLinkAverageKnockouts, $htmlLinkWinners);
$htmlMenuReportSeason->setItems($htmlLinkSeasonArray);
$htmlMenuReportChampionship = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Championship");
$htmlLinkByYearByEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "sort"), paramValue: array("championship", "0 down,2 down"), tabIndex: -1, text: "By year by earnings", title: null);
$htmlLinkByNameByYear = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "sort"), paramValue: array("championship", "1 up,0 down"), tabIndex: -1, text: "By name by year", title: null);
$htmlLinkByNameByEarningsByYear = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "sort"), paramValue: array("championship", "1 up,2 down"), tabIndex: -1, text: "By name by earnings by year", title: null);
$htmlLinkByNameByEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "reports.php", id: null, paramName: array("reportId", "sort", "group"), paramValue: array("championship", "2 down,1 up", "true"), tabIndex: -1, text: "By name by earnings", title: null);
$htmlLinkChampionshipArray = array($htmlLinkByYearByEarnings, $htmlLinkByNameByYear, $htmlLinkByNameByEarningsByYear, $htmlLinkByNameByEarnings);
$htmlMenuReportChampionship->setItems($htmlLinkChampionshipArray);
$htmlMenuReportRanking = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Ranking");
$htmlLinkTotalPoints = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("pointsTotalForUser", "Y"), tabIndex: -1, text: "Total pts", title: null);
$htmlLinkAveragePoints = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("pointsAverageForUser", "Y"), tabIndex: -1, text: "Average points", title: null);
$htmlLinkTotalKnockouts = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("knockoutsTotalForUser", "Y"), tabIndex: -1, text: "Total KOs", title: null);
$htmlLinkAverageKnockouts = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("knockoutsAverageForUser", "Y"), tabIndex: -1, text: "Average KOs", title: null);
$htmlLinkTotalEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("earningsTotalForUser", "Y"), tabIndex: -1, text: "Total earnings", title: null);
$htmlLinkAverageEarnings = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("earningsAverageForUser", "Y"), tabIndex: -1, text: "Avg earnings", title: null);
$htmlLinkWins = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("winsForUser", "Y"), tabIndex: -1, text: "Wins", title: null);
$htmlLinkNemesis = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("nemesisForUser", "Y"), tabIndex: -1, text: "Nemesis", title: null);
$htmlLinkBully = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("bullyForUser", "Y"), tabIndex: -1, text: "Bully", title: null);
$htmlLinkWon = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("tournamentsWonForUser", "Y"), tabIndex: -1, text: "Won", title: null);
$htmlLinkFinishes = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("finishesForUser", "Y"), tabIndex: -1, text: "Finishes", title: null);
$htmlLinkPlayedCount = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("tournamentsPlayedForUser", "Y"), tabIndex: -1, text: "Played count", title: null);
$htmlLinkPlayedByType = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("tournamentsPlayedByTypeForUser", "Y"), tabIndex: -1, text: "Played by type", title: null);
$htmlLinkMemberSince = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "top5.php", id: null, paramName: array("reportId", "navigation"), paramValue: array("tournamentsPlayedFirstForUser", "Y"), tabIndex: -1, text: "Member since", title: null);
$htmlLinkRankingArray = array($htmlLinkTotalPoints, $htmlLinkAveragePoints, $htmlLinkTotalKnockouts, $htmlLinkAverageKnockouts, $htmlLinkTotalEarnings, $htmlLinkAverageEarnings, $htmlLinkWins, $htmlLinkNemesis, $htmlLinkBully, $htmlLinkWon, $htmlLinkFinishes, $htmlLinkPlayedCount, $htmlLinkPlayedByType, $htmlLinkMemberSince);
$htmlMenuReportRanking->setItems($htmlLinkRankingArray);
$htmlReportsArray = array($htmlMenuReportStandard, $htmlMenuReportSeason, $htmlMenuReportChampionship, $htmlMenuReportRanking);
$htmlMenuReports->setItems($htmlReportsArray);
$levels = array($htmlLinkHome, $htmlLinkEvents, $htmlLinkChampionship, $htmlMenuResults, $htmlMenuStats, $htmlMenuReports);
// print_r($htmlMenuResults); die();
if (SessionUtility::getValue(SessionUtility::$OBJECT_NAME_ADMINISTRATOR) != 0) {
  $htmlMenuReportAdministration = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Administration");
  $htmlMenuReportGames = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Games");
  $htmlLinkNotifications = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageNotification.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Notifcations", title: null);
  $htmlLinkSeasons = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageSeason.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Seasons", title: null);
  $htmlLinkTournaments = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageTournament.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Tournaments", title: null);
  $htmlLinkRegistration = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageRegistration.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Registration", title: null);
  $htmlLinkBuyins = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageBuyins.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Buyins", title: null);
  $htmlLinkResults = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageResults.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Results", title: null);
  $htmlLinkSpecialType = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageSpecialType.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Special type", title: null);
  $htmlLinkGamesArray = array($htmlLinkNotifications, $htmlLinkSeasons, $htmlLinkTournaments, $htmlLinkRegistration, $htmlLinkBuyins, $htmlLinkResults, $htmlLinkSpecialType);
  $htmlMenuReportGames->setItems($htmlLinkGamesArray);
  $htmlMenuReportUsers = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Users");
  $htmlLinkLocations = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageLocation.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Locations", title: null);
  $htmlLinkUsers = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageUser.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Users", title: null);
  $htmlLinkNewUserApproval = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageSignupApproval.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "New user approval", title: null);
  $htmlLinkUsersArray = array($htmlLinkLocations, $htmlLinkUsers, $htmlLinkNewUserApproval);
  $htmlMenuReportUsers->setItems($htmlLinkUsersArray);
  $htmlMenuReportPayouts = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Payouts");
  $htmlLinkGroup = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageGroup.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Groups", title: null);
  $htmlLinkGroupPayout = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageGroupPayout.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Payout groups", title: null);
  $htmlLinkPayout = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "managePayout.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Payouts", title: null);
  $htmlLinkPayoutArray = array($htmlLinkGroup, $htmlLinkPayout, $htmlLinkGroupPayout);
  $htmlMenuReportPayouts->setItems($htmlLinkPayoutArray);
  $htmlLinkEmail = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageEmail.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Send email", title: null);
  $htmlMenuReportScheduledJobs = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "Scheduled Jobs");
  $htmlLinkAutoRegisterHost = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "autoRegisterHost.php", id: null, paramName: array(Constant::$FIELD_NAME_MODE), paramValue: array(Constant::$MODE_VIEW), tabIndex: -1, text: "Run auto register host", title: null);
  $htmlLinkAutoReminder = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "autoReminder.php", id: null, paramName: array(Constant::$FIELD_NAME_MODE), paramValue: array(Constant::$MODE_VIEW), tabIndex: -1, text: "Run auto reminder", title: null);
  $htmlLinkScheduledJobsArray = array($htmlLinkAutoRegisterHost, $htmlLinkAutoReminder);
  $htmlMenuReportScheduledJobs->setItems($htmlLinkScheduledJobsArray);
  $htmlLinkAdministrationArray = array($htmlMenuReportGames, $htmlMenuReportUsers, $htmlMenuReportPayouts, $htmlLinkEmail, $htmlMenuReportScheduledJobs);
  $htmlMenuReportAdministration->setItems($htmlLinkAdministrationArray);
  array_push($levels, $htmlMenuReportAdministration);
}
$htmlMenuReportMyProfile = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: null, text: "My profile");
$htmlLinkEdit = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "manageUser.php", id: null, paramName: array("mode", "userId"), paramValue: array("modify", SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID)), tabIndex: -1, text: "Edit my profile", title: null);
$htmlLinkLogout = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "logout.php", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Logout", title: null);
$htmlLinkResetPassword = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "resetPassword.php", id: null, paramName: array("nav"), paramValue: array("Y"), tabIndex: -1, text: "Password reset", title: null);
$htmlLinkMyProfileArray = array($htmlLinkEdit, $htmlLinkLogout, $htmlLinkResetPassword);
$htmlMenuReportMyProfile->setItems($htmlLinkMyProfileArray);
array_push($levels, $htmlMenuReportMyProfile);
$htmlLinkRules = new HtmlLink(accessKey: null, class: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), href: "rules/ccp_rules_2023.pdf", id: null, paramName: null, paramValue: null, tabIndex: -1, text: "Rules", title: null);
array_push($levels, $htmlLinkRules);
  // echo print_r($levels, true);
$htmlMenuRoot = new HtmlMenu(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, items: $levels, text: null);
$smarty->assign("navigation", $htmlMenuRoot->getHtmlRoot());
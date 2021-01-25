<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\HtmlLink;
use ccp\classes\model\HtmlMenu;
use ccp\classes\utility\SessionUtility;
$htmlLinkHome = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "home.php", null, null, null, -1, "Home", null);
$htmlLinkEvents = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "registrationList.php", null, null, null, -1, "Events", null);
$htmlLinkChampionship = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "championship.php", null, null, null, -1, "Championship<br />Seating", null);
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
$htmlMenuResults = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Results");
$params = array("desc");
$queryResultYears = $databaseResult->getTournamentYearsPlayed($params);
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
    $htmlMenuResultSeasonGroup = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Seasons " . $counterOverall . " to " . ($counterOverall - 4 == 0 ? 1 : $counterOverall - 4));
    $htmlMenuResultSeasonGroupArray[$counterResultSeasonGroup] = $htmlMenuResultSeasonGroup;
    $counterResultSeasonGroup++;
  }
  $htmlMenuResultSeason = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, $rowYears . " (Season " . ($rowYears - DateTime::$YEAR_FIRST_SEASON) . ")");
  $htmlMenuResultSeasonArray[$counterResultSeason] = $htmlMenuResultSeason;
  $counterResultSeason++;
  $htmlMenuResultSeasonGroup->setItems($htmlMenuResultSeasonArray);
  $params = array($rowYears);
  $queryResultAll = $databaseResult->getTournamentAll($params);
  if (0 < count($queryResultAll)) {
    foreach ($queryResultAll as $rowAll) {
      $description = count(explode(" - ", $rowAll->getDescription())) > 1 ? explode(" - ", $rowAll->getDescription())[1] : explode(" - ", $rowAll->getDescription())[0];
      $htmlLinkResult = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "tournamentId"), array("results", $rowAll->getId()), -1, $description . " (" . $rowAll->getDate()->getDisplayFormat() . ")", null);
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
$htmlMenuStats = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Stats");
$htmlLinkMyStats = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "personalize.php", null, null, null, -1, "My Stats", null);
$params = array(false);
$resultListUsers = $databaseResult->getUsersAll($params);
$counterOverall = 1;
$counterLoop = 1;
$counterUserGroup = 0;
foreach ($resultListUsers as $user) {
  if ($counterLoop == 1) {
    $htmlLinkUserArray = array();
    $htmlLinkUserArrayCounter = 0;
    $htmlMenuUserGroup = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Users " . $counterOverall . " to " . ($counterOverall + 9));
    $htmlMenuUserGroupArray[$counterUserGroup] = $htmlMenuUserGroup;
    $counterUserGroup++;
  }
  $htmlLinkUser = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "personalize.php", null, array("userId"), array($user->getId()), -1, $user->getName() . "'s stats", null);
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
$htmlMenuOtherStats = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Other Users");
$htmlMenuOtherStats->setItems($htmlMenuUserGroupArray);
$htmlStatsArray = array($htmlLinkMyStats, $htmlMenuOtherStats);
$htmlMenuStats->setItems($htmlStatsArray);
$htmlMenuReports = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Reports");
$htmlMenuReportStandard = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Standard");
$queryResult = $databaseResult->getResultIdMax(null);
$htmlLinkResults = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "tournamentId"), array("results", $queryResult[0]), -1, "Results", null);
$htmlLinkTotalPoints = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("pointsTotal", "show"), -1, "Total pts", null);
$htmlLinkEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("earnings", "show"), -1, "Earnings", null);
$htmlLinkEarningsChampionship = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("earningsChampionship", "show"), -1, "Earnings (Championship)", null);
$htmlLinkKnockouts = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("knockouts", "show"), -1, "KOs", null);
$htmlLinkSummary = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("summary", "show"), -1, "Summary", null);
$htmlLinkWinners = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("winners", "show"), -1, "Winners", null);
$htmlLinkFinishes = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("finishes", "show"), -1, "Finishes", null);
$htmlLinkBounties = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "yearSelection"), array("bounties", "show"), -1, "Bounties", null);
$htmlLinkStandardArray = array($htmlLinkResults, $htmlLinkTotalPoints, $htmlLinkEarnings, $htmlLinkEarningsChampionship, $htmlLinkKnockouts, $htmlLinkSummary, $htmlLinkWinners, $htmlLinkFinishes, $htmlLinkBounties);
$htmlMenuReportStandard->setItems($htmlLinkStandardArray);
$htmlMenuReportSeason = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Season");
$htmlLinkPrizePool = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("prizePoolForSeason", "Y"), -1, "Prize pool", null);
$htmlLinkTotalPoints = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("pointsTotalForSeason", "Y"), -1, "Total points", null);
$htmlLinkAveragePoints = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("pointsAverageForSeason", "Y"), -1, "Average points", null);
$htmlLinkTotalEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("earningsTotalForSeason", "Y"), -1, "Total Earnings", null);
$htmlLinkAverageEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("earningsAverageForSeason", "Y"), -1, "Average Earnings", null);
$htmlLinkTotalKnockouts = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("knockoutsTotalForSeason", "Y"), -1, "Total knockouts", null);
$htmlLinkAverageKnockouts = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("knockoutsAverageForSeason", "Y"), -1, "Average knockouts", null);
$htmlLinkBounties = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("bountiesForSeason", "Y"), -1, "Bounties", null);
$htmlLinkWinners = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("winnersForSeason", "Y"), -1, "Winners", null);
$htmlLinkSeasonArray = array($htmlLinkPrizePool, $htmlLinkTotalPoints, $htmlLinkAveragePoints, $htmlLinkTotalEarnings, $htmlLinkAverageEarnings, $htmlLinkTotalKnockouts, $htmlLinkAverageKnockouts, $htmlLinkBounties, $htmlLinkWinners);
$htmlMenuReportSeason->setItems($htmlLinkSeasonArray);
$htmlMenuReportChampionship = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Championship");
$htmlLinkByYearByEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "sort"), array("championship", "0 desc,2 desc"), -1, "By year by earnings", null);
$htmlLinkByNameByYear = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "sort"), array("championship", "1 asc,0 desc"), -1, "By name by year", null);
$htmlLinkByNameByEarningsByYear = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "sort"), array("championship", "1 asc,2 desc"), -1, "By name by earnings by year", null);
$htmlLinkByNameByEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "reports.php", null, array("reportId", "sort", "group"), array("championship", "2 desc,1 asc", "true"), -1, "By name by earnings", null);
$htmlLinkChampionshipArray = array($htmlLinkByYearByEarnings, $htmlLinkByNameByYear, $htmlLinkByNameByEarningsByYear, $htmlLinkByNameByEarnings);
$htmlMenuReportChampionship->setItems($htmlLinkChampionshipArray);
$htmlMenuReportRanking = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Ranking");
$htmlLinkTotalPoints = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("pointsTotalForUser", "Y"), -1, "Total pts", null);
$htmlLinkAveragePoints = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("pointsAverageForUser", "Y"), -1, "Average points", null);
$htmlLinkTotalKnockouts = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("knockoutsTotalForUser", "Y"), -1, "Total KOs", null);
$htmlLinkAverageKnockouts = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("knockoutsAverageForUser", "Y"), -1, "Average KOs", null);
$htmlLinkTotalEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("earningsTotalForSeason", "Y"), -1, "Total earnings", null);
$htmlLinkAverageEarnings = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("earningsTotalForUser", "Y"), -1, "Avg earnings", null);
$htmlLinkWins = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("winsForUser", "Y"), -1, "Wins", null);
$htmlLinkNemesis = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("nemesisForUser", "Y"), -1, "Nemesis", null);
$htmlLinkBully = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("bullyForUser", "Y"), -1, "Bully", null);
$htmlLinkWon = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("tournamentsWonForUser", "Y"), -1, "Won", null);
$htmlLinkFinishes = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("finishesForUser", "Y"), -1, "Finishes", null);
$htmlLinkPlayedCount = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("tournamentsPlayedForUser", "Y"), -1, "Played count", null);
$htmlLinkPlayedByType = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("tournamentsPlayedByTypeForUser", "Y"), -1, "Played by type", null);
$htmlLinkMemberSince = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "top5.php", null, array("reportId", "navigation"), array("tournamentsPlayedFirstForUser", "Y"), -1, "Member since", null);
$htmlLinkRankingArray = array($htmlLinkTotalPoints, $htmlLinkAveragePoints, $htmlLinkTotalKnockouts, $htmlLinkAverageKnockouts, $htmlLinkTotalEarnings, $htmlLinkAverageEarnings, $htmlLinkWins, $htmlLinkNemesis, $htmlLinkBully, $htmlLinkWon, $htmlLinkFinishes, $htmlLinkPlayedCount, $htmlLinkPlayedByType, $htmlLinkMemberSince);
$htmlMenuReportRanking->setItems($htmlLinkRankingArray);
$htmlReportsArray = array($htmlMenuReportStandard, $htmlMenuReportSeason, $htmlMenuReportChampionship, $htmlMenuReportRanking);
$htmlMenuReports->setItems($htmlReportsArray);
$levels = array($htmlLinkHome, $htmlLinkEvents, $htmlLinkChampionship, $htmlMenuResults, $htmlMenuStats, $htmlMenuReports);
// print_r($htmlMenuResults); die();
if (SessionUtility::getValue(SessionUtility::$OBJECT_NAME_ADMINISTRATOR) != 0) {
  $htmlMenuReportAdministration = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Administration");
  $htmlMenuReportGames = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Games");
  $htmlLinkNotifications = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageNotification.php", null, null, null, -1, "Notifcations", null);
  $htmlLinkSeasons = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageSeason.php", null, null, null, -1, "Seasons", null);
  $htmlLinkTournaments = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageTournament.php", null, null, null, -1, "Tournaments", null);
  $htmlLinkRegistration = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageRegistration.php", null, null, null, -1, "Registration", null);
  $htmlLinkBuyins = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageBuyins.php", null, null, null, -1, "Buyins", null);
  $htmlLinkResultsDuring = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageResultsDuring.php", null, null, null, -1, "Results - during", null);
  $htmlLinkResults = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageResults.php", null, null, null, -1, "Results", null);
  $htmlLinkSpecialType = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageSpecialType.php", null, null, null, -1, "Special type", null);
  $htmlLinkGamesArray = array($htmlLinkNotifications, $htmlLinkSeasons, $htmlLinkTournaments, $htmlLinkRegistration, $htmlLinkBuyins, $htmlLinkResultsDuring, $htmlLinkResults, $htmlLinkSpecialType);
  $htmlMenuReportGames->setItems($htmlLinkGamesArray);
  $htmlMenuReportUsers = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Users");
  $htmlLinkLocations = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageLocation.php", null, null, null, -1, "Locations", null);
  $htmlLinkUsers = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageUser.php", null, null, null, -1, "Users", null);
  $htmlLinkNewUserApproval = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageSignupApproval.php", null, null, null, -1, "New user approval", null);
  $htmlLinkUsersArray = array($htmlLinkLocations, $htmlLinkUsers, $htmlLinkNewUserApproval);
  $htmlMenuReportUsers->setItems($htmlLinkUsersArray);
  $htmlMenuReportPayouts = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Payouts");
  $htmlLinkGroup = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageGroup.php", null, null, null, -1, "Groups", null);
  $htmlLinkGroupPayout = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageGroupPayout.php", null, null, null, -1, "Payout groups", null);
  $htmlLinkPayout = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "managePayout.php", null, null, null, -1, "Payouts", null);
  $htmlLinkPayoutArray = array($htmlLinkGroup, $htmlLinkPayout, $htmlLinkGroupPayout);
  $htmlMenuReportPayouts->setItems($htmlLinkPayoutArray);
  $htmlLinkEmail = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageEmail.php", null, null, null, -1, "Send email", null);
  $htmlMenuReportScheduledJobs = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "Scheduled Jobs");
  $htmlLinkAutoRegisterHost = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "autoRegisterHost.php", null, array(Constant::$FIELD_NAME_MODE), array(Constant::$MODE_VIEW), -1, "Run auto register host", null);
  $htmlLinkAutoReminder = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "autoReminder.php", null, array(Constant::$FIELD_NAME_MODE), array(Constant::$MODE_VIEW), -1, "Run auto reminder", null);
  $htmlLinkScheduledJobsArray = array($htmlLinkAutoRegisterHost, $htmlLinkAutoReminder);
  $htmlMenuReportScheduledJobs->setItems($htmlLinkScheduledJobsArray);
  $htmlLinkAdministrationArray = array($htmlMenuReportGames, $htmlMenuReportUsers, $htmlMenuReportPayouts, $htmlLinkEmail, $htmlMenuReportScheduledJobs);
  $htmlMenuReportAdministration->setItems($htmlLinkAdministrationArray);
  array_push($levels, $htmlMenuReportAdministration);
}
$htmlMenuReportMyProfile = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, "My profile");
$htmlLinkEdit = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "manageUser.php", null, array("mode", "userId"), array("modify", SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID)), -1, "Edit my profile", null);
$htmlLinkLogout = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "logout.php", null, null, null, -1, "Logout", null);
$htmlLinkResetPassword = new HtmlLink(null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), "resetPassword.php", null, array("nav"), array("Y"), -1, "Password reset", null);
$htmlLinkMyProfileArray = array($htmlLinkEdit, $htmlLinkLogout, $htmlLinkResetPassword);
$htmlMenuReportMyProfile->setItems($htmlLinkMyProfileArray);
array_push($levels, $htmlMenuReportMyProfile);
  // echo print_r($levels, true);
$htmlMenuRoot = new HtmlMenu(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), $levels, null, null);
$smarty->assign("navigation", $htmlMenuRoot->getHtmlRoot());
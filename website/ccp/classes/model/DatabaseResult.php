<?php
namespace ccp\classes\model;
use ccp\classes\utility\SessionUtility;
use Exception;
use PDO;
use PDOException;
class DatabaseResult extends Root {
  private $database; // Database object
  private $connection; // actual connection
  public function __construct($debug) {
//     $debug = true;
    parent::__construct1($debug);
    $this->initialize();
  }
  public function getConnection() {
    return $this->connection;
  }
  public function getDatabase() {
    return $this->database;
  }
  public function initialize() {
    $this->setDatabase($this->initializeDatabase());
    $this->setConnection($this->initializeConnection());
  }
  public function setConnection($connection) {
    $this->connection = $connection;
  }
  public function setDatabase(Database $database) {
    $this->database = $database;
  }
  public function getAutoRegisterHost($params) {
    return $this->getData("autoRegisterHost", $params, null, false, null, false);
  }
  public function getBounty() {
    return $this->getData("bountySelectAll", null, null, false, null, false);
  }
  public function getBountyCountSelectByTournament($params) {
    return $this->getData("bountyCountSelectByTournament", $params, null, false, null, false);
  }
  public function getBountyEarnings($params) {
    return $this->getData("bountyEarnings", $params, null, true, null, false);
  }
  public function getBountiesForSeason($params) {
    return $this->getData("bountiesForSeason", $params, false, false, null, false);
  }
  public function getBullyForUser($params) {
    return $this->getData("bullyForUser", $params, null, true, null, false);
  }
  public function getChampionshipByYearByEarnings($params) {
    return $this->getData("championship", $params, null, true, null, false);
  }
  public function getChampionshipByPlayerForYear($params) {
    return $this->getData("championship", $params, null, true, null, false);
  }
  public function getChampionshipByPlayerByEarnings($params) {
    return $this->getData("championship", $params, null, true, null, false);
  }
  public function getChampionshipQualifiedPlayers($params) {
    return $this->getData("championshipQualifiedPlayers", $params, null, false, null, false);
  }
  public function getCountTournamentForDates($params) {
    return $this->getData("countTournamentForDates", $params, null, false, null, false);
  }
  public function getEarningsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData("earningsAverageForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getEarningsTotalForChampionship($params) {
    return $this->getData("earningsTotalForChampionship", $params, null, true, null, false);
  }
  public function getEarningsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData("earningsTotalForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getEarningsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData("earningsTotalAndAverageForSeasonForUser", $params, $orderBy, true, null, $rank);
  }
  public function getEarningsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData("earningsTotalAndAverageForUser", $params, $orderBy, true, null, $rank);
  }
  public function getFee() {
    return $this->getData("feeSelectAll", null, null, false, null, false);
  }
  public function getFinishesForUser($params) {
    return $this->getData("finishesSelectAllByPlayerId", $params, null, true, null, false);
  }
  public function getFoodByTournamentIdAndPlayerId($params) {
    return $this->getData("foodByTournamentIdAndPlayerId", $params, null, false, null, false);
  }
  public function getGameType() {
    return $this->getData("gameTypeSelectAll", null, null, false, null, false);
  }
  public function getGroupsAll($params) {
    return $this->getData("groupSelectAll", null, null, $params[0], null, false);
  }
  public function getGroupById($params) {
    return $this->getData("groupSelectAllById", $params, null, false, null, false);
  }
  public function getGroupNameList() {
    return $this->getData("groupSelectNameList", null, null, false, null, false);
  }
  public function getGroupPayout() {
    return $this->getData("groupPayoutSelectAll", null, null, true, null, false);
  }
  public function getGroupPayoutById($params) {
    return $this->getData("groupPayoutSelectAllById", $params, null, false, null, false);
  }
  public function getKnockoutsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData("knockoutsAverageForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getKnockoutsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData("knockoutsTotalForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getKnockoutsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData("knockoutsTotalAndAverageForSeasonForUser", $params, $orderBy, true, null, $rank);
  }
  public function getKnockoutsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData("knockoutsTotalAndAverageForUser", $params, $orderBy, true, null, $rank);
  }
  public function getLimitType() {
    return $this->getData("limitTypeSelectAll", null, null, false, null, false);
  }
  public function getLocation($params) {
    return $this->getData("locationSelectAll", $params, null, $params[0], null, false);
  }
  public function getLocationById($params) {
    return $this->getData("locationSelectById", $params, null, false, null, false);
  }
  public function getLocationMaxId() {
    return $this->getData("locationSelectMaxId", null, null, false, null, false);
  }
  public function getLocationsHostedCount() {
    return $this->getData("locationSelectAllCount", null, null, true, null, false);
  }
  public function getLogin($userName) {
    return $this->getData("login", array($userName, "Super Users"), null, false, null, false);
  }
  public function getNemesisForUser($params) {
    return $this->getData("nemesisForUser", $params, null, true, null, false);
  }
  public function getPayoutsAll($params) {
    return $this->getData("payoutSelectAll", null, null, $params[0], null, false);
  }
  public function getPayoutById($params) {
    return $this->getData("payoutSelectAllById", $params, null, false, null, false);
  }
  public function getPayoutMaxId() {
    return $this->getData("payoutSelectMaxId", null, null, false, null, false);
  }
  public function getPayoutNameList() {
    return $this->getData("payoutSelectNameList", null, null, false, null, false);
  }
  public function getPointsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData("pointsAverageForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getPointsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData("pointsTotalForSeason", $params, $orderBy, true, $limitCount, false);
  }
  public function getPointsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData("pointsTotalAndAverageForSeasonForUser", $params, $orderBy, true, null, $rank);
  }
  public function getPointsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData("pointsTotalAndAverageForUser", $params, $orderBy, true, null, $rank);
  }
  public function getPrizePoolForSeason($params, $returnQuery) {
    return $this->getData("prizePoolForSeason", $params, null, $returnQuery, null, false);
  }
  public function getRegistrationWaitList($params) {
    return $this->getData("registrationWaitList", $params, null, false, null, false);
  }
  public function getResultIdMax($params) {
    return $this->getData("resultIdMax", null, null, false, null, false);
  }
  public function getResult() {
    return $this->getData("resultSelectAll", null, null, false, null, false);
  }
  public function getResultDuring($params) {
    return $this->getData("resultSelectAllDuring", $params, null, false, null, false);
  }
  public function getResultLastEnteredDuring($params) {
    return $this->getData("resultSelectLastEnteredDuring", $params, null, false, null, false);
  }
  public function getResultByTournamentId($params) {
    return $this->getData("resultSelectAllByTournamentId", $params, null, true, null, false);
  }
  public function getResultByTournamentIdAndPlayerId($params) {
    return $this->getData("resultSelectOneByTournamentIdAndPlayerId", $params, null, false, null, false);
  }
  public function getResultRegisteredByTournamentId($params) {
    return $this->getData("resultSelectRegisteredByTournamentId", $params, null, false, null, false);
  }
  public function getResultFinishedByTournamentId($params) {
    return $this->getData("resultSelectAllFinishedByTournamentId", $params, null, $params[1], null, false);
  }
  public function getResultPaidByTournamentId($params, $returnQuery) {
    return $this->getData("resultSelectPaidByTournamentId", $params, null, $returnQuery, null, false);
  }
  public function getResultPaidNotEnteredByTournamentId($params) {
    return $this->getData("resultSelectPaidNotEnteredByTournamentId", $params, null, false, null, false);
  }
  public function getResultOrderedTotalPoints($params) {
    return $this->getData("resultAllOrderedPoints", $params, null, true, null, false);
  }
  public function getResultOrderedEarnings($params) {
    return $this->getData("resultAllOrderedEarnings", $params, null, true, null, false);
  }
  public function getResultOrderedKnockouts($params) {
    return $this->getData("resultAllOrderedKnockouts", $params, null, true, null, false);
  }
  // public function getResultOrderedKnockoutsStats($params) {
  // return $this->getData("resultAllOrderedKnockoutsStats", $params, null, false, null, false);
  // }
  public function getResultOrderedSummary($params) {
    return $this->getData("resultAllOrderedSummary", $params, null, true, null, false);
  }
  public function getResultOrderedSummaryStats($params) {
    $resultListSummary = $this->getData("resultAllOrderedSummaryStats", $params, null, false, null, false);
    $resultListKo = $this->getData("resultAllOrderedKnockoutsStats", $params, null, false, null, false);
    $resultListWinners = $this->getData("winnersSelectAllStats", $params, null, false, null, false);
    foreach ($resultListSummary as $resultListSummaryKey => $resultListSummaryValue) {
      foreach ($resultListKo as $resultListKoKey => $resultListKoValue) {
        if ($resultListSummaryKey == $resultListKoKey) {
          $resultListSummary[$resultListSummaryKey] = array_merge($resultListSummaryValue, $resultListKoValue);
          break;
        }
      }
      foreach ($resultListWinners as $resultListWinnersKey => $resultListWinnersValue) {
        if ($resultListSummaryKey == $resultListWinnersKey) {
          $resultListSummary[$resultListSummaryKey] = array_merge($resultListSummary[$resultListSummaryKey], $resultListWinnersValue);
          break;
        }
      }
    }
    return $resultListSummary;
  }
  public function getResultBounty() {
    return $this->getData("resultBountySelectAll", null, null, false, null, false);
  }
  public function getResultBountyCurrent($params) {
    return $this->getData("resultBountyCurrent", $params, null, false, null, false);
  }
  public function getResultPaidUserCount() {
    return $this->getData("resultPaidUserCount", null, null, false, null, false);
  }
  public function getResultBountyByTournamentIdAndBountyId($params) {
    return $this->getData("resultBountyByTournamentIdAndBountyId", $params, null, true, null, false);
  }
  public function getSeason($params) {
    return $this->getData("seasonSelectAll", null, $params[0], $params[1], null, false);
  }
  public function getSeasonByActive($params) {
    return $this->getData("seasonSelectOneByActive", $params, null, false, null, false);
  }
  public function getSeasonById($params) {
    return $this->getData("seasonSelectOneById", $params, null, false, null, false);
  }
  public function getSeasonByIdAndDesc($params) {
    return $this->getData("seasonSelectOneByIdAndDesc", $params, null, false, null, false);
  }
  public function getSeasonActiveCount() {
    return $this->getData("seasonActiveCount", null, null, false, null, false);
  }
  public function getSeasonDateCheckCount($params) {
    return $this->getData("seasonDateCheckCount", $params, null, false, null, false);
  }
  public function getSpecialType($params) {
    return $this->getData("specialTypeSelectAll", null, $params[0], $params[1], null, false);
  }
  public function getSpecialTypeById($params) {
    return $this->getData("specialTypeSelectOneById", $params, null, false, null, false);
  }
  public function getStatus() {
    return $this->getData("statusSelectAll", null, null, false, null, false);
  }
  public function getStatusPaid($params, $returnQuery) {
    return $this->getData("statusSelectPaid", $params, null, $returnQuery, null, false);
  }
  public function getStructure() {
    return $this->getData("structureSelectAll", null, null, false, null, false);
  }
  public function getStructurePayout($params) {
    return $this->getData("structurePayout", $params, null, false, null, false);
  }
  public function getTournamentAll($params) {
    return $this->getData("tournamentAll", $params, null, null, null, false);
  }
  public function getTournament($params) {
    return $this->getData("tournamentSelectAll", null, $params[0], $params[1], null, false);
  }
  public function getTournamentIdMax($params) {
    return $this->getData("tournamentIdMax", null, null, false, null, false);
  }
  public function getTournamentOrdered($params) {
    return $this->getData("tournamentSelectAllOrdered", null, null, $params[0], null, false);
  }
  public function getTournamentsForEmailNotifications($params) {
    return $this->getData("tournamentsSelectForEmailNotifications", $params, null, false, null, false);
  }
  public function getTournamentByDateAndStartTime($params, $limitCount) {
    return $this->getData("tournamentSelectAllByDateAndStartTime", $params, null, false, $limitCount, false);
  }
  public function getTournamentById($params) {
    return $this->getData("tournamentSelectOneById", $params, null, false, null, false);
  }
  public function getTournamentBounty() {
    return $this->getData("tournamentBountySelectAll", null, null, false, null, false);
  }
  public function getTournamentBountyByTournamentId($params) {
    return $this->getData("tournamentBountySelectByTournamentId", $params, null, false, null, false);
  }
  public function getTournamentDuring() {
    return $this->getData("tournamentSelectAllDuring", null, null, false, null, false);
  }
  public function getSeasonChampionships() {
    return $this->getData("seasonSelectAllChampionship", null, null, false, null, false);
}
  public function getTournamentYearsPlayed($params) {
//     return $this->getData("tournamentSelectAllYearsPlayed", null, $params[0], false, null, false);
    return $this->getData("tournamentSelectAllYearsPlayed", null, null, false, null, false);
  }
  public function getTournamentForRegistration($params) {
    return $this->getData("tournamentSelectAllForRegistration", $params, null, false, null, false);
  }
  public function getTournamentForBuyins($params) {
    return $this->getData("tournamentSelectAllForBuyins", $params, null, false, null, false);
  }
  public function getTournamentForRegistrationStatus($params) {
    return $this->getData("tournamentSelectAllRegistrationStatus", $params, null, true, null, false);
  }
  public function getTournamentsPlayedByPlayerIdAndDateRange($params) {
    return $this->getData("tournamentsPlayedByPlayerIdAndDateRange", $params, null, false, null, false);
  }
  public function getTournamentsWonByPlayerId($params) {
    return $this->getData("tournamentsWonByPlayerId", $params, null, false, null, false);
  }
  public function getTournamentsPlayed($params) {
    return $this->getData("tournamentsPlayed", $params, null, true, null, true);
  }
  public function getTournamentsPlayedByTypeByPlayerId($params) {
    return $this->getData("tournamentsPlayedByType", $params, null, true, null, false);
  }
  public function getTournamentsPlayedFirstByPlayerId($params) {
    return $this->getData("tournamentsPlayedFirst", $params, null, false, null, false);
  }
  public function getTournamentIdList($params) {
    return $this->getData("tournamentIdList", $params, null, false, null, false);
  }
  // public function getUser($params) {
  // return $this->getData("userSelectAll", $params, null, $params[0], null, false);
  // }
  public function getUserAbsencesByTournamentId($params) {
    return $this->getData("userAbsencesByTournamentId", $params, null, false, null, false);
  }
  public function getUsersActive($params) {
    return $this->getData("userActive", null, null, false, null, false);
  }
  public function getUsersAll($params) {
    return $this->getData("userSelectAll", null, null, $params[0], null, false);
  }
  public function getUserById($params) {
    return $this->getData("userSelectOneById", $params, null, false, null, false);
  }
  public function getUserByUsername($params) {
    return $this->getData("userSelectOneByUsername", $params, null, false, null, false);
  }
  public function getUserByEmail($params) {
    return $this->getData("userSelectOneByEmail", $params, null, false, null, false);
  }
  public function getUsersForEmailNotifications($params) {
    return $this->getData("usersSelectForEmailNotifications", $params, null, false, null, false);
  }
  public function getUsersForApproval() {
    return $this->getData("usersSelectForApproval", null, null, true, null, false);
  }
  public function getUserPaidByTournamentId($params) {
    return $this->getData("userPaidByTournamentId", $params, null, false, null, false);
  }
  public function getWaitListedPlayerByTournamentId($params) {
    return $this->getData("waitListedPlayerByTournamentId", $params, null, false, null, false);
  }
  public function getWinnersForSeason($params, $returnQuery, $limitCount) {
    return $this->getData("winnersForSeason", $params, null, $returnQuery, $limitCount, false);
  }
  public function getWinsForUser($params, $orderBy, $rank) {
    return $this->getData("winsForUser", $params, $orderBy, true, null, $rank);
  }
  public function getWinsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData("winsTotalAndAverageForSeasonForUser", $params, $orderBy, true, null, $rank);
  }
  public function getWinners($params) {
    return $this->getData("winnersSelectAll", $params, null, true, null, false);
  }
  public function getUserPasswordReset($params) {
    return $this->getData("userPasswordReset", $params, null, false, null, false);
  }
  public function deleteBounty($params) {
    return $this->deleteData("bountyDelete", $params);
  }
  public function deleteLocation($params) {
    return $this->deleteData("locationDelete", $params);
  }
  public function deleteGroup($params) {
    return $this->deleteData("groupDelete", $params);
  }
  public function deleteGroupPayout($params) {
    return $this->deleteData("groupPayoutDelete", $params);
  }
  public function deletePayout($params) {
    return $this->deleteData("payoutDelete", $params);
  }
  public function deleteRegistration($params) {
    return $this->deleteData("registrationDelete", $params);
  }
  public function deleteResult($params) {
    return $this->deleteData("resultDelete", $params);
  }
  public function deleteResultBounty($params) {
    return $this->deleteData("resultBountyDelete", $params);
  }
  public function deleteSeason($params) {
    return $this->deleteData("seasonDelete", $params);
  }
  public function deleteStructure($params) {
    return $this->deleteData("structureDelete", $params);
  }
  public function deleteTournament($params) {
    return $this->deleteData("tournamentDelete", $params);
  }
  public function deleteTournamentBountyByTournamentId($params) {
    return $this->deleteData("tournamentBountyDeleteByTournamentId", $params);
  }
  public function deleteTournamentBountyByTournamentIdAndBountyId($params) {
    return $this->deleteData("tournamentBountyDeleteByTournamentIdAndBountyId", $params);
  }
  public function deleteTournamentBountyByPlayerId($params) {
    return $this->deleteData("tournamentBountyDeleteByPlayerId", $params);
  }
  public function deleteSpecialType($params) {
    return $this->deleteData("specialTypeDelete", $params);
  }
  public function insertBounty($params) {
    return $this->insertData("bountyInsert", $params);
  }
  public function insertGroup($params) {
    return $this->insertData("groupInsert", $params);
  }
  public function insertGroupPayout($params) {
    return $this->insertData("groupPayoutInsert", $params);
  }
  public function insertLocation($params) {
    return $this->insertData("locationInsert", $params);
  }
  public function insertPayout($params) {
    return $this->insertData("payoutInsert", $params);
  }
  public function insertRegistration($params) {
    return $this->insertData("registrationInsert", $params);
  }
  public function insertSeason($params) {
    return $this->insertData("seasonInsert", $params);
  }
  public function insertStructure($params) {
    return $this->insertData("structureInsert", $params);
  }
  public function insertTournament($params) {
    return $this->insertData("tournamentInsert", $params);
  }
  public function insertTournamentBounty($params) {
    return $this->insertData("tournamentBountyInsert", $params);
  }
  public function insertSpecialType($params) {
    return $this->insertData("specialTypeInsert", $params);
  }
  public function insertUser($params) {
    return $this->insertData("userInsert", $params);
  }
  public function updateBuyins($params) {
    return $this->updateData("buyinsUpdate", $params);
  }
  public function updateGroup($params) {
    return $this->updateData("groupUpdate", $params);
  }
  public function updateGroupPayout($params) {
    return $this->updateData("groupPayoutUpdate", $params);
  }
  public function updateLocation($params) {
    return $this->updateData("locationUpdate", $params);
  }
  public function updatePayout($params) {
    return $this->updateData("payoutUpdate", $params);
  }
  public function updateRegistration($params) {
    return $this->updateData("registrationUpdate", $params);
  }
  public function updateRegistrationCancel($params) {
    return $this->updateData("registrationCancelUpdate", $params);
  }
  public function updateResult($params) {
    return $this->updateData("resultUpdate", $params);
  }
  public function updateResultDuring($params) {
    return $this->updateData("resultUpdateDuring", $params);
  }
  public function updateResultByTournamentIdAndPlace($params) {
    return $this->updateData("resultUpdateByTournamentIdAndPlace", $params);
  }
  public function updateSeason($params) {
    return $this->updateData("seasonUpdate", $params);
  }
  public function updateTournament($params) {
    return $this->updateData("tournamentUpdate", $params);
  }
  public function updateSpecialType($params) {
    return $this->updateData("specialTypeUpdate", $params);
  }
  public function updateUser($params) {
    return $this->updateData("userUpdate", $params);
  }
  public function updateUserReset($params) {
    return $this->updateData("userUpdateReset", $params);
  }
  public function updateUserChangePassword($params) {
    return $this->updateData("userUpdateChangePassword", $params);
  }
  public function updateUserRememberMe($params) {
    return $this->updateData("userUpdateRememberMe", $params);
  }
  public function updateUserRememberMeClear($params) {
    return $this->updateData("userUpdateRememberMeClear", $params);
  }
  private function initializeDatabase() {
    if ($_SERVER["SERVER_NAME"] == "localhost") {
      $username = "root";
      $password = "toor";
      $port = 3308;
    } else {
      $username = "chipch5_app";
      $password = "app_chipch5";
      $port = 3006;
    }
    $database = new Database($this->isDebug(), "localhost", $username, $password, "chipch5_stats", $port);
    return $database;
  }
  private function initializeConnection() {
    try {
      $connection = new PDO($this->getDatabase()->getDsn(), $this->getDatabase()->getUserid(), $this->getDatabase()->getPassword(), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage() . "\r\n" . $this->getDatabase();
    }
    return $connection;
  }
  // $dataName is name of the query
  // $params is array of input parameters
  // $orderBy is array of fields to order by
  // $returnQuery is boolean (true returns query instead of results, false returns results)
  // $limitCount is number to limit the results by
  // $rank is boolean (true means ranking, false means no ranking)
  private function getData($dataName, $params, $orderBy = null, $returnQuery = false, $limitCount = null, $rank = false) {
//     try {
      $resultList = array();
      switch ($dataName) {
        case "autoRegisterHost":
          // tournament id so that it returns a record for each tournament on the day
          $query =
            "SELECT t.tournamentId, t.tournamentDate, t.startTime, l.playerId, l.address, l.city, l.state, l.zipCode, l.phone, CONCAT(u.first_name, ' ', u.last_name) AS name, u.email " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId AND tournamentDate BETWEEN '" . $params[0] . "' AND DATE_ADD('" . $params[0] . "', INTERVAL 14 DAY) " .
            "INNER JOIN poker_user u ON l.playerId = u.id " . $this->buildUserActive("AND", "u") .
            " LEFT JOIN poker_result r ON t.tournamentId = r.tournamentId AND u.id = r.playerId " .
            "WHERE r.playerId IS NULL";
          break;
        case "bountySelectAll":
          $query = "SELECT bountyId, bountyName, bountyDesc " . "FROM poker_bounty";
          break;
        case "bountyCountSelectByTournament":
          $query =
            "SELECT b.bountyName, b.bountyDesc, COUNT(*) AS cnt " .
            "FROM poker_result_bounty rb " .
            "INNER JOIN poker_bounty b ON rb.bountyId = b.bountyId AND rb.tournamentId = " . $params[0] .
            " GROUP BY b.bountyName";
          break;
        case "bountyEarnings":
          $query =
            "SELECT a.knockedOutBy, a.winner AS name, SUM(a.numPlayers) * 2 AS winnings, (nb.numBounties * 2) AS cost, a.active, a.winnerActive " .
            "FROM (SELECT r.tournamentid, r.playerid, CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, r.KnockedOutBy, CONCAT(u2.first_name, ' ', u2.last_name) AS winner, u2.active AS winnerActive, tb.BountyId, b.BountyName, np.numPlayers " .
            "      FROM poker_result r";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "       INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'";
          }
          $query .=
            "      INNER JOIN poker_user u ON r.playerid = u.id " .
            "      INNER JOIN poker_user u2 ON r.KnockedOutBy = u2.id " .
          "      INNER JOIN poker_tournament_bounty tb ON r.TournamentId = tb.TournamentId AND r.PlayerId = tb.PlayerId " .
          "      INNER JOIN poker_bounty b ON tb.BountyId = b.BountyId " .
          "      INNER JOIN (SELECT rb.tournamentId, rb.bountyId, COUNT(*) AS numPlayers " .
          "                  FROM poker_result_bounty rb " .
          "                  GROUP BY rb.tournamentId, rb.bountyId) np ON tb.tournamentId = np.tournamentId AND tb.BountyId = np.bountyId " .
          "      ORDER BY r.TournamentId, tb.BountyId) a " . "INNER JOIN (SELECT rb1.playerId, COUNT(*) AS numBounties " .
          "            FROM poker_result_bounty rb1 " .
//           "            INNER JOIN poker_tournament t1 ON rb1.tournamentId = t1.tournamentId AND (t1.tournamentDesc IS NULL OR t1.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "')";
          "            INNER JOIN poker_tournament t1 ON rb1.tournamentId = t1.tournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "            AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'";
          }
          $query .=
            "            LEFT JOIN poker_special_type st ON t1.specialTypeId = st.typeId AND (st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "')" .
            "            GROUP BY rb1.playerId) nb ON a.KnockedOutBy = nb.playerId " .
            "GROUP BY a.winner";
          break;
        case "bountiesForSeason":
          $query =
            "SELECT type, CONCAT(first_name, ' ', last_name) AS name, tournamentDesc, active " .
            "FROM (SELECT 'points' AS type, g.first_name, g.last_name, g.active, g.tournamentDesc " .
//             "      FROM (SELECT r.playerId, u.first_name, u.last_name, u.active, SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "      FROM (SELECT r.playerId, u.first_name, u.last_name, u.active, SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "                                                                         CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "                                                                          CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                                                          CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                                                         ELSE " .
//             "                                                                          CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                                                          CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                          END " . "                                                                         END) AS pts, t.tournamentDesc " .
            "            FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerId " .
            "            INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' " .
            "            LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "            INNER JOIN (SELECT tournamentId, COUNT(*) AS numPlayers " .
            "                        FROM poker_result " .
            "                        WHERE place > 0 " .
            "                        GROUP BY tournamentId) np ON r.tournamentId = np.tournamentId " .
            "            GROUP BY r.playerId) g " .
            "      ORDER BY pts DESC, " . $this->buildOrderByName(null) . " LIMIT 2) a " .
            "UNION " .
            "SELECT * " .
            "FROM (SELECT 'tourney' AS type, CONCAT(u.first_name, ' ', u.last_name) AS name, t.tournamentDesc, u.active " .
            "      FROM poker_tournament t " .
            "      INNER JOIN poker_result r ON t.tournamentId = r.tournamentId AND r.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "      INNER JOIN poker_user u ON r.playerId = u.id " .
            "      AND t.tournamentDate = (SELECT MAX(t2.tournamentDate) " .
            "                              FROM poker_tournament t2 " .
            "                              INNER JOIN poker_result r2 ON t2.tournamentId = r2.tournamentId AND r2.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "      AND t.startTime = (SELECT MAX(t3.startTime) " .
            "                         FROM poker_tournament t3 " .
            "                         INNER JOIN poker_result r3 ON t3.tournamentId = r3.tournamentId AND r3.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                         WHERE t3.tournamentDate = (SELECT MAX(t4.tournamentDate) " . "                                                    FROM poker_tournament t4 " .
            "                                                    INNER JOIN poker_result r4 ON t4.tournamentId = r4.tournamentId AND r4.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND t4.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "')) " .
            "      AND r.place = (SELECT MIN(place) " .
            "                     FROM poker_tournament t5 " .
            "                     INNER JOIN poker_result r5 ON t5.tournamentId = r5.tournamentId AND r5.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                     AND t5.tournamentDate = (SELECT MAX(t6.tournamentDate) " .
            "                                              FROM poker_tournament t6 INNER JOIN poker_result r6 ON t6.tournamentId = r6.tournamentId AND r6.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND t6.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                     AND t5.startTime = (SELECT MAX(t7.startTime) " .
            "                                         FROM poker_tournament t7 " .
            "                                         INNER JOIN poker_result r7 on t7.tournamentId = r7.tournamentId AND r7.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                     WHERE t7.tournamentDate = (SELECT MAX(t8.tournamentDate) " .
            "                                                FROM poker_tournament t8 INNER JOIN poker_result r8 ON t8.tournamentId = r8.tournamentId AND r8.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND t8.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                                        ) " .
            "                    ) " .
            "      LIMIT 1) b";
          break;
        case "bullyForUser":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(r.playerId) AS kOs " .
            "FROM poker_result r " .
            "INNER JOIN poker_user u ON r.playerId = u.id " . "WHERE r.knockedOutBy = " . $params[0] .
            " GROUP BY r.playerId " .
            "ORDER BY kOs DESC, " . $this->buildOrderByName(null);
          break;
        case "championship":
          $query = "SELECT ";
          if (! isset($params[3]) || ! $params[3]) {
            $query .= " yr, id, ";
          }
          $query .= "name, ";
          if (isset($params[3]) && $params[3]) {
            $query .= "SUM(earnings) AS ";
          }
          $query .=
            "earnings " .
            "FROM (" . $this->buildChampionship($params) . ") a " .
            "WHERE earnings > 0";
          if (isset($params[3]) && $params[3]) {
            $query .= " GROUP BY name";
          }
          break;
        case "championshipQualifiedPlayers":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, " .
//             "       SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "       SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "             CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "               CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "               CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "             ELSE " .
//             "               CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "               CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "             END " .
            "           END) AS points, " .
            "       SUM(CASE WHEN r.place BETWEEN 1 AND 8 THEN 3 ELSE 0 END) AS 'bonus points', " .
            "       nt.numTourneys AS tourneys, " .
            "       SUM(CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
//             "           ELSE " . "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "           ELSE " . "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "           END) / nt.numTourneys AS 'average points' " .
            "FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerid " . $this->buildUserActive("AND", "u") .
            " INNER JOIN poker_tournament t on r.tournamentid = t.tournamentid AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' " .
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
            "INNER JOIN (SELECT r1.playerid, COUNT(*) AS numTourneys " .
            "            FROM poker_result r1 " .
            "            INNER JOIN poker_tournament t1 ON r1.tournamentid = t1.tournamentid " .
            "            WHERE r1.place > 0 " .
            "            AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' " .
            "            GROUP BY r1.playerid) nt ON r.playerid = nt.playerid " .
            "INNER JOIN (SELECT tournamentid, COUNT(*) AS numPlayers " .
            "            FROM poker_result " .
            "            WHERE place > 0 " .
            "            GROUP BY tournamentid) np ON r.tournamentid = np.tournamentid " .
            "WHERE nt.numTourneys >= 10 ";
          if (isset($params[2])) {
            $query .= " AND u.id NOT IN (" . $params[2] . ")";
          }
          $query .=
            "GROUP BY r.playerid " .
            "ORDER BY points DESC";
          break;
        case "countTournamentForDates": // 0 is start date, 1 is end date, 2 is user id, 3 is true for result table and false for not
          $query =
            "SELECT COUNT(*) AS cnt " .
            "FROM poker_tournament t";
          if (isset($params[3]) && $params[3]) {
            $query .= " INNER JOIN poker_result r ON t.tournamentId = r.tournamentId";
          }
          if (isset($params[2])) {
            $query .= " WHERE r.playerId = " . $params[2] . " AND r.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND ";
          } else {
            $query .= " WHERE ";
          }
          $query .= "t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'";
          break;
        case "earningsAverageForSeason":
        case "earningsTotalForChampionship":
        case "earningsTotalForSeason":
        case "earningsTotalAndAverageForSeasonForUser":
        case "earningsTotalAndAverageForUser":
          if ("earningsTotalAndAverageForUser" == $dataName) {
            $userId = $params[0];
          } else if ("earningsTotalForSeason" != $dataName && "earningsAverageForSeason" != $dataName && "earningsTotalForChampionship" != $dataName) {
            $userId = $params[2];
          }
          $query = "";
          if ("earningsTotalForChampionship" != $dataName) {
            $query .=
              "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, IFNULL(earns, 0) AS earns, IFNULL(earns / trnys, 0) AS avg, IFNULL(trnys, 0) AS trnys, u.active " .
              "FROM poker_user u " .
              "LEFT JOIN (SELECT id, SUM(totalEarnings) AS earns, numTourneys AS trnys " .
              "           FROM (SELECT id, first_name, last_name, SUM(earnings) AS totalEarnings, MAX(earnings) AS maxEarnings, numTourneys " .
              "                 FROM (SELECT p.id, p.first_name, p.last_name, " .
              "                              ((np.numPlayers * (t.buyinAmount - (t.buyinAmount * t.rake))) + " .
              "                               (CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END * (t.rebuyAmount - (t.rebuyAmount * t.rake))) + " .
              "                               (CASE WHEN na.numAddons IS NULL THEN 0 ELSE na.numAddons END * (t.addonAmount - (t.addonAmount * t.rake)))) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS Earnings, " .
              "                              nt.NumTourneys " .
              "            FROM poker_user p " .
              "            INNER JOIN poker_result r ON p.id = r.playerId " .
              "            INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId ";
            if ("earningsTotalAndAverageForUser" != $dataName) {
              $query .= "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
            }
            $query .=
              "            INNER JOIN (SELECT r1.playerId, COUNT(*) AS NumTourneys " .
              "                        FROM poker_result r1 " .
              "                        INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND r1.place > 0 ";
            if ("earningsTotalAndAverageForUser" != $dataName) {
              $query .= "                        AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
            }
            $query .=
              "                        GROUP BY r1.playerId) nt ON r.playerId = nt.playerId " .
              "            INNER JOIN (SELECT r2.tournamentId, COUNT(*) AS numPlayers " .
              "                        FROM poker_result r2 " .
              "                        WHERE r2.place > 0 " .
              "                        GROUP BY r2.tournamentId) np ON r.tournamentId = np.tournamentId " .
              "            LEFT JOIN (SELECT r3.tournamentId, SUM(r3.rebuyCount) AS numRebuys " .
              "                       FROM poker_result r3 " .
              "                       WHERE r3.place > 0 " .
              "                       AND r3.rebuyCount > 0 " .
              "                       GROUP BY r3.tournamentId) nr ON r.tournamentId = nr.tournamentId " .
              "            LEFT JOIN (SELECT tournamentId, COUNT(addonPaid) AS numAddons " .
              "                       FROM poker_result " .
              "                       WHERE addonPaid = '" . Constant::$FLAG_YES . "' " .
              "                       GROUP BY tournamentId) na ON r.tournamentId = na.tournamentId " .
              "            LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
              "                       FROM (SELECT np.tournamentId, p.payoutId " .
              "                             FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
              "                                   FROM poker_result r " .
              "                                   WHERE r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
              "                                   GROUP BY r.tournamentId) np " .
              "                             INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId " .
              "                             INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
              "                             INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
              "                       INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place WHERE r.place > 0) y " .
              "            GROUP BY id " .
              "            UNION ";
          } else {
            $query .=
              "             SELECT id, CONCAT(first_name, ' ', last_name) AS name, IFNULL(totalEarnings, 0) AS earns " .
              "             FROM (";
          }
          $query .=
            "            SELECT xx.id, xx.last_name, xx.first_name, SUM(xx.earnings) AS totalEarnings, MAX(xx.earnings) AS maxEarnings, 0 " .
            "            FROM (SELECT YEAR(t.tournamentDate) AS Yr, p.Id, p.first_name, p.last_name, " .
            "                        (SELECT SUM(total) - CASE WHEN YEAR(t.tournamentDate) = 2008 THEN 150 ELSE " . // adjust to match Dave W stats
            "                                               CASE WHEN YEAR(t.tournamentDate) = 2007 THEN -291 ELSE " . // adjust to match Dave W stats
            "                                                 CASE WHEN YEAR(t.tournamentDate) = 2006 THEN -824 ELSE 0 END " . // adjust to match Dave W stats
            "                                               END " .
            "                                            END AS 'Total Pool' " .
            "                         FROM (SELECT YEAR(t2.tournamentDate) AS Yr, t2.tournamentId AS Id, CASE WHEN b.Play IS NULL THEN 0 ELSE b.Play END, " .
            "                                      ((t2.BuyinAmount * t2.rake) * Play) + " .
            "                                      ((t2.rebuyAmount * t2.rake) * CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END) + " .
            "                                      ((t2.addonAmount * t2.rake) * CASE WHEN na.numAddons IS NULL THEN 0 ELSE na.numAddons END) AS Total " .
            "                               FROM poker_tournament t2 LEFT JOIN (SELECT tournamentId, COUNT(*) AS Play " .
            "                                                                   FROM poker_result " .
            "                                                                   WHERE buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "                                                                   AND place > 0 " .
            "                                                                   GROUP BY tournamentId) b ON t2.tournamentId = b.tournamentId";
          if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalForChampionship" != $dataName) {
            $query .= "                               AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          if ("earningsTotalForChampionship" == $dataName && isset($params[0])) {
            $query .= "                               AND YEAR(t2.tournamentDate) = '" . $params[0] . "' ";
          }
          $query .=
            "                              LEFT JOIN (SELECT r.tournamentId, SUM(r.rebuyCount) AS numRebuys " .
            "                                         FROM poker_result r " .
            "                                         WHERE r.rebuyPaid = '" . Constant::$FLAG_YES . "' " .
            "                                         AND r.rebuyCount > 0 " .
            "                                         GROUP BY r.tournamentId) nr ON t2.tournamentId = nr.tournamentId " .
            "                              LEFT JOIN (SELECT r.tournamentId, COUNT(*) AS numAddons " .
            "                                         FROM poker_result r " .
            "                                         WHERE r.AddonPaid = '" . Constant::$FLAG_YES . "' " .
            "                                         GROUP BY r.tournamentId) na ON t2.tournamentId = na.tournamentId) zz " .
            "                        WHERE zz.yr = YEAR(t.tournamentDate) " .
            "                        GROUP BY zz.yr) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS Earnings " .
            "                 FROM poker_user p " .
            "                 INNER JOIN poker_result r ON p.id = r.playerId " .
//             "                 INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentDesc LIKE '%" . Constant::$DESCRIPTION_CHAMPIONSHIP . "%'";
          "                 INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId";
          if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalForChampionship" != $dataName) {
            $query .= "        AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          if ("earningsTotalForChampionship" == $dataName && isset($params[0])) {
            $query .= "                               AND YEAR(t.tournamentDate) = '" . $params[0] . "' ";
          }
          $query .=
            "                  LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "                  LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
            "                             FROM (SELECT np.tournamentId, p.payoutId " .
            "                                   FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
            "                                         FROM poker_result r " .
            "                                         WHERE r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                         GROUP BY r.tournamentId) np " .
            "                                   INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId";
          if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalForChampionship" != $dataName) {
            $query .= "                                    AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          if ("earningsTotalForChampionship" == $dataName && isset($params[0])) {
            $query .= "                               AND YEAR(t.tournamentDate) = '" . $params[0] . "' ";
          }
          $query .=
            "                                   INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
            "                                   INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
            "                             INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
            "                  WHERE r.place > 0 " .
            "                  AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "'" .
            "                  GROUP BY id, yr) xx ";
          if ("earningsTotalForChampionship" == $dataName) {
            $query .=
              "        GROUP BY xx.id, xx.last_name, xx.first_name " .
              "        ORDER BY totalearnings desc, xx.last_name, xx.first_name) a";
          } else {
            $query .=
              "      GROUP BY xx.id, xx.last_name, xx.first_name) cc " .
              "GROUP BY id) z ON u.id = z.id ";
            if ("earningsTotalForSeason" != $dataName && "earningsAverageForSeason" != $dataName && "earningsTotalForChampionship" != $dataName) {
              $whereClause = "WHERE u.id = " . $userId;
              $query .= " WHERE u.id = " . $userId;
            }
            if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalAndAverageForSeasonForUser" != $dataName) {
              $query .= " ORDER BY ";
              if (1 == $orderBy[0]) {
                $query .= "earns";
              } else {
                $query .= "avg";
              }
              $query .= " DESC, " . $this->buildOrderByName(null);
            }
            if ("earningsTotalForChampionship" == $dataName) {
              $query .= ")";
            }
            if ($rank) {
              if (1 == $orderBy[0]) {
                $orderByFieldName = "earns DESC, " . $this->buildOrderByName(null);
                $selectFieldName = "earns";
              } else {
                $orderByFieldName = "avg DESC, " . $this->buildOrderByName(null);
                $selectFieldName = "avg";
              }
              $selectFieldNames = "id, name, earns, avg, trnys";
              $query = $this->modifyQueryAddRank($query, $whereClause, $selectFieldName, $selectFieldNames, $orderByFieldName);
            }
          }
          break;
        case "feeSelectAll":
          $query =
            "SELECT year, playerId, amount " .
            "FROM poker_fee";
          break;
        case "finishesSelectAllByPlayerId":
          $query =
            "SELECT a.place, CASE WHEN b.finishes IS NULL THEN 0 ELSE b.finishes END AS finishes, CASE WHEN b.pct IS NULL THEN 0 ELSE b.pct END AS pct " .
            "FROM (SELECT DISTINCT place " .
            "      FROM poker_result " .
            "      WHERE place > 0 " .
            "      ORDER BY place) a " .
            "LEFT JOIN (SELECT r1.place, COUNT(*) AS finishes, COUNT(*) / (SELECT COUNT(*) " .
            "                                                              FROM poker_result r2 " .
            "                                                              INNER JOIN poker_tournament t2 ON r2.tournamentId = t2.tournamentId";
          if (isset($params[1]) && isset($params[2])) {
            $query .= "                                                              AND t2.tournamentDate BETWEEN '" . $params[1] . "' AND '" . $params[2] . "'";
          }
          $query .=
            "                                                              WHERE r2.playerId = r1.playerId) AS pct " .
            "           FROM poker_result r1 " .
            "           INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId";
          if (isset($params[1]) && isset($params[2])) {
            $query .= " AND t1.tournamentDate BETWEEN '" . $params[1] . "' AND '" . $params[2] . "'";
          }
          $query .=
            "           AND r1.playerId = " . $params[0] .
            "           GROUP BY r1.place) b ON a.place = b.place";
          break;
        case "foodByTournamentIdAndPlayerId":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.email, r.food, u.active " .
            "FROM poker_user u " .
            "LEFT JOIN poker_result r ON u.id = r.playerId AND r.tournamentId = " . $params[0] .
            " WHERE u.id = " . $params[1];
          break;
        case "gameTypeSelectAll":
          $query =
            "SELECT gameTypeId, gameTypeName " .
            "FROM poker_game_type";
          break;
        case "groupSelectAll":
        case "groupSelectAllById":
          $query =
            "SELECT groupId AS id, groupName AS name " .
            "FROM poker_group";
          if ("groupSelectAllById" == $dataName) {
            $query .= " WHERE groupId = " . $params[0];
          }
          break;
        case "groupPayoutSelectAll":
        case "groupPayoutSelectAllById":
          $query =
            "SELECT gp.groupId AS id, g.groupName AS 'group name', gp.payoutId AS 'payout id', p.payoutName AS 'payout name' " .
            "FROM poker_group_payout gp INNER JOIN poker_group g ON gp.groupId = g.groupId " .
            "INNER JOIN poker_payout p ON gp.payoutId = p.payoutId";
          if ("groupPayoutSelectAllById" == $dataName) {
            $query .=
              " WHERE gp.groupId = " . $params[0] .
              " AND gp.payoutId = " . $params[1];
          }
          break;
        case "groupSelectNameList":
          $query =
            "SELECT groupId, groupName " .
            "FROM poker_group";
          break;
        case "knockoutsAverageForSeason":
        case "knockoutsTotalForSeason":
        case "knockoutsTotalAndAverageForSeasonForUser":
        case "knockoutsTotalAndAverageForUser":
          if ("knockoutsTotalAndAverageForUser" == $dataName) {
            $userId = $params[0];
          } else if ("knockoutsTotalForSeason" != $dataName && "knockoutsAverageForSeason" != $dataName) {
            $userId = $params[2];
          }
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, IFNULL(kO, 0) AS kO, IFNULL(avg, 0) AS avg, IFNULL(trnys, 0) AS trnys, u.active " .
            "FROM poker_user u LEFT JOIN (SELECT id, k.knockouts AS kO, ROUND(k.knockouts / nt.numTourneys, 2) AS avg, nt.numTourneys AS trnys " .
            "                             FROM (SELECT u.id, u.first_name, u.last_name, COUNT(*) AS knockouts " .
            "                                   FROM poker_tournament t " .
            "                                   INNER JOIN poker_result r ON t.tournamentId = r.tournamentId ";
          if ("knockoutsTotalAndAverageForUser" != $dataName) {
            $query .= "                                   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                   AND r.place > 0 " .
            "                                   INNER JOIN poker_user u ON r.knockedOutBy = u.id " .
            "                                   GROUP BY r.knockedOutBy) k " .
            "INNER JOIN (SELECT r.playerId, COUNT(*) AS numTourneys " .
            "            FROM poker_tournament t INNER JOIN poker_result r ON t.tournamentId = r.tournamentId AND r.place > 0 ";
          if ("knockoutsTotalAndAverageForUser" != $dataName) {
            $query .= "   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .= "    GROUP BY r.playerId) nt ON k.Id = nt.PlayerId) a ON u.id = a.id";
          if ("knockoutsTotalForSeason" != $dataName && "knockoutsAverageForSeason" != $dataName) {
            $whereClause = "WHERE u.id = " . $userId;
            $query .= " WHERE u.id = " . $userId;
          }
          if ("knockoutsTotalAndAverageForSeasonForUser" != $dataName && "knockoutsTotalAndAverageForUser" != $dataName) {
            $query .= " ORDER BY ";
            if (1 == $orderBy[0]) {
              $query .= "kO";
            } else {
              $query .= "avg";
            }
            $query .= " DESC, " . $this->buildOrderByName(null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "kO DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "kO";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, kO, avg, trnys";
            $query = $this->modifyQueryAddRank($query, $whereClause, $selectFieldName, $selectFieldNames, $orderByFieldName);
          }
          break;
        case "limitTypeSelectAll":
          $query =
            "SELECT limitTypeId, limitTypeName " .
            "FROM poker_limit_type";
          break;
        case "locationSelectAll":
          $query =
            "SELECT l.locationId AS id, l.locationName AS name, u.id as playerId, CONCAT(u.first_name, ' ', u.last_name) AS host, l.address, l.city, UPPER(l.state) AS state, l.zipCode AS zip, l.phone, l.active, u.active AS userActive " .
            "FROM poker_location l " .
            "INNER JOIN poker_user u ON l.playerId = u.id ";
          if ($params[1]) {
            $query .= " AND l.active = '" . Constant::$FLAG_YES . "'";
          }
          if ($params[2]) {
            $query .= "ORDER BY l.locationName";
          }
          break;
        case "locationSelectById":
          $query =
            "SELECT locationId AS id, locationName AS name, playerId, address, city, UPPER(state) AS state, zipCode AS zip, phone, active " .
            "FROM poker_location " .
            "WHERE locationId IN (" . $params[0] . ")";
          break;
        case "locationSelectMaxId":
          $query =
            "SELECT MAX(locationId) AS id " .
            "FROM poker_location";
          break;
        case "locationSelectAllCount":
          $query =
            "SELECT l.locationId AS id, l.locationName AS location, l.playerId, CONCAT(u.first_name, ' ', u.last_name) AS host, l.address, l.city, l.state, l.zipCode AS zip, l.phone, l.active, u.active AS userActive, COUNT(*) AS count " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "INNER JOIN poker_user u ON l.playerId = u.id " .
            "GROUP BY l.locationId " .
            "ORDER BY count DESC";
          break;
        case "login":
          $query =
            "SELECT password " .
            "FROM poker_user " .
            "WHERE username = '" . $params[0] . "' " .
            "AND active = 1";
          break;
        case "nemesisForUser":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(r.knockedOutBy) AS kOs " .
            "FROM poker_result r INNER JOIN poker_user u ON r.knockedOutBy = u.id " .
            "WHERE r.playerId = " . $params[0] .
            " GROUP BY r.knockedOutBy " .
            "ORDER BY kOs DESC, " . $this->buildOrderByName(null);
          break;
          // TODO: dummy figure out how to fix
        case "payoutSelectAll" :
        case "payoutSelectAllById" :
          $query =
            "SELECT p.payoutId AS id, p.payoutName AS name, p.bonusPoints AS 'bonus pts', p.minPlayers AS 'min players', p.maxPlayers AS 'max players', s.place, s.percentage " .
            "FROM poker_payout p INNER JOIN poker_structure s ON p.payoutId = s.payoutId";
          if ("payoutSelectAllById" == $dataName) {
            $query .= " WHERE p.payoutId = " . $params[0];
          }
          break;
        case "payoutSelectMaxId":
          $query =
            "SELECT MAX(payoutId) AS id " .
            "FROM poker_payout";
          break;
        case "payoutSelectNameList":
          $query =
            "SELECT payoutId, payoutName " .
            "FROM poker_payout";
          break;
        case "pointsAverageForSeason":
        case "pointsTotalForSeason":
        case "pointsTotalAndAverageForSeasonForUser":
        case "pointsTotalAndAverageForUser":
          if ("pointsTotalAndAverageForUser" == $dataName) {
            $userId = $params[0];
          } else if ("pointsTotalForSeason" != $dataName && "pointsAverageForSeason" != $dataName) {
            $userId = $params[2];
          }
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, IFNULL(a.points, 0) AS pts, IFNULL(ROUND(a.points / a.trnys, 2), 0) AS avg, IFNULL(a.trnys, 0) AS trnys, u.active " .
//             "FROM poker_user u LEFT JOIN (SELECT u.id, SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "FROM poker_user u LEFT JOIN (SELECT u.id, SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "                                               CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "                                                CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                                CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                               ELSE " .
//             "                                                CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                                CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                               END " .
            "                                              END) AS points, nt.trnys " .
            "                            FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerId " .
            "                            INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId ";
          if ("pointsTotalAndAverageForUser" != $dataName) {
            $query .= "                             AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                            LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "                            INNER JOIN (SELECT r1.playerId, COUNT(*) AS trnys " .
            "                                        FROM poker_result r1 " .
            "                                        INNER JOIN poker_tournament t1 ON r1.TournamentId = t1.TournamentId AND r1.place > 0 ";
          if ("pointsTotalAndAverageForUser" != $dataName) {
            $query .= "                                         AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                        GROUP BY r1.playerId) nt ON r.playerId = nt.playerId " .
            "                            INNER JOIN (SELECT tournamentId, COUNT(*) AS numPlayers " .
            "                                        FROM poker_result " .
            "                                        WHERE place > 0 " .
            "                                        GROUP BY tournamentId) np ON r.tournamentId = np.tournamentId " .
            "                            GROUP BY r.playerId) a ON u.id = a.id";
          if ("pointsTotalForSeason" != $dataName && "pointsAverageForSeason" != $dataName) {
            $whereClause = "WHERE u.id = " . $userId;
            $query .= " WHERE u.id = " . $userId;
          }
          if ("pointsTotalAndAverageForUser" != $dataName && "pointsTotalAndAverageForSeasonForUser" != $dataName) {
            $query .= " ORDER BY ";
            if (1 == $orderBy[0]) {
              $query .= "pts";
            } else {
              $query .= "avg";
            }
            $query .= " DESC, " . $this->buildOrderByName(null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "pts DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "pts";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, pts, avg, trnys";
            $query = $this->modifyQueryAddRank($query, $whereClause, $selectFieldName, $selectFieldNames, $orderByFieldName);
          }
          break;
        case "prizePoolForSeason":
          $query =
            "SELECT SUM(total) AS total " .
            "FROM (SELECT t.tournamentId AS Id, np.play, " .
            "             ((t.buyinAmount * t.rake) * np.play) + " .
            "             ((t.rebuyAmount * t.rake) * CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END) + " .
            "             ((t.addonAmount * t.rake) * CASE WHEN na.numAddons IS NULL THEN 0 ELSE na.numAddons END) AS total " .
            "      FROM poker_tournament t " .
            "      LEFT JOIN (SELECT TournamentId, COUNT(*) AS play " .
            "                 FROM poker_result " .
            "                 WHERE buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "                 AND place > 0 " .
            "                 GROUP BY tournamentId) np ON t.tournamentId = np.tournamentId " .
            "      LEFT JOIN (SELECT tournamentId, SUM(rebuyCount) AS numRebuys " .
            "                 FROM poker_result " .
            "                 WHERE rebuyPaid = '" . Constant::$FLAG_YES . "' " .
            "                 AND rebuyCount > 0 " .
            "                 GROUP BY tournamentId) nr ON t.tournamentId = nr.tournamentId " .
            "      LEFT JOIN (SELECT tournamentId, COUNT(*) AS numAddons " .
            "                 FROM poker_result " .
            "                 WHERE addonPaid = '" . Constant::$FLAG_YES . "' " .
            "                 GROUP BY tournamentId) na ON t.tournamentId = na.tournamentId " .
            "      WHERE t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') zz";
          break;
        case "registrationWaitList":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.email, t.maxPlayers, u.active " .
            "FROM poker_user u " .
            "INNER JOIN poker_result r ON u.id = r.playerId " .
            "INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND r.tournamentId = " . $params[0] . " AND r.registerOrder > " . $params[1] . " AND r.registerOrder > t.maxPlayers " .
            "ORDER BY r.registerOrder " .
            "LIMIT " . $params[2];
          break;
        case "resultIdMax":
          $query =
            "SELECT MAX(r.tournamentId) AS tournamentId " .
            "FROM poker_tournament t INNER JOIN poker_result r ON t.TournamentId = r.TournamentId " .
            "WHERE tournamentDate <= CURRENT_DATE";
          break;
        case "resultSelectAll":
        case "resultSelectOneByTournamentIdAndPlayerId":
        case "resultSelectRegisteredByTournamentId":
        case "resultSelectAllFinishedByTournamentId":
        case "resultSelectPaidByTournamentId":
        case "resultSelectPaidNotEnteredByTournamentId":
          $query =
            "SELECT r.tournamentId, r.playerId, CONCAT(u.first_name, ' ' , u.last_name) AS name, u.email, r.statusCode, s.statusName AS status, r.registerOrder, r.buyinPaid, r.rebuyPaid, r.rebuyCount AS rebuy, r.addonPaid AS addon, r.addonFlag, r.place, r.knockedOutBy, CONCAT(u2.first_name, ' ' , u2.last_name) AS 'knocked out by', r.food, u.active, u2.active as knockedOutActive " .
            "FROM poker_result r INNER JOIN poker_user u ON r.playerId = u.id " .
            "LEFT JOIN poker_user u2 ON r.knockedOutBy = u2.id " .
            "INNER JOIN poker_status_code s ON r.statusCode = s.statusCode";
          if ("resultSelectOneByTournamentIdAndPlayerId" == $dataName) {
            $query .= " AND r.tournamentId = " . $params[0] . " AND r.playerId = " . $params[1];
          } else if ("resultSelectRegisteredByTournamentId" == $dataName) {
            $query .=
              " AND r.tournamentId = " . $params[0] .
              " AND r.statusCode = '" . Constant::$CODE_STATUS_REGISTERED . "'" .
              " AND r.place = 0" .
            " ORDER BY r.registerOrder";
          } else if ("resultSelectAllFinishedByTournamentId" == $dataName) {
            $query .=
              " AND r.tournamentId = " . $params[0] .
              " AND place <> 0" .
              " ORDER BY place DESC";
          } else if ("resultSelectPaidByTournamentId" == $dataName || "resultSelectPaidNotEnteredByTournamentId" == $dataName) {
            $query .=
              " WHERE tournamentId = " . $params[0] .
              " AND buyinPaid = '" . Constant::$FLAG_YES . "'";
            if ("resultSelectPaidNotEnteredByTournamentId" == $dataName) {
              $query .= " AND place = 0";
            }
            if ("resultSelectPaidByTournamentId" == $dataName || "resultSelectPaidNotEnteredByTournamentId" == $dataName) {
              $query .= " ORDER BY " . $this->buildOrderByName("u");
            }
          }
          break;
        case "resultSelectAllDuring":
          $query =
            "SELECT MIN(place) AS place " .
            "FROM poker_result " .
            "WHERE tournamentId = " . $params[0] .
            " AND place > 0";
          break;
        case "resultSelectLastEnteredDuring":
          $query =
            "SELECT r.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name, u.active " .
            "FROM poker_result r INNER JOIN poker_user u ON r.playerId = u.id " .
            "WHERE r.tournamentId = " . $params[0] .
            " AND r.place = " . $params[1];
          break;
        case "resultSelectAllByTournamentId":
          // prize pool used for championship resuls
          if (isset($params[0])) {
            $temp = $params[0];
          } else {
            $temp =
              "((np.NumPlayers * (t.BuyinAmount-(t.BuyinAmount * t.Rake))) + (CASE " .
              "        WHEN nr.NumRebuys IS NULL THEN 0 " .
              "        ELSE nr.NumRebuys " .
              "    END * (t.RebuyAmount - (t.RebuyAmount * t.Rake))) + (CASE " .
              "        WHEN na.NumAddons IS NULL THEN 0 " .
              "        ELSE na.NumAddons " .
              "    END * (t.AddonAmount - (t.AddonAmount * t.Rake))))";
          }
          $query =
            "SELECT r.place, CONCAT(p.first_name, ' ', p.last_name) AS name, r.rebuyCount * t.rebuyAmount AS rebuy, " .
            "       CASE WHEN r.AddonPaid = '" . Constant::$FLAG_YES . "' THEN t.AddonAmount ELSE 0 END AS addon, " .
            "       " . $temp .
            " * CASE " .
            "        WHEN s.Percentage IS NULL THEN 0 " .
            "        ELSE s.Percentage " .
            "    END AS earnings, " .
            "       CASE WHEN t.tournamentDesc LIKE '%Championship%' THEN 0 " .
            "       ELSE " .
            "        CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "         CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "         CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "        ELSE " .
//             "         CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "         CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "        END " .
            "       END AS 'pts', ko.knockedOutBy AS 'knocked out by', p.active, ko.active AS knockOutActive " .
            "FROM poker_result r INNER JOIN poker_user p ON r.playerId = p.id " .
            "INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId " .
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "LEFT JOIN " .
            "    (SELECT s1.payoutId, s1.place, s1.percentage " .
            "     FROM (SELECT p.payoutId " .
            "           FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
            "                 FROM poker_result r " .
            "                 WHERE r.tournamentId = " . $params[1] . " AND r.place > 0 AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "')) np " .
            "           INNER JOIN poker_tournament t ON np.tournamentId = t.tournamentId " .
            "           INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
            "           INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
            "     INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.place = s.place " .
            "INNER JOIN (SELECT r1.tournamentId, COUNT(*) AS numPlayers " .
            "            FROM poker_result r1 " .
            "            WHERE r1.place > 0 " .
            "            GROUP BY r1.tournamentId) np ON r.tournamentId = np.tournamentId " .
            "LEFT JOIN (SELECT r2.tournamentId, SUM(r2.rebuyCount) AS numRebuys " .
            "           FROM poker_result r2 " .
            "           WHERE r2.rebuyCount > 0 GROUP BY r2.tournamentId) nr ON r.tournamentId = nr.tournamentId " .
            "LEFT JOIN (SELECT r3.tournamentId, r3.playerId, CONCAT(p1.first_name, ' ', p1.last_name) AS knockedOutBy, p1.active " .
            "           FROM poker_result r3 INNER JOIN poker_user p1 ON r3.knockedOutBy = p1.id) ko ON r.tournamentId = ko.tournamentId AND r.playerId = ko.playerId " .
            "LEFT JOIN (SELECT tournamentId, playerId, COUNT(bountyId) AS numBountys " .
            "           FROM poker_result_bounty GROUP BY tournamentId, playerId) rb ON r.tournamentId = rb.tournamentId AND r.playerId = rb.playerId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(addonPaid) AS numAddons " .
            "           FROM poker_result WHERE addonPaid = '" . Constant::$FLAG_YES . "' GROUP BY tournamentId) na ON r.tournamentId = na.tournamentId " .
            "WHERE r.tournamentId = " . $params[1] .
            " AND r.place > 0 " .
            "ORDER BY t.tournamentDate DESC, t.startTime DESC, r.place";
          break;
        case "resultAllOrderedPoints":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, " .
//             "       SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "       SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "            CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "            ELSE " .
//             "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 " .
            "             ELSE np.numPlayers - r.place + 1 END " .
            "            END " .
            "           END) AS pts, " .
//             "       SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "       SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "            CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "            ELSE " .
//             "             CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "            END " .
            "           END) / nt.numTourneys AS avg, nt.numTourneys AS tourneys, u.active " .
            "FROM poker_user u " .
            "INNER JOIN poker_result r ON u.id = r.playerId " .
            "INNER JOIN poker_tournament t on r.tournamentId = t.tournamentId ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "      AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
//           $query .= " INNER JOIN (SELECT r1.playerId, COUNT(*) AS numTourneys FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND (t1.tournamentDesc IS NULL OR t1.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') AND r1.place > 0";
          $query .=
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            " INNER JOIN (SELECT r1.playerId, COUNT(*) AS numTourneys FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND r1.place > 0";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "      AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            " LEFT JOIN poker_special_type st ON t1.specialTypeId = st.typeId AND (st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "')" .
            " GROUP BY r1.playerId) nt ON r.playerId = nt.playerId " .
            "INNER JOIN (SELECT tournamentId, COUNT(*) AS numPlayers " .
            "            FROM poker_result " .
            "            WHERE place > 0 " .
            "            GROUP BY tournamentId) np ON r.tournamentId = np.tournamentId " .
            "GROUP BY r.playerId " .
            "ORDER BY pts DESC, " . $this->buildOrderByName(null);
          break;
        case "resultAllOrderedEarnings":
          $query =
            "SELECT name, SUM(totalEarnings) AS earnings, SUM(totalEarnings) / numTourneys AS avg, MAX(maxEarnings) AS max, numTourneys AS tourneys, active " .
            "FROM (SELECT id, name, SUM(earnings) AS totalEarnings, MAX(earnings) AS maxEarnings, numTourneys, active " .
            "      FROM (SELECT p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, " .
            "                   ((np.numPlayers * (t.buyinAmount - (t.buyinAmount * t.rake))) + " .
            "                    (CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END * (t.rebuyAmount - (t.rebuyAmount * t.rake))) + " .
            "                    (CASE WHEN na.numAddons IS NULL THEN 0 ELSE na.numAddons END * (t.addonAmount - (t.addonAmount * t.rake)))) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS earnings, nt.numTourneys, p.active " .
            "            FROM poker_result r INNER JOIN poker_user p ON r.playerId = p.id " .
            "            INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "            INNER JOIN (SELECT r1.playerId, COUNT(*) AS numTourneys " .
            "                        FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND r1.place > 0 ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                       AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                        GROUP BY r1.playerId) nt ON r.playerId = nt.playerId " .
            "            INNER JOIN (SELECT r2.tournamentId, COUNT(*) AS numPlayers " .
            "                        FROM poker_result r2 " .
            "                        WHERE r2.place > 0 " .
            "                        GROUP BY r2.tournamentId) np ON r.tournamentId = np.tournamentId " .
            "            LEFT JOIN (SELECT r3.tournamentId, SUM(r3.rebuyCount) AS numRebuys " .
            "                       FROM poker_result r3 " .
            "                       WHERE r3.place > 0 " .
            "                       AND r3.rebuyCount > 0 " .
            "                       GROUP BY r3.tournamentId) nr ON r.tournamentId = nr.tournamentId " .
            "            LEFT JOIN (SELECT tournamentId, COUNT(addonPaid) AS numaddons " . "                       FROM poker_result " . "                       WHERE addonPaid = '" . Constant::$FLAG_YES . "' " . "                       GROUP BY tournamentId) na ON r.tournamentId = na.tournamentId " . "            LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " . "                       FROM (SELECT np.tournamentId, p.payoutId " . "                             FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " . "                                   FROM poker_result r " . "                                   WHERE r.place > 0 " . "                                   AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " . "                                   GROUP BY r.tournamentId) np " . "                             INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId " . "                             INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " . "                             INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " . "                       INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " . "                       WHERE r.place > 0) y " . "            GROUP BY id " . "            UNION " . "            SELECT xx.id, xx.name, SUM(xx.earnings) AS totalEarnings, MAX(xx.earnings) AS maxEarnings, 0, xx.active " . "            FROM (SELECT YEAR(t.tournamentDate) AS yr, p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, p.active, " . "                         (SELECT SUM(total) AS 'total pool' " . "                          FROM (SELECT YEAR(t2.tournamentDate) AS Yr, t2.tournamentId AS id, CASE WHEN b.play IS NULL THEN 0 ELSE CONCAT(b.play, '+', CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END, 'r', '+', CASE WHEN na.numAddons IS NULL THEN 0 ELSE na.numAddons END, 'a') END AS play, " . "                                       ((t2.buyinAmount * t2.rake) * play) + ((t2.rebuyAmount * t2.rake) * CASE WHEN nr.numRebuys IS NULL THEN 0 ELSE nr.numRebuys END) + ((t2.addonAmount * t2.rake) * CASE WHEN na.numaddons IS NULL THEN 0 ELSE na.numaddons END) AS total " . "                                FROM poker_tournament t2 " . "                                LEFT JOIN (SELECT tournamentId, COUNT(*) AS play " . "                                           FROM poker_result " . "                                           WHERE buyinPaid = '" . Constant::$FLAG_YES . "' " . "                                           AND place > 0 " . "                                           GROUP BY tournamentId) b ON t2.tournamentId = b.tournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                               LEFT JOIN (SELECT r.tournamentId, SUM(r.rebuyCount) AS numRebuys " .
            "                                          FROM poker_result r " .
            "                                          WHERE r.rebuyPaid = '" . Constant::$FLAG_YES . "' " .
            "                                          AND r.rebuyCount > 0 " .
            "                                          GROUP BY r.tournamentId) nr ON t2.tournamentId = nr.tournamentId " .
            "                               LEFT JOIN (SELECT r.tournamentId, COUNT(*) AS numaddons " .
            "                                          FROM poker_result r " .
            "                                          WHERE r.addonPaid = '" . Constant::$FLAG_YES . "' " .
            "                                          GROUP BY r.tournamentId) na ON t2.tournamentId = na.tournamentId) zz " .
            "                         WHERE zz.yr = YEAR(t.tournamentDate) " .
            "                         GROUP BY zz.yr) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS earnings " .
            "                 FROM poker_result r " .
            "                 INNER JOIN poker_user p ON r.playerId = p.id " .
//             "                 INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentDesc LIKE '%" . Constant::$DESCRIPTION_CHAMPIONSHIP . "%'";
          "                 INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                  AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                 LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "                 LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
            "                            FROM (SELECT np.tournamentId, p.payoutId " .
            "                                  FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
            "                                        FROM poker_result r " .
            "                                        WHERE r.place > 0 " .
            "                                        AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                        GROUP BY r.tournamentId) np " .
            "                                  INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                  INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
            "                                  INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
            "                            INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
            "                 WHERE r.place > 0 " .
            "                 AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "'" .
            "                 GROUP BY id, yr) xx " .
            "            GROUP BY xx.id, xx.name) cc " .
            "GROUP BY id, name " .
            "ORDER BY earnings DESC";
          break;
        case "resultAllOrderedKnockouts":
        case "resultAllOrderedKnockoutsStats":
          $query =
            "SELECT k.id, name, k.knockouts AS kOs, k.knockouts / nt.numTourneys AS avgKo, b.bestKnockout AS bestKo, nt.numTourneys AS tourneys, k.active " .
            "FROM (SELECT u3.id, CONCAT(u3.first_name, ' ', u3.last_name) AS name, u.active, COUNT(*) AS knockouts " .
            "      FROM poker_tournament t " .
            "      INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "      INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "      INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "      INNER JOIN poker_user u ON l.playerId = u.id " .
            "      INNER JOIN poker_result r ON t.tournamentId = r.tournamentId " .
            "      INNER JOIN poker_user u2 ON r.playerId = u2.id " .
            "      INNER JOIN poker_status_code sc ON r.statusCode = sc.statusCode " .
            "      INNER JOIN poker_user u3 ON r.knockedOutBy = u3.id " .
            "      WHERE r.place > 0 ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "      AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "      GROUP BY r.knockedOutBy) k " .
            "INNER JOIN (SELECT r.playerId, COUNT(*) AS numTourneys " .
            "            FROM poker_tournament t " .
            "            INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "            INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "            INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "            INNER JOIN poker_user u ON l.playerId = u.id " .
            "            INNER JOIN poker_result r ON t.tournamentId = r.tournamentId " .
            "            INNER JOIN poker_user u2 ON r.playerId = u2.id " .
            "            INNER JOIN poker_status_code sc ON r.statusCode = sc.statusCode " .
            "            LEFT JOIN poker_user u3 ON r.knockedOutBy = u3.id " .
            "            WHERE r.place > 0 ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "            GROUP BY r.playerId) nt ON k.id = nt.playerId " .
            "LEFT JOIN (SELECT id, MAX(knockouts) AS BestKnockout " .
            "           FROM (SELECT u3.id, t.tournamentId, r.knockedOutBy, COUNT(*) AS knockouts " .
            "                 FROM poker_tournament t INNER JOIN poker_limit_type lt ON t.LimitTypeId = lt.limitTypeId " .
            "                 INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "                 INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "                 INNER JOIN poker_user u ON l.playerId = u.id " .
            "                 INNER JOIN poker_result r ON t.tournamentId = r.tournamentId " .
            "                 INNER JOIN poker_user u2 ON r.playerId = u2.id " .
            "                 INNER JOIN poker_status_code sc ON r.statusCode = sc.statusCode " .
            "                 INNER JOIN poker_user u3 ON r.knockedOutBy = u3.id " .
            "                 WHERE r.place > 0 " .
            "                 AND r.knockedOutBy IS NOT NULL ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                 AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                 GROUP BY t.tournamentId, r.knockedOutBy) z " .
            "           GROUP BY z.Id) b ON nt.playerId = b.id " .
            "WHERE b.id IN (SELECT DISTINCT playerId " .
            "               FROM poker_result " .
            "               WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "ORDER BY k.knockouts DESC, nt.NumTourneys";
          break;
        case "resultAllOrderedSummary":
        case "resultAllOrderedSummaryStats":
          $query = "SELECT ";
          if ("resultAllOrderedSummaryStats" == $dataName) {
            $query .= "id, ";
          }
          $query .=
            "name, d.tourneys AS '#', CASE WHEN e.Points IS NULL THEN 0 ELSE e.Points END AS pts, e.Points / d.numTourneys AS AvgPoints, d.FTs AS 'count', d.pctFTs AS '%', d.avgPlace AS 'avg', d.high AS 'best', d.low AS 'worst', " .
            "-(CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END) AS buyins, -(CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END) AS rebuys, " .
            "-(CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END) AS addons, -(CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END) + -(CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END) + -(CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END) AS 'total', " .
            "CASE WHEN e.NumBountys IS NULL THEN 0 ELSE e.NumBountys * 0 END AS bounties, d.earnings,  " .
            "d.earnings - CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END - CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END - CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END - CASE WHEN e.numBountys IS NULL THEN 0 ELSE e.numBountys * 0 END AS 'net(+/-)', " .
            "d.earnings / d.numTourneys AS '$ / trny', " .
            "(d.earnings - CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END - CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END - CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END - CASE WHEN e.numBountys IS NULL THEN 0 ELSE e.numBountys * 0 END) / d.numTourneys AS 'Net / Trny', " .
            "active " .
            "FROM (SELECT a.Id, a.name, a.active, a.Tourneys, a.FTs, a.PctFTs, a.AvgPlace, a.Low, a.High, CASE WHEN b.Earnings IS NULL THEN 0 ELSE b.Earnings END AS Earnings, a.NumTourneys " .
            "      FROM (SELECT p.Id, CONCAT(p.first_name, ' ', p.last_name) AS name, CASE WHEN nt.NumTourneys IS NULL THEN 0 ELSE nt.NumTourneys END AS Tourneys, CASE WHEN nft.NumFinalTables IS NULL THEN 0 ELSE nft.NumFinalTables END AS FTs, " .
            "                   CASE WHEN nt.NumTourneys IS NULL THEN 0 ELSE CASE WHEN nft.NumFinalTables IS NULL THEN 0 ELSE nft.NumFinalTables END / nt.NumTourneys END AS PctFTs, " .
            "                   CASE WHEN nt.NumTourneys IS NULL THEN 0 ELSE CASE WHEN nt.TotalPlaces IS NULL THEN 0 ELSE nt.TotalPlaces END / nt.NumTourneys END AS AvgPlace, " .
            "                   CASE WHEN nt.MaxPlace IS NULL THEN 0 ELSE nt.MaxPlace END AS Low, CASE WHEN nt.MinPlace IS NULL THEN 0 ELSE nt.MinPlace END AS High, nt.NumTourneys, p.active " .
            "            FROM poker_user p " .
            "            LEFT JOIN (SELECT r1.PlayerId, COUNT(*) AS NumTourneys, SUM(r1.Place) AS TotalPlaces, MAX(r1.Place) AS MaxPlace, MIN(r1.Place) AS MinPlace " .
            "                       FROM poker_result r1 " .
            "                       INNER JOIN poker_tournament t1 ON r1.TournamentId = t1.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                       AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                       WHERE r1.Place > 0 " .
            "                       GROUP BY r1.PlayerId) nt ON p.Id = nt.PlayerId " .
            "            LEFT JOIN (SELECT r2.PlayerId, COUNT(*) AS NumFinalTables " .
            "                       FROM poker_result r2 " .
            "                       INNER JOIN poker_tournament t2 ON r2.TournamentId = t2.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                       AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                       WHERE r2.Place BETWEEN 1 AND 8 " .
            "                       GROUP BY r2.PlayerId) nft ON p.Id = nft.PlayerId) a " .
            "            LEFT JOIN (SELECT id, name, SUM(TotalEarnings) AS Earnings, MAX(MaxEarnings) AS MaxEarnings, numTourneys " .
            "                       FROM (SELECT Id, name, SUM(Earnings) AS TotalEarnings, MAX(Earnings) AS MaxEarnings, NumTourneys " .
            "                             FROM (SELECT p.Id, CONCAT(p.first_name, ' ', p.last_name) AS name, " .
            "                                         ((np.NumPlayers * (t.BuyinAmount - (t.BuyinAmount * t.rake))) + " .
            "                                          (CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END * (t.RebuyAmount - (t.RebuyAmount * t.rake))) + " .
            "                                          (CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END * (t.AddonAmount - (t.AddonAmount * t.Rake)))) * CASE WHEN s.Percentage IS NULL THEN 0 ELSE s.Percentage END AS Earnings, nt.NumTourneys " .
            "                                   FROM poker_result r INNER JOIN poker_user p ON r.PlayerId = p.Id " .
            "                                   INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                   INNER JOIN (SELECT r1.PlayerId, COUNT(*) AS NumTourneys " .
            "                                               FROM poker_result r1 " .
            "                                               INNER JOIN poker_tournament t1 ON r1.TournamentId = t1.TournamentId AND r1.Place > 0";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                               AND t1.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                               GROUP BY r1.PlayerId) nt ON r.PlayerId = nt.PlayerId " .
            "                                   INNER JOIN (SELECT r2.TournamentId, COUNT(*) AS NumPlayers " .
            "                                               FROM poker_result r2 " .
            "                                               WHERE r2.Place > 0 " .
            "                                               GROUP BY r2.TournamentId) np ON r.TournamentId = np.TournamentId " .
            "                                   LEFT JOIN (SELECT r3.TournamentId, SUM(r3.rebuyCount) AS NumRebuys " .
            "                                              FROM poker_result r3 " .
            "                                              WHERE r3.Place > 0 " .
            "                                              AND r3.RebuyCount > 0 GROUP BY r3.TournamentId) nr ON r.TournamentId = nr.TournamentId " .
            "                                   LEFT JOIN (SELECT TournamentId, COUNT(AddonPaid) AS NumAddons " .
            "                                              FROM poker_result " .
            "                                              WHERE AddonPaid = '" . Constant::$FLAG_YES . "' " .
            "                                              GROUP BY TournamentId) na ON r.TournamentId = na.TournamentId " .
            "                                   LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
            "                                              FROM (SELECT np.tournamentId, p.payoutId " .
            "                                                    FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
            "                                                          FROM poker_result r " .
            "                                                          WHERE r.place > 0 " .
            "                                                          AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                          GROUP BY r.tournamentId) np INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId " .
            "                                                    INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
            "                                                    INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
            "                                              INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
            "                                   WHERE r.Place > 0) y " .
            "                             GROUP BY id " .
            "                             UNION " .
            "                             SELECT xx.id, xx.name, SUM(xx.earnings) AS TotalEarnings, MAX(xx.earnings) AS MaxEarnings, 0 " .
            "                             FROM (" . $this->buildChampionship($params) .
            "                                   GROUP BY id, yr) xx " .
            "                             GROUP BY xx.id, xx.name) cc " .
            "                       GROUP BY id, name) b ON a.Id = b.Id) d " .
//             "LEFT JOIN (SELECT c.PlayerId, c.Place, c.NumPlayers, CASE WHEN c.Place IS NULL THEN 0 ELSE SUM(CASE WHEN (c.tournamentDesc IS NULL OR c.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "LEFT JOIN (SELECT c.PlayerId, c.Place, c.NumPlayers, CASE WHEN c.Place IS NULL THEN 0 ELSE SUM(CASE WHEN c.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "                                                      CASE WHEN c.place BETWEEN 1 AND 8 THEN " .
//             "                                                       CASE WHEN c.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (c.numPlayers - c.place + 4) * 2 ELSE c.numPlayers - c.place + 4 END " .
            "                                                       CASE WHEN c.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (c.numPlayers - c.place + 4) * 2 ELSE c.numPlayers - c.place + 4 END " .
            "                                                      ELSE " .
//             "                                                       CASE WHEN c.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (c.numPlayers - c.place + 1) * 2 ELSE c.numPlayers - c.place + 1 END " .
            "                                                       CASE WHEN c.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (c.numPlayers - c.place + 1) * 2 ELSE c.numPlayers - c.place + 1 END " .
            "                                                      END " .
            "                                                     END) END AS Points, " .
            "                                                     SUM(CASE WHEN c.NumRebuys IS NULL THEN 0 ELSE c.NumRebuys END * c.RebuyAmount) AS Rebuys, " .
            "                                                     SUM(CASE WHEN c.NumAddons IS NULL THEN 0 ELSE c.NumAddons END * c.AddonAmount) AS Addons, " .
            "                                                     SUM(c.NumBountys) AS NumBountys, c.NumRebuys, c.BuyinAmount " .
            "           FROM (SELECT a.TournamentId, a.tournamentDesc, a.PlayerId, a.Place, a.NumPlayers, CASE WHEN b.NumBountys IS NULL THEN 0 ELSE b.NumBountys END AS NumBountys, a.NumRebuys, a.BuyinAmount, a.RebuyAmount, a.AddonAmount, a.NumAddons, a.typeDescription " .
            "                 FROM (SELECT r.TournamentId, t.tournamentDesc, r.PlayerId, r.Place, np.NumPlayers, nr.NumRebuys, t.BuyinAmount, t.RebuyAmount, t.AddonAmount, na.NumAddons, st.typeDescription " .
            "                       FROM poker_result r INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                       AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                       AND r.place > 0 " .
            "                       LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "                       INNER JOIN (SELECT r3.TournamentId, COUNT(*) AS NumPlayers " .
            "                                   FROM poker_result r3 INNER JOIN poker_tournament t3 ON r3.TournamentId = t3.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                   AND t3.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                   WHERE r3.Place > 0 " .
            "                                   GROUP BY r3.TournamentId) np ON r.TournamentId = np.TournamentId " .
            "                       LEFT JOIN (SELECT r4.TournamentId, r4.PlayerId, SUM(r4.rebuyCount) AS NumRebuys " .
            "                                  FROM poker_result r4 " .
            "                                  INNER JOIN poker_tournament t4 ON r4.TournamentId = t4.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                                  AND t4.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                                  WHERE r4.Place > 0 " .
            "                                  AND r4.RebuyCount > 0 " .
            "                                  GROUP BY r4.TournamentId, r4.PlayerId) nr ON r.TournamentId = nr.TournamentId AND r.PlayerId = nr.PlayerId " .
            "                       LEFT JOIN (SELECT TournamentId, PlayerId, COUNT(AddonPaid) AS NumAddons " .
            "                                  FROM poker_result r7 WHERE AddonPaid = '" . Constant::$FLAG_YES . "' GROUP BY TournamentId, PlayerId) na ON r.TournamentId = na.TournamentId AND r.PlayerId = na.PlayerId) a " .
            "                 LEFT JOIN (SELECT rb1.TournamentId, rb1.PlayerId, COUNT(BountyId) AS NumBountys " .
            "                            FROM poker_result_bounty rb1 " .
            "                            INNER JOIN poker_result r8 ON rb1.TournamentId = r8.TournamentId AND rb1.PlayerId = r8.PlayerId " .
            "                            INNER JOIN poker_tournament t8 ON r8.TournamentId = t8.TournamentId";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "                            AND t8.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                            GROUP BY rb1.TournamentId, rb1.PlayerId) b ON a.TournamentId = b.TournamentId AND a.PlayerId = b.PlayerId) c " .
            "           GROUP BY c.PlayerId) e ON d.Id = e.PlayerId " .
            "WHERE e.playerId IN (SELECT DISTINCT playerId " .
            "                     FROM poker_result " .
            "                     WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "') ";
          if ("resultAllOrderedSummary" == $dataName) {
            $query .= "ORDER BY ROUND(d.earnings, 0) DESC";
          }
          break;
        case "resultBountyByTournamentIdAndBountyId":
          $query =
            "SELECT 1 " .
            "FROM poker_result_bounty rb " .
            "LEFT JOIN poker_bounty b ON rb.bountyId = b.bountyId " .
            "WHERE rb.tournamentId = " . $params[0] .
            " AND rb.playerId = ?2 " .
            "AND rb.bountyId = " . $params[1];
          break;
        case "resultBountySelectAll":
          $query =
            "SELECT tournamentId, playerId, bountyId " .
            "FROM poker_result_bounty";
          break;
        case "resultBountyCurrent":
          $query =
            "SELECT bountyId, playerId " .
            "FROM (SELECT 1 AS bountyId, playerId " .
//             "      FROM (SELECT r.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name, SUM(CASE WHEN (t.tournamentDesc IS NULL OR t.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "      FROM (SELECT r.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name, SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "                                                                                     CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
//             "                                                                                       CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                                                                       CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                                                                     ELSE " .
//             "                                                                                       CASE WHEN t.tournamentdesc LIKE '%" . Constant::$DESCRIPTION_MAIN_EVENT . "%' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                                                                       CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "                                                                                     END " .
            "                                                                                   END) AS pts " .
            "            FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerId " .
            "            INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' " .
            "            LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
            "            INNER JOIN (SELECT tournamentId, COUNT(*) AS numPlayers FROM poker_result WHERE place > 0 GROUP BY tournamentId) np ON r.tournamentId = np.tournamentId GROUP BY r.playerId) g " .
            "      INNER JOIN (SELECT u.* " .
            "                  FROM poker_user u " .
            "                  INNER JOIN poker_result r ON r.playerId = u.id AND r.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                  INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId " .
            "                                                AND t.tournamentDate = (SELECT MAX(t9.tournamentDate) " .
            "                                                                        FROM poker_tournament t9 " .
            "                                                                        INNER JOIN poker_result r9 ON t9.tournamentId = r9.tournamentId AND r9.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                        AND t9.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                                                                                                                                        AND t.startTime = (SELECT MIN(t10.startTime) " .
            "                                                                                                                                                           FROM poker_tournament t10 " .
            "                                                                                                                                                           INNER JOIN poker_result r10 ON t10.tournamentId = r10.tournamentId " .
            "                                                                                                                                                                                       AND r10.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                                                                       AND t10.tournamentDate = (SELECT MAX(t11.tournamentDate) " .
            "                                                                                                                                                                                                                 FROM poker_tournament t11 " .
            "                                                                                                                                                                                                                 INNER JOIN poker_result r11 ON t11.tournamentId = r11.tournamentId " .
            "                                                                                                                                                                                                                 AND r11.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                                                                                                 AND t11.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'))) z ON g.playerId = z.id " .
            "      ORDER BY pts DESC, g.name " .
            "      LIMIT 2) a " .
            "UNION " .
            "SELECT bountyId, id " .
            "FROM (SELECT 2 AS bountyId, u.id " .
            "      FROM poker_tournament t " .
            "      INNER JOIN poker_result r on t.tournamentId = r.tournamentId AND t.tournamentDate = (SELECT MAX(t2.tournamentDate) " .
            "                                                                                           FROM poker_tournament t2 " .
            "                                                                                           INNER JOIN poker_result r2 ON t2.tournamentId = r2.tournamentId " .
            "                                                                                           AND r2.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                           AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                                                                                           AND t.startTime = (SELECT MAX(t3.startTime) " .
            "                                                                                                              FROM poker_tournament t3 " .
            "                                                                                                              INNER JOIN poker_result r3 ON t3.tournamentId = r3.tournamentId " .
            "                                                                                                                                         AND r3.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                              WHERE t3.tournamentDate = (SELECT MAX(t4.tournamentDate) " .
            "                                                                                                                                         FROM poker_tournament t4 " .
            "                                                                                                                                         INNER JOIN poker_result r4 ON t4.tournamentId = r4.tournamentId " .
            "                                                                                                                                         AND r4.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                                                         AND t4.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "')) " .
            "                                                                                           AND r.place = (SELECT MIN(place) " .
            "                                                                                                          FROM poker_tournament t5 " .
            "                                                                                                          INNER JOIN poker_result r5 ON t5.tournamentId = r5.tournamentId " .
            "                                                                                                          AND r5.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                          AND t5.tournamentDate = (SELECT MAX(t6.tournamentDate) " .
            "                                                                                                                                   FROM poker_tournament t6 " .
            "                                                                                                                                   INNER JOIN poker_result r6 ON t6.tournamentId = r6.tournamentId " .
            "                                                                                                                                                              AND r6.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                                                                              AND t6.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                                                                                                                                                              AND t5.startTime = (SELECT MAX(t7.startTime) " .
            "                                                                                                                                                                                  FROM poker_tournament t7 " .
            "                                                                                                                                                                                  INNER JOIN poker_result r7 ON t7.tournamentId = r7.tournamentId " .
            "                                                                                                                                                                                  AND r7.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                                                                                                  WHERE t7.tournamentDate = (SELECT MAX(t8.tournamentDate) " .
            "                                                                                                                                                                                                             FROM poker_tournament t8 " .
            "                                                                                                                                                                                                             INNER JOIN poker_result r8 ON t8.tournamentId = r8.tournamentId " .
            "                                                                                                                                                                                                             AND r8.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " .
            "                                                                                                                                                                                                             AND t8.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "')) " .
            "                                                                                                                                   INNER JOIN (SELECT u.* " .
            "                                                                                                                                               FROM poker_user u " .
            "                                                                                                                                               INNER JOIN poker_result r ON r.playerId = u.id " .
            "                                                                                                                                               INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId " .
            "                                                                                                                                               AND r.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                               AND t.tournamentDate = (SELECT MAX(t9.tournamentDate) " .
            "                                                                                                                                                                       FROM poker_tournament t9 " .
            "                                                                                                                                                                       INNER JOIN poker_result r9 ON t9.tournamentId = r9.tournamentId " .
            "                                                                                                                                                                       AND r9.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                                                       AND t9.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "') " .
            "                                                                                                                                                                       AND t.startTime = (SELECT MIN(t10.startTime) " .
            "                                                                                                                                                                                          FROM poker_tournament t10 " .
            "                                                                                                                                                                                          INNER JOIN poker_result r10 ON t10.tournamentId = r10.tournamentId " .
            "                                                                                                                                                                                                                      AND r10.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                                                                                                      AND t10.tournamentDate = (SELECT MAX(t11.tournamentDate) " .
            "                                                                                                                                                                                                                                                FROM poker_tournament t11 " .
            "                                                                                                                                                                                                                                                INNER JOIN poker_result r11 ON t11.tournamentId = r11.tournamentId " .
            "                                                                                                                                                                                                                                                AND r11.statusCode IN ('" . Constant::$CODE_STATUS_PAID . "', '" . Constant::$CODE_STATUS_FINISHED . "') " .
            "                                                                                                                                                                                                                                                AND t11.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'))) z ON r5.playerId = z.id) " .
            "                                                                                                                                   INNER JOIN poker_user u ON r.playerId = u.id " .
            "    LIMIT 1) b";
          break;
        case "resultPaidUserCount":
          $query =
            "SELECT COUNT(*) AS cnt " .
            "FROM poker_user u INNER JOIN poker_result r ON r.playerId = u.id " .
            "INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId " .
            "AND t.tournamentDate = (SELECT MAX(t9.tournamentDate) " .
            "                        FROM poker_tournament t9 " .
            "                        INNER JOIN poker_result r9 ON t9.tournamentId = r9.tournamentId AND r9.statusCode = '" . Constant::$CODE_STATUS_PAID . "') " .
            "AND t.startTime = (SELECT MIN(t10.startTime) " .
            "                  FROM poker_tournament t10 " .
            "                  INNER JOIN poker_result r10 ON t10.tournamentId = r10.tournamentId AND r10.statusCode = '" . Constant::$CODE_STATUS_PAID . "' " .
            "                                              AND t10.tournamentDate = (SELECT MAX(t11.tournamentDate) " .
            "                                                                        FROM poker_tournament t11 " .
            "                                                                        INNER JOIN poker_result r11 ON t11.tournamentId = r11.tournamentId AND r11.statusCode = '" . Constant::$CODE_STATUS_PAID . "'))";
          break;
        case "seasonActiveCount":
          $query =
            "SELECT COUNT(*) AS cnt " .
            "FROM poker_season " .
            "WHERE seasonActive = '1'";
          break;
        case "seasonDateCheckCount":
          $query =
            "SELECT COUNT(*) AS cnt " .
            "FROM poker_season " .
            "WHERE ('" . $params[0] . "' BETWEEN seasonStartDate AND seasonEndDate " .
            "OR '" . $params[1] . "' BETWEEN seasonStartDate AND seasonEndDate)";
          if (isset($params[2])) {
            $query .= " AND seasonId <> " . $params[2];
          }
          break;
        case "seasonSelectAll":
        case "seasonSelectOneById":
        case "seasonSelectOneByIdAndDesc":
        case "seasonSelectOneByActive":
          $query =
            "SELECT seasonId AS id, seasonDescription AS description, seasonStartDate AS 'start date', seasonEndDate AS 'end date', seasonActive AS 'active' " .
            "FROM poker_season s ";
          if ("seasonSelectOneById" == $dataName) {
            $query .= " WHERE seasonid = " . $params[0];
          } else if ("seasonSelectOneByIdAndDesc" == $dataName) {
            $query .=
              " INNER JOIN poker_tournament t " .
              " WHERE t.tournamentDate BETWEEN s.seasonStartDate AND s.seasonEndDate AND t.tournamentId = " . $params[0] . " AND t.tournamentDesc LIKE '%" . $params[1] . "%'";
          } else if ("seasonSelectOneByActive" == $dataName) {
            $query .= " WHERE seasonActive = " . $params[0];
          } else if ("seasonSelectAll" == $dataName) {
            if (isset($orderBy)) {
              $query .= $orderBy;
            }
          }
          break;
        case "seasonSelectAllChampionship":
          $query =
            "SELECT seasonId, seasonDescription, seasonStartDate, seasonEndDate, seasonActive " .
            "FROM poker_season " .
            "ORDER BY seasonEndDate DESC, seasonStartDate";
          break;
        case "specialTypeSelectAll":
        case "specialTypeSelectOneById":
          $query =
            "SELECT typeId AS id, typeDescription AS description " .
            "FROM poker_special_type";
            if ("specialTypeSelectOneById" == $dataName) {
              $query .= " WHERE typeId = " . $params[0];
            }
          break;
        case "statusSelectPaid":
          $query =
            "SELECT p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, CASE WHEN r.buyinPaid = '" . Constant::$FLAG_YES . "' THEN 'Paid' ELSE 'Not paid' END AS 'buyin status', " .
            "CASE WHEN r.rebuyPaid = '" . Constant::$FLAG_YES . "' THEN 'Paid' ELSE 'Not paid' END AS 'rebuy status', " .
            "r.rebuyCount, CASE WHEN r.addonPaid = '" . Constant::$FLAG_YES . "' THEN 'Paid' ELSE 'Not paid' END AS 'addon status' " .
            "FROM poker_user p INNER JOIN poker_result r ON p.id = r.playerId " . $this->buildUserActive("AND", "p") .
            " INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND t.tournamentId = " . $params[0] .
            " AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "', '" . Constant::$CODE_STATUS_PAID . "')";
          break;
        case "statusSelectAll":
          $query =
            "SELECT statusCode, statusName " .
            "FROM poker_status_code";
          break;
        case "structureSelectAll":
        case "structurePayout":
          $query = "SELECT payoutId, place, percentage";
          if ("structurePayout" == $dataName) {
            $query .= " * " . $params[0] . " AS pay, percentage";
          }
          $query .= " FROM poker_structure";
          if ("structurePayout" == $dataName) {
            $query .= " WHERE payoutId = " . $params[1];
          }
          break;
        case "tournamentIdMax":
          $query =
            "SELECT MAX(tournamentId) AS tournamentId " .
            "FROM poker_tournament " .
            "WHERE tournamentDate <= CURRENT_DATE ";
          // "AND startTime <= CURRENT_TIME";
          break;
        case "tournamentAll":
          $query =
            "SELECT tournamentId, tournamentDesc, tournamentDate " .
            "FROM poker_tournament " .
            " WHERE YEAR(tournamentDate) = " . $params[0] .
            " ORDER BY tournamentDate DESC, startTime DESC";
          break;
        case "tournamentSelectAll":
        case "tournamentSelectAllByDateAndStartTime":
        case "tournamentSelectOneById":
        case "tournamentSelectAllForRegistration":
        case "tournamentSelectAllForBuyins":
        case "tournamentSelectAllOrdered":
        case "tournamentsSelectForEmailNotifications":
          $query =
            "SELECT t.tournamentId AS id, t.tournamentDesc AS description, t.comment, t.locationId, l.locationName AS location, t.limitTypeId, lt.limitTypeName AS 'limit', t.gameTypeId, gt.gameTypeName AS 'type', " .
            "       l.playerId, CONCAT(u.first_name, ' ', u.last_name) AS playerName, l.address, l.city, l.state, l.zipCode, l.phone, l.map AS mapHide, l.mapLink AS map, t.tournamentDate AS date, t.startTime AS 'start', t.endTime AS 'end', t.maxPlayers AS 'max players', t.chipCount AS 'chips', -t.buyinAmount AS 'buyin', t.maxRebuys AS 'max', -t.rebuyAmount AS 'amt', -t.addonAmount AS 'amt ', " .
            "       t.addonChipCount AS 'chips ', t.groupId, g.groupName AS name, t.rake, CASE WHEN nr.registeredCount IS NULL THEN 0 ELSE nr.registeredCount END AS registeredCount, " .
            "       CASE WHEN bp.buyinsPaid IS NULL THEN 0 ELSE bp.buyinsPaid END AS buyinsPaid, " .
            "       CASE WHEN rp.rebuysPaid IS NULL THEN 0 ELSE rp.rebuysPaid END AS rebuysPaid, " .
            "       CASE WHEN rc.rebuysCount IS NULL THEN 0 ELSE rc.rebuysCount END AS rebuysCount, " .
            "       CASE WHEN ap.addonsPaid IS NULL THEN 0 ELSE ap.addonsPaid END AS addonsPaid, " .
            "       CASE WHEN ec.enteredCount IS NULL THEN 0 ELSE ec.enteredCount END AS enteredCount, " .
            "       t.specialTypeId, st.typeDescription AS std " .
            "FROM poker_tournament t INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "INNER JOIN poker_user u ON l.playerId = u.id " .
            "INNER JOIN poker_group g on t.groupId = g.groupId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS buyinsPaid FROM poker_result WHERE buyinPaid = '" . Constant::$FLAG_YES . "' AND place = 0 GROUP BY tournamentId) bp ON t.tournamentId = bp.tournamentId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS rebuysPaid FROM poker_result WHERE rebuyPaid = '" . Constant::$FLAG_YES . "' AND place = 0 GROUP BY tournamentId) rp ON t.tournamentId = rp.tournamentId " .
            "LEFT JOIN (SELECT tournamentId, SUM(rebuyCount) AS rebuysCount FROM poker_result WHERE rebuyPaid = '" . Constant::$FLAG_YES . "' AND place = 0 GROUP BY tournamentId) rc ON t.tournamentId = rc.tournamentId " . "LEFT JOIN (SELECT tournamentId, COUNT(*) AS addonsPaid FROM poker_result WHERE addonPaid = '" . Constant::$FLAG_YES . "' AND place = 0 GROUP BY tournamentId) ap ON t.tournamentId = ap.tournamentId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS enteredCount FROM poker_result WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND place <> 0 GROUP BY tournamentId) ec ON t.tournamentId = ec.tournamentId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS registeredCount FROM poker_result WHERE statusCode = '" . Constant::$CODE_STATUS_REGISTERED . "' GROUP BY tournamentId) nr ON t.tournamentId = nr.tournamentId";
          if ("tournamentSelectAllByDateAndStartTime" == $dataName) {
            $query .=
              " WHERE t.tournamentDate >= '" . $params[0] . "' OR (t.tournamentDate = '" . $params[0] . "' AND t.startTime >= '" . $params[1] . "') " .
              "ORDER BY t.tournamentDate, t.startTime";
          } else if ("tournamentSelectOneById" == $dataName) {
            $query .= " WHERE t.tournamentId = " . $params[0];
          } else if ("tournamentSelectAllForRegistration" == $dataName || "tournamentSelectAllForBuyins" == $dataName) {
            $query .=
              " WHERE (" . $params[0] . " >= t.tournamentDate OR CURRENT_DATE <= " . $params[1] . ")" .
              " AND enteredCount IS NULL" .
              " ORDER BY t.tournamentDate, t.startTime";
          } else if ("tournamentSelectAllOrdered" == $dataName) {
            $query .= " ORDER BY t.tournamentDate DESC, t.startTime DESC";
          } else if ("tournamentSelectAll" == $dataName) {
            if (isset($orderBy)) {
              $query .= $orderBy;
            }
          } else if ("tournamentsSelectForEmailNotifications" == $dataName) {
            $query .=
              " WHERE DATE(tournamentDate) = DATE(DATE_ADD(now(), INTERVAL " . $params[0] . " DAY))" .
              " ORDER BY tournamentDate, startTime";
          }
          break;
        case "tournamentSelectAllRegistrationStatus":
          $query =
            "SELECT p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, CASE WHEN r.playerId IS NULL THEN 'Not registered' ELSE 'Registered' END AS status, " .
            "CASE WHEN r.registerOrder IS NULL THEN 'N/A' " .
            "ELSE CASE WHEN r.registerOrder > r.maxPlayers THEN CONCAT(r.registerOrder, ' (Wait list #', r.registerOrder - r.maxPlayers, ')') ELSE r.registerOrder END " .
            "END AS 'order' " .
            "FROM poker_user p LEFT JOIN (SELECT r2.tournamentId, r2.playerId, r2.registerOrder, t.maxPlayers " .
            "                                   FROM poker_result r2 " .
            "                                   INNER JOIN poker_tournament t ON r2.tournamentId = t.tournamentId AND r2.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "', '" . Constant::$CODE_STATUS_PAID . "') AND r2.tournamentId = " . $params[0] . ") r ON p.id = r.playerId " .
            "WHERE CONCAT(p.first_name, ' ', p.last_name) NOT LIKE '%test%' " .
            "AND CONCAT(p.first_name, ' ', p.last_name) NOT LIKE '%CCP%' " .
            "AND CONCAT(p.first_name, ' ', p.last_name) NOT LIKE '%lapdog%' " .
            "AND p.username NOT LIKE '%admin%' " .
            "AND p.active = 1";
          break;
        case "tournamentSelectAllDuring":
          $query =
            "SELECT t.tournamentId, t.tournamentDate, t.startTime, l.locationName, CASE WHEN bp.buyinsPaid IS NULL THEN 0 ELSE bp.buyinsPaid END AS buyinsPaid " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS buyinsPaid " .
            "           FROM poker_result " .
            "           WHERE buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "           GROUP BY tournamentId) bp ON t.tournamentId = bp.tournamentId " .
            "WHERE tournamentDate = CURRENT_DATE " .
            "AND bp.buyinsPaid > 0 " .
            "AND t.startTime = (SELECT MAX(t.startTime) " .
            "                   FROM poker_tournament t " .
            "                   LEFT JOIN (SELECT tournamentId, COUNT(*) AS buyinsPaid " .
            "                              FROM poker_result " .
            "                              WHERE buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "                              GROUP BY tournamentId) bp ON t.tournamentId = bp.tournamentId AND t.tournamentDate = CURRENT_DATE " .
           "                   WHERE bp.buyinsPaid > 0)";
          break;
        case "tournamentSelectAllYearsPlayed":
          $query =
            "SELECT DISTINCT YEAR(tournamentDate) AS year " .
            "FROM poker_tournament " .
            "ORDER BY YEAR(tournamentDate) desc";
          if (isset($orderBy)) {
            $query .= " " . $orderBy;
          }
          break;
        case "tournamentBountySelectAll":
        case "tournamentBountySelectByTournamentId":
          $query =
            "SELECT tb.tournamentId, b.bountyId, b.bountyName, b.bountyDesc, tb.playerId, CASE WHEN tb.playerId IS NULL THEN 'N/A' ELSE CONCAT(p.first_name, ' ', p.last_name) END AS name, p.active " .
            "FROM poker_bounty b LEFT JOIN poker_tournament_bounty tb ON b.bountyId = tb.bountyId";
          if ("tournamentBountySelectByTournamentId" == $dataName) {
            $query .= " AND tb.tournamentId = " . $params[0];
          }
          $query .= " LEFT JOIN poker_user p ON tb.playerId = p.id";
          if ("tournamentBountySelectByTournamentId" == $dataName) {
            $query .= " ORDER BY b.bountyName";
          }
          break;
        case "tournamentsPlayedByPlayerIdAndDateRange":
          $query =
            "SELECT COUNT(*) AS numPlayed " .
            "FROM poker_tournament t INNER JOIN poker_result r ON t.tournamentId = r.tournamentId " .
            "AND playerId = " . $params[0] . " " .
            "AND place > 0 " .
            "AND tournamentDate BETWEEN '" . $params[1] . "' AND '" . $params[2] . "'";
          break;
        case "tournamentsWonByPlayerId":
          $query =
            "SELECT t.tournamentId AS id, t.tournamentDesc AS description, t.comment as comment, t.locationId, l.locationName AS location, t.limitTypeId, lt.limitTypeName AS 'limit', t.gameTypeId, gt.gameTypeName AS 'type', t.chipCount AS 'chips', " .
            "l.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name, l.address, l.city, l.state, l.zipCode, l.phone, t.tournamentDate AS date, t.startTime AS 'start', t.endTime AS 'end', t.buyinAmount AS 'buyin', t.maxPlayers AS 'max players', t.maxRebuys AS 'max', t.rebuyAmount AS 'amt', t.addonAmount AS 'amt ', " .
            "t.addonChipCount AS 'chips ', t.rake, l.map AS mapHide, l.mapLink AS map, CASE WHEN ec.enteredCount IS NULL THEN 0 ELSE ec.enteredCount END AS enteredCount, u.active, t.specialTypeId, st.typeDescription AS std " .
            "FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerId AND u.id = " . $params[0] .
            " INNER JOIN poker_tournament t ON t.tournamentId = r.tournamentId AND r.place = 1 " .
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
            "INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
          // "INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
          // "INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS enteredCount " . "           FROM poker_result " . "           WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " . "           AND place <> 0 " . "           GROUP BY tournamentId) ec ON t.tournamentId = ec.tournamentId " . "ORDER BY date, 'start time'";
          break;
        case "tournamentsPlayed":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(*) AS tourneys " .
            "FROM poker_user u " .
            "INNER JOIN poker_result r ON u.id = r.playerId AND r.place > 0 " .
            "GROUP BY u.id <REPLACE>";
          if ($rank) {
            $whereClause = "<REPLACE>";
            $orderByFieldName = "tourneys DESC, " . $this->buildOrderByName(null);
            $selectFieldNames = "id, name, tourneys";
            $query = $this->modifyQueryAddRank($query, $whereClause, "tourneys", $selectFieldNames, $orderByFieldName);
          }
          break;
        case "tournamentsPlayedByType":
          $query =
            "SELECT lt.limitTypeId, lt.limitTypeName AS 'limit type', gt.gameTypeId, gt.gameTypeName AS 'game type', t.maxRebuys AS rebuys, CASE WHEN t.addonAmount > 0 THEN '" . Constant::$FLAG_YES . "' ELSE '" . Constant::$FLAG_NO . "' END AS addon, COUNT(*) AS count " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_limit_type lt ON lt.limitTypeId = t.limitTypeId " .
            "INNER JOIN poker_game_type gt ON gt.gameTypeId = t.gameTypeId " .
            "INNER JOIN poker_result r ON t.tournamentId = r.tournamentId AND r.statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' AND r.playerId = " . $params[0] .
            " GROUP BY lt.limitTypeId, lt.limitTypeName, gt.gameTypeId, gt.gameTypeName, t.maxRebuys, addon";
          break;
        case "tournamentsPlayedFirst":
          $query =
            "SELECT MIN(t.tournamentDate) AS date " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_result r ON t.tournamentId = r.tournamentId AND r.playerId = " . $params[0];
          break;
        case "tournamentIdList":
          $query =
            "SELECT tournamentId " .
            "FROM poker_tournament " .
            "ORDER BY tournamentDate, startTime";
          break;
        case "userAbsencesByTournamentId":
          $query =
            "SELECT pta.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name " .
//             "FROM poker_tournament_absence pta INNER JOIN poker_tournament pt ON pta.tournamentId = pt.tournamentId AND tournamentDesc LIKE '%" . Constant::$DESCRIPTION_CHAMPIONSHIP . "%' AND YEAR(tournamentDate) = " . $params[0] .
            "FROM poker_tournament_absence pta INNER JOIN poker_tournament pt ON pta.tournamentId = pt.tournamentId AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' AND YEAR(tournamentDate) = " . $params[0] .
            " LEFT JOIN poker_special_type st ON pt.specialTypeId = st.typeId" .
            " INNER JOIN poker_user u ON pta.playerId = u.id";
          break;
        case "userPaidByTournamentId":
          $query =
            "SELECT p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, p.username, p.password, p.email, p.administrator, p.registration_date, p.approval_date, p.approval_userid, p.rejection_date, p.rejection_userid, p.active, p.selector, p.token, p.expires " .
            "FROM poker_user p " .
            "INNER JOIN poker_result r ON p.id = r.playerId AND r.tournamentId = " . $params[0] . " AND r.buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "ORDER BY " . $this->buildOrderByName(null);
          break;
        case "userActive":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.email " .
            "FROM poker_user u " .
            "WHERE u.active = '1' " .
            "ORDER BY " . $this->buildOrderByName("u");
          break;
        case "userSelectAll":
        case "userSelectOneById":
        case "userSelectOneByUsername":
        case "userSelectOneByEmail":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.username, u.password, u.email, u.administrator AS admin, u.registration_date AS 'Reg Date', u.approval_date AS 'App Date', u.approval_userid AS 'App User', CONCAT(ua.first_name, ' ', ua.last_name) AS 'App Name', u.rejection_date AS 'Reject Date', u.rejection_userid AS 'Reject User', CONCAT(ur.first_name, ' ', ur.last_name) AS 'Reject Name', u.active " .
            "FROM poker_user u " .
            "LEFT JOIN poker_user ua ON u.approval_userid = ua.id " .
            "LEFT JOIN poker_user ur ON u.rejection_userid = ur.id";
          if ("userSelectAll" != $dataName && "userSelectOneById" != $dataName) {
            $query .= " WHERE u.active <> 0";
          }
          if ("userSelectOneById" == $dataName) {
            $query .= " WHERE u.id = " . $params[0];
          } else if ("userSelectOneByUsername" == $dataName) {
            $query .= " AND u.username = '" . $params[0] . "'";
          } else if ("userSelectOneByEmail" == $dataName) {
            $query .= " AND u.email = '" . $params[0] . "'";
          }
          $query .= " ORDER BY " . $this->buildOrderByName("u");
          break;
        case "usersSelectForEmailNotifications":
          $query =
            "SELECT id, CONCAT(first_name, ' ', last_name) AS name, email " .
            "FROM poker_user u " .
            "WHERE active = 1 " .
            "AND approval_date IS NOT NULL " .
            "AND rejection_date IS NULL " .
            "AND email <>  '' " .
            "ORDER BY id";
          break;
        case "usersSelectForApproval":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.email, u.username, u.rejection_date AS \"Rejection Date\", CONCAT(u2.first_name, ' ', u2.last_name) AS \"Rejection Name\"" .
            "FROM poker_user u " .
            "LEFT JOIN poker_user u2 ON u.rejection_userid = u2.id " .
            "WHERE u.approval_date IS NULL";
          break;
        case "waitListedPlayerByTournamentId":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.email, t.maxPlayers " .
            "FROM poker_user u " .
            "INNER JOIN poker_result r ON u.id = r.playerId AND r.tournamentId = " . $params[0] . $this->buildUserActive("AND", "u") .
            " INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND r.registerOrder = t.maxPlayers";
          break;
        case "winnersForSeason":
        case "winsForUser":
        case "winsTotalAndAverageForSeasonForUser":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, IFNULL(wins, 0) AS wins, IFNULL(wins / trnys, 0) AS avg, IFNULL(trnys, 0) AS trnys, u.active " .
            "FROM poker_user u " .
            "LEFT JOIN (SELECT r.playerId, COUNT(*) AS wins, numTourneys AS trnys " .
            "           FROM poker_tournament t " .
            "           INNER JOIN poker_result r ON t.tournamentId = r.tournamentId AND r.place = 1 ";
          if ("winsForUser" != $dataName && isset($params[0]) && isset($params[1])) {
            $query .= "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "            INNER JOIN (SELECT r.playerId, COUNT(*) AS numTourneys " .
            "                        FROM poker_result r " .
            "                        INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND r.place > 0 ";
          if ("winsForUser" != $dataName && isset($params[0]) && isset($params[1])) {
            $query .= "                        AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
          $query .=
            "                        GROUP BY r.playerId) nt ON r.playerId = nt.playerId " .
            "            GROUP BY r.playerId) a ON u.id = a.playerId " . $this->buildUserActive("AND", "u");
          if ("winsTotalAndAverageForSeasonForUser" == $dataName || "winsForUser" == $dataName) {
            $whereClause = "WHERE u.id = " . $params[2];
            $query .= " WHERE u.id = " . $params[2];
          } else if ("winnersForSeason" == $dataName) {
            $query .= " WHERE wins > 0";
          }
          if ("winsForUser" != $dataName && "winsTotalAndAverageForSeasonForUser" != $dataName) {
            $query .= " ORDER BY wins DESC, " . $this->buildOrderByName(null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "wins DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "wins";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, wins, avg, trnys";
            $query = $this->modifyQueryAddRank($query, $whereClause, $selectFieldName, $selectFieldNames, $orderByFieldName);
          }
          break;
        case "winnersSelectAll":
        case "winnersSelectAllStats":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(*) AS wins " .
            "FROM poker_result r " .
            "INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId AND r.place = 1";
          if (isset($params[0]) && isset($params[1])) {
            $query .= " AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "'";
          }
          $query .=
            " INNER JOIN poker_user u ON r.playerId = u.id " .
            "GROUP BY u.name " .
            "ORDER BY ";
          if ("winnersSelectAll" == $dataName) {
            $query .= "wins DESC, ";
          }
          $query .= $this->buildOrderByName(null);
          break;
        case "userPasswordReset":
          $query =
            "SELECT token " .
            "FROM poker_user " .
            "WHERE username = '" . $params[0] . "' " .
            "AND email = '" . $params[1] . "'";
          break;
      }
      if (isset($limitCount)) {
        $query .= " LIMIT " . $limitCount;
      }
      if ($this->isDebug()) {
        echo "<br>" . $query;
      }
      if ($returnQuery) {
        return $query;
      } else {
        $queryResult = $this->getConnection()->query($query);
        if ($queryResult) {
          $numRecords = $queryResult->rowCount();
          $hasRecords = 0 < $numRecords;
          if ($hasRecords) {
            $ctr = 0;
            while ($row = $queryResult->fetch(PDO::FETCH_BOTH)) {
              $resultListForPerson = array();
              switch ($dataName) {
                case "autoRegisterHost":
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["tournamentId"]);
                  $dateTime = new DateTime($this->isDebug(), null, $row["tournamentDate"]);
                  $tournament->setDate($dateTime);
                  $dateTime = new DateTime($this->isDebug(), null, $row["startTime"]);
                  $tournament->setStartTime($dateTime);
                  $location = new Location();
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  $user->setName($row["name"]);
                  $user->setEmail($row["email"]);
                  $address = new Address();
                  $address->setAddress($row["address"]);
                  $address->setCity($row["city"]);
                  $address->setState($row["state"]);
                  $address->setZip((int) $row["zipCode"]);
                  $address->setPhone($row["phone"]);
                  $user->setAddress($address);
                  $location->setUser($user);
                  $tournament->setLocation($location);
                  array_push($resultList, $tournament);
                  break;
                case "bountiesForSeason":
                  $resultBounty = new ResultBounty();
                  $bounty = new Bounty();
                  if ("points" == $row["type"]) {
                    $bounty->setId(1);
                    $bounty->setName("Bounty A");
                  } else {
                    $bounty->setId(2);
                    $bounty->setName("Bounty B");
                  }
                  $bounty->setDescription($row["type"]);
                  $resultBounty->setBounty($bounty);
                  $user = new User();
                  $user->setName($row["name"]);
                  $user->setActive($row["active"]);
                  $resultBounty->setUser($user);
                  array_push($resultList, $resultBounty);
                  break;
                case "bountyCountSelectByTournament":
                  $values = array(
                    $row["bountyName"],
                    $row["bountyDesc"],
                    $row["cnt"]);
                  array_push($resultList, $values);
                  break;
                case "bountyEarnings":
                  $values = array(
                    $row["knockedOutBy"],
                    $row["name"],
                    $row["winnings"],
                    $row["cost"],
                    $row["active"],
                    $row["winnerActive"]);
                  array_push($resultList, $values);
                  break;
                case "bountySelectAll":
                  $bounty = new Bounty();
                  $bounty->setId((int) $row["bountyId"]);
                  $bounty->setName($row["bountyName"]);
                  $bounty->setDescription($row["bountyDesc"]);
                  array_push($resultList, $bounty);
                  break;
                case "bullyForUser":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["active"]);
                  array_push($resultList, $row["numKOs"]);
                  break;
                case "championshipByYearByEarnings":
                  $object = array();
                  array_push($object, (int) $row["yr"]);
                  array_push($object, (int) $row["id"]);
                  array_push($object, $row["name"]);
                  array_push($object, (int) $row["earnings"]);
                  array_push($resultList, $object);
                  break;
                case "championshipQualifiedPlayers":
                  $object = array();
                  array_push($object, $row["name"]);
                  array_push($object, (int) $row["points"]);
                  array_push($object, (int) $row["bonus points"]);
                  array_push($object, (int) $row["tourneys"]);
                  array_push($object, (int) $row["average points"]);
                  array_push($resultList, $object);
                  break;
                case "countTournamentForDates":
                  $object = array();
                  array_push($resultList, (int) $row["cnt"]);
                  break;
                case "earningsAverageForSeason":
                case "earningsTotalForChampionship":
                case "earningsTotalForSeason":
                case "earningsTotalAndAverageForSeasonForUser":
                case "earningsTotalAndAverageForUser":
                  if ("earningsTotalAndAverageForSeasonForUser" != $dataName && "earningsTotalAndAverageForUser" != $dataName) {
                    array_push($resultList, $row["name"]);
                  }
                  array_push($resultList, $row["earns"]);
                  if ("earningsTotalForChampionship" != $dataName) {
                    array_push($resultList, $row["avg"]);
                    array_push($resultList, $row["trnys"]);
                  }
                  array_push($resultList, $row["active"]);
                  break;
                case "feeSelectAll":
                  $fee = new Fee();
                  $fee->setYear((int) $row["year"]);
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  $fee->setUser($user);
                  $fee->setAmount((int) $row["amount"]);
                  array_push($resultList, $fee);
                  break;
                case "finishesSelectAllByPlayerId":
                  array_push($resultList, $row["place"]);
                  array_push($resultList, $row["finishes"]);
                  array_push($resultList, $row["avg"]);
                  break;
                case "foodByTournamentIdAndPlayerId":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["email"]);
                  array_push($resultList, $row["food"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "gameTypeSelectAll":
                  $gameType = new GameType();
                  $gameType->setId((int) $row["gameTypeId"]);
                  $gameType->setName($row["gameTypeName"]);
                  array_push($resultList, $gameType);
                  break;
                case "groupSelectAll":
                case "groupSelectAllById":
                  $group = new Group();
                  $group->setId((int) $row["id"]);
                  $group->setName($row["name"]);
//                   $group->setGroup($group);
//                   $group->setPayouts($this->getPayouts($row["groupId"], null, true));
                  array_push($resultList, $group);
                  break;
                case "groupPayoutSelectAll":
                case "groupPayoutSelectAllById":
                  $groupPayout = new GroupPayout();
                  $group = new Group();
                  $group->setId((int) $row["id"]);
                  $group->setName($row["group name"]);
                  $groupPayout->setGroup($group);
                  $payout = new Payout();
                  $payout->setId($row["payout id"]);
                  $payout->setName($row["payout name"]);
                  $payouts = array($payout);
                  $groupPayout->setPayouts($payouts);
                  array_push($resultList, $groupPayout);
                  break;
                case "groupSelectNameList":
                  $values = array($row["groupId"], $row["groupName"]);
                  array_push($resultList, $values);
                  break;
                case "knockoutsAverageForSeason":
                case "knockoutsTotalForSeason":
                case "knockoutsTotalAndAverageForSeasonForUser":
                case "knockoutsTotalAndAverageForUser":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["kO"]);
                  array_push($resultList, $row["avg"]);
                  array_push($resultList, $row["trnys"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "limitTypeSelectAll":
                  $limitType = new LimitType();
                  $limitType->setId((int) $row["limitTypeId"]);
                  $limitType->setName($row["limitTypeName"]);
                  array_push($resultList, $limitType);
                  break;
                case "locationSelectAll":
                case "locationSelectById":
                case "locationSelectAllCount":
                  $location = new Location();
                  $location->setId((int) $row["id"]);
                  if ("locationSelectAllCount" == $dataName) {
                    $location->setName($row["location"]);
                  } else {
                    $location->setName($row["name"]);
                  }
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  if ("locationSelectById" != $dataName) {
                    $user->setName($row["host"]);
                    $user->setActive($row["userActive"]);
                  }
                  $address = new Address();
                  $address->setAddress($row["address"]);
                  $address->setCity($row["city"]);
                  $address->setState($row["state"]);
                  $address->setZip((int) $row["zip"]);
                  $address->setPhone($row["phone"]);
                  $user->setAddress($address);
                  $location->setUser($user);
                  $location->setActive($row["active"]);
                  if ("locationSelectAllCount" == $dataName) {
                    $location->setCount((int) $row["count"]);
                  }
                  array_push($resultList, $location);
                  break;
                case "locationSelectMaxId":
                  array_push($resultList, (int) $row["id"]);
                  break;
                case "login":
                  array_push($resultList, $row["password"]);
                  break;
                case "nemesisForUser":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["active"]);
                  array_push($resultList, $row["numKOs"]);
                  break;
//                 case "payoutSelectAll":
//                 case "payoutSelectAllById":
// //                   $payouts = $this->getPayouts(null, $row["id"], false);
// //                   array_push($resultList, $payouts);
//                   $resultList = $this->getPayouts(null, null, false);
//                   break;
                case "payoutSelectMaxId":
                  array_push($resultList, (int) $row["id"]);
                  break;
                case "payoutSelectNameList":
                  $values = array(
                    $row["payoutId"],
                    $row["payoutName"]);
                  array_push($resultList, $values);
                  break;
                case "pointsAverageForSeason":
                case "pointsTotalForSeason":
                case "pointsTotalAndAverageForSeasonForUser":
                case "pointsTotalAndAverageForUser":
                  // array_push($resultList, $row["first_name"] . " " . $row["last_name"]);
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["pts"]);
                  array_push($resultList, $row["avg"]);
                  array_push($resultList, $row["trnys"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "prizePoolForSeason":
                  array_push($resultList, $row["total"]);
                  break;
                case "registrationWaitList":
                  $values = array(
                    $row["name"],
                    $row["email"],
                    $row["maxPlayers"],
                    $row["active"]);
                  array_push($resultList, $values);
                  break;
                case "resultIdMax":
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "resultBountyByTournamentIdAndBountyId":
                  $values = array(
                    $row["1"]);
                  array_push($resultList, $values);
                  break;
                case "resultSelectAll":
                case "resultSelectOneByTournamentIdAndPlayerId":
                case "resultSelectRegisteredByTournamentId":
                case "resultSelectAllFinishedByTournamentId":
                case "resultSelectPaidByTournamentId":
                case "resultSelectPaidNotEnteredByTournamentId":
                  $result = new Result();
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["tournamentId"]);
                  $result->setTournament($tournament);
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  $user->setName($row["name"]);
                  $user->setEmail($row["email"]);
                  $user->setActive($row["active"]);
                  $result->setUser($user);
                  $status = new Status();
                  $status->setCode($row["statusCode"]);
                  $status->setName($row["status"]);
                  $result->setStatus($status);
                  $result->setRegisterOrder((int) $row["registerOrder"]);
                  $booleanString = new BooleanString($row["buyinPaid"]);
                  $result->setBuyinPaid($booleanString->getBoolean());
                  $booleanString = new BooleanString($row["rebuyPaid"]);
                  $result->setRebuyPaid($booleanString->getBoolean());
                  $booleanString = new BooleanString($row["addon"]);
                  $result->setAddonPaid($booleanString->getBoolean());
                  $result->setRebuyCount((int) $row["rebuy"]);
                  $booleanString = new BooleanString($row["addonFlag"]);
                  $result->setAddonFlag($booleanString->getBoolean());
                  $result->setPlace((int) $row["place"]);
                  $user = new User();
                  $user->setId((int) $row["knockedOutBy"]);
                  $user->setActive($row["knockedOutActive"]);
                  if (isset($row["knocked out by"])) {
                    $user->setName($row["knocked out by"]);
                  }
                  $result->setKnockedOutBy($user);
                  $result->setFood($row["food"]);
                  array_push($resultList, $result);
                  break;
                case "resultSelectAllDuring":
                  array_push($resultList, (int) $row["place"]);
                  break;
                case "resultSelectLastEnteredDuring":
                  array_push($resultList, (int) $row["playerId"]);
                  array_push($resultList, $row["name"]);
                  break;
                case "resultSelectAllByTournamentId":
                  array_push($resultList, (int) $row["place"]);
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["rebuy"]);
                  array_push($resultList, $row["addon"]);
                  array_push($resultList, (float) $row["earnings"]);
                  array_push($resultList, (int) $row["total pts"]);
                  array_push($resultList, $row["knocked out by"]);
                  array_push($resultList, $row["active"]);
                  array_push($resultList, $row["knockOutActive"]);
                  break;
                case "resultAllOrderedPoints":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, (int) $row["pts"]);
                  array_push($resultList, (int) $row["avg"]);
                  array_push($resultList, (int) $row["tourneys"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "resultAllOrderedEarnings":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, (int) $row["earnings"]);
                  array_push($resultList, (int) $row["max"]);
                  array_push($resultList, (int) $row["avg"]);
                  array_push($resultList, (int) $row["tourneys"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "resultAllOrderedKnockouts":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, (int) $row["knockouts"]);
                  array_push($resultList, (int) $row["avg"]);
                  array_push($resultList, (int) $row["best"]);
                  array_push($resultList, (int) $row["tourneys"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "resultAllOrderedKnockoutsStats":
                  $resultListForPerson = array();
                  $resultListForPerson["name"] = $row["name"];
                  $resultListForPerson["kOs"] = $row["kOs"];
                  $resultListForPerson["avgKo"] = $row["avgKo"];
                  $resultListForPerson["bestKo"] = $row["bestKo"];
                  $resultListForPerson["tourneys"] = $row["tourneys"];
                  $resultListForPerson["active"] = $row["active"];
                  $resultList[$row["name"]] = $resultListForPerson;
                  break;
                case "resultAllOrderedSummary":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, (int) $row["#"]);
                  array_push($resultList, (int) $row["pts"]);
                  array_push($resultList, (int) $row["count"]);
                  array_push($resultList, (int) $row["%"]);
                  array_push($resultList, (int) $row["avg"]);
                  array_push($resultList, (int) $row["best"]);
                  array_push($resultList, (int) $row["worst"]);
                  array_push($resultList, (int) $row["buyins"]);
                  array_push($resultList, (int) $row["rebuys"]);
                  array_push($resultList, (int) $row["addons"]);
                  array_push($resultList, (int) $row["earnings"]);
                  array_push($resultList, (int) $row["net(+/-)"]);
                  array_push($resultList, (int) $row["net %"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "resultAllOrderedSummaryStats":
                  $resultListForPerson = array();
                  $resultListForPerson["name"] = $row["name"];
                  $resultListForPerson["tourneys"] = $row["tourneys"];
                  $resultListForPerson["points"] = $row["points"];
                  $resultListForPerson["AvgPoints"] = $row["AvgPoints"];
                  $resultListForPerson["count"] = $row["count"];
                  $resultListForPerson["%"] = $row["%"];
                  $resultListForPerson["avg"] = $row["avg"];
                  $resultListForPerson["best"] = $row["best"];
                  $resultListForPerson["worst"] = $row["worst"];
                  $resultListForPerson["buyins"] = $row["buyins"];
                  $resultListForPerson["rebuys"] = $row["rebuys"];
                  $resultListForPerson["addons"] = $row["addons"];
                  $resultListForPerson["earnings"] = $row["earnings"];
                  $resultListForPerson["net(+/-)"] = $row["net(+/-)"];
                  $resultListForPerson["active"] = $row["active"];
                  $resultList[(string) $row["name"]] = $resultListForPerson;
                  break;
                case "resultBountySelectAll":
                  $resultBounty = new ResultBounty();
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["tournamentId"]);
                  $resultBounty->setTournament($tournament);
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  $user->setActive($row["active"]);
                  $resultBounty->setUser($user);
                  $bounty = new Bounty();
                  $bounty->setId((int) $row["bountyId"]);
                  $resultBounty->setBounty($bounty);
                  array_push($resultList, $resultBounty);
                  break;
                case "resultBountyCurrent":
                  $values = array(
                    $row["bountyId"],
                    $row["playerId"]);
                  array_push($resultList, $values);
                  break;
                case "resultPaidUserCount":
                  array_push($resultList, (int) $row["cnt"]);
                  break;
                case "seasonActiveCount":
                case "seasonDateCheckCount":
                  array_push($resultList, (int) $row["cnt"]);
                  break;
                case "seasonSelectAll":
                case "seasonSelectOneById":
                case "seasonSelectOneByIdAndDesc":
                case "seasonSelectOneByActive":
                  $startDateTime = new DateTime($this->isDebug(), null, $row["start date"]);
                  $endDateTime = new DateTime($this->isDebug(), null, $row["end date"]);
                  $season = new Season($this->isDebug(), $row["id"], $row["description"], $startDateTime, $endDateTime, $row["active"]);
                  array_push($resultList, $season);
                  break;
                case "statusSelectPaid":
                  $values = array($row["id"], $row["name"], $row["buyin status"], $row["rebuy status"], $row["rebuyCount"], $row["addon status"]);
                  array_push($resultList, $values);
                  break;
                case "statusSelectAll":
                  $status = new Status();
                  $status->setId((int) $row["statusCode"]);
                  array_push($resultList, $status);
                  break;
                case "structureSelectAll":
                case "structurePayout":
                  if ("structureSelectAll" == $dataName) {
                    $structure = new Structure();
                    $payout = new Payout();
                    $payout->setId((int) $row["payoutId"]);
                    $structure->setPayout($payout);
                    $structure->setPlace((int) $row["place"]);
                    $structure->setPercentage((float) $row["percentage"]);
                    array_push($resultList, $structure);
                  } else if ("structurePayout" == $dataName) {
                    $values = array(
                      $row["place"],
                      $row["percentage"],
                      (float) $row["pay"]);
                    array_push($resultList, $values);
                  }
                  break;
                case "tournamentIdMax":
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "tournamentAll":
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["tournamentId"]);
                  $tournament->setDescription($row["tournamentDesc"]);
                  $dateTime = new DateTime($this->isDebug(), null, $row["tournamentDate"]);
                  $tournament->setDate($dateTime);
                  array_push($resultList, $tournament);
                  break;
                case "tournamentSelectAll":
                case "tournamentSelectAllByDateAndStartTime":
                case "tournamentSelectOneById":
                case "tournamentSelectAllForRegistration":
                case "tournamentSelectAllForBuyins":
                case "tournamentSelectAllOrdered":
                case "tournamentsWonByPlayerId":
                case "tournamentsSelectForEmailNotifications":
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["id"]);
                  $tournament->setDescription($row["description"]);
                  $tournament->setComment($row["comment"]);
                  $limitType = new LimitType();
                  $limitType->setId((int) $row["limitTypeId"]);
                  $limitType->setName($row["limit"]);
                  $tournament->setLimitType($limitType);
                  $gameType = new GameType();
                  $gameType->setId((int) $row["gameTypeId"]);
                  $gameType->setName($row["type"]);
                  $tournament->setGameType($gameType);
                  $tournament->setChipCount((int) $row["chips"]);
                  $location = new Location();
                  $location->setId((int) $row["locationId"]);
                  $location->setName($row["location"]);
                  $location->setMap($row["mapHide"]);
                  $location->setMapName($row["map"]);
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  if ("tournamentsWonByPlayerId" != $dataName) {
                    $user->setName($row["playerName"]);
                  }
                  $address = new Address();
                  $address->setAddress($row["address"]);
                  $address->setCity($row["city"]);
                  $address->setState($row["state"]);
                  $address->setZip((int) $row["zipCode"]);
                  $address->setPhone($row["phone"]);
                  $user->setAddress($address);
                  $location->setUser($user);
                  $tournament->setLocation($location);
                  $dateTime = new DateTime($this->isDebug(), null, $row["date"]);
                  $tournament->setDate($dateTime);
                  $dateTime = new DateTime($this->isDebug(), null, $row["start"]);
                  $tournament->setStartTime($dateTime);
                  $dateTime = new DateTime($this->isDebug(), null, $row["end"]);
                  $tournament->setEndTime($dateTime);
                  $tournament->setBuyinAmount((int) $row["buyin"]);
                  if (null != $tournament->getSpecialType() && strpos($tournament->getSpecialType()->getDescription(), Constant::$DESCRIPTION_CHAMPIONSHIP) === false) {
                    $tournament->setMaxPlayers((int) $row["max players"]);
                  } else {
                    $databaseResult = new DatabaseResult($this->isDebug());
                    $databaseResult->setDebug(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
                    $params = array(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat());
                    $tournament->setMaxPlayers((int) count($databaseResult->getChampionshipQualifiedPlayers($params)));
                  }
                  $tournament->setMaxRebuys((int) $row["max"]);
                  $tournament->setRebuyAmount((int) $row["amt"]);
                  $tournament->setAddonAmount((int) $row["amt "]);
                  $tournament->setAddonChipCount((int) $row["chips "]);
                  if ("tournamentsWonByPlayerId" != $dataName) {
                    $group = new Group();
                    $group = new Group();
                    $group->setId((int) $row["groupId"]);
                    $group->setName($row["name"]);
                    $group->setGroup($group);
                    $group->setPayouts($this->getPayouts($row["groupId"], null, true));
                    $tournament->setGroup($group);
                  }
                  $tournament->setRake((float) ($row["rake"] * 100));
                  // $tournament->setDirections($row["map"]);
                  $tournament->setEnteredCount((int) $row["enteredCount"]);
                  if ("tournamentsWonByPlayerId" != $dataName) {
                    $tournament->setRegisteredCount((int) $row["registeredCount"]);
                    $tournament->setBuyinsPaid((int) $row["buyinsPaid"]);
                    $tournament->setRebuysPaid((int) $row["rebuysPaid"]);
                    $tournament->setRebuysCount((int) $row["rebuysCount"]);
                    $tournament->setAddonsPaid((int) $row["addonsPaid"]);
                  }
                  $specialType = new SpecialType($this->isDebug(), $row["specialTypeId"], $row["std"]);
                  $tournament->setSpecialType($specialType);
                  array_push($resultList, $tournament);
                  break;
                case "tournamentSelectAllRegistrationStatus":
                  array_push($resultList, (int) $row["id"]);
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["status"]);
                  array_push($resultList, (int) $row["order"]);
                  array_push($resultList, $row["active"]);
                  break;
                case "tournamentSelectAllDuring":
                  array_push($resultList, (int) $row["tournamentId"]);
                  $dateTime = new DateTime($this->isDebug(), null, $row["tournamentDate"]);
                  array_push($resultList, $dateTime);
                  $dateTime = new DateTime($this->isDebug(), null, $row["startTime"]);
                  array_push($resultList, $dateTime);
                  array_push($resultList, $row["locationName"]);
                  array_push($resultList, (int) $row["buyinsPaid"]);
                  break;
                case "seasonSelectAllChampionship":
                  $startDateTime = new DateTime($this->isDebug(), null, $row["seasonStartDate"]);
                  $endDateTime = new DateTime($this->isDebug(), null, $row["seasonEndDate"]);
                  $season = new Season($this->isDebug(), $row["id"], $row["seasonDescription"], $startDateTime, $endDateTime, $row["seasonActive"]);
                  array_push($resultList, $season);
                  break;
                case "specialTypeSelectAll":
                case "specialTypeSelectOneById":
                  $specialType = new SpecialType($this->isDebug(), $row["id"], $row["description"]);
                  array_push($resultList, $specialType);
                  break;
                case "tournamentSelectAllYearsPlayed":
                  array_push($resultList, (int) $row["year"]);
                  break;
                case "tournamentsSelectForEmailNotifications":
                  break;
                case "tournamentBountySelectAll":
                case "tournamentBountySelectByTournamentId":
                  $tournamentBounty = new TournamentBounty();
                  $tournament = new Tournament();
                  $tournament->setId((int) $row["tournamentId"]);
                  $tournamentBounty->setTournament($tournament);
                  $bounty = new Bounty();
                  $bounty->setId((int) $row["bountyId"]);
                  $bounty->setName($row["bountyName"]);
                  $bounty->setDescription($row["bountyDesc"]);
                  $tournamentBounty->setBounty($bounty);
                  $user = new User();
                  $user->setId((int) $row["playerId"]);
                  $user->setName($row["name"]);
                  $user->setActive($row["active"]);
                  $tournamentBounty->setUser($user);
                  array_push($resultList, $tournamentBounty);
                  break;
                case "tournamentsPlayedByPlayerIdAndDateRange":
                  array_push($resultList, (int) $row["numPlayed"]);
                  break;
                case "tournamentsPlayedByType":
                  $object = array();
                  $limitType = new LimitType();
                  $limitType->setId((int) $row["limitTypeId"]);
                  $limitType->setName($row["limit type"]);
                  array_push($object, $limitType);
                  array_push($resultList, $object);
                  $gameType = new GameType();
                  $gameType->setId((int) $row["gameTypeId"]);
                  $gameType->setName($row["game type"]);
                  array_push($object, $gameType);
                  array_push($resultList, $object);
                  array_push($object, (int) $row["count"]);
                  array_push($object, (int) $row["rebuys"]);
                  break;
                case "tournamentsPlayedFirst":
                  $dateTime = new DateTime($this->isDebug(), null, $row["date"]);
                  array_push($resultList, $dateTime);
                  break;
                case "tournamentIdList":
                  $object = array();
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "userAbsencesByTournamentId":
                  $values = array(
                    $row["playerId"],
                    $row["name"]);
                  array_push($resultList, $values);
                  break;
                case "userActive":
                  $user = new User();
                  $user->setId((int) $row["id"]);
                  $name = explode(" ", $row["name"]);
                  $user->setFirstName($name[0]);
                  if (1 < count($name)) {
                    $lastName = "";
                    for ($i = 1; $i < count($name); $i ++) {
                      $lastName .= $name[$i] . " ";
                    }
                    $user->setLastName(substr($lastName, 0, strlen($lastName) - 1));
                  }
                  $user->setEmail($row["email"]);
                  array_push($resultList, $user);
                  break;
                case "userSelectAll":
                case "userSelectOneById":
                case "userSelectOneByUsername":
                case "userSelectOneByEmail":
                case "userPaidByTournamentId":
                  $user = new User();
                  $user->setId((int) $row["id"]);
                  $name = explode(" ", $row["name"]);
                  $user->setFirstName($name[0]);
                  if (1 < count($name)) {
                    $user->setLastName($name[1]);
                  }
                  $user->setUsername($row[2]);
                  $user->setPassword($row[3]);
                  $user->setEmail($row[4]);
                  $user->setAdministrator($row[5]);
                  $user->setRegistrationDate($row[6]);
                  $user->setApprovalDate($row[7]);
                  $user->setApprovalUserid($row[8]);
                  $user->setApprovalName($row[9]);
                  $user->setRejectionDate($row[10]);
                  $user->setRejectionUserid($row[11]);
                  $user->setRejectionName($row[12]);
                  $user->setActive($row[13]);
                  // $user->setResetSelector($row["reset_selector"]);
                  // $user->setResetToken($row["reset_token"]);
                  // $user->setResetExpires($row["reset_expires"]);
                  // $user->setRememberSelector($row["remember_selector"]);
                  // $user->setRememberToken($row["remember_token"]);
                  // $user->setRememberExpires($row["remember_expires"]);
                  // $user->setType($row["usertype"]);
                  array_push($resultList, $user);
                  break;
                case "usersSelectForEmailNotifications":
                  $user = new User();
                  $user->setId((int) $row["id"]);
                  $user->setName($row["name"]);
                  $user->setEmail($row["email"]);
                  array_push($resultList, $user);
                  break;
                case "waitListedPlayerByTournamentId":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["email"]);
                  array_push($resultList, (int) $row["maxPlayers"]);
                  break;
                case "winnersForSeason":
                case "winsForUser":
                case "winsTotalAndAverageForSeasonForUser":
                  $object = array();
                  array_push($object, (int) $row["id"]);
                  array_push($object, $row["name"]);
                  array_push($object, (int) $row["wins"]);
                  array_push($object, (int) $row["avg"]);
                  array_push($object, (int) $row["trnys"]);
                  array_push($object, $row["active"]);
                  array_push($resultList, $object);
                  break;
                case "winnersSelectAll":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["active"]);
                  array_push($resultList, (int) $row["wins"]);
                  break;
                case "winnersSelectAllStats":
                  $resultListForPerson = array();
                  $resultListForPerson["name"] = $row["name"];
                  $resultListForPerson["active"] = $row["active"];
                  $resultListForPerson["wins"] = $row["wins"];
                  $resultList[(string) $row["name"]] = $resultListForPerson;
                case "userPasswordReset":
                  array_push($resultList, $row["token"]);
                  break;
              }
              $ctr ++;
            }
            if ($dataName == "payoutSelectAll" || $dataName == "payoutSelectAllById") {
              $resultList = $this->getPayouts(null, $dataName == "payoutSelectAllById" ? $params[0] : null, $dataName == "payoutSelectAllById" ? true : false);
            }
          }
          $queryResult->closeCursor();
        }
      }
    return $resultList;
  }
  // $groupId is group id
  // $payoutId is payout id
  // $structureFlag is boolean true for structures
  private function getPayouts($groupId, $payoutId, $structureFlag) {
    $payouts = array();
    $queryNested =
      "SELECT p.payoutId AS id, p.payoutName AS name, p.bonusPoints AS 'bonus pts', p.minPlayers AS 'min players', p.maxPlayers AS 'max players' " .
      "FROM poker_payout p ";
    if (isset($groupId)) {
      $queryNested .=
        " INNER JOIN poker_group_payout gp ON gp.payoutId = p.payoutId" .
        " WHERE gp.groupId = " . $groupId;
    } else if (isset($payoutId)) {
      $queryNested .= " WHERE p.payoutId = " . $payoutId;
    }
    $queryResultNested = $this->getConnection()->query($queryNested);
    if ($queryResultNested) {
      $numRecords = $queryResultNested->rowCount();
      $hasRecords = 0 < $numRecords;
      if ($hasRecords) {
        $ctr2 = 0;
        while ($rowNested = $queryResultNested->fetch(PDO::FETCH_BOTH)) {
          $payout = new Payout();
          $payout->setBonusPoints((int) $rowNested["bonus pts"]);
          $payout->setId((int) $rowNested["id"]);
          $payout->setName($rowNested["name"]);
          $payout->setMinPlayers((int) $rowNested["min players"]);
          $payout->setMaxPlayers((int) $rowNested["max players"]);
          if ($structureFlag) {
            $queryNested2 =
              "SELECT s.place, s.percentage " .
              "FROM poker_structure s " .
              "WHERE payoutId = " . $rowNested["id"];
            $queryResultNested2 = $this->getConnection()->query($queryNested2);
            if ($queryResultNested2) {
              $numRecords2 = $queryResultNested2->rowCount();
              $hasRecords2 = 0 < $numRecords2;
              if ($hasRecords2) {
                $ctr3 = 0;
                $structures = array();
                while ($rowNested2 = $queryResultNested2->fetch(PDO::FETCH_BOTH)) {
                  $structure = new Structure();
                  $structure->setPercentage((float) $rowNested2["percentage"]);
                  $structure->setPlace((int) $rowNested2["place"]);
                  $structures[$ctr3] = $structure;
                  $ctr3++;
                }
                $payout->setStructures($structures);
              }
            }
            $queryResultNested2->closeCursor();
          }
          $payouts[$ctr2] = $payout;
          $ctr2++;
        }
      }
    }
    $queryResultNested->closeCursor();
    return $payouts;
  }
  // $dataName is name of query
  // $params is array of input parameters
  private function deleteData($dataName, $params = null) {
    $numRecords = 0;
    try {
      switch ($dataName) {
        case "bountyDelete":
          $query = "DELETE FROM poker_result_bounty " . "WHERE tournamentId = " . $params[0] . " AND playerId = " . $params[1] . " AND bountyId = " . $params[2];
          break;
        case "groupDelete":
          $query =
            "DELETE FROM poker_group " .
            "WHERE groupId IN (" . $params[0] . ")";
          break;
        case "groupPayoutDelete":
          $query =
            "DELETE FROM poker_group_payout " .
            "WHERE groupId IN (" . $params[0] . ") " .
            "AND payoutId IN (" . $params[1] . ")";
          break;
        case "locationDelete":
          $query =
            "DELETE FROM poker_location " .
            "WHERE locationId IN (" . $params[0] . ")";
          break;
        case "payoutDelete":
          $query =
            "DELETE FROM poker_payout " .
            "WHERE payoutId IN (" . $params[0] . ")";
          break;
        case "registrationDelete":
          $query =
            "DELETE FROM poker_result " .
            "WHERE tournamentId = " . $params[0] . " AND playerId = " . $params[1];
          break;
        case "resultDelete":
          $query =
            "DELETE FROM poker_result " .
            "WHERE tournamentId IN (" . $params[0] . ")";
          break;
        case "resultBountyDelete":
          $query =
            "DELETE FROM poker_result_bounty " .
            "WHERE tournamentId IN (" . $params[0] . ")";
          break;
        case "seasonDelete":
          $query =
            "DELETE FROM poker_season " .
            "WHERE seasonId IN (" . $params[0] . ")";
          break;
        case "structureDelete":
          $query =
            "DELETE FROM poker_structure " .
            "WHERE payoutId IN (" . $params[0] . ")";
          break;
        case "tournamentDelete":
          $query =
            "DELETE FROM poker_tournament " .
            "WHERE tournamentId IN (" . $params[0] . ")";
          break;
        case "tournamentBountyDeleteByTournamentId":
          $query =
            "DELETE FROM poker_tournament_bounty " .
            "WHERE tournamentId = " . $params[0];
          break;
        case "tournamentBountyDeleteByTournamentIdAndBountyId":
          $query =
            "DELETE FROM poker_tournament_bounty " .
            "WHERE tournamentId = " . $params[0] . " AND bountyId = " . $params[1];
          break;
        case "tournamentBountyDeleteByPlayerId":
          $query =
            "DELETE FROM poker_tournament_bounty " .
            "WHERE tournamentId = " . $params[0] . " AND bountyId = " . $params[1] . " AND playerId = " . $params[2];
          break;
        case "specialTypeDelete":
          $query =
            "DELETE FROM poker_special_type " .
            "WHERE typeId IN (" . $params[0] . ")";
          break;
      }
      if ($this->isDebug()) {
        echo "<br>" . $query;
      }
      $queryResult = $this->getConnection()->query($query);
      if ($queryResult->errorCode() == "00000") {
        $numRecords = $queryResult->rowCount();
      } else if ($queryResult) {
        $numRecords = $queryResult->errorInfo();
      }
    } catch (Exception $e) {
      throw new Exception($e);
    }
    return $numRecords;
  }
  // $dataName is name of query
  // $params is array of input parameters
  private function insertData($dataName, $params = null) {
    $numRecords = 0;
    try {
      switch ($dataName) {
        case "bountyInsert":
          $query = "INSERT INTO poker_result_bounty(tournamentId, playerId, bountyId) " . "VALUES(" . $params[0] . ", " . $params[1] . ", " . $params[2] . ")";
          break;
        case "groupInsert":
          $query = "INSERT INTO poker_group(groupId, groupName) " . "SELECT IFNULL(MAX(groupId), 0) + 1, '" . $params[0] . "' FROM poker_group";
          break;
        case "groupPayoutInsert":
          $query = "INSERT INTO poker_group_payout(groupId, payoutId) VALUES(" . $params[0] . ", " . $params[1] . ")";
          break;
        case "locationInsert":
          $query = "INSERT INTO poker_location(locationId, locationName, playerId, address, city, state, zipCode, phone, active) " . "SELECT IFNULL(MAX(locationId), 0) + 1, '" . $params[0] . "', " . $params[1] . ", '" . $params[2] . "', '" . $params[3] . "', UPPER('" . $params[4] . "'), " . $params[5] . ", " . $params[6] . ", '" . ($params[7] ? Constant::$FLAG_YES : Constant::$FLAG_NO) . "' FROM poker_location";
          break;
        case "payoutInsert":
          $query = "INSERT INTO poker_payout(payoutId, payoutName, bonusPoints, minPlayers, maxPlayers) " . "SELECT IFNULL(MAX(payoutId), 0) + 1, '" . $params[0] . "', " . $params[1] . ", " . $params[2] . ", " . $params[3] . " FROM poker_payout";
          break;
        case "registrationInsert":
          $query = "INSERT INTO poker_result(tournamentId, playerId, rebuyCount, statusCode, registerOrder, addonFlag, place, knockedOutBy, food) " . "SELECT " . $params[0] . ", " . $params[1] . ", 0, '" . Constant::$CODE_STATUS_REGISTERED . "', CASE WHEN MAX(registerOrder) IS NULL THEN 1 ELSE MAX(registerOrder) + 1 END, '" . Constant::$FLAG_NO . "', 0, NULL, " . $params[2] . " FROM poker_result WHERE tournamentId = " . $params[0];
          break;
        case "seasonInsert":
          $query = "INSERT INTO poker_season(seasonId, seasonDescription, seasonStartDate, seasonEndDate, seasonActive) " . "SELECT IFNULL(MAX(seasonId), 0) + 1, '" . $params[0] . "', '" . $params[1] . "', '" . $params[2] . "', '" . (isset($params[3]) ? $params[3] : "0") . "' FROM poker_season";
          break;
        case "structureInsert":
          $query = "INSERT INTO poker_structure(payoutId, place, percentage) VALUES(" . $params[0] . ", " . $params[1] . ", " . $params[2] . ")";
          break;
        case "tournamentInsert":
          $query = "INSERT INTO poker_tournament(tournamentId, tournamentDesc, comment, limitTypeId, gameTypeId, chipCount, locationId, tournamentDate, startTime, endTime, buyinAmount, maxPlayers, maxRebuys, rebuyAmount, addonAmount, addonChipCount, groupId, rake, map, specialTypeId) " . "SELECT IFNULL(MAX(tournamentId), 0) + 1, " . (strlen(trim($params[0])) == 0 ? "null" : "'" . $params[0] . "'") . ", " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") . ", " . $params[2] . ", " . $params[3] . ", " . $params[4] . ", " . $params[5] . ", " . (!isset($params[6]) ? "null" : "'" . $params[6]->getDatabaseFormat() . "'") . ", " . (!isset($params[7]) ? "null" : "'" . $params[7]->getDatabaseTimeFormat() . "'") . ", " . (strlen(trim($params[8])) == 0 ? "null" : "'" . $params[8] . "'") . ", " . $params[9] . ", " . $params[10] . ", " . $params[11] . ", " . $params[12] . ", " . $params[13] . ", " . $params[14] . ", " . $params[15] . ", " . (strlen(trim($params[16])) == 0 ? "null" : "'" . $params[16] . "'") . ", " . (strlen(trim($params[17])) == 0 ? "null" : ("'" . $params[17]) . "'") . ", " . (strlen(trim($params[18])) == 0 ? "null" : "'" . $params[18] . "'") . " FROM poker_tournament";
          break;
        case "tournamentBountyInsert":
          $query = "INSERT INTO poker_tournament_bounty(tournamentId, bountyId, playerId) " . "VALUES(" . $params[0] . ", " . $params[1] . ", " . $params[2] . ")";
          break;
        case "specialTypeInsert":
          $query = "INSERT INTO poker_special_type(typeId, typeDescription) " . "SELECT IFNULL(MAX(typeId), 0) + 1, '" . $params[0] . "' FROM poker_special_type";
          break;
        case "userInsert":
//           $query = "INSERT INTO poker_user(id, first_name, last_name, username, password, email, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, reset_selector, reset_token, reset_expires, remember_selector, remember_token, remember_expires) " .
          $query = "INSERT INTO poker_user(id, first_name, last_name, username, password, email, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, selector, token, expires) " .
          // "SELECT MAX(id) + 1, '" . $params[0] . "', '" . $params[1] . "', '" . $params[2] . "', '" . password_hash($params[3], PASSWORD_DEFAULT) . "', '" . $params[4] . "', 0, CURRENT_TIMESTAMP, null, null, null, null, 0, null, null, null, null, null, null FROM poker_user";
            "SELECT MAX(id) + 1, '" . $params[1] . "', '" . $params[2] . "', '" . $params[3] . "', '" . password_hash($params[4], PASSWORD_DEFAULT) . "', '" . $params[5] . "', " . (isset($params[6]) ? $params[6] : "0") . ", " . (isset($params[7]) ? null : "CURRENT_TIMESTAMP") . ", " . (isset($params[8]) ? "'" . $params[8] . "'" : "null") . ", " . (isset($params[9]) ? "'" . $params[9] . "'" : "null") . ", " . (isset($params[10]) ? "'" . $params[10] . "'" : "null") . ", " . (isset($params[11]) ? $params[11] : "null") . ", " . (isset($params[12]) ? $params[12] : "0") . ", " . (isset($params[13]) ? $params[13] : "null") . ", " . (isset($params[14]) ? $params[14] : "null") . ", " . (isset($params[15]) ? $params[15] : "null") . " FROM poker_user";
          break;
      }
      if ($this->isDebug()) {
        echo "<br>" . $query;
      }
      $queryResult = $this->getConnection()->query($query);
      if ($queryResult->errorCode() == "00000") {
        $numRecords = $queryResult->rowCount();
      } else if ($queryResult) {
        $numRecords = $queryResult->errorInfo();
      }
    } catch (Exception $e) {
      throw new Exception($e);
    }
    return $numRecords;
  }
  // $dataName is query name
  // $params is array of input parameters
  private function updateData($dataName, $params = null) {
    $numRecords = 0;
    try {
      switch ($dataName) {
        case "buyinsUpdate":
          $query =
            "UPDATE poker_result " .
            "SET statusCode = '" . $params[0] . "', " .
            "    buyinPaid = '" . $params[1] . "', " .
            "    rebuyPaid = '" . $params[2] . "', " .
            "    addonPaid = '" . $params[3] . "', " .
            "    rebuyCount = " . $params[4] .
            " WHERE tournamentId = " . $params[5] .
            " AND playerId = " . $params[6];
          break;
        case "groupUpdate":
          $query =
            "UPDATE poker_group " .
            "SET groupName = '" . $params[0] .
            "' WHERE groupId = " . $params[1];
          break;
        case "groupPayoutUpdate":
          $query =
            "UPDATE poker_group_payout " .
            "SET groupId = " . $params[0] .
            ", payoutId = " . $params[1] .
            " WHERE groupId = " . $params[2] .
            " AND payoutId = " . $params[3];
          break;
        case "locationUpdate":
          $query =
            "UPDATE poker_location " .
            "SET locationName = '" . $params[0] .
            "', playerId = " . $params[1] .
            ", address = '" . $params[2] .
            "', city = '" . $params[3] .
            "', state = UPPER('" . $params[4] .
            "'), zipCode = " . $params[5] .
            ", phone = " . $params[6] .
            ", active = '" . ($params[7] ? Constant::$FLAG_YES : Constant::$FLAG_NO) . "' " .
            "WHERE locationId = " . $params[8];
          break;
        case "payoutUpdate":
          $query =
            "UPDATE poker_payout " .
            "SET payoutName = '" . $params[0] .
            "', bonusPoints = " . $params[1] .
            ", minPlayers = " . $params[2] .
            ", maxPlayers = " . $params[3] .
            " WHERE payoutId = " . $params[4];
          break;
        case "registrationUpdate":
          $query =
            "UPDATE poker_result " .
            "SET food = " . $params[0] .
            " WHERE tournamentId = " . $params[1] .
            " AND playerId = " . $params[2];
          break;
        case "registrationCancelUpdate":
          $query =
            "UPDATE poker_result " .
            "SET registerOrder = registerOrder - 1 " .
            "WHERE tournamentId = " . $params[0] .
           " AND registerOrder > " . $params[1];
          break;
        case "resultUpdate":
          $query =
            "UPDATE poker_result SET " .
            (isset($params[0]) ? "rebuyCount = " . $params[0] . ", " : "") .
            (isset($params[1]) ? "rebuyPaid = '" . $params[1] . "', " : "") .
            (isset($params[2]) ? " addonPaid = '" . $params[2] . "', " : "") .
            "statusCode = '" . $params[3] .
            "', place = " . $params[4] .
            ", knockedOutBy = " . $params[5] .
            " WHERE tournamentId = " . $params[6] .
            " AND playerId IN (" . $params[7] . ")";
          break;
        case "resultUpdateDuring":
          $query =
            "UPDATE poker_result " .
            "SET statusCode = '" . $params[0] .
            "', place = " . $params[1] .
            ", knockedOutBy = " . $params[2] .
            " WHERE tournamentId = " . $params[3] .
            " AND playerId = " . $params[4];
          break;
        case "resultUpdateByTournamentIdAndPlace":
          $query =
            "UPDATE poker_result SET " .
            (isset($params[0]) ? "rebuyCount = " . $params[0] . ", " : "") .
            (isset($params[1]) ? "rebuyPaid = '" . $params[1] . "', " : "") .
            (isset($params[2]) ? " addonPaid = '" . $params[2] . "', " : "") .
            "statusCode = '" . $params[3] .
            "', place = " . $params[4] .
            ", knockedoutBy = " . $params[5] .
            " WHERE tournamentId = " . $params[6]; // . " AND place < " . $params[6];
          break;
        case "seasonUpdate":
          $query =
            "UPDATE poker_season " .
            "SET seasonDescription = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            ", seasonStartDate = '" . $params[2] .
            "', seasonEndDate = '" . $params[3] .
            "', seasonActive = '" . (isset($params[4]) ? $params[4] : "0") .
            "' WHERE seasonId = " . $params[0];
          break;
        case "tournamentUpdate":
          $query =
            "UPDATE poker_tournament " .
            "SET tournamentDesc = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            ", comment = " . (strlen(trim($params[2])) == 0 ? "null" : "'" . $params[2] . "'") .
            ", limitTypeId = " . $params[3] .
            ", gameTypeId = " . $params[4] .
            ", chipCount = " . $params[5] .
            ", locationId = " . $params[6] .
            ", tournamentDate = '" . $params[7]->getDatabaseFormat() .
            "', startTime = '" . $params[8]->getDatabaseTimeFormat() .
            "', endTime = " . (isset($params[9]) ? "'" . $params[9] . "'" : "null") .
            ", buyinAmount = " . $params[10] . ", maxPlayers = " . $params[11] .
            ", maxRebuys = " . $params[12] . ", rebuyAmount = " . $params[13] .
            ", addonAmount = " . $params[14] . ", addonChipCount = " . $params[15] .
            ", groupId = " . $params[16] .
            ", rake = " . $params[17] .
            ", map = " . (strlen(trim($params[18])) == 0 ? "null" : "'" . $params[18] . "'") .
            ", specialTypeId = " . (isset($params[19]) && "" != $params[19] ? $params[19] : "null") .
            " WHERE tournamentId = " . $params[0];
          break;
          case "userUpdate":
          $validValues = array(0, 1);
          $query = "UPDATE poker_user " .
          // id, first_name, last_name, username, password, email, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, reset_selector, reset_token, reset_expires, remember_selector, remember_token, remember_expires
          "SET";
          if (! empty($params[0])) {
            $query .= " id = " . $params[0];
          }
          if (! empty($params[1])) {
            if (! empty($params[0])) {
              $query .= ", ";
            }
            $query .= " first_name = '" . $params[1] . "'";
          }
          if (! empty($params[2])) {
            if (! empty($params[0]) || ! empty($params[1])) {
              $query .= ", ";
            }
            $query .= " last_name = '" . $params[2] . "'";
          }
          if (! empty($params[3])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2])) {
              $query .= ", ";
            }
            $query .= " username = '" . $params[3] . "'";
          }
          if (! empty($params[4])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3])) {
              $query .= ", ";
            }
            $query .= " password = '" . password_hash($params[4], PASSWORD_DEFAULT) . "'";
          }
          if (! empty($params[5])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4])) {
              $query .= ", ";
            }
            $query .= " email = '" . $params[5] . "'";
          }
          if (in_array($params[6], $validValues)) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5])) {
              $query .= ", ";
            }
            $query .= " administrator = '" . $params[6] . "'";
          }
          if (! empty($params[7])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6])) {
              $query .= ", ";
            }
            $query .= " registration_date = '" . $params[8] . "'";
          }
          if (! empty($params[8])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7])) {
              $query .= ", ";
            }
//             $query .= " approval_date = '" . $params[8] . "'";
              $query .= " approval_date = " . ($params[8] == "CURRENT_TIMESTAMP" ? $params[8] : "'" . $params[8] . "'");
          }
          if (! empty($params[9])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8])) {
              $query .= ", ";
            }
            $query .= " approval_userid = " . $params[9];
          }
          if (! empty($params[10])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9])) {
              $query .= ", ";
            }
            $query .= " rejection_date = " . ($params[10] == "CURRENT_TIMESTAMP" ? $params[10] : "'" . $params[10] . "'");
          }
          if (! empty($params[11])) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9]) || ! empty($params[10])) {
              $query .= ", ";
            }
            $query .= " rejection_userid = " . $params[11];
          }
          if (in_array($params[12], $validValues)) {
            if (! empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9]) || ! empty($params[10]) || ! empty($params[11])) {
              $query .= ", ";
            }
            $query .= " active = '" . $params[12] . "'";
          }
          if (! empty($params[34])) {
            $query .= " selector = '" . $params[12] . "'";
          }
          if (! empty($params[14])) {
            $query .= " token = '" . $params[14] . "'";
          }
          if (! empty($params[15])) {
            $query .= " expires = '" . $params[15] . "'";
          }
          //           if (! empty($params[14])) {
//             $query .= " reset_selector = '" . $params[14] . "'";
//           }
//           if (! empty($params[15])) {
//             $query .= " reset_token = '" . $params[15] . "'";
//           }
//           if (! empty($params[16])) {
//             $query .= " reset_expires = '" . $params[16] . "'";
//           }
//           if (! empty($params[17])) {
//             $query .= " remember_selector = '" . $params[17] . "'";
//           }
//           if (! empty($params[18])) {
//             $query .= " remember_token = '" . $params[18] . "'";
//           }
//           if (! empty($params[19])) {
//             $query .= " remember_expires = '" . $params[19] . "'";
//           }
          $query .= " WHERE id = " . $params[0];
          break;
        case "specialTypeUpdate":
          $query =
            "UPDATE poker_special_type" .
            "SET typeDescription = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            " WHERE typeId = " . $params[0];
          break;
          case "userUpdateReset":
          $selector = bin2hex(random_bytes(8));
          $token = random_bytes(32);
          $expires = new \DateTime("NOW");
          // $expires->add(new DateInterval("PT01H")); // 1 hour
          $expires->add(new \DateInterval("P1D")); // 1 day
//           $query = "UPDATE poker_user " . "SET reset_selector = '" . $selector . "', reset_token = '" . hash('sha256', $token) . "', reset_expires = " . $expires->format('U') . " WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
          $query = "UPDATE poker_user " . "SET selector = '" . $selector . "', token = '" . hash('sha256', $token) . "', expires = " . $expires->format('U') . " WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
          break;
        case "userUpdateChangePassword":
//           $query = "UPDATE poker_user " . "SET password = '" . password_hash($params[2], PASSWORD_DEFAULT) . "', reset_selector = NULL, reset_token = NULL, reset_expires = NULL " . "WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "' " . "AND reset_expires >= " . $params[2];
//          $query = "UPDATE poker_user " . "SET password = '" . password_hash($params[2], PASSWORD_DEFAULT) . "', selector = NULL, token = NULL, expires = NULL " . "WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "' " . "AND expires >= " . $params[2];
          $query = "UPDATE poker_user " . "SET password = '" . password_hash($params[2], PASSWORD_DEFAULT) . "', selector = NULL, token = NULL, expires = NULL " . "WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
          break;
//         case "userUpdateRememberMe":
//           $selector = bin2hex(random_bytes(8));
//           $token = random_bytes(32);
//           $expires = new \DateTime("NOW");
//           // $expires->add(new DateInterval("PT01H")); // 1 hour
//           $expires->add(new \DateInterval("P7D")); // 7 days
//           $query = "UPDATE poker_user " . "SET remember_selector = '" . $selector . "', remember_token = '" . hash('sha256', $token) . "', remember_expires = " . $expires->format('U') . " WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
//           break;
//         case "userUpdateRememberMeClear":
//           $query = "UPDATE poker_user " . "SET remember_selector = NULL, remember_token = NULL, remember_expires = NULL " . "WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
//           break;
      }
      if ($this->isDebug()) {
        echo "<br>" . $query;
      }
      $queryResult = $this->getConnection()->query($query);
      if ($queryResult->errorCode() == "00000") {
        if ($dataName == "userUpdateReset" || $dataName == "userUpdateRememberMe") {
          if (1 == $queryResult->rowCount()) {
            $numRecords = array($selector, bin2hex($token), $expires->format('U'));
          } else {
            $numRecords = "More than 1 record found!";
          }
        } else {
          $numRecords = $queryResult->rowCount();
        }
      } else if ($queryResult) {
        $numRecords = $queryResult->errorInfo();
      }
    } catch (Exception $e) {
      throw new Exception($e);
    }
    return $numRecords;
  }
  // $prefix is table alias
  private function buildOrderByName($prefix) {
    $alias = isset($prefix) ? $prefix . "." : "";
    return $alias . "last_name, " . $alias . "first_name";
  }
  private function buildChampionship($params) {
    $query =
      "SELECT YEAR(t.tournamentDate) AS Yr, p.Id, p.first_name, p.last_name, CONCAT(p.first_name, ' ', p.last_name) AS name, " .
    "                                          (SELECT SUM(total) AS 'Total Pool' " . "                                           FROM (SELECT YEAR(t2.tournamentDate) AS Yr, t2.TournamentId AS Id, CASE WHEN b.Play IS NULL THEN 0 ELSE CONCAT(b.Play, '+', CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END, 'r', '+', CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END, 'a') END AS Play, " .
    "                                                        ((t2.BuyinAmount * t2.Rake) * Play) + ((t2.RebuyAmount * t2.Rake) * CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END) + " .
    "                                                         ((t2.AddonAmount * t2.Rake) * CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END) AS Total " .
    "                                                 FROM poker_tournament t2 " .
    "                                                 LEFT JOIN (SELECT TournamentId, COUNT(*) AS Play " .
    "                                                            FROM poker_result " .
    "                                                            WHERE buyinPaid = '" . Constant::$FLAG_YES . "' AND Place > 0 " .
    "                                                            GROUP BY TournamentId) b ON t2.TournamentId = b.TournamentId";
    if (isset($params[0]) && isset($params[1])) {
      $query .=
      "                                                 AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
    }
    $query .= "                                                 LEFT JOIN (SELECT r.TournamentId, SUM(r.rebuyCount) AS NumRebuys " .
    "                                                            FROM poker_result r " .
    "                                                            WHERE r.rebuyPaid = '" . Constant::$FLAG_YES . "' " .
    "                                                            AND r.RebuyCount > 0 " .
    "                                                            GROUP BY r.TournamentId) nr ON t2.TournamentId = nr.TournamentId " .
    "                                                LEFT JOIN (SELECT r.TournamentId, COUNT(*) AS NumAddons " .
    "                                                           FROM poker_result r " .
    "                                                           WHERE r.AddonPaid = '" . Constant::$FLAG_YES . "' " .
    "                                                           GROUP BY r.TournamentId) na ON t2.TournamentId = na.TournamentId) zz " .
    "                                                WHERE zz.yr = YEAR(t.tournamentDate) " .
    "                                                GROUP BY zz.yr) * CASE WHEN s.Percentage IS NULL THEN 0 ELSE s.Percentage END AS Earnings " .
    "                                   FROM poker_result r INNER JOIN poker_user p ON r.PlayerId = p.Id " .
//     "                                   INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId AND t.tournamentDesc LIKE '%" . Constant::$DESCRIPTION_CHAMPIONSHIP . "%'";
    "                                   INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId";
    if (isset($params[0]) && isset($params[1])) {
      $query .=
        "                                   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
    }
    $query .=
      "                                   LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
      "                                   LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
      "                                              FROM (SELECT np.tournamentId, p.payoutId " .
      "                                                    FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
      "                                                          FROM poker_result r " .
      "                                                          WHERE r.place > 0 " .
      "                                                          AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
      "                                                          GROUP BY r.tournamentId) np " .
      "                                                    INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId";
    if (isset($params[0]) && isset($params[1])) {
      $query .=
        "                                                    AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
    }
    $query .=
      "                                                    INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
      "                                                    INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
      "                                              INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
      "                                   WHERE r.Place > 0 " .
      "                                   AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "'";
    return $query;
  }
  // $where is sql where clause (WHERE or AND)
  // $alias is table alias
  private function buildUserActive($where = "WHERE", $alias = null) {
    return " AND " . (isset($alias) ? $alias . "." : "") . "active = 1";
  }
  // $query is query to modify
  // $whereClause is where clause to replace in query
  // $selectFieldName is field name used for ranking
  // $selectFieldNames is list of field names to search in
  // $orderByFieldName is order by field name to use when replacing
  private function modifyQueryAddRank($query, $whereClause, $selectFieldName, $selectFieldNames, $orderByFieldName) {
    if ($this->isDebug()) {
      echo "<br>orig -> " . $query;
    }
    $queryTemp = substr_replace($query, "SELECT ROW_NUMBER() OVER (ORDER BY " . $selectFieldName . " DESC, name) AS row, RANK() OVER (ORDER BY " . $selectFieldName . " DESC) AS rank, " . $selectFieldNames . " FROM (SELECT ", 0, 6);
    $queryTemp = str_replace($whereClause, "ORDER BY " . $selectFieldName . " DESC, last_name, first_name) z ORDER BY row, name", $queryTemp);
    return $queryTemp;
  }
}
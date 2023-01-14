<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use Exception;
use PDO;
use PDOException;
use ccp\classes\utility\SessionUtility;
class DatabaseResult extends Root {
  private Database $database;
  private PDO $connection;
  public function __construct(protected bool $debug) {
    $this->setDatabase($this->initializeDatabase());
    $this->setConnection($this->initializeConnection());
  }
  public function getConnection() {
    return $this->connection;
  }
  public function getDatabase() {
    return $this->database;
  }
  public function setConnection(PDO $connection) {
    $this->connection = $connection;
  }
  public function setDatabase(Database $database) {
    $this->database = $database;
  }
  public function getAutoRegisterHost(array $params) {
    return $this->getData(dataName: "autoRegisterHost", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getBullyForUser(array $params) {
    return $this->getData(dataName: "bullyForUser", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getChampionshipByYearByEarnings(array $params) {
    return $this->getData(dataName: "championship", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getChampionshipByPlayerForYear(array $params) {
    return $this->getData(dataName: "championship", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getChampionshipByPlayerByEarnings(array $params) {
    return $this->getData(dataName: "championship", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getChampionshipQualifiedPlayers(array $params) {
    return $this->getData(dataName: "championshipQualifiedPlayers", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getCountTournamentForDates(array $params) {
    return $this->getData(dataName: "countTournamentForDates", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getEarningsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "earningsAverageForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getEarningsTotalForChampionship(array $params) {
    return $this->getData(dataName: "earningsTotalForChampionship", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getEarningsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "earningsTotalForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getEarningsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "earningsTotalAndAverageForSeasonForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getEarningsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "earningsTotalAndAverageForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getFee() {
    return $this->getData(dataName: "feeSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getFinishesForUser(array $params) {
    return $this->getData(dataName: "finishesSelectAllByPlayerId", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getFoodByTournamentIdAndPlayerId(array $params) {
    return $this->getData(dataName: "foodByTournamentIdAndPlayerId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getGameType() {
    return $this->getData(dataName: "gameTypeSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getGroupsAll(array $params) {
    return $this->getData(dataName: "groupSelectAll", params: null, orderBy: null, returnQuery: $params[0], limitCount: null, rank: false);
  }
  public function getGroupById(array $params) {
    return $this->getData(dataName: "groupSelectAllById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getGroupNameList() {
    return $this->getData(dataName: "groupSelectNameList", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getGroupPayout() {
    return $this->getData(dataName: "groupPayoutSelectAll", params: null, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getGroupPayoutById(array $params) {
    return $this->getData(dataName: "groupPayoutSelectAllById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getKnockoutsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "knockoutsAverageForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getKnockoutsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "knockoutsTotalForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getKnockoutsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "knockoutsTotalAndAverageForSeasonForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getKnockoutsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "knockoutsTotalAndAverageForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getLimitType() {
    return $this->getData(dataName: "limitTypeSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getLocation(array $params) {
    return $this->getData(dataName: "locationSelectAll", params: $params, orderBy: null, returnQuery: $params[0], limitCount: null, rank: false);
  }
  public function getLocationById(array $params) {
    return $this->getData(dataName: "locationSelectById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getLogin($userName) {
    return $this->getData(dataName: "login", params: array($userName, "Super Users"), orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getNemesisForUser(array $params) {
    return $this->getData(dataName: "nemesisForUser", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getNotification($params, $returnQuery) {
    return $this->getData(dataName: "notificationSelectAll", params: $params, orderBy: null, returnQuery: $returnQuery, limitCount: null, rank: false);
  }
  public function getNotificationById(array $params) {
    return $this->getData(dataName: "notificationSelectOneById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getPayoutsAll(array $params) {
    return $this->getData(dataName: "payoutSelectAll", params: null, orderBy: null, returnQuery: $params[0], limitCount: null, rank: false);
  }
  public function getPayoutById(array $params) {
    return $this->getData(dataName: "payoutSelectAllById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getPayoutMaxId() {
    return $this->getData(dataName: "payoutSelectMaxId", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getPayoutNameList() {
    return $this->getData(dataName: "payoutSelectNameList", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getPointsAverageForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "pointsAverageForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getPointsTotalForSeason($params, $orderBy, $limitCount) {
    return $this->getData(dataName: "pointsTotalForSeason", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: $limitCount, rank: false);
  }
  public function getPointsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "pointsTotalAndAverageForSeasonForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getPointsTotalAndAverageForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "pointsTotalAndAverageForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getPrizePoolForSeason($params, $returnQuery) {
    return $this->getData(dataName: "prizePoolForSeason", params: $params, orderBy: null, returnQuery: $returnQuery, limitCount: null, rank: false);
  }
  public function getRegistrationWaitList(array $params) {
    return $this->getData(dataName: "registrationWaitList", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultIdMax(array|null $params) {
    return $this->getData(dataName: "resultIdMax", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
}
  public function getResult() {
    return $this->getData(dataName: "resultSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultDuring(array $params) {
    return $this->getData(dataName: "resultSelectAllDuring", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultLastEnteredDuring(array $params) {
    return $this->getData(dataName: "resultSelectLastEnteredDuring", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultByTournamentId(array $params) {
    return $this->getData(dataName: "resultSelectAllByTournamentId", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getResultByTournamentIdAndPlayerId(array $params) {
    return $this->getData(dataName: "resultSelectOneByTournamentIdAndPlayerId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultRegisteredByTournamentId(array $params) {
    return $this->getData(dataName: "resultSelectRegisteredByTournamentId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultFinishedByTournamentId(array $params) {
    return $this->getData(dataName: "resultSelectAllFinishedByTournamentId", params: $params, orderBy: null, returnQuery: $params[1], limitCount: null, rank: false);
  }
  public function getResultPaidByTournamentId($params, $returnQuery) {
    return $this->getData(dataName: "resultSelectPaidByTournamentId", params: $params, orderBy: null, returnQuery: $returnQuery, limitCount: null, rank: false);
  }
  public function getResultPaidNotEnteredByTournamentId(array $params) {
    return $this->getData(dataName: "resultSelectPaidNotEnteredByTournamentId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getResultOrderedTotalPoints(array $params) {
    return $this->getData(dataName: "resultAllOrderedPoints", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getResultOrderedEarnings(array $params) {
    return $this->getData(dataName: "resultAllOrderedEarnings", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getResultOrderedKnockouts(array $params) {
    return $this->getData(dataName: "resultAllOrderedKnockouts", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getResultOrderedSummary(array $params) {
    return $this->getData(dataName: "resultAllOrderedSummary", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getResultOrderedSummaryStats(array $params) {
    $resultListSummary = $this->getData(dataName: "resultAllOrderedSummaryStats", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
    $resultListKo = $this->getData(dataName: "resultAllOrderedKnockoutsStats", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
    $resultListWinners = $this->getData(dataName: "winnersSelectAllStats", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
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
  public function getResultPaidUserCount() {
    return $this->getData(dataName: "resultPaidUserCount", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeason(array $params) {
    return $this->getData(dataName: "seasonSelectAll", params: $params, orderBy: $params[0], returnQuery: $params[1], limitCount: null, rank: false);
  }
  public function getSeasonByActive(array $params) {
    return $this->getData(dataName: "seasonSelectOneByActive", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeasonById(array $params) {
    return $this->getData(dataName: "seasonSelectOneById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeasonByIdAndDesc(array $params) {
    return $this->getData(dataName: "seasonSelectOneByIdAndDesc", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeasonActiveCount() {
    return $this->getData(dataName: "seasonActiveCount", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeasonChampionships() {
    return $this->getData(dataName: "seasonSelectAllChampionship", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSeasonDateCheckCount(array $params) {
    return $this->getData(dataName: "seasonDateCheckCount", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getSpecialType(array $params) {
    return $this->getData(dataName: "specialTypeSelectAll", params: null, orderBy: $params[0], returnQuery: $params[1], limitCount: null, rank: false);
  }
  public function getSpecialTypeById(array $params) {
    return $this->getData(dataName: "specialTypeSelectOneById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getStatus() {
    return $this->getData(dataName: "statusSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getStatusPaid($params, $returnQuery) {
    return $this->getData(dataName: "statusSelectPaid", params: $params, orderBy: null, returnQuery: $returnQuery, limitCount: null, rank: false);
  }
  public function getStructure() {
    return $this->getData(dataName: "structureSelectAll", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getStructurePayout(array $params) {
    return $this->getData(dataName: "structurePayout", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournament(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentSelectAll", params: null, paramsNested: $paramsNested, orderBy: $params[0], returnQuery: $params[1], limitCount: null, rank: false);
  }
  public function getTournamentAll(array $params) {
    return $this->getData(dataName: "tournamentAll", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentIdMax(array $params) {
    return $this->getData(dataName: "tournamentIdMax", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentOrdered(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentSelectAllOrdered", params: null, paramsNested: $paramsNested, orderBy: null, returnQuery: $params[0], limitCount: null, rank: false);
  }
  public function getTournamentsForEmailNotifications(array $params) {
    return $this->getData(dataName: "tournamentsSelectForEmailNotifications", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentByDateAndStartTime(array $params, array $paramsNested, $limitCount) {
    return $this->getData(dataName: "tournamentSelectAllByDateAndStartTime", params: $params, paramsNested: $paramsNested, orderBy: null, returnQuery: false, limitCount: $limitCount, rank: false);
  }
  public function getTournamentById(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentSelectOneById", params: $params, paramsNested: $paramsNested, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentDuring() {
    return $this->getData(dataName: "tournamentSelectAllDuring", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentYearsPlayed(array $params) {
    return $this->getData(dataName: "tournamentSelectAllYearsPlayed", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentForRegistration(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentSelectAllForRegistration", params: $params, paramsNested: $paramsNested, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentForBuyins(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentSelectAllForBuyins", params: $params, paramsNested: $paramsNested, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentForRegistrationStatus(array $params) {
    return $this->getData(dataName: "tournamentSelectAllRegistrationStatus", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getTournamentsPlayedByPlayerIdAndDateRange(array $params) {
    return $this->getData(dataName: "tournamentsPlayedByPlayerIdAndDateRange", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentsWonByPlayerId(array $params, array $paramsNested) {
    return $this->getData(dataName: "tournamentsWonByPlayerId", params: $params, paramsNested: $paramsNested, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentsPlayed(array $params) {
    return $this->getData(dataName: "tournamentsPlayed", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: true);
  }
  public function getTournamentsPlayedByTypeByPlayerId(array $params) {
    return $this->getData(dataName: "tournamentsPlayedByType", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getTournamentsPlayedFirstByPlayerId(array $params) {
    return $this->getData(dataName: "tournamentsPlayedFirst", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getTournamentIdList(array $params) {
    return $this->getData(dataName: "tournamentIdList", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUserAbsencesByTournamentId(array $params) {
    return $this->getData(dataName: "userAbsencesByTournamentId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUsersActive(array $params) {
    return $this->getData(dataName: "userActive", params: null, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUsersAll(array $params) {
    return $this->getData(dataName: "userSelectAll", params: $params, orderBy: null, returnQuery: $params[0], limitCount: null, rank: false);
  }
  public function getUserById(array $params) {
    return $this->getData(dataName: "userSelectOneById", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUserByUsername(array $params) {
    return $this->getData(dataName: "userSelectOneByUsername", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUserByEmail(array $params) {
    return $this->getData(dataName: "userSelectOneByEmail", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUsersForEmailNotifications(array $params) {
    return $this->getData(dataName: "usersSelectForEmailNotifications", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getUsersForApproval() {
    return $this->getData(dataName: "usersSelectForApproval", params: null, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getUserPaidByTournamentId(array $params) {
    return $this->getData(dataName: "userPaidByTournamentId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getWaitListedPlayerByTournamentId(array $params) {
    return $this->getData(dataName: "waitListedPlayerByTournamentId", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function getWinnersForSeason($params, $returnQuery, $limitCount) {
    return $this->getData(dataName: "winnersForSeason", params: $params, orderBy: null, returnQuery: $returnQuery, limitCount: $limitCount, rank: false);
  }
  public function getWinsForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "winsForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getWinsTotalAndAverageForSeasonForUser($params, $orderBy, $rank) {
    return $this->getData(dataName: "winsTotalAndAverageForSeasonForUser", params: $params, orderBy: $orderBy, returnQuery: true, limitCount: null, rank: $rank);
  }
  public function getWinners(array $params) {
    return $this->getData(dataName: "winnersSelectAll", params: $params, orderBy: null, returnQuery: true, limitCount: null, rank: false);
  }
  public function getUserPasswordReset(array $params) {
    return $this->getData(dataName: "userPasswordReset", params: $params, orderBy: null, returnQuery: false, limitCount: null, rank: false);
  }
  public function deleteLocation(array $params) {
    return $this->deleteData(dataName: "locationDelete", params: $params);
  }
  public function deleteGroup(array $params) {
    return $this->deleteData(dataName: "groupDelete", params: $params);
  }
  public function deleteGroupPayout(array $params) {
    return $this->deleteData(dataName: "groupPayoutDelete", params: $params);
  }
  public function deleteNotification(array $params) {
    return $this->deleteData(dataName: "notificationDelete", params: $params);
  }
  public function deletePayout(array $params) {
    return $this->deleteData(dataName: "payoutDelete", params: $params);
  }
  public function deleteRegistration(array $params) {
    return $this->deleteData(dataName: "registrationDelete", params: $params);
  }
  public function deleteResult(array $params) {
    return $this->deleteData(dataName: "resultDelete", params: $params);
  }
  public function deleteSeason(array $params) {
    return $this->deleteData(dataName: "seasonDelete", params: $params);
  }
  public function deleteStructure(array $params) {
    return $this->deleteData(dataName: "structureDelete", params: $params);
  }
  public function deleteTournament(array $params) {
    return $this->deleteData(dataName: "tournamentDelete", params: $params);
  }
  public function deleteSpecialType(array $params) {
    return $this->deleteData(dataName: "specialTypeDelete", params: $params);
  }
  public function insertGroup(array $params) {
    return $this->insertData(dataName: "groupInsert", params: $params);
  }
  public function insertGroupPayout(array $params) {
    return $this->insertData(dataName: "groupPayoutInsert", params: $params);
  }
  public function insertLocation(array $params) {
    return $this->insertData(dataName: "locationInsert", params: $params);
  }
  public function insertNotification(array $params) {
    return $this->insertData(dataName: "notificationInsert", params: $params);
  }
  public function insertPayout(array $params) {
    return $this->insertData(dataName: "payoutInsert", params: $params);
  }
  public function insertRegistration(array $params) {
    return $this->insertData(dataName: "registrationInsert", params: $params);
  }
  public function insertSeason(array $params) {
    return $this->insertData(dataName: "seasonInsert", params: $params);
  }
  public function insertStructure(array $params) {
    return $this->insertData(dataName: "structureInsert", params: $params);
  }
  public function insertTournament(array $params) {
    return $this->insertData(dataName: "tournamentInsert", params: $params);
  }
  public function insertSpecialType(array $params) {
    return $this->insertData(dataName: "specialTypeInsert", params: $params);
  }
  public function insertUser(array $params) {
    return $this->insertData(dataName: "userInsert", params: $params);
  }
  public function updateBuyins(array $params) {
    return $this->updateData(dataName: "buyinsUpdate", params: $params);
  }
  public function updateGroup(array $params) {
    return $this->updateData(dataName: "groupUpdate", params: $params);
  }
  public function updateGroupPayout(array $params) {
    return $this->updateData(dataName: "groupPayoutUpdate", params: $params);
  }
  public function updateLocation(array $params) {
    return $this->updateData(dataName: "locationUpdate", params: $params);
  }
  public function updateNotification(array $params) {
    return $this->updateData(dataName: "notificationUpdate", params: $params);
  }
  public function updatePayout(array $params) {
    return $this->updateData(dataName: "payoutUpdate", params: $params);
  }
  public function updateRegistration(array $params) {
    return $this->updateData(dataName: "registrationUpdate", params: $params);
  }
  public function updateRegistrationCancel(array $params) {
    return $this->updateData(dataName: "registrationCancelUpdate", params: $params);
  }
  public function updateResult(array $params) {
    return $this->updateData(dataName: "resultUpdate", params: $params);
  }
  public function updateResultDuring(array $params) {
    return $this->updateData(dataName: "resultUpdateDuring", params: $params);
  }
  public function updateResultByTournamentIdAndPlace(array $params) {
    return $this->updateData(dataName: "resultUpdateByTournamentIdAndPlace", params: $params);
  }
  public function updateResultByTournamentId(array $params) {
    return $this->updateData(dataName: "resultUpdateByTournamentId", params: $params);
  }
  public function updateSeason(array $params) {
    return $this->updateData(dataName: "seasonUpdate", params: $params);
  }
  public function updateTournament(array $params) {
    return $this->updateData(dataName: "tournamentUpdate", params: $params);
  }
  public function updateSpecialType(array $params) {
    return $this->updateData(dataName: "specialTypeUpdate", params: $params);
  }
  public function updateUser(array $params) {
    return $this->updateData(dataName: "userUpdate", params: $params);
  }
  public function updateUserReset(array $params) {
    return $this->updateData(dataName: "userUpdateReset", params: $params);
  }
  public function updateUserChangePassword(array $params) {
    return $this->updateData(dataName: "userUpdateChangePassword", params: $params);
  }
  public function updateUserRememberMe(array $params) {
    return $this->updateData(dataName: "userUpdateRememberMe", params: $params);
  }
  public function updateUserRememberMeClear(array $params) {
    return $this->updateData(dataName: "userUpdateRememberMeClear", params: $params);
  }
  private function initializeDatabase() {
    if ($_SERVER["SERVER_NAME"] == "chipchairprayer.com" || $_SERVER["SERVER_NAME"] == "www.chipchairprayer.com") {
      $username = "chipch5_app";
      $password = "app_chipch5";
      $port = 3306;
      $databaseName = "chipch5_stats_new";
    } else {
      $username = "root";
      $password = "toor";
      $port = 3306;
      $databaseName = "chipch5_stats";
    }
    $database = new Database(debug: $this->isDebug(), hostName: "localhost", userid: $username, password: $password, databaseName: $databaseName, port: $port);
    return $database;
  }
  private function initializeConnection() {
    try {
      $connection = new PDO(dsn: $this->getDatabase()->getDsn(), username: $this->getDatabase()->getUserid(), password: $this->getDatabase()->getPassword(), options: array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage() . "\r\n" . $this->getDatabase();
    }
    return $connection;
  }
  // $dataName is name of the query
  // $params is array of input parameters
  // $paramsNested is array of input parameters
  // $orderBy is array of fields to order by
  // $returnQuery is boolean (true returns query instead of results, false returns results)
  // $limitCount is number to limit the results by
  // $rank is boolean (true means ranking, false means no ranking)
  private function getData(string $dataName, array|null $params, array|null $paramsNested = null, array|string|null $orderBy = null, bool $returnQuery = false, int|null $limitCount = null, bool $rank = false) {
//     try {
      $resultList = array();
      switch ($dataName) {
        case "autoRegisterHost":
          // tournament id so that it returns a record for each tournament on the day
          $query =
            "SELECT t.tournamentId, t.tournamentDate, t.startTime, l.playerId, l.address, l.city, l.state, l.zipCode, CONCAT(u.first_name, ' ', u.last_name) AS name, u.email " .
            "FROM poker_tournament t " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId AND tournamentDate BETWEEN '" . $params[0] . "' AND DATE_ADD('" . $params[0] . "', INTERVAL 14 DAY) " .
            "INNER JOIN poker_user u ON l.playerId = u.id " . $this->buildUserActive(where: "AND", alias: "u") .
            " LEFT JOIN poker_result r ON t.tournamentId = r.tournamentId AND u.id = r.playerId " .
            "WHERE r.playerId IS NULL";
          break;
        case "bullyForUser":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(r.playerId) AS kOs " .
            "FROM poker_result r " .
            "INNER JOIN poker_user u ON r.playerId = u.id " . "WHERE r.knockedOutBy = " . $params[0] .
            " GROUP BY r.playerId " .
            "ORDER BY kOs DESC, " . $this->buildOrderByName(prefix: null);
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
            "earnings, SUM(earnings) / trnys AS avg, trnys " .
            "FROM (" . $this->buildChampionship($params) . ") a " .
            "WHERE earnings > 0";
//           if (isset($params[3]) && $params[3]) {
//             $query .= " GROUP BY name";
//           }
//           $query .= " GROUP BY yr, id";
          $query .= " GROUP BY " . $params[2];
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
            "WHERE nt.numTourneys >= " . $params[2];
//           if (isset($params[2])) {
//             $query .= " AND u.id NOT IN (" . $params[2] . ")";
//           }
          $query .=
            " GROUP BY r.playerid " .
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
            $query .= "             SELECT id, CONCAT(first_name, ' ', last_name) AS name, IFNULL(totalEarnings, 0) AS earns";
            if ("earningsTotalForChampionship" == $dataName) {
              $query .= ", IFNULL(totalEarnings / trnys, 0) AS avg, IFNULL(trnys, 0) AS trnys ";
            }
            $query .= "             FROM (";
          }
          $query .=
            "            SELECT xx.id, xx.last_name, xx.first_name, SUM(xx.earnings) AS totalEarnings, MAX(xx.earnings) AS maxEarnings, 0";
          if ("earningsTotalForChampionship" == $dataName) {
            $query .= ", numTourneys AS trnys ";
          }
          $query .=
            "            FROM (SELECT Yr, p.Id, p.first_name, p.last_name, ";
          if ("earningsTotalForChampionship" == $dataName) {
            $query .= " numTourneys, ";
          }
          $query .=
            "                        qq.total * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS Earnings " .
            "                 FROM poker_user p " .
            "                 INNER JOIN poker_result r ON p.id = r.playerId " .
            "                 INNER JOIN poker_tournament t ON r.tournamentId = t.tournamentId";
            if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalForChampionship" != $dataName) {
              $query .= "        AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
            }
            if ("earningsTotalForChampionship" == $dataName && isset($params[0])) {
              $query .= "                               AND YEAR(t.tournamentDate) IN ('" . $params[0] . "') ";
            }
            $query .= 
            "                  INNER JOIN (SELECT Yr, SUM(total) - CASE WHEN Yr = 2008 THEN 150 ELSE " . // adjust to match Dave W stats
            "                                               CASE WHEN Yr = 2007 THEN -291 ELSE " . // adjust to match Dave W stats
            "                                                 CASE WHEN Yr = 2006 THEN -824 ELSE 0 END " . // adjust to match Dave W stats
            "                                               END " .
            "                                            END AS total " .
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
              $query .= "                               AND YEAR(t2.tournamentDate) IN ('" . $params[0] . "') ";
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
            "                        GROUP BY zz.yr) qq";
            if (isset($params[0])) {
              $query .= " ON qq.yr IN ('" . $params[0] . "') ";
            } else {
              $query .= " ON qq.yr = YEAR(t.tournamentDate) ";
            }
            $query .=
            "                  LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId";
            if ("earningsTotalForChampionship" == $dataName) {
              $query .= "                  INNER JOIN (SELECT r1.playerId, COUNT(*) AS NumTourneys FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND r1.place > 0 INNER JOIN poker_special_type st1 ON t1.specialTypeId = st1.typeId AND st1.typeDescription = 'Championship' GROUP BY r1.playerId) nt ON r.playerId = nt.playerId ";
            }
            $query .=
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
            $query .= "                               AND YEAR(t.tournamentDate) IN ('" . $params[0] . "') ";
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
            } else {
              $query .= " WHERE u.active = '" . Constant::$FLAG_YES_DATABASE . "'";
            }
            if ("earningsTotalAndAverageForUser" != $dataName && "earningsTotalAndAverageForSeasonForUser" != $dataName) {
              $query .= " ORDER BY ";
              if (1 == $orderBy[0]) {
                $query .= "earns";
              } else {
                $query .= "avg";
              }
              $query .= " DESC, " . $this->buildOrderByName(prefix: null);
            }
            if ("earningsTotalForChampionship" == $dataName) {
              $query .= ")";
            }
            if ($rank) {
              if (1 == $orderBy[0]) {
                $orderByFieldName = "earns DESC, " . $this->buildOrderByName(prefix: null);
                $selectFieldName = "earns";
              } else {
                $orderByFieldName = "avg DESC, " . $this->buildOrderByName(prefix: null);
                $selectFieldName = "avg";
              }
              $selectFieldNames = "id, name, earns, avg, trnys";
              $query = $this->modifyQueryAddRank(query: $query, whereClause: $whereClause, selectFieldName: $selectFieldName, selectFieldNames: $selectFieldNames, orderByFieldName: $orderByFieldName);
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
          // TODO: dummy figure out how to fix
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
          } else {
            $query .= " WHERE u.active = '" . Constant::$FLAG_YES_DATABASE . "'";
          }
          if ("knockoutsTotalAndAverageForSeasonForUser" != $dataName && "knockoutsTotalAndAverageForUser" != $dataName) {
            $query .= " ORDER BY ";
            if (1 == $orderBy[0]) {
              $query .= "kO";
            } else {
              $query .= "avg";
            }
            $query .= " DESC, " . $this->buildOrderByName(prefix: null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "kO DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "kO";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, kO, avg, trnys";
            $query = $this->modifyQueryAddRank(query: $query, whereClause: $whereClause, selectFieldName: $selectFieldName, selectFieldNames: $selectFieldNames, orderByFieldName: $orderByFieldName);
          }
          break;
        case "limitTypeSelectAll":
          $query =
            "SELECT limitTypeId, limitTypeName " .
            "FROM poker_limit_type";
          break;
        case "locationSelectAll":
          $query =
            "SELECT l.locationId AS id, l.locationName AS name, u.id as playerId, CONCAT(u.first_name, ' ', u.last_name) AS host, l.address, l.city, UPPER(l.state) AS state, l.zipCode AS zip, u.active, (SELECT COUNT(*) FROM poker_tournament t WHERE t.LocationId = l.locationId) AS trnys " .
            "FROM poker_location l INNER JOIN poker_user u ON l.playerId = u.id ";
          if ($params[1]) {
            $query .= " AND u.active = '" . Constant::$FLAG_YES_DATABASE . "'";
          }
          if ($params[2]) {
            $query .= " ORDER BY l.locationName";
          }
          break;
        case "locationSelectById":
          $query =
            "SELECT l.locationId AS id, l.locationName AS name, l.playerId, l.address, l.city, UPPER(l.state) AS state, l.zipCode AS zip, u.active " .
            "FROM poker_location l INNER JOIN poker_user u ON l.playerId = u.id " .
            "WHERE l.locationId IN (" . $params[0] . ")";
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
            "ORDER BY kOs DESC, " . $this->buildOrderByName(prefix: null);
          break;
        case "notificationSelectAll":
        case "notificationSelectOneById":
          $query =
            "SELECT id, description, startDate AS 'start date', endDate AS 'end date' " .
            "FROM poker_notification ";
          if ("notificationSelectOneById" == $dataName) {
            $query .= " WHERE id = " . $params[0];
          } else if ("notificationSelectAll" == $dataName) {
            if (isset($params[0])) {
              $query .= " WHERE '" . $params[0] . "' BETWEEN startDate AND endDate ";
            }
            if (isset($orderBy)) {
              $query .= $orderBy;
            }
          }
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
            "FROM poker_user u LEFT JOIN (SELECT u.id, SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "                                               CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
            "                                                CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "                                               ELSE " .
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
          } else {
            $query .= " WHERE u.active = '" . Constant::$FLAG_YES_DATABASE . "'";
          }
          if ("pointsTotalAndAverageForUser" != $dataName && "pointsTotalAndAverageForSeasonForUser" != $dataName) {
            $query .= " ORDER BY ";
            if (1 == $orderBy[0]) {
              $query .= "pts";
            } else {
              $query .= "avg";
            }
            $query .= " DESC, " . $this->buildOrderByName(prefix: null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "pts DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "pts";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, pts, avg, trnys";
            $query = $this->modifyQueryAddRank(query: $query, whereClause: $whereClause, selectFieldName: $selectFieldName, selectFieldNames: $selectFieldNames, orderByFieldName: $orderByFieldName);
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
            //if ("resultSelectPaidNotEnteredByTournamentId" == $dataName) {
              $query .= " ORDER BY " . $this->buildOrderByName(prefix: "u");
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
//             "       CASE WHEN t.tournamentDesc LIKE '%Championship%' THEN 0 " .
            "       CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN 0" .
            "       ELSE " .
            "        CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
            "         CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "        ELSE " .
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
            "LEFT JOIN (SELECT tournamentId, COUNT(addonPaid) AS numAddons " .
            "           FROM poker_result WHERE addonPaid = '" . Constant::$FLAG_YES . "' GROUP BY tournamentId) na ON r.tournamentId = na.tournamentId " .
            "WHERE r.tournamentId = " . $params[1] .
            " AND r.place > 0 " .
            "ORDER BY t.tournamentDate DESC, t.startTime DESC, r.place";
          break;
        case "resultAllOrderedPoints":
          $query =
            "SELECT CONCAT(u.first_name, ' ', u.last_name) AS name, " .
            "       SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "            CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "            ELSE " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 " .
            "             ELSE np.numPlayers - r.place + 1 END " .
            "            END " .
            "           END) AS pts, " .
            "       SUM(CASE WHEN st.typeDescription IS NULL OR st.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
            "            CASE WHEN r.place BETWEEN 1 AND 8 THEN " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 4) * 2 ELSE np.numPlayers - r.place + 4 END " .
            "            ELSE " .
            "             CASE WHEN st.typeDescription = '" . Constant::$DESCRIPTION_MAIN_EVENT . "' THEN (np.numPlayers - r.place + 1) * 2 ELSE np.numPlayers - r.place + 1 END " .
            "            END " .
            "           END) / nt.numTourneys AS avg, nt.numTourneys AS tourneys, u.active " .
            "FROM poker_user u " .
            "INNER JOIN poker_result r ON u.id = r.playerId " .
            "INNER JOIN poker_tournament t on r.tournamentId = t.tournamentId ";
          if (isset($params[0]) && isset($params[1])) {
            $query .= "      AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
          }
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
            "ORDER BY pts DESC, " . $this->buildOrderByName(prefix: null);
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
            // bounties removed here
            "d.earnings,  " .
            "d.earnings - CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END - CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END - CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END AS 'net(+/-)', " .
            "d.earnings / d.numTourneys AS '$ / trny', " .
            "(d.earnings - CASE WHEN d.numTourneys IS NULL THEN 0 ELSE d.numTourneys * e.buyinAmount END - CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END - CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END) / d.numTourneys AS 'Net / Trny', " .
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
            "                             FROM (" . $this->buildChampionship(params: $params) .
            "                                   GROUP BY id, yr) xx " .
            "                             GROUP BY xx.id, xx.name) cc " .
            "                       GROUP BY id, name) b ON a.Id = b.Id WHERE b.Id IN (SELECT DISTINCT playerId FROM poker_result WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "')) d " .
//             "LEFT JOIN (SELECT c.PlayerId, c.Place, c.NumPlayers, CASE WHEN c.Place IS NULL THEN 0 ELSE SUM(CASE WHEN (c.tournamentDesc IS NULL OR c.tournamentDesc <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "') THEN " .
            "LEFT JOIN (SELECT c.PlayerId, c.Place, c.NumPlayers, CASE WHEN c.Place IS NULL THEN 0 ELSE SUM(CASE WHEN c.typeDescription IS NULL OR c.typeDescription <> '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' THEN " .
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
            "                                                     c.NumRebuys, c.BuyinAmount " .
            "           FROM (SELECT a.TournamentId, a.tournamentDesc, a.PlayerId, a.Place, a.NumPlayers, a.NumRebuys, a.BuyinAmount, a.RebuyAmount, a.AddonAmount, a.NumAddons, a.typeDescription " .
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
            "                 ) c " .
            "           GROUP BY c.PlayerId) e ON d.Id = e.PlayerId ";
          if ("resultAllOrderedSummary" == $dataName) {
            $query .= "ORDER BY ROUND(d.earnings, 0) DESC";
          }
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
            "SELECT seasonId AS id, seasonDescription AS description, seasonStartDate AS 'start date', seasonEndDate AS 'end date', seasonChampionshipQualify AS '# to qualify', seasonActive AS 'active' " .
            "FROM poker_season s ";
          if ("seasonSelectOneById" == $dataName) {
            $query .= " WHERE seasonid = " . $params[0];
          } else if ("seasonSelectOneByIdAndDesc" == $dataName) {
            $query .=
              " INNER JOIN poker_tournament t" .
              " LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
              " WHERE t.tournamentDate BETWEEN s.seasonStartDate AND s.seasonEndDate AND t.tournamentId = " . $params[0] . " AND st.typeDescription = '" . $params[1] . "'";
          } else if ("seasonSelectOneByActive" == $dataName) {
            $query .= " WHERE seasonActive = " . $params[0];
          }
          if (isset($params[2]) && $params[2]) {
            $query .= " ORDER BY seasonStartDate DESC";
          }
          break;
        case "seasonSelectAllChampionship":
          $query =
            "SELECT seasonId, seasonDescription, seasonStartDate, seasonEndDate, seasonChampionshipQualify, seasonActive " .
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
            "FROM poker_user p INNER JOIN poker_result r ON p.id = r.playerId " . $this->buildUserActive(where: "AND", alias: "p") .
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
            "       l.playerId, CONCAT(u.first_name, ' ', u.last_name) AS playerName, l.address, l.city, l.state, l.zipCode, u.phone, l.map AS mapHide, l.mapLink AS map, t.tournamentDate AS date, t.startTime AS 'start', t.endTime AS 'end', t.maxPlayers AS 'max players', t.chipCount AS 'chips', -t.buyinAmount AS 'buyin', t.maxRebuys AS 'max', -t.rebuyAmount AS 'amt', -t.addonAmount AS 'amt ', " .
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
            "WHERE p.active = 1";
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
            "l.playerId, CONCAT(u.first_name, ' ', u.last_name) AS name, l.address, l.city, l.state, l.zipCode, u.phone, t.tournamentDate AS date, t.startTime AS 'start', t.endTime AS 'end', t.buyinAmount AS 'buyin', t.maxPlayers AS 'max players', t.maxRebuys AS 'max', t.rebuyAmount AS 'amt', t.addonAmount AS 'amt ', " .
            "t.addonChipCount AS 'chips ', t.rake, l.map AS mapHide, l.mapLink AS map, CASE WHEN ec.enteredCount IS NULL THEN 0 ELSE ec.enteredCount END AS enteredCount, u.active, t.specialTypeId, st.typeDescription AS std " .
            "FROM poker_user u INNER JOIN poker_result r ON u.id = r.playerId AND u.id = " . $params[0] .
            " INNER JOIN poker_tournament t ON t.tournamentId = r.tournamentId AND r.place = 1 " .
            "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
            "INNER JOIN poker_game_type gt ON t.gameTypeId = gt.gameTypeId " .
            "INNER JOIN poker_limit_type lt ON t.limitTypeId = lt.limitTypeId " .
            "INNER JOIN poker_location l ON t.locationId = l.locationId " .
            "LEFT JOIN (SELECT tournamentId, COUNT(*) AS enteredCount " . "           FROM poker_result " . "           WHERE statusCode = '" . Constant::$CODE_STATUS_FINISHED . "' " . "           AND place <> 0 " . "           GROUP BY tournamentId) ec ON t.tournamentId = ec.tournamentId " . "ORDER BY date, 'start time'";
          break;
        case "tournamentsPlayed":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.active, COUNT(*) AS tourneys " .
            "FROM poker_user u " .
//             "INNER JOIN poker_result r ON u.id = r.playerId AND r.place > 0 " .
            "LEFT OUTER JOIN poker_result r ON u.id = r.playerId AND r.place > 0 " .
            "WHERE u.active = '" . Constant::$FLAG_YES_DATABASE . "' " .
            "GROUP BY u.id <REPLACE>";
          if ($rank) {
            $whereClause = "<REPLACE>";
            $orderByFieldName = "tourneys DESC, " . $this->buildOrderByName(prefix: null);
            $selectFieldNames = "id, name, tourneys";
            $query = $this->modifyQueryAddRank(query: $query, whereClause: $whereClause, selectFieldName: "tourneys", selectFieldNames: $selectFieldNames, orderByFieldName: $orderByFieldName);
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
            "FROM poker_tournament_absence pta INNER JOIN poker_tournament pt ON pta.tournamentId = pt.tournamentId AND YEAR(tournamentDate) = " . $params[0] .
            " LEFT JOIN poker_special_type st ON pt.specialTypeId = st.typeId AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "'" .
            " INNER JOIN poker_user u ON pta.playerId = u.id";
          break;
        case "userPaidByTournamentId":
          $query =
            "SELECT p.id, CONCAT(p.first_name, ' ', p.last_name) AS name, p.username, p.password, p.email, p.administrator, p.registration_date, p.approval_date, p.approval_userid, p.rejection_date, p.rejection_userid, p.active, p.selector, p.token, p.expires " .
            "FROM poker_user p " .
            "INNER JOIN poker_result r ON p.id = r.playerId AND r.tournamentId = " . $params[0] . " AND r.buyinPaid = '" . Constant::$FLAG_YES . "' " .
            "ORDER BY " . $this->buildOrderByName(prefix: null);
          break;
        case "userActive":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.email " .
            "FROM poker_user u " .
            "WHERE u.active = '1' " .
            "ORDER BY " . $this->buildOrderByName(prefix: "u");
          break;
        case "userSelectAll":
        case "userSelectOneById":
        case "userSelectOneByUsername":
        case "userSelectOneByEmail":
          $query =
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, u.username, u.password, u.email, u.phone, u.administrator AS admin, u.registration_date AS 'Reg Date', u.approval_date AS 'App Date', u.approval_userid AS 'App User', CONCAT(ua.first_name, ' ', ua.last_name) AS 'App Name', u.rejection_date AS 'Reject Date', u.rejection_userid AS 'Reject User', CONCAT(ur.first_name, ' ', ur.last_name) AS 'Reject Name', u.active " .
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
          $query .= " ORDER BY " . $this->buildOrderByName(prefix: "u");
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
            "INNER JOIN poker_result r ON u.id = r.playerId AND r.tournamentId = " . $params[0] . $this->buildUserActive(where: "AND", alias: "u") .
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
            "            GROUP BY r.playerId) a ON u.id = a.playerId " . $this->buildUserActive(where: "AND", alias: "u");
          if ("winsTotalAndAverageForSeasonForUser" == $dataName || "winsForUser" == $dataName) {
            $whereClause = "WHERE u.id = " . $params[2];
            $query .= " WHERE u.id = " . $params[2];
          } else if ("winnersForSeason" == $dataName) {
            $query .= " WHERE wins > 0";
          }
          if ("winsForUser" != $dataName && "winsTotalAndAverageForSeasonForUser" != $dataName) {
            $query .= " ORDER BY wins DESC, " . $this->buildOrderByName(prefix: null);
          }
          if ($rank) {
            if (1 == $orderBy[0]) {
              $orderByFieldName = "wins DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "wins";
            } else {
              $orderByFieldName = "avg DESC, " . $this->buildOrderByName(prefix: null);
              $selectFieldName = "avg";
            }
            $selectFieldNames = "id, name, wins, avg, trnys";
            $query = $this->modifyQueryAddRank(query: $query, whereClause: $whereClause, selectFieldName: $selectFieldName, selectFieldNames: $selectFieldNames, orderByFieldName: $orderByFieldName);
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
          $query .= $this->buildOrderByName(prefix: null);
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
                  $address = new Address(debug: $this->isDebug(), id: null, address: $row["address"], city: $row["city"], state: $row["state"], zip: (int) $row["zipCode"]);
                  $user = new User(debug: $this->isDebug(), id: (int) $row["playerId"], name: $row["name"], username: null, password: null, email: $row["email"], phone: null, administrator: 0, registrationDate:null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: 0, address: $address, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires:null);
                  $location = new Location(debug: $this->isDebug(), id: null, name: "", user: $user, count: 0, active: 0, map: null, mapName: null, tournamentCount: 0);
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["tournamentDate"]);
                  $dateStartTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["startTime"]);
                  $tournament = new Tournament(debug: $this->isDebug(), id: (int) $row["tournamentId"], description: null, comment: null, limitType: null, gameType: null, specialType: null, chipCount: 0, location: $location, date: $dateTime, startTime: $dateStartTime, endTime: null, buyinAmount: 0, maxPlayers: 0, maxRebuys: 0, rebuyAmount: 0, addonAmount: 0, addonChipCount: 0, groupPayout: null, rake: 0, registeredCount: 0, buyinsPaid: 0, rebuysPaid: 0, rebuysCount: 0, addonsPaid: 0, enteredCount: 0);
                  array_push($resultList, $tournament);
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
                  $gameType = new GameType(debug: $this->isDebug(), id: $row["gameTypeId"], name: $row["gameTypeName"]);
                  array_push($resultList, $gameType);
                  break;
                case "groupSelectAll":
                case "groupSelectAllById":
                  $group = new Group(debug: $this->isDebug(), id: (int) $row["id"], name: $row["name"]);
                  array_push($resultList, $group);
                  break;
                case "groupPayoutSelectAll":
                case "groupPayoutSelectAllById":
                  $group = new Group(debug: $this->isDebug(), id: (int) $row["id"], name: $row["group name"]);
                  $aryPayouts = $this->getPayouts((int) $params[0], $dataName == "groupPayoutSelectAllById" ? (int) $params[1] : null, $dataName == "groupPayoutSelectAllById" ? true : false);
                  $groupPayout = new GroupPayout(debug: $this->isDebug(), id: null, group: $group, payouts: $aryPayouts);
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
                  $limitType = new LimitType(debug: $this->isDebug(), id: $row["limitTypeId"], name: $row["limitTypeName"]);
                  array_push($resultList, $limitType);
                  break;
                case "locationSelectAll":
                case "locationSelectById":
//                 case "locationSelectAllCount":
                  if ("locationSelectById" != $dataName) {
                    $name = $row["host"];
                  } else {
                    $name = "";
                  }
                  $address = new Address(debug: $this->isDebug(), id: null, address: $row["address"], city: $row["city"], state: $row["state"], zip: (int) $row["zip"]);
                  $user = new User(debug: $this->isDebug(), id: $row["playerId"], name: $name, username: null, password: null, email: null, phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: (int) $row["active"], address: $address, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  $location = new Location(debug: $this->isDebug(), id: $row["id"], name: $row["name"], user: $user, count: 0, active: (int) $row["active"], map: null, mapName: null, tournamentCount: "locationSelectAll" == $dataName ? (int) $row["trnys"] : 0);
                  array_push($resultList, $location);
                  break;
//                 case "locationSelectMaxId":
//                   array_push($resultList, (int) $row["id"]);
//                   break;
                case "login":
                  array_push($resultList, $row["password"]);
                  break;
                case "nemesisForUser":
                  array_push($resultList, $row["name"]);
                  array_push($resultList, $row["active"]);
                  array_push($resultList, $row["numKOs"]);
                  break;
                case "notificationSelectAll":
                case "notificationSelectOneById":
                  $startDateTime = new DateTime(debug:$this->isDebug(), id: null, time: $row["start date"]);
                  $endDateTime = new DateTime(debug:$this->isDebug(), id: null, time: $row["end date"]);
                  $notification = new Notification(debug:$this->isDebug(), id: (int) $row["id"], description: $row["description"], startDate: $startDateTime, endDate: $endDateTime);
                  array_push($resultList, $notification);
                  break;
                case "payoutSelectMaxId":
                  array_push($resultList, (int) $row["id"]);
                  break;
                case "payoutSelectNameList":
                  $values = array($row["payoutId"], $row["payoutName"]);
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
                  $values = array($row["name"], $row["email"], $row["maxPlayers"], $row["active"]);
                  array_push($resultList, $values);
                  break;
                case "resultIdMax":
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "resultSelectAll":
                case "resultSelectOneByTournamentIdAndPlayerId":
                case "resultSelectRegisteredByTournamentId":
                case "resultSelectAllFinishedByTournamentId":
                case "resultSelectPaidByTournamentId":
                case "resultSelectPaidNotEnteredByTournamentId":
                  $status = new Status(debug: $this->isDebug(), id: null, code: $row["statusCode"], name: $row["status"]);
                  $tournament = new Tournament(debug: $this->isDebug(), id: (int) $row["tournamentId"], description: null, comment: null, limitType: null, gameType: null, specialType: null, chipCount: 0, location: null, date: null, startTime: null, endTime: null, buyinAmount: 0, maxPlayers: 0, maxRebuys: 0, rebuyAmount: 0, addonAmount: 0, addonChipCount: 0, groupPayout: null, rake: 0, registeredCount: 0, buyinsPaid: 0, rebuysPaid: 0, rebuysCount: 0, addonsPaid: 0, enteredCount: 0);
                  $user = new User(debug: $this->isDebug(), id:(int) $row["playerId"], name: $row["name"], username: null, password: null, email: $row["email"], phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: (int) $row["active"], address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  if (isset($row["knocked out by"])) {
                    $nameKnockedOutBy = $row["knocked out by"];
                  } else {
                    $nameKnockedOutBy = "";
                  }
                  $knockedOutBy = new User(debug: $this->isDebug(), id: (int) $row["knockedOutBy"], name: $nameKnockedOutBy, username: null, password: null, email: null, phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: isset($row["knockedOutActive"]) ? (int) $row["knockedOutActive"] : 0, address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  //(bool $debug, string|int|null $id, Tournament $tournament, User $user, Status $status, int $registerOrder, bool $buyinPaid, bool $rebuyPaid, bool $addonPaid, int $rebuyCount,
                  // bool $addonFlag, int $place, User $knockedOutBy, string $food) {
                  $buyinPaid = new BooleanString($row["buyinPaid"]);
                  $rebuyPaid = new BooleanString($row["rebuyPaid"]);
                  $addonPaid = new BooleanString($row["addon"]);
                  $addonFlag = new BooleanString($row["addonFlag"]);
                  $result = new Result(debug: $this->isDebug(), id: null, tournament: $tournament, user: $user, status: $status, registerOrder: (int) $row["registerOrder"], buyinPaid: $buyinPaid->getBoolean(), rebuyPaid: $rebuyPaid->getBoolean(), addonPaid: $addonPaid->getBoolean(), rebuyCount: (int) $row["rebuy"], addonFlag: $addonFlag->getBoolean(), place: (int) $row["place"], knockedOutBy: $knockedOutBy, food: $row["food"]);
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
                  $startDateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["start date"]);
                  $endDateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["end date"]);
                  $season = new Season(debug: $this->isDebug(), id: $row["id"], description: $row["description"], startDate: $startDateTime, endDate: $endDateTime, championshipQualify: (int) $row["# to qualify"], active: (int) $row["active"]);
                  array_push($resultList, $season);
                  break;
                case "statusSelectPaid":
                  $values = array($row["id"], $row["name"], $row["buyin status"], $row["rebuy status"], $row["rebuyCount"], $row["addon status"]);
                  array_push($resultList, $values);
                  break;
                case "statusSelectAll":
                  $status = new Status(debug: $this->isDebug(), id: null, code: (int) $row["statusCode"], name: null);
                  array_push($resultList, $status);
                  break;
                case "structureSelectAll":
                case "structurePayout":
                  if ("structureSelectAll" == $dataName) {
                    $structure = new Structure(debug: $this->isDebug(), id: null, place: (int) $row["place"], percentage: (float) $row["percentage"]);
                    array_push($resultList, $structure);
                  } else if ("structurePayout" == $dataName) {
                    $values = array($row["place"], $row["percentage"], (float) $row["pay"]);
                    array_push($resultList, $values);
                  }
                  break;
                case "tournamentIdMax":
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "tournamentAll":
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["tournamentDate"]);
                  $tournament = new Tournament(debug: $this->isDebug(), id: $row["tournamentId"], description: $row["tournamentDesc"], comment: null, limitType: null, gameType: null, specialType: null, chipCount: 0, location: null, date: $dateTime, startTime: null, endTime: null, buyinAmount: 0, maxPlayers: 0, maxRebuys: 0, rebuyAmount: 0, addonAmount: 0, addonChipCount: 0, groupPayout: null, rake: 0, registeredCount: 0, buyinsPaid: 0, rebuysPaid: 0, rebuysCount: 0, addonsPaid: 0, enteredCount: 0);
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
                  $limitType = new LimitType(debug: $this->isDebug(), id: $row["limitTypeId"], name: $row["limit"]);
                  $gameType = new GameType(debug: $this->isDebug(), id: $row["gameTypeId"], name: $row["type"]);
                  $specialType = new SpecialType(debug: $this->isDebug(), id: $row["specialTypeId"], description: $row["std"]);
                  $address = new Address(debug: $this->isDebug(), id: null, address: $row["address"], city: $row["city"], state: $row["state"], zip: (int) $row["zipCode"]);
                  if ("tournamentsWonByPlayerId" != $dataName) {
                      $name = $row["playerName"];
                  } else {
                      $name = "";
                  }
                  $phone = new Phone(debug: $this->isDebug(), id: null, value: $row["phone"]);
                  $user = new User(debug: $this->isDebug(), id: $row["playerId"], name: $name, username: null, password: null, email: null, phone: $phone, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: 0, address: $address, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  $location = new Location(debug: $this->isDebug(), id: $row["locationId"], name: $row["location"], user: $user, count: 0, active: 0, map: $row["mapHide"], mapName: $row["map"], tournamentCount: 0);
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["date"]);
                  $dateTimeStart = new DateTime(debug: $this->isDebug(), id: null, time: $row["start"]);
                  $dateTimeEnd = new DateTime(debug: $this->isDebug(), id: null, time: $row["end"]);
                  if (!isset($row["std"]) || (isset($row["std"]) && strpos($row["std"], Constant::$DESCRIPTION_CHAMPIONSHIP) === false)) {
                    $maxPlayers = (int) $row["max players"];
                  } else {
                    $databaseResult = new DatabaseResult(debug: $this->isDebug());
                    //TODO: move sessionutility to callers
                    //$params = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
                    $maxPlayers = (int) count($databaseResult->getChampionshipQualifiedPlayers(params: $paramsNested));
                  }
                  if ("tournamentsWonByPlayerId" != $dataName) {
                    $group = new Group($this->isDebug(), $row["groupId"], $row["name"]);
                    $groupPayout = new GroupPayout(debug: $this->isDebug(), id: null, group: $group, payouts: $this->getPayouts(groupId: (int) $row["groupId"], payoutId: null, structureFlag: true));
                  } else {
                    $groupPayout = null;
                  }
                  // $tournament->setDirections($row["map"]);
                  if ("tournamentsWonByPlayerId" != $dataName) {
                    $registeredCount = (int) $row["registeredCount"];
                    $buyinsPaid = (int) $row["buyinsPaid"];
                    $rebuysPaid = (int) $row["rebuysPaid"];
                    $rebuysCount = (int) $row["rebuysCount"];
                    $addonsPaid = (int) $row["addonsPaid"];
                  } else {
                      $registeredCount = 0;
                      $buyinsPaid = 0;
                      $rebuysPaid = 0;
                      $rebuysCount = 0;
                      $addonsPaid = 0;
                  }
                  //$debug, $id, $description, $comment, $limitType, $gameType, $specialType, $chipCount, $location, $date, $startTime, $endTime, 
//                   $buyinAmount, $maxPlayers, $maxRebuys, $rebuyAmount, $addonAmount, $addonChipCount, $groupPayout, $rake, $registeredCount, 
//                   $buyinsPaid, $rebuysPaid, $rebuysCount, $addonsPaid, $enteredCount
                  $tournament = new Tournament(debug: $this->isDebug(), id: $row["id"], description: $row["description"], comment: $row["comment"], limitType: $limitType, gameType: $gameType, specialType: $specialType, chipCount: (int) $row["chips"], location: $location, date: $dateTime, startTime: $dateTimeStart, endTime: $dateTimeEnd, buyinAmount: (int) $row["buyin"], maxPlayers: $maxPlayers, maxRebuys: (int) $row["max"], rebuyAmount: (int) $row["amt"], addonAmount: (int) $row["amt "], addonChipCount: (int) $row["chips "], groupPayout: $groupPayout, rake: (float) ($row["rake"] * 100), registeredCount: $registeredCount, buyinsPaid: $buyinsPaid, rebuysPaid: $rebuysPaid, rebuysCount: $rebuysCount, addonsPaid: $addonsPaid, enteredCount: (int) $row["enteredCount"]);
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
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["tournamentDate"]);
                  array_push($resultList, $dateTime);
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["startTime"]);
                  array_push($resultList, $dateTime);
                  array_push($resultList, $row["locationName"]);
                  array_push($resultList, (int) $row["buyinsPaid"]);
                  break;
                case "seasonSelectAllChampionship":
                  $startDateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["seasonStartDate"]);
                  $endDateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["seasonEndDate"]);
                  $season = new Season(debug: $this->isDebug(), id: $row["id"], description: $row["seasonDescription"], startDate: $startDateTime, endDate: $endDateTime, championshipQualify: (int) $row["# to qualify"], active: $row["seasonActive"]);
                  array_push($resultList, $season);
                  break;
                case "specialTypeSelectAll":
                case "specialTypeSelectOneById":
                  $specialType = new SpecialType(debug: $this->isDebug(), id: $row["id"], description: $row["description"]);
                  array_push($resultList, $specialType);
                  break;
                case "tournamentSelectAllYearsPlayed":
                  array_push($resultList, (int) $row["year"]);
                  break;
                case "tournamentsSelectForEmailNotifications":
                  break;
                case "tournamentsPlayedByPlayerIdAndDateRange":
                  array_push($resultList, (int) $row["numPlayed"]);
                  break;
                case "tournamentsPlayedByType":
                  $object = array();
                  $limitType = new LimitType(id: (int) $row["limitTypeId"], name: $row["limit type"]);
                  array_push($object, $limitType);
                  array_push($resultList, $object);
                  $gameType = new GameType(id: (int) $row["gameTypeId"], name: $row["game type"]);
                  array_push($object, $gameType);
                  array_push($resultList, $object);
                  array_push($object, (int) $row["count"]);
                  array_push($object, (int) $row["rebuys"]);
                  break;
                case "tournamentsPlayedFirst":
                  $dateTime = new DateTime(debug: $this->isDebug(), id: null, time: $row["date"]);
                  array_push($resultList, $dateTime);
                  break;
                case "tournamentIdList":
                  $object = array();
                  array_push($resultList, (int) $row["tournamentId"]);
                  break;
                case "userAbsencesByTournamentId":
                  $values = array($row["playerId"], $row["name"]);
                  array_push($resultList, $values);
                  break;
                case "userActive":
                  $user = new User(debug: $this->isDebug(), id: (int) $row["id"], name: $row["name"], username: null, password: null, email: $row["email"], phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: null, approvalName: null, rejectionDate: null, rejectionUserid: null, rejectionName: null, active: 1, address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  array_push($resultList, $user);
                  break;
                case "userSelectAll":
                case "userSelectOneById":
                case "userSelectOneByUsername":
                case "userSelectOneByEmail":
                case "userPaidByTournamentId":
                  $phone = new Phone(debug: $this->isDebug(), id: null, value: $row[5]);
                  $user = new User(debug: $this->isDebug(), id: (int) $row["id"], name: $row["name"], username: $row[2], password: $row[3], email: $row[4], phone: $phone, administrator: (int) $row[6], registrationDate: $row[7], approvalDate: $row[8], approvalUserid: (int) $row[9], approvalName: $row[10], rejectionDate: $row[11], rejectionUserid: (int) $row[12], rejectionName: $row[13], active: (int) $row[14], address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
                  array_push($resultList, $user);
                  break;
                case "usersSelectForEmailNotifications":
                  $user = new User(debug: $this->isDebug(), id: $row["id"], name: $row["name"], username: null, password: null, email: $row["email"], phone: null, administrator: 0, registrationDate: null, approvalDate: null, approvalUserid: 0, approvalName: null, rejectionDate: null, rejectionUserid: 0, rejectionName: null, active: 0, address: null, resetSelector: null, resetToken: null, resetExpires: null, rememberSelector: null, rememberToken: null, rememberExpires: null);
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
              $resultList = $this->getPayouts(groupId: null, payoutId: $dataName == "payoutSelectAllById" ? (int) $params[0] : null, structureFlag: $dataName == "payoutSelectAllById" ? true : false);
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
  private function getPayouts(int|null $groupId, int|null $payoutId, bool $structureFlag) {
    $payouts = array();
    $queryNested =
      "SELECT p.payoutId AS id, p.payoutName AS name, p.bonusPoints AS 'bonus pts', p.minPlayers AS 'min players', p.maxPlayers AS 'max players' " .
      "FROM poker_payout p ";
    if (isset($groupId)) {
      $queryNested .=
        " INNER JOIN poker_group_payout gp ON gp.payoutId = p.payoutId" .
        " WHERE gp.groupId = " . $groupId;
    }
    if (isset($payoutId)) {
      if (isset($groupId)) {
        $queryNested .= " AND ";
      } else {
        $queryNested .= " WHERE ";
      }
      $queryNested .= "p.payoutId = " . $payoutId;
    }
    $queryResultNested = $this->getConnection()->query($queryNested);
    if ($queryResultNested) {
      $numRecords = $queryResultNested->rowCount();
      $hasRecords = 0 < $numRecords;
      if ($hasRecords) {
        $structures = null;
        $ctr2 = 0;
        while ($rowNested = $queryResultNested->fetch(PDO::FETCH_BOTH)) {
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
                  $structure = new Structure(debug: $this->isDebug(), id: null, place: (int) $rowNested2["place"], percentage: (float) $rowNested2["percentage"]);
                  $structures[$ctr3] = $structure;
                  $ctr3++;
                }
              }
            }
            $queryResultNested2->closeCursor();
          }
          $payout = new Payout(debug: $this->isDebug(), id: (int) $rowNested["id"], name: $rowNested["name"], bonusPoints: (int) $rowNested["bonus pts"], minPlayers: (int) $rowNested["min players"], maxPlayers: (int) $rowNested["max players"], structures: $structures);
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
  private function deleteData(string $dataName, array $params = null) {
    $numRecords = 0;
    try {
      switch ($dataName) {
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
        case "notificationDelete":
          $query =
            "DELETE FROM poker_notification " .
            "WHERE id IN (" . $params[0] . ")";
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
  private function insertData(string $dataName, array $params = null) {
    $numRecords = 0;
//     try {
      switch ($dataName) {
        case "groupInsert":
          $query = "INSERT INTO poker_group(groupId, groupName) " . "SELECT IFNULL(MAX(groupId), 0) + 1, '" . $params[0] . "' FROM poker_group";
          break;
        case "groupPayoutInsert":
          $query = "INSERT INTO poker_group_payout(groupId, payoutId) VALUES(" . $params[0] . ", " . $params[1] . ")";
          break;
        case "locationInsert":
          $query = "INSERT INTO poker_location(locationId, locationName, playerId, address, city, state, zipCode) " . "SELECT IFNULL(MAX(locationId), 0) + 1, '" . $params[0] . "', " . $params[1] . ", '" . $params[2] . "', '" . $params[3] . "', UPPER('" . $params[4] . "'), " . $params[5] . " FROM poker_location";
          break;
        case "notificationInsert":
          $query = "INSERT INTO poker_notification(id, description, startDate, endDate) " . "SELECT IFNULL(MAX(id), 0) + 1, '" . $params[0] . "', '" . $params[1] . "', '" . $params[2] . "' FROM poker_notification";
          break;
        case "payoutInsert":
          $query = "INSERT INTO poker_payout(payoutId, payoutName, bonusPoints, minPlayers, maxPlayers) " . "SELECT IFNULL(MAX(payoutId), 0) + 1, '" . $params[0] . "', " . $params[1] . ", " . $params[2] . ", " . $params[3] . " FROM poker_payout";
          break;
        case "registrationInsert":
          $query = "INSERT INTO poker_result(tournamentId, playerId, rebuyCount, statusCode, registerOrder, addonFlag, place, knockedOutBy, food) " . "SELECT " . $params[0] . ", " . $params[1] . ", 0, '" . Constant::$CODE_STATUS_REGISTERED . "', CASE WHEN MAX(registerOrder) IS NULL THEN 1 ELSE MAX(registerOrder) + 1 END, '" . Constant::$FLAG_NO . "', 0, NULL, '" . $params[2] . "' FROM poker_result WHERE tournamentId = " . $params[0];
          break;
        case "seasonInsert":
          $query = "INSERT INTO poker_season(seasonId, seasonDescription, seasonStartDate, seasonEndDate, seasonChampionshipQualify, seasonActive) " . "SELECT IFNULL(MAX(seasonId), 0) + 1, '" . $params[0] . "', '" . $params[1] . "', '" . $params[2] . "', " . $params[3] . ", " . (isset($params[4]) ? $params[4] : 0) . " FROM poker_season";
          break;
        case "structureInsert":
          $query = "INSERT INTO poker_structure(payoutId, place, percentage) VALUES(" . $params[0] . ", " . $params[1] . ", " . $params[2] . ")";
          break;
        case "tournamentInsert":
          $query = "INSERT INTO poker_tournament(tournamentId, tournamentDesc, comment, limitTypeId, gameTypeId, chipCount, locationId, tournamentDate, startTime, endTime, buyinAmount, maxPlayers, maxRebuys, rebuyAmount, addonAmount, addonChipCount, groupId, rake, map, specialTypeId) " . "SELECT IFNULL(MAX(tournamentId), 0) + 1, " . (isset($params[0]) ? "'" . $params[0] . "'" : "null") . ", " . (isset($params[1]) == 0 ? "'" . $params[1] . "'" : "null") . ", " . $params[2] . ", " . $params[3] . ", " . $params[4] . ", " . $params[5] . ", " . (isset($params[6]) ? "'" . $params[6]->getDatabaseFormat() . "'" : "null") . ", " . (isset($params[7]) ? "'" . $params[7]->getDatabaseTimeFormat() . "'" : "null") . ", " . (isset($params[8]) ? "'" . $params[8] . "'" : "null") . ", " . $params[9] . ", " . $params[10] . ", " . $params[11] . ", " . $params[12] . ", " . $params[13] . ", " . $params[14] . ", " . $params[15] . ", " . (isset($params[16]) ? $params[16] : "null") . ", " . (strlen($params[17]) > 0 ? ("'" . $params[17]) . "'" : "null") . ", " . (strlen($params[18]) > 0 ? "'" . $params[18] . "'" : "null") . " FROM poker_tournament";
          break;
        case "specialTypeInsert":
          $query = "INSERT INTO poker_special_type(typeId, typeDescription) " . "SELECT IFNULL(MAX(typeId), 0) + 1, '" . $params[0] . "' FROM poker_special_type";
          break;
        case "userInsert":
//           $query = "INSERT INTO poker_user(id, first_name, last_name, username, password, email, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, reset_selector, reset_token, reset_expires, remember_selector, remember_token, remember_expires) " .
          $query = "INSERT INTO poker_user(id, first_name, last_name, username, password, email, phone, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, selector, token, expires) " .
          // "SELECT MAX(id) + 1, '" . $params[0] . "', '" . $params[1] . "', '" . $params[2] . "', '" . password_hash($params[3], PASSWORD_DEFAULT) . "', '" . $params[4] . "', 0, CURRENT_TIMESTAMP, null, null, null, null, 0, null, null, null, null, null, null FROM poker_user";
          "SELECT MAX(id) + 1, '" . $params[1] . "', '" . $params[2] . "', '" . $params[3] . "', '" . password_hash($params[4], PASSWORD_DEFAULT) . "', '" . $params[5] . "', " . $params[6] . ", " . (isset($params[7]) ? $params[7] : "0") . ", " . (isset($params[8]) ? "'" . $params[8] . "'" : "CURRENT_TIMESTAMP") . ", " . (isset($params[9]) ? "'" . $params[9] . "'" : "CURRENT_TIMESTAMP") . ", " . (isset($params[10]) ? "'" . $params[10] . "'" : "null") . ", " . (isset($params[11]) ? "'" . $params[11] . "'" : "null") . ", " . (isset($params[12]) ? $params[12] : "null") . ", " . (isset($params[13]) ? $params[13] : "0") . ", " . (isset($params[14]) ? $params[14] : "null") . ", " . (isset($params[14]) ? $params[14] : "null") . ", " . (isset($params[15]) ? $params[15] : "null") . " FROM poker_user";
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
//     } catch (Exception $e) {
//       throw new Exception($e);
//     }
    return $numRecords;
  }
  // $dataName is query name
  // $params is array of input parameters
  private function updateData(string $dataName, array $params = null) {
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
            " WHERE locationId = " . $params[6];
          break;
        case "notificationUpdate":
          $query =
            "UPDATE poker_notification " .
            "SET description = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            ", startDate = '" . $params[2] .
            "', endDate = '" . $params[3] .
            "' WHERE id = " . $params[0];
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
            "SET food = '" . $params[0] .
            "' WHERE tournamentId = " . $params[1] .
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
        case "resultUpdateByTournamentId":
          $query =
            "UPDATE poker_result SET " .
            (isset($params[0]) ? "rebuyCount = '" . $params[0] . "'" : "") .
            (isset($params[0]) && (isset($params[1]) || isset($params[2]) || isset($params[3])) ? ", " : "") .
            (isset($params[1]) ? "rebuyPaid = '" . $params[1] . "'" : "") .
            (isset($params[1]) && (isset($params[2]) || isset($params[3])) ? ", " : "") .
            (isset($params[2]) ? " addonPaid = '" . $params[2] . "'" : "") .
            (isset($params[2]) && (isset($params[3])) ? ", " : "") .
            (isset($params[3]) ? " addonFlag = '" . $params[3] . "' " : "") .
            " WHERE tournamentId = " . $params[4];
          break;
        case "seasonUpdate":
          $query =
            "UPDATE poker_season " .
            "SET seasonDescription = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            ", seasonStartDate = '" . $params[2] .
            "', seasonEndDate = '" . $params[3] .
            "', seasonChampionshipQualify = " . $params[4] .
            ", seasonActive = " . (isset($params[5]) ? $params[5] : 0) .
            " WHERE seasonId = " . $params[0];
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
          // id, first_name, last_name, username, password, email, phone, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, reset_selector, reset_token, reset_expires, remember_selector, remember_token, remember_expires
          "SET";
          if (!empty($params[0])) {
            $query .= " id = " . $params[0];
          }
          if (!empty($params[1])) {
            if (!empty($params[0])) {
              $query .= ", ";
            }
            $query .= " first_name = '" . $params[1] . "'";
          }
          if (!empty($params[2])) {
            if (!empty($params[0]) || ! empty($params[1])) {
              $query .= ", ";
            }
            $query .= " last_name = '" . $params[2] . "'";
          }
          if (!empty($params[3])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2])) {
              $query .= ", ";
            }
            $query .= " username = '" . $params[3] . "'";
          }
          if (!empty($params[4])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3])) {
              $query .= ", ";
            }
            $query .= " password = '" . password_hash($params[4], PASSWORD_DEFAULT) . "'";
          }
          if (!empty($params[5])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4])) {
              $query .= ", ";
            }
            $query .= " email = '" . $params[5] . "'";
          }
          if (!empty($params[6])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5])) {
              $query .= ", ";
            }
            $query .= " phone = " . $params[6];
          }
          if (isset($params[7]) && in_array($params[7], $validValues)) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6])) {
              $query .= ", ";
            }
            $query .= " administrator = '" . $params[7] . "'";
          }
          if (!empty($params[8])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7])) {
              $query .= ", ";
            }
              $query .= " registration_date = '" . $params[8] . "'";
          }
          if (!empty($params[9])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8])) {
              $query .= ", ";
            }
            $query .= " approval_date = " . ($params[9] == "CURRENT_TIMESTAMP" ? $params[9] : "'" . $params[9] . "'");
          }
          if (!empty($params[10])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9])) {
              $query .= ", ";
            }
            $query .= " approval_userid = " . $params[10];
          }
          if (!empty($params[11])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9]) || ! empty($params[10])) {
              $query .= ", ";
            }
            $query .= " rejection_date = " . ($params[11] == "CURRENT_TIMESTAMP" ? $params[11] : "'" . $params[11] . "'");
          }
          if (!empty($params[12])) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9]) || ! empty($params[10]) || ! empty($params[11])) {
              $query .= ", ";
            }
            $query .= " rejection_userid = '" . $params[12] . "'";
          }
          if (isset($params[13]) && in_array($params[13], $validValues)) {
            if (!empty($params[0]) || ! empty($params[1]) || ! empty($params[2]) || ! empty($params[3]) || ! empty($params[4]) || ! empty($params[5]) || ! empty($params[6]) || ! empty($params[7]) || ! empty($params[8]) || ! empty($params[9]) || ! empty($params[10]) || ! empty($params[11]) || ! empty($params[12])) {
              $query .= ", ";
            }
            $query .= " active = '" . $params[13] . "'";
          }
          if (!empty($params[14])) {
            $query .= " selector = '" . $params[14] . "'";
          }
          if (!empty($params[15])) {
            $query .= " token = '" . $params[15] . "'";
          }
          if (!empty($params[16])) {
            $query .= " expires = '" . $params[16] . "'";
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
            "UPDATE poker_special_type " .
            "SET typeDescription = " . (strlen(trim($params[1])) == 0 ? "null" : "'" . $params[1] . "'") .
            " WHERE typeId = " . $params[0];
          break;
        case "userUpdateReset":
          $selector = bin2hex(random_bytes(length: 8));
          $token = random_bytes(length: 32);
          $expires = new \DateTime("NOW");
          $expires->add(new \DateInterval("P1D")); // 1 day
          $query = "UPDATE poker_user " . "SET selector = '" . $selector . "', token = '" . hash('sha256', $token) . "', expires = " . $expires->format('U') . " WHERE username = '" . $params[0] . "' " . "AND email = '" . $params[1] . "'";
          break;
        case "userUpdateChangePassword":
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
      throw new Exception($e->getMessage());
    }
    return $numRecords;
  }
  // $prefix is table alias
  private function buildOrderByName(string|null $prefix) {
    $alias = isset($prefix) ? $prefix . "." : "";
    return $alias . "last_name, " . $alias . "first_name";
  }
  private function buildChampionship(array $params) {
//     $query =
//       "SELECT YEAR(t.tournamentDate) AS Yr, p.Id, p.first_name, p.last_name, CONCAT(p.first_name, ' ', p.last_name) AS name, " .
//       "                                          (SELECT SUM(total) AS 'Total Pool' " . 
//       "                                           FROM (SELECT YEAR(t2.tournamentDate) AS Yr, t2.TournamentId AS Id, CASE WHEN b.Play IS NULL THEN 0 ELSE CONCAT(b.Play, '+', CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END, 'r', '+', CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END, 'a') END AS Play, " .
//       "                                                        ((t2.BuyinAmount * t2.Rake) * Play) + ((t2.RebuyAmount * t2.Rake) * CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END) + " .
//       "                                                         ((t2.AddonAmount * t2.Rake) * CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END) AS Total " .
//       "                                                 FROM poker_tournament t2 " .
//       "                                                 LEFT JOIN (SELECT TournamentId, COUNT(*) AS Play " .
//       "                                                            FROM poker_result " .
//       "                                                            WHERE buyinPaid = '" . Constant::$FLAG_YES . "' AND Place > 0 " .
//       "                                                            GROUP BY TournamentId) b ON t2.TournamentId = b.TournamentId";
//     if (isset($params[0]) && isset($params[1])) {
//       $query .=
//       "                                                 AND t2.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
//     }
//     $query .= "                                                 LEFT JOIN (SELECT r.TournamentId, SUM(r.rebuyCount) AS NumRebuys " .
//       "                                                            FROM poker_result r " .
//       "                                                            WHERE r.rebuyPaid = '" . Constant::$FLAG_YES . "' " .
//       "                                                            AND r.RebuyCount > 0 " .
//       "                                                            GROUP BY r.TournamentId) nr ON t2.TournamentId = nr.TournamentId " .
//       "                                                LEFT JOIN (SELECT r.TournamentId, COUNT(*) AS NumAddons " .
//       "                                                           FROM poker_result r " .
//       "                                                           WHERE r.AddonPaid = '" . Constant::$FLAG_YES . "' " .
//       "                                                           GROUP BY r.TournamentId) na ON t2.TournamentId = na.TournamentId) zz " .
//       "                                                WHERE zz.yr = YEAR(t.tournamentDate) " .
//       "                                                GROUP BY zz.yr) * CASE WHEN s.Percentage IS NULL THEN 0 ELSE s.Percentage END AS Earnings " .
//       "                                   FROM poker_result r INNER JOIN poker_user p ON r.PlayerId = p.Id " .
//       "                                   INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId";
//     if (isset($params[0]) && isset($params[1])) {
//       $query .=
//         "                                   AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
//     }
//     $query .=
//       "                                   LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId" .
//       "                                   LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
//       "                                              FROM (SELECT np.tournamentId, p.payoutId " .
//       "                                                    FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers " .
//       "                                                          FROM poker_result r " .
//       "                                                          WHERE r.place > 0 " .
//       "                                                          AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') " .
//       "                                                          GROUP BY r.tournamentId) np " .
//       "                                                    INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId";
//     if (isset($params[0]) && isset($params[1])) {
//       $query .=
//         "                                                    AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
//     }
//     $query .=
//       "                                                    INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
//       "                                                    INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
//       "                                              INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
//       "                                   WHERE r.Place > 0 " .
//       "                                   AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "'";
    $query = 
      "SELECT se.seasonStartDate, YEAR(t.tournamentDate) AS Yr, p.Id, p.first_name, p.last_name, CONCAT(p.first_name, ' ', p.last_name) AS name, " .
      "       qq.total * CASE WHEN s.Percentage IS NULL THEN 0 ELSE s.Percentage END AS Earnings, numTourneys AS trnys " .
      "FROM poker_result r " .
      "INNER JOIN poker_user p ON r.PlayerId = p.Id " .
      "INNER JOIN poker_tournament t ON r.TournamentId = t.TournamentId ";
      if (isset($params[0]) && isset($params[1])) {
        $query .=
          "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
      }
      $query .=
        "INNER JOIN poker_season se ON t.tournamentDate BETWEEN se.seasonStartDate AND se.seasonEndDate " .
        "INNER JOIN (SELECT seasonStartDate, seasonEndDate, SUM(total) - CASE WHEN YEAR(seasonEndDate) = 2008 THEN 150 ELSE CASE WHEN YEAR(seasonEndDate) = 2007 THEN -291 ELSE CASE WHEN YEAR(seasonEndDate) = 2006 THEN -824 ELSE 0 END END END AS total " .
        "            FROM (SELECT se2.seasonStartDate, se2.seasonEndDate, t2.TournamentId AS Id, CASE WHEN b.Play IS NULL THEN 0 ELSE CONCAT(b.Play, '+', CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END, 'r', '+', CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END, 'a') END AS Play, ((t2.BuyinAmount * t2.Rake) * Play) + ((t2.RebuyAmount * t2.Rake) * CASE WHEN nr.NumRebuys IS NULL THEN 0 ELSE nr.NumRebuys END) + ((t2.AddonAmount * t2.Rake) * CASE WHEN na.NumAddons IS NULL THEN 0 ELSE na.NumAddons END) AS Total " .
        "                  FROM poker_tournament t2 " .
        "                  INNER JOIN poker_season se2 ON t2.tournamentDate BETWEEN se2.seasonStartDate AND se2.seasonEndDate " .
        "                  LEFT JOIN (SELECT TournamentId, COUNT(*) AS Play FROM poker_result WHERE buyinPaid = 'Y' AND Place > 0 GROUP BY TournamentId) b ON t2.TournamentId = b.TournamentId " .
        "                  LEFT JOIN (SELECT r.TournamentId, SUM(r.rebuyCount) AS NumRebuys FROM poker_result r WHERE r.rebuyPaid = 'Y' AND r.RebuyCount > 0 GROUP BY r.TournamentId) nr ON t2.TournamentId = nr.TournamentId " .
        "                  LEFT JOIN (SELECT r.TournamentId, COUNT(*) AS NumAddons FROM poker_result r WHERE r.AddonPaid = 'Y' GROUP BY r.TournamentId) na ON t2.TournamentId = na.TournamentId) zz " .
        "            GROUP BY seasonStartDate, seasonEndDate) qq ON qq.seasonStartDate = se.seasonStartDate AND qq.seasonEndDate = se.seasonEndDate " .
        "LEFT JOIN poker_special_type st ON t.specialTypeId = st.typeId " .
        "INNER JOIN (SELECT r1.playerId, COUNT(*) AS NumTourneys FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentId = t1.tournamentId AND r1.place > 0 INNER JOIN poker_special_type st1 ON t1.specialTypeId = st1.typeId AND st1.typeDescription = 'Championship' GROUP BY r1.playerId) nt ON r.playerId = nt.playerId " .
        "LEFT JOIN (SELECT a.tournamentId, s1.payoutId, s1.place, s1.percentage " .
        "          FROM (SELECT np.tournamentId, p.payoutId " .
        "                FROM (SELECT r.tournamentId, COUNT(*) AS numPlayers FROM poker_result r WHERE r.place > 0 AND r.statusCode IN ('" . Constant::$CODE_STATUS_REGISTERED . "','" . Constant::$CODE_STATUS_FINISHED . "') GROUP BY r.tournamentId) np " .
        "                INNER JOIN poker_tournament t on np.tournamentId = t.tournamentId ";
      if (isset($params[0]) && isset($params[1])) {
        $query .=
          "            AND t.tournamentDate BETWEEN '" . $params[0] . "' AND '" . $params[1] . "' ";
      }
      $query .=
        "                INNER JOIN poker_group_payout gp ON t.GroupId = gp.GroupId " .
        "                INNER JOIN poker_payout p ON gp.PayoutId = p.PayoutId AND np.numPlayers BETWEEN p.minPlayers AND p.maxPlayers) a " .
        "          INNER JOIN poker_structure s1 ON a.payoutId = s1.payoutId) s ON r.tournamentId = s.tournamentId AND r.place = s.place " .
        "WHERE r.Place > 0 " .
        "AND st.typeDescription = '" . Constant::$DESCRIPTION_CHAMPIONSHIP . "' ";
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
  private function modifyQueryAddRank(string $query, string $whereClause, string $selectFieldName, string $selectFieldNames, string $orderByFieldName) {
    if ($this->isDebug()) {
      echo "<br>orig -> " . $query;
    }
    $queryTemp = substr_replace($query, "SELECT ROW_NUMBER() OVER (ORDER BY " . $selectFieldName . " DESC, name) AS row, RANK() OVER (ORDER BY " . $selectFieldName . " DESC) AS rank, " . $selectFieldNames . " FROM (SELECT ", 0, 6);
    $queryTemp = str_replace(search: $whereClause, replace: "ORDER BY " . $selectFieldName . " DESC, last_name, first_name) z ORDER BY row, name", subject: $queryTemp);
    return $queryTemp;
  }
}
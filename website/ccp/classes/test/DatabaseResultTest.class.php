<?php
namespace ccp\classes\Test;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class DatabaseResultTest extends BaseTest {
  public static function testGetBounty() {
    $databaseResult = new DatabaseResult();
    $bountyList = $databaseResult->getBounty();
    echo "<br>testGetBounty " . ((count($bountyList) == 2) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFee() {
    $databaseResult = new DatabaseResult();
    $feeList = $databaseResult->getFee();
    echo "<br>testGetFee " . ((count($feeList)> 10) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGameType() {
    $databaseResult = new DatabaseResult();
    $gameTypeList = $databaseResult->getGameType();
    echo "<br>testGetGameType " . ((count($gameTypeList) == 7) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGroupPayout() {
    $databaseResult = new DatabaseResult();
    $groupPayoutList = $databaseResult->getGroupPayout();
    echo "<br>testGetGroupPayout " . ((count($groupPayoutList) == 3) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLimitType() {
    $databaseResult = new DatabaseResult();
    $limitTypeList = $databaseResult->getLimitType();
    echo "<br>testGetLimitType " . ((count($limitTypeList) == 3) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLocation() {
    $databaseResult = new DatabaseResult();
    $params = array(false, false, false);
    $locationList = $databaseResult->getLocation($params);
    echo "<br>testGetLocation " . ((count($locationList) >= 18) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLogin() {
    $databaseResult = new DatabaseResult();
    $loginList = $databaseResult->getLogin("tmmargar");
    echo "<br>testGetLogin " . ((count($loginList) == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPayout() {
    $databaseResult = new DatabaseResult();
    $payoutList = $databaseResult->getPayout();
    echo "<br>testGetPayout " . ((count($payoutList) >= 2) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetResult() {
    $databaseResult = new DatabaseResult();
    $resultList = $databaseResult->getResult();
    echo "<br>testGetResult " . ((count($resultList) >= 100) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetResultBounty() {
    $databaseResult = new DatabaseResult();
    $resultBountyList = $databaseResult->getResultBounty();
    echo "<br>testGetResultBounty " . ((count($resultBountyList) >= 100) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStatus() {
    $databaseResult = new DatabaseResult();
    $statusList = $databaseResult->getStatus();
    echo "<br>testGetStatus " . ((count($statusList) >= 3) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStructure() {
    $databaseResult = new DatabaseResult();
    $structureList = $databaseResult->getStructure();
    echo "<br>testGetStructure " . ((count($structureList) >= 17) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournament() {
    $databaseResult = new DatabaseResult();
    $params = array(null, false);
    $tournamentList = $databaseResult->getTournament($params);
    echo "<br>testGetTournament " . ((count($tournamentList) >= 100) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournamentBounty() {
    $databaseResult = new DatabaseResult();
    $tournamentBountyList = $databaseResult->getTournamentBounty();
    echo "<br>testGetTournamentBounty " . ((count($tournamentBountyList) >= 100) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUser() {
    $databaseResult = new DatabaseResult();
    $userList = $databaseResult->getUsersAll();
    echo "<br>testGetUser " . ((count($userList) >= 50) ? self::getPassOutput() : self::getFailOutput());
  }
  //public static function testGetAffectedRowCount() {
    //$databaseResult = new DatabaseResult();
    //$params = array("test", 100, "123 abc", "def", "ga", "45678");
    //$limitList = $databaseResult->insertLocation($params);
    //echo "<br>testGetAffectedRowCount " . (($databaseResult->getAffectedRowCount() == 1) ? self::getPassOutput() : self::getFailOutput());
  //}
  //public static function testGetReturnedRowCount() {
    //$databaseResult = new DatabaseResult();
    //$limitList = $databaseResult->getLimitType();
    //echo "<br>testGetReturnedRowCount " . (($databaseResult->getReturnedRowCount($limitList) >= 3) ? self::getPassOutput() : self::getFailOutput());
  //}
  public static function testGetLocationById() {
    $databaseResult = new DatabaseResult();
    $params = array(1);
    $locationList = $databaseResult->getLocationById($params);
    echo "<br>testGetLocationById " . (($locationList[0]->getName() == "Plymouth - Forster") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testInsertLocation() {
    $databaseResult = new DatabaseResult();
    $params = array("test", 100, "123 abc", "def", "ga", 45678, Constant::YES_FLAG);
    $rowCount = $databaseResult->insertLocation($params);
    echo "<br>testInsertLocation " . (($rowCount == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testUpdateLocation() {
    $databaseResult = new DatabaseResult();
    $locationList = $databaseResult->getLocationMaxId();
    $params = array("test2", 100, "123 abc", "def", "ga", 45678, Constant::YES_FLAG, $locationList[0]);
    $rowCount = $databaseResult->updateLocation($params);
    echo "<br>testUpdateLocation " . (($rowCount == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testDeleteLocation() {
    $databaseResult = new DatabaseResult();
    $locationList = $databaseResult->getLocationMaxId();
    $params = array($locationList[0]);
    $rowCount = $databaseResult->deleteLocation($params);
    echo "<br>testDeleteLocation " . (($rowCount == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function runAllTests() {
    DatabaseResultTest::testGetBounty();
    DatabaseResultTest::testGetFee();
    DatabaseResultTest::testGetGameType();
    DatabaseResultTest::testGetGroupPayout();
    DatabaseResultTest::testGetLimitType();
    DatabaseResultTest::testGetLocation();
    DatabaseResultTest::testGetLogin();
    DatabaseResultTest::testGetPayout();
    DatabaseResultTest::testGetResult();
    DatabaseResultTest::testGetResultBounty();
    DatabaseResultTest::testGetStatus();
    DatabaseResultTest::testGetStructure();
    DatabaseResultTest::testGetTournament();
    DatabaseResultTest::testGetTournamentBounty();
    DatabaseResultTest::testGetUser();
    //DatabaseResultTest::testGetAffectedRowCount();
    //DatabaseResultTest::testGetReturnedRowCount();
    DatabaseResultTest::testGetLocationById();
    DatabaseResultTest::testInsertLocation();
    DatabaseResultTest::testUpdateLocation();
    DatabaseResultTest::testDeleteLocation();
  }
}
DatabaseResultTest::runAllTests();
?>
<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DateTime;
use ccp\classes\model\GameType;
use ccp\classes\model\Group;
use ccp\classes\model\GroupPayout;
use ccp\classes\model\LimitType;
use ccp\classes\model\Location;
use ccp\classes\model\Payout;
use ccp\classes\model\Result;
use ccp\classes\model\Status;
use ccp\classes\model\Tournament;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
use Exception;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class ResultTest extends BaseTest {
  public static function testGetTournamentBlank() {
    $result = new Result();
    echo "<br>testGetTournamentBlank " . (($result->getTournament() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournamentNotBlank() {
    $result = new Result();
    $tournament = new Tournament();
    $tournament->setId(1);
    $result->setTournament($tournament);
    echo "<br>testGetTournamentNotBlank " . (($result->getTournament()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournamentException() {
    $result = new Result();
    try {
      $result->setTournament(1);
      echo "<br>testGetTournamentException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetTournamentException " . self::getPassOutput();
    }
  }
  public static function testGetUserBlank() {
    $result = new Result();
    echo "<br>testGetUserBlank " . (($result->getUser() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserNotBlank() {
    $result = new Result();
    $user = new User();
    $user->setId(1);
    $result->setUser($user);
    echo "<br>testGetUserNotBlank " . (($result->getUser()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserException() {
    $result = new Result();
    try {
      $result->setUser(1);
      echo "<br>testGetUserException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetUserException " . self::getPassOutput();
    }
  }
  public static function testGetStatusBlank() {
    $result = new Result();
    echo "<br>testGetStatusBlank " . (($result->getStatus() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStatusNotBlank() {
    $result = new Result();
    $status = new Status();
    $status->setId(1);
    $result->setStatus($status);
    echo "<br>testGetStatusNotBlank " . (($result->getStatus()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStatusException() {
    $result = new Result();
    try {
      $result->setStatus(1);
      echo "<br>testGetStatusException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetStatusException " . self::getPassOutput();
    }
  }
  public static function testGetRegisterOrderBlank() {
    $result = new Result();
    echo "<br>testGetRegisterOrderBlank " . (($result->getRegisterOrder() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRegisterOrderNotBlank() {
    $result = new Result();
    $result->setRegisterOrder(1);
    echo "<br>testGetRegisterOrderNotBlank " . (($result->getRegisterOrder() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRegisterOrderException() {
    $result = new Result();
    try {
      $result->setRegisterOrder("abc");
      echo "<br>testGetRegisterOrderException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRegisterOrderException " . self::getPassOutput();
    }
  }
  public static function testGetBuyinPaidBlank() {
    $result = new Result();
    echo "<br>testGetBuyinPaidBlank " . (($result->isBuyinPaid() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBuyinPaidNotBlank() {
    $result = new Result();
    $result->setBuyinPaid(true);
    echo "<br>testGetBuyinPaidNotBlank " . (($result->isBuyinPaid()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBuyinPaidException() {
    $result = new Result();
    try {
      $result->setBuyinPaid("abc");
      echo "<br>testGetBuyinPaidException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetBuyinPaidException " . self::getPassOutput();
    }
  }
  public static function testGetRebuyPaidBlank() {
    $result = new Result();
    echo "<br>testGetRebuyPaidBlank " . (($result->isRebuyPaid() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyPaidNotBlank() {
    $result = new Result();
    $result->setRebuyPaid(true);
    echo "<br>testGetRebuyPaidNotBlank " . (($result->isRebuyPaid()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyPaidException() {
    $result = new Result();
    try {
      $result->setRebuyPaid("abc");
      echo "<br>testGetRebuyPaidException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRebuyPaidException " . self::getPassOutput();
    }
  }
  public static function testGetAddonPaidBlank() {
    $result = new Result();
    echo "<br>testGetAddonPaidBlank " . (($result->isAddonPaid() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonPaidNotBlank() {
    $result = new Result();
    $result->setAddonPaid(true);
    echo "<br>testGetAddonPaidNotBlank " . (($result->isAddonPaid()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonPaidException() {
    $result = new Result();
    try {
      $result->setAddonPaid("abc");
      echo "<br>testGetAddonPaidException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetAddonPaidException " . self::getPassOutput();
    }
  }
  public static function testGetRebuyCountBlank() {
    $result = new Result();
    echo "<br>testGetRebuyCountBlank " . (($result->getRebuyCount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyCountNotBlank() {
    $result = new Result();
    $result->setRebuyCount(1);
    echo "<br>testGetRebuyCountNotBlank " . (($result->getRebuyCount()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyCountException() {
    $result = new Result();
    try {
      $result->setRebuyCount("abc");
      echo "<br>testGetRebuyCountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRebuyCountException " . self::getPassOutput();
    }
  }
  public static function testGetAddonFlagBlank() {
    $result = new Result();
    echo "<br>testGetAddonFlagBlank " . (($result->isAddonFlag() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonFlagNotBlank() {
    $result = new Result();
    $result->setAddonFlag(true);
    echo "<br>testGetAddonFlagNotBlank " . (($result->isAddonFlag()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonFlagException() {
    $result = new Result();
    try {
      $result->setAddonFlag("abc");
      echo "<br>testGetAddonFlagException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetAddonFlagException " . self::getPassOutput();
    }
  }
  public static function testGetPlaceBlank() {
    $result = new Result();
    echo "<br>testGetPlaceBlank " . (($result->getPlace() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPlaceNotBlank() {
    $result = new Result();
    $result->setPlace(1);
    echo "<br>testGetPlaceNotBlank " . (($result->getPlace()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPlaceException() {
    $result = new Result();
    try {
      $result->setPlace("abc");
      echo "<br>testGetPlaceException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetPlaceException " . self::getPassOutput();
    }
  }
  public static function testGetKnockedOutByBlank() {
    $result = new Result();
    echo "<br>testGetKnockedOutByBlank " . (($result->getKnockedOutBy() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetKnockedOutByNotBlank() {
    $result = new Result();
    $knockedOutBy = new User();
    $knockedOutBy->setId(1);
    $result->setKnockedOutBy($knockedOutBy);
    echo "<br>testGetKnockedOutByNotBlank " . (($result->getKnockedOutBy()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetKnockedOutByException() {
    $result = new Result();
    try {
      $result->setKnockedOutBy(1);
      echo "<br>testGetKnockedOutByException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetKnockedOutByException " . self::getPassOutput();
    }
  }
  public static function testGetFoodBlank() {
    $result = new Result();
    echo "<br>testGetFoodBlank " . (($result->getFood() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFoodNotBlank() {
    $result = new Result();
    $result->setFood("abc");
    echo "<br>testGetFoodNotBlank " . (($result->getFood()) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $result = new Result();
    $result->setAddonFlag(true);
    $result->setAddonPaid(false);
    $result->setBuyinPaid(false);
    $result->setFood("fd");
    $result->setId(1);
    $knockedOutBy = new User();
    $address = new Address();
    $address->setAddress("789 ghi");
    $address->setCity("city 3");
    $address->setId(11);
    $address->setState("MI");
    $address->setZip(77777);
    $knockedOutBy->setAddress($address);
    $knockedOutBy->setEmail("email3@email3.com");
    $knockedOutBy->setFirstName("fn 3");
    $knockedOutBy->setId(10);
    $knockedOutBy->setLastName("ln 3");
    $knockedOutBy->setPassword("pwd 3");
    $knockedOutBy->setType("Administrator");
    $knockedOutBy->setUsername("username 3");
    $result->setKnockedOutBy($knockedOutBy);
    $result->setPlace(1);
    $result->setRebuyCount(0);
    $result->setRebuyPaid(true);
    $result->setRegisterOrder(9);
    $status = new Status();
    $status->setCode(Constant::STATUS_CODE_FINISHED);
    $status->setId(1);
    $status->setName("st nm");
    $result->setStatus($status);
    $tournament = new Tournament();
    $tournament->setAddonAmount(10);
    $tournament->setAddonChipCount(500);
    $tournament->setAddonsPaid(0);
    $tournament->setBuyinAmount(25);
    $tournament->setBuyinsPaid(5);
    $tournament->setChipCount(2500);
    $tournament->setComment("comment");
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setDate($dateTime->getTime());
    $tournament->setDescription("desc");
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setEndTime($dateTime->getTime());
    $gameType = new GameType();
    $gameType->setId(1);
    $gameType->setName("gt nm");
    $tournament->setGameType($gameType);
    $groupPayout = new GroupPayout();
    $group = new Group();
    $group->setId(2);
    $group->setName("grp nm");
    $groupPayout->setGroup($group);
    $groupPayout->setId(3);
    $payout = new Payout();
    $payout->setBonusPoints(3);
    $payout->setId(4);
    $payout->setName("pn 1");
    $payout->setNumPlayers(22);
    $payout2 = new Payout();
    $payout2->setBonusPoints(3);
    $payout2->setId(5);
    $payout2->setName("pn 2");
    $payout2->setNumPlayers(24);
    $payouts = array(
      $payout,
      $payout2);
    $groupPayout->setPayouts($payouts);
    $tournament->setGroupPayout($groupPayout);
    $tournament->setId(6);
    $limitType = new LimitType();
    $limitType->setId(7);
    $limitType->setName("lt nm");
    $tournament->setLimitType($limitType);
    $location = new Location();
    $location->setActive(Constant::YES_FLAG);
    $location->setCount(3);
    $location->setId(8);
    $location->setName("test loc");
    $user = new User();
    $address = new Address();
    $address->setAddress("123 abc");
    $address->setCity("city");
    $address->setId(9);
    $address->setState("MI");
    $address->setZip(99999);
    $address = new Address();
    $address->setAddress("123 abc");
    $address->setCity("city");
    $address->setId(9);
    $address->setState("MI");
    $address->setZip(99999);
    $user->setAddress($address);
    $user->setEmail("email@email.com");
    $user->setFirstName("fn");
    $user->setId(10);
    $user->setLastName("ln");
    $user->setPassword("pwd");
    $user->setType("Administrator");
    $user->setUsername("username");
    $location->setUser($user);
    $tournament->setLocation($location);
    $tournament->setMaxPlayers(36);
    $tournament->setMaxRebuys(1);
    $tournament->setRake(.2);
    $tournament->setRebuyAmount(25);
    $tournament->setRebuysPaid(0);
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setStartTime($dateTime->getTime());
    $result->setTournament($tournament);
    $address = new Address();
    $address->setAddress("456 def");
    $address->setCity("city 2");
    $address->setId(10);
    $address->setState("MI");
    $address->setZip(88888);
    $user->setAddress($address);
    $user->setEmail("email2@email2.com");
    $user->setFirstName("fn 2");
    $user->setId(10);
    $user->setLastName("ln 2");
    $user->setPassword("pwd 2");
    $user->setType("Administrator");
    $user->setUsername("username 2");
    $result->setUser($user);
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $result->toString());
  }
  public static function runAllTests() {
    ResultTest::testGetTournamentBlank();
    ResultTest::testGetTournamentNotBlank();
    ResultTest::testGetTournamentException();
    ResultTest::testGetUserBlank();
    ResultTest::testGetUserNotBlank();
    ResultTest::testGetUserException();
    ResultTest::testGetRegisterOrderBlank();
    ResultTest::testGetRegisterOrderNotBlank();
    ResultTest::testGetRegisterOrderException();
    ResultTest::testGetBuyinPaidBlank();
    ResultTest::testGetBuyinPaidNotBlank();
    ResultTest::testGetBuyinPaidException();
    ResultTest::testGetRebuyPaidBlank();
    ResultTest::testGetRebuyPaidNotBlank();
    ResultTest::testGetRebuyPaidException();
    ResultTest::testGetAddonPaidBlank();
    ResultTest::testGetAddonPaidNotBlank();
    ResultTest::testGetAddonPaidException();
    ResultTest::testGetRebuyCountBlank();
    ResultTest::testGetRebuyCountNotBlank();
    ResultTest::testGetRebuyCountException();
    ResultTest::testGetAddonFlagBlank();
    ResultTest::testGetAddonFlagNotBlank();
    ResultTest::testGetAddonFlagException();
    ResultTest::testGetPlaceBlank();
    ResultTest::testGetPlaceNotBlank();
    ResultTest::testGetPlaceException();
    ResultTest::testGetKnockedOutByBlank();
    ResultTest::testGetKnockedOutByNotBlank();
    ResultTest::testGetKnockedOutByException();
    ResultTest::testGetFoodBlank();
    ResultTest::testGetFoodNotBlank();
    ResultTest::testToString();
  }
}
ResultTest::runAllTests();
?>
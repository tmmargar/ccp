<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use ccp\classes\model\Bounty;
use ccp\classes\model\Constant;
use ccp\classes\model\DateTime;
use ccp\classes\model\GameType;
use ccp\classes\model\Group;
use ccp\classes\model\GroupPayout;
use ccp\classes\model\LimitType;
use ccp\classes\model\Location;
use ccp\classes\model\Payout;
use ccp\classes\model\ResultBounty;
use ccp\classes\model\Tournament;
use ccp\classes\model\User;
use ccp\classes\model\UserGroup;
use ccp\classes\utility\SessionUtility;
use Exception;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class ResultBountyTest extends BaseTest {
  public static function testGetTournamentBlank() {
    $resultBounty = new ResultBounty();
    echo "<br>testGetTournamentBlank " . (($resultBounty->getTournament() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournamentNotBlank() {
    $resultBounty = new ResultBounty();
    $tournament = new Tournament();
    $tournament->setId(1);
    $resultBounty->setTournament($tournament);
    echo "<br>testGetTournamentNotBlank " . (($resultBounty->getTournament()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTournamentException() {
    $resultBounty = new ResultBounty();
    try {
      $resultBounty->setTournament(1);
      echo "<br>testGetTournamentException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetTournamentException " . self::getPassOutput();
    }
  }
  public static function testGetBountyBlank() {
    $resultBounty = new ResultBounty();
    echo "<br>testGetBountyBlank " . (($resultBounty->getBounty() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBountyNotBlank() {
    $resultBounty = new ResultBounty();
    $bounty = new Bounty();
    $bounty->setId(1);
    $resultBounty->setBounty($bounty);
    echo "<br>testGetBountyNotBlank " . (($resultBounty->getBounty()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBountyException() {
    $resultBounty = new ResultBounty();
    try {
      $resultBounty->setBounty(1);
      echo "<br>testGetBountyException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetBountyException " . self::getPassOutput();
    }
  }
  public static function testGetUserBlank() {
    $resultBounty = new ResultBounty();
    echo "<br>testGetUserBlank " . (($resultBounty->getUser() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserNotBlank() {
    $resultBounty = new ResultBounty();
    $user = new User();
    $user->setId(1);
    $resultBounty->setUser($user);
    echo "<br>testGetUserNotBlank " . (($resultBounty->getUser()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserException() {
    $resultBounty = new ResultBounty();
    try {
      $resultBounty->setUser(1);
      echo "<br>testGetUserException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetUserException " . self::getPassOutput();
    }
  }
  public static function testToString() {
    $resultBounty = new ResultBounty();
    $bounty = new Bounty();
    $bounty->setDescription("desc");
    $bounty->setId(1);
    $bounty->setName("bty nm");
    $resultBounty->setBounty($bounty);
    $resultBounty->setId(1);
    $tournament = new Tournament();
    $tournament->setAddonAmount(10);
    $tournament->setAddonChipCount(500);
    $tournament->setAddonsPaid(0);
    $tournament->setBuyinAmount(25);
    $tournament->setBuyinsPaid(5);
    $tournament->setChipCount(2500);
    $tournament->setComment("comment");
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
    $tournament->setDate($dateTime->getTime());
    $tournament->setDescription("desc");
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
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
    $user->setAddress($address);
    $user->setEmail("email@email.com");
    $user->setFirstName("fn");
    $group = new UserGroup();
    $group->setId(3);
    $group->setTitle("Registered");
    $groups = array(
      $group);
    $user->setGroups($groups);
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
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
    $tournament->setStartTime($dateTime->getTime());
    $resultBounty->setTournament($tournament);
    $user->setAddress($address);
    $user->setEmail("email2@email2.com");
    $user->setFirstName("fn 2");
    $group = new UserGroup();
    $group->setId(3);
    $group->setTitle("Administrator");
    $groups = array(
      $group);
    $user->setGroups($groups);
    $user->setId(10);
    $user->setLastName("ln 2");
    $user->setPassword("pwd 2");
    $user->setType("Administrator");
    $user->setUsername("username 2");
    $resultBounty->setUser($user);
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $resultBounty->toString());
  }
  public static function runAllTests() {
    ResultBountyTest::testGetTournamentBlank();
    ResultBountyTest::testGetTournamentNotBlank();
    ResultBountyTest::testGetTournamentException();
    ResultBountyTest::testGetBountyBlank();
    ResultBountyTest::testGetBountyNotBlank();
    ResultBountyTest::testGetBountyException();
    ResultBountyTest::testGetUserBlank();
    ResultBountyTest::testGetUserNotBlank();
    ResultBountyTest::testGetUserException();
    ResultBountyTest::testToString();
  }
}
ResultBountyTest::runAllTests();
?>
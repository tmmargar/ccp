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
use ccp\classes\model\Tournament;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
use Exception;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class TournamentTest extends BaseTest {
  public static function testGetIdBlank() {
    $tournament = new Tournament();
    echo "<br>testGetIdBlank " . (($tournament->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $tournament = new Tournament();
    $tournament->setId(1);
    echo "<br>testGetIdNotBlank " . (($tournament->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDescriptionBlank() {
    $tournament = new Tournament();
    echo "<br>testGetDescriptionBlank " . (($tournament->getDescription() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDescriptionNotBlank() {
    $tournament = new Tournament();
    $tournament->setDescription("abc");
    echo "<br>testGetDescriptionNotBlank " . (($tournament->getDescription() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCommentBlank() {
    $tournament = new Tournament();
    echo "<br>testGetCommentBlank " . (($tournament->getComment() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCommentNotBlank() {
    $tournament = new Tournament();
    $tournament->setComment("abc");
    echo "<br>testGetCommentNotBlank " . (($tournament->getComment() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLimitTypeBlank() {
    $tournament = new Tournament();
    echo "<br>testGetLimitTypeBlank " . (($tournament->getLimitType() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLimitTypeNotBlank() {
    $tournament = new Tournament();
    $limitType = new LimitType();
    $limitType->setId(1);
    $tournament->setLimitType($limitType);
    echo "<br>testGetLimitTypeNotBlank " . (($tournament->getLimitType()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLimitTypeException() {
    $tournament = new Tournament();
    try {
      $tournament->setLimitType(1);
      echo "<br>testGetLimitTypeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetLimitTypeException " . self::getPassOutput();
    }
  }
  public static function testGetGameTypeBlank() {
    $tournament = new Tournament();
    echo "<br>testGetGameTypeBlank " . (($tournament->getGameType() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGameTypeNotBlank() {
    $tournament = new Tournament();
    $gameType = new GameType();
    $gameType->setId(1);
    $tournament->setGameType($gameType);
    echo "<br>testGetGameTypeNotBlank " . (($tournament->getGameType()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGameTypeException() {
    $tournament = new Tournament();
    try {
      $tournament->setGameType(1);
      echo "<br>testGetGameTypeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetGameTypeException " . self::getPassOutput();
    }
  }
  public static function testGetChipCountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetChipCountBlank " . (($tournament->getChipCount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetChipCountNotBlank() {
    $tournament = new Tournament();
    $tournament->setChipCount(1);
    echo "<br>testGetChipCountNotBlank " . (($tournament->getChipCount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetChipCountException() {
    $tournament = new Tournament();
    try {
      $tournament->setChipCount("abc");
      echo "<br>testGetChipCountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetChipCountException " . self::getPassOutput();
    }
  }
  public static function testGetLocationBlank() {
    $tournament = new Tournament();
    echo "<br>testGetLocationBlank " . (($tournament->getLocation() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLocationNotBlank() {
    $tournament = new Tournament();
    $location = new Location();
    $location->setId(1);
    $tournament->setLocation($location);
    echo "<br>testGetLocationNotBlank " . (($tournament->getLocation()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLocationException() {
    $tournament = new Tournament();
    try {
      $tournament->setLocation(1);
      echo "<br>testGetLocationException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetLocationException " . self::getPassOutput();
    }
  }
  public static function testGetDateBlank() {
    $tournament = new Tournament();
    echo "<br>testGetDateBlank " . (($tournament->getDate() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDateNotBlank() {
    $tournament = new Tournament();
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setDate($dateTime);
    echo "<br>testGetDateNotBlank " . (($tournament->getDate() == $dateTime) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDateException() {
    $tournament = new Tournament();
    try {
      $tournament->setDate(1);
      echo "<br>testGetDateException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetDateException " . self::getPassOutput();
    }
  }
  public static function testGetStartTimeBlank() {
    $tournament = new Tournament();
    echo "<br>testGetStartTimeBlank " . (($tournament->getStartTime() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStartTimeNotBlank() {
    $tournament = new Tournament();
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setStartTime($dateTime);
    echo "<br>testGetStartTimeNotBlank " . (($tournament->getStartTime() == $dateTime) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStartTimeException() {
    $tournament = new Tournament();
    try {
      $tournament->setStartTime(1);
      echo "<br>testGetStartTimeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetStartTimeException " . self::getPassOutput();
    }
  }
  public static function testGetEndTimeBlank() {
    $tournament = new Tournament();
    echo "<br>testGetEndTimeBlank " . (($tournament->getEndTime() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetEndTimeNotBlank() {
    $tournament = new Tournament();
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), NULL, NULL);
    $tournament->setEndTime($dateTime);
    echo "<br>testGetEndTimeNotBlank " . (($tournament->getEndTime() == $dateTime) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetEndTimeException() {
    $tournament = new Tournament();
    try {
      $tournament->setEndTime(1);
      echo "<br>testGetEndTimeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetEndTimeException " . self::getPassOutput();
    }
  }
  public static function testGetBuyinAmountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetBuyinAmountBlank " . (($tournament->getBuyinAmount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBuyinAmountNotBlank() {
    $tournament = new Tournament();
    $tournament->setBuyinAmount(1);
    echo "<br>testGetBuyinAmountNotBlank " . (($tournament->getBuyinAmount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBuyinAmountException() {
    $tournament = new Tournament();
    try {
      $tournament->setBuyinAmount("abc");
      echo "<br>testGetBuyinAmountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetBuyinAmountException " . self::getPassOutput();
    }
  }
  public static function testGetMaxPlayersBlank() {
    $tournament = new Tournament();
    echo "<br>testGetMaxPlayersBlank " . (($tournament->getMaxPlayers() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxPlayersNotBlank() {
    $tournament = new Tournament();
    $tournament->setMaxPlayers(1);
    echo "<br>testGetMaxPlayersNotBlank " . (($tournament->getMaxPlayers() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxPlayersException() {
    $tournament = new Tournament();
    try {
      $tournament->setMaxPlayers("abc");
      echo "<br>testGetMaxPlayersException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetMaxPlayersException " . self::getPassOutput();
    }
  }
  public static function testGetMaxRebuysBlank() {
    $tournament = new Tournament();
    echo "<br>testGetMaxRebuysBlank " . (($tournament->getMaxRebuys() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxRebuysNotBlank() {
    $tournament = new Tournament();
    $tournament->setMaxRebuys(1);
    echo "<br>testGetMaxRebuysNotBlank " . (($tournament->getMaxRebuys() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxRebuysException() {
    $tournament = new Tournament();
    try {
      $tournament->setMaxRebuys("abc");
      echo "<br>testGetMaxRebuysException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetMaxRebuysException " . self::getPassOutput();
    }
  }
  public static function testGetRebuyAmountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetRebuyAmountBlank " . (($tournament->getRebuyAmount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyAmountNotBlank() {
    $tournament = new Tournament();
    $tournament->setRebuyAmount(1);
    echo "<br>testGetRebuyAmountNotBlank " . (($tournament->getRebuyAmount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRebuyAmountException() {
    $tournament = new Tournament();
    try {
      $tournament->setRebuyAmount("abc");
      echo "<br>testGetRebuyAmountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRebuyAmountException " . self::getPassOutput();
    }
  }
  public static function testGetAddonAmountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetAddonAmountBlank " . (($tournament->getAddonAmount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonAmountNotBlank() {
    $tournament = new Tournament();
    $tournament->setAddonAmount(1);
    echo "<br>testGetAddonAmountNotBlank " . (($tournament->getAddonAmount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonAmountException() {
    $tournament = new Tournament();
    try {
      $tournament->setAddonAmount("abc");
      echo "<br>testGetAddonAmountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetAddonAmountException " . self::getPassOutput();
    }
  }
  public static function testGetAddonChipCountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetAddonChipCountBlank " . (($tournament->getAddonChipCount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonChipCountNotBlank() {
    $tournament = new Tournament();
    $tournament->setAddonChipCount(1);
    echo "<br>testGetAddonChipCountNotBlank " . (($tournament->getAddonChipCount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddonChipCountException() {
    $tournament = new Tournament();
    try {
      $tournament->setAddonChipCount("abc");
      echo "<br>testGetAddonChipCountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetAddonChipCountException " . self::getPassOutput();
    }
  }
  public static function testGetGroupPayoutBlank() {
    $tournament = new Tournament();
    echo "<br>testGetGroupPayoutBlank " . (($tournament->getGroupPayout() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGroupPayoutNotBlank() {
    $tournament = new Tournament();
    $groupPayout = new GroupPayout();
    $groupPayout->setId(1);
    $tournament->setGroupPayout($groupPayout);
    echo "<br>testGetGroupPayoutNotBlank " . (($tournament->getGroupPayout()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGroupPayoutException() {
    $tournament = new Tournament();
    try {
      $tournament->setGroupPayout(1);
      echo "<br>testGetGroupPayoutException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetGroupPayoutException " . self::getPassOutput();
    }
  }
  public static function testGetRakeBlank() {
    $tournament = new Tournament();
    echo "<br>testGetRakeBlank " . (($tournament->getRake() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRakeNotBlank() {
    $tournament = new Tournament();
    $tournament->setRake(.2);
    echo "<br>testGetRakeNotBlank " . (($tournament->getRake() == .2) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRakeException() {
    $tournament = new Tournament();
    try {
      $tournament->setRake("abc");
      echo "<br>testGetRakeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRakeAmountException " . self::getPassOutput();
    }
  }
  public static function testGetDirectionsBlank() {
    $tournament = new Tournament();
    echo "<br>testGetDirectionsBlank " . (($tournament->getDirections() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDirectionsNotBlank() {
    $tournament = new Tournament();
    $tournament->setDirections("abc");
    echo "<br>testGetDirectionsNotBlank " . (($tournament->getDirections() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRegisteredCountBlank() {
    $tournament = new Tournament();
    echo "<br>testGetRegisteredCountBlank " . (($tournament->getRegisteredCount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRegisteredCountNotBlank() {
    $tournament = new Tournament();
    $tournament->setRegisteredCount(1);
    echo "<br>testGetRegisteredCountNotBlank " . (($tournament->getRegisteredCount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetRegisteredCountException() {
    $tournament = new Tournament();
    try {
      $tournament->setRegisteredCount("abc");
      echo "<br>testGetRegisteredCountException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetRegisteredCountException " . self::getPassOutput();
    }
  }
  public static function testToString() {
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
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $tournament->toString());
  }
  public static function runAllTests() {
    TournamentTest::testGetIdBlank();
    TournamentTest::testGetIdNotBlank();
    TournamentTest::testGetDescriptionBlank();
    TournamentTest::testGetDescriptionNotBlank();
    TournamentTest::testGetCommentBlank();
    TournamentTest::testGetCommentNotBlank();
    TournamentTest::testGetLimitTypeBlank();
    TournamentTest::testGetLimitTypeNotBlank();
    TournamentTest::testGetLimitTypeException();
    TournamentTest::testGetGameTypeBlank();
    TournamentTest::testGetGameTypeNotBlank();
    TournamentTest::testGetGameTypeException();
    TournamentTest::testGetChipCountBlank();
    TournamentTest::testGetChipCountNotBlank();
    TournamentTest::testGetChipCountException();
    TournamentTest::testGetLocationBlank();
    TournamentTest::testGetLocationNotBlank();
    TournamentTest::testGetLocationException();
    TournamentTest::testGetDateBlank();
    TournamentTest::testGetDateNotBlank();
    TournamentTest::testGetDateException();
    TournamentTest::testGetStartTimeBlank();
    TournamentTest::testGetStartTimeNotBlank();
    TournamentTest::testGetStartTimeException();
    TournamentTest::testGetEndTimeBlank();
    TournamentTest::testGetEndTimeNotBlank();
    TournamentTest::testGetEndTimeException();
    TournamentTest::testGetBuyinAmountBlank();
    TournamentTest::testGetBuyinAmountNotBlank();
    TournamentTest::testGetBuyinAmountException();
    TournamentTest::testGetMaxPlayersBlank();
    TournamentTest::testGetMaxPlayersNotBlank();
    TournamentTest::testGetMaxPlayersException();
    TournamentTest::testGetMaxRebuysBlank();
    TournamentTest::testGetMaxRebuysNotBlank();
    TournamentTest::testGetMaxRebuysException();
    TournamentTest::testGetRebuyAmountBlank();
    TournamentTest::testGetRebuyAmountNotBlank();
    TournamentTest::testGetRebuyAmountException();
    TournamentTest::testGetAddonAmountBlank();
    TournamentTest::testGetAddonAmountNotBlank();
    TournamentTest::testGetAddonAmountException();
    TournamentTest::testGetAddonChipCountBlank();
    TournamentTest::testGetAddonChipCountNotBlank();
    TournamentTest::testGetAddonChipCountException();
    TournamentTest::testGetGroupPayoutBlank();
    TournamentTest::testGetGroupPayoutNotBlank();
    TournamentTest::testGetGroupPayoutException();
    TournamentTest::testGetRakeBlank();
    TournamentTest::testGetRakeNotBlank();
    TournamentTest::testGetRakeException();
    TournamentTest::testGetDirectionsBlank();
    TournamentTest::testGetDirectionsNotBlank();
    TournamentTest::testGetRegisteredCountBlank();
    TournamentTest::testGetRegisteredCountNotBlank();
    TournamentTest::testGetRegisteredCountException();
    TournamentTest::testToString();
  }
}
TournamentTest::runAllTests();
?>
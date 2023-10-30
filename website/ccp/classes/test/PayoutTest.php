<?php
namespace ccp\classes\Test;
use ccp\classes\model\Payout;
use ccp\classes\model\Structure;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class PayoutTest extends BaseTest {
  public static function testGetIdBlank() {
    $payout = new Payout();
    echo "<br>testGetIdBlank " . (($payout->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $payout = new Payout();
    $payout->setId(1);
    echo "<br>testGetIdNotBlank " . (($payout->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $payout = new Payout();
    echo "<br>testGetNameBlank " . (($payout->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $payout = new Payout();
    $payout->setName("abc");
    echo "<br>testGetNameNotBlank " . (($payout->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBonusPointsBlank() {
    $payout = new Payout();
    echo "<br>testGetBonusPointsBlank " . (($payout->getBonusPoints() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBonusPointsNotBlank() {
    $payout = new Payout();
    $payout->setBonusPoints(3);
    echo "<br>testGetBonusPointsNotBlank " . (($payout->getBonusPoints() == 3) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBonusPointsException() {
    $payout = new Payout();
    try {
      $payout->setBonusPoints("abc");
      echo "<br>testGetBonusPointsException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetBonusPointsException " . self::getPassOutput();
    }
  }
  public static function testGetMinPlayersBlank() {
    $payout = new Payout();
    echo "<br>testGetMinPlayersBlank " . (($payout->getMinPlayers() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMinPlayersNotBlank() {
    $payout = new Payout();
    $payout->setMinPlayers(22);
    echo "<br>testGetMinPlayersNotBlank " . (($payout->getMinPlayers() == 22) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMinPlayersException() {
    $payout = new Payout();
    try {
      $payout->setMinPlayers("abc");
      echo "<br>testGetMinPlayersException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetMinPlayersException " . self::getPassOutput();
    }
  }
  public static function testGetMaxPlayersBlank() {
    $payout = new Payout();
    echo "<br>testGetMaxPlayersBlank " . (($payout->getMaxPlayers() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxPlayersNotBlank() {
    $payout = new Payout();
    $payout->setMaxPlayers(22);
    echo "<br>testGetMaxPlayersNotBlank " . (($payout->getMaxPlayers() == 22) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetMaxPlayersException() {
    $payout = new Payout();
    try {
      $payout->setMaxPlayers("abc");
      echo "<br>testGetMaxPlayersException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetMaxPlayersException " . self::getPassOutput();
    }
  }
  public static function testGetStructuresBlank() {
    $payout = new Payout();
    echo "<br>testGetStructuresBlank " . (($payout->getStructures() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStructuresNotBlank() {
    $payout = new Payout();
    $structure = new Structure();
    $structure->setId(9);
    $structure->setPercentage(.5);
    $structure->setPlace(1);
    $structure2 = new Structure();
    $structure2->setId(8);
    $structure2->setPercentage(.25);
    $structure2->setPlace(1);
    $structures = array($structure, $structure2);
    $payout->setStructures($structures);
    $structuresOut = $payout->getStructures();
    echo "<br>testGetStructuresNotBlank " . (($structuresOut[0]->getId() == 9) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $payout = new Payout();
    $payout->setBonusPoints(3);
    $payout->setId(1);
    $payout->setMinPlayers(17);
    $payout->setMinPlayers(20);
    $payout->setName("pay nm");
    $structure = new Structure();
    $structure->setId(9);
    $structure->setPercentage(.5);
    $structure->setPlace(1);
    $structure2 = new Structure();
    $structure2->setId(8);
    $structure2->setPercentage(.25);
    $structure2->setPlace(1);
    $structures = array($structure, $structure2);
    $payout->setStructures($structures);
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $payout->toString());
  }
  public static function runAllTests() {
    PayoutTest::testGetIdBlank();
    PayoutTest::testGetIdNotBlank();
    PayoutTest::testGetNameBlank();
    PayoutTest::testGetNameNotBlank();
    PayoutTest::testGetBonusPointsBlank();
    PayoutTest::testGetBonusPointsNotBlank();
    PayoutTest::testGetBonusPointsException();
    PayoutTest::testGetMinPlayersBlank();
    PayoutTest::testGetMinPlayersNotBlank();
    PayoutTest::testGetMinPlayersException();
    PayoutTest::testGetMaxPlayersBlank();
    PayoutTest::testGetMaxPlayersNotBlank();
    PayoutTest::testGetMaxPlayersException();
    PayoutTest::testGetStructuresBlank();
    PayoutTest::testGetStructuresNotBlank();
    PayoutTest::testToString();
  }
}
PayoutTest::runAllTests();
?>
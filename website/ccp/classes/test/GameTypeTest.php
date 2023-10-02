<?php
namespace ccp\classes\Test;
use ccp\classes\model\GameType;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class GameTypeTest extends BaseTest {
  public static function testGetIdBlank() {
    $gameType = new GameType();
    echo "<br>testGetIdBlank " . (($gameType->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $gameType = new GameType();
    $gameType->setId(1);
    echo "<br>testGetIdNotBlank " . (($gameType->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $gameType = new GameType();
    echo "<br>testGetNameBlank " . (($gameType->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $gameType = new GameType();
    $gameType->setName("abc");
    echo "<br>testGetNameNotBlank " . (($gameType->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $gameType = new GameType();
    $gameType->setId(1);
    $gameType->setName("gt nm");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $gameType->toString());
  }
  public static function runAllTests() {
    GameTypeTest::testGetIdBlank();
    GameTypeTest::testGetIdNotBlank();
    GameTypeTest::testGetNameBlank();
    GameTypeTest::testGetNameNotBlank();
    GameTypeTest::testToString();
  }
}
GameTypeTest::runAllTests();
?>
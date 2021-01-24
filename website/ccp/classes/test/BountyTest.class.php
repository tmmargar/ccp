<?php
namespace ccp\classes\Test;
use ccp\classes\model\Bounty;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class BountyTest extends BaseTest {
  public static function testGetIdBlank() {
    $bounty = new Bounty();
    echo "<br>testGetIdBlank " . (($bounty->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $bounty = new Bounty();
    $bounty->setId(1);
    echo "<br>testGetIdNotBlank " . (($bounty->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $bounty = new Bounty();
    echo "<br>testGetNameBlank " . (($bounty->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $bounty = new Bounty();
    $bounty->setName("abc");
    echo "<br>testGetNameNotBlank " . (($bounty->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDescriptionBlank() {
    $bounty = new Bounty();
    echo "<br>testGetDescriptionBlank " . (($bounty->getDescription() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDescriptionNotBlank() {
    $bounty = new Bounty();
    $bounty->setDescription("abc");
    echo "<br>testGetDescriptionNotBlank " . (($bounty->getDescription() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $bounty = new Bounty();
    $bounty->setDescription("bty desc");
    $bounty->setId(1);
    $bounty->setName("bty nm");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $bounty->toString());
  }
  public static function runAllTests() {
    BountyTest::testGetIdBlank();
    BountyTest::testGetIdNotBlank();
    BountyTest::testGetNameBlank();
    BountyTest::testGetNameNotBlank();
    BountyTest::testGetDescriptionBlank();
    BountyTest::testGetDescriptionNotBlank();
    BountyTest::testToString();
  }
}
BountyTest::runAllTests();
?>
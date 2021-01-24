<?php
namespace ccp\classes\Test;
use ccp\classes\model\LimitType;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class LimitTypeTest extends BaseTest {
  public static function testGetIdBlank() {
    $limitType = new LimitType();
    echo "<br>testGetIdBlank " . (($limitType->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $limitType = new LimitType();
    $limitType->setId(1);
    echo "<br>testGetIdNotBlank " . (($limitType->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $limitType = new LimitType();
    echo "<br>testGetNameBlank " . (($limitType->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $limitType = new LimitType();
    $limitType->setName("abc");
    echo "<br>testGetNameNotBlank " . (($limitType->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $limitType = new LimitType();
    $limitType->setId(1);
    $limitType->setName("lt nm");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $limitType->toString());
  }
  public static function runAllTests() {
    LimitTypeTest::testGetIdBlank();
    LimitTypeTest::testGetIdNotBlank();
    LimitTypeTest::testGetNameBlank();
    LimitTypeTest::testGetNameNotBlank();
    LimitTypeTest::testToString();
  }
}
LimitTypeTest::runAllTests();
?>
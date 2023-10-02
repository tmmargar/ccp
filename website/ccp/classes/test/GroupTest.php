<?php
namespace ccp\classes\Test;
use ccp\classes\model\Group;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class GroupTest extends BaseTest {
  public static function testGetIdBlank() {
    $group = new Group();
    echo "<br>testGetIdBlank " . (($group->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $group = new Group();
    $group->setId(1);
    echo "<br>testGetIdNotBlank " . (($group->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $group = new Group();
    echo "<br>testGetNameBlank " . (($group->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $group = new Group();
    $group->setName("abc");
    echo "<br>testGetNameNotBlank " . (($group->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $group = new Group();
    $group->setId(1);
    $group->setName("gp nm");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $group->toString());
  }
  public static function runAllTests() {
    GroupTest::testGetIdBlank();
    GroupTest::testGetIdNotBlank();
    GroupTest::testGetNameBlank();
    GroupTest::testGetNameNotBlank();
    GroupTest::testToString();
  }
}
GroupTest::runAllTests();
?>
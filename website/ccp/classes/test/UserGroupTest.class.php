<?php
namespace ccp\classes\Test;
use ccp\classes\model\UserGroup;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class UserGroupTest extends BaseTest {
  public static function testGetIdBlank() {
    $userGroup = new UserGroup();
    echo "<br>testGetIdBlank " . (($userGroup->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $userGroup = new UserGroup();
    $userGroup->setId(1);
    echo "<br>testGetIdNotBlank " . (($userGroup->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTitleBlank() {
    $userGroup = new UserGroup();
    echo "<br>testGetTitleBlank " . (($userGroup->getTitle() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTitleNotBlank() {
    $userGroup = new UserGroup();
    $userGroup->setTitle("abc");
    echo "<br>testGetTitleNotBlank " . (($userGroup->getTitle() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $userGroup = new UserGroup();
    $userGroup->setId(1);
    $userGroup->setTitle("title");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $userGroup->toString());
  }
  public static function runAllTests() {
    UserGroupTest::testGetIdBlank();
    UserGroupTest::testGetIdNotBlank();
    UserGroupTest::testGetTitleBlank();
    UserGroupTest::testGetTitleNotBlank();
    UserGroupTest::testToString();
  }
}
UserGroupTest::runAllTests();
?>
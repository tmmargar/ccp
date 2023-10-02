<?php
namespace ccp\classes\Test;
use ccp\classes\model\Database;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class DatabaseTest extends BaseTest {
  public static function testGetHostNameBlank() {
    $db = new Database();
    echo "<br>testGetHostNameBlank " . (($db->getHostName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetHostNameNotBlank() {
    $db = new Database();
    $db->setHostName("abc");
    echo "<br>testGetHostNameNotBlank " . (($db->getHostName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUseridBlank() {
    $db = new Database();
    echo "<br>testGetUseridBlank " . (($db->getUserid() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUseridNotBlank() {
    $db = new Database();
    $db->setUserid("abc");
    echo "<br>testGetUseridNotBlank " . (($db->getUserid() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPasswordBlank() {
    $db = new Database();
    echo "<br>testGetPasswordBlank " . (($db->getPassword() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPasswordNotBlank() {
    $db = new Database();
    $db->setPassword("abc");
    echo "<br>testGetPasswordNotBlank " . (($db->getPassword() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDatabaseNameBlank() {
    $db = new Database();
    echo "<br>testGetDatabaseNameBlank " . (($db->getDatabaseName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetDatabaseNameNotBlank() {
    $db = new Database();
    $db->setDatabaseName("abc");
    echo "<br>testGetDatabaseNameNotBlank " . (($db->getDatabaseName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTableNamesBlank() {
    $db = new Database();
    echo "<br>testGetTableNamesBlank " . (($db->getTableNames() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTableNamesNotBlank() {
    $db = new Database();
    $db->setTableNames(array("key1" => "value1"));
    echo "<br>testGetTableNamesNotBlank " . (key($db->getTableNames()) == "key1" && current($db->getTableNames()) == "value1" ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $database = new Database();
    $database->setDatabaseName("db nm");
    $database->setHostName("host nm");
    $database->setPassword("pwd");
    $database->setTableNames(array("tbl1", "tbl2"));
    $database->setUserid("userid");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $database->toString());
  }
  public static function runAllTests() {
    DatabaseTest::testGetHostNameBlank();
    DatabaseTest::testGetHostNameNotBlank();
    DatabaseTest::testGetUseridBlank();
    DatabaseTest::testGetUseridNotBlank();
    DatabaseTest::testGetPasswordBlank();
    DatabaseTest::testGetPasswordNotBlank();
    DatabaseTest::testGetDatabaseNameBlank();
    DatabaseTest::testGetDatabaseNameNotBlank();
    DatabaseTest::testGetTableNamesBlank();
    DatabaseTest::testGetTableNamesNotBlank();
    DatabaseTest::testToString();
  }
}
DatabaseTest::runAllTests();
?>
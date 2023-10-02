<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use ccp\classes\model\Fee;
use ccp\classes\model\User;
use ccp\classes\model\UserGroup;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class FeeTest extends BaseTest {
  public static function testGetUserBlank() {
    $fee = new Fee();
    echo "<br>testGetUserBlank " . (($fee->getUser() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserNotBlank() {
    $fee = new Fee();
    $user = new User();
    $user->setId(1);
    $fee->setUser($user);
    echo "<br>testGetUserNotBlank " . (($fee->getUser()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetYearBlank() {
    $fee = new Fee();
    echo "<br>testGetYearBlank " . (($fee->getYear() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetYearNotBlank() {
    $fee = new Fee();
    $fee->setYear(2012);
    echo "<br>testGetYearNotBlank " . (($fee->getYear() == 2012) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAmountBlank() {
    $fee = new Fee();
    echo "<br>testGetAmountBlank " . (($fee->getAmount() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAmountNotBlank() {
    $fee = new Fee();
    $fee->setAmount(1);
    echo "<br>testGetAmountNotBlank " . (($fee->getAmount() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $fee = new Fee();
    $fee->setAmount(10);
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
    $fee->setUser($user);
    $fee->setYear(2013);
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $fee->toString());
  }
  public static function runAllTests() {
    FeeTest::testGetUserBlank();
    FeeTest::testGetUserNotBlank();
    FeeTest::testGetYearBlank();
    FeeTest::testGetYearNotBlank();
    FeeTest::testGetAmountBlank();
    FeeTest::testGetAmountNotBlank();
    FeeTest::testToString();
  }
}
FeeTest::runAllTests();
?>
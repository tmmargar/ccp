<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use ccp\classes\model\User;
use Exception;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class UserTest extends BaseTest {
  public static function testGetIdBlank() {
    $user = new User();
    echo "<br>testGetIdBlank " . (($user->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $user = new User();
    $user->setId(1);
    echo "<br>testGetIdNotBlank " . (($user->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFirstNameBlank() {
    $user = new User();
    echo "<br>testGetFirstNameBlank " . (($user->getFirstName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFirstNameNotBlank() {
    $user = new User();
    $user->setFirstName("abc");
    echo "<br>testGetFirstNameNotBlank " . (($user->getFirstName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLastNameBlank() {
    $user = new User();
    echo "<br>testGetLastNameBlank " . (($user->getLastName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLastNameNotBlank() {
    $user = new User();
    $user->setLastName("abc");
    echo "<br>testGetLastNameNotBlank " . (($user->getLastName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetEmailBlank() {
    $user = new User();
    echo "<br>testGetEmailBlank " . (($user->getEmail() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetEmailNotBlank() {
    $user = new User();
    $user->setEmail("abc");
    echo "<br>testGetEmailNotBlank " . (($user->getEmail() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserIdBlank() {
    $user = new User();
    echo "<br>testGetUserIdBlank " . (($user->getUserId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserIdNotBlank() {
    $user = new User();
    $user->setUsername("abc");
    echo "<br>testGetUserIdNotBlank " . (($user->getUserId() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPasswordBlank() {
    $user = new User();
    echo "<br>testGetPasswordBlank " . (($user->getPassword() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPasswordNotBlank() {
    $user = new User();
    $user->setPassword("abc");
    echo "<br>testGetPasswordNotBlank " . (($user->getPassword() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTypeBlank() {
    $user = new User();
    echo "<br>testGetTypeBlank " . (($user->getType() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTypeNotBlank() {
    $user = new User();
    $user->setType("Registered");
    echo "<br>testGetTypeNotBlank " . (($user->getType() == "Registered") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTypeException() {
    $user = new User();
    try {
      $user->setType("abc");
      echo "<br>testGetTypeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetTypeException " . self::getPassOutput();
    }
  }
  public static function testGetAddressBlank() {
    $user = new User();
    echo "<br>testGetAddressBlank " . (($user->getAddress() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddressNotBlank() {
    $user = new User();
    $address = new Address();
    $address->setAddress("123 abc");
    $user->setAddress($address);
    echo "<br>testGetAddressNotBlank " . (($user->getAddress()->getAddress() == "123 abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddressException() {
    $user = new User();
    try {
      $user->setAddress("abc");
      echo "<br>testGetAddressException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetAddressException " . self::getPassOutput();
    }
  }
  public static function testGetNameBlank() {
    $user = new User();
    echo "<br>testGetNameBlank " . (($user->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $user = new User();
    $user->setFirstName("abc");
    $user->setLastName("def");
    echo "<br>testGetNameNotBlank " . (($user->getName() == "abc def") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $user = new User();
    $address = new Address();
    $address->setAddress("123 abc");
    $address->setCity("Howell");
    $address->setId(1);
    $address->setState("MI");
    $address->setZip(99999);
    $user->setAddress($address);
    $user->setFirstName("fn");
    $user->setEmail("email@somewhere.com");
    $user->setId(2);
    $user->setLastName("ln");
    $user->setPassword("pwd");
    $user->setType("Administrator");
    $user->setUsername("username");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $user->toString());
  }
  public static function runAllTests() {
    UserTest::testGetIdBlank();
    UserTest::testGetIdNotBlank();
    UserTest::testGetFirstNameBlank();
    UserTest::testGetFirstNameNotBlank();
    UserTest::testGetLastNameBlank();
    UserTest::testGetLastNameNotBlank();
    UserTest::testGetEmailBlank();
    UserTest::testGetEmailNotBlank();
    UserTest::testGetUserIdBlank();
    UserTest::testGetUserIdNotBlank();
    UserTest::testGetPasswordBlank();
    UserTest::testGetPasswordNotBlank();
    UserTest::testGetTypeBlank();
    UserTest::testGetTypeNotBlank();
    UserTest::testGetTypeException();
    UserTest::testGetGroupsBlank();
    UserTest::testGetGroupsNotBlank();
    UserTest::testGetAddressBlank();
    UserTest::testGetAddressNotBlank();
    UserTest::testGetAddressException();
    UserTest::testGetNameBlank();
    UserTest::testGetNameNotBlank();
    UserTest::testToString();
  }
}
UserTest::runAllTests();
?>
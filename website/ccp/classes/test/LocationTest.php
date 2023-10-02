<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\Location;
use ccp\classes\model\User;
use ccp\classes\model\UserGroup;
use Exception;
// include_once "../init.php";
// include_once ROOT . "/autoload.php";
class LocationTest extends BaseTest {
  public static function testGetIdBlank() {
    $location = new Location();
    echo "<br>testGetIdBlank " . (($location->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $location = new Location();
    $location->setId(1);
    echo "<br>testGetIdNotBlank " . (($location->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameBlank() {
    $location = new Location();
    echo "<br>testGetNameBlank " . (($location->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetNameNotBlank() {
    $location = new Location();
    $location->setName("abc");
    echo "<br>testGetNameNotBlank " . (($location->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserBlank() {
    $location = new Location();
    echo "<br>testGetUserBlank " . (($location->getUser() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserNotBlank() {
    $location = new Location();
    $user = new User();
    $user->setId(33);
    $location->setUser($user);
    echo "<br>testGetUserNotBlank " . (($location->getUser()->getId() == 33) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetUserException() {
    $location = new Location();
    try {
      $location->setUser(1);
      echo "<br>testGetUserException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetUserException " . self::getPassOutput();
    }
  }
  public static function testGetCountBlank() {
    $location = new Location();
    echo "<br>testGetCountBlank " . (($location->getName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCountNotBlank() {
    $location = new Location();
    $location->setName("abc");
    echo "<br>testGetCountNotBlank " . (($location->getName() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetActiveBlank() {
    $location = new Location();
    echo "<br>testGetActiveBlank " . (($location->getActive() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetActiveNotBlank() {
    $location = new Location();
    $location->setActive(Constant::NO_FLAG);
    echo "<br>testGetActiveNotBlank " . (($location->getActive() == Constant::NO_FLAG) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetActiveException() {
    $location = new Location();
    try {
      $location->setActive(1);
      echo "<br>testGetActiveException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetActiveException " . self::getPassOutput();
    }
  }
  public static function testToString() {
    $location = new Location();
    $location->setActive(true);
    $location->setCount(3);
    $location->setId(1);
    $location->setName("loc nm");
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
    $location->setUser($user);
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $location->toString());
  }
  public static function runAllTests() {
    LocationTest::testGetIdBlank();
    LocationTest::testGetIdNotBlank();
    LocationTest::testGetNameBlank();
    LocationTest::testGetNameNotBlank();
    LocationTest::testGetUserBlank();
    LocationTest::testGetUserNotBlank();
    LocationTest::testGetUserException();
    LocationTest::testGetCountBlank();
    LocationTest::testGetCountNotBlank();
    LocationTest::testGetActiveBlank();
    LocationTest::testGetActiveNotBlank();
    LocationTest::testGetActiveException();
    LocationTest::testToString();
  }
}
LocationTest::runAllTests();
?>
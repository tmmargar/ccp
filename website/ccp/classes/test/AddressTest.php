<?php
namespace ccp\classes\Test;
use ccp\classes\model\Address;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class AddressTest extends BaseTest {
  public static function testGetIdBlank() {
    $address = new Address();
    echo "<br>testGetIdBlank " . (($address->getId() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdNotBlank() {
    $address = new Address();
    $address->setId(1);
    echo "<br>testGetIdNotBlank " . (($address->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetIdException() {
    $address = new Address();
    try {
      $address->setId("a");
      echo "<br>testGetIdException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetIdException " . self::getPassOutput();
    }
  }
  public static function testGetAddressBlank() {
    $address = new Address();
    echo "<br>testGetAddressBlank " . (($address->getAddress() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetAddressNotBlank() {
    $address = new Address();
    $address->setAddress("abc");
    echo "<br>testGetAddressNotBlank " . (($address->getAddress() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCityBlank() {
    $address = new Address();
    echo "<br>testGetCityBlank " . (($address->getCity() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCityNotBlank() {
    $address = new Address();
    $address->setCity("abc");
    echo "<br>testGetCityNotBlank " . (($address->getCity() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStateBlank() {
    $address = new Address();
    echo "<br>testGetStateBlank " . (($address->getState() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStateNotBlank() {
    $address = new Address();
    $address->setState("MI");
    echo "<br>testGetStateNotBlank " . (($address->getState() == "MI") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetStateException() {
    $address = new Address();
    try {
      $address->setId("ABC");
      echo "<br>testGetStateException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetStateException " . self::getPassOutput();
    }
  }
  public static function testGetZipBlank() {
    $address = new Address();
    echo "<br>testGetZipBlank " . (($address->getZip() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetZipNotBlank() {
    $address = new Address();
    $address->setZip(11111);
    echo "<br>testGetZipNotBlank " . (($address->getZip() == 11111) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetZipStringException() {
    $address = new Address();
    try {
      $address->setZip("123");
      echo "<br>testGetZipException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetZipException " . self::getPassOutput();
    }
  }
  public static function testGetZipNumberShortException() {
    $address = new Address();
    try {
      $address->setZip(123);
      echo "<br>testGetZipNumberShortException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetZipNumberShortException " . self::getPassOutput();
    }
  }
  public static function testToString() {
    $address = new Address();
    $address->setAddress("123 abc");
    $address->setCity("cty");
    $address->setId(1);
    $address->setState("MI");
    $address->setZip(99999);
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $address->toString());
  }
  public static function runAllTests() {
    AddressTest::testGetIdBlank();
    AddressTest::testGetIdNotBlank();
    AddressTest::testGetIdException();
    AddressTest::testGetAddressBlank();
    AddressTest::testGetAddressNotBlank();
    AddressTest::testGetCityBlank();
    AddressTest::testGetCityNotBlank();
    AddressTest::testGetStateBlank();
    AddressTest::testGetStateNotBlank();
    AddressTest::testGetStateException();
    AddressTest::testGetZipBlank();
    AddressTest::testGetZipNotBlank();
    AddressTest::testGetZipStringException();
    AddressTest::testGetZipNumberShortException();
    AddressTest::testToString();
  }
}
AddressTest::runAllTests();
?>
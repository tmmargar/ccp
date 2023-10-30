<?php
namespace ccp\classes\Test;
use ccp\classes\model\Structure;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class StructureTest extends BaseTest {
    public static function testGetPlaceBlank() {
    $structure = new Structure();
    echo "<br>testGetPlaceBlank " . (($structure->getPlace() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPlaceNotBlank() {
    $structure = new Structure();
    $structure->setPlace(1);
    echo "<br>testGetPlaceNotBlank " . (($structure->getPlace() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPlaceException() {
    $structure = new Structure();
    try {
      $structure->setPlace("abc");
      echo "<br>testGetPlaceException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetPlaceException " . self::getPassOutput();
    }
  }
  public static function testGetPercentageBlank() {
    $structure = new Structure();
    echo "<br>testGetPercentageBlank " . (($structure->getPercentage() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPercentageNotBlank() {
    $structure = new Structure();
    $structure->setPercentage(.1);
    echo "<br>testGetPercentageNotBlank " . (($structure->getPercentage() == .1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPercentageException() {
    $structure = new Structure();
    try {
      $structure->setPercentage("abc");
      echo "<br>testGetPercentageException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetPercentageException " . self::getPassOutput();
    }
  }
  public static function testToString() {
    $structure = new Structure();
    $structure->setId(1);
    $structure->setPercentage(.2);
    $structure->setPlace(1);
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $structure->toString());
  }
  public static function runAllTests() {
    StructureTest::testGetPlaceBlank();
    StructureTest::testGetPlaceNotBlank();
    StructureTest::testGetPlaceException();
    StructureTest::testGetPercentageBlank();
    StructureTest::testGetPercentageNotBlank();
    StructureTest::testGetPercentageException();
    StructureTest::testToString();
  }
}
StructureTest::runAllTests();
?>
<?php
namespace ccp\classes\Test;
use ccp\classes\model\Constant;
use ccp\classes\model\Status;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class StatusTest extends BaseTest {
  public static function testGetCodeBlank() {
    $status = new Status();
    echo "<br>testGetCodeBlank " . (($status->getCode() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCodeNotBlank() {
    $status = new Status();
    $status->setCode("F");
    echo "<br>testGetCodeNotBlank " . (($status->getCode() == "F") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCodeException() {
    $status = new Status();
    try {
      $status->setCode("a");
      echo "<br>testGetCodeException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetCodeException " . self::getPassOutput();
    }
  }
  public static function testGetDescriptionNotBlank() {
    $status = new Status();
    $status->setCode("F");
    echo "<br>testGetDescriptionNotBlank " . (($status->getDescription() == "Finished") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $status = new Status();
    $status->setCode(Constant::STATUS_CODE_FINISHED);
    $status->setId(1);
    $status->setName("st nm");
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $status->toString());
  }
  public static function runAllTests() {
    StatusTest::testGetCodeBlank();
    StatusTest::testGetCodeNotBlank();
    StatusTest::testGetCodeException();
    StatusTest::testGetDescriptionNotBlank();
    StatusTest::testToString();
  }
}
StatusTest::runAllTests();
?>
<?php
namespace ccp\classes\utility\Test;
use ccp\classes\Test\BaseTest;
use ccp\classes\utility\HtmlUtility;
use Exception;
//include_once "../../init.php";
//include_once ROOT . "/autoload.php";
class HtmlUtilityTest extends BaseTest {
  public static function testBuildLastModified() {
    echo "buildLastModified<pre>" . htmlentities(HtmlUtility::buildLastModified()) . "</pre>";
  }
  public static function testBuildNavigation() {
    echo "buildNavigation<pre>" . htmlentities(HtmlUtility::buildNavigation(1)) . "</pre>";
  }
//   public static function testBuildErrorMessage() {
//     try {
//       throw new Exception("test exception");
//     } catch (Exception $e) {
//       echo "buildErrorMessage<pre>" . htmlentities(HtmlUtility::buildErrorMessage($e)) . "</pre>";
//     }
//   }
  public static function runAllTests() {
    HtmlUtilityTest::testBuildLastModified();
    HtmlUtilityTest::testBuildNavigation();
//     HtmlUtilityTest::testBuildErrorMessage();
  }
}
HtmlUtilityTest::runAllTests();
?>
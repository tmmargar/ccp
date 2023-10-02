<style type="text/css" media="all">
  .pass, .fail {font-weight: bold;}
  .pass	{color: green;}
  .fail	{color: red;}
</style>
<?php
namespace ccp\classes\Test;
use ErrorException;
function errorHandler($errno, $errstr, $errfile, $errline) {
  if ($errno === E_RECOVERABLE_ERROR) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
  }
  return false;
}
set_error_handler("errorHandler");
class BaseTest {
  public static $CLASS_NAME_PASS = "pass";
  public static $CLASS_NAME_FAIL = "fail";
  protected static function getPassOutput() {
    return BaseTest::getTextOutput(BaseTest::$CLASS_NAME_PASS, "passed");
  }
  protected static function getFailOutput() {
    return BaseTest::getTextOutput(BaseTest::$CLASS_NAME_FAIL, "failed");
  }
  protected static function getTextOutput($class, $text) {
    return "<span class=\"" . $class . "\">" . $text . "</span>";
  }
}
?>
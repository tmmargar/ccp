<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
abstract class Root {
  private $debug = false;
  // dynamic way to call constructor based on number of parameters (using naming  __construct#()
  public function __construct() {
    $arguments = func_get_args();
    $numberOfArguments = func_num_args();
    if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
//       $reflection = new \ReflectionClass($this);
//       echo "<br>Calling __construct" . $numberOfArguments . " on " . $reflection->getName();
      call_user_func_array(array($this, $function), $arguments);
    }
  }
  public function __construct1($debug) {
    $this->debug = $debug;
  }
  public function isDebug() {
    return $this->debug;
  }
  /*
   * public function serialize() {
   * return serialize($this);
   * }
   */
  public function setDebug($debug) {
    $this->debug = $debug;
  }
  /*
   * public function unserialize($serialized) {
   * return unserialize($serialized);
   * }
   */
  public function __toString() {
    $output = "debug = ";
    $output .= var_export($this->debug, true);
    return $output;
  }
}
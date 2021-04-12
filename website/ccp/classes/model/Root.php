<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class Root {
  private bool $debug = false;
  public function __construct($debug) {
    $this->debug = $debug;
  }
  public function isDebug() {
    return $this->debug;
  }
  public function setDebug(bool $debug) {
    $this->debug = $debug;
  }
  public function __toString() {
    $output = "debug = ";
    $output .= var_export($this->debug, true);
    return $output;
  }
}
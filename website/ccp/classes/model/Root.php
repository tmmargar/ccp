<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class Root {
  public function __construct(protected bool $debug = false) {}
  public function isDebug() {
    return $this->debug;
  }
  public function setDebug(bool $debug) {
    $this->debug = $debug;
  }
  public function __toString() {
    $output = "debug = ";
    if (isset($this->debug)) {
      $output .= var_export($this->debug, true);
    }
    return $output;
  }
}
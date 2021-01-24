<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class Status extends Base {
  private static $codeList = array(
    "P" => "Paid",
    "R" => "Registered",
    "F" => "Finished"
  );
  private $code;
  private $name;
  public function getCode() {
    return $this->code;
  }
  public function getName() {
    return $this->name;
  }
  public function getDescription() {
    return self::$codeList[$this->code];
  }
  public function setCode($code) {
    if (array_key_exists($code, self::$codeList)) {
      $this->code = $code;
    } else {
      throw new Exception($code . " is not a valid status code");
    }
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", code = '";
    $output .= $this->getCode();
    $output .= "', name = '";
    $output .= $this->getName();
    $output .= "', description = '";
    $output .= $this->getDescription();
    $output .= "'";
    return $output;
  }
}
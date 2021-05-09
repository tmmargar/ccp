<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use Exception;
class Status extends Base {
  private static array $codeList = array("P" => "Paid", "R" => "Registered", "F" => "Finished");
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $code, protected string $name) {
    parent::__construct($debug, $id);
  }
  public function getCode() {
    return $this->code;
  }
  public function getName() {
    return $this->name;
  }
  public function getDescription() {
    return self::$codeList[$this->code];
  }
  public function setCode(string $code) {
    if (array_key_exists($code, self::$codeList)) {
      $this->code = $code;
    } else {
      throw new Exception($code . " is not a valid status code");
    }
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", code = '";
    $output .= $this->code;
    $output .= "', name = '";
    $output .= $this->name;
    $output .= "', description = '";
    $output .= $this->description;
    $output .= "'";
    return $output;
  }
}
<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Phone extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $value) {
    parent::__construct($debug, $id);
  }
  public function getValue() {
    return $this->value == "0" ? "0000000000" : $this->value;
  }
  public function setValue(string $value) {
    $this->value = $value;
  }
  public function getDisplayFormatted() {
    // note: making sure we have something
    if (! isset($this->value[3])) {
      return '';
    }
    // note: strip out everything but numbers
    $valueNumbersOnly = preg_replace("/[^0-9]/", "", $this->value);
    $length = strlen($valueNumbersOnly);
    switch ($length) {
      case 7:
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $valueNumbersOnly);
        break;
      case 10:
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $valueNumbersOnly);
        break;
      case 11:
        return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $valueNumbersOnly);
        break;
      default:
        return $valueNumbersOnly;
        break;
    }
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", value = '";
    $output .= $this->value;
    $output .= "'";
    return $output;
  }
}
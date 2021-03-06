<?php
namespace ccp\classes\model;
class Phone extends Base {
  private $value;
  public function __construct($value) {
    $this->value = $value;
  }
  public function getValue() {
    return $this->value;
  }
  public function setValue($value) {
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
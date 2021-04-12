<?php
namespace ccp\classes\model;
class BooleanString extends Base {
  private string $value;
  public function __construct($value) {
    $this->value = $value;
  }
  public function getValue() {
    return $this->value;
  }
  public function setValue(string $value) {
    $this->value = $value;
  }
  public function getBoolean() {
    return Constant::$FLAG_YES == $this->value ? true : false;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", value = '";
    $output .= $this->value;
    $output .= "'";
    return $output;
  }
}
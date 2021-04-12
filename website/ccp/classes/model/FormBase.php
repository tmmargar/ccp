<?php
namespace ccp\classes\model;
class FormBase extends Base {
  private array $class; // array
  private bool $disabled; // boolean
  private string|null $name;
  private string|null $suffix;
  private array|string|null $value;
  public function __construct(bool $debug, array|null $class, bool $disabled, string|int $id, string|null $name, string|null $suffix, array|string|null $value) {
    parent::__construct($debug, $id);
    $this->class = null == $class ? array() : $class;
    $this->disabled = $disabled;
    $this->name = Base::build($name, null);
    $this->suffix = $suffix;
//     $this->value = !isset($value) || $value == "" ? null : $value;
    $this->value = (isset($value) && $value != "") || $value == 0 ? $value : null;
//     echo "<BR>" . $id . " -- " . $value . " -> " . $this->value;
  }
  public function getClass() {
    return $this->class;
  }
  public function getClassAsString() {
    return implode(" ", $this->class);
  }
  public function getName() {
    return $this->name;
  }
  public function getSuffix() {
    return $this->suffix;
  }
  public function getValue() {
    return $this->value;
  }
  public function isDisabled() {
    return $this->disabled;
  }
  public function setClass(array|null $class) {
    $this->class = $class;
  }
  public function setDisabled(bool $disabled) {
    $this->disabled = $disabled;
  }
  public function setName(string|null $name) {
    $this->name = $name;
  }
  public function setSuffix(string|null $suffix) {
    $this->suffix = $suffix;
  }
  public function setValue(array|string|null $value) {
    $this->value = $value;
  }
  public function toString() {
    $output = parent::__toString();
    $output .= ", class = '";
    $output .= print_r($this->class, true);
    $output .= "', disabled = ";
    $output .= $this->disabled;
    $output .= ", name = '";
    $output .= $this->name;
    $output .= ", suffx = '";
    $output .= $this->suffix;
    $output .= "', value = '";
    $output .= $this->value;
    $output .= "'";
    return $output;
  }
}
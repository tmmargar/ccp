<?php
namespace ccp\classes\model;
class Group extends Base {
  private string $name;
  public function getName() {
    return $this->name;
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->getName();
    $output .= "'";
    return $output;
  }
}
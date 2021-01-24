<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class Group extends Base {
  private $name;
  public function getName() {
    return $this->name;
  }
  public function setName($name) {
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
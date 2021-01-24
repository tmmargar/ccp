<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class Bounty extends Base {
  private $name;
  private $description;
  public function getName() {
    return $this->name;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setDescription($description) {
    $this->description = $description;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->getName();
    $output .= "', description = '";
    $output .= $this->getDescription();
    $output .= "'";
    return $output;
  }
}
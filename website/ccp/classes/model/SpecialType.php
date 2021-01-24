<?php
namespace ccp\classes\model;
class SpecialType extends Base {
  private $description;

  public function __construct3($debug, $id, $description) {
    parent::__construct2($debug, $id);
    $this->description = $description;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= "', description = '";
    $output .= $this->getDescription();
    $output .= "'";
    return $output;
  }
}
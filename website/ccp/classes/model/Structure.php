<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class Structure extends Base {
  private $place; // number
  private $percentage; // number
  public function getPlace() {
    return $this->place;
  }
  public function getPercentage() {
    return $this->percentage;
  }
  public function setPlace($place) {
    if (is_int($place)) {
      $this->place = $place;
    } else {
      throw new Exception($place . " is not a valid number");
    }
  }
  public function setPercentage($percentage) {
    //if (is_float($percentage)) {
    if (is_numeric($percentage)) {
      $this->percentage = $percentage;
    } else {
      throw new Exception($percentage . " is not a valid number");
    }
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", place = ";
    $output .= $this->getPlace();
    $output .= ", percentage = ";
    $output .= $this->getPercentage();
    return $output;
  }
}
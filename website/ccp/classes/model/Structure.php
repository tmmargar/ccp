<?php
namespace ccp\classes\model;
use Exception;
class Structure extends Base {
  private int $place; // number
  private int $percentage; // number
  public function getPlace() {
    return $this->place;
  }
  public function getPercentage() {
    return $this->percentage;
  }
  public function setPlace(int $place) {
    $this->place = $place;
  }
  public function setPercentage(float $percentage) {
    $this->percentage = $percentage;
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
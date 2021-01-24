<?php
namespace ccp\classes\model;
class Season extends Base {
  private $description;
  private $startDate;
  private $endDate;
  private $active; // 1 is active, 0 is not

  public function __construct6($debug, $id, $description, $startDate, $endDate, $active) {
    parent::__construct2($debug, $id);
    $this->description = $description;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->active = $active;
  }

  public function getActive() {
    return $this->active;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getEndDate() {
    return $this->endDate;
  }

  public function getStartDate() {
    return $this->startDate;
  }

  public function setActive($active) {
    $this->active = $active;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setEndDate($endDate) {
    $this->endDate = $endDate;
  }

  public function setStartDate($startDate) {
    $this->startDate = $startDate;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= "', description = '";
    $output .= $this->getDescription();
    $output .= "', startDate = '";
    $output .= $this->getStartDate()->getDisplayFormat();
    $output .= "', endDate = '";
    $output .= $this->getEndDate()->getDisplayFormat();
    $output .= "', active = '";
    $output .= $this->getActive();
    $output .= "'";
    return $output;
  }
}
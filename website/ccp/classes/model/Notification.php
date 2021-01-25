<?php
namespace ccp\classes\model;
class Notification extends Base {
  private $description;
  private $startDate;
  private $endDate;

  public function __construct5($debug, $id, $description, $startDate, $endDate) {
    parent::__construct2($debug, $id);
    $this->description = $description;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
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
    $output .= "'";
    return $output;
  }
}
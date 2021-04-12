<?php
namespace ccp\classes\model;
class Season extends Base {
  private string $description;
  private DateTime $startDate;
  private DateTime $endDate;
  private int $active; // 1 is active, 0 is not
  public function __construct(bool $debug, int $id, string $description, DateTime $startDate, DateTime $endDate, int $active) {
    parent::__construct($debug, $id);
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

  public function setActive(int $active) {
    $this->active = $active;
  }

  public function setDescription(string $description) {
    $this->description = $description;
  }

  public function setEndDate(string $endDate) {
    $this->endDate = $endDate;
  }

  public function setStartDate(string $startDate) {
    $this->startDate = $startDate;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= "', description = '";
    $output .= $this->description;
    $output .= "', startDate = '";
    $output .= $this->startDate->getDisplayFormat();
    $output .= "', endDate = '";
    $output .= $this->endDate->getDisplayFormat();
    $output .= "', active = '";
    $output .= $this->active;
    $output .= "'";
    return $output;
  }
}
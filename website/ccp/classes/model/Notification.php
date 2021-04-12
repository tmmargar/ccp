<?php
namespace ccp\classes\model;
class Notification extends Base {
  private string $description;
  private string $startDate;
  private string $endDate;

  public function __construct(bool $debug, int $id, string $description, string $startDate, string $endDate) {
    parent::__construct($debug, $id);
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
    $output .= "'";
    return $output;
  }
}
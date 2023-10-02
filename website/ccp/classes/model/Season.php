<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Season extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $description, protected DateTime $startDate, protected DateTime $endDate, protected int $championshipQualify, protected int $fee, protected int $active) {
    parent::__construct($debug, $id);
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
  
  public function getFee() {
    return $this->fee;
  }

  public function getStartDate() {
    return $this->startDate;
  }
  
  public function getChampionshipQualify() {
    return $this->championshipQualify;
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
  
  public function setFee(int $fee) {
    $this->fee = $fee;
  }

  public function setStartDate(string $startDate) {
    $this->startDate = $startDate;
  }
  
  public function setChampionshipQualify(int $championshipQualify) {
    $this->championshipQualify = $championshipQualify;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= "', description = '";
    $output .= $this->description;
    $output .= "', startDate = '";
    $output .= $this->startDate->getDisplayFormat();
    $output .= "', endDate = '";
    $output .= $this->endDate->getDisplayFormat();
    $output .= "', championshipQualify = ";
    $output .= $this->championshipQualify;
    $output .= "', fee = ";
    $output .= $this->fee;
    $output .= ", active = '";
    $output .= $this->active;
    $output .= "'";
    return $output;
  }
}
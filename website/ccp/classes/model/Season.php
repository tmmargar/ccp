<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Season extends Base {
  public function __construct(protected bool $debug, protected string|int $id, protected string $description, protected DateTime $startDate, protected DateTime $endDate,
    protected int $championshipQualify, protected int $finalTablePlayers, protected int $finalTableBonusPoints, protected int $fee, protected int $active) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getActive(): int {
    return $this->active;
  }
  public function getDescription(): string {
    return $this->description;
  }
  public function getEndDate(): DateTime {
    return $this->endDate;
  }
  public function getFee(): int {
    return $this->fee;
  }
  public function getFinalTableBonusPoints(): int {
    return $this->finalTableBonusPoints;
  }
  public function getFinalTablePlayers(): int {
    return $this->finalTablePlayers;
  }
  public function getStartDate(): DateTime {
    return $this->startDate;
  }
  public function getChampionshipQualify(): int {
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
  public function setFinalTableBonusPoints(int $finalTableBonusPoints) {
    $this->finalTableBonusPoints = $finalTableBonusPoints;
  }
  public function setFinalTablePlayers(int $finalTablePlayers) {
    $this->finalTablePlayers = $finalTablePlayers;
  }
  public function setStartDate(string $startDate) {
    $this->startDate = $startDate;
  }
  public function setChampionshipQualify(int $championshipQualify) {
    $this->championshipQualify = $championshipQualify;
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= "', description = '";
    $output .= $this->description;
    $output .= "', startDate = '";
    $output .= $this->startDate->getDisplayFormat();
    $output .= "', endDate = '";
    $output .= $this->endDate->getDisplayFormat();
    $output .= "', championshipQualify = ";
    $output .= $this->championshipQualify;
    $output .= "', finalTableBonusPoints = ";
    $output .= $this->finalTableBonusPoints;
    $output .= "', finalTablePlayers = ";
    $output .= $this->finalTablePlayers;
    $output .= ", fee = ";
    $output .= $this->fee;
    $output .= ", active = ";
    $output .= $this->active;
    return $output;
  }
}
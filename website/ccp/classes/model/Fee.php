<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Fee extends Base {
  public function __construct(protected bool $debug, protected int $seasonId, protected int $playerId, protected int $amount) {
    parent::__construct($debug, $id);
  }
  
  public function getAmount() {
    return $this->amount;
  }
  
  public function getPlayerId() {
    return $this->playerId;
  }
  
  public function getSeasonId() {
    return $this->seasonId;
  }
  
  public function setAmount(int $amount) {
    $this->amount = $amount;
  }

  public function setPlayerId(string $playerId) {
    $this->playerId = $playerId;
  }

  public function setSeasonId(string $seasonId) {
    $this->seasonId = $seasonId;
  }
  
  public function __toString() {
    $output = parent::__toString();
    $output .= ", amount = ";
    $output .= $this->amount;
    $output .= ", playerId = ";
    $output .= $this->playerId;
    $output .= ", seasonId = ";
    $output .= $this->seasonId;
    $output .= "";
    return $output;
  }
}
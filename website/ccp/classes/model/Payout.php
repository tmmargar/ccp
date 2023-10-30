<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Payout extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $name, protected int $bonusPoints, protected int $minPlayers, protected int $maxPlayers,
    protected array|null $structures) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getName(): string {
    return $this->name;
  }
  public function getBonusPoints(): int {
    return $this->bonusPoints;
  }
  public function getMinPlayers(): int {
    return $this->minPlayers;
  }
  public function getMaxPlayers(): int {
    return $this->maxPlayers;
  }
  public function getStructures(): array {
    return $this->structures;
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function setBonusPoints(int $bonusPoints) {
    $this->bonusPoints = $bonusPoints;
  }
  public function setMinPlayers(int $minPlayers) {
    $this->minPlayers = $minPlayers;
  }
  public function setMaxPlayers(int $maxPlayers) {
    $this->maxPlayers = $maxPlayers;
  }
  public function setStructures(array|null $structures) {
    $this->structures = $structures;
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->name;
    $output .= "', bonusPoints = ";
    $output .= $this->bonusPoints;
    $output .= "', minPlayers = ";
    $output .= $this->minPlayers;
    $output .= ", maxPlayers = ";
    $output .= $this->maxPlayers;
    $output .= ", structures = [";
    foreach ($this->structures as $structure) {
      $output .= "[";
      $output .= $structure;
      $output .= "],";
    }
    $output = substr(string: $output, offset: 0, length: strlen(string: $output) - 1) . "]";
    return $output;
  }
}
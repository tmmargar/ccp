<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class Payout extends Base {
  private $name;
  private $bonusPoints; // number
  private $minPlayers; // number
  private $maxPlayers; // number
  private $structures; // array of Structure objects
  public function getName() {
    return $this->name;
  }
  public function getBonusPoints() {
    return $this->bonusPoints;
  }
  public function getMinPlayers() {
    return $this->minPlayers;
  }
  public function getMaxPlayers() {
    return $this->maxPlayers;
  }
  public function getStructures() {
    return $this->structures;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setBonusPoints($bonusPoints) {
    if (is_int($bonusPoints)) {
      $this->bonusPoints = $bonusPoints;
    } else {
      throw new Exception($bonusPoints . " is not a valid number");
    }
  }
  public function setMinPlayers($minPlayers) {
    if (is_int($minPlayers)) {
      $this->minPlayers = $minPlayers;
    } else {
      throw new Exception($minPlayers . " is not a valid number");
    }
  }
  public function setMaxPlayers($maxPlayers) {
    if (is_int($maxPlayers)) {
      $this->maxPlayers = $maxPlayers;
    } else {
      throw new Exception($maxPlayers . " is not a valid number");
    }
  }
  public function setStructures($structures) {
    if (is_array($structures)) {
      $this->structures = $structures;
    } else {
      throw new Exception($structures . " is not an array");
    }
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->getName();
    $output .= "', bonusPoints = ";
    $output .= $this->getBonusPoints();
    $output .= "', minPlayers = ";
    $output .= $this->getMinPlayers();
    $output .= ", maxPlayers = ";
    $output .= $this->getMaxPlayers();
    $output .= ", structures = [";
    foreach ($this->getStructures() as $structure) {
      $output .= "[";
      $output .= $structure->__toString();
      $output .= "],";
    }
    $output = substr($output, 0, strlen($output) - 1) . "]";
    return $output;
  }
}
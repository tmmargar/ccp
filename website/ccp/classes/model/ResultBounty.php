<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class ResultBounty extends Base {
  private $tournament; // tournament object // key
  private $bounty; // bounty object // key
  private $user; // user object // key
  public function getTournament() {
    return $this->tournament;
  }
  public function getBounty() {
    return $this->bounty;
  }
  public function getUser() {
    return $this->user;
  }
  public function setTournament(Tournament $tournament) {
    $this->tournament = $tournament;
  }
  public function setBounty(Bounty $bounty) {
    $this->bounty = $bounty;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", tournament = [";
    $output .= $this->getTournament()->__toString();
    $output .= "], bounty = [";
    $output .= $this->getBounty()->__toString();
    $output .= "], user = [";
    $output .= $this->getUser()->__toString();
    $output .= "]";
    return $output;
  }
}
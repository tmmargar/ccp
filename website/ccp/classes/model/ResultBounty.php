<?php
namespace ccp\classes\model;
class ResultBounty extends Base {
  private Tournament|null $tournament; // tournament object // key
  private Bounty $bounty; // bounty object // key
  private User $user; // user object // key
  public function __construct(bool $debug, string|int|null $id, Tournament|null $tournament, Bounty $bounty, User $user) {
    parent::__construct($debug, $id);
    $this->tournament = $tournament;
    $this->bounty = $bounty;
    $this->user = $user;
  }
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
    $output .= $this->tournament;
    $output .= "], bounty = [";
    $output .= $this->bounty;
    $output .= "], user = [";
    $output .= $this->user;
    $output .= "]";
    return $output;
  }
}
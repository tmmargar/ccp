<?php
namespace ccp\classes\model;
class TournamentBounty extends Base {
  private Tournament $tournament; // tournament object
  private Bounty $bounty; // bounty object
  private User $user; // user object
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
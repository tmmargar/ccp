<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class ResultBounty extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected Tournament|null $tournament, protected Bounty $bounty, protected User $user) {
    parent::__construct($debug, $id);
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
<?php
namespace ccp\classes\model;
class GroupPayout extends Base {
  private Group $group; // Group object
  private array $payouts; // array of Payout objects
  public function getGroup() {
    return $this->group;
  }
  public function getPayouts() {
    return $this->payouts;
  }
  public function setGroup(Group $group) {
    $this->group = $group;
  }
  public function setPayouts(array $payouts) {
    $this->payouts = $payouts;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= "group = [";
    $output .= $this->group;
    $output .= "], payouts = [";
    foreach ($this->payouts as $payout) {
      $output .= "[";
      $output .= $payout;
      $output .= "],";
    }
    $output = substr($output, 0, strlen($output) - 1) . "]";
    return $output;
  }
}
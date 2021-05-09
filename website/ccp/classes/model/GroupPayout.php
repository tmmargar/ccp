<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class GroupPayout extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected Group $group, protected array $payouts) {
    parent::__construct($debug, $id);
  }
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
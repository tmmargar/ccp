<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class GroupPayout extends Base {
  public function __construct(protected bool $debug, protected string|int $id, protected Group $group, protected array $payouts) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getGroup(): Group {
    return $this->group;
  }
  public function getPayouts(): array {
    return $this->payouts;
  }
  public function setGroup(Group $group) {
    $this->group = $group;
  }
  public function setPayouts(array $payouts) {
    $this->payouts = $payouts;
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= "group = [";
    $output .= $this->group;
    $output .= "], payouts = [";
    foreach ($this->payouts as $payout) {
      $output .= "[";
      $output .= $payout;
      $output .= "],";
    }
    $output = substr($output, 0, strlen(string: $output) - 1) . "]";
    return $output;
  }
}
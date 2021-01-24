<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class GroupPayout extends Base {
  private $group; // Group object
  private $payouts; // array of Payout objects
  public function getGroup() {
    return $this->group;
  }
  public function getPayouts() {
    return $this->payouts;
  }
  public function setGroup(Group $group) {
    $this->group = $group;
  }
  public function setPayouts($payouts) {
    if (is_array($payouts)) {
      $this->payouts = $payouts;
    } else {
      throw new Exception($payouts . " is not an array");
    }
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= "group = [";
    $output .= $this->getGroup()->__toString();
    $output .= "], payouts = [";
    foreach ($this->getPayouts() as $payout) {
      $output .= "[";
      $output .= $payout->__toString();
      $output .= "],";
    }
    $output = substr($output, 0, strlen($output) - 1) . "]";
    return $output;
  }
}
<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class Fee {
  private $user; // key// user object
  private $year; // key // calendar year 4 digit
  private $amount; // number
  public function getUser() {
    return $this->user;
  }
  public function getYear() {
    return $this->year;
  }
  public function getAmount() {
    return $this->amount;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function setYear($year) {
    $this->year = $year;
  }
  public function setAmount($amount) {
    $this->amount = $amount;
  }
  public function __toString() {
    $output = "user = [";
    $output .= $this->getUser()->__toString();
    $output .= "], year = ";
    $output .= $this->getYear();
    $output .= ", amount = ";
    $output .= $this->getAmount();
    return $output;
  }
}
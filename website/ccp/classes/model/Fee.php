<?php
namespace ccp\classes\model;
class Fee {
  private User $user; // key// user object
  private int $year; // key // calendar year 4 digit
  private int $amount; // number
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
  public function setYear(int $year) {
    $this->year = $year;
  }
  public function setAmount(int $amount) {
    $this->amount = $amount;
  }
  public function __toString() {
    $output = "user = [";
    $output .= $this->user;
    $output .= "], year = ";
    $output .= $this->year;
    $output .= ", amount = ";
    $output .= $this->amount;
    return $output;
  }
}
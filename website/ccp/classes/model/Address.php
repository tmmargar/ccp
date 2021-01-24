<?php
namespace ccp\classes\model;
use Exception;
class Address extends Base {
  // AA and XX are temporary placeholders
  public static $stateList = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ","NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WY", "AA", "XX");
  private $address;
  private $city;
  private $phone;
  private $state; // 2 character
  private $zip; // 5 digits
  public function __construct5($address, $city, $state, int $zip, int $phone) {
    $this->address = $address;
    $this->city = $city;
    $this->state = $state;
    $this->zip = $zip;
    $this->phone = $phone;
  }
  public function getAddress() {
    return $this->address;
  }
  public function getCity() {
    return $this->city;
  }
  public function getPhone() {
    return $this->phone;
  }
  public function getState() {
    return $this->state;
  }
  public function getZip() {
    return $this->zip;
  }
  public function setAddress($address) {
    $this->address = $address;
  }
  public function setCity($city) {
    $this->city = $city;
  }
  public function setPhone($phone) {
    // fix validation to handle leading zero
    $this->phone = $phone;
  }
  public function setState($state) {
    if (in_array($state, self::$stateList)) {
      $this->state = $state;
    } else {
      throw new Exception($state . " is not a valid state abberviation");
    }
  }
  public function setZip($zip) {
    // fix validation to handle leading zero
//     if (is_int($zip) && strlen($zip) == 5) {
      $this->zip = $zip;
//     } else {
//       throw new Exception($zip . " is not a valid zip code");
//     }
  }
  public function toString() {
    $output = parent::__toString();
    $output .= ", address = '";
    $output .= $this->getAddress();
    $output .= "', city = '";
    $output .= $this->getCity();
    $output .= "', state = '";
    $output .= $this->getState();
    $output .= "', zip = ";
    $output .= $this->getZip();
    $output .= "', phone = ";
    $output .= $this->getPhone();
    return $output;
  }
}
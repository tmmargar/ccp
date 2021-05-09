<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use Exception;
class Address extends Base {
  // AA and XX are temporary placeholders
  public static $stateList = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ","NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WY", "AA", "XX");
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $address, protected string $city, protected string $state, protected int $zip, protected int|null $phone) {
    parent::__construct($debug, $id);
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
  public function setAddress(string $address) {
    $this->address = $address;
  }
  public function setCity(string $city) {
    $this->city = $city;
  }
  public function setPhone(int $phone) {
    $this->phone = $phone;
  }
  public function setState(string $state) {
    if (in_array($state, self::$stateList)) {
      $this->state = $state;
    } else {
      throw new Exception($state . " is not a valid state abberviation");
    }
  }
  public function setZip(int $zip) {
      $this->zip = $zip;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", address = '";
    $output .= $this->getAddress();
    $output .= "', city = '";
    $output .= $this->getCity();
    $output .= "', state = '";
    $output .= $this->getState();
    $output .= "', zip = ";
    $output .= $this->getZip();
    $output .= ", phone = ";
    $output .= $this->getPhone();
    return $output;
  }
}
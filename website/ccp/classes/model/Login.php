<?php
namespace ccp\classes\model;
class Login extends Base {
  private $username;
  private $password;
  public function __construct4($debug, $id, $username, $password) {
    parent::__construct2($debug, $id);
    $this->username = $username;
    $this->password = $password;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getUsername() {
    return $this->username;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  public function setUsername($username) {
    $this->username = $username;
  }
  public function __toString() {
    return parent::__toString() .
    "<br>username = " . $this->username .
    "<br>password = " . $this->password;
  }
}
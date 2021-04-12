<?php
namespace ccp\classes\model;
class Login extends Base {
  private string $username;
  private string $password;
  public function __construct(bool $debug, string|int|null $id, string $username, string $password) {
    parent::__construct($debug, $id);
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
    $output = parent::__toString();
    $output .= ", username = '" . $this->username;
    $output .= "', password = " . $this->password;
    return $output;
  }
}
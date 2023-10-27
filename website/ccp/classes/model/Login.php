<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Login extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $username, protected string $password) {
    parent::__construct(debug: $debug, id: $id);
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
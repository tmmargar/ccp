<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Database extends Root {
  public function __construct(protected bool $debug, protected string $hostName, protected string $userid, protected string $password, protected string $databaseName, protected int $port) {
    parent::__construct(debug: $debug);
  }
  public function getDsn() {
    return 'mysql:dbname=' . $this->getDatabaseName() . ';host=' . $this->getHostName() . ';port=' . $this->port;
  }
  public function getHostName() {
    return $this->hostName;
  }
  public function getUserid() {
    return $this->userid;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getDatabaseName() {
    return $this->databaseName;
  }
  public function getPort() {
    return $this->port;
  }
  public function setHostName(string $hostName) {
    $this->hostName = $hostName;
  }
  public function setUserid(string $userid) {
    $this->userid = $userid;
  }
  public function setPassword(string $password) {
    $this->password = $password;
  }
  public function setDatabaseName(string $databaseName) {
    $this->databaseName = $databaseName;
  }
  public function setPort(int $port) {
    $this->port = $port;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", hostName = '";
    $output .= $this->getHostName();
    $output .= "', userid = '";
    $output .= $this->getUserid();
    $output .= "', password = '";
    $output .= $this->getPassword();
    $output .= "', databaseName = '";
    $output .= $this->getDatabaseName();
    $output .= "', port = ";
    $output .= $this->getPort();
    return $output;
  }
}
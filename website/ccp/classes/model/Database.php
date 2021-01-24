<?php
namespace ccp\classes\model;
class Database extends Root {
  private $hostName;
  private $userid;
  private $password;
  private $databaseName;
  private $port;

  public function __construct6($debug, $hostName, $userid, $password, $databaseName, $port) {
    parent::__construct1($debug);
    $this->hostName = $hostName;
    $this->userid = $userid;
    $this->password = $password;
    $this->databaseName = $databaseName;
    $this->port = $port;
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
  public function setHostName($hostName) {
    $this->hostName = $hostName;
  }
  public function setUserid($userid) {
    $this->userid = $userid;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  public function setDatabaseName($databaseName) {
    $this->databaseName = $databaseName;
  }
  public function setPort($port) {
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
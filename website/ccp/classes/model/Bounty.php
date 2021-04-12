<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class Bounty extends Base {
  private string $name;
  private string $description;
  public function __construct(bool $debug, string|int|null $id, string $name, string $description) {
    parent::__construct($debug, $id);
    $this->name = $name;
    $this->description = $description;
  }
  public function getName() {
    return $this->name;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function setDescription(string $description) {
    $this->description = $description;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->name;
    $output .= "', description = '";
    $output .= $this->description;
    $output .= "'";
    return $output;
  }
}
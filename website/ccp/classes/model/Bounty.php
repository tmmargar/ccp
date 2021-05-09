<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Bounty extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $name, protected string $description) {
    parent::__construct($debug, $id);
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
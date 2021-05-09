<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Group extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $name) {
    parent::__construct($debug, $id);
  }
  public function getName() {
    return $this->name;
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->getName();
    $output .= "'";
    return $output;
  }
}
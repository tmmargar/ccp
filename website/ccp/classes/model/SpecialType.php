<?php
namespace ccp\classes\model;
class SpecialType extends Base {
  private string $description;

  public function __construct(bool $debug, int $id, string $description) {
    parent::__construct($debug, $id);
    $this->description = $description;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription(string $description) {
    $this->description = $description;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= ", description = '";
    $output .= $this->description;
    $output .= "'";
    return $output;
  }
}
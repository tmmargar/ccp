<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class SpecialType extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string|null $description) {
    parent::__construct($debug, $id);
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
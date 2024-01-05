<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class SpecialType extends Base {
  public function __construct(protected bool $debug, protected string|int $id, protected ?string $description, protected ?int $multiplier) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getDescription(): ?string {
    return $this->description;
  }
  public function getMultiplier(): ?int {
    return $this->multiplier;
  }
  public function setDescription(string $description) {
    $this->description = $description;
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= ", description = '";
    $output .= $this->description;
    $output .= "', multiplier = ";
    $output .= $this->multiplier;
    $output .= "";
    return $output;
  }
}
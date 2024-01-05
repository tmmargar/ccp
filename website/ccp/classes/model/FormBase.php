<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class FormBase extends Base {
  public function __construct(protected bool $debug, protected ?array $class, protected bool $disabled, protected string|int $id, protected ?string $name, protected ?string $suffix,
    protected array|string|int $value) {
    parent::__construct(debug: $debug, id: $id);
    $this->class = NULL == $class ? array() : $class;
    $this->name = Base::build(value: $name, suffix: NULL);
    $this->value = (isset($value) && $value != "") || $value == 0 ? $value : NULL;
  }
  public function getClass(): ?array {
    return $this->class;
  }
  public function getClassAsString(): string {
    return implode(" ", $this->class);
  }
  public function getName(): ?string {
    return $this->name;
  }
  public function getSuffix(): ?string {
    return $this->suffix;
  }
  public function getValue(): array|string|int {
    return $this->value;
  }
  public function isDisabled(): bool {
    return $this->disabled;
  }
  public function setClass(?array $class) {
    $this->class = $class;
  }
  public function setDisabled(bool $disabled) {
    $this->disabled = $disabled;
  }
  public function setName(?string $name) {
    $this->name = $name;
  }
  public function setSuffix(?string $suffix) {
    $this->suffix = $suffix;
  }
  public function setValue(array|string $value) {
    $this->value = $value;
  }
  public function toString(): string {
    $output = parent::__toString();
    $output .= ", class = ";
    $output .= print_r(value: $this->class, return: true);
    $output .= ", disabled = ";
    $output .= $this->disabled;
    $output .= ", name = '";
    $output .= $this->name;
    $output .= ", suffx = '";
    $output .= $this->suffix;
    $output .= "', value = '";
    $output .= $this->value;
    $output .= "'";
    return $output;
  }
}
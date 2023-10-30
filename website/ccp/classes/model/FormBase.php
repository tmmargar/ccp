<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class FormBase extends Base {
  public function __construct(protected bool $debug, protected array|null $class, protected bool $disabled, protected string|int|null $id, protected string|null $name, protected string|null $suffix,
    protected array|string|int|null $value) {
    parent::__construct(debug: $debug, id: $id);
    $this->class = null == $class ? array() : $class;
    $this->name = Base::build(value: $name, suffix: null);
    $this->value = (isset($value) && $value != "") || $value == 0 ? $value : null;
  }
  public function getClass(): array|null {
    return $this->class;
  }
  public function getClassAsString(): string {
    return implode(" ", $this->class);
  }
  public function getName(): string|null {
    return $this->name;
  }
  public function getSuffix(): string|null {
    return $this->suffix;
  }
  public function getValue(): array|string|int|null {
    return $this->value;
  }
  public function isDisabled(): bool {
    return $this->disabled;
  }
  public function setClass(array|null $class) {
    $this->class = $class;
  }
  public function setDisabled(bool $disabled) {
    $this->disabled = $disabled;
  }
  public function setName(string|null $name) {
    $this->name = $name;
  }
  public function setSuffix(string|null $suffix) {
    $this->suffix = $suffix;
  }
  public function setValue(array|string|null $value) {
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
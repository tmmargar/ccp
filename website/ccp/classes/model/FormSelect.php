<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class FormSelect extends FormBase {
  public function __construct(protected bool $debug, protected string $accessKey, protected array|null $class, protected bool $disabled, protected int|string|null $id, protected bool $multiple,
    protected string|null $name, protected string|null $onClick, protected bool $readOnly, protected int $size, protected string|null $suffix, protected array|string|int|null $value) {
    parent::__construct(debug: $debug, class: $class, disabled: $disabled, id: $id, name: $name, suffix: $suffix, value: $value);
  }
  public function getAccessKey(): string {
    return $this->accessKey;
  }
  public function getHtml(): string {
    return "<select" . ("" != $this->getClassAsString() ? " class=\"" . $this->getClassAsString() . "\"" : "") . (null !== $this->isDisabled() && $this->isDisabled() ? " disabled" : "") . " id=\"" .
      $this->getId() . "\"" . (null !== $this->isMultiple() && $this->isMultiple() ? " multiple" : "") . " name=\"" . $this->getName() . "\"" .
      (null !== $this->isReadOnly() && $this->isReadOnly() ? " readonly" : "") . " size=\"" . $this->getSize() . "\"" . ("" != $this->getOnClick() ? " onclick=\"" . $this->getOnClick() . "\"" : "") .
      ">\n";
  }
  public function getOnClick(): string|null {
    return $this->onClick;
  }
  public function getSize(): int {
    return $this->size;
  }
  public function isMultiple(): bool {
    return $this->multiple;
  }
  public function isReadOnly(): bool {
    return $this->readOnly;
  }
  public function setAccessKey(string $accessKey) {
    $this->accessKey = $accessKey;
  }
  public function setMultiple(bool $multiple) {
    $this->multiple = $multiple;
  }
  public function setOnClick(string $onClick) {
    $this->onClick = $onClick;
  }
  public function setReadOnly(bool $readOnly) {
    $this->readOnly = $readOnly;
  }
  public function setSize(int $size) {
    $this->size = $size;
  }
  public function toString(): string {
    $output = parent::__toString();
    $output .= ", accessKey = '";
    $output .= $this->accessKey;
    $output .= "', multiple = ";
    $output .= var_export(value: $this->multiple, return: true);
    $output .= "', onClick = '";
    $output .= $this->onClick;
    $output .= "', readOnly = ";
    $output .= var_export(value: $this->readOnly, return: true);
    $output .= ", size = ";
    $output .= $this->size;
    return $output;
  }
}
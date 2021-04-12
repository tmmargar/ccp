<?php
namespace ccp\classes\model;
class FormSelect extends FormBase {
  private string $accessKey;
  private bool $multiple;
  private string $onClick;
  private bool $readOnly;
  private int $size;
  public function __construct(bool $debug, string $accessKey, array $class, bool $disabled, int $id, bool $multiple, strin $name, string $onClick, bool $readOnly, int $size, string|null $suffix, string $value) {
    parent::__construct7($debug, $class, $disabled, $id, $name, $suffix, $value);
    $this->accessKey = $accessKey;
    $this->multiple = $multiple;
    $this->onClick = $onClick;
    $this->readOnly = $readOnly;
    $this->size = $size;
  }
  public function getAccessKey() {
    return $this->accessKey;
  }
  public function getHtml() {
    return "<select" .
//       (isset($this->getClassAsString()) ? " class=\"" . $this->getClassAsString() . "\"" : "") .
      ("" != $this->getClassAsString() ? " class=\"" . $this->getClassAsString() . "\"" : "") .
//       (isset($this->isDisabled()) && $this->isDisabled() ? " disabled" : "") .
      (null !== $this->isDisabled() && $this->isDisabled() ? " disabled" : "") .
      " id=\"" . $this->getId() . "\"" .
//       (isset($this->isMultiple()) && $this->isMultiple() ? " multiple" : "") .
      (null !== $this->isMultiple() && $this->isMultiple() ? " multiple" : "") .
      " name=\"" . $this->getName() . "\"" .
//       (isset($this->isReadOnly()) && $this->isReadOnly() ? " readonly" : "") .
      (null !== $this->isReadOnly() && $this->isReadOnly() ? " readonly" : "") .
      " size=\"" . $this->getSize() . "\"" .
//       (isset($this->getOnClick()) ? " onclick=\"" . $this->getOnClick() . "\"" : "") .
      ("" != $this->getOnClick() ? " onclick=\"" . $this->getOnClick() . "\"" : "") .
      ">\n";
  }
  public function getOnClick() {
    return $this->onClick;
  }
  public function getSize() {
    return $this->size;
  }
  public function isMultiple() {
    return $this->multiple;
  }
  public function isReadOnly() {
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
  public function toString() {
    $output = parent::__toString();
    $output .= ", accessKey = '";
    $output .= $this->accessKey;
    $output .= "', multiple = ";
    $output .= var_export($this->multiple, true);
    $output .= "', onClick = '";
    $output .= $this->onClick;
    $output .= "', readOnly = ";
    $output .= var_export($this->readOnly, true);
    $output .= ", size = ";
    $output .= $this->size;
    return $output;
  }
}
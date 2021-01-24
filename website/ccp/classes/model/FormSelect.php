<?php
namespace ccp\classes\model;
class FormSelect extends FormBase {
  private $accessKey;
  private $multiple;
  private $onClick;
  private $readOnly;
  private $size;
  public function __construct12($debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value) {
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
  public function setAccessKey($accessKey) {
    $this->accessKey = $accessKey;
  }
  public function setMultiple($multiple) {
    $this->multiple = $multiple;
  }
  public function setOnClick($onClick) {
    $this->onClick = $onClick;
  }
  public function setReadOnly($readOnly) {
    $this->readOnly = $readOnly;
  }
  public function setSize($size) {
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
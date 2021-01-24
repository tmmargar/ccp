<?php
namespace ccp\classes\model;
class FormOption extends FormBase {
  private $selectedValue;
  private $text;
  public function __construct9($debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
    parent::__construct7($debug, $class, $disabled, $id, $name, $suffix, $value);
    $this->selectedValue = $selectedValue;
    $this->text = $text;
  }
  public function getHtml() {
    return "<option" .
//       (isset($this->isDisabled()) && $this->isDisabled() ? " disabled" : "") .
      (null !== $this->isDisabled() && $this->isDisabled() ? " disabled" : "") .
      " value=\"" . $this->getValue() . "\"" .
      (isset($this->selectedValue) && ($this->selectedValue == $this->getValue()) ? " selected" : "") .
      ">" .
      htmlentities($this->text, ENT_NOQUOTES, "UTF-8") .
      "</option>\n";
  }
  public function getSelectedValue() {
    return $this->selectedValue;
  }
  public function getText() {
    return $this->text;
  }
  public function setSelctedValue($selectedValue) {
    $this->selectedValue = $selectedValue;
  }
  public function setText($text) {
    $this->text = $text;
  }
  public function toString() {
    $output = parent::__toString();
    $output .= "selectedValue = '";
    $output .= $this->selectedValue;
    $output .= "', text = '";
    $output .= $this->text;
    $output .= "'";
    return $output;
  }
}
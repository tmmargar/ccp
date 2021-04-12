<?php
namespace ccp\classes\model;
class FormOption extends FormBase {
  private string $selectedValue;
  private string $text;
  public function __construct(bool $debug, array $class, bool $disabled, int $id, string $name, string $selectedValue, string|null $suffix, string $text, string $value) {
    parent::__construct($debug, $class, $disabled, $id, $name, $suffix, $value);
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
  public function setSelctedValue(string $selectedValue) {
    $this->selectedValue = $selectedValue;
  }
  public function setText(string $text) {
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
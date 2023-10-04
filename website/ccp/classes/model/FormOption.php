<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class FormOption extends FormBase {
  public function __construct(protected bool $debug, protected array|null $class, protected bool $disabled, protected int|string|null $id, protected string|null $name, protected string|null $selectedValue, protected string|null $suffix, protected string $text, protected array|string|int|null $value) {
    parent::__construct($debug, $class, $disabled, $id, $name, $suffix, $value);
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
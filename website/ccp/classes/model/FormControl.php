<?php
namespace ccp\classes\model;
class FormControl extends FormBase {
  // DO NOT USE FormInput eclipse shows errors even though code runs
  public static $TYPE_INPUT_BUTTON    = "button";
  public static $TYPE_INPUT_CHECKBOX  = "checkbox";
  public static $TYPE_INPUT_EMAIL     = "email";
  public static $TYPE_INPUT_HIDDEN    = "hidden";
  public static $TYPE_INPUT_PASSWORD  = "password";
  public static $TYPE_INPUT_RESET     = "reset";
  public static $TYPE_INPUT_SUBMIT    = "submit";
  public static $TYPE_INPUT_TELEPHONE = "tel";
  public static $TYPE_INPUT_TEXTAREA  = "textarea";
  public static $TYPE_INPUT_TEXTBOX   = "text";
  private $accessKey;
  private $autoComplete;
  private $autoFocus; // boolean
  private $checked; // boolean
  private $cols;
  private $maxLength;
  private $onClick;
  private $placeholder;
  private $readOnly; // boolean
  private $required; // boolean
  private $rows;
  private $size;
  private $type;
  private $wrap;
  public function __construct21($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap) {
    parent::__construct7($debug, $class, $disabled, $id . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $name . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $suffix, $value);
    $this->accessKey = $accessKey;
    $this->autoComplete = $autoComplete;
    $this->autoFocus = $autoFocus;
    $this->checked = $checked;
    $this->cols = $cols;
    $this->maxLength = $maxLength;
    $this->onClick = $onClick;
    $this->placeholder = $placeholder;
    $this->readOnly = $readOnly;
    $this->required = $required;
    $this->rows = $rows;
    $this->size = $size;
    $this->type = $type;
    $this->wrap  = $wrap;
  }
  public function getAccessKey() {
    return $this->accessKey;
  }
  public function getAutoComplete() {
    return $this->autoComplete;
  }
  public function getAutoFocus() {
    return $this->autoFocus;
  }
  public function getCols() {
    return $this->cols;
  }
  public function getHtml() {
//     echo "<br>" . $this->getId() . " -- " . $this->getValue() . " -> " . ("" !== $this->getValue());
//     echo "<br>" . $this->getId() . " -- " . $this->isDisabled() . " -> " . $this->readOnly;
    return (self::$TYPE_INPUT_TEXTAREA == $this->type ? "<textarea" : "<input") .
      (isset($this->accessKey) ? " accesskey=\"" . $this->accessKey . "\"" : "") .
      (isset($this->autoComplete) && $this->autoComplete == true ? " autocomplete=\"" . $this->autoComplete . "\"" : "") .
      (isset($this->autoFocus) && $this->autoFocus ? " autofocus" : "") .
      (isset($this->checked) && $this->checked ? " checked" : "") .
      ("" != $this->getClassAsString() ? " class=\"" . $this->getClassAsString() . "\"" : "") .
      (isset($this->cols) ? " cols=\"" . $this->cols . "\"" : "") .
      (null !== $this->isDisabled() && $this->isDisabled() ? " disabled" : "") .
      " id=\"" . $this->getId() . "\"" .
      (isset($this->maxLength) ? " maxlength=\"" . $this->maxLength . "\"" : "") .
      " name=\"" . $this->getName() . "\"" .
      (isset($this->placeholder) ? " placeholder=\"" . $this->placeholder . "\"" : "") .
      (isset($this->readOnly) && $this->readOnly ? " readonly" : "") .
      (isset($this->required) ? " required=\"" . $this->required . "\"" : "") .
      (isset($this->rows) ? " rows=\"" . $this->rows . "\"" : "") .
      (isset($this->size) ? " size=\"" . $this->size . "\"" : "") .
//       " type=\"" . $this->type . "\"" .
      " type=\"" . (self::$TYPE_INPUT_TELEPHONE == $this->type ? self::$TYPE_INPUT_TEXTBOX : $this->type) . "\"" .
      ("" !== $this->getValue() ? " value=\"" . htmlentities($this->getValue(), ENT_NOQUOTES, "UTF-8") . "\"" : "") .
      (isset($this->wrap) ? " wrap=\"" . $this->wrap . "\"" : "") .
      (isset($this->onClick) ? " onclick=\"" . $this->onClick . "\"" : "") .
//       (self::$TYPE_INPUT_TELEPHONE == $this->type ? " pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" placeholder=\"(999) 999-9999\"" : "") .
      (self::$TYPE_INPUT_TELEPHONE == $this->type ? " data-mask=\"(999) 999-9999\"" : "") .
      (self::$TYPE_INPUT_TEXTAREA == $this->type ? "></textarea>\n" : " />\n");
  }
  public function getMaxLength() {
    return $this->maxLength;
  }
  public function getOnClick() {
    return $this->onClick;
  }
  public function getPlaceholder() {
    return $this->placeholder;
  }
  public function getRows() {
    return $this->rows;
  }
  public function getSize() {
    return $this->size;
  }
  public function getType() {
    return $this->type;
  }
  public function getWrap() {
    return $this->wrap;
  }
  public function isChecked() {
    return $this->checked;
  }
  public function isReadOnly() {
    return $this->readOnly;
  }
  public function isRequired() {
    return $this->required;
  }
  public function setAccessKey($accessKey) {
    $this->accessKey = $accessKey;
  }
  public function setAutoComplete($autoComplete) {
    $this->autoComplete = $autoComplete;
  }
  public function setAutoFocus($autoFocus) {
    $this->autoFocus = $autoFocus;
  }
  public function setChecked($checked) {
    $this->checked = $checked;
  }
  public function setCols($cols) {
    $this->cols = $cols;
  }
  public function setMaxLength($maxLength) {
    $this->maxLength = $maxLength;
  }
  public function setOnClick($onClick) {
    $this->onClick = $onClick;
  }
  public function setPlaceholder($placeholder) {
    $this->placeholder = $placeholder;
  }
  public function setReadOnly($readOnly) {
    $this->readOnly = $readOnly;
  }
  public function setRequired($required) {
    $this->required = $required;
  }
  public function setRows($rows) {
    $this->rows = $rows;
  }
  public function setSize($size) {
    $this->size = $size;
  }
  public function setType($type) {
    $this->type = $type;
  }
  public function setWrap($wrap) {
    $this->wrap = $wrap;
  }
  public function toString() {
    $output = parent::__toString();
    $output .= ", accessKey = '";
    $output .= $this->accessKey;
    $output .= "', autoComplete = '";
    $output .= $this->autoComplete;
    $output .= "', autoFocus = ";
    $output .= var_export($this->autoFocus, true);
    $output .= ", checked = ";
    $output .= var_export($this->checked, true);
    $output .= ", cols = ";
    $output .= $this->cols;
    $output .= ", maxLength = ";
    $output .= $this->maxLength;
    $output .= ", onClick = '";
    $output .= $this->onClick;
    $output .= "', placeholder = '";
    $output .= $this->placeholder;
    $output .= "', readOnly = ";
    $output .= var_export($this->readOnly, true);
    $output .= ", required = ";
    $output .= var_export($this->required, true);
    $output .= ", rows = ";
    $output .= $this->rows;
    $output .= ", size = ";
    $output .= $this->size;
    $output .= ", type = '";
    $output .= $this->type;
    $output .= "', wrap = ";
    $output .= $this->wrap;
    $output .= "'";
    return $output;
  }
}
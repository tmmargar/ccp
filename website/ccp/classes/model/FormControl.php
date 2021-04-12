<?php
namespace ccp\classes\model;
class FormControl extends FormBase {
  // DO NOT USE FormInput eclipse shows errors even though code runs
  public static string $TYPE_INPUT_BUTTON    = "button";
  public static string $TYPE_INPUT_CHECKBOX  = "checkbox";
  public static string $TYPE_INPUT_EMAIL     = "email";
  public static string $TYPE_INPUT_HIDDEN    = "hidden";
  public static string $TYPE_INPUT_PASSWORD  = "password";
  public static string $TYPE_INPUT_RESET     = "reset";
  public static string $TYPE_INPUT_SUBMIT    = "submit";
  public static string $TYPE_INPUT_TELEPHONE = "tel";
  public static string $TYPE_INPUT_TEXTAREA  = "textarea";
  public static string $TYPE_INPUT_TEXTBOX   = "text";
  private string|null $accessKey;
  private string|null $autoComplete;
  private bool $autoFocus; // boolean
  private bool|null $checked; // boolean
  private string|null $cols;
  private string|null $maxLength;
  private string|null $onClick;
  private string|null $placeholder;
  private bool $readOnly; // boolean
  private bool|null $required; // boolean
  private string|null $rows;
  private int|null $size;
  private string|null $type;
  private string|null $wrap;
  public function __construct(bool $debug, string|null $accessKey, string|null $autoComplete, bool $autoFocus, bool|null $checked, array|null $class, string|null $cols, bool $disabled, string|int|null $id, string|null $maxLength, string|null $name, string|null $onClick, string|null $placeholder, bool $readOnly, bool|null $required, string|null $rows, int|null $size, string|null $suffix, string|null $type, string|null $value, string|null $wrap) {
    parent::__construct($debug, $class, $disabled, $id . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $name . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $suffix, $value);
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
  public function setAccessKey(string|null $accessKey) {
    $this->accessKey = $accessKey;
  }
  public function setAutoComplete($autoComplete) {
    $this->autoComplete = $autoComplete;
  }
  public function setAutoFocus(bool $autoFocus) {
    $this->autoFocus = $autoFocus;
  }
  public function setChecked(bool|null $checked) {
    $this->checked = $checked;
  }
  public function setCols(string|null $cols) {
    $this->cols = $cols;
  }
  public function setMaxLength(string|null $maxLength) {
    $this->maxLength = $maxLength;
  }
  public function setOnClick(string|null $onClick) {
    $this->onClick = $onClick;
  }
  public function setPlaceholder(string|null $placeholder) {
    $this->placeholder = $placeholder;
  }
  public function setReadOnly(bool $readOnly) {
    $this->readOnly = $readOnly;
  }
  public function setRequired(bool|null $required) {
    $this->required = $required;
  }
  public function setRows(string|null $rows) {
    $this->rows = $rows;
  }
  public function setSize(int|null $size) {
    $this->size = $size;
  }
  public function setType(string|null $type) {
    $this->type = $type;
  }
  public function setWrap(string|null $wrap) {
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
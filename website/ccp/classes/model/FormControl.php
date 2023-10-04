<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class FormControl extends FormBase {
  // DO NOT USE FormInput eclipse shows errors even though code runs
  public static string $TYPE_INPUT_BUTTON    = "button";
  public static string $TYPE_INPUT_CHECKBOX  = "checkbox";
  public static string $TYPE_INPUT_DATE_TIME = "datetime-local";
  public static string $TYPE_INPUT_EMAIL     = "email";
  public static string $TYPE_INPUT_HIDDEN    = "hidden";
  public static string $TYPE_INPUT_NUMBER    = "number";
  public static string $TYPE_INPUT_PASSWORD  = "password";
  public static string $TYPE_INPUT_RESET     = "reset";
  public static string $TYPE_INPUT_SUBMIT    = "submit";
  public static string $TYPE_INPUT_TELEPHONE = "tel";
  public static string $TYPE_INPUT_TEXTAREA  = "textarea";
  public static string $TYPE_INPUT_TEXTBOX   = "text";
  public function __construct(protected bool $debug, protected string|null $accessKey, protected string|null $autoComplete, protected bool $autoFocus, protected bool|null $checked, protected array|null $class, protected int|null $cols, protected bool $disabled, protected string|int|null $id, protected int|null $maxLength, protected string|null $name, protected string|null $onClick, protected string|null $placeholder, protected bool $readOnly, protected bool|null $required, protected int|null $rows, protected int|null $size, protected string|null $suffix, protected string|null $type, protected array|string|int|null $value, protected string|null $wrap, protected string|null $import = null, protected bool|null $noValidate = false) {
    parent::__construct($debug, $class, $disabled, $id . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $name . (self::$TYPE_INPUT_RESET == $type ? "Button" : ""), $suffix, $value);
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
    $temp = "";
    if (isset($this->onClick)) {
      $temp =
        "<script type=\"module\">\n" .
        "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
        $this->import .
        "  document.querySelector(\"#" . $this->getId() . "\").addEventListener(\"click\", (evt) => { " . $this->onClick . " });\n" .
        "</script>\n";
    }
    return $temp .
      (self::$TYPE_INPUT_TEXTAREA == $this->type ? "<textarea" : (self::$TYPE_INPUT_BUTTON == $this->type || self::$TYPE_INPUT_SUBMIT == $this->type || self::$TYPE_INPUT_RESET == $this->type ? "<button" : "<input")) .
      (isset($this->accessKey) ? " accesskey=\"" . $this->accessKey . "\"" : "") .
      (isset($this->autoComplete) ? " autocomplete=\"" . $this->autoComplete . "\"" : "") .
      (isset($this->autoFocus) && $this->autoFocus ? " autofocus" : "") .
      (isset($this->checked) && $this->checked ? " checked" : "") .
      ("" != $this->getClassAsString() ? " class=\"" . $this->getClassAsString() . "\"" : "") .
      (isset($this->cols) ? " cols=\"" . $this->cols . "\"" : "") .
//       data-mask-clearifnotmatch=\"true\"
//       (self::$TYPE_INPUT_TELEPHONE == $this->type ? " data-inputmask=\"'mask': '(000) 000-0000'\"" : "") .
      (null !== $this->isDisabled() && $this->isDisabled() ? " disabled" : "") .
      (isset($this->onClick) ? " href=\"#\"" : "") .
      " id=\"" . $this->getId() . "\"" .
      (isset($this->maxLength) ? " maxlength=\"" . $this->maxLength . "\"" : "") .
      " name=\"" . $this->getName() . "\"" .
//       (self::$TYPE_INPUT_TELEPHONE == $this->type ? " pattern=\"[\(]\d{3}[\)] \d{3}[\-]\d{4}\"" : "") .
//       (isset($this->placeholder) ? " placeholder=\"" . $this->placeholder . "\"" : (self::$TYPE_INPUT_TELEPHONE == $this->type ? " placeholder=\"(999) 999-9999\"" : "")) .
      (isset($this->readOnly) && $this->readOnly ? " readonly" : "") .
//       (isset($this->required) ? " required=\"" . $this->required . "\"" : "") .
      ($this->required ? " required" : "") .
      (isset($this->rows) ? " rows=\"" . $this->rows . "\"" : "") .
      (isset($this->size) ? " size=\"" . $this->size . "\"" : "") .
      " type=\"" . ((self::$TYPE_INPUT_RESET == $this->type) ? self::$TYPE_INPUT_BUTTON : $this->type) . "\"" .
//     " type=\"" . (self::$TYPE_INPUT_TELEPHONE == $this->type ? self::$TYPE_INPUT_TELEPHONE : $this->type) . "\"" .
    (self::$TYPE_INPUT_BUTTON !== $this->type && null !== $this->getValue() ? " value=\"" . htmlentities((string) $this->getValue(), ENT_NOQUOTES, "UTF-8") . "\"" : "") .
      (isset($this->wrap) ? " wrap=\"" . $this->wrap . "\"" : "") .
//       (isset($this->onClick) ? " onclick=\"" . $this->onClick . "\"" : "") .
      (self::$TYPE_INPUT_BUTTON == $this->type || self::$TYPE_INPUT_SUBMIT == $this->type || self::$TYPE_INPUT_RESET == $this->type || self::$TYPE_INPUT_HIDDEN == $this->type || self::$TYPE_INPUT_CHECKBOX == $this->type ? "" : " onfocus=\"this.select();\"") .
//       (self::$TYPE_INPUT_TELEPHONE == $this->type ? " pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" placeholder=\"(999) 999-9999\"" : "") .
//       (self::$TYPE_INPUT_TELEPHONE == $this->type ? " data-mask=\"1 (000) 000-0000\"" : "") .
    (self::$TYPE_INPUT_TEXTAREA == $this->type ? ">" . $this->getValue() . "</textarea>\n" :
      (self::$TYPE_INPUT_DATE_TIME == $this->type ? ">" :
      (self::$TYPE_INPUT_RESET == $this->type || $this->noValidate ? " formnovalidate>" . $this->getValue() . "</button>" :
      (self::$TYPE_INPUT_BUTTON == $this->type || self::$TYPE_INPUT_SUBMIT == $this->type ? ">" . $this->getValue() . "</button>" : " />\n"))));
  }
  public function getImport() {
    return $this->import;
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
  public function isNoValidate() {
    return $this->noValidate;
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
  public function setCols(int|null $cols) {
    $this->cols = $cols;
  }
  public function setImport(string|null $import) {
    $this->import = $import;
  }
  public function setMaxLength(int|null $maxLength) {
    $this->maxLength = $maxLength;
  }
  public function setNoValidate(bool|null $noValidate) {
    $this->noValidate = $noValidate;
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
  public function setRows(int|null $rows) {
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
    $output .= ", import = '";
    $output .= $this->import;
    $output .= "', maxLength = ";
    $output .= $this->maxLength;
    $output .= ", noValidate = ";
    $output .= $this->noValidate;
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
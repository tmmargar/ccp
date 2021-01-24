<?php
namespace ccp\classes\model;
class HtmlLink extends HtmlBase {
  private $href;
  private $paramName; // array of names
  private $paramValue; // aray of values
  private $text;
  public function __construct10($accessKey, $class, $debug, $href, $id, $paramName, $paramValue, $tabIndex, $text, $title) {
    parent::__construct6($accessKey, $class, $debug, $id, $tabIndex, $title);
    $this->href = $href;
    $this->paramName = $paramName;
    $this->paramValue = $paramValue;
    $this->text = $text;
  }
  private function getParamString() {
    $output = "";
    if (isset($this->paramName) && isset($this->paramValue)) {
      $counter = 0;
      foreach($this->paramName as $paramName) {
        $output .= ($counter == 0 ? "?" : "&") . $paramName . "=" . $this->paramValue[$counter];
        $counter++;
      }
    }
    return $output;
  }
  public function getHtml() {
    return
      "<a" .
      ("" == $this->getClassAsString() ? "" : " class=\"" . $this->getClassAsString() . "\"") .
      (isset($this->href) ? " href=\"" . $this->href . "" : "") .
      (isset($this->mode) ? "?mode=" . $this->mode : "") .
      $this->getParamString() .
      "\"" .
      (null == $this->getId() ? "" : " id=\"" . $this->getId() . "\"") .
      (null == $this->getTabIndex() ? "" : " tabindex=\"" . $this->getTabIndex() . "\"") .
      (null == $this->getTitle() ? "" : " title=\"" . $this->getTitle() . "\"") .
      ">" . $this->text . "</a>";
  }
  public function getHref() {
    return $this->href;
  }
  public function getParamName() {
    return $this->paramName;
  }
  public function getParamValue() {
    return $this->paramValue;
  }
  public function getText() {
    return $this->text;
  }
  public function setHref($href) {
    $this->href = $href;
  }
  public function setParamName($paramName) {
    $this->paramName = $paramName;
  }
  public function setParamValue($paramValue) {
    $this->paramValue = $paramValue;
  }
  public function setText($text) {
    $this->text = $text;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", href = '";
    $output .= $this->href;
    $output .= "', paramName = '";
    $output .= $this->paramName;
    $output .= "', paramValue = '";
    $output .= $this->paramValue;
    $output .= "', text = '";
    $output .= $this->text;
    $output .= "'";
    return $output;
  }
}
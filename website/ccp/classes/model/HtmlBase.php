<?php
namespace ccp\classes\model;
abstract class HtmlBase extends Base {
  private $accessKey;
  private $class; // array of class names
  private $tabIndex;
  private $title;

  public function __construct6($accessKey, $class, $debug, $id, $tabIndex, $title) {
    parent::__construct2($debug, $id);
    $this->accessKey = $accessKey;
    $this->class = $class;
    $this->tabIndex = $tabIndex;
    $this->title = $title;
  }
  public function getAccessKey() {
    return $this->accessKey;
  }
  public function getClass() {
    return $this->class;
  }
  public function getClassAsString() {
    return is_array($this->class) ? implode(" ", array_filter($this->class)) : "";
  }
  public function getTabIndex() {
    return $this->tabIndex;
  }
  public function getTitle() {
    return $this->title;
  }
  public function setAccessKey($acccessKey) {
    $this->accessKey = $acccessKey;
  }
  public function setClass(array $class) {
    $this->class = $class;
  }
  public function setTabIndex($tabIndex) {
    $this->tabIndex = $tabIndex;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", accessKey = '";
    $output .= $this->accessKey;
    $output .= "', class = ";
    $output .= print_r($this->class, true);
    $output .= ", tabIndex = ";
    $output .= $this->tabIndex;
    $output .= ", title = '";
    $output .= $this->title;
    $output .= "'";
    return $output;
  }
}
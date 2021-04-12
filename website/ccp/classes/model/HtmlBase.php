<?php
namespace ccp\classes\model;
abstract class HtmlBase extends Base {
  private string|null $accessKey;
  private array|null $class; // array of class names
  private int $tabIndex;
  private string|null $title;

  public function __construct(string|null $accessKey, array|null $class, bool $debug, string|int|null $id, int $tabIndex, string|null $title) {
    parent::__construct($debug, $id);
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
  public function setAccessKey(string $acccessKey) {
    $this->accessKey = $acccessKey;
  }
  public function setClass(array $class) {
    $this->class = $class;
  }
  public function setTabIndex(int $tabIndex) {
    $this->tabIndex = $tabIndex;
  }
  public function setTitle(string $title) {
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
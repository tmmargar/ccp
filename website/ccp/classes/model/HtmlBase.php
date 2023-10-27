<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class HtmlBase extends Base {
  public function __construct(protected string|null $accessKey, protected array|null $class, protected bool $debug, protected string|int|null $id, protected int $tabIndex, protected string|null $title) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getAccessKey() {
    return $this->accessKey;
  }
  public function getClass() {
    return $this->class;
  }
  public function getClassAsString() {
    return is_array($this->class) ? implode(separator: " ", array: array_filter($this->class)) : "";
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
    $output .= print_r(value: $this->class, return: true);
    $output .= ", tabIndex = ";
    $output .= $this->tabIndex;
    $output .= ", title = '";
    $output .= $this->title;
    $output .= "'";
    return $output;
  }
}
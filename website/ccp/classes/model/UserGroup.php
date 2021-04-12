<?php
namespace ccp\classes\model;
class UserGroup extends Base {
  private string $title;
  public function getTitle() {
    return $this->title;
  }
  public function setTitle(string $title) {
    $this->title = $title;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", title = '";
    $output .= $this->title;
    $output .= "'";
    return $output;
  }
}
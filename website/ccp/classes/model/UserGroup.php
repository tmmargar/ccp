<?php
namespace ccp\classes\model;
// include_once ROOT . "/autoload.php";
class UserGroup extends Base {
  private $title;
  public function getTitle() {
    return $this->title;
  }
  public function setTitle($title) {
    $this->title = $title;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", title = '";
    $output .= $this->getTitle();
    $output .= "'";
    return $output;
  }
}
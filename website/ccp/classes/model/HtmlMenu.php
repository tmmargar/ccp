<?php
namespace ccp\classes\model;
use ccp\classes\utility\SessionUtility;

class HtmlMenu extends HtmlBase {
  private $items; // array of HtmlLink or HtmlMenu
  private $text;
  public function __construct4($debug, $items, $id, $text) {
    parent::__construct2($debug, $id);
    $this->items = $items;
    $this->text = $text;
  }
  public function getHtmlRoot() {
    //$output = "<ul class=\"drop-nav\" id=\"drop-nav\">\n";
    $output = "<div id=\"leftContent\">";
    $output .= " <nav id=\"main-nav\">\n";
    $output .= "  <ul class=\"sm sm-vertical sm-blue\" id=\"main-menu\">\n";
    $output .= $this->getHtml(true, 2);
    $output .= "  </ul>\n";
    $output .= " </nav>\n";
    $output .= " <div id=\"seasonInfo\">\n";
    $output .= "<strong>Season Info</strong>\n";
    $output .= SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDisplayFormat();
    $output .= "<br />|<br />\n";
    $output .= SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDisplayFormat();
    $output .= " </div>\n";
    $output .= "</div>\n";
    return $output;
  }
  public function getHtml($parent, $counter) {
    $output = "";
    foreach ($this->items as $item) { // $menu is HtmlLink or HtmlMenu object
      if (get_class($item) == "ccp\classes\model\HtmlLink") {
        $output .= str_repeat(" ", $counter) . "<li>" . $item->getHtml() . "</li>\n";
      } else {
        //$output .= $parent ? str_repeat(" ", $counter) . "<li>\n" : "";
        $output .= $parent ? str_repeat(" ", $counter) . "<li>\n" : "<li>\n";
//         $output .= str_repeat(" ", $counter + 1) . "<a>" . $item->getText() . " &#9662;</a>\n";
//         $output .= str_repeat(" ", $counter + 1) . "<ul class=\"submenu\">\n";
//         $output .= str_repeat(" ", $counter + 2) . $item->getHtml(false, $counter + 2);
//         $output .= str_repeat(" ", $counter + 1) . "</ul>\n";
        // use anchor so cursor is hand (work around for now)
        $output .= str_repeat(" ", $counter + 2) . "<a href=\"#\">" . $item->getText() . "</a>\n";
        $output .= str_repeat(" ", $counter + 2) . "<ul>\n";
        $output .= str_repeat(" ", $counter + 3) . $item->getHtml(false, $counter + 3);
        $output .= str_repeat(" ", $counter + 2) . "</ul>\n";
        $output .= str_repeat(" ", $counter) . "</li>\n";
      }
    }
    return $output;
  }
  public function getItems() {
    return $this->items;
  }
  public function getText() {
    return $this->text;
  }
  public function setItems(array $items) {
    $this->items = $items;
  }
  public function setText($text) {
    $this->text = $text;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", items = ";
    $output .= print_r($this->items, true);
    $output .= ", text = '";
    $output .= $this->text;
    $output .= "'";
    return $output;
  }
}
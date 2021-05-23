<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use ccp\classes\utility\SessionUtility;
class HtmlMenu extends HtmlBase {
  public function __construct(protected bool $debug, protected string|int|null $id, protected array|null $items, protected string|null $text) {
    parent::__construct(null, null, $debug, $id, 0, null);
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
    $output .= "<strong>Season Info</strong>\n<br />\n";
    if ("" == SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)) {
      $output .= "None";
    } else {
      $output .= SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDisplayFormat();
      $output .= "<br />|<br />\n";
      $output .= SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDisplayFormat();
      $output .= "<br />|<br />\n";
      $output .= SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY) . " to qualify";
    }
    $output .= " </div>\n";
    $output .= "</div>\n";
    return $output;
  }
  public function getHtml(bool $parent, int $counter) {
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
  public function setText(string $text) {
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
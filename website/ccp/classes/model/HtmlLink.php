<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class HtmlLink extends HtmlBase {
  public function __construct(protected string|null $accessKey, protected array|null $class, protected bool $debug, protected string $href, protected string|int|null $id,
    protected array|null $paramName, protected array|null $paramValue, protected int $tabIndex, protected string $text, protected string|null $title) {
    parent::__construct(accessKey: $accessKey, class: $class, debug: $debug, id: $id, tabIndex: $tabIndex, title: $title);
  }
  private function getParamString(): string {
    $output = "";
    if (isset($this->paramName) && isset($this->paramValue)) {
      $counter = 0;
      foreach ($this->paramName as $paramName) {
        $output .= ($counter == 0 ? "?" : "&") . $paramName . "=" . $this->paramValue[$counter];
        $counter ++;
      }
    }
    return $output;
  }
  public function getHtml(): string {
    return "<a" . ("" == $this->getClassAsString() ? "" : " class=\"" . $this->getClassAsString() . "\"") . (isset($this->href) ? " href=\"" . $this->href . "" : "") .
      (isset($this->mode) ? "?mode=" . $this->mode : "") . $this->getParamString() . "\"" . (null == $this->getId() ? "" : " id=\"" . $this->getId() . "\"") .
      (null == $this->getTabIndex() ? "" : " tabindex=\"" . $this->getTabIndex() . "\"") . (null == $this->getTitle() ? "" : " title=\"" . $this->getTitle() . "\"") . ">" . $this->text . "</a>";
  }
  public function getHref(): string {
    return $this->href;
  }
  public function getParamName(): array|null {
    return $this->paramName;
  }
  public function getParamValue(): array|null {
    return $this->paramValue;
  }
  public function getText(): string {
    return $this->text;
  }
  public function setHref(string $href) {
    $this->href = $href;
  }
  public function setParamName(array $paramName) {
    $this->paramName = $paramName;
  }
  public function setParamValue(array $paramValue) {
    $this->paramValue = $paramValue;
  }
  public function setText(string $text) {
    $this->text = $text;
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= ", href = '";
    $output .= $this->href;
    $output .= "', paramName = ";
    $output .= print_r(value: $this->paramName, return: true);
    $output .= ", paramValue = ";
    $output .= print_r(value: $this->paramValue, return: true);
    $output .= ", text = '";
    $output .= $this->text;
    $output .= "'";
    return $output;
  }
}
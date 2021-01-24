<?php
namespace ccp\classes\model;
class Location extends Base {
  private $name;
  private $user; // user object
  private $count; // total tournaments hosted
  private $active;
  private $map; // blob map pdf
  private $mapName; // name of file
  public function buildMapUrl() {
    return "<a href =\"" . Constant::PATH_MAP() . "/" . $this->getMapName() . "\">Map</a>\n";
  }
  public function getName() {
    return $this->name;
  }
  public function getUser() {
    return $this->user;
  }
  public function getCount() {
    return $this->count;
  }
  public function getActive() {
    return $this->active;
  }
  public function getMap() {
    return $this->map;
  }
  public function getMapName() {
    return $this->mapName;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function setCount($count) {
    $this->count = $count;
  }
  public function setActive($active) {
//     if (Constant::$FLAG_YES == $active || Constant::$FLAG_NO == $active) {
      $this->active = $active;
//     } else {
//       throw new Exception($active . " is not a valid active");
//     }
  }
  public function setMap($map) {
    $this->map = $map;
  }
  public function setMapName($mapName) {
    $this->mapName = $mapName;
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageLocation.php", "modify", $this->getId(), $this->getName());
    $link = new HtmlLink(null, null, $this->isDebug(), "manageLocation.php", null, array("userId", "mode"),  array($this->getId(). "modify"), -1, $this->getName(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->getName();
    $output .= "', user = [";
    $output .= $this->getUser()->__toString();
    $output .= "], count = ";
    $output .= $this->getCount();
    $output .= ", active = ";
    $output .= var_export($this->getActive(), true);
    $output .= ", map = '";
    $output .= $this->getMap();
    $output .= "', mapName = '";
    $output .= $this->getMapName();
    $output .= "'";
    return $output;
  }
}
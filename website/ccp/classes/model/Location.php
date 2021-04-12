<?php
namespace ccp\classes\model;
class Location extends Base {
  private string $name;
  private User $user; // user object
  private int $count; // total tournaments hosted
  private int $active;
  private $map; // blob map pdf
  private string $mapName; // name of file
  private int $tournamentCount; // # of tournaments
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
  public function getTournamentCount() {
    return $this->tournamentCount;
  }
  public function setName(string $name) {
    $this->name = $name;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function setCount(int $count) {
    $this->count = $count;
  }
  public function setActive(int $active) {
    $this->active = $active;
  }
  public function setMap($map) {
    $this->map = $map;
  }
  public function setMapName(string $mapName) {
    $this->mapName = $mapName;
  }
  public function setTournamentCount(int $tournamentCount) {
    $this->tournamentCount = $tournamentCount;
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageLocation.php", "modify", $this->getId(), $this->getName());
    $link = new HtmlLink(null, null, $this->isDebug(), "manageLocation.php", null, array("userId", "mode"),  array($this->getId(). "modify"), -1, $this->getName(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", name = '";
    $output .= $this->name;
    $output .= "', user = [";
    $output .= $this->user;
    $output .= "], count = ";
    $output .= $this->count;
    $output .= ", active = ";
    $output .= var_export($this->active, true);
    $output .= ", map = '";
    $output .= $this->map;
    $output .= "', mapName = '";
    $output .= $this->mapName;
    $output .= "', tournamentCount = ";
    $output .= $this->tournamentCount;
    return $output;
  }
}
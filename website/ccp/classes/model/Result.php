<?php
namespace ccp\classes\model;
class Result extends Base {
  private Tournament $tournament; // tournament object
  private User $user; // user object
  private Status $status; // status object
  private int $registerOrder; // number
  private bool $buyinPaid = false;
  private bool $rebuyPaid = false;
  private bool $addonPaid = false;
  private int $rebuyCount; // number
  private bool $addonFlag = false;
  private int $place; // number
  private User $knockedOutBy; // user object
  private string $food;
  public function getTournament() {
    return $this->tournament;
  }
  public function getUser() {
    return $this->user;
  }
  public function getStatus() {
    return $this->status;
  }
  public function getRegisterOrder() {
    return $this->registerOrder;
  }
  public function isBuyinPaid() {
    return $this->buyinPaid;
  }
  public function isRebuyPaid() {
    return $this->rebuyPaid;
  }
  public function isAddonPaid() {
    return $this->addonPaid;
  }
  public function getRebuyCount() {
    return $this->rebuyCount;
  }
  public function isAddonFlag() {
    return $this->addonFlag;
  }
  public function getPlace() {
    return $this->place;
  }
  public function getKnockedOutBy() {
    return $this->knockedOutBy;
  }
  public function getFood() {
    return $this->food;
  }
  public function setTournament(Tournament $tournament) {
    $this->tournament = $tournament;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function setStatus(Status $status) {
    $this->status = $status;
  }
  public function setRegisterOrder(int $registerOrder) {
    $this->registerOrder = $registerOrder;
  }
  public function setBuyinPaid(bool $buyinPaid) {
    $this->buyinPaid = $buyinPaid;
  }
  public function setRebuyPaid(bool $rebuyPaid) {
    $this->rebuyPaid = $rebuyPaid;
  }
  public function setAddonPaid(bool $addonPaid) {
    $this->addonPaid = $addonPaid;
  }
  public function setRebuyCount(int $rebuyCount) {
    $this->rebuyCount = $rebuyCount;
  }
  public function setAddonFlag(bool $addonFlag) {
    $this->addonFlag = $addonFlag;
  }
  public function setPlace(int $place) {
    $this->place = $place;
  }
  public function setKnockedOutBy(User $knockedOutBy) {
    $this->knockedOutBy = $knockedOutBy;
  }
  public function setFood(string $food) {
    $this->food = $food;
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageResult.php", "modify", $this->getId(), $this->getTournament()->getDescription());
    $link = new HtmlLink(null, null, $this->isDebug(), "manageResult.php", null, array("id", "mode"),  array($this->getId(). "modify"), -1, $this->getTournament()->getDescription(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= "tournament = [";
    $output .= $this->tournament;
    $output .= "], user = [";
    $output .= $this->user;
    $output .= "], status = [";
    $output .= $this->status;
    $output .= "], registerOrder = ";
    $output .= $this->registerOrder;
    $output .= ", buyinPaid = ";
    $output .= var_export($this->buyinPaid, true);
    $output .= ", rebuyPaid = ";
    $output .= var_export($this->eebuyPaid, true);
    $output .= ", addonPaid = ";
    $output .= var_export($this->addonPaid, true);
    $output .= ", rebuyCount = ";
    $output .= $this->rebuyCount;
    $output .= ", addonFlag = ";
    $output .= var_export($this->addonFlag, true);
    $output .= ", place = ";
    $output .= $this->place;
    $output .= ", knockedOutBy = [";
    $output .= $this->knockedOutBy;
    $output .= "], food = '";
    $output .= $this->food;
    $output .= "'";
    return $output;
  }
}
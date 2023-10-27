<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Result extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected Tournament $tournament, protected User $user, protected Status $status, protected int $registerOrder, protected bool $buyinPaid, protected bool $rebuyPaid, protected bool $addonPaid, protected int $rebuyCount, protected bool $addonFlag, protected int $place, protected User $knockedOutBy, protected string|null $food, protected string|null $feeStatus) {
    parent::__construct(debug: $debug, id: $id);
  }
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
  public function getFeeStatus() {
    return $this->feeStatus;
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
  public function setFeeStatus(string $feeStatus) {
    $this->feeStatus = $feeStatus;
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageResult.php", "modify", $this->getId(), $this->getTournament()->getDescription());
    $link = new HtmlLink(accessKey: null, class: null, debug: $this->isDebug(), href: "manageResult.php", id: null, paramName: array("id", "mode"), paramValue: array($this->getId(). "modify"), tabIndex: -1, text: $this->getTournament()->getDescription(), title: null);
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
    $output .= var_export(value: $this->buyinPaid, return: true);
    $output .= ", rebuyPaid = ";
    $output .= var_export(value: $this->rebuyPaid, return: true);
    $output .= ", addonPaid = ";
    $output .= var_export(value: $this->addonPaid, return: true);
    $output .= ", rebuyCount = ";
    $output .= $this->rebuyCount;
    $output .= ", addonFlag = ";
    $output .= var_export(value: $this->addonFlag, return: true);
    $output .= ", place = ";
    $output .= $this->place;
    $output .= ", knockedOutBy = [";
    $output .= $this->knockedOutBy;
    $output .= "], food = '";
    $output .= $this->food;
    $output .= "', feeStatus = '";
    $output .= $this->feeStatus;
    $output .= "'";
    return $output;
  }
}
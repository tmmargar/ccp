<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class Result extends Base {
  private $tournament; // tournament object
  private $user; // user object
  private $status; // status object
  private $registerOrder; // number
  private $buyinPaid = false;
  private $rebuyPaid = false;
  private $addonPaid = false;
  private $rebuyCount; // number
  private $addonFlag = false;
  private $place; // number
  private $knockedOutBy; // user object
  private $food;
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
  public function setRegisterOrder($registerOrder) {
    if (is_int($registerOrder)) {
      $this->registerOrder = $registerOrder;
    } else {
      throw new Exception($registerOrder . " is not a valid register order");
    }
  }
  public function setBuyinPaid($buyinPaid) {
    if (is_bool($buyinPaid)) {
      $this->buyinPaid = $buyinPaid;
    } else {
      throw new Exception($buyinPaid . " is not a valid buyin paid");
    }
  }
  public function setRebuyPaid($rebuyPaid) {
    if (is_bool($rebuyPaid)) {
      $this->rebuyPaid = $rebuyPaid;
    } else {
      throw new Exception($rebuyPaid . " is not a valid rebuy paid");
    }
  }
  public function setAddonPaid($addonPaid) {
    if (is_bool($addonPaid)) {
      $this->addonPaid = $addonPaid;
    } else {
      throw new Exception($addonPaid . " is not a valid addon paid");
    }
  }
  public function setRebuyCount($rebuyCount) {
    if (is_int($rebuyCount)) {
      $this->rebuyCount = $rebuyCount;
    } else {
      throw new Exception($rebuyCount . " is not a valid rebuy count");
    }
  }
  public function setAddonFlag($addonFlag) {
    if (is_bool($addonFlag)) {
      $this->addonFlag = $addonFlag;
    } else {
      throw new Exception($addonFlag . " is not a valid addon flag");
    }
  }
  public function setPlace($place) {
    if (is_int($place)) {
      $this->place = $place;
    } else {
      throw new Exception($place . " is not a valid place");
    }
  }
  public function setKnockedOutBy(User $knockedOutBy) {
    $this->knockedOutBy = $knockedOutBy;
  }
  public function setFood($food) {
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
    $output .= $this->getTournament()->__toString();
    $output .= "], user = [";
    $output .= $this->getUser()->__toString();
    $output .= "], status = [";
    $output .= $this->getStatus()->__toString();
    $output .= "], registerOrder = ";
    $output .= $this->getRegisterOrder();
    $output .= ", buyinPaid = ";
    $output .= var_export($this->isBuyinPaid(), true);
    $output .= ", rebuyPaid = ";
    $output .= var_export($this->isRebuyPaid(), true);
    $output .= ", addonPaid = ";
    $output .= var_export($this->isAddonPaid(), true);
    $output .= ", rebuyCount = ";
    $output .= $this->getRebuyCount();
    $output .= ", addonFlag = ";
    $output .= var_export($this->isAddonFlag(), true);
    $output .= ", place = ";
    $output .= $this->getPlace();
    $output .= ", knockedOutBy = [";
    $output .= $this->getKnockedOutBy()->__toString();
    $output .= "], food = '";
    $output .= $this->getFood();
    $output .= "'";
    return $output;
  }
}
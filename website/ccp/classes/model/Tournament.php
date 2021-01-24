<?php
namespace ccp\classes\model;
use Exception;
// include_once ROOT . "/autoload.php";
class Tournament extends Base {
  private $description;
  private $comment;
  private $limitType; // limit type object
  private $gameType; // game type object
  private $specialType; // special type object
  private $chipCount;
  private $location; // location object
  private $date; // DateTime object
  private $startTime; // DateTime object
  private $endTime; // DateTime object
  private $buyinAmount; // number not currency
  private $maxPlayers; // number
  private $maxRebuys; // number
  private $rebuyAmount; // number not currency
  private $addonAmount; // number not currency
  private $addonChipCount; // number
  private $groupPayout; // group payout object
  private $rake; // number not currency
  private $registeredCount; // number
  private $buyinsPaid; // number
  private $rebuysPaid; // number
  private $rebuysCount; // number
  private $addonsPaid; // number
  private $enteredCount; // number
  public function getDescription() {
    return $this->description;
  }
  public function getComment() {
    return $this->comment;
  }
  public function getLimitType() {
    return $this->limitType;
  }
  public function getGameType() {
    return $this->gameType;
  }
  public function getSpecialType() {
    return $this->specialType;
  }
  public function getChipCount() {
    return $this->chipCount;
  }
  public function getLocation() {
    return $this->location;
  }
  public function getDate() {
    return $this->date;
  }
  public function getStartTime() {
    return $this->startTime;
  }
  public function getEndTime() {
    return $this->endTime;
  }
  public function getBuyinAmount() {
    return $this->buyinAmount;
  }
  public function getMaxPlayers() {
    return $this->maxPlayers;
  }
  public function getMaxRebuys() {
    return $this->maxRebuys;
  }
  public function getRebuyAmount() {
    return $this->rebuyAmount;
  }
  public function getAddonAmount() {
    return $this->addonAmount;
  }
  public function getAddonChipCount() {
    return $this->addonChipCount;
  }
  public function getGroupPayout() {
    return $this->groupPayout;
  }
  public function getRake() {
    return $this->rake;
  }
  public function getRakeForCalculation() {
    return $this->rake / 100;
  }
  public function getRegistrationClose() {
    $close = "";
    if (isset($this->startTime)) {
      $close = clone $this->startTime;
      $interval = new \DateInterval("PT2H"); // 2 hours
      $close->getTime()->sub($interval);
    }
    return $close;
  }
  public function getRegisteredCount() {
    return $this->registeredCount;
  }
  public function getBuyinsPaid() {
    return $this->buyinsPaid;
  }
  public function getRebuysPaid() {
    return $this->rebuysPaid;
  }
  public function getRebuysCount() {
    return $this->rebuysCount;
  }
  public function getAddonsPaid() {
    return $this->addonsPaid;
  }
  public function getEnteredCount() {
    return $this->enteredCount;
  }
  public function setDescription($description) {
    $this->description = $description;
  }
  public function setComment($comment) {
    $this->comment = $comment;
  }
  public function setLimitType(LimitType $limitType) {
    $this->limitType = $limitType;
  }
  public function setGameType(GameType $gameType) {
    $this->gameType = $gameType;
  }
  public function setSpecialType(SpecialType $specialType) {
    $this->specialType = $specialType;
  }
  public function setChipCount($chipCount) {
    if (is_int($chipCount)) {
      $this->chipCount = $chipCount;
    } else {
      throw new Exception($chipCount . " is not a valid chip count");
    }
  }
  public function setLocation(Location $location) {
    $this->location = $location;
  }
  public function setDate(DateTime $date) {
    $this->date = $date;
  }
  public function setStartTime(DateTime $startTime) {
    $this->startTime = $startTime;
  }
  public function setEndTime(DateTime $endTime) {
    $this->endTime = $endTime;
  }
  public function setBuyinAmount($buyinAmount) {
    if (is_int($buyinAmount)) {
      $this->buyinAmount = $buyinAmount;
    } else {
      throw new Exception($buyinAmount . " is not a valid buyin amount");
    }
  }
  public function setMaxPlayers($maxPlayers) {
    if (is_int($maxPlayers)) {
      $this->maxPlayers = $maxPlayers;
    } else {
      throw new Exception($maxPlayers . " is not a valid number of players");
    }
  }
  public function setMaxRebuys($maxRebuys) {
    if (is_int($maxRebuys)) {
      $this->maxRebuys = $maxRebuys;
    } else {
      throw new Exception($maxRebuys . " is not a valid number of rebuys");
    }
  }
  public function setRebuyAmount($rebuyAmount) {
    if (is_int($rebuyAmount)) {
      $this->rebuyAmount = $rebuyAmount;
    } else {
      throw new Exception($rebuyAmount . " is not a valid rebuy amount");
    }
  }
  public function setAddonAmount($addonAmount) {
    if (is_int($addonAmount)) {
      $this->addonAmount = $addonAmount;
    } else {
      throw new Exception($addonAmount . " is not a valid addon amount");
    }
  }
  public function setAddonChipCount($addonChipCount) {
    if (is_int($addonChipCount)) {
      $this->addonChipCount = $addonChipCount;
    } else {
      throw new Exception($addonChipCount . " is not a valid addon chip count");
    }
  }
  public function setGroupPayout(GroupPayout $groupPayout) {
    $this->groupPayout = $groupPayout;
  }
  public function setRake($rake) {
    if (is_float($rake)) {
      $this->rake = $rake;
    } else {
      throw new Exception($rake . " is not a valid rake");
    }
  }
  public function setRegisteredCount($registeredCount) {
    if (is_int($registeredCount)) {
      $this->registeredCount = $registeredCount;
    } else {
      throw new Exception($registeredCount . " is not a valid registered count");
    }
  }
  public function setEnteredCount($enteredCount) {
    if (is_int($enteredCount)) {
      $this->enteredCount = $enteredCount;
    } else {
      throw new Exception($enteredCount . " is not a valid entered count");
    }
  }
  public function setBuyinsPaid($buyinsPaid) {
    if (is_int($buyinsPaid)) {
      $this->buyinsPaid = $buyinsPaid;
    } else {
      throw new Exception($buyinsPaid . " is not a valid buyins paid");
    }
  }
  public function setRebuysPaid($rebuysPaid) {
    if (is_int($rebuysPaid)) {
      $this->rebuysPaid = $rebuysPaid;
    } else {
      throw new Exception($rebuysPaid . " is not a valid rebuys paid");
    }
  }
  public function setRebuysCount($rebuysCount) {
    if (is_int($rebuysCount)) {
      $this->rebuysCount = $rebuysCount;
    } else {
      throw new Exception($rebuysCount . " is not a valid rebuys count");
    }
  }
  public function setAddonsPaid($addonsPaid) {
    if (is_int($addonsPaid)) {
      $this->addonsPaid = $addonsPaid;
    } else {
      throw new Exception($addonsPaid . " is not a valid addons paid");
    }
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageTournament.php", "modify", $this->getId(), $this->getDescription());
    $link = new HtmlLink(null, null, $this->isDebug(), "manageTournament.php", null, array("id", "mode"),  array($this->getId(). "modify"), -1, $this->getDescription(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", description = '";
    $output .= $this->getDescription();
    $output .= "', comment = '";
    $output .= $this->getComment();
    $output .= "', limitType = [";
    $output .= $this->getLimitType()->__toString();
    $output .= "], gameType = [";
    $output .= $this->getGameType()->__toString();
    $output .= "], specialType = [";
    $output .= $this->getSpecialType()->__toString();
    $output .= "], chipCount = ";
    $output .= $this->getChipCount();
    $output .= ", location = [";
    $output .= $this->getLocation()->__toString();
    $output .= "], date = ";
    $output .= $this->getDate()->getDisplayFormat();
    $output .= ", startTime = ";
    $output .= $this->getStartTime()->getDisplayAmPmFormat();
    $output .= ", endTime = ";
    $output .= $this->getEndTime()->getDisplayAmPmFormat();
    $output .= ", buyinAmount = ";
    $output .= $this->getBuyinAmount();
    $output .= ", maxPlayers = ";
    $output .= $this->getMaxPlayers();
    $output .= ", maxRebuys = ";
    $output .= $this->getMaxRebuys();
    $output .= ", rebuyAmount = ";
    $output .= $this->getRebuyAmount();
    $output .= ", addonAmount = ";
    $output .= $this->getAddonAmount();
    $output .= ", addonChipCount = ";
    $output .= $this->getAddonChipCount();
    $output .= ", groupPayout = [";
    $output .= $this->getGroupPayout()->__toString();
    $output .= "], rake = ";
    $output .= $this->getRake();
    $output .= ", registrationClose = ";
    $output .= $this->getRegistrationClose()->getDisplayAmPmFormat();
//     $output .= ", directions = '";
//     $output .= $this->getDirections();
    $output .= "', registeredCount = ";
    $output .= $this->getRegisteredCount();
    $output .= ", enteredCount = ";
    $output .= $this->getEnteredCount();
    $output .= ", buyinsPaid = ";
    $output .= $this->getBuyinsPaid();
    $output .= ", rebuysPaid = ";
    $output .= $this->getRebuysPaid();
    $output .= ", rebuysCount = ";
    $output .= $this->getRebuysCount();
    $output .= ", addonsPaid = ";
    $output .= $this->getAddonsPaid();
    return $output;
  }
}
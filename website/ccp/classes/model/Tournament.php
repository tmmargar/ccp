<?php
namespace ccp\classes\model;
class Tournament extends Base {
  private string|null $description;
  private string|null $comment;
  private LimitType|null $limitType; // limit type object
  private GameType|null $gameType; // game type object
  private SpecialType|null $specialType; // special type object
  private int $chipCount;
  private Location|null $location; // location object
  private DateTime $date; // DateTime object
  private DateTime|null $startTime; // DateTime object
  private DateTime|null $endTime; // DateTime object
  private int $buyinAmount; // number not currency
  private int $maxPlayers; // number
  private int $maxRebuys; // number
  private int $rebuyAmount; // number not currency
  private int $addonAmount; // number not currency
  private int $addonChipCount; // number
  private GroupPayout|null $groupPayout; // group payout object
  private int $rake; // number not currency
  private int $registeredCount; // number
  private int $buyinsPaid; // number
  private int $rebuysPaid; // number
  private int $rebuysCount; // number
  private int $addonsPaid; // number
  private int $enteredCount; // number
  public function __construct(bool $debug, string|int|null $id, string|null $description ,string|null $comment, LimitType|null $limitType, GameType|null $gameType, SpecialType|null $specialType, int $chipCount, Location|null $location, DateTime $date, DateTime|null $startTime, DateTime|null $endTime, int $buyinAmount, int $maxPlayers, int $maxRebuys, int $rebuyAmount, int $addonAmount, int $addonChipCount, GroupPayout|null $groupPayout, int $rake, int $registeredCount, int $buyinsPaid, int $rebuysPaid, int $rebuysCount, int $addonsPaid, int $enteredCount) {
    parent::__construct($debug, $id);
    $this->description = $description;
    $this->comment = $comment;
    $this->limitType = $limitType;
    $this->gameType = $gameType;
    $this->specialType = $specialType;
    $this->chipCount = $chipCount;
    $this->location = $location;
    $this->date = $date;
    $this->startTime = $startTime;
    $this->endTime = $endTime;
    $this->buyinAmount = $buyinAmount;
    $this->maxPlayers = $maxPlayers;
    $this->maxRebuys = $maxRebuys;
    $this->rebuyAmount = $rebuyAmount;
    $this->addonAmount = $addonAmount;
    $this->addonChipCount = $addonChipCount;
    $this->groupPayout = $groupPayout;
    $this->rake = $rake;
    $this->registeredCount = $registeredCount;
    $this->buyinsPaid = $buyinsPaid;
    $this->rebuysPaid = $rebuysPaid;
    $this->addonsPaid = $addonsPaid;
    $this->enteredCount = $enteredCount;
  }
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
  public function setDescription(string $description) {
    $this->description = $description;
  }
  public function setComment(string $comment) {
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
  public function setChipCount(int $chipCount) {
    $this->chipCount = $chipCount;
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
  public function setBuyinAmount(int $buyinAmount) {
    $this->buyinAmount = $buyinAmount;
  }
  public function setMaxPlayers(int $maxPlayers) {
    $this->maxPlayers = $maxPlayers;
  }
  public function setMaxRebuys(int $maxRebuys) {
    $this->maxRebuys = $maxRebuys;
  }
  public function setRebuyAmount(int $rebuyAmount) {
    $this->rebuyAmount = $rebuyAmount;
  }
  public function setAddonAmount(int $addonAmount) {
    $this->addonAmount = $addonAmount;
  }
  public function setAddonChipCount(int $addonChipCount) {
    $this->addonChipCount = $addonChipCount;
  }
  public function setGroupPayout(GroupPayout $groupPayout) {
    $this->groupPayout = $groupPayout;
  }
  public function setRake(int $rake) {
    $this->rake = $rake;
  }
  public function setRegisteredCount(int $registeredCount) {
    $this->registeredCount = $registeredCount;
  }
  public function setEnteredCount(int $enteredCount) {
    $this->enteredCount = $enteredCount;
  }
  public function setBuyinsPaid(int $buyinsPaid) {
    $this->buyinsPaid = $buyinsPaid;
  }
  public function setRebuysPaid(int $rebuysPaid) {
    $this->rebuysPaid = $rebuysPaid;
  }
  public function setRebuysCount(int $rebuysCount) {
    $this->rebuysCount = $rebuysCount;
  }
  public function setAddonsPaid(int $addonsPaid) {
    $this->addonsPaid = $addonsPaid;
  }
  public function getLink() {
//     return HtmlUtility::buildLink("manageTournament.php", "modify", $this->getId(), $this->getDescription());
    $link = new HtmlLink(null, null, $this->isDebug(), "manageTournament.php", null, array("id", "mode"),  array($this->getId(). "modify"), -1, $this->getDescription(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", description = '";
    $output .= $this->description;
    $output .= "', comment = '";
    $output .= $this->comment;
    $output .= "', limitType = [";
    $output .= $this->limitType;
    $output .= "], gameType = [";
    $output .= $this->gameType;
    $output .= "], specialType = [";
    $output .= $this->specialType;
    $output .= "], chipCount = ";
    $output .= $this->chipCount;
    $output .= ", location = [";
    $output .= $this->location;
    $output .= "], date = ";
    $output .= $this->date->getDisplayFormat();
    $output .= ", startTime = ";
    $output .= $this->startTime->getDisplayAmPmFormat();
    $output .= ", endTime = ";
    $output .= $this->endTime->getDisplayAmPmFormat();
    $output .= ", buyinAmount = ";
    $output .= $this->buyinAmount;
    $output .= ", maxPlayers = ";
    $output .= $this->maxPlayers;
    $output .= ", maxRebuys = ";
    $output .= $this->maxRebuys;
    $output .= ", rebuyAmount = ";
    $output .= $this->rebuyAmount;
    $output .= ", addonAmount = ";
    $output .= $this->addonAmount;
    $output .= ", addonChipCount = ";
    $output .= $this->addonChipCount;
    $output .= ", groupPayout = [";
    $output .= $this->groupPayout;
    $output .= "], rake = ";
    $output .= $this->rake;
    $output .= ", registrationClose = ";
    $output .= $this->registrationClose->getDisplayAmPmFormat();
//     $output .= ", directions = '";
//     $output .= $this->directions;
    $output .= "', registeredCount = ";
    $output .= $this->registeredCount;
    $output .= ", enteredCount = ";
    $output .= $this->enteredCount;
    $output .= ", buyinsPaid = ";
    $output .= $this->buyinsPaid;
    $output .= ", rebuysPaid = ";
    $output .= $this->rebuysPaid;
    $output .= ", rebuysCount = ";
    $output .= $this->rebuysCount;
    $output .= ", addonsPaid = ";
    $output .= $this->addonsPaid;
    return $output;
  }
}
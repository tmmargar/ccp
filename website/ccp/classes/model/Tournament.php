<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Tournament extends Base {
  public function __construct(protected bool $debug, protected string|int|null $id, protected string|null $description, protected string|null $comment, protected LimitType|null $limitType,
    protected GameType|null $gameType, protected SpecialType|null $specialType, protected int $chipCount, protected Location|null $location, protected DateTime|null $date,
    protected DateTime|null $startTime, protected DateTime|null $endTime, protected int $buyinAmount, protected int $maxPlayers, protected int $maxRebuys, protected int $rebuyAmount,
    protected int $addonAmount, protected int $addonChipCount, protected GroupPayout|null $groupPayout, protected float $rake, protected int $registeredCount, protected int $buyinsPaid,
    protected int $rebuysPaid, protected int $rebuysCount, protected int $addonsPaid, protected int $enteredCount, protected int $earnings = 0) {
    parent::__construct(debug: $debug, id: $id);
  }
  public function getDescription(): string|null {
    return $this->description;
  }
  public function getComment(): string|null {
    return $this->comment;
  }
  public function getLimitType(): LimitType|null {
    return $this->limitType;
  }
  public function getGameType(): GameType|null {
    return $this->gameType;
  }
  public function getSpecialType(): SpecialType|null {
    return $this->specialType;
  }
  public function getChipCount(): int {
    return $this->chipCount;
  }
  public function getLocation(): Location|null {
    return $this->location;
  }
  public function getDate(): DateTime|null {
    return $this->date;
  }
  public function getStartTime(): DateTime|null {
    return $this->startTime;
  }
  public function getEndTime(): DateTime|null {
    return $this->endTime;
  }
  public function getBuyinAmount(): int {
    return $this->buyinAmount;
  }
  public function getMaxPlayers(): int {
    return $this->maxPlayers;
  }
  public function getMaxRebuys(): int {
    return $this->maxRebuys;
  }
  public function getRebuyAmount(): int {
    return $this->rebuyAmount;
  }
  public function getAddonAmount(): int {
    return $this->addonAmount;
  }
  public function getAddonChipCount(): int {
    return $this->addonChipCount;
  }
  public function getGroupPayout(): GroupPayout|null {
    return $this->groupPayout;
  }
  public function getRake(): float {
    return $this->rake;
  }
  public function getRakeForCalculation(): float {
    return $this->rake / 100;
  }
  public function getRegistrationClose(): DateTime {
    $close = "";
    if (isset($this->startTime)) {
      $close = clone $this->startTime;
      $interval = new \DateInterval(duration: "PT2H"); // 2 hours
      $close->getTime()->sub($interval);
    }
    return $close;
  }
  public function getRegistrationOpen(): DateTime {
    return new DateTime(debug: $this->isDebug(), id: null, time: "12:00");
  }
  public function getRegisteredCount(): int {
    return $this->registeredCount;
  }
  public function getBuyinsPaid(): int {
    return $this->buyinsPaid;
  }
  public function getRebuysPaid(): int {
    return $this->rebuysPaid;
  }
  public function getRebuysCount(): int {
    return $this->rebuysCount;
  }
  public function getAddonsPaid(): int {
    return $this->addonsPaid;
  }
  public function getEnteredCount(): int {
    return $this->enteredCount;
  }
  public function getEarnings(): int {
    return $this->earnings;
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
  public function setRake(float $rake) {
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
  public function setEarnings(int $earnings) {
    $this->earnings = $earnings;
  }
  public function getLink() {
    $link = new HtmlLink(accessKey: null, class: null, debug: $this->isDebug(), href: "manageTournament.php", id: null, paramName: array("id","mode"), paramValue: array($this->getId() . "modify"),
      tabIndex: - 1, text: $this->getDescription(), title: null);
    return $link->getHtml();
  }
  public function getDateAndTime() {
    return new DateTime(debug: $this->isDebug(), id: null, time: $this->getDate()->getDatabaseFormat() . " " . $this->getStartTime()->getDatabaseTimeFormat());
  }
  public function getDisplayDetails() {
    $optionText = $this->getDate()->getDisplayFormat();
    $optionText .= "@" . $this->getStartTime()->getDisplayAmPmFormat();
    $optionText .= " (" . $this->getLocation()->getName() . ")";
    $optionText .= " " . $this->getLimitType()->getName();
    $optionText .= " " . $this->getGameType()->getName();
    $optionText .= " " . $this->getMaxRebuys() . "r" . (0 != $this->getAddonAmount() ? "+a" : "");
    $waitListCnt = $this->getRegisteredCount() - $this->getMaxPlayers();
    $optionText .= " (" . ($waitListCnt > 0 ? $this->getMaxPlayers() : $this->getRegisteredCount()) . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . "np/" . $this->getBuyinsPaid() . "p";
    $optionText .= "+" . $this->getRebuysPaid() . "rp";
    $optionText .= "+" . $this->getAddonsPaid() . "ap";
    $optionText .= "/" . $this->getEnteredCount() . "ent)";
    return $optionText;
  }
  public function __toString(): string {
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
    $output .= $this->getRegistrationClose()->getDisplayAmPmFormat();
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
    $output .= ", earnings = ";
    $output .= $this->earnings;
    return $output;
  }
}
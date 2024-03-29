<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Player extends Base {
  private string $firstName;
  private string $lastName;
  private int $idPrevious;
  public function __construct(protected bool $debug, protected string|int $id, protected string $name, protected ?string $username, protected ?string $password,
    protected ?string $email, protected Phone|NULL $phone, protected int $administrator, protected ?string $registrationDate, protected ?string $approvalDate,
    protected ?int $approvalUserid, protected ?string $approvalName, protected ?string $rejectionDate, protected ?int $rejectionUserid, protected ?string $rejectionName,
    protected int $active, protected Address|NULL $address, protected $resetSelector, protected $resetToken, protected $resetExpires, protected $rememberSelector, protected $rememberToken,
    protected $rememberExpires) {
    parent::__construct(debug: $debug, id: $id);
    $nameFull = explode(separator: " ", string: $name);
    $this->setFirstName(firstName: $nameFull[0]);
    $this->setLastName(lastName: implode(separator: " ", array: array_slice(array: $nameFull, offset: 1)));
    $this->idPrevious = 0;
  }
  public function getFirstName(): string {
    return $this->firstName;
  }
  public function getLastName(): string {
    return $this->lastName;
  }
  public function getEmail(): ?string {
    return $this->email;
  }
  public function getPhone(): Phone|NULL {
    return $this->phone;
  }
  public function getUsername(): ?string {
    return $this->username;
  }
  public function getPassword(): ?string {
    return $this->password;
  }
  public function getAdministrator(): int {
    return $this->administrator;
  }
  public function getRegistrationDate(): ?string {
    return $this->registrationDate;
  }
  public function getApprovalDate(): ?string {
    return $this->approvalDate;
  }
  public function getApprovalUserid(): ?int {
    return $this->approvalUserid;
  }
  public function getApprovalName(): ?string {
    return $this->approvalName;
  }
  public function getRejectionDate(): ?string {
    return $this->rejectionDate;
  }
  public function getRejectionUserid(): ?int {
    return $this->rejectionUserid;
  }
  public function getRejectionName(): ?string {
    return $this->rejectionName;
  }
  public function getActive(): int {
    return $this->active;
  }
  public function getResetSelector() {
    return $this->resetSelector;
  }
  public function getResetToken() {
    return $this->resetToken;
  }
  public function getResetExpires() {
    return $this->resetExpires;
  }
  public function getRememberSelector() {
    return $this->rememberSelector;
  }
  public function getRememberToken() {
    return $this->rememberToken;
  }
  public function getRememberExpires() {
    return $this->rememberExpires;
  }
  public function getAddress(): Address|NULL {
    return $this->address;
  }
  public function getName(): string {
    return $this->firstName . (isset($this->lastName) ? (" " . $this->lastName) : "");
  }
  public function getIdPrevious(): int {
    return $this->idPrevious;
  }
  public function setFirstName(string $firstName) {
    $this->firstName = $firstName;
  }
  public function setLastName(string $lastName) {
    $this->lastName = $lastName;
  }
  public function setEmail(string $email) {
    $this->email = $email;
  }
  public function setPhone(Phone|NULL $phone) {
    $this->phone = $phone;
  }
  public function setUsername(string $username) {
    $this->username = $username;
  }
  public function setPassword(string $password) {
    $this->password = $password;
  }
  public function setAdministrator(int $administrator) {
    $this->administrator = $administrator;
  }
  public function setRegistrationDate(string $registrationDate) {
    $this->registrationDate = $registrationDate;
  }
  public function setApprovalDate(string $approvalDate) {
    $this->approvalDate = $approvalDate;
  }
  public function setApprovalUserid(int $approvalUserid) {
    $this->approvalUserid = $approvalUserid;
  }
  public function setApprovalName(string $approvalName) {
    $this->approvalName = $approvalName;
  }
  public function setRejectionDate(string $rejectionDate) {
    $this->rejectionDate = $rejectionDate;
  }
  public function setRejectionUserid(int $rejectionUserid) {
    $this->rejectionUserid = $rejectionUserid;
  }
  public function setRejectionName(string $rejectionName) {
    $this->rejectionName = $rejectionName;
  }
  public function setActive(int $active) {
    $this->active = $active;
  }
  public function setResetSelector($resetSelector) {
    $this->resetSelector = $resetSelector;
  }
  public function setResetToken($resetToken) {
    $this->resetToken = $resetToken;
  }
  public function setResetExpires($resetExpires) {
    $this->resetExpires = $resetExpires;
  }
  public function setRememberSelector($rememberSelector) {
    $this->rememberSelector = $rememberSelector;
  }
  public function setRememberToken($rememberToken) {
    $this->rememberToken = $rememberToken;
  }
  public function setRememberExpires($rememberExpires) {
    $this->rememberExpires = $rememberExpires;
  }
  public function setAddress(Address $address) {
    $this->address = $address;
  }
  public function setIdPrevious(int $idPrevious) {
    $this->idPrevious = $idPrevious;
  }
  public function setName($name) {
    $names = explode(separator: " ", string: $name);
    $this->firstName = $names[0];
    if (1 < count(value: $names)) {
      $this->lastName = implode(separator: " ", array: array_slice(array: $names, offset: 1));
    }
  }
  public function getLink(): string {
    $link = new HtmlLink(accessKey: NULL, class: NULL, debugP: $this->isDebug(), href: "managePlayer.php", id: NULL, paramName: array("id","mode"), paramValue: array($this->getId() . "modify"),
      tabIndex: - 1, text: $this->getName(), title: NULL);
    return $link->getHtml();
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= ", firstName = '";
    $output .= $this->firstName;
    $output .= "', lastName = '";
    $output .= $this->lastName;
    $output .= "', email = '";
    $output .= $this->email;
    $output .= "', phone = [";
    $output .= NULL !== $this->phone ? $this->phone->__toString() : "";
    $output .= "], username = '";
    $output .= $this->username;
    $output .= "', password = '";
    $output .= $this->password;
    $output .= "', administrator = '";
    $output .= $this->administrator;
    $output .= "', registrationDate = '";
    $output .= $this->registrationDate;
    $output .= "', approvalDate = '";
    $output .= $this->approvalDate;
    $output .= "', approvalUserId = '";
    $output .= $this->approvalUserid;
    $output .= "', approvalName = '";
    $output .= $this->approvalName;
    $output .= "', rejectionDate = '";
    $output .= $this->rejectionDate;
    $output .= "', rejectionUserId = '";
    $output .= $this->rejectionUserid;
    $output .= "', rejectionName = '";
    $output .= $this->rejectionName;
    $output .= "', active = '";
    $output .= $this->active;
    $output .= "', address = [";
    $output .= NULL !== $this->address ? $this->address->__toString() : "";
    $output .= "], idPrevious = ";
    $output .= $this->idPrevious;
    $output .= ", resetSelector = '";
    $output .= $this->resetSelector;
    $output .= "', resetToken = '";
    $output .= $this->resetToken;
    $output .= "', resetExpires = '";
    $output .= $this->resetExpires;
    $output .= "', rememberSelector = '";
    $output .= $this->rememberSelector;
    $output .= "', rememberToken = '";
    $output .= $this->rememberToken;
    $output .= "', rememberExpires = '";
    $output .= $this->rememberExpires;
    $output .= "'";
    return $output;
  }
}
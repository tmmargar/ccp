<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class User extends Base {
  private string $firstName;
  private string $lastName;
  private int $idPrevious;
  public function __construct(protected bool $debug, protected string|int|null $id, protected string $name, protected string|null $username, protected string|null $password, protected string|null $email, protected Phone|null $phone, protected int $administrator, protected string|null $registrationDate, protected string|null $approvalDate, protected int|null $approvalUserid, protected string|null $approvalName, protected string|null $rejectionDate, protected int|null $rejectionUserid, protected string|null $rejectionName, protected int $active, protected Address|null $address, protected $resetSelector, protected $resetToken, protected $resetExpires, protected $rememberSelector, protected $rememberToken, protected $rememberExpires) {
    parent::__construct(debug: $debug, id: $id);
    $nameFull = explode(separator: " ", string: $name);
    $this->setFirstName(firstName: $nameFull[0]);
    $this->setLastName(lastName: implode(separator: " ", array: array_slice(array: $nameFull, offset: 1)));
    $this->idPrevious = 0;
  }
  public function getFirstName() {
    return $this->firstName;
  }
  public function getLastName() {
    return $this->lastName;
  }
  public function getEmail() {
    return $this->email;
  }
  public function getPhone() {
    return $this->phone;
  }
  public function getUsername() {
    return $this->username;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getAdministrator() {
    return $this->administrator;
  }
  public function getRegistrationDate() {
    return $this->registrationDate;
  }
  public function getApprovalDate() {
    return $this->approvalDate;
  }
  public function getApprovalUserid() {
    return $this->approvalUserid;
  }
  public function getApprovalName() {
    return $this->approvalName;
  }
  public function getRejectionDate() {
    return $this->rejectionDate;
  }
  public function getRejectionUserid() {
    return $this->rejectionUserid;
  }
  public function getRejectionName() {
    return $this->rejectionName;
  }
  public function getActive() {
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
  public function getAddress() {
    return $this->address;
  }
  public function getName() {
    return $this->firstName . (isset($this->lastName) ? (" " . $this->lastName) : "");
  }
  public function getIdPrevious() {
    return $this->idPrevious;
  }
  public function setFirstName(string $firstName) {
    $this->firstName = $firstName;
  }
  public function setLastName(string $lastName) {
    $this->lastName = $lastName;
  }
  public function setEmail(string $email) {
    // TODO: validate
    $this->email = $email;
  }
  public function setPhone(Phone|null $phone) {
    $this->phone = $phone;
  }
  public function setUsername(string $username) {
    $this->username = $username;
  }
  public function setPassword(string $password) {
    // TODO: encryption or hiding
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
  // pass in full name which gets split and set
  public function setName($name) {
    $names = explode(separator: " ", string: $name);
    $this->firstName = $names[0];
    if (1 < count(value: $names)) {
      $this->lastName = implode(separator: " ", array: array_slice(array: $names, offset: 1));
    }
  }
  public function getLink() {
    // return "<a href=\"manageUser.php?mode=modify&id=" . $this->getId() . "\">" . $this->getName() . "<\a>\n";
    $link = new HtmlLink(accessKey: null, class: null, debugP: $this->isDebug(), href: "manageUser.php", id: null, paramName: array("id", "mode"), paramValue: array($this->getId(). "modify"), tabIndex: -1, text: $this->getName(), title: null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", firstName = '";
    $output .= $this->firstName;
    $output .= "', lastName = '";
    $output .= $this->lastName;
    $output .= "', email = '";
    $output .= $this->email;
    $output .= "', phone = [";
    $output .= null !== $this->phone ? $this->phone->__toString() : "";
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
    $output .= null !== $this->address ? $this->address->__toString() : "";
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
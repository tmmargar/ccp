<?php
namespace ccp\classes\model;
class User extends Base {
  private $firstName;
  private $lastName;
  private $email;
  private $username;
  private $password;
  private $administrator; // boolean 0 is false non 0 is true
  private $registrationDate;
  private $approvalDate;
  private $approvalUserid;
  private $approvalName;
  private $rejectionDate;
  private $rejectionUserid;
  private $rejectionName;
  private $active; // boolean 0 is false non 0 is true
  private $resetSelector;
  private $resetToken;
  private $resetExpires;
  private $rememberSelector;
  private $rememberToken;
  private $rememberExpires;
  private $address; // address object
  private $idPrevious; // holds previous userid after making sequential
  public function __construct22($id, $firstName, $lastName, $username, $password, $email, $administrator, $registrationDate, $approvalDate, $approvalUserid, $approvalName, $rejectionDate, $rejectionUserid, $rejectionName, $active, $resetSelector, $resetToken, $resetExpires, $rememberSelector, $rememberToken, $rememberExpires, Address $address) {
    $this->setId($id);
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->administrator = $administrator;
    $this->registrationDate = $registrationDate;
    $this->approvalDate = $approvalDate;
    $this->approvalUserid = $approvalUserid;
    $this->approvalName = $approvalName;
    $this->rejectionDate = $rejectionDate;
    $this->rejectionUserid = $rejectionUserid;
    $this->rejectionName = $rejectionName;
    $this->active = $active;
    $this->resetSelector = $resetSelector;
    $this->resetToken = $resetToken;
    $this->resetExpires = $resetExpires;
    $this->rememberSelector = $rememberSelector;
    $this->rememberToken = $rememberToken;
    $this->rememberExpires = $rememberExpires;
    $this->address = $address;
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
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }
  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }
  public function setEmail($email) {
    // TODO: validate
    $this->email = $email;
  }
  public function setUsername($username) {
    $this->username = $username;
  }
  public function setPassword($password) {
    // TODO: encryption or hiding
    $this->password = $password;
  }
  public function setAdministrator($administrator) {
    $this->administrator = $administrator;
  }
  public function setRegistrationDate($registrationDate) {
    $this->registrationDate = $registrationDate;
  }
  public function setApprovalDate($approvalDate) {
    $this->approvalDate = $approvalDate;
  }
  public function setApprovalUserid($approvalUserid) {
    $this->approvalUserid = $approvalUserid;
  }
  public function setApprovalName($approvalName) {
    $this->approvalName = $approvalName;
  }
  public function setRejectionDate($rejectionDate) {
    $this->rejectionDate = $rejectionDate;
  }
  public function setRejectionUserid($rejectionUserid) {
    $this->rejectionUserid = $rejectionUserid;
  }
  public function setRejectionName($rejectionName) {
    $this->rejectionName = $rejectionName;
  }
  public function setActive($active) {
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
  public function setIdPrevious($idPrevious) {
    $this->idPrevious = $idPrevious;
  }
  // pass in full name which gets split and set
  public function setName($name) {
    $names = explode(" ", $name);
    $this->firstName = $names[0];
    if (1 < count($names)) {
      $this->lastName = implode(" ", array_slice($names, 1));
    }
  }
  public function getLink() {
    // return "<a href=\"manageUser.php?mode=modify&id=" . $this->getId() . "\">" . $this->getName() . "<\a>\n";
    $link = new HtmlLink(null, null, $this->isDebug(), "manageUser.php", null, array("id", "mode"),  array($this->getId(). "modify"), -1, $this->getName(), null);
    return $link->getHtml();
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", firstName = '";
    $output .= $this->getFirstName();
    $output .= "', lastName = '";
    $output .= $this->getLastName();
    $output .= "', email = '";
    $output .= $this->getEmail();
    $output .= "', username = '";
    $output .= $this->getUsername();
    $output .= "', password = '";
    $output .= $this->getPassword();
    $output .= "', administrator = '";
    $output .= $this->getAdministrator();
    $output .= "', registrationDate = '";
    $output .= $this->getRegistrationDate();
    $output .= "', approvalDate = '";
    $output .= $this->getApprovalDate();
    $output .= "', approvalUserId = '";
    $output .= $this->getApprovalUserId();
    $output .= "', approvalName = '";
    $output .= $this->getApprovalName();
    $output .= "', rejectionDate = '";
    $output .= $this->getRejectionDate();
    $output .= "', rejectionUserId = '";
    $output .= $this->getRejectionUserId();
    $output .= "', rejectionName = '";
    $output .= $this->getRejectionName();
    $output .= "', active = '";
    $output .= $this->getActive();
    $output .= "', resetSelector = '";
    $output .= $this->getResetSelector();
    $output .= "', resetToken = '";
    $output .= $this->getResetToken();
    $output .= "', resetExpires = '";
    $output .= $this->getResetExpires();
    $output .= "', rememberSelector = '";
    $output .= $this->getRememberSelector();
    $output .= "', rememberToken = '";
    $output .= $this->getRememberToken();
    $output .= "', rememberExpires = '";
    $output .= $this->getRememberExpires();
    $output .= "', address = [";
    $output .= null !== $this->getAddress() ? $this->getAddress()->__toString() : "";
    $output .= "], idPrevious = ";
    $output .= $this->idPrevious;
    return $output;
  }
}
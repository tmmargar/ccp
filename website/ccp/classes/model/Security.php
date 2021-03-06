<?php
namespace ccp\classes\model;
use ccp\classes\utility\SessionUtility;
class Security extends Base {
  private $login; // Login object
  private $user; // User object populated after valid login
  private $season; // Season object
  public function __construct4($debug, $id, Login $login, User $user) {
    parent::__construct2($debug, $id);
    $this->login = $login;
    $this->user = $user;
  }
  public function getLogin() {
    return $this->login;
  }
  public function getSeason() {
    return $this->season;
  }
  public function getUser() {
    return $this->user;
  }
  public function login() {
    if ($this->validatePassword()) {
      $this->loginSuccess();
      return true;
    } else {
      return false;
    }
  }
  private function loginSuccess() {
    $databaseResult = new DatabaseResult($this->isDebug());
    $params = array($this->login->getUsername());
    $resultList = $databaseResult->getUserByUsername($params);
    if (0 < count($resultList)) {
      $this->setUser($resultList[0]);
      SessionUtility::setValue(SessionUtility::$OBJECT_NAME_SECURITY, $this);
    }
    $params = array(Constant::$FLAG_YES_DATABASE);
    $resultList = $databaseResult->getSeasonByActive($params);
    if (0 < count($resultList)) {
      $this->setSeason($resultList[0]);
      SessionUtility::setValue(SessionUtility::$OBJECT_NAME_SEASON, $resultList[0]);
    }
  }
  /*
   * public static function rememberMe($userName, $password, $rememberMe, $url) {
   * $current_time = time();
   * $current_date = date("Y-m-d H:i:s", $current_time);
   * // Set Cookie expiration for 1 month
   * // $cookie_expiration_time = $current_time + (30 * 24 * 60 * 60); // for 1 month
   * // $isLoggedIn = false;
   * // Check if loggedin session and redirect if session exists
   * echo "<Br>session user id -> " . $_SESSION["userid"];
   * echo "<Br>cookie user id -> " . $_COOKIE["remember_username"];
   * echo "<Br>cookie selector -> " . $_COOKIE["remember_selector"];
   * echo "<Br>cookie token -> " . $_COOKIE["remember_token"];
   * if (! empty(self::getValue("userid"))) {
   * self::redirect();
   * } else if (! empty($_COOKIE["remember_username"]) && ! empty($_COOKIE["remember_selector"]) && ! empty($_COOKIE["remember_token"])) { // Check if loggedin session exists
   * // Initiate auth token verification directive to false
   * $isPasswordVerified = false;
   * $isSelectorVerified = false;
   * $isExpiryDateVerified = false;
   * // Get token for username
   * // $userToken = $auth->getTokenByUsername($_COOKIE["remember_username"], 0);
   * $databaseResult = new DatabaseResult();
   * $databaseResult->setDebug(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
   * $params = array(
   * $_COOKIE["remember_username"]
   * );
   * $resultList = $databaseResult->getUserByUsername($params);
   * if (0 < count($resultList)) {
   * // Validate random password cookie with database
   * if (password_verify($_COOKIE["remember_selector"], $resultList[0]->getRememberSelector())) {
   * $isPasswordVerified = true;
   * }
   * echo "<br> token -> " . $_COOKIE["remember_token"] . " == " . $resultList[0]->getRememberToken();
   * // Validate random selector cookie with database
   * if (password_verify($_COOKIE["remember_token"], $resultList[0]->getRememberToken())) {
   * $isSelectorVerified = true;
   * }
   * echo "<br> date -> " . $resultList[0]->getRememberExpires() . " >= " . $current_date;
   * // check cookie expiration by date
   * if ($resultList[0]->getRememberExpires() >= $current_date) {
   * $isExpiryDateVerified = true;
   * }
   * // Redirect if all cookie based validation returns true
   * // Else, mark the token as expired and clear cookies
   * if (! empty($resultList[0]->getId()) && $isPasswordVerified && $isSelectorVerified && $isExpiryDateVerified) {
   * self::redirect();
   * } else {
   * if (! empty($resultList[0]->getId())) {
   * // $auth->markAsExpired($resultList[0]->getId());
   * }
   * // clear cookies
   * // $util->clearAuthCookie();
   * }
   * }
   * } else {
   * self::login($userName, $password, $rememberMe, $url);
   * }
   * }
   */
  public function setLogin($login) {
    $this->login = $login;
  }
  public function setSeason(Season $season) {
    $this->season = $season;
  }
  public function setUser(User $user) {
    $this->user = $user;
  }
  public function __toString() {
    return parent::__toString() . "<br>login = " . $this->login->__toString() . "<br>user = " . $this->user->__toString();
  }
  private function validatePassword() {
    $found = false;
    $databaseResult = new DatabaseResult($this->isDebug());
    $resultList = $databaseResult->getLogin($this->login->getUsername());
    if (0 < count($resultList)) {
//       echo "<br>" . $this->login->getPassword() . " -- " . $resultList[0];
//       $t_hasher = new PasswordHash(8, FALSE);
//       echo "<br>hasher check ->" . $t_hasher->CheckPassword($this->login->getPassword(), $resultList[0]);
//       if ($t_hasher->CheckPassword($this->login->getPassword(), $resultList[0])) {
//         echo "<br>MATCH OLD";
//         $found = true;
//       } else {
//          echo "<br>hashed -> " . password_hash($this->login->getPassword(), PASSWORD_DEFAULT);
        if (password_verify($this->login->getPassword(), $resultList[0])) {
//           echo "<br>MATCH NEW";
          $found = true;
          // } else {
          // echo "<br>NO MATCH NEW";
        }
//       }
//       die();
    }
    return $found;
  }
}
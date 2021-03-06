<?php
namespace ccp\classes\utility;
use ccp\classes\model\Constant;
use Exception;
class SessionUtility {
  public static $OBJECT_NAME_ADMINISTRATOR = "administrator";
  public static $OBJECT_NAME_DEBUG = "debug";
  public static $OBJECT_NAME_NAME = "name";
  public static $OBJECT_NAME_USERID = "userid";
  public static $OBJECT_NAME_USERNAME = "username";
  public static $OBJECT_NAME_SECURITY = "securityObject";
  public static $OBJECT_NAME_SEASON = "seasonObject";
  public static $OBJECT_NAME_START_DATE = "startDate";
  public static $OBJECT_NAME_END_DATE = "endDate";
  public static function destroy() {
    self::startSession();
    // clear out session
    $_SESSION = array();
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    // if (ini_get("session.use_cookies")) {
    // $params = session_get_cookie_params();
    // setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    // }
    // // Use this too
    // ini_set('session.gc_max_lifetime', 0);
    // ini_set('session.gc_probability', 1);
    // ini_set('session.gc_divisor', 1);
    session_destroy();
  }
  public static function destroyAllSessions() {
    $files = glob(session_save_path() . '/*'); // get all file names
    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
      }
    }
  }
  public static function existsSeason() {
    return !empty($_SESSION[self::$OBJECT_NAME_SEASON]);
  }
  public static function existsSecurity() {
    return !empty($_SESSION[self::$OBJECT_NAME_SECURITY]);
  }
  public static function getValue($name) {
    // TODO: find better way to do this
    // return $_SESSION[$name];
    $value = "";
    if (self::existsSecurity()) {
      $security = unserialize($_SESSION[self::$OBJECT_NAME_SECURITY]);
      switch ($name) {
        case self::$OBJECT_NAME_ADMINISTRATOR:
          $value = $security->getUser()->getAdministrator();
          break;
        case self::$OBJECT_NAME_DEBUG:
          $value = false; // $security->isDebug();
          break;
        case self::$OBJECT_NAME_NAME:
          $value = $security->getUser()->getName();
          break;
        case self::$OBJECT_NAME_USERID:
          $value = $security->getUser()->getId();
          break;
        case self::$OBJECT_NAME_USERNAME:
          $value = $security->getUser()->getUsername();
          break;
      }
    }
    if (self::existsSeason()) {
      $season = unserialize($_SESSION[self::$OBJECT_NAME_SEASON]);
      switch ($name) {
        case self::$OBJECT_NAME_START_DATE:
          $value = $season->getStartDate();
          break;
        case self::$OBJECT_NAME_END_DATE:
          $value = $season->getEndDate();
          break;
      }
    }
    return $value;
  }
  public static function print() {
    return print_r($_SESSION, true);
  }
  public static function regenerateAllSessions($seasonNew) {
    $sessionCurrentId = session_id(); // get current session id
    $ctr = -1;
    $files = glob(session_save_path() . "/*"); // get all session files
    foreach ($files as $file) {
      $ctr++;
//       echo "<br>file is " . $file;
      if (is_file($file) && ("sessions/sess_" . $sessionCurrentId) != $file) { // if file and not current session
//         echo "<BR>backing up current session " . $sessionCurrentId;
        $temp = array();
//         $temp['tempid'] = session_id();
        $temp['sessionId'] = $sessionCurrentId;
        foreach ($_SESSION as $key=>$val) {
            $temp[$key] = $val;
        }
        session_write_close();
//         echo "<BR>updating other session " . $file;
        $fileAry = explode("_", $file);
        session_id($fileAry[1]);
        session_start();
        // update session here
//         $_SESSION[self::$OBJECT_NAME_SEASON] = serialize($seasonNew);
        self::setValue(self::$OBJECT_NAME_SEASON, $seasonNew);
        session_write_close();
//         echo "<BR>restoring current session " . $temp['sessionId'];
        session_id($temp['sessionId']); //restart local sesh
        session_start();
        foreach ($temp as $key=>$val) {
            $_SESSION[$key] = $val;
        }
//         echo "<BR>restoring current session season " . $seasonNew;
        // update session here
//         $_SESSION[self::$OBJECT_NAME_SEASON] = serialize($seasonNew);
        self::setValue(self::$OBJECT_NAME_SEASON, $seasonNew);
      }
    }
  }
  public static function startSession() {
    if (Constant::PATH_SESSION() != session_save_path()) {
      session_save_path(Constant::PATH_SESSION());
    }
    session_start();
//     session_regenerate_id(true);
  }
  public static function setValue($name, $value) {
    $_SESSION[$name] = serialize($value);
  }
  public static function unserialize($session_data) {
    $method = ini_get("session.serialize_handler");
    switch ($method) {
      case "php":
        return self::unserialize_php($session_data);
        break;
      case "php_binary":
        return self::unserialize_phpbinary($session_data);
         break;
      default:
        throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary");
    }
  }
  private static function unserialize_php($session_data) {
    $return_data = array();
    $offset = 0;
    while ($offset < strlen($session_data)) {
      if (!strstr(substr($session_data, $offset), "|")) {
        throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
      }
      $pos = strpos($session_data, "|", $offset);
      $num = $pos - $offset;
      $varname = substr($session_data, $offset, $num);
      $offset += $num + 1;
      $data = unserialize(substr($session_data, $offset));
      $return_data[$varname] = $data;
      $offset += strlen(serialize($data));
    }
    return $return_data;
  }
  private static function unserialize_phpbinary($session_data) {
    $return_data = array();
    $offset = 0;
    while ($offset < strlen($session_data)) {
      $num = ord($session_data[$offset]);
      $offset += 1;
      $varname = substr($session_data, $offset, $num);
      $offset += $num;
      $data = unserialize(substr($session_data, $offset));
      $return_data[$varname] = $data;
      $offset += strlen(serialize($data));
    }
    return $return_data;
  }
}
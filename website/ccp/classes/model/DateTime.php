<?php
namespace ccp\classes\model;

use DateTimeZone;

class DateTime extends Base {
  public static $YEAR_FIRST_SEASON = 2005;
//   public static $DATE_START_SEASON = "-01-01";
//   public static $DATE_END_SEASON   = "-11-30";
  private static $DATE_FORMAT_CURRENT_YEAR = "Y";
  private static $DATE_FORMAT_DATABASE_DEFAULT = "Y-m-d";
  private static $DATE_FORMAT_DISPLAY_DEFAULT = "M d, Y";
  private static $DATE_FORMAT_DISPLAY_LONG = "l, F d, Y";
  private static $DATE_FORMAT_DISPLAY_REGISTRATION_NOT_OPEN = "M d";
  private static $DATE_FORMAT_PICKER_DISPLAY_DEFAULT = "m/d/Y";
  private static $TIME_FORMAT_DATABASE_DEFAULT = "H:i:s";
  private static $TIME_FORMAT_DISPLAY_AMPM = "H:i";

  private $time;
  private $timeZone; // \DateTimeZone

  public function __construct3($debug, $id, $time) {
    self::__construct4($debug, $id, $time, null);
  }
  public function __construct4($debug, $id, $time, $timeZone) {
    parent::__construct2($debug, $id);
    if (!isset($timeZone)) {
        $timeZone = new DateTimeZone(date_default_timezone_get());
    }
    $this->timeZone = $timeZone;
    if ("now" == $time) {
      $temp = new \DateTime();
      $time = $temp->format("Ymd H:i:s");
    }
    $this->time = null == $time ? null : new \DateTime($time, $this->timeZone);
  }

  public function getCurrentYearFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_CURRENT_YEAR);
  }

  public function getDatabaseFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_DATABASE_DEFAULT);
  }

  public function getDatabaseTimeFormat() {
    return null == $this->time ? null : $this->time->format(self::$TIME_FORMAT_DATABASE_DEFAULT);
  }

  public function getDisplayAmPmFormat() {
    return null == $this->time ? null : $this->time->format(self::$TIME_FORMAT_DISPLAY_AMPM);
  }

  public function getDisplayDatePickerFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_PICKER_DISPLAY_DEFAULT);
  }

  public function getDisplayFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_DISPLAY_DEFAULT);
  }

  public function getDisplayLongFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_DISPLAY_LONG);
  }

  public function getDisplayLongTimeFormat() {
    return null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_DISPLAY_LONG . " " . self::$TIME_FORMAT_DISPLAY_AMPM);
  }

  public function getDisplayRegistrationNotOpenFormat() {
    return null == $this->time ? null :  $this->time->format(self::$DATE_FORMAT_DISPLAY_REGISTRATION_NOT_OPEN);
  }

  public function getTime() {
    return $this->time;
  }

  public function getTimeZone() {
    return $this->timeZone;
  }

  public function setTime($time) {
    $this->time = $time;
  }

  public function setTimeZone($timeZone) {
    $this->timeZone = $timeZone;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", time = ";
    $output .= $this->time;
    $output .= ", timeZone = ";
    $output .= $this->timeZone;
    return $output;
  }
}
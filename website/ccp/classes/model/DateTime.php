<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use DateTimeZone;
class DateTime extends Base {
  public static int $YEAR_FIRST_SEASON                             = 2005;
  private static string $DATE_FORMAT_YEAR                          = "Y";
  private static string $DATE_FORMAT_DATABASE_DEFAULT              = "Y-m-d";
  private static string $DATE_FORMAT_DATABASE_DATE_TIME_DEFAULT    = "Y-m-d H:i:s";
  private static string $DATE_FORMAT_DISPLAY_DEFAULT               = "m/d/Y";
  private static string $DATE_FORMAT_DISPLAY_LONG                  = "D, M j, Y";
  private static string $DATE_FORMAT_DISPLAY_REGISTRATION_NOT_OPEN = "M d";
  private static string $DATE_FORMAT_PICKER_TIME_DISPLAY_DEFAULT   = "Y-m-d\TH:i";
  private static string $DATE_FORMAT_TIME_DISPLAY_DEFAULT          = "M d, Y h:i A";
  private static string $TIME_FORMAT_DATABASE_DEFAULT              = "H:i:s";
  private static string $TIME_FORMAT_DISPLAY_AMPM                  = "h:i A";
  private static string $TIME_FORMAT_NOW                           = "Ymd H:i:s";
  private \DateTime|null $time;
  private \DateTimeZone $timeZone; // \DateTimeZone

  public function __construct(protected bool $debug, protected string|int|null $id, string|null $time) {
    parent::__construct(debug: $debug, id: $id);
    $this->timeZone = new DateTimeZone(timezone: date_default_timezone_get());
    if ("now" == $time) {
      $temp = new \DateTime();
      $time = $temp->format(format: self::$TIME_FORMAT_NOW);
    }
    $this->time = null == $time ? null : new \DateTime($time, $this->timeZone);
  }

  public function getDatabaseFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_DATABASE_DEFAULT);
  }

  public function getDatabaseDateTimeFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_DATABASE_DATE_TIME_DEFAULT);
  }

  public function getDatabaseTimeFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$TIME_FORMAT_DATABASE_DEFAULT);
  }

  public function getDisplayAmPmFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$TIME_FORMAT_DISPLAY_AMPM);
  }

  public function getDisplayDateTimePickerFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_PICKER_TIME_DISPLAY_DEFAULT);
  }

  public function getDisplayFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_DISPLAY_DEFAULT);
  }

  public function getDisplayLongFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_DISPLAY_LONG);
  }

  public function getDisplayLongTimeFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_DISPLAY_LONG . " " . self::$TIME_FORMAT_DISPLAY_AMPM);
  }

  public function getDisplayRegistrationNotOpenFormat() {
    return null == $this->time ? null :  $this->time->format(format: self::$DATE_FORMAT_DISPLAY_REGISTRATION_NOT_OPEN);
  }

  public function getDisplayTimeFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_TIME_DISPLAY_DEFAULT);
  }

  public function getTime() {
    return $this->time;
  }

  public function getTimeZone() {
    return $this->timeZone;
  }

  public function getYearFormat() {
    return null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_YEAR);
  }

  public function setTime(int $time) {
    $this->time = $time;
  }

  public function setTimeZone(DateTimezone $timeZone) {
    $this->timeZone = $timeZone;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", time = ";
//     $output .= null == $this->time ? null : $this->time->format(self::$DATE_FORMAT_DISPLAY_DEFAULT);
    $output .= null == $this->time ? null : $this->time->format(format: self::$DATE_FORMAT_PICKER_TIME_DISPLAY_DEFAULT);
    $output .= ", timeZone = ";
    $output .= null == $this->timeZone ? null : $this->timeZone->getName();
    return $output;
  }
}
<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class Constant {
  public const ACCESSKEY_ACTIVE = "v";
  public const ACCESSKEY_ADDON_AMOUNT = "n";
  public const ACCESSKEY_ADDON_CHIP_COUNT = "t";
  public const ACCESSKEY_ADDRESS = "a";
  public const ACCESSKEY_ADD_ROW = "o";
  public const ACCESSKEY_APPROVE = "a";
  public const ACCESSKEY_ATTEND = "a";
  public const ACCESSKEY_BODY = "b";
  public const ACCESSKEY_BONUS_POINTS = "b";
  public const ACCESSKEY_BUYIN_AMOUNT = "b";
  public const ACCESSKEY_CANCEL = "a";
  public const ACCESSKEY_CHIP_COUNT = "c";
  public const ACCESSKEY_CITY = "c";
  public const ACCESSKEY_COMMENT = "n";
  public const ACCESSKEY_CONFIRM_DELETE = "l";
  public const ACCESSKEY_CONFIRM_PASSWORD = "c";
  public const ACCESSKEY_CREATE = "c";
  public const ACCESSKEY_DELETE = "l";
  public const ACCESSKEY_DESCRIPTION = "i";
  public const ACCESSKEY_EMAIL = "e";
  public const ACCESSKEY_FEE_PAID = "f";
  public const ACCESSKEY_FIRST_NAME = "f";
  public const ACCESSKEY_FOOD = "f";
  public const ACCESSKEY_GAME_TYPE = "g";
  public const ACCESSKEY_GROUP = "o";
  public const ACCESSKEY_GO = "g";
  public const ACCESSKEY_KNOCKOUT_ID = "k";
  public const ACCESSKEY_LAST_NAME = "l";
  public const ACCESSKEY_LIMIT_TYPE = "l";
  public const ACCESSKEY_LOCATION_NAME = "n";
  public const ACCESSKEY_LOGIN = "l";
  public const ACCESSKEY_MAP = "m";
  public const ACCESSKEY_MAX_PLAYERS = "x";
  public const ACCESSKEY_MAX_REBUYS = "u";
  public const ACCESSKEY_MIN_PLAYERS = "x";
  public const ACCESSKEY_MODIFY = "m";
  public const ACCESSKEY_NAME = "n";
  public const ACCESSKEY_PASSWORD = "p";
  public const ACCESSKEY_PAYOUT = "o";
  public const ACCESSKEY_PERCENTAGE = "p";
  public const ACCESSKEY_PHONE = "h";
  public const ACCESSKEY_PLACE = "p";
  public const ACCESSKEY_PLAYER_ID = "p";
  public const ACCESSKEY_RAKE = "k";
  public const ACCESSKEY_REBUY_AMOUNT = "y";
  public const ACCESSKEY_REBUY_COUNT = "y";
  public const ACCESSKEY_REGISTER = "r";
  public const ACCESSKEY_REJECT = "r";
  public const ACCESSKEY_REMEMBER_ME = "r";
  public const ACCESSKEY_RESET = "r";
  public const ACCESSKEY_REMOVE_ROW = "m";
  public const ACCESSKEY_SAVE = "s";
  public const ACCESSKEY_SEASON = "s";
  public const ACCESSKEY_SIGN_UP = "s";
  public const ACCESSKEY_SPECIAL_TYPE = "s";
  public const ACCESSKEY_START_TIME = "s";
  public const ACCESSKEY_STATE = "t";
  public const ACCESSKEY_SUBJECT = "s";
  public const ACCESSKEY_TO = "t";
  public const ACCESSKEY_TOURNAMENT_DATE = "t";
  public const ACCESSKEY_TOURNAMENT_ID = "t";
  public const ACCESSKEY_UNREGISTER = "u";
  public const ACCESSKEY_UPDATE = "u";
  public const ACCESSKEY_USERNAME = "u";
  public const ACCESSKEY_VIEW = "v";
  public const ACCESSKEY_ZIP = "z";
  public const CODE_STATUS_FINISHED = "F";
  public const CODE_STATUS_PAID = "P";
  public const CODE_STATUS_REGISTERED = "R";
  public const DELIMITER_DEFAULT = ", ";
  public const DESCRIPTION_CHAMPIONSHIP = "Championship";
  public const DESCRIPTION_MAIN_EVENT = "Main Event";
  public const DISPLAY_ADDON = "+a";
  public const DISPLAY_REBUY = "+r";
  public const FIELD_NAME_EMAIL = "email";
  public const FIELD_NAME_ID = "id";
  public const FIELD_NAME_MODE = "mode";
  public const FIELD_NAME_SUFFIX_CHECKBOX_ALL = "CheckAll";
  public const FIELD_NAME_USER = "user";
  public const FIELD_NAME_USERNAME = "username";
  public const FLAG_NO = "N";
  public const FLAG_YES = "Y";
  public const FLAG_YES_DATABASE = 1;
  public const ID_TABLE_DATA = "dataTbl";
  public const ID_TABLE_INPUT = "inputs";
  public const INTERVAL_DATE_REGISTRATION_OPEN = "P14D";
  public const MODE_APPROVE = "approve";
  public const MODE_CONFIRM = "confirm";
  public const MODE_CREATE = "create";
  public const MODE_DELETE = "delete";
  public const MODE_EMAIL = "email";
  public const MODE_LOGIN = "login";
  public const MODE_MODIFY = "modify";
  public const MODE_RESET_PASSWORD = "resetPassword";
  public const MODE_RESET_PASSWORD_CONFIRM = "resetPasswordConfirm";
  public const MODE_RESET_PASSWORD_REQUEST = "resetPasswordRequest";
  public const MODE_SAVE_CREATE = "savecreate";
  public const MODE_SAVE_MODIFY = "savemodify";
  public const MODE_SAVE_PREFIX = "save";
  public const MODE_SAVE_VIEW = "saveview";
  public const MODE_SEND_EMAIL = "sendEmail";
  public const MODE_SIGNUP = "signup";
  public const NAME_STAFF = "CCP Staff";
  public const MODE_VIEW = "view";
  public const NAME_STATUS_NOT_PAID = "Not paid";
  public const NAME_STATUS_NOT_REGISTERED = "Not registered";
  public const NAME_STATUS_PAID = "Paid";
  public const NAME_STATUS_REGISTERED = "Registered";
  public const NAME_TIME_ZONE = "America/New_York";
  public const SYMBOL_CURRENCY_DEFAULT = "$";
  public const SYMBOL_PERCENTAGE_DEFAULT = "%";
  public const TEXT_ADDON = "Addon";
  public const TEXT_ADD_ROW = "Add row";
  public const TEXT_APPROVE = "Approve";
  public const TEXT_ATTEND = "Attend";
  public const TEXT_ATTEND_UNATTEND = "Attend / un-attend";
  public const TEXT_BUYIN = "Buyin";
  public const TEXT_CANCEL = "Cancel";
  public const TEXT_CONFIRM_DELETE = "Confirm delete";
  public const TEXT_CREATE = "Create";
  public const TEXT_DELETE = "Delete";
  public const TEXT_FEE = "Fee";
  public const TEXT_FEE_PAID = "FeePaid";
  public const TEXT_FEE_PAID_DISPLAY = "Fee Paid";
  public const TEXT_GO = "Go";
  public const TEXT_MODIFY = "Modify";
  public const TEXT_NO = "No";
  public const TEXT_NONE = "None";
  public const TEXT_REBUY = "Rebuy";
  public const TEXT_REBUY_COUNT = "RebuyCount";
  public const TEXT_REGISTER = "Register";
  public const TEXT_REGISTER_UNREGISTER = "Register / un-register";
  public const TEXT_REMOVE_ROW = "Remove row";
  public const TEXT_RESET = "Reset";
  public const TEXT_SAVE = "Save";
  public const TEXT_TRUE = "true";
  public const TEXT_UNREGISTER = "Unregister";
  public const TEXT_UPDATE = "Update";
  public const TEXT_VIEW = "View";
  public const TEXT_YES = "Yes";
  public const TYPE_INPUT_BUTTON = "button";
  public const TYPE_INPUT_CHECKBOX = "checkbox";
  public const TYPE_INPUT_HIDDEN = "hidden";
  public const TYPE_INPUT_PASSWORD = "password";
  public const TYPE_INPUT_RESET = "reset";
  public const TYPE_INPUT_SUBMIT = "submit";
  public const TYPE_INPUT_TEXTAREA = "textarea";
  public const TYPE_INPUT_TEXTBOX = "text";
  public const URL = "chipchairprayer.com";
  public const URL_WWW = "www.chipchairprayer.com";
  public const VALUE_DEFAULT_CHECKBOX = "on";
  public const FOLDER_SESSION = "sessions";
  public const FOLDER_MAP = "maps";
  public const PATH_HOME_LOCAL = "C:/Users/n082832/git/ccp/website";
  public const PATH_HOME_SERVER = "/home/chipch5/public_html";
  public static function CONTEXT_ROOT(): string {
    return self::FLAG_LOCAL() ? "/ccp/" : "/new/";
  }
  public static function EMAIL_STAFF(): string {
    return self::FLAG_LOCAL() ? "staff@localhost.com" : "staff@chipchairprayer.com";
  }
  public static function FLAG_LOCAL(): bool {
    return $_SERVER['HTTP_HOST'] == "chipchairprayer.com" || $_SERVER['HTTP_HOST'] == "www.chipchairprayer.com" ? false : true;
  }
  public static function PATH(): string {
    return $_SERVER["HTTP_HOST"] . self::CONTEXT_ROOT();
  }
  public static function PATH_MAP(): string {
    return (self::FLAG_LOCAL() ? "" : self::PATH_HOME_SERVER . self::CONTEXT_ROOT()) . self::FOLDER_MAP;
  }
  public static function PATH_ROOT(): string {
    return (self::FLAG_LOCAL() ? self::PATH_HOME_LOCAL : self::PATH_HOME_SERVER) . self::CONTEXT_ROOT();
  }
  public static function PATH_SESSION(): string {
    return (self::FLAG_LOCAL() ? "" : self::PATH_HOME_SERVER . self::CONTEXT_ROOT()) . self::FOLDER_SESSION;
  }
  public static function SERVER_EMAIL(): string {
    return self::FLAG_LOCAL() ? "localhost" : "ecngx303.inmotionhosting.com";
  }
}
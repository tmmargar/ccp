<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class Constant {
  public static string $ACCESSKEY_ACTIVE                      = "v";
  public static string $ACCESSKEY_ADDON_AMOUNT                = "n";
  public static string $ACCESSKEY_ADDON_CHIP_COUNT            = "t";
  public static string $ACCESSKEY_ADDRESS                     = "a";
  public static string $ACCESSKEY_ADD_ROW                     = "o";
  public static string $ACCESSKEY_APPROVE                     = "a";
  public static string $ACCESSKEY_BODY                        = "b";
  public static string $ACCESSKEY_BONUS_POINTS                = "b";
  public static string $ACCESSKEY_BOUNTY                      = "b";
  public static string $ACCESSKEY_BUYIN_AMOUNT                = "b";
  public static string $ACCESSKEY_CANCEL                      = "a";
  public static string $ACCESSKEY_CHIP_COUNT                  = "c";
  public static string $ACCESSKEY_CITY                        = "c";
  public static string $ACCESSKEY_COMMENT                     = "n";
  public static string $ACCESSKEY_CONFIRM_DELETE              = "l";
  public static string $ACCESSKEY_CONFIRM_PASSWORD            = "c";
  public static string $ACCESSKEY_CREATE                      = "c";
  public static string $ACCESSKEY_DELETE                      = "l";
  public static string $ACCESSKEY_DESCRIPTION                 = "i";
  public static string $ACCESSKEY_EMAIL                       = "e";
  public static string $ACCESSKEY_FIRST_NAME                  = "f";
  public static string $ACCESSKEY_FOOD                        = "f";
  public static string $ACCESSKEY_GAME_TYPE                   = "g";
  public static string $ACCESSKEY_GROUP                       = "o";
  public static string $ACCESSKEY_GO                          = "g";
  public static string $ACCESSKEY_KNOCKOUT_ID                 = "k";
  public static string $ACCESSKEY_LAST_NAME                   = "l";
  public static string $ACCESSKEY_LIMIT_TYPE                  = "l";
  public static string $ACCESSKEY_LOCATION_NAME               = "n";
  public static string $ACCESSKEY_LOGIN                       = "l";
  public static string $ACCESSKEY_MAP                         = "m";
  public static string $ACCESSKEY_MAX_PLAYERS                 = "x";
  public static string $ACCESSKEY_MAX_REBUYS                  = "u";
  public static string $ACCESSKEY_MIN_PLAYERS                 = "x";
  public static string $ACCESSKEY_MODIFY                      = "m";
  public static string $ACCESSKEY_NAME                        = "n";
  public static string $ACCESSKEY_PASSWORD                    = "p";
  public static string $ACCESSKEY_PAYOUT                      = "o";
  public static string $ACCESSKEY_PERCENTAGE                  = "p";
  public static string $ACCESSKEY_PHONE                       = "h";
  public static string $ACCESSKEY_PLACE                       = "p";
  public static string $ACCESSKEY_PLAYER_ID                   = "p";
  public static string $ACCESSKEY_RAKE                        = "k";
  public static string $ACCESSKEY_REBUY_AMOUNT                = "y";
  public static string $ACCESSKEY_REBUY_COUNT                 = "y";
  public static string $ACCESSKEY_REGISTER                    = "r";
  public static string $ACCESSKEY_REJECT                      = "r";
  public static string $ACCESSKEY_REMEMBER_ME                 = "r";
  public static string $ACCESSKEY_RESET                       = "r";
  public static string $ACCESSKEY_REMOVE_ROW                  = "m";
  public static string $ACCESSKEY_SAVE                        = "s";
  public static string $ACCESSKEY_SEASON                      = "s";
  public static string $ACCESSKEY_SIGN_UP                     = "s";
  public static string $ACCESSKEY_SPECIAL_TYPE                = "s";
  public static string $ACCESSKEY_START_TIME                  = "s";
  public static string $ACCESSKEY_STATE                       = "t";
  public static string $ACCESSKEY_SUBJECT                     = "s";
  public static string $ACCESSKEY_TO                          = "t";
  public static string $ACCESSKEY_TOURNAMENT_DATE             = "t";
  public static string $ACCESSKEY_TOURNAMENT_ID               = "t";
  public static string $ACCESSKEY_UNREGISTER                  = "u";
  public static string $ACCESSKEY_USERNAME                    = "u";
  public static string $ACCESSKEY_VIEW                        = "v";
  public static string $ACCESSKEY_ZIP                         = "z";
  public static string $CODE_STATUS_FINISHED                  = "F";
  public static string $CODE_STATUS_PAID                      = "P";
  public static string $CODE_STATUS_REGISTERED                = "R";
  public static string $DELIMITER_DEFAULT                     = ", ";
  public static string $DESCRIPTION_CHAMPIONSHIP              = "Championship";
  public static string $DESCRIPTION_MAIN_EVENT                = "Main Event";
  public static string $DISPLAY_ADDON                         = "+a";
  public static string $DISPLAY_REBUY                         = "+r";
  public static string $FIELD_NAME_EMAIL                      = "email";
  public static string $FIELD_NAME_ID                         = "id";
  public static string $FIELD_NAME_MODE                       = "mode";
  public static string $FIELD_NAME_SUFFIX_CHECKBOX_ALL        = "CheckAll";
  public static string $FIELD_NAME_USER                       = "user";
  public static string $FIELD_NAME_USERNAME                   = "username";
  public static string $FLAG_NO                               = "N";
  public static string $FLAG_YES                              = "Y";
  public static int $FLAG_YES_DATABASE                        = 1;
  public static string $ID_TABLE_DATA                         = "dataTbl";
  public static string $ID_TABLE_INPUT                        = "inputs";
  public static string $INTERVAL_DATE_REGISTRATION_OPEN       = "P14D";
  public static string $MODE_APPROVE                          = "approve";
  public static string $MODE_CONFIRM                          = "confirm";
  public static string $MODE_CREATE                           = "create";
  public static string $MODE_DELETE                           = "delete";
  public static string $MODE_EMAIL                            = "email";
  public static string $MODE_LOGIN                            = "login";
  public static string $MODE_MODIFY                           = "modify";
  public static string $MODE_RESET_PASSWORD                   = "resetPassword";
  public static string $MODE_RESET_PASSWORD_CONFIRM           = "resetPasswordConfirm";
  public static string $MODE_RESET_PASSWORD_REQUEST           = "resetPasswordRequest";
  public static string $MODE_SAVE_CREATE                      = "savecreate";
  public static string $MODE_SAVE_MODIFY                      = "savemodify";
  public static string $MODE_SAVE_PREFIX                      = "save";
  public static string $MODE_SAVE_VIEW                        = "saveview";
  public static string $MODE_SEND_EMAIL                       = "sendEmail";
  public static string $MODE_SIGNUP                           = "signup";
  public static string $NAME_STAFF                            = "CCP Staff";
  public static string $MODE_VIEW                             = "view";
  public static string $NAME_STATUS_NOT_PAID                  = "Not paid";
  public static string $NAME_STATUS_NOT_REGISTERED            = "Not registered";
  public static string $NAME_STATUS_PAID                      = "Paid";
  public static string $NAME_STATUS_REGISTERED                = "Registered";
  public static string $NAME_TIME_ZONE                        = "America/New_York";
  public static string $SYMBOL_CURRENCY_DEFAULT               = "$";
  public static string $SYMBOL_PERCENTAGE_DEFAULT             = "%";
  public static string $TEXT_ADDON                            = "Addon";
  public static string $TEXT_ADD_ROW                          = "Add row";
  public static string $TEXT_APPROVE                          = "Approve";
  public static string $TEXT_BUYIN                            = "Buyin";
  public static string $TEXT_CANCEL                           = "Cancel";
  public static string $TEXT_CONFIRM_DELETE                   = "Confirm delete";
  public static string $TEXT_CREATE                           = "Create";
  public static string $TEXT_DELETE                           = "Delete";
  public static string $TEXT_GO                               = "Go";
  public static string $TEXT_MODIFY                           = "Modify";
  public static string $TEXT_NO                               = "No";
  public static string $TEXT_NONE                             = "None";
  public static string $TEXT_REBUY                            = "Rebuy";
  public static string $TEXT_REBUY_COUNT                      = "RebuyCount";
  public static string $TEXT_REGISTER                         = "Register";
  public static string $TEXT_REGISTER_UNREGISTER              = "Register / un-register";
  public static string $TEXT_REMOVE_ROW                       = "Remove row";
  public static string $TEXT_RESET                            = "Reset";
  public static string $TEXT_SAVE                             = "Save";
  public static string $TEXT_TRUE                             = "true";
  public static string $TEXT_UNREGISTER                       = "Unregister";
  public static string $TEXT_VIEW                             = "View";
  public static string $TEXT_YES                              = "Yes";
  public static string $TYPE_INPUT_BUTTON                     = "button";
  public static string $TYPE_INPUT_CHECKBOX                   = "checkbox";
  public static string $TYPE_INPUT_HIDDEN                     = "hidden";
  public static string $TYPE_INPUT_PASSWORD                   = "password";
  public static string $TYPE_INPUT_RESET                      = "reset";
  public static string $TYPE_INPUT_SUBMIT                     = "submit";
  public static string $TYPE_INPUT_TEXTAREA                   = "textarea";
  public static string $TYPE_INPUT_TEXTBOX                    = "text";
  public static string $VALUE_DEFAULT_CHECKBOX                = "on";
  private static string $FOLDER_SESSION                       = "sessions";
  private static string $FOLDER_MAP                           = "maps";
  private static string $PATH_HOME_SERVER                     = "/home/chipch5/public_html";
  public static function CONTEXT_ROOT() {
    return self::FLAG_LOCAL() ? "/ccp/" : "/new/";
  }
  public static function EMAIL_STAFF() {
    return self::FLAG_LOCAL() ? "staff@localhost.com" : "staff@chipchairprayer.com";
  }
  public static function FLAG_LOCAL() {
    return $_SERVER['HTTP_HOST'] == "chipchairprayer.com" || $_SERVER['HTTP_HOST'] == "www.chipchairprayer.com" ? false : true;
  }
  public static function PATH() {
    return $_SERVER["HTTP_HOST"] . self::CONTEXT_ROOT();
  }
  public static function PATH_MAP() {
    return (self::FLAG_LOCAL() ? "" : self::$PATH_HOME_SERVER . self::CONTEXT_ROOT()) . self::$FOLDER_MAP;
  }
  public static function PATH_SESSION() {
    return (self::FLAG_LOCAL() ? "" : self::$PATH_HOME_SERVER . self::CONTEXT_ROOT()) . self::$FOLDER_SESSION;
  }
  public static function SERVER_EMAIL() {
    //return self::FLAG_LOCAL() ? "localhost" : "secure253.inmotionhosting.com";
    return self::FLAG_LOCAL() ? "localhost" : "ecngx303.inmotionhosting.com";
  }
}
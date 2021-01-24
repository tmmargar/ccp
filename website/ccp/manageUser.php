<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormBase;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
use DateTimeZone;
require_once "init.php";
define("FIRST_NAME_FIELD_LABEL", "First name");
define("LAST_NAME_FIELD_LABEL", "Last name");
define("USERNAME_FIELD_LABEL", "Username");
define("PASSWORD_FIELD_LABEL", "Password");
define("EMAIL_FIELD_LABEL", "Email");
define("ADMINISTRATOR_FIELD_LABEL", "Administrator");
define("ACTIVE_FIELD_LABEL", "Active");
define("REGISTRATION_DATE_FIELD_LABEL", "Registration Date");
define("APPROVAL_DATE_FIELD_LABEL", "Approval Date");
define("APPROVAL_USER_FIELD_LABEL", "Approval User");
define("REJECTION_DATE_FIELD_LABEL", "Rejection Date");
define("REJECTION_USER_FIELD_LABEL", "Rejection User");
define("USER_ID_FIELD_NAME", "userId");
define("FIRST_NAME_FIELD_NAME", "firstName");
define("LAST_NAME_FIELD_NAME", "lastName");
define("USERNAME_FIELD_NAME", "username");
define("PASSWORD_FIELD_NAME", "password");
define("EMAIL_FIELD_NAME", "email");
define("ADMINISTRATOR_FIELD_NAME", "administrator");
define("ACTIVE_FIELD_NAME", "active");
define("REGISTRATION_DATE_FIELD_NAME", "registrationDate");
define("APPROVAL_DATE_FIELD_NAME", "approvalDate");
define("APPROVAL_USER_FIELD_NAME", "approvalUSEr");
define("REJECTION_DATE_FIELD_NAME", "rejectionDate");
define("REJECTION_USER_FIELD_NAME", "rejectionUSEr");
define("SELECTED_ROWS_FIELD_NAME", "userIds");
define("HIDDEN_ROW_FIELD_NAME", "rowUserId");
// define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("DEFAULT_VALUE_USER_ID", "");
define("DEFAULT_VALUE_TEMP_USER_ID", "");
define("DEFAULT_VALUE_FIRST_NAME", "");
define("DEFAULT_VALUE_LAST_NAME", "");
define("DEFAULT_VALUE_USERNAME", "");
define("DEFAULT_VALUE_PASSWORD", "");
define("DEFAULT_VALUE_EMAIL", "");
define("DEFAULT_VALUE_ADMINISTRATOR", "0");
// define("DEFAULT_VALUE_REGISTRATION_DATE", "");
// define("DEFAULT_VALUE_APPROVAL_DATE", "");
// define("DEFAULT_VALUE_APPROVAL_USER", "");
// define("DEFAULT_VALUE_REJECTION_DATE", "");
// define("DEFAULT_VALUE_REJECTION_USER", "");
define("DEFAULT_VALUE_ACTIVE", "0");
define("DEFAULT_VALUE_NUM_ROWS", 20);
$smarty->assign("title", "Manage User");
$smarty->assign("script", "<script src=\"scripts/manageUser.js\" type=\"text/javascript\"></script>");
$smarty->assign("style", "");
$smarty->assign("heading", "Manage User");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : (isset($_GET[Constant::$FIELD_NAME_MODE]) ? $_GET[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW);
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageUser");
$userIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : (isset($_GET[USER_ID_FIELD_NAME]) ? $_GET[USER_ID_FIELD_NAME] : DEFAULT_VALUE_TEMP_USER_ID);
$firstName = isset($_POST[FIRST_NAME_FIELD_NAME . "_"]) ? $_POST[FIRST_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_FIRST_NAME;
$lastName = isset($_POST[LAST_NAME_FIELD_NAME . "_"]) ? $_POST[LAST_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_LAST_NAME;
$username = isset($_POST[USERNAME_FIELD_NAME . "_"]) ? $_POST[USERNAME_FIELD_NAME . "_"] : DEFAULT_VALUE_USERNAME;
$password = isset($_POST[PASSWORD_FIELD_NAME . "_"]) ? $_POST[PASSWORD_FIELD_NAME . "_"] : DEFAULT_VALUE_PASSWORD;
$administrator = isset($_POST[ADMINISTRATOR_FIELD_NAME . "_"]) ? $_POST[ADMINISTRATOR_FIELD_NAME . "_"] : DEFAULT_VALUE_ADMINISTRATOR;
$active = isset($_POST[ACTIVE_FIELD_NAME . "_"]) ? $_POST[ACTIVE_FIELD_NAME . "_"] : DEFAULT_VALUE_ACTIVE;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
$output = "";
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($userIds) : array(0);
  $resultList = $databaseResult->getUserById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $userIds != DEFAULT_VALUE_TEMP_USER_ID)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $userIds);
    while ($ctr < count($ary)) {
      $output = "    <div style=\"float: left; width: 175px; height: 25px;\">" . FIRST_NAME_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_FIRST_NAME, null, false, null, null, null, false, FIRST_NAME_FIELD_NAME . "_" . $ary[$ctr], 30, FIRST_NAME_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getFirstName() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . LAST_NAME_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LAST_NAME, null, false, null, null, null, false, LAST_NAME_FIELD_NAME . "_" . $ary[$ctr], 30, LAST_NAME_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getLastName() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . USERNAME_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOCATION_NAME, null, false, null, null, null, false, USERNAME_FIELD_NAME . "_" . $ary[$ctr], 30, USERNAME_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUsername() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . PASSWORD_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $output .= "     <div id=\"passwordDiv\"" . (Constant::$MODE_MODIFY == $mode ? " style=\"display: none;\"" : "") . ">\n";
      $textBoxPassword = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PASSWORD, "new-password", false, null, null, null, false, PASSWORD_FIELD_NAME . "_" . $ary[$ctr], null, PASSWORD_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_PASSWORD, ((count($resultList) > 0) ? $resultList[$ctr]->getPassword() : ""), null);
      $output .= $textBoxPassword->getHtml();
      $output .= "     </div>\n";
      if (Constant::$MODE_MODIFY == $mode) {
        $output .= "     <div id=\"passwordLinkDiv\">";
        $output .= "      <a href=\"javascript:input.showHideToggle(['passwordLinkDiv', 'passwordDiv']);\">Click to enter new password</a>\n";
        $output .= "     </div>\n";
      }
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . EMAIL_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_EMAIL, null, false, null, null, null, false, EMAIL_FIELD_NAME . "_" . $ary[$ctr], 100, EMAIL_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getEmail() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      if (SessionUtility::getValue(SessionUtility::$OBJECT_NAME_ADMINISTRATOR) == 1) {
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . ADMINISTRATOR_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $checkboxAdministrator = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getAdministrator() ? true : false), null, null, false, ADMINISTRATOR_FIELD_NAME . "_" . $ary[$ctr], null, ADMINISTRATOR_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
        $output .= "        " . $checkboxAdministrator->getHtml();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . ACTIVE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $checkboxActive = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive() ? true : false), null, null, false, ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, Constant::$FLAG_YES_DATABASE, null);
        $output .= "        " . $checkboxActive->getHtml();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      if (Constant::$MODE_MODIFY == $mode) {
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . REGISTRATION_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $registrationDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $resultList[$ctr]->getRegistrationDate(), new DateTimeZone(Constant::$NAME_TIME_ZONE));
        $textRegistrationDate = new FormBase(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, true, REGISTRATION_DATE_FIELD_NAME . "_" . $ary[$ctr], REGISTRATION_DATE_FIELD_NAME . "_" . $ary[$ctr], null, $registrationDateTime->getDisplayFormat());
        $output .= "        " . $textRegistrationDate->getValue();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . APPROVAL_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $approvalDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $resultList[$ctr]->getApprovalDate(), new DateTimeZone(Constant::$NAME_TIME_ZONE));
        $textApprovalDate = new FormBase(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, true, APPROVAL_DATE_FIELD_NAME . "_" . $ary[$ctr], APPROVAL_DATE_FIELD_NAME . "_" . $ary[$ctr], null, $approvalDateTime->getDisplayFormat());
        $output .= "        " . $textApprovalDate->getValue();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . APPROVAL_USER_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $textApprovalUser = new FormBase(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, true, APPROVAL_USER_FIELD_NAME . "_" . $ary[$ctr], APPROVAL_USER_FIELD_NAME . "_" . $ary[$ctr], null, $resultList[$ctr]->getApprovalName());
        $output .= "        " . $textApprovalUser->getValue();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . REJECTION_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $rejectionDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $resultList[$ctr]->getRejectionDate(), new DateTimeZone(Constant::$NAME_TIME_ZONE));
        $textRejectionDate = new FormBase(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, true, REJECTION_DATE_FIELD_NAME . "_" . $ary[$ctr], REJECTION_DATE_FIELD_NAME . "_" . $ary[$ctr], null, $rejectionDateTime->getDisplayFormat());
        $output .= "        " . $textRejectionDate->getValue();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div style=\"float: left; width: 175px; height: 25px;\">" . REJECTION_USER_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n     ";
        $textRejectionUser = new FormBase(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, true, REJECTION_USER_FIELD_NAME . "_" . $ary[$ctr], REJECTION_USER_FIELD_NAME . "_" . $ary[$ctr], null, $resultList[$ctr]->getRejectionName());
        $output .= "        " . $textRejectionUser->getValue();
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $output .= "    <div style=\"float: left;\">\n     ";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $output .= "    <div style==\"clear: both;\"></div>\n";
      $ctr++;
    }
    $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, true, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_RESET, Constant::$TEXT_RESET, null);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
  $output .= $buttonCancel->getHtml();
  $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $userIds, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $userIds);
  $numRows = count($ary);
  $ctr = 0;
  while ($ctr < $numRows) {
    $firstName = isset($_POST[FIRST_NAME_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[FIRST_NAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_FIRST_NAME;
    $lastName = isset($_POST[LAST_NAME_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[LAST_NAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_LAST_NAME;
    $username = isset($_POST[USERNAME_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[USERNAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_USERNAME;
    $password = isset($_POST[PASSWORD_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[PASSWORD_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_PASSWORD;
    $email = isset($_POST[EMAIL_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[EMAIL_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_EMAIL;
    $administrator = isset($_POST[ADMINISTRATOR_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[ADMINISTRATOR_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_ADMINISTRATOR;
    $active = isset($_POST[ACTIVE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[ACTIVE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_ACTIVE;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      // $params = array(null, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, DateTimeUtility::getDateDatabaseFormat(DateTime::createFromFormat(DateTimeUtility::$DATE_FORMAT_PICKER_DISPLAY_DEFAULT, "12/25/2019")), SessionUtility::getValue("userid"), null, null, "1", null, null, null, null, null, null);
//       $params = array(null, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate(null, null)), SessionUtility::getValue("userid"), null, null, $active == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, null, null, null, null, null);
      $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
      $params = array(null, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, $dateTime->getDatabaseFormat(), SessionUtility::getValue("userid"), null, null, isset($active) ? $active : 0, null, null, null);
      $databaseResult->insertUser($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      // $userId = (isset($_POST[USER_ID_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[USER_ID_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_USER_ID;
      $tempUserId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_TEMP_USER_ID;
      $params = array($tempUserId, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, null, null, null, null, isset($active) ? $active : 0, null, null, null, null, null, null);
      $databaseResult->updateUser($params);
    }
    $ctr++;
  }
  $userIds = DEFAULT_VALUE_TEMP_USER_ID;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_TEMP_USER_ID != $userIds) {
      $params = array($userIds);
      $databaseResult->deleteUser($params);
      $userIds = DEFAULT_VALUE_TEMP_USER_ID;
    }
    $mode = Constant::$MODE_VIEW;
  }
  if (Constant::$MODE_VIEW == $mode) {
    $buttonCreate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CREATE, null, false, null, null, null, false, Constant::$TEXT_CREATE, null, Constant::$TEXT_CREATE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CREATE, null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MODIFY, null, false, null, null, null, true, Constant::$TEXT_MODIFY, null, Constant::$TEXT_MODIFY, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_MODIFY, null);
    $output .= $buttonModify->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_DELETE, null, false, null, null, null, false, Constant::$TEXT_CONFIRM_DELETE, null, Constant::$TEXT_CONFIRM_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CONFIRM_DELETE, null);
    $output .= $buttonDelete->getHtml();
    $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
    $output .= $buttonCancel->getHtml();
  }
  $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $userIds, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(true);
  $query = $databaseResult->getUsersAll($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE userId IN (" . $userIds . ")";
  }
  $hideColIndexes = array(3, 8, 11);
//   $output .= HtmlUtility::buildTable($query, $mode, $classNames, $caption, $colFormats, $hiddenId, $selectedColumnVals, $delimiter, $foreignKeys, $html, $headerRow, $showNote, $hiddenAdditional, $hideColIndexes, $colSpan, $tableIdSuffix, $width);
// public function __construct18($caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width) {
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, $hideColIndexes, null, null, null, true, $query, $userIds, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
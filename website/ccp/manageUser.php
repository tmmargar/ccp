<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
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
define("PHONE_FIELD_LABEL", "Phone");
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
define("PHONE_FIELD_NAME", "phone");
define("ADMINISTRATOR_FIELD_NAME", "administrator");
define("ACTIVE_FIELD_NAME", "active");
define("REGISTRATION_DATE_FIELD_NAME", "registrationDate");
define("APPROVAL_DATE_FIELD_NAME", "approvalDate");
define("APPROVAL_USER_FIELD_NAME", "approvalUser");
define("REJECTION_DATE_FIELD_NAME", "rejectionDate");
define("REJECTION_USER_FIELD_NAME", "rejectionUser");
define("DEFAULT_VALUE_ADMINISTRATOR", "0");
define("DEFAULT_VALUE_PHONE", "0");
define("DEFAULT_VALUE_ACTIVE_CREATE", "1");
define("DEFAULT_VALUE_ACTIVE", "0");
define("DEFAULT_VALUE_NUM_ROWS", 20);
$smarty->assign("title", "Manage User");
$smarty->assign("heading", "Manage User");
$smarty->assign("style", "<link href=\"css/manageUser.css\" rel=\"stylesheet\">");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ids = isset($_GET[USER_ID_FIELD_NAME]) ? $_GET[USER_ID_FIELD_NAME] : $ids;
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getUserById(params: $params);
  $output .= " <div class=\"buttons center\">\n";
  $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE . "_2", maxLength: null, name: Constant::$TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
  $output .= $buttonSave->getHtml();
  $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET . "_2", maxLength: null, name: Constant::$TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null, noValidate: true);
  $output .= $buttonReset->getHtml();
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL . "_2", maxLength: null, name: Constant::$TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . FIRST_NAME_FIELD_NAME . "_" . $id . "\">" . FIRST_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_FIRST_NAME, autoComplete: null, autoFocus: true, checked: null, class: null, cols: null, disabled: false, id: FIRST_NAME_FIELD_NAME . "_" . $id, maxLength: 30, name: FIRST_NAME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 25, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getFirstName() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . LAST_NAME_FIELD_NAME . "_" . $id . "\">" . LAST_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_LAST_NAME, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: LAST_NAME_FIELD_NAME . "_" . $id, maxLength: 30, name: LAST_NAME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 25, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getLastName() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . USERNAME_FIELD_NAME . "_" . $id . "\">" . USERNAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_LOCATION_NAME, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: USERNAME_FIELD_NAME . "_" . $id, maxLength: 30, name: USERNAME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 25, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getUsername() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . PASSWORD_FIELD_NAME . "_" . $id . "\">" . PASSWORD_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxPassword = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PASSWORD, autoComplete: "new-password", autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PASSWORD_FIELD_NAME . "_" . $id, maxLength: null, name: PASSWORD_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: false, rows: null, size: 25, suffix: null, type: FormControl::$TYPE_INPUT_PASSWORD, value: "", wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" .
                 "  <div id=\"passwordDiv\"" . (Constant::$MODE_MODIFY == $mode ? " style=\"display: none;\"" : "") . ">" . $textBoxPassword->getHtml() . "</div>\n";
      if (Constant::$MODE_MODIFY == $mode) {
        $output .= " <div id=\"passwordLinkDiv\">";
        $output .=
          "<script type=\"module\">\n" .
          "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
          "  document.querySelector(\"#password_link\").addEventListener(\"click\", (evt) => input.showHideToggle({aryId: ['passwordLinkDiv', 'passwordDiv'], idFocus: '" . PASSWORD_FIELD_NAME . "_" . $id . "'}));\n" .
          "</script>\n";
        $output .= "  <a href=\"#\" id=\"password_link\">Click to enter new password</a>\n";
        $output .= " </div>\n";
      }
      $output .= " </div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . EMAIL_FIELD_NAME . "_" . $id . "\">" . EMAIL_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: EMAIL_FIELD_NAME . "_" . $id, maxLength: 100, name: EMAIL_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 25, suffix: null, type: FormControl::$TYPE_INPUT_EMAIL, value: ((count($resultList) > 0) ? $resultList[$ctr]->getEmail() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxEmail->getHtml() . "</div>";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . PHONE_FIELD_NAME . "_" . $id . "\">" . PHONE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxPhone = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PHONE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PHONE_FIELD_NAME . "_" . $id, maxLength: null, name: PHONE_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 12, suffix: null, type: FormControl::$TYPE_INPUT_TELEPHONE, value: ((count($resultList) > 0) ? $resultList[$ctr]->getPhone()->getValue() == 0 ? "" : $resultList[$ctr]->getPhone()->getValue() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxPhone->getHtml() . "</div>";
      if (SessionUtility::getValue(SessionUtility::$OBJECT_NAME_ADMINISTRATOR) == 1) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . ADMINISTRATOR_FIELD_NAME . "_" . $id . "\">" . ADMINISTRATOR_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $checkboxAdministrator = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: ((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getAdministrator() ? true : false), class: null, cols: null, disabled: false, id: ADMINISTRATOR_FIELD_NAME . "_" . $id, maxLength: null, name: ADMINISTRATOR_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_CHECKBOX, value: (string) Constant::$FLAG_YES_DATABASE, wrap: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $checkboxAdministrator->getHtml() . "</div>";
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . ACTIVE_FIELD_NAME . "_" . $id . "\">" . ACTIVE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $checkboxActive = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: (((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive() || Constant::$MODE_CREATE == $mode) ? true : false), class: null, cols: null, disabled: false, id: ACTIVE_FIELD_NAME . "_" . $id, maxLength: null, name: ACTIVE_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_CHECKBOX, value: (string) Constant::$FLAG_YES_DATABASE, wrap: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $checkboxActive->getHtml() . "</div>";
      }
      if (Constant::$MODE_MODIFY == $mode) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . REGISTRATION_DATE_FIELD_NAME . "_" . $id . "\">" . REGISTRATION_DATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $registrationDateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $resultList[$ctr]->getRegistrationDate());
//         $debug, $class, $disabled, $id, $name, $suffix, $value) {
        $textRegistrationDate = new FormBase(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: true, id: REGISTRATION_DATE_FIELD_NAME . "_" . $id, name: REGISTRATION_DATE_FIELD_NAME . "_" . $id, suffix: null, value: $registrationDateTime->getDisplayFormat());
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textRegistrationDate->getValue() . "</div>";
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . APPROVAL_DATE_FIELD_NAME . "_" . $id . "\">" . APPROVAL_DATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $approvalDateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $resultList[$ctr]->getApprovalDate());
        $textApprovalDate = new FormBase(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: true, id: APPROVAL_DATE_FIELD_NAME . "_" . $id, name: APPROVAL_DATE_FIELD_NAME . "_" . $id, suffix: null, value: $approvalDateTime->getDisplayFormat());
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textApprovalDate->getValue() . "</div>";
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . APPROVAL_USER_FIELD_NAME . "_" . $id . "\">" . APPROVAL_USER_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $textApprovalUser = new FormBase(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: true, id: APPROVAL_USER_FIELD_NAME . "_" . $id, name: APPROVAL_USER_FIELD_NAME . "_" . $id, suffix: null, value: $resultList[$ctr]->getApprovalName());
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textApprovalUser->getValue() . "</div>";
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . REJECTION_DATE_FIELD_NAME . "_" . $id . "\">" . REJECTION_DATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $rejectionDateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $resultList[$ctr]->getRejectionDate());
        $textRejectionDate = new FormBase(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: true, id: REJECTION_DATE_FIELD_NAME . "_" . $id, name: REJECTION_DATE_FIELD_NAME . "_" . $id, suffix: null, value: $rejectionDateTime->getDisplayFormat());
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textRejectionDate->getValue() . "</div>";
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . REJECTION_USER_FIELD_NAME . "_" . $id . "\">" . REJECTION_USER_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $textRejectionUser = new FormBase(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: true, id: REJECTION_USER_FIELD_NAME . "_" . $id, name: REJECTION_USER_FIELD_NAME . "_" . $id, suffix: null, value: $resultList[$ctr]->getRejectionName());
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textRejectionUser->getValue() . "</div>";
      }
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $ctr ++;
    }
    $output .= " <div class=\"buttons center\">\n";
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null, noValidate: true);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $output .= "</div>\n";
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ctr = 0;
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    $firstName = isset($_POST[FIRST_NAME_FIELD_NAME . "_" . $id]) ? $_POST[FIRST_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $lastName = isset($_POST[LAST_NAME_FIELD_NAME . "_" . $id]) ? $_POST[LAST_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $username = isset($_POST[USERNAME_FIELD_NAME . "_" . $id]) ? $_POST[USERNAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $password = isset($_POST[PASSWORD_FIELD_NAME . "_" . $id]) ? $_POST[PASSWORD_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $email = isset($_POST[EMAIL_FIELD_NAME . "_" . $id]) ? $_POST[EMAIL_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $phone = (isset($_POST[PHONE_FIELD_NAME . "_" . $id])) ? preg_replace("/[^0-9]/", "", $_POST[PHONE_FIELD_NAME . "_" . $id]) : DEFAULT_VALUE_PHONE;
    $phone = $phone == "" ? DEFAULT_VALUE_PHONE : $phone;
    $administrator = isset($_POST[ADMINISTRATOR_FIELD_NAME . "_" . $id]) ? $_POST[ADMINISTRATOR_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_ADMINISTRATOR;
    $active = isset($_POST[ACTIVE_FIELD_NAME . "_" . $id]) ? $_POST[ACTIVE_FIELD_NAME . "_" . $id] : (Constant::$MODE_SAVE_CREATE == $mode ? DEFAULT_VALUE_ACTIVE_CREATE : DEFAULT_VALUE_ACTIVE);
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      // $params = array(null, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, DateTimeUtility::getDateDatabaseFormat(DateTime::createFromFormat(DateTimeUtility::$DATE_FORMAT_PICKER_DISPLAY_DEFAULT, "12/25/2019")), SessionUtility::getValue("userid"), null, null, "1", null, null, null, null, null, null);
      // $params = array(null, $firstName, $lastName, $username, $password, $email, $administrator == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, DateTimeUtility::getDateDatabaseFormat(DateTimeUtility::createDate(null, null)), SessionUtility::getValue("userid"), null, null, $active == Constant::$VALUE_DEFAULT_CHECKBOX ? 1 : 0, null, null, null, null, null, null);
      $dateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
      $params = array(null, $firstName, $lastName, $username, $password, $email, $phone, $administrator, $dateTime->getDatabaseFormat(), $dateTime->getDatabaseFormat(), SessionUtility::getValue("userid"), null, null, $active, null, null, null);
      $databaseResult->insertUser(params: $params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      // $userId = (isset($_POST[USER_ID_FIELD_NAME . "_" . $id])) ? $_POST[USER_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $tempUserId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $params = array($tempUserId, $firstName, $lastName, $username, $password, $email, $phone, $administrator, null, null, null, null, null, $active, null, null, null, null, null, null);
      $databaseResult->updateUser(params: $params);
    }
    $ctr ++;
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($ids);
      $databaseResult->deleteUser(params: $params);
      $ids = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::$MODE_VIEW == $mode) {
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CREATE, maxLength: null, name: Constant::$TEXT_CREATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_MODIFY, maxLength: null, name: Constant::$TEXT_MODIFY, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CONFIRM_DELETE, maxLength: null, name: Constant::$TEXT_CONFIRM_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
    $output .= $buttonCancel->getHtml();
  }
  $output .= "</div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(true);
  $query = $databaseResult->getUsersAll($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE userId IN (" . $ids . ")";
  }
  $hideColIndexes = array(3, 8, 9, 11, 12);
  // $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width) {
  $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: null, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
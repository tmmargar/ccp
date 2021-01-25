<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("NOTIFICATION_DESCRIPTION_FIELD_LABEL", "Description");
define("NOTIFICATION_START_DATE_FIELD_LABEL", "Start date");
define("NOTIFICATION_END_DATE_FIELD_LABEL", "End date");
define("NOTIFICATION_ID_FIELD_NAME", "notificaitonId");
define("NOTIFICATION_DESCRIPTION_FIELD_NAME", "notificationDescription");
define("NOTIFICATION_START_DATE_FIELD_NAME", "notificationStartDate");
define("NOTIFICATION_END_DATE_FIELD_NAME", "notificationEndDate");
define("SELECTED_ROWS_FIELD_NAME", "notificationIds");
define("HIDDEN_ROW_FIELD_NAME", "rowNotificationId");
define("DEFAULT_VALUE_NOTIFICATION_IDS", "");
define("DEFAULT_VALUE_NOTIFICATION_ID", "-1");
define("DEFAULT_VALUE_NOTIFICATION_DESCRIPTION", "");
define("DEFAULT_VALUE_NOTIFICATION_START_DATE", "");
define("DEFAULT_VALUE_NOTIFICATION_END_DATE", "");
define("DEFAULT_VALUE_NOTIFICATION_ACTIVE", "0");
$smarty->assign("title", "Chip Chair and a Prayer Manage Notification");
$smarty->assign("script", "<script src=\"scripts/manageNotification.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Notification");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageNotification");
$output = "";
$notificationIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : DEFAULT_VALUE_NOTIFICATION_IDS;
// TODO: determine if suffix needed or not
$suffix = "_" . (isset($notificationIds) ? $notificationIds : "");
$notificationId = isset($_POST[NOTIFICATION_ID_FIELD_NAME . $suffix]) ? $_POST[NOTIFICATION_ID_FIELD_NAME . $suffix] : DEFAULT_VALUE_NOTIFICATION_ID;
$notificationDescription = isset($_POST[NOTIFICATION_DESCRIPTION_FIELD_NAME . $suffix]) ? $_POST[NOTIFICATION_DESCRIPTION_FIELD_NAME . $suffix] : DEFAULT_VALUE_NOTIFICATION_DESCRIPTION;
$notificationStartDate = isset($_POST[NOTIFICATION_START_DATE_FIELD_NAME . $suffix]) ? $_POST[NOTIFICATION_START_DATE_FIELD_NAME . $suffix] : DEFAULT_VALUE_NOTIFICATION_START_DATE;
$notificationEndDate = isset($_POST[NOTIFICATION_END_DATE_FIELD_NAME . $suffix]) ? $_POST[NOTIFICATION_END_DATE_FIELD_NAME . $suffix] : DEFAULT_VALUE_NOTIFICATION_END_DATE;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $databaseResult = new DatabaseResult(true);
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($notificationIds) : array(0);
  $resultList = $databaseResult->getNotificationById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_NOTIFICATION_IDS != $notificationIds)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $notificationIds);
    while ($ctr < count($ary)) {
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . NOTIFICATION_DESCRIPTION_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DESCRIPTION, null, true, null, null, null, false, NOTIFICATION_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr], 200, NOTIFICATION_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . NOTIFICATION_START_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, NOTIFICATION_START_DATE_FIELD_NAME . "_" . $ary[$ctr], 30, NOTIFICATION_START_DATE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getStartDate()->getDisplayDateTimePickerFormat() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . NOTIFICATION_END_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, NOTIFICATION_END_DATE_FIELD_NAME . "_" . $ary[$ctr], 30, NOTIFICATION_END_DATE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getEndDate()->getDisplayDateTimePickerFormat() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $notificationIds, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $notificationStartDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $notificationStartDate);
  $notificationEndDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $notificationEndDate);
  if (Constant::$MODE_SAVE_CREATE == $mode) {
    $params = array($notificationDescription, $notificationStartDateTime->getDatabaseDateTimeFormat(), $notificationEndDateTime->getDatabaseDateTimeFormat());
    $rowCount = $databaseResult->insertNotification($params);
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
  } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
    $ary = explode(Constant::$DELIMITER_DEFAULT, $notificationIds);
    $numRows = count($ary);
    $ctr = 0;
    while ($ctr < $numRows) {
      $notificationId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_NOTIFICATION_ID;
      $notificationDescription = (isset($_POST[NOTIFICATION_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[NOTIFICATION_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_NOTIFICATION_DESCRIPTION;
      $notificationStartDate = isset($_POST[NOTIFICATION_START_DATE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[NOTIFICATION_START_DATE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_NOTIFICATION_START_DATE;
      $notificationEndDate = isset($_POST[NOTIFICATION_END_DATE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[NOTIFICATION_END_DATE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_NOTIFICATION_END_DATE;
      $notificationStartDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $notificationStartDate);
      $notificationEndDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $notificationEndDate);
      $params = array($notificationId, $notificationDescription, $notificationStartDateTime->getDatabaseDateTimeFormat(), $notificationEndDateTime->getDatabaseDateTimeFormat());
      $rowCount = $databaseResult->updateNotification($params);
      if (!is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $ctr++;
    }
    $notificationIds = DEFAULT_VALUE_NOTIFICATION_IDS;
  }
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($notificationIds != DEFAULT_VALUE_NOTIFICATION_IDS) {
      $params = array($notificationIds);
      $rowCount = $databaseResult->deleteNotification($params);
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $notificationIds = DEFAULT_VALUE_NOTIFICATION_IDS;
    }
    $mode = Constant::$MODE_VIEW;
  }
  if (Constant::$MODE_VIEW == $mode) {
    $buttonCreate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CREATE, null, false, null, null, null, false, Constant::$TEXT_CREATE, null, Constant::$TEXT_CREATE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CREATE, null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MODIFY, null, false, null, null, null, true, Constant::$TEXT_MODIFY, null, Constant::$TEXT_MODIFY, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_MODIFY, null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DELETE, null, false, null, null, null, true, Constant::$TEXT_DELETE, null, Constant::$TEXT_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_DELETE, null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_DELETE, null, false, null, null, null, false, Constant::$TEXT_CONFIRM_DELETE, null, Constant::$TEXT_CONFIRM_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CONFIRM_DELETE, null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
    $output .= $buttonDelete->getHtml();
  }
  $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $notificationIds, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(null);
  $query = $databaseResult->getNotification($params, true);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE notificaitonId IN (" . $notificationIds . ")";
  }
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $notificationIds, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
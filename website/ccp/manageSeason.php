<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("SEASON_DESCRIPTION_FIELD_LABEL", "Description");
define("SEASON_START_DATE_FIELD_LABEL", "Start date");
define("SEASON_END_DATE_FIELD_LABEL", "End date");
define("SEASON_ACTIVE_FIELD_LABEL", "Active");
define("SEASON_DESCRIPTION_FIELD_NAME", "seasonDescription");
define("SEASON_START_DATE_FIELD_NAME", "seasonStartDate");
define("SEASON_END_DATE_FIELD_NAME", "seasonEndDate");
define("SEASON_ACTIVE_FIELD_NAME", "seasonActive");
define("DEFAULT_VALUE_SEASON_ACTIVE", "0");
$smarty->assign("title", "Manage Season");
$smarty->assign("heading", "Manage Season");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getSeasonById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_BLANK != $ids)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_DESCRIPTION_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxDescription = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DESCRIPTION, null, true, null, null, null, false, SEASON_DESCRIPTION_FIELD_NAME . "_" . $id, 200, SEASON_DESCRIPTION_FIELD_NAME . "_" . $id, null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), null);
      $output .= $textBoxDescription->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_START_DATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxStartDate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, SEASON_START_DATE_FIELD_NAME . "_" . $id, 30, SEASON_START_DATE_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getStartDate()->getDisplayDatePickerFormat() : ""), null);
      $output .= $textBoxStartDate->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_END_DATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxEndDate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, SEASON_END_DATE_FIELD_NAME . "_" . $id, 30, SEASON_END_DATE_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getEndDate()->getDisplayDatePickerFormat() : ""), null);
      $output .= $textBoxEndDate->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $resultList2 = $databaseResult->getSeasonActiveCount();
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_ACTIVE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $checkboxActive = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive() ? true : false), null, null, (count($resultList) > 0 && $resultList2[0] == 0) || (count($resultList) > 0 && $resultList2[0] != 0 && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive())  ? false : true, SEASON_ACTIVE_FIELD_NAME . "_" . $id, null, SEASON_ACTIVE_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, (string) Constant::$FLAG_YES_DATABASE, null);
      $output .= "        " . $checkboxActive->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    $seasonId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $seasonDescription = (isset($_POST[SEASON_DESCRIPTION_FIELD_NAME . "_" . $id])) ? $_POST[SEASON_DESCRIPTION_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $seasonStartDate = isset($_POST[SEASON_START_DATE_FIELD_NAME . "_" . $id]) ? $_POST[SEASON_START_DATE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $seasonEndDate = isset($_POST[SEASON_END_DATE_FIELD_NAME . "_" . $id]) ? $_POST[SEASON_END_DATE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $seasonActive = isset($_POST[SEASON_ACTIVE_FIELD_NAME . "_" . $id]) ? $_POST[SEASON_ACTIVE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_SEASON_ACTIVE;
    $seasonStartDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonStartDate);
    $seasonEndDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonEndDate);
    $params = array($seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), $seasonId == "" ? null : $seasonId);
    $rowCount = $databaseResult->getSeasonDateCheckCount($params);
    if ($rowCount[0] > 0) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"You must enter a start date (" . $seasonStartDateTime->getDisplayFormat() . ") and end date  (" . $seasonEndDateTime->getDisplayFormat() . ") that do not overlap with an existing season\" ]);\n" . "</script>\n";
    } else {
      if (Constant::$MODE_SAVE_CREATE == $mode) {
        $params = array($seasonDescription, $seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), isset($seasonActive) ? $seasonActive : 0);
        $rowCount = $databaseResult->insertSeason($params);
      } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
          $params = array($seasonId, $seasonDescription, $seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), isset($seasonActive) ? $seasonActive : 0);
          $rowCount = $databaseResult->updateSeason($params);
      }
      if (!is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
    }
    $ids = DEFAULT_VALUE_BLANK;
  }
  $params = array(1);
  $resultList = $databaseResult->getSeasonByActive($params);
  if (count($resultList) > 0) {
    SessionUtility::regenerateAllSessions($resultList[0]);
  }
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($ids != DEFAULT_VALUE_BLANK) {
      $params = array($ids);
      $rowCount = $databaseResult->deleteSeason($params);
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $ids = DEFAULT_VALUE_BLANK;
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(null, true, Constant::$MODE_DELETE == $mode ? false : true);
  $query = $databaseResult->getSeason($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE seasonId IN (" . $ids . ")";
  }
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $ids, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
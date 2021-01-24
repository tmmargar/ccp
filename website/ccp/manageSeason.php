<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("SEASON_DESCRIPTION_FIELD_LABEL", "Description");
define("SEASON_START_DATE_FIELD_LABEL", "Start date");
define("SEASON_END_DATE_FIELD_LABEL", "End date");
define("SEASON_ACTIVE_FIELD_LABEL", "Active");
define("SEASON_ID_FIELD_NAME", "seasonId");
define("SEASON_DESCRIPTION_FIELD_NAME", "seasonDescription");
define("SEASON_START_DATE_FIELD_NAME", "seasonStartDate");
define("SEASON_END_DATE_FIELD_NAME", "seasonEndDate");
define("SEASON_ACTIVE_FIELD_NAME", "seasonActive");
define("SELECTED_ROWS_FIELD_NAME", "seasonIds");
define("HIDDEN_ROW_FIELD_NAME", "rowSeasonId");
define("DEFAULT_VALUE_SEASON_IDS", "");
define("DEFAULT_VALUE_SEASON_ID", "-1");
define("DEFAULT_VALUE_SEASON_DESCRIPTION", "");
define("DEFAULT_VALUE_SEASON_START_DATE", "");
define("DEFAULT_VALUE_SEASON_END_DATE", "");
define("DEFAULT_VALUE_SEASON_ACTIVE", "0");
$smarty->assign("title", "Chip Chair and a Prayer Manage Season");
$smarty->assign("script", "<script src=\"scripts/manageSeason.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Season");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageSeason");
$output = "";
$seasonIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : DEFAULT_VALUE_SEASON_IDS;
// TODO: determine if suffix needed or not
$suffix = "_" . (isset($seasonIds) ? $seasonIds : "");
$seasonId = isset($_POST[SEASON_ID_FIELD_NAME . $suffix]) ? $_POST[SEASON_ID_FIELD_NAME . $suffix] : DEFAULT_VALUE_SEASON_ID;
$seasonDescription = isset($_POST[SEASON_DESCRIPTION_FIELD_NAME . $suffix]) ? $_POST[SEASON_DESCRIPTION_FIELD_NAME . $suffix] : DEFAULT_VALUE_SEASON_DESCRIPTION;
$seasonStartDate = isset($_POST[SEASON_START_DATE_FIELD_NAME . $suffix]) ? $_POST[SEASON_START_DATE_FIELD_NAME . $suffix] : DEFAULT_VALUE_SEASON_START_DATE;
$seasonEndDate = isset($_POST[SEASON_END_DATE_FIELD_NAME . $suffix]) ? $_POST[SEASON_END_DATE_FIELD_NAME . $suffix] : DEFAULT_VALUE_SEASON_END_DATE;
$seasonActive = isset($_POST[SEASON_ACTIVE_FIELD_NAME . $suffix]) ? $_POST[SEASON_ACTIVE_FIELD_NAME . $suffix] : DEFAULT_VALUE_SEASON_ACTIVE;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($seasonIds) : array(0);
  $resultList = $databaseResult->getSeasonById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_SEASON_IDS != $seasonIds)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $seasonIds);
    while ($ctr < count($ary)) {
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_DESCRIPTION_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DESCRIPTION, null, true, null, null, null, false, SEASON_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr], 200, SEASON_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_START_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, SEASON_START_DATE_FIELD_NAME . "_" . $ary[$ctr], 30, SEASON_START_DATE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getStartDate()->getDisplayDatePickerFormat() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_END_DATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, SEASON_END_DATE_FIELD_NAME . "_" . $ary[$ctr], 30, SEASON_END_DATE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getEndDate()->getDisplayDatePickerFormat() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $resultList2 = $databaseResult->getSeasonActiveCount();
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SEASON_ACTIVE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $checkboxActive = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) > 0) && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive() ? true : false), null, null, (count($resultList) > 0 && $resultList2[0] == 0) || (count($resultList) > 0 && $resultList2[0] != 0 && Constant::$FLAG_YES_DATABASE == $resultList[$ctr]->getActive())  ? false : true, SEASON_ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, SEASON_ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, Constant::$FLAG_YES_DATABASE, null);
      $output .= "        " . $checkboxActive->getHtml();
      $output .= "    </div>\n";
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $seasonIds, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $seasonStartDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonStartDate);
  $seasonEndDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonEndDate);
  if (Constant::$MODE_SAVE_CREATE == $mode) {
    $params = array($seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat());
    $rowCount = $databaseResult->getSeasonDateCheckCount($params);
    if ($rowCount[0] > 0) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"You must enter a start date (" . $seasonStartDate . ") and end date  (" . $seasonEndDate . ") that do not overlap with an existing season\" ]);\n" . "</script>\n";
    } else {
      $params = array($seasonDescription, $seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), isset($seasonActive) ? $seasonActive : 0);
      $rowCount = $databaseResult->insertSeason($params);
      if (!is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
    }
  } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
    $ary = explode(Constant::$DELIMITER_DEFAULT, $seasonIds);
    $numRows = count($ary);
    $ctr = 0;
    while ($ctr < $numRows) {
      $params = array($seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]]);
      $rowCount = $databaseResult->getSeasonDateCheckCount($params);
      if ($rowCount[0] > 0) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"You must enter a start date (" . $seasonStartDate . ") and end date  (" . $seasonEndDate . ") that do not overlap with an existing season\" ]);\n" . "</script>\n";
      } else {
        $seasonId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_SEASON_ID;
        $seasonDescription = (isset($_POST[SEASON_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[SEASON_DESCRIPTION_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_SEASON_DESCRIPTION;
        $seasonStartDate = isset($_POST[SEASON_START_DATE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[SEASON_START_DATE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_SEASON_START_DATE;
        $seasonEndDate = isset($_POST[SEASON_END_DATE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[SEASON_END_DATE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_SEASON_END_DATE;
        $seasonActive = isset($_POST[SEASON_ACTIVE_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[SEASON_ACTIVE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_SEASON_ACTIVE;
        $seasonStartDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonStartDate);
        $seasonEndDateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $seasonEndDate);
        $params = array($seasonId, $seasonDescription, $seasonStartDateTime->getDatabaseFormat(), $seasonEndDateTime->getDatabaseFormat(), isset($seasonActive) ? $seasonActive : 0);
        $rowCount = $databaseResult->updateSeason($params);
        if (!is_numeric($rowCount)) {
          $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
        }
      }
      $ctr++;
    }
    $seasonIds = DEFAULT_VALUE_SEASON_IDS;
  }
  $params = array(1);
  $resultList = $databaseResult->getSeasonByActive($params);
//   echo "<br>session active count is " . count($resultList);
  if (count($resultList) > 0) {
//     echo "<br>regenerating all sessions";
    SessionUtility::regenerateAllSessions($resultList[0]);
  }
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($seasonIds != DEFAULT_VALUE_SEASON_IDS) {
      $params = array($seasonIds);
      $rowCount = $databaseResult->deleteSeason($params);
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $seasonIds = DEFAULT_VALUE_SEASON_IDS;
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $seasonIds, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(null, true);
  $query = $databaseResult->getSeason($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE seasonId IN (" . $seasonIds . ")";
  }
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $seasonIds, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
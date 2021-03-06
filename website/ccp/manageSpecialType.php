<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("SPECIAL_TYPE_DESCRIPTION_FIELD_LABEL", "Description");
define("SPECIAL_TYPE_ID_FIELD_NAME", "specialTypeId");
define("SPECIAL_TYPE_DESCRIPTION_FIELD_NAME", "specialTypeDescription");
define("DEFAULT_VALUE_SPECIAL_TYPE_ID", "-1");
$smarty->assign("title", "Manage Special Type");
$smarty->assign("heading", "Manage Special Type");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getSpecialTypeById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_BLANK != $ids)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= "    <div style=\"float: left; width: 140px; height: 25px;\">" . SPECIAL_TYPE_DESCRIPTION_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DESCRIPTION, null, true, null, null, null, false, SPECIAL_TYPE_DESCRIPTION_FIELD_NAME . "_" . $id, 200, SPECIAL_TYPE_DESCRIPTION_FIELD_NAME . "_" . $id, null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), null);
      $output .= $textBoxName->getHtml();
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
    $specialTypeId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_SPECIAL_TYPE_ID;
    $specialTypeDescription = (isset($_POST[SPECIAL_TYPE_DESCRIPTION_FIELD_NAME . "_" . $id])) ? $_POST[SPECIAL_TYPE_DESCRIPTION_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($specialTypeDescription);
      $rowCount = $databaseResult->insertSpecialType($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $params = array($specialTypeId, $specialTypeDescription);
      $rowCount = $databaseResult->updateSpecialType($params);
    }
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
    $ids = DEFAULT_VALUE_BLANK;
  }
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($ids != DEFAULT_VALUE_BLANK) {
      $params = array($ids);
      $rowCount = $databaseResult->deleteSpecialType($params);
      if (!is_numeric($rowCount)) {
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
  $params = array(null, true);
  $query = $databaseResult->getSpecialType($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE typeId IN (" . $ids . ")";
  }
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $ids, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("GROUP_ID_FIELD_NAME", "groupId");
define("GROUP_NAME_FIELD_NAME", "groupName");
define("GROUP_NAME_FIELD_LABEL", "Group name");
define("SELECTED_ROW_FIELD_NAME", "tempGroupId");
define("DEFAULT_VALUE_GROUP_ID", "-1");
$smarty->assign("title", "Manage Group");
$smarty->assign("heading", "Manage Group");
$groupName = isset($_POST[GROUP_NAME_FIELD_NAME . "_"]) ? $_POST[GROUP_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_BLANK;
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ids = isset($_GET[GROUP_ID_FIELD_NAME]) ? $_GET[GROUP_ID_FIELD_NAME] : $ids;
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getGroupById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . GROUP_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textGroupName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_NAME, null, false, null, null, null, false, GROUP_NAME_FIELD_NAME . "_" . $id, 30, GROUP_NAME_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), null);
      $output .= $textGroupName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $ctr ++;
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
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($groupName);
      $databaseResult->insertGroup($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $groupName = (isset($_POST[GROUP_NAME_FIELD_NAME . "_" . $id])) ? $_POST[GROUP_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $tempGroupId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $params = array($groupName, $tempGroupId);
      $databaseResult->updateGroup($params);
    }
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($ids);
      $databaseResult->deleteGroup($params);
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
  $params = array(true);
  $query = $databaseResult->getGroupsAll($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE groupId IN (" . $ids . ")";
  }
  //0$href, 1$paramName, 2/3$paramValue, 4$text
//   $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $link = array(array(1), array("manageGroupPayout.php", array("groupId", "mode"), 1, "modify", 1));
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, $link, true, $query, $ids, null, "30%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
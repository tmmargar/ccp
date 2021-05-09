<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("GROUP_FIELD_LABEL", "Group");
define("PAYOUT_FIELD_LABEL", "Payout");
define("GROUP_ID_FIELD_NAME", "groupId");
define("GROUP_NAME_FIELD_NAME", "groupName");
define("PAYOUT_ID_FIELD_NAME", "payoutId");
define("PAYOUT_NAME_FIELD_NAME", "payoutName");
define("SELECTED_ROW_FIELD_NAME", "tempGroupPayoutId");
define("ORIGINAL_PAYOUT_ID_FIELD_NAME", "payoutIdOriginal");
define("ORIGINAL_GROUP_ID_FIELD_NAME", "groupIdOriginal");
define("DEFAULT_VALUE_GROUP_ID", "-1");
define("DEFAULT_VALUE_PAYOUT_ID", "-1");
$smarty->assign("title", "Manage Group Payout");
$smarty->assign("heading", "Manage Group Payout");
$aryGroupPayoutIds = explode("::", $ids);
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($aryGroupPayoutIds[0], $aryGroupPayoutIds[1]) : array(0, 0);
  $resultList = $databaseResult->getGroupPayoutById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $groupId = isset($_POST[GROUP_ID_FIELD_NAME . "_"]) ? $_POST[GROUP_ID_FIELD_NAME . "_"] : DEFAULT_VALUE_GROUP_ID;
    $payoutId = isset($_POST[PAYOUT_ID_FIELD_NAME . "_"]) ? $_POST[PAYOUT_ID_FIELD_NAME . "_"] : DEFAULT_VALUE_PAYOUT_ID;
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $arySplit = explode("::", $id);
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . GROUP_FIELD_LABEL . ($arySplit[0] != "" ? " " . $arySplit[0] : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getGroupsAll($params);
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left;\">\n";
        $selectGroup = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_GROUP, null, false, GROUP_ID_FIELD_NAME . "_" . $arySplit[0], false, GROUP_ID_FIELD_NAME . "_" . $arySplit[0], null, false, 1, null, null);
        $output .= $selectGroup->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $groupId, null, Constant::$TEXT_NONE, "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $group) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGroup()->getId() : "", null, $group->getName(), $group->getId());
          $output .= $option->getHtml();
        }
        $output .= "        </select>\n";
        $output .= "       </div>\n";
      }
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . PAYOUT_FIELD_LABEL . ($arySplit[0] != "" ? " " . $arySplit[0] : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getPayoutsAll($params); // returns array of Payout objects
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left;\">\n";
        $selectGroup = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PAYOUT, null, false, PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], false, PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], null, false, 1, null, null);
        $output .= $selectGroup->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $payoutId, null, Constant::$TEXT_NONE, "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $payout) {
          //TODO: handle array payout
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getPayouts()[0]->getId() : "", null, $payout->getName(), $payout->getId());
          $output .= $option->getHtml();
        }
        $output .= "        </select>\n";
        $output .= "       </div>\n";
      }
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenOriginalGroupId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0], null, ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getGroup()->getId() : ""), null);
      $output .= $hiddenOriginalGroupId->getHtml();
      $hiddenOriginalPayoutId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], null, ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getPayouts()[0]->getId() : ""), null);
      $output .= $hiddenOriginalPayoutId->getHtml();
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $arySplit[0], null, HIDDEN_ROW_FIELD_NAME . "_" . $arySplit[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getGroup()->getId() . "::" . $resultList[$ctr]->getPayouts()[0]->getId() : ""), null);
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
    $arySplit = explode("::", $id);
    $groupId = (isset($_POST[GROUP_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[GROUP_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_GROUP_ID;
    $payoutId = (isset($_POST[PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_PAYOUT_ID;
    $originalGroupId = (isset($_POST[ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_GROUP_ID;
    $originalPayoutId = (isset($_POST[ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_PAYOUT_ID;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($groupId, $payoutId);
      $databaseResult->insertGroupPayout($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $params = array($groupId, $payoutId, $originalGroupId, $originalPayoutId);
      $databaseResult->updateGroupPayout($params);
    }
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($aryGroupPayoutIds[0], $aryGroupPayoutIds[1]);
      $databaseResult->deleteGroupPayout($params);
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
//   $params = array(null);
  $query = $databaseResult->getGroupPayout($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .=
      " WHERE gp.groupId IN (" . $aryGroupPayoutIds[0] . ")" .
      " AND gp.payoutId IN (" . $aryGroupPayoutIds[1] . ")";
  }
  //0$href, 1$paramName, 2/3$paramValue, 4$text
//   $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $link = array(array(1, 3), array("manageGroup.php", array("groupId", "mode"), 0, "modify", 1), array("managePayout.php", array("payoutId", "mode"), 2, "modify", 3));
  $htmlTable = new HtmlTable(null, null, null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, $link, true, $query, $ids, null, "30%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
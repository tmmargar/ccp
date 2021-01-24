<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("PAYOUT_ID_FIELD_NAME", "payoutId");
define("PAYOUT_NAME_FIELD_NAME", "payoutName");
define("PAYOUT_NAME_FIELD_LABEL", "Payout name");
define("PLACE_FIELD_LABEL", "Place");
define("SELECTED_ROW_FIELD_NAME", "tempPayoutId");
define("PLACE_FIELD_NAME", "place");
define("PERCENTAGE_FIELD_NAME", "percentage");
define("PERCENTAGE_TOTAL_FIELD_NAME", "percentageTotal");
define("SELECTED_ROWS_FIELD_NAME", "payoutIds");
define("HIDDEN_ROW_FIELD_NAME", "rowPayoutId");
define("DEFAULT_VALUE_PAYOUT_ID", "-1");
define("DEFAULT_VALUE_TEMP_PAYOUT_ID", "");
define("DEFAULT_VALUE_PAYOUT_NAME", "");
define("DEFAULT_VALUE_PLACE", "");
define("DEFAULT_VALUE_PERCENTAGE", "");
$smarty->assign("title", "Chip Chair and a Prayer Manage Payout");
$smarty->assign("script", "<script src=\"scripts/managePayout.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Payout");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManagePayoutPayout");
$payoutIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : DEFAULT_VALUE_TEMP_PAYOUT_ID;
$payoutName = isset($_POST[PAYOUT_NAME_FIELD_NAME . "_"]) ? $_POST[PAYOUT_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_PAYOUT_NAME;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
$databaseResult = new DatabaseResult(true);
$output = "";
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($payoutIds) : array(0);
  $resultList = $databaseResult->getPayoutById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $payoutIds != DEFAULT_VALUE_TEMP_PAYOUT_ID)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $payoutIds);
    while ($ctr < count($ary)) {
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . PAYOUT_NAME_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textPayoutName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_NAME, null, false, null, null, null, false, PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr], 30, PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), null);
      $output .= $textPayoutName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . PLACE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textPayoutPlace = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLACE, null, false, null, null, null, false, PLACE_FIELD_NAME . "_" . $ary[$ctr], 2, PLACE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getStructures()->getPlace() : ""), null);
      $output .= $textPayoutPlace->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $payoutIds, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $payoutIds);
  $numRows = count($ary);
  $ctr = 0;
  while ($ctr < $numRows) {
//     $playerId = (isset($_POST[PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr]] : "";
//     print_r($_POST);
//     echo "<BR>act -> " . $active;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($payoutName);
      $databaseResult->insertPayout($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $payoutName = (isset($_POST[PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_PAYOUT_NAME;
      $tempPayoutId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_TEMP_PAYOUT_ID;
      $params = array($payoutName, $tempPayoutId);
//       print_r($params);
      $databaseResult->updatePayout($params);
    }
    $ctr ++;
  }
  $payoutIds = DEFAULT_VALUE_TEMP_PAYOUT_ID;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_TEMP_PAYOUT_ID != $payoutIds) {
      $params = array($payoutIds);
      $databaseResult->deletePayout($params);
      $payoutIds = DEFAULT_VALUE_TEMP_PAYOUT_ID;
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $payoutIds, null);
  $output .= $hiddenSelectedRows->getHtml();
//   $params = array(null);
  $query = $databaseResult->getPayout($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE payoutId IN (" . $payoutIds . ")";
  }
  //p.payoutId, p.payoutName, p.bonusPoints, p.minPlayers, p.maxPlayers, s.place, s.percentage
  $colFormats = array(array(6, "percentage", 0));
//   $hideColIndexes = array(2, 10);
//   $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $htmlTable = new HtmlTable(null, null, null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $payoutIds, null, "60%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
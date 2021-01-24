<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\model\Structure;
use ccp\classes\utility\SessionUtility;
use ccp\classes\model\Payout;
require_once "init.php";
define("PAYOUT_NAME_FIELD_LABEL", "Payout name");
define("BONuS_POINTS_FIELD_LABEL", "Bonus points");
define("MIN_PLAYERS_FIELD_LABEL", "Min players");
define("Max_PLAYERS_FIELD_LABEL", "Max players");
define("PLACE_FIELD_LABEL", "Place");
define("PERCENTAGE_FIELD_LABEL", "Percentage");
define("PAYOUT_ID_FIELD_NAME", "payoutId");
define("PAYOUT_NAME_FIELD_NAME", "payoutName");
define("BONUS_POINTS_FIELD_NAME", "bonusPoints");
define("MIN_PLAYERS_FIELD_NAME", "minPlayers");
define("MAX_PLAYERS_FIELD_NAME", "maxPlayers");
define("PLACE_FIELD_NAME", "place");
define("PERCENTAGE_FIELD_NAME", "percentage");
define("PERCENTAGE_TOTAL_FIELD_NAME", "percentageTotal");
define("SELECTED_ROW_FIELD_NAME", "tempPayoutId");
define("SELECTED_ROWS_FIELD_NAME", "payoutIds");
define("HIDDEN_ROW_FIELD_NAME", "rowPayoutId");
define("DEFAULT_VALUE_PAYOUT_ID", "-1");
define("DEFAULT_VALUE_TEMP_PAYOUT_ID", "");
define("DEFAULT_VALUE_PAYOUT_NAME", "");
define("DEFAULT_VALUE_BONUS_POINTS", "");
define("DEFAULT_VALUE_MIN_PLAYERS", "");
define("DEFAULT_VALUE_MAX_PLAYERS", "");
define("DEFAULT_VALUE_PLACE", "");
define("DEFAULT_VALUE_PERCENTAGE", "");
$smarty->assign("title", "Chip Chair and a Prayer Manage Payout");
$smarty->assign("script", "<script src=\"scripts/managePayout.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Payout");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : (isset($_GET[Constant::$FIELD_NAME_MODE]) ? $_GET[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW);
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManagePayoutPayout");
$payoutIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : (isset($_GET[PAYOUT_ID_FIELD_NAME]) ? $_GET[PAYOUT_ID_FIELD_NAME] : DEFAULT_VALUE_TEMP_PAYOUT_ID);
$payoutName = isset($_POST[PAYOUT_NAME_FIELD_NAME . "_"]) ? $_POST[PAYOUT_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_PAYOUT_NAME;
$bonusPoints = isset($_POST[BONUS_POINTS_FIELD_NAME . "_"]) ? $_POST[BONUS_POINTS_FIELD_NAME . "_"] : DEFAULT_VALUE_BONUS_POINTS;
$minPlayers = isset($_POST[MIN_PLAYERS_FIELD_NAME . "_"]) ? $_POST[MIN_PLAYERS_FIELD_NAME . "_"] : DEFAULT_VALUE_MIN_PLAYERS;
$maxPlayers = isset($_POST[MAX_PLAYERS_FIELD_NAME . "_"]) ? $_POST[MAX_PLAYERS_FIELD_NAME . "_"] : DEFAULT_VALUE_MAX_PLAYERS;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $databaseResult = new DatabaseResult(true);
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
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . BONuS_POINTS_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBonusPoints = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_BONUS_POINTS, null, false, null, null, null, false, BONUS_POINTS_FIELD_NAME . "_" . $ary[$ctr], 2, BONUS_POINTS_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getBonusPoints() : 3), null);
      $output .= $textBonusPoints->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . MIN_PLAYERS_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textMinPlayers = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MIN_PLAYERS, null, false, null, null, null, false, MIN_PLAYERS_FIELD_NAME . "_" . $ary[$ctr], 2, MIN_PLAYERS_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getMinPlayers() : "0"), null);
      $output .= $textMinPlayers->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . MIN_PLAYERS_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textMaxPlayers = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MAX_PLAYERS, null, false, null, null, null, false, MAX_PLAYERS_FIELD_NAME . "_" . $ary[$ctr], 2, MAX_PLAYERS_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getMaxPlayers() : 36), null);
      $output .= $textMaxPlayers->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $percentageTotal = 0;
      $ctr2 = 0;
      $output .= "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"" . Constant::$ID_TABLE_INPUT . "\" style=\"margin: 0;\" width=\"25%\">\n";
      $output .= "     <tbody>\n";
      if (count($resultList) == 0) {
        $payout = new Payout();
        $structure = new Structure();
        $structure->setPlace(1);
        $structure->setPercentage(1);
        $payout->setStructures(array($structure));
        $resultList[0] = $payout;
      }
      foreach ($resultList[$ctr]->getStructures() as $structure) {
        $output .= "      <tr>\n";
        $output .= "       <td class=\"textAlignUnset\">" . PLACE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ":</td>\n";
        $output .= "       <td class=\"textAlignUnset\">\n";
        $textPayoutPlace = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLACE, null, false, null, null, null, true, PLACE_FIELD_NAME . "_" . $ary[$ctr] . "_" . $ctr2, 2, PLACE_FIELD_NAME . "_" . $ary[$ctr] . "_" . $ctr2, null, null, true, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $structure->getPlace() : ""), null);
        $output .= $textPayoutPlace->getHtml();
        $output .= "       </td>\n";
        $output .= "       <td class=\"textAlignUnset\">" . PERCENTAGE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ":</td>\n";
        $output .= "       <td class=\"textAlignUnset\">\n";
        $textPayoutPercentage = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PERCENTAGE, null, false, null, null, null, false, PERCENTAGE_FIELD_NAME . "_" . $ary[$ctr] . "_" . $ctr2, 2, PERCENTAGE_FIELD_NAME . "_" . $ary[$ctr] . "_" . $ctr2, null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $structure->getPercentage() * 100 : ""), null);
        $output .= $textPayoutPercentage->getHtml();
        $output .= "       </td>\n";
        $output .= "      </tr>\n";
        $percentageTotal += $structure->getPercentage() * 100;
        $ctr2++;
      }
      $output .= "      <tr>\n";
      $output .= "       <td class=\"textAlignUnset\"></td>\n";
      $output .= "       <td class=\"textAlignUnset\">\n";
      $textDummy = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, array("hidden"), null, false, "dummy_" . $ary[$ctr] . "_total", 2, "dummy_" . $ary[$ctr] . "_total", null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, null, null);
      $output .= $textDummy->getHtml();
      $output .= "       </td>\n";
      $output .= "       <td class=\"textAlignUnset\">Total " . PERCENTAGE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ":</td>\n";
      $output .= "       <td class=\"textAlignUnset\">\n";
      $textPayoutPercentage = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PERCENTAGE, null, false, null, null, null, true, PERCENTAGE_FIELD_NAME . "Total", 2, PERCENTAGE_FIELD_NAME . "Total", null, null, true, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, $percentageTotal, null);
      $output .= $textPayoutPercentage->getHtml();
      $output .= "       </td>\n";
      $output .= "      </tr>\n";
      $output .= "     </tbody>\n";
      $output .= "    </table>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $ctr++;
    }
    $buttonAddRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADD_ROW, null, false, null, null, null, false, Constant::$TEXT_ADD_ROW, null, Constant::$TEXT_ADD_ROW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_BUTTON, Constant::$TEXT_ADD_ROW, null);
    $output .= $buttonAddRow->getHtml();
    $buttonRemoveRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REMOVE_ROW, null, false, null, null, null, false, Constant::$TEXT_REMOVE_ROW, null, Constant::$TEXT_REMOVE_ROW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_BUTTON, Constant::$TEXT_REMOVE_ROW, null);
    $output .= $buttonRemoveRow->getHtml();
    $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, true, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_RESET, null);
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
    if (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
      $payoutName = (isset($_POST[PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[PAYOUT_NAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_PAYOUT_NAME;
      $bonusPoints = isset($_POST[BONUS_POINTS_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[BONUS_POINTS_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_BONUS_POINTS;
      $minPlayers = isset($_POST[MIN_PLAYERS_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[MIN_PLAYERS_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_MIN_PLAYERS;
      $maxPlayers = isset($_POST[MAX_PLAYERS_FIELD_NAME . "_" . $ary[$ctr]]) ? $_POST[MAX_PLAYERS_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_MAX_PLAYERS;
      if (Constant::$MODE_SAVE_CREATE == $mode) {
        $params = array($payoutName, $bonusPoints, $minPlayers, $maxPlayers);
        $databaseResult->insertPayout($params);
        $resultList = $databaseResult->getPayoutMaxId();
        $tempPayoutId = $resultList[0];
      } else {
        $tempPayoutId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_TEMP_PAYOUT_ID;
      }
      if (Constant::$MODE_SAVE_MODIFY == $mode) {
        $params = array($payoutName, $bonusPoints, $minPlayers, $maxPlayers, $tempPayoutId);
        $databaseResult->updatePayout($params);
        $params = array($tempPayoutId);
        $databaseResult->deleteStructure($params);
      }
      $ctr2 = 0;
      $found = true;
      while ($found) {
        $place = (isset($_POST[PLACE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2])) ? $_POST[PLACE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2] : null;
        $percentage = (isset($_POST[PERCENTAGE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2])) ? $_POST[PERCENTAGE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2] : null;
        if (isset($place) && isset($percentage)) {
          $params = array($tempPayoutId, $place, $percentage / 100);
          $databaseResult->insertStructure($params);
          $ctr2++;
        } else {
          $found = false;
        }
      }
    }
    $ctr++;
  }
  $payoutIds = DEFAULT_VALUE_TEMP_PAYOUT_ID;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_TEMP_PAYOUT_ID != $payoutIds) {
      $params = array($payoutIds);
      $databaseResult->deleteStructure($params);
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
  $params = array(true);
  $query = $databaseResult->getPayoutsAll($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE p.payoutId IN (" . $payoutIds . ")";
  }
  $colFormats = array(array(6, "percentage", 0));
//   $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $htmlTable = new HtmlTable(null, null, null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, null, null, null, null, true, $query, $payoutIds, null, "60%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
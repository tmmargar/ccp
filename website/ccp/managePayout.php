<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\HtmlTable;
use ccp\classes\model\Structure;
use ccp\classes\utility\SessionUtility;
use ccp\classes\model\Payout;
require_once "init.php";
define("PAYOUT_NAME_FIELD_LABEL", "Payout name");
define("BONUS_POINTS_FIELD_LABEL", "Bonus points");
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
define("DEFAULT_VALUE_PAYOUT_ID", "-1");
$smarty->assign("title", "Manage Payout");
$smarty->assign("heading", "Manage Payout");
$smarty->assign("style", "<link href=\"css/managePayout.css\" rel=\"stylesheet\">");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ids = isset($_GET[PAYOUT_ID_FIELD_NAME]) ? $_GET[PAYOUT_ID_FIELD_NAME] : $ids;
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getPayoutById(params: $params);
  $output .= " <div class=\"buttons center\">\n";
  $buttonAddRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADD_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_ADD_ROW . "_2", maxLength: null, name: Constant::$TEXT_ADD_ROW . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_ADD_ROW, wrap: null);
  $output .= $buttonAddRow->getHtml();
  $buttonRemoveRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REMOVE_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_REMOVE_ROW . "_2", maxLength: null, name: Constant::$TEXT_REMOVE_ROW . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_REMOVE_ROW, wrap: null);
  $output .= $buttonRemoveRow->getHtml();
  $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_SAVE . "_2", maxLength: null, name: Constant::$TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
  $output .= $buttonSave->getHtml();
  $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET . "_2", maxLength: null, name: Constant::$TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
  $output .= $buttonReset->getHtml();
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL . "_2", maxLength: null, name: Constant::$TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . PAYOUT_NAME_FIELD_NAME . "_" . $id . "\">" . PAYOUT_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
      $textPayoutName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_NAME, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PAYOUT_NAME_FIELD_NAME . "_" . $id, maxLength: 30, name: PAYOUT_NAME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 30, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textPayoutName->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . BONUS_POINTS_FIELD_NAME . "_" . $id . "\">" . BONUS_POINTS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBonusPoints = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_BONUS_POINTS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: BONUS_POINTS_FIELD_NAME . "_" . $id, maxLength: 2, name: BONUS_POINTS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) ((count($resultList) > 0) ? $resultList[$ctr]->getBonusPoints() : 3), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBonusPoints->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . MIN_PLAYERS_FIELD_NAME . "_" . $id . "\">" . MIN_PLAYERS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textMinPlayers = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MIN_PLAYERS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: MIN_PLAYERS_FIELD_NAME . "_" . $id, maxLength: 2, name: MIN_PLAYERS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) ((count($resultList) > 0) ? $resultList[$ctr]->getMinPlayers() : 0), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textMinPlayers->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . MIN_PLAYERS_FIELD_NAME . "_" . $id . "\">" . MIN_PLAYERS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textMaxPlayers = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MAX_PLAYERS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: MAX_PLAYERS_FIELD_NAME . "_" . $id, maxLength: 2, name: MAX_PLAYERS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) ((count($resultList) > 0) ? $resultList[$ctr]->getMaxPlayers() : 36), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textMaxPlayers->getHtml() . "</div>\n";
      $percentageTotal = 0;
      $ctr2 = 0;
      $output .= " <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"" . Constant::$ID_TABLE_INPUT . "\" style=\"margin: 0;\" width=\"100%\">\n";
      $output .= "  <tbody>\n";
      if (count($resultList) == 0) {
        $structure = new Structure(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, place: 1, percentage : 1);
        $payout = new Payout(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, name: "", bonusPoints: 0, minPlayers: 0, maxPlayers: 0, structures: array($structure));
        $resultList[0] = $payout;
      }
      foreach ($resultList[$ctr]->getStructures() as $structure) {
        $output .= "   <tr>\n";
        $output .= "    <td class=\"textAlignUnset\">" . PLACE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ":</td>\n";
        $output .= "    <td class=\"textAlignUnset\">\n";
        $textPayoutPlace = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PLACE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: PLACE_FIELD_NAME . "_" . $id . "_" . $ctr2, maxLength: 2, name: PLACE_FIELD_NAME . "_" . $id . "_" . $ctr2, onClick: null, placeholder: null, readOnly: true, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) ((count($resultList) > 0) ? $structure->getPlace() : ""), wrap: null);
        $output .= $textPayoutPlace->getHtml();
        $output .= "    </td>\n";
        $output .= "    <td class=\"textAlignUnset\">" . PERCENTAGE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ":</td>\n";
        $output .= "    <td class=\"textAlignUnset\">\n";
        $textPayoutPercentage = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PERCENTAGE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: PERCENTAGE_FIELD_NAME . "_" . $id . "_" . $ctr2, maxLength: 2, name: PERCENTAGE_FIELD_NAME . "_" . $id . "_" . $ctr2, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) ((count($resultList) > 0) ? $structure->getPercentage() * 100 : ""), wrap: null);
        $output .= $textPayoutPercentage->getHtml();
        $output .= "    </td>\n";
        $output .= "   </tr>\n";
        $percentageTotal += $structure->getPercentage() * 100;
        $ctr2 ++;
      }
      $output .= "   <tr>\n";
      $output .= "    <td class=\"textAlignUnset\"></td>\n";
      $output .= "    <td class=\"textAlignUnset\">\n";
      $textDummy = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: array("hidden"), cols: null, disabled: false, id: "dummy_" . $id . "_total", maxLength: 2, name: "dummy_" . $id . "_total", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: null, wrap: null);
      $output .= $textDummy->getHtml();
      $output .= "    </td>\n";
      $output .= "    <td class=\"textAlignUnset\">Total " . PERCENTAGE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ":</td>\n";
      $output .= "    <td class=\"textAlignUnset\">\n";
      $textPayoutPercentage = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PERCENTAGE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: PERCENTAGE_FIELD_NAME . "Total", maxLength: 2, name: PERCENTAGE_FIELD_NAME . "Total", onClick: null, placeholder: null, readOnly: true, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) $percentageTotal, wrap: null);
      $output .= $textPayoutPercentage->getHtml();
      $output .= "    </td>\n";
      $output .= "   </tr>\n";
      $output .= "  </tbody>\n";
      $output .= " </table>\n";
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $ctr++;
    }
    $output .= " <div class=\"buttons center\">\n";
    $buttonAddRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADD_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_ADD_ROW, maxLength: null, name: Constant::$TEXT_ADD_ROW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_ADD_ROW, wrap: null);
    $output .= $buttonAddRow->getHtml();
    $buttonRemoveRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REMOVE_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_REMOVE_ROW, maxLength: null, name: Constant::$TEXT_REMOVE_ROW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_REMOVE_ROW, wrap: null);
    $output .= $buttonRemoveRow->getHtml();
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $output .= "</div>\n";
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    if (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
      $payoutName = (isset($_POST[PAYOUT_NAME_FIELD_NAME . "_" . $id])) ? $_POST[PAYOUT_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $bonusPoints = isset($_POST[BONUS_POINTS_FIELD_NAME . "_" . $id]) ? $_POST[BONUS_POINTS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $minPlayers = isset($_POST[MIN_PLAYERS_FIELD_NAME . "_" . $id]) ? $_POST[MIN_PLAYERS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $maxPlayers = isset($_POST[MAX_PLAYERS_FIELD_NAME . "_" . $id]) ? $_POST[MAX_PLAYERS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      if (Constant::$MODE_SAVE_CREATE == $mode) {
        $params = array($payoutName, $bonusPoints, $minPlayers, $maxPlayers);
        $databaseResult->insertPayout(params: $params);
        $resultList = $databaseResult->getPayoutMaxId();
        $tempPayoutId = $resultList[0];
      } else {
        $tempPayoutId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      }
      if (Constant::$MODE_SAVE_MODIFY == $mode) {
        $params = array($payoutName, $bonusPoints, $minPlayers, $maxPlayers, $tempPayoutId);
        $databaseResult->updatePayout(params: $params);
        $params = array($tempPayoutId);
        $databaseResult->deleteStructure(params: $params);
      }
      $ctr2 = 0;
      $found = true;
      while ($found) {
        $place = (isset($_POST[PLACE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2])) ? $_POST[PLACE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2] : null;
        $percentage = (isset($_POST[PERCENTAGE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2])) ? $_POST[PERCENTAGE_FIELD_NAME . "_" . (Constant::$MODE_SAVE_MODIFY == $mode ? $tempPayoutId : "") . "_" . $ctr2] : null;
        if (isset($place) && isset($percentage)) {
          $params = array($tempPayoutId, $place, $percentage / 100);
          $databaseResult->insertStructure(params: $params);
          $ctr2 ++;
        } else {
          $found = false;
        }
      }
    }
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($ids);
      $databaseResult->deleteStructure(params: $params);
      $databaseResult->deletePayout(params: $params);
      $ids = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::$MODE_VIEW == $mode) {
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CREATE . "_2", maxLength: null, name: Constant::$TEXT_CREATE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG),accessKey:  Constant::$ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_MODIFY . "_2", maxLength: null, name: Constant::$TEXT_MODIFY . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_DELETE . "_2", maxLength: null, name: Constant::$TEXT_DELETE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CONFIRM_DELETE . "_2", maxLength: null, name: Constant::$TEXT_CONFIRM_DELETE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL . "_2", maxLength: null, name: Constant::$TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
    $output .= $buttonDelete->getHtml();
  }
  $output .= "</div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(true);
  $query = $databaseResult->getPayoutsAll($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE p.payoutId IN (" . $ids . ")";
  }
  $colFormats = array(array(6, "percentage", 0));
  // $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
  $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: null, html: null, id: null, link: null, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
  $output .= $htmlTable->getHtml();
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::$MODE_VIEW == $mode) {
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CREATE, maxLength: null, name: Constant::$TEXT_CREATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG),accessKey:  Constant::$ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_MODIFY, maxLength: null, name: Constant::$TEXT_MODIFY, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_DELETE, maxLength: null, name: Constant::$TEXT_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CONFIRM_DELETE, maxLength: null, name: Constant::$TEXT_CONFIRM_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
    $output .= $buttonDelete->getHtml();
  }
  $output .= "</div>\n";
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
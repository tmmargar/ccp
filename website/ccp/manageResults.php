<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Base;
use ccp\classes\model\BooleanString;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
use PDO;
require_once "init.php";
define("TOURNAMENT_ID_FIELD_LABEL", "Tournament");
define("TOURNAMENT_PLAYER_ID_FIELD_LABEL", "Player id");
define("TOURNAMENT_REBUY_FIELD_LABEL", "Rebuy");
define("TOURNAMENT_ADDON_FIELD_LABEL", "Addon");
define("TOURNAMENT_PLACE_FIELD_LABEL", "Place");
define("TOURNAMENT_KNOCKOUT_BY_FIELD_LABEL", "Knockout by");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentId");
define("TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerId");
define("TOURNAMENT_REBUY_FIELD_NAME", "tournamentRebuy");
define("TOURNAMENT_REBUY_COUNT_FIELD_NAME", "tournamentRebuyCount");
define("TOURNAMENT_ADDON_FIELD_NAME", "tournamentAddon");
define("TOURNAMENT_PLACE_FIELD_NAME", "tournamentPlace");
define("TOURNAMENT_KNOCKOUT_BY_FIELD_NAME", "tournamentKnockoutBy");
define("TOURNAMENT_FOOD_FIELD_NAME", "tournamentFood");
define("SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME", "tournamentKnockoutBys");
define("HIDDEN_ROW_TOURNAMENT_PLAYER_ID_FIELD_NAME", "rowTournamentPlayerId");
define("HIDDEN_ROW_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME", "rowTournamentKnockoutBy");
define("MAX_REBUYS_FIELD_NAME", "maxRebuys");
define("ADDON_AMOUNT_FIELD_NAME", "addonAmount");
define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("DEFAULT_VALUE_TOURNAMENT_ID", "0");
define("DEFAULT_VALUE_TOURNAMENT_REBUY_COUNT", 0);
$smarty->assign("title", "Manage Results");
$smarty->assign("heading", "Manage Results");
$smarty->assign("style", "<link href=\"css/manageResults.css\" rel=\"stylesheet\">");
$smarty->assign("jqueryLocalAdditional", "N");
$tournamentKnockoutBys = isset($_POST[SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME]) ? $_POST[SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$tournamentIdString = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
// id::rebuy count::addon amount (100:1:0)
$tournamentIdVals = explode("::", $tournamentIdString);
$tournamentId = $tournamentIdVals[0];
$tournamentPlace = isset($_POST[TOURNAMENT_PLACE_FIELD_NAME]) ? $_POST[TOURNAMENT_PLACE_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$tournamentRebuyCount = isset($_POST[TOURNAMENT_REBUY_FIELD_NAME]) ? $_POST[TOURNAMENT_REBUY_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_REBUY_COUNT;
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = array($tournamentId);
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList2 = $databaseResult->getTournamentById(params: $params, paramsNested: $paramsNested);
  if (count($resultList2) > 0) {
    $maxPlayers = $resultList2[0]->getBuyinsPaid();
    $rebuyFlag = $resultList2[0]->getRebuyAmount() == 0 ? true : false;
    $addonFlag = $resultList2[0]->getAddonAmount() == 0 ? true : false;
    $maxRebuys = $resultList2[0]->getMaxRebuys();
  }
  $orderBy = "";
  if ($mode == Constant::$MODE_CREATE) {
    $orderBy .= " WHERE enteredCount IS NULL AND buyinsPaid > 0 AND t.tournamentId NOT IN (SELECT DISTINCT tournamentId FROM poker_result WHERE place <> 0)";
  } else if ($mode == Constant::$MODE_MODIFY) {
    $orderBy .= " WHERE enteredCount > 0";
  }
  $orderBy .= " ORDER BY t.tournamentDate DESC, t.startTime DESC";
  $params = array($orderBy, false);
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList2 = $databaseResult->getTournament(params: $params, paramsNested: $paramsNested);
  if (count($resultList2) > 0) {
    if ($mode == Constant::$MODE_CREATE) {
      $rowCount = 1;
    } elseif ($mode == Constant::$MODE_MODIFY) {
      $rowCount = count($resultList2);
    }
    $ctr = 0;
    if ($ctr < $rowCount) {
      $output .= " <div class=\"responsive responsive--3cols responsive--collapse\">";
      $output .= "  <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ID_FIELD_NAME . "\">" . TOURNAMENT_ID_FIELD_LABEL . ": </label></div>\n";
      //     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
      $selectTournament = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TOURNAMENT_ID, class: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, multiple: false, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
      $output .= "  <div class=\"responsive-cell responsive-cell-value\">" . $selectTournament->getHtml();
      //     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
      $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_TOURNAMENT_ID);
      $output .= $option->getHtml();
      $cnt = 0;
      while ($cnt < count($resultList2)) {
        $tournament = $resultList2[$cnt];
        if (($tournamentId == $tournament->getId())) {
          $endDateTemp = clone ($tournament->getDate());
          $endDateTemp->getTime()->modify('-1 day');
        }
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $tournamentId . "::" . $tournament->getMaxRebuys() . "::" . $tournament->getAddonAmount(), suffix: null, text: $tournament->getDisplayDetails(), value: $tournament->getId() . "::" . $tournament->getMaxRebuys() . "::" . $tournament->getAddonAmount());
        $output .= $option->getHtml();
        $cnt ++;
      }
      $output .= "   </select>\n";
      $output .= "  </div>\n";
      $output .= "  <div class=\"responsive-cell responsive-cell-button\">\n";
      // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
      $buttonGo = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_GO, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_GO, maxLength: null, name: Constant::$TEXT_GO, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_GO, wrap: null);
      $output .= $buttonGo->getHtml();
      $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
      $output .= $buttonCancel->getHtml();
      $output .= "  </div>\n";
      $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
      $output .= $hiddenMode->getHtml();
      //       $output .= " </div>\n";
      if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
        $output .= " </div>\n";
        $output .= " <div class=\"buttons center\">\n";
        $buttonAddRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADD_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_ADD_ROW . "_2", maxLength: null, name: Constant::$TEXT_ADD_ROW . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_ADD_ROW, wrap: null);
        $output .= $buttonAddRow->getHtml();
        $buttonRemoveRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REMOVE_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_REMOVE_ROW . "_2", maxLength: null, name: Constant::$TEXT_REMOVE_ROW . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_REMOVE_ROW, wrap: null);
        $output .= $buttonRemoveRow->getHtml();
        $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE . "_2", maxLength: null, name: Constant::$TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
        $output .= $buttonSave->getHtml();
        $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET . "_2", maxLength: null, name: Constant::$TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null, noValidate: true);
        $output .= $buttonReset->getHtml();
        $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL . "_2", maxLength: null, name: Constant::$TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
        $output .= $buttonCancel->getHtml();
        $output .= "  </div>\n";
        $params = array(Constant::$MODE_MODIFY == $mode ? $tournamentId : 0, true);
        $query = $databaseResult->getResultFinishedByTournamentId(params: $params);
        $queryResult = $databaseResult->getConnection()->query($query);
        if ($mode == Constant::$MODE_CREATE) {
          $rowCount = 1;
        } elseif ($mode == Constant::$MODE_MODIFY) {
          $rowCount = $queryResult->rowCount();
        }
        $hideColIndexes = array(0, 1, 3, 4, 5, 6, 7, 8, 11, 13, 15, 16, 17);
        $output .= "   <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"" . Constant::$ID_TABLE_INPUT . "\" style=\"margin: 0;\" width=\"100%\">\n";
        $ctrTemp = 0;
        while ($ctrTemp < $rowCount) {
          if ($ctrTemp == 0) {
            $queryTemp = $databaseResult->getResultPaidByTournamentId(params: $params, returnQuery: true);
            $resultTemp = $databaseResult->getConnection()->query($queryTemp);
            $output .= "    <thead>\n";
            $output .= "     <tr>\n";
            for ($idx = 0; $idx < $resultTemp->columnCount(); $idx ++) {
              if (! in_array($idx, $hideColIndexes)) {
                $output .= "      <th>" . ucwords($resultTemp->getColumnMeta($idx)["name"]) . "</th>\n";
              }
            }
            $output .= "     </tr>\n";
            $output .= "    </thead>\n";
            $output .= "    <tbody>\n";
          }
          $row = $queryResult->fetch(PDO::FETCH_BOTH);
          $ctrTemp ++;
          if ($mode == Constant::$MODE_MODIFY) {
            if (0 < strlen($ids)) {
              $ids .= Constant::$DELIMITER_DEFAULT;
            }
            $ids .= $ctrTemp;
          }
          $output .= "     <tr>\n";
          $params = array($tournamentId);
          $resultList7 = $databaseResult->getResultPaidByTournamentId(params: $params, returnQuery: false);
          if (count($resultList7) > 0) {
            $index = 0;
            while ($index < count($resultList7)) {
              $result = $resultList7[$index];
              $aryPlayerInfo[$index] = array($result->getUser()->getId(), $result->getUser()->getName(), $result->getUser()->getId() . "::" . ($result->isRebuyPaid() ? Constant::$FLAG_YES : Constant::$FLAG_NO) . "::" . $result->getRebuyCount() . "::" . ($result->isAddonPaid() ? Constant::$FLAG_YES : Constant::$FLAG_NO));
              $index ++;
            }
          }
          if (count($aryPlayerInfo) > 0) {
            $index = 0;
            $output .= "      <td class=\"center\">\n";
            $selectPlayer = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PLAYER_ID, class: null, disabled: false, id: TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctrTemp, multiple: false, name: TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctrTemp, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
            $output .= $selectPlayer->getHtml();
            $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: DEFAULT_VALUE_BLANK, suffix: null, text: Constant::$TEXT_NONE, value: "");
            $output .= $option->getHtml();
            while ($index < count($aryPlayerInfo)) {
              $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $row !== false && $row[1] == $aryPlayerInfo[$index][0] ? $aryPlayerInfo[$index][2] : "", suffix: null, text: $aryPlayerInfo[$index][1], value: $aryPlayerInfo[$index][2]);
              $output .= $option->getHtml();
              $index ++;
            }
            $output .= "       </select>\n";
            $output .= "      </td>\n";
          }
          $output .= "      <td class=\"center\">\n";
          $booleanString = new BooleanString(value: $row !== false ? $row[8] : "");
          $checkboxRebuy = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: $booleanString->getBoolean(), class: null, cols: null, disabled: $rebuyFlag, id: TOURNAMENT_REBUY_FIELD_NAME . "_" . $ctrTemp, maxLength: null, name: TOURNAMENT_REBUY_FIELD_NAME . "_" . $ctrTemp, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_CHECKBOX, value: null, wrap: null);
          $output .= $checkboxRebuy->getHtml();
          $textBoxRebuyCount = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REBUY_COUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: ($row !== false && 0 == $row[9] ? true : false), id: TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctrTemp, maxLength: 2, name: TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctrTemp, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: $row !== false ? $row[9] : "", wrap: null);
          $output .= $textBoxRebuyCount->getHtml();
          $output .= "      </td>\n";
          $output .= "      <td class=\"center\">\n";
          $booleanString = new BooleanString(value: $row !== false ? $row[10] : "");
          $checkboxAddon = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: $booleanString->getBoolean(), class: null, cols: null, disabled: $addonFlag, id: TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctrTemp, maxLength: null, name: TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctrTemp, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_CHECKBOX, value: Constant::$FLAG_YES, wrap: null);
          $output .= $checkboxAddon->getHtml();
          $output .= "      </td>\n";
          if ($row === false || "" == $row[1]) {
            $player = 0;
          } else {
            $player = $row[1];
          }
          $output .= "      <td class=\"center\">\n";
          $textBoxPlace = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctrTemp, maxLength: 2, name: TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctrTemp, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: (string) (isset($row[12]) ? $row[12] : $maxPlayers), wrap: null);
          $output .= $textBoxPlace->getHtml();
          $output .= "      </td>\n";
          if (count($aryPlayerInfo) > 0) {
            $index = 0;
            $output .= "      <td class=\"center\">\n";
            $selectPlayer = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_KNOCKOUT_ID, class: null, disabled: false, id: TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctrTemp, multiple: false, name: TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctrTemp, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
            $output .= $selectPlayer->getHtml();
            $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $row !== false ? $row[13] : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
            $output .= $option->getHtml();
            while ($index < count($aryPlayerInfo)) {
              $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $row !== false && $row[13] == $aryPlayerInfo[$index][0] ? $aryPlayerInfo[$index][2] : "", suffix: null, text: $aryPlayerInfo[$index][1], value: $aryPlayerInfo[$index][2]);
              $output .= $option->getHtml();
              $index ++;
            }
            $output .= "       </select>\n";
            $output .= "      </td>\n";
          }
          $output .= "     </tr>\n";
        }
        $output .= "    </tbody>\n";
        $output .= "   </table>\n";
        $output .= " <div class=\"buttons center\">\n";
        $buttonAddRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADD_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_ADD_ROW, maxLength: null, name: Constant::$TEXT_ADD_ROW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_ADD_ROW, wrap: null);
        $output .= $buttonAddRow->getHtml();
        $buttonRemoveRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REMOVE_ROW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_REMOVE_ROW, maxLength: null, name: Constant::$TEXT_REMOVE_ROW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_BUTTON, value: Constant::$TEXT_REMOVE_ROW, wrap: null);
        $output .= $buttonRemoveRow->getHtml();
        $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
        $output .= $buttonSave->getHtml();
        $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
        $output .= $buttonReset->getHtml();
        $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
        $output .= $buttonCancel->getHtml();
        $output .= " </div>\n";
      }
    } else {
      $output .= "The tournament selected does not have any entered results to modify.\n";
      $hiddenTournamentId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, maxLength: null, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $tournamentId, wrap: null);
      $output .= $hiddenTournamentId->getHtml();
    }
  } else {
    $output .= "No tournaments found with paid buyins and without any results\n";
    $output .= "<br />\n";
    $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
    $output .= $buttonCancel->getHtml();
  }
  $hiddenSelectedRowsPlayerId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
  $output .= $hiddenSelectedRowsPlayerId->getHtml();
  $hiddenRebuys = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: MAX_REBUYS_FIELD_NAME, maxLength: null, name: MAX_REBUYS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (isset($maxRebuys) ? (string) $maxRebuys : ""), wrap: null);
  $output .= $hiddenRebuys->getHtml();
  $hiddenAddonAmount = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ADDON_AMOUNT_FIELD_NAME, maxLength: null, name: ADDON_AMOUNT_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
  $output .= $hiddenAddonAmount->getHtml();
} elseif ($mode == Constant::$MODE_SAVE_CREATE || $mode == Constant::$MODE_SAVE_MODIFY) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  // clear all rows
  $params = array(null, null, null, Constant::$CODE_STATUS_PAID, 0, "null", $tournamentId); // , $maxPlace);
  $rowCount = $databaseResult->updateResultByTournamentIdAndPlace(params: $params);
  $numRows = count($ary) + 1;
  $ctr = 1;
  while ($ctr < $numRows) {
    if (isset($_POST[TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctr])) {
      // knockout value is id, rebuyPaid, rebuyCount, addonPaid (100::N::0::N)
      $knockout = $_POST[TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctr];
      $aryKnockout = explode("::", $knockout);
      $tournamentTempKnockout = ($aryKnockout[0] == "") ? "null" : $aryKnockout[0];
    } else {
      $tournamentTempKnockout = "null";
    }
    if (isset($_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctr])) {
      // player value is id, rebuyPaid, rebuyCount, addonPaid (100::N::0::N)
      $player = $_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctr];
      $aryPlayer = explode("::", $player);
      $tournamentTempPlayerId = $aryPlayer[0];
    }
    $tournamentRebuyCount = isset($_POST[TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctr]) ? $_POST[TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctr] : DEFAULT_VALUE_TOURNAMENT_REBUY_COUNT;
    if (isset($_POST[TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctr])) {
      $tournamentAddonAmount = $_POST[TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctr];
      if ($tournamentAddonAmount == Constant::$VALUE_DEFAULT_CHECKBOX || $tournamentAddonAmount == Constant::$FLAG_YES) {
        $tournamentAddonAmount = Constant::$FLAG_YES;
      } else {
        $tournamentAddonAmount = Constant::$FLAG_NO;
      }
    } else {
      $tournamentAddonAmount = Constant::$FLAG_NO;
    }
    $tournamentPlace = isset($_POST[TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctr]) ? $_POST[TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctr] : DEFAULT_VALUE_BLANK;
    // registration creates the record so just need to update the record for CREATE
    // instead of a normal INSERT so CREATE AND MODIFY are the same
    $params = array($tournamentRebuyCount, ($tournamentRebuyCount == 0 ? Constant::$FLAG_NO : Constant::$FLAG_YES), $tournamentAddonAmount, Constant::$CODE_STATUS_FINISHED, $tournamentPlace, $tournamentTempKnockout, $tournamentId, $tournamentTempPlayerId);
    $rowCount = $databaseResult->updateResult(params: $params);
    $ctr++;
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_DELETE || $mode == Constant::$MODE_CONFIRM) {
  if ($mode == Constant::$MODE_CONFIRM) {
    if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
      $params = array(0, Constant::$FLAG_NO, Constant::$FLAG_NO, Constant::$CODE_STATUS_PAID, 0, "null", $tournamentId, null);
      $rowCount = $databaseResult->updateResult(params: $params);
      $ids = DEFAULT_VALUE_BLANK;
      // $tournamentPayoutIds = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  $params = array(false);
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList = $databaseResult->getTournamentOrdered(params: $params, paramsNested: $paramsNested);
  if (0 < count($resultList)) {
    $output .= " <div class=\"responsive responsive--3cols responsive--collapse\">";
    $output .= "  <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ID_FIELD_NAME . "\">" . TOURNAMENT_ID_FIELD_LABEL . ": </label></div>\n";
    $selectTournament = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TOURNAMENT_ID, class: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, multiple: false, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
    $output .= "  <div class=\"responsive-cell responsive-cell-value\">" . $selectTournament->getHtml();
    $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $tournamentId, suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_TOURNAMENT_ID);
    $output .= $option->getHtml();
    $cnt = 0;
    while ($cnt < count($resultList)) {
      $tournament = $resultList[$cnt];
      $optionText = $tournament->getDate()->getDisplayFormat();
      $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
      $optionText .= " (" . $tournament->getLocation()->getName() . ")";
      $optionText .= " " . $tournament->getLimitType()->getName();
      $optionText .= " " . $tournament->getGameType()->getName();
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 < $tournament->getAddonAmount() ? "+a" : "");
      $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
      $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . "np/" . $tournament->getBuyinsPaid() . "p";
      $optionText .= "+" . $tournament->getRebuysPaid() . "rp";
      $optionText .= "+" . $tournament->getAddonsPaid() . "ap";
      $optionText .= "/" . $tournament->getEnteredCount() . "ent)";
      $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $tournamentId, suffix: null, text: $optionText, value: $tournament->getId());
      $output .= $option->getHtml();
      $cnt ++;
    }
    $output .= "   </select>\n";
    $output .= "  </div>\n";
    $output .= "  <div class=\"responsive-cell responsive-cell-button\">\n";
    if ($mode == Constant::$MODE_VIEW) {
      $buttonView = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_VIEW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_VIEW, maxLength: null, name: Constant::$TEXT_VIEW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_VIEW, wrap: null);
      $output .= $buttonView->getHtml();
//       $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_MODIFY, maxLength: null, name: Constant::$TEXT_MODIFY, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_MODIFY, wrap: null);
      $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_UPDATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_UPDATE, maxLength: null, name: Constant::$TEXT_UPDATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_UPDATE, wrap: null);
      $output .= $buttonModify->getHtml();
      if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
        $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_DELETE, maxLength: null, name: Constant::$TEXT_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_DELETE, wrap: null);
        $output .= $buttonDelete->getHtml();
      }
      $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CREATE, maxLength: null, name: Constant::$TEXT_CREATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CREATE, wrap: null);
      $output .= $buttonCreate->getHtml();
    }
    if ($mode == Constant::$MODE_DELETE) {
      $buttonConfirmDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CONFIRM_DELETE, maxLength: null, name: Constant::$TEXT_CONFIRM_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CONFIRM_DELETE, wrap: null);
      $output .= $buttonConfirmDelete->getHtml();
      $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null);
      $output .= $buttonCancel->getHtml();
    }
    $output .= "  </div>\n";
    if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_DELETE) {
      $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
      $output .= $hiddenMode->getHtml();
    }
    $hiddenPlayerId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
    $output .= $hiddenPlayerId->getHtml();
    $hiddenKnockout = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $tournamentKnockoutBys, wrap: null);
    $output .= $hiddenKnockout->getHtml();
  }
  $output .= " </div>\n";
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $params = array($tournamentId);
    if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_DELETE) {
      $queryDelete = "";
//       if ($mode == Constant::$MODE_DELETE) {
//         $queryDelete .= " AND playerId IN (" . $ids . ")";
//       }
      $params = array($tournamentId, null, $queryDelete);
      $query = $databaseResult->getResultPaidByTournamentId(params: $params, returnQuery: true);
    }
    $colFormats = array(array(9, "number", 0), array(12, "number", 0));
    $hiddenAdditional = array(array("tournamentPlayerId", 1));
    $hideColIndexes = array(0, 1, 3, 4, 6, 7, 8, 11, 13, 15, 16, 17);
    //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
    $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: $hiddenAdditional, hiddenId: null, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: null, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
    $output .= $htmlTable->getHtml();
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
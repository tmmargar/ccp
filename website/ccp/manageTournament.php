<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TOURNAMENT_DESCRIPTION_FIELD_LABEL", "Description");
define("TOURNAMENT_COMMENT_FIELD_LABEL", "Comment");
define("TOURNAMENT_MAP_FIELD_LABEL", "Map");
define("TOURNAMENT_LIMIT_TYPE_ID_FIELD_LABEL", "Limit type");
define("TOURNAMENT_GAME_TYPE_ID_FIELD_LABEL", "Game type");
define("TOURNAMENT_SPECIAL_TYPE_ID_FIELD_LABEL", "Special type");
define("TOURNAMENT_CHIP_COUNT_FIELD_LABEL", "Chip count");
define("TOURNAMENT_LOCATION_ID_FIELD_LABEL", "Location");
define("TOURNAMENT_DATE_TIME_FIELD_LABEL", "Date / Time");
define("TOURNAMENT_BUYIN_AMOUNT_FIELD_LABEL", "Buyin amount");
define("TOURNAMENT_MAX_PLAYERS_FIELD_LABEL", "Max players");
define("TOURNAMENT_REBUY_AMOUNT_FIELD_LABEL", "Rebuy amount");
define("TOURNAMENT_ADDON_AMOUNT_FIELD_LABEL", "Addon amount");
define("TOURNAMENT_ADDON_CHIP_COUNT_FIELD_LABEL", "Addon chip count");
define("TOURNAMENT_MAX_REBUYS_FIELD_LABEL", "Max rebuys");
define("TOURNAMENT_GROUP_ID_FIELD_LABEL", "Group");
define("TOURNAMENT_RAKE_FIELD_LABEL", "Rake");
define("TOURNAMENT_DESCRIPTION_FIELD_NAME", "tournamentDescription");
define("TOURNAMENT_COMMENT_FIELD_NAME", "tournamentComment");
define("TOURNAMENT_MAP_FIELD_NAME", "tournamentMap");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentName");
define("TOURNAMENT_DESC_FIELD_NAME", "tournamentDescription");
define("TOURNAMENT_DATE_FIELD_NAME", "tournamentDate");
define("TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME", "tournamentLimitTypeId");
define("TOURNAMENT_GAME_TYPE_ID_FIELD_NAME", "tournamentGameTypeId");
define("TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME", "tournamentSpecialTypeId");
define("TOURNAMENT_CHIP_COUNT_FIELD_NAME", "tournamentChipCount");
define("TOURNAMENT_LOCATION_ID_FIELD_NAME", "tournamentLocationId");
define("TOURNAMENT_DATE_TIME_FIELD_NAME", "tournamentStartDateTime");
define("TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME", "tournamentBuyinAmount");
define("TOURNAMENT_MAX_PLAYERS_FIELD_NAME", "tournamentMaxPlayers");
define("TOURNAMENT_MAX_REBUYS_FIELD_NAME", "tournamentRebuys");
define("TOURNAMENT_REBUY_AMOUNT_FIELD_NAME", "tournamentRebuyAmount");
define("TOURNAMENT_ADDON_AMOUNT_FIELD_NAME", "tournamentAddonAmount");
define("TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME", "tournamentAddonChipCount");
define("TOURNAMENT_GROUP_ID_FIELD_NAME", "tournamentGroupId");
define("TOURNAMENT_RAKE_FIELD_NAME", "tournamentRake");
define("TOURNAMENT_RESULTS_EXIST_FIELD_NAME", "tournamentResultsExist");
define("SELECTED_ROWS_TOURNAMENT_LOCATION_ID_FIELD_NAME", "tournamentLocationIds");
define("SELECTED_ROWS_TOURNAMENT_GROUP_ID_FIELD_NAME", "tournamentGroupIds");
define("HIDDEN_ROW_TOURNAMENT_LOCATION_ID_FIELD_NAME", "rowTournamentLocationId");
define("HIDDEN_ROW_TOURNAMENT_GROUP_ID_FIELD_NAME", "rowTournamentGroupId");
define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("DEFAULT_VALUE_TOURNAMENT_ID", "-1");
$smarty->assign("title", "Manage Tournament");
$smarty->assign("heading", "Manage Tournament");
$smarty->assign("style", "<link href=\"css/manageTournament.css\" rel=\"stylesheet\">");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList = $databaseResult->getTournamentById(params: $params, paramsNested: $paramsNested);
  $output .= " <div class=\"buttons center\">\n";
  $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE . "_2", maxLength: null, name: Constant::$TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
  $output .= $buttonSave->getHtml();
  $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET . "_2", maxLength: null, name: Constant::$TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null, noValidate: true);
  $output .= $buttonReset->getHtml();
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL . "_2", maxLength: null, name: Constant::$TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_BLANK != $ids)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_DESCRIPTION_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_DESCRIPTION, autoComplete: null, autoFocus: true, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id, maxLength: 200, name: TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_COMMENT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_COMMENT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id, maxLength: 200, name: TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: false, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getComment() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>";
      // $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_MAP_FIELD_NAME . "_" . $id . "\">Map link " . $id . ": </label></div>\n";
      // $output .= HtmlUtility::buildTextbox(Constant::$ACCESSKEY_MAP, null, false, Base::build(TOURNAMENT_MAP_FIELD_NAME . "_" . $id, null), 255, Base::build(TOURNAMENT_MAP_FIELD_NAME . "_" . $id, null), false, 100, ((count($resultList) > 0) ? $resultList[$ctr]->getDirections() : ""), null);
      $resultList2 = $databaseResult->getLimitType();
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_LIMIT_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
        //     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
        $selectLimitType = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_LIMIT_TYPE, class: null, disabled: false, id: TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id, multiple: false, name: TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectLimitType->getHtml();
        //     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getLimitType()->getId() : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $limitType) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getLimitType()->getId() : "", suffix: null, text: $limitType->getName(), value: $limitType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
      }
      $resultList2 = $databaseResult->getGameType();
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_GAME_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
        $selectLimitType = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_GAME_TYPE, class: null, disabled: false, id: TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id, multiple: false, name: TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectLimitType->getHtml();
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $gameType) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", suffix: null, text: $gameType->getName(), value: $gameType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
      }
      $params = array(null, false, array(true));
      $resultList2 = $databaseResult->getSpecialType($params);
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_SPECIAL_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
        $selectSpecialType = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SPECIAL_TYPE, class: null, disabled: false, id: TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id, multiple: false, name: TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectSpecialType->getHtml();
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $specialType) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getSpecialType()->getId() : "", suffix: null, text: $specialType->getDescription(), value: $specialType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_CHIP_COUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CHIP_COUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id, maxLength: 5, name: TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getChipCount() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# > 0 except Championship)</div>\n";
      $params = array(false, true, true);
      $resultList2 = $databaseResult->getLocation(params: $params);
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_LOCATION_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
        $selectLocation = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_LOCATION_NAME, class: null, disabled: false, id: TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, multiple: false, name: TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectLocation->getHtml();
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getLocation()->getId() : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $location) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getLocation()->getId() : "", suffix: null, text: $location->getName(), value: $location->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_DATE_TIME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_START_TIME, autoComplete: null, autoFocus: false, checked: null, class: array("timePicker"), cols: null, disabled: false, id: TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id, maxLength: 30, name: TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 20, suffix: null, type: FormControl::$TYPE_INPUT_DATE_TIME, value: ((count($resultList) > 0) ? ($resultList[$ctr]->getDateAndTime()->getDisplayDateTimePickerFormat()) : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_BUYIN_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_BUYIN_AMOUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id, maxLength: 4, name: TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) -$resultList[$ctr]->getBuyinAmount() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# > 0 except Championship)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_MAX_PLAYERS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MAX_PLAYERS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id, maxLength: 2, name: TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getMaxPlayers() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# > 0)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_REBUY_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REBUY_AMOUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id, maxLength: 4, name: TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) -$resultList[$ctr]->getRebuyAmount() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# >= 0)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_MAX_REBUYS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MAX_REBUYS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id, maxLength: 2, name: TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getMaxRebuys() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# >= 0)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_ADDON_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADDON_AMOUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id, maxLength: 4, name: TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: (count($resultList) > 0 ? (string) -$resultList[$ctr]->getAddonAmount() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# >= 0)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_ADDON_CHIP_COUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_ADDON_CHIP_COUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id, maxLength: 5, name: TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getAddonChipCount() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# >= 0)</div>\n";
      $resultList2 = $databaseResult->getGroupNameList();
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_GROUP_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
        $selectLocation = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_GROUP, class: null, disabled: false, id: TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, multiple: false, name: TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, onClick:null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectLocation->getHtml();
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $values) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : "", suffix: null, text: $values[1], value: $values[0]);
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_RAKE_FIELD_NAME . "_" . $id . "\">" . TOURNAMENT_RAKE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </label></div>\n";
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RAKE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_RAKE_FIELD_NAME . "_" . $id, maxLength: 4, name: TOURNAMENT_RAKE_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::$TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getRake() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (# 1 to 99 except Championship)</div>\n";
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getLocation()->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $ctr ++;
    }
    $output .= " <div class=\"buttons center\">\n";
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null, noValidate: true);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
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
    $tournamentId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_TOURNAMENT_ID;
    $tournamentDescription = (isset($_POST[TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentComment = (isset($_POST[TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentMap = (isset($_POST[TOURNAMENT_MAP_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_MAP_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentLimitTypeId = (isset($_POST[TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentGameTypeId = (isset($_POST[TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentSpecialTypeId = (isset($_POST[TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentChipCount = (isset($_POST[TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentLocationId = (isset($_POST[TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentDateTime = isset($_POST[TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id]) ? $_POST[TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $aryTournamentDateTime = explode("T", $tournamentDateTime);
    $tournamentDate = $aryTournamentDateTime[0];
    $tournamentStartTime = $aryTournamentDateTime[1];
    $tournamentBuyinAmount = (isset($_POST[TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentMaxPlayers = (isset($_POST[TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentMaxRebuys = (isset($_POST[TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentRebuyAmount = (isset($_POST[TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_TOURNAMENT_REBUYS_AMOUNT;
    $tournamentAddonAmount = (isset($_POST[TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentAddonChipCount = (isset($_POST[TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentGroupId = (isset($_POST[TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id])) ? $tournamentGroupId = $_POST[TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $tournamentRake = (isset($_POST[TOURNAMENT_RAKE_FIELD_NAME . "_" . $id])) ? $_POST[TOURNAMENT_RAKE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $dateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $tournamentDate);
    $dateTimeStart = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $tournamentDate . " " . $tournamentStartTime);
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($tournamentDescription, $tournamentComment, $tournamentLimitTypeId, $tournamentGameTypeId, $tournamentChipCount, $tournamentLocationId, $dateTime, $dateTimeStart, null, $tournamentBuyinAmount, $tournamentMaxPlayers, $tournamentMaxRebuys, $tournamentRebuyAmount, $tournamentAddonAmount, $tournamentAddonChipCount, $tournamentGroupId, (trim($tournamentRake, "%") / 100), $tournamentMap, $tournamentSpecialTypeId);
      $rowCount = $databaseResult->insertTournament(params: $params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $params = array($tournamentId, $tournamentDescription, $tournamentComment, $tournamentLimitTypeId, $tournamentGameTypeId, $tournamentChipCount, $tournamentLocationId, $dateTime, $dateTimeStart, null, $tournamentBuyinAmount, $tournamentMaxPlayers, $tournamentMaxRebuys, $tournamentRebuyAmount, $tournamentAddonAmount, $tournamentAddonChipCount, $tournamentGroupId, ($tournamentRake / 100), $tournamentMap, $tournamentSpecialTypeId);
      $rowCount = $databaseResult->updateTournament(params: $params);
      $params = array($tournamentMaxRebuys == 0 ? 0 : null, $tournamentMaxRebuys == 0 ? Constant::$FLAG_NO : null, $tournamentAddonAmount == 0 ? Constant::$FLAG_NO : null, $tournamentAddonAmount == 0 ? Constant::$FLAG_NO : null, $tournamentId);
      if (isset($params[0]) || isset($params[1]) || isset($params[2]) || isset($params[3])) {
        $rowCount = $databaseResult->updateResultByTournamentId(params: $params);
      }
    }
    if (!is_numeric($rowCount)) {
      $output .=
      "<script type=\"module\">\n" .
      "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
      "  display.showErrors({errors: [ \"" . $rowCount . "\" ]});\n" .
      "</script>\n";
    }
    $ids = DEFAULT_VALUE_BLANK;
    $mode = Constant::$MODE_VIEW;
  }
}
if (Constant::$MODE_MODIFY == $mode || Constant::$MODE_DELETE == $mode) {
  $resultsExist = 0;
  $params = array($ids, false);
  $resultList = $databaseResult->getResultFinishedByTournamentId(params: $params);
  if (count($resultList) > 0) {
    $resultsExist = Constant::$FLAG_YES_DATABASE;
  }
  $hiddenResultsExist = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_RESULTS_EXIST_FIELD_NAME, null, TOURNAMENT_RESULTS_EXIST_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, (string) $resultsExist, null);
  $output .= $hiddenResultsExist->getHtml();
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($ids != DEFAULT_VALUE_BLANK) {
      $params = array($ids);
      $rowCount = $databaseResult->deleteResult(params: $params);
      $rowCount = $databaseResult->deleteTournament(params: $params);
      if (!is_numeric($rowCount)) {
        $output .=
        "<script type=\"module\">\n" .
        "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
        "  display.showErrors({errors: [ \"" . $rowCount . "\" ]});\n" .
        "</script>\n";
      }
      $ids = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::$MODE_VIEW == $mode) {
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CREATE, maxLength: null, name: Constant::$TEXT_CREATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_MODIFY, maxLength: null, name: Constant::$TEXT_MODIFY, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::$TEXT_DELETE, maxLength: null, name: Constant::$TEXT_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_DELETE, wrap: null, noValidate: true);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CONFIRM_DELETE, maxLength: null, name: Constant::$TEXT_CONFIRM_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_CANCEL, maxLength: null, name: Constant::$TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_CANCEL, wrap: null, noValidate: true);
    $output .= $buttonDelete->getHtml();
  }
  $output .= "</div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(null, true);
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $query = $databaseResult->getTournament(params: $params, paramsNested: $paramsNested);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE t.tournamentId IN (" . $ids . ")";
  }
  $colFormats = array(array(19, "time", null), array(21, "number", null), array(22, "number", 0), array(23, "currency", 0), array(24, "number", 0), array(25, "currency", 0), array(26, "currency", 0), array(27, "number", 0), array(30, "percentage", 0));
  $hideColIndexes = array(3, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 20, 28, 31, 32, 33, 34, 35, 36, 37);
  $colSpan = array(array("Game", "Rebuy", "Addon", "Group"), array(6, 24, 26, 29), array(array(8), array(25), array(27), array(30)));
  //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
  $htmlTable = new HtmlTable(caption: null, class: null, colspan: $colSpan, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: null, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
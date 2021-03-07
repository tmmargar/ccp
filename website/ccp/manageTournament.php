<?php
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
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getTournamentById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && DEFAULT_VALUE_BLANK != $ids)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_DESCRIPTION_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DESCRIPTION, null, true, null, null, null, false, TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id, 200, TOURNAMENT_DESCRIPTION_FIELD_NAME . "_" . $id, null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getDescription() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_COMMENT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_COMMENT, null, false, null, null, null, false, TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id, 200, TOURNAMENT_COMMENT_FIELD_NAME . "_" . $id, null, null, false, null, null, 100, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getComment() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      // $output .= " <div style=\"clear: both;\"></div>\n";
      // $output .= " <div style=\"float: left; width: 150px; height: 25px;\">Map link " . $id . ": </div>\n";
      // $output .= " <div style=\"float: left;\">\n ";
      // $output .= HtmlUtility::buildTextbox(Constant::$ACCESSKEY_MAP, null, false, Base::build(TOURNAMENT_MAP_FIELD_NAME . "_" . $id, null), 255, Base::build(TOURNAMENT_MAP_FIELD_NAME . "_" . $id, null), false, 100, ((count($resultList) > 0) ? $resultList[$ctr]->getDirections() : ""), null);
      // $output .= " </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $resultList2 = $databaseResult->getLimitType();
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_LIMIT_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n";
        $selectLimitType = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LIMIT_TYPE, null, false, TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id, false, TOURNAMENT_LIMIT_TYPE_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectLimitType->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getLimitType()->getId() : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $limitType) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getLimitType()->getId() : "", null, $limitType->getName(), $limitType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $resultList2 = $databaseResult->getGameType();
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_GAME_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n";
        $selectLimitType = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_GAME_TYPE, null, false, TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id, false, TOURNAMENT_GAME_TYPE_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectLimitType->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $gameType) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", null, $gameType->getName(), $gameType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $params = array(null, false);
      $resultList2 = $databaseResult->getSpecialType($params);
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_SPECIAL_TYPE_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n";
        $selectSpecialType = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SPECIAL_TYPE, null, false, TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id, false, TOURNAMENT_SPECIAL_TYPE_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectSpecialType->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGameType()->getId() : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $specialType) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getSpecialType()->getId() : "", null, $specialType->getDescription(), $specialType->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_CHIP_COUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CHIP_COUNT, null, false, null, null, null, false, TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id, 5, TOURNAMENT_CHIP_COUNT_FIELD_NAME . "_" . $id, null, null, false, null, null, 5, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getChipCount() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number > 0)\n    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $params = array(false, true, true);
      $resultList2 = $databaseResult->getLocation($params);
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_LOCATION_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n";
        $selectLocation = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOCATION_NAME, null, false, TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, false, TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectLocation->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getLocation()->getId() : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $location) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getLocation()->getId() : "", null, $location->getName(), $location->getId());
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_DATE_TIME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_START_TIME, null, false, null, array("timePicker"), null, false, TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id, 30, TOURNAMENT_DATE_TIME_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? ($resultList[$ctr]->getDate()->getDisplayDatePickerFormat() . " " . $resultList[$ctr]->getStartTime()->getDisplayAmPmFormat()) : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " \n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_BUYIN_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_BUYIN_AMOUNT, null, false, null, null, null, false, TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id, 4, TOURNAMENT_BUYIN_AMOUNT_FIELD_NAME . "_" . $id, null, null, false, null, null, 3, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getBuyinAmount() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number > 0 except Championship)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_MAX_PLAYERS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MAX_PLAYERS, null, false, null, null, null, false, TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id, 2, TOURNAMENT_MAX_PLAYERS_FIELD_NAME . "_" . $id, null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getMaxPlayers() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number > 0)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_REBUY_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REBUY_AMOUNT, null, false, null, null, null, false, TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id, 4, TOURNAMENT_REBUY_AMOUNT_FIELD_NAME . "_" . $id, null, null, false, null, null, 4, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getRebuyAmount() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_MAX_REBUYS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MAX_REBUYS, null, false, null, null, null, false, TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id, 2, TOURNAMENT_MAX_REBUYS_FIELD_NAME . "_" . $id, null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getMaxRebuys() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number >= 0)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_ADDON_AMOUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADDON_AMOUNT, null, false, null, null, null, false, TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id, 4, TOURNAMENT_ADDON_AMOUNT_FIELD_NAME . "_" . $id, null, null, false, null, null, 4, null, FormControl::$TYPE_INPUT_TEXTBOX, (count($resultList) > 0 ? $resultList[$ctr]->getAddonAmount() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_ADDON_CHIP_COUNT_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADDON_CHIP_COUNT, null, false, null, null, null, false, TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id, 5, TOURNAMENT_ADDON_CHIP_COUNT_FIELD_NAME . "_" . $id, null, null, false, null, null, 4, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getAddonChipCount() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number >= 0)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $resultList2 = $databaseResult->getGroupNameList();
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_GROUP_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
        $output .= "    <div style=\"float: left;\">\n";
        $selectLocation = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_GROUP, null, false, TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, false, TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectLocation->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
        $output .= $option->getHtml();
        foreach ($resultList2 as $values) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : "", null, $values[1], $values[0]);
          $output .= $option->getHtml();
        }
        $output .= "     </select>\n";
        $output .= "    </div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $output .= "    <div style=\"float: left; width: 150px; height: 25px;\">" . TOURNAMENT_RAKE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RAKE, null, false, null, null, null, false, TOURNAMENT_RAKE_FIELD_NAME . "_" . $id, 4, TOURNAMENT_RAKE_FIELD_NAME . "_" . $id, null, null, false, null, null, 4, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getRake() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= " (number from 0 to 99)\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_TOURNAMENT_LOCATION_ID_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getLocation()->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_TOURNAMENT_GROUP_ID_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getGroupPayout()->getGroup()->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
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
    $aryTournamentDateTime = explode(" ", $tournamentDateTime);
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
    $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournamentDate);
    $dateTimeStart = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournamentDate . " " . $tournamentStartTime);
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($tournamentDescription, $tournamentComment, $tournamentLimitTypeId, $tournamentGameTypeId, $tournamentChipCount, $tournamentLocationId, $dateTime, $dateTimeStart, null, $tournamentBuyinAmount, $tournamentMaxPlayers, $tournamentMaxRebuys, $tournamentRebuyAmount, $tournamentAddonAmount, $tournamentAddonChipCount, $tournamentGroupId, (trim($tournamentRake, "%") / 100), $tournamentMap, $tournamentSpecialTypeId);
      $rowCount = $databaseResult->insertTournament($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $params = array($tournamentId, $tournamentDescription, $tournamentComment, $tournamentLimitTypeId, $tournamentGameTypeId, $tournamentChipCount, $tournamentLocationId, $dateTime, $dateTimeStart, null, $tournamentBuyinAmount, $tournamentMaxPlayers, $tournamentMaxRebuys, $tournamentRebuyAmount, $tournamentAddonAmount, $tournamentAddonChipCount, $tournamentGroupId, ($tournamentRake / 100), $tournamentMap, $tournamentSpecialTypeId);
      $rowCount = $databaseResult->updateTournament($params);
      $params = array($tournamentMaxRebuys == 0 ? 0 : null, $tournamentMaxRebuys == 0 ? Constant::$FLAG_NO : null, $tournamentAddonAmount == 0 ? Constant::$FLAG_NO : null, $tournamentAddonAmount == 0 ? Constant::$FLAG_NO : null, $tournamentId);
      if (isset($params[0]) || isset($params[1]) || isset($params[2]) || isset($params[3])) {
        $rowCount = $databaseResult->updateResultByTournamentId($params);
      }
    }
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
    $ids = DEFAULT_VALUE_BLANK;
    $mode = Constant::$MODE_VIEW;
  }
}
if (Constant::$MODE_MODIFY == $mode || Constant::$MODE_DELETE == $mode) {
  $resultsExist = 0;
  $params = array($ids, false);
  $resultList = $databaseResult->getResultFinishedByTournamentId($params);
  if (count($resultList) > 0) {
    $resultsExist = Constant::$FLAG_YES_DATABASE;
  }
  $hiddenResultsExist = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_RESULTS_EXIST_FIELD_NAME, null, TOURNAMENT_RESULTS_EXIST_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $resultsExist, null);
  $output .= $hiddenResultsExist->getHtml();
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if ($ids != DEFAULT_VALUE_BLANK) {
      $params = array($ids);
      $rowCount = $databaseResult->deleteResultBounty($params);
      $rowCount = $databaseResult->deleteResult($params);
      $rowCount = $databaseResult->deleteTournamentBountyByTournamentId($params);
      $rowCount = $databaseResult->deleteTournament($params);
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
  $query = $databaseResult->getTournament($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE t.tournamentId IN (" . $ids . ")";
  }
  $colFormats = array(array(19, "time", null), array(21, "number", null), array(22, "number", 0), array(23, "currency", 0), array(24, "number", 0), array(25, "currency", 0), array(26, "currency", 0), array(27, "number", 0), array(30, "percentage", 0));
  $hideColIndexes = array(3, 5, 7, 9, 10, 11, 12, 13, 14, 15, 16, 20, 28, 31, 32, 33, 34, 35, 36, 37);
  $colSpan = array(array("Game", "Rebuy", "Addon", "Group"), array(6, 24, 26, 29), array(array(8), array(25), array(27), array(30)));
  $htmlTable = new HtmlTable(null, null, $colSpan, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, $hideColIndexes, null, null, null, true, $query, $ids, null, "100%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
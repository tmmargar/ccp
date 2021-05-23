<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TOURNAMENT_ID_FIELD_LABEL", "Tournament id");
define("TOURNAMENT_PLAYER_ID_FIELD_LABEL", "Player id");
define("TOURNAMENT_PLACE_FIELD_LABEL", "Place");
define("TOURNAMENT_KNOCKOUT_BY_FIELD_LABEL", "Knockout by");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentId");
define("TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerId");
define("TOURNAMENT_PLACE_FIELD_NAME", "tournamentPlace");
define("TOURNAMENT_KNOCKOUT_BY_FIELD_NAME", "tournamentKnockoutBy");
define("TOURNAMENT_PLAYER_NAME_FIELD_NAME", "tournamentPlayerName");
define("TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME", "tournamentKnockoutByName");
$smarty->assign("title", "Manage Results During");
$smarty->assign("heading", "Manage Results During");
if ($mode == Constant::$MODE_SAVE_VIEW) {
  $output .= "<script type=\"text/javascript\">\n aryErrors = [];\n aryMessages = [];\n";
  $tournamentId = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $playerId = isset($_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $playerIdTemp = isset($_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp"]) ? $_POST[TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp"] : DEFAULT_VALUE_BLANK;
  $place = isset($_POST[TOURNAMENT_PLACE_FIELD_NAME]) ? $_POST[TOURNAMENT_PLACE_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $knockoutId = isset($_POST[TOURNAMENT_KNOCKOUT_BY_FIELD_NAME]) ? $_POST[TOURNAMENT_KNOCKOUT_BY_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $playerName = isset($_POST[TOURNAMENT_PLAYER_NAME_FIELD_NAME]) ? $_POST[TOURNAMENT_PLAYER_NAME_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $playerNameTemp = isset($_POST[TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp"]) ? $_POST[TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp"] : DEFAULT_VALUE_BLANK;
  $knockoutName = isset($_POST[TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME]) ? $_POST[TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME] : DEFAULT_VALUE_BLANK;
  $bountyA = isset($_POST["bountyA"]) ? $_POST["bountyA"] : null;
  $bountyAName = isset($_POST["bountyAName"]) ? $_POST["bountyAName"] : null;
  $bountyB = isset($_POST["bountyB"]) ? $_POST["bountyB"] : null;
  $bountyBName = isset($_POST["bountyBName"]) ? $_POST["bountyBName"] : null;
  if (isset($bountyA)) {
    $params = array($tournamentId, 1, $bountyA);
    $databaseResult->insertTournamentBounty(params: $params);
    $output .= "  aryMessages.push(\"Bounty A is " . $bountyAName . "\");\n";
  }
  if (isset($bountyB)) {
    $params = array($tournamentId, 2, $bountyB);
    $databaseResult->insertTournamentBounty(params: $params);
    $output .= "  aryMessages.push(\"Bounty B is " . $bountyBName . "\");\n";
  }
  if (isset($playerId)) {
    $params = array(Constant::$CODE_STATUS_FINISHED, $place, $knockoutId, $tournamentId, $playerId);
    $databaseResult->updateResultDuring(params: $params);
    $output .= "  aryMessages.push(\"" . $playerName . " finished #" . $place;
    if (1 < $place) {
      $output .= " and was knocked out by " . $knockoutName . "\");\n";
    }
    if (2 == $place) {
      $params = array(Constant::$CODE_STATUS_FINISHED, 1, "null", $tournamentId, $playerIdTemp);
      $databaseResult->updateResultDuring(params: $params);
      $output .= "  aryMessages.push(\"" . $playerNameTemp . " finished #1\");\n";
    }
  }
  $output .= "  if (aryErrors.length > 0) {display.showErrors(aryErrors);}\n";
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
}
$resultList = $databaseResult->getTournamentDuring();
if (count($resultList) > 0) {
  $tournamentId = $resultList[0];
  $totalPlayers = $resultList[4];
  $params = array($tournamentId);
  $resultList2 = $databaseResult->getResultDuring(params: $params);
  if (count($resultList2) > 0) {
    $place = $resultList2[0];
  }
  $params = array($tournamentId, $place);
  $resultList2 = $databaseResult->getResultLastEnteredDuring(params: $params);
  if (count($resultList2) > 0) {
    $lastEnteredName = $resultList2[1];
  }
  if ($place != 1) {
    $output .= "    <div style=\"float: left; width: 150px;\">" . TOURNAMENT_ID_FIELD_LABEL . ":</div>\n";
    $output .= "    <div style=\"float: left;\">" . $resultList[0] . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= "    <div style=\"float: left; width: 150px;\">Date:</div>\n";
    $output .= "    <div style=\"float: left;\">" . $resultList[1]->getDisplayFormat() . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= "    <div style=\"float: left; width: 150px;\">Time:</div>\n";
    $output .= "    <div style=\"float: left;\">" . $resultList[2]->getDisplayAmPmFormat() . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= "    <div style=\"float: left; width: 150px;\">Location:</div>\n";
    $output .= "    <div style=\"float: left;\">" . $resultList[3] . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= "    <div style=\"float: left; width: 150px;\">Total paid:</div>\n";
    $output .= "    <div style=\"float: left;\">" . $resultList[4] . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= "    <div style=\"float: left; width: 150px;\">Last player entered:</div>\n";
    $output .= "    <div style=\"float: left;\">" . ($place > 0 ? $lastEnteredName : "None") . "</div>\n";
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $totalPlayers = $resultList[4];
    if ($place == 0) {
      $place = $totalPlayers;
    } else if ($place <= $totalPlayers) {
      $place -= 1;
    }
    $params = array($tournamentId);
    $resultList2 = $databaseResult->getResultPaidNotEnteredByTournamentId(params: $params);
    if (count($resultList2) > 0) {
      $index = 0;
      while ($index < count($resultList2)) {
        $result = $resultList2[$index];
        $aryPlayerInfo[$index] = array($result->getUser()->getId(), $result->getUser()->getName(), $result->getUser()->getId() . "::" . ($result->isRebuyPaid() ? Constant::$FLAG_YES : Constant::$FLAG_NO) . "::" . $result->getRebuyCount() . "::" . ($result->isAddonPaid() ? Constant::$FLAG_YES : Constant::$FLAG_NO));
        $index ++;
      }
    }
    if (isset($aryPlayerInfo) && count($aryPlayerInfo) > 0) {
      $output .= "    <div style=\"float: left; width: 100px;\">" . TOURNAMENT_PLAYER_ID_FIELD_LABEL . ":</div>\n";
      $output .= "    <div style=\"float: left;\">\n";
      $selectPlayer = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_PLAYER_ID, class: null, disabled: false, id: TOURNAMENT_PLAYER_ID_FIELD_NAME, multiple: false, name: TOURNAMENT_PLAYER_ID_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
      $output .= $selectPlayer->getHtml();
      $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: DEFAULT_VALUE_BLANK, suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
      $output .= $option->getHtml();
      $index = 0;
      while ($index < count($aryPlayerInfo)) {
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: null, suffix: null, text: $aryPlayerInfo[$index][1], value: $aryPlayerInfo[$index][0]);
        $output .= $option->getHtml();
        $index ++;
      }
      $output .= "     </select>\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 100px;\">" . TOURNAMENT_KNOCKOUT_BY_FIELD_LABEL . ":</div>\n";
      $output .= "    <div style=\"float: left;\">\n";
      $selectPlayer = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_KNOCKOUT_ID, class: null, disabled: false, id: TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, multiple: false, name: TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
      $output .= $selectPlayer->getHtml();
      $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: DEFAULT_VALUE_BLANK, suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_BLANK);
      $output .= $option->getHtml();
      $index = 0;
      while ($index < count($aryPlayerInfo)) {
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: null, suffix: null, text: $aryPlayerInfo[$index][1], value: $aryPlayerInfo[$index][0]);
        $output .= $option->getHtml();
        $index ++;
      }
      $output .= "     </select>\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 100px;\">" . TOURNAMENT_PLACE_FIELD_LABEL . ":</div>\n";
      $output .= "    <div style=\"float: left;\">" . $place . "\n</div>\n";
      $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    }
    $hiddenPlace = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_PLACE_FIELD_NAME, maxLength: null, name: TOURNAMENT_PLACE_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (string) $place, wrap: null);
    $output .= $hiddenPlace->getHtml();
    $hiddenPlayerName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_PLAYER_NAME_FIELD_NAME, maxLength: null, name: TOURNAMENT_PLAYER_NAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenPlayerName->getHtml();
    $hiddenKnockout = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME, maxLength: null, name: TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenKnockout->getHtml();
    $hiddenPlayerId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp", maxLength: null, name: TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenPlayerId->getHtml();
    $hiddenPlayerNameTemp = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp", maxLength: null, name: TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenPlayerNameTemp->getHtml();
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
    $output .= $buttonReset->getHtml();
    $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
    $output .= $hiddenMode->getHtml();
    $hiddenTournamentId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, maxLength: null, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (string) $tournamentId, wrap: null);
    $output .= $hiddenTournamentId->getHtml();
  } else {
    $output .= "No tournaments found without results for today\n";
  }
} else {
  $output .= "No tournaments found with paid buyins for today\n";
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
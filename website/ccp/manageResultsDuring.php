<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
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
    $databaseResult->insertTournamentBounty($params);
    $output .= "Bounty A is " . $bountyAName . "<br />\n";
  }
  if (isset($bountyB)) {
    $params = array($tournamentId, 2, $bountyB);
    $databaseResult->insertTournamentBounty($params);
    $output .= "Bounty B is " . $bountyBName;
  }
  if (isset($playerId)) {
    $params = array(Constant::$CODE_STATUS_FINISHED, $place, $knockoutId, $tournamentId, $playerId);
    $databaseResult->updateResultDuring($params);
    $output .= $playerName . " finished #" . $place;
    if (1 < $place) {
      $output .= " and was knocked out by " . $knockoutName;
    }
    if (2 == $place) {
      $params = array(Constant::$CODE_STATUS_FINISHED, 1, "null", $tournamentId, $playerIdTemp);
      $databaseResult->updateResultDuring($params);
      $output .= " <br /> " . $playerNameTemp . " finished #1";
    }
  }
  $output .= "</strong>\n</span>\n<br />\n";
}
$resultList = $databaseResult->getTournamentDuring();
if (count($resultList) > 0) {
  $tournamentId = $resultList[0];
  $totalPlayers = $resultList[4];
  $params = array($tournamentId);
  $resultList2 = $databaseResult->getResultDuring($params);
  if (count($resultList2) > 0) {
    $place = $resultList2[0];
  }
  $params = array($tournamentId, $place);
  $resultList2 = $databaseResult->getResultLastEnteredDuring($params);
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
    $params = array(
      $tournamentId);
    $resultList2 = $databaseResult->getResultPaidNotEnteredByTournamentId($params, false);
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
      $selectPlayer = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLAYER_ID, null, false, TOURNAMENT_PLAYER_ID_FIELD_NAME, false, TOURNAMENT_PLAYER_ID_FIELD_NAME, null, false, 1, null, null);
      $output .= $selectPlayer->getHtml();
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, DEFAULT_VALUE_BLANK, null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
      $output .= $option->getHtml();
      $index = 0;
      while ($index < count($aryPlayerInfo)) {
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, null, null, $aryPlayerInfo[$index][1], $aryPlayerInfo[$index][0]);
        $output .= $option->getHtml();
        $index ++;
      }
      $output .= "     </select>\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 100px;\">" . TOURNAMENT_KNOCKOUT_BY_FIELD_LABEL . ":</div>\n";
      $output .= "    <div style=\"float: left;\">\n";
      $selectPlayer = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_KNOCKOUT_ID, null, false, TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, false, TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, null, false, 1, null, null);
      $output .= $selectPlayer->getHtml();
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, DEFAULT_VALUE_BLANK, null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
      $output .= $option->getHtml();
      $index = 0;
      while ($index < count($aryPlayerInfo)) {
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, null, null, $aryPlayerInfo[$index][1], $aryPlayerInfo[$index][0]);
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
    $hiddenPlace = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_PLACE_FIELD_NAME, null, TOURNAMENT_PLACE_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $place, null);
    $output .= $hiddenPlace->getHtml();
    $hiddenPlayerName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_PLAYER_NAME_FIELD_NAME, null, TOURNAMENT_PLAYER_NAME_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenPlayerName->getHtml();
    $hiddenKnockout = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME, null, TOURNAMENT_KNOCKOUT_BY_NAME_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenKnockout->getHtml();
    $hiddenPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp", null, TOURNAMENT_PLAYER_ID_FIELD_NAME . "Temp", null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenPlayerId->getHtml();
    $hiddenPlayerNameTemp = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp", null, TOURNAMENT_PLAYER_NAME_FIELD_NAME . "Temp", null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenPlayerNameTemp->getHtml();
    $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, false, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_RESET, Constant::$TEXT_RESET, null);
    $output .= $buttonReset->getHtml();
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $hiddenTournamentId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_ID_FIELD_NAME, null, TOURNAMENT_ID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $tournamentId, null);
    $output .= $hiddenTournamentId->getHtml();
  } else {
    $output .= "No tournaments found without results for today\n";
  }
} else {
  $output .= "No tournaments found with paid buyins for today\n";
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
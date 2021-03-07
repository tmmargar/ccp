<?php
namespace ccp;
use ccp\classes\model\Base;
use ccp\classes\model\BooleanString;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
use PDO;
require_once "init.php";
define("TOURNAMENT_ID_FIELD_LABEL", "Tournament id");
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
$tournamentKnockoutBys = isset($_POST[SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME]) ? $_POST[SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$tournamentIdString = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
// id::rebuy count::addon amount (100:1:0)
$tournamentIdVals = explode("::", $tournamentIdString);
$tournamentId = $tournamentIdVals[0];
$tournamentPlace = isset($_POST[TOURNAMENT_PLACE_FIELD_NAME]) ? $_POST[TOURNAMENT_PLACE_FIELD_NAME] : DEFAULT_VALUE_BLANK;
$tournamentRebuyCount = isset($_POST[TOURNAMENT_REBUY_FIELD_NAME]) ? $_POST[TOURNAMENT_REBUY_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_REBUY_COUNT;
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $resultList2 = $databaseResult->getBounty();
  if (count($resultList2) > 0) {
    $ctr = 0;
    while ($ctr < count($resultList2)) {
      $aryBountyName[$ctr] = $resultList2[$ctr]->getName();
      $ctr ++;
    }
  }
  $params = array($tournamentId);
  $resultList2 = $databaseResult->getTournamentById($params);
  if (count($resultList2) > 0) {
    $maxPlayers = $resultList2[0]->getBuyinsPaid();
    $rebuyFlag = $resultList2[0]->getRebuyAmount() == 0 ? true : false;
    $addonFlag = $resultList2[0]->getAddonAmount() == 0 ? true : false;
  }
  $orderBy = "";
  if ($mode == Constant::$MODE_CREATE) {
    $orderBy .= " WHERE enteredCount IS NULL AND buyinsPaid > 0 AND t.tournamentId NOT IN (SELECT DISTINCT tournamentId FROM poker_result WHERE place <> 0)";
  } else if ($mode == Constant::$MODE_MODIFY) {
    $orderBy .= " WHERE enteredCount > 0";
  }
  $orderBy .= " ORDER BY t.tournamentDate DESC, t.startTime DESC";
  $params = array($orderBy, false);
  $resultList2 = $databaseResult->getTournament($params);
  if (count($resultList2) > 0) {
    if ($mode == Constant::$MODE_CREATE) {
      $rowCount = 1;
    } elseif ($mode == Constant::$MODE_MODIFY) {
      $rowCount = count($resultList2);
    }
    $ctr = 0;
    if ($ctr < $rowCount) {
      $output .= "    " . TOURNAMENT_ID_FIELD_LABEL . ": \n    ";
      $selectTournament = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TOURNAMENT_ID, null, false, TOURNAMENT_ID_FIELD_NAME, false, TOURNAMENT_ID_FIELD_NAME, null, false, 1, null, null);
      $output .= $selectTournament->getHtml();
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_TOURNAMENT_ID);
      $output .= $option->getHtml();
      $cnt = 0;
      while ($cnt < count($resultList2)) {
        $tournament = $resultList2[$cnt];
        if (($tournamentId == $tournament->getId())) {
          $endDateTemp = clone ($tournament->getDate());
          $endDateTemp->getTime()->modify('-1 day');
        }
        $optionText = $tournament->getDate()->getDisplayDatePickerFormat();
        $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
        $optionText .= " (" . $tournament->getLocation()->getName() . ")";
        $optionText .= " " . $tournament->getLimitType()->getName();
        $optionText .= " " . $tournament->getGameType()->getName();
        $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 < $tournament->getAddonAmount() ? "+a" : "");
        $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
        $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . " not paid/" . $tournament->getBuyinsPaid() . " paid";
        $optionText .= "+" . $tournament->getRebuysPaid() . "r paid";
        $optionText .= "+" . $tournament->getAddonsPaid() . "a paid";
        $optionText .= "/" . $tournament->getEnteredCount() . " entered)";
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentId . "::" . $tournament->getMaxRebuys() . "::" . $tournament->getAddonAmount(), null, $optionText, $tournament->getId() . "::" . $tournament->getMaxRebuys() . "::" . $tournament->getAddonAmount());
        $output .= $option->getHtml();
        $cnt ++;
      }
      $output .= "    </select>\n";
      $buttonGo = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_GO, null, false, null, null, null, false, Constant::$TEXT_GO, null, Constant::$TEXT_GO, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_GO, null);
      $output .= $buttonGo->getHtml();
      if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
        if (Constant::$MODE_MODIFY != $mode) {
          $resultList3 = $databaseResult->getResultPaidUserCount();
          // if there are registered people restrict to those otherwise use everyone
          if (count($resultList3) > 0) {
            $params = array(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), $endDateTemp->getDatabaseFormat());
            $resultList4 = $databaseResult->getResultBountyCurrent($params);
            if (count($resultList4) > 0) {
              $ctrTemp = 0;
              while ($ctrTemp < count($resultList4)) {
                // $aryBounty[$resultList4[$ctrTemp][0]] = $resultList4[$ctrTemp][1];
                $aryData[$ctrTemp] = array($resultList4[$ctrTemp][0], $resultList4[$ctrTemp][1]);
                $ctrTemp ++;
              }
            }
            // if bounty a and bounty b match then move bounty a to next
            if (isset($aryData[2][1]) && $aryData[0][1] == $aryData[2][1]) {
              // array, index, length
              array_splice($aryData, 0, 1);
            }
            // need to handle first tournament where no bounties
            if (isset($aryData)) {
              $aryBounty[1] = $aryData[0][1];
              if (isset($aryData[2][1])) {
                $aryBounty[2] = $aryData[2][1];
              } else {
                $aryBounty[2] = $aryData[1][1];
              }
            }
          }
        }
        $params = array($tournamentId);
        $resultList5 = $databaseResult->getTournamentBountyByTournamentId($params);
        if (count($resultList5) > 0) {
          $ctrTemp = 0;
          while ($ctrTemp < count($resultList5)) {
            $tournamentBounty = $resultList5[$ctrTemp];
            $tournamentBountyId = isset($_POST[$tournamentBounty->getBounty()->getId()]) ? $_POST[$tournamentBounty->getBounty()->getId()] : "";
            $output .= "<div style=\"float: left; width: 250px;\">" . $tournamentBounty->getBounty()->getName() . " (" . $tournamentBounty->getBounty()->getDescription() . "):</div>\n";
            $selectBounty = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_BOUNTY, null, false, $tournamentBounty->getBounty()->getName(), false, $tournamentBounty->getBounty()->getName(), null, false, 1, null, null);
            $output .= "<div style=\"float: left;\">" . $selectBounty->getHtml();
            $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentBountyId, null, Constant::$TEXT_NONE, "");
            $output .= $option->getHtml();
            $params = array($tournamentId);
            $resultList6 = $databaseResult->getUserPaidByTournamentId($params);
            if (count($resultList6) > 0) {
              $ctrTemp2 = 0;
              while ($ctrTemp2 < count($resultList6)) {
                $user = $resultList6[$ctrTemp2];
                $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, isset($aryBounty) ? $aryBounty[$tournamentBounty->getBounty()->getId()] : $tournamentBounty->getUser()->getId(), null, $user->getName(), $user->getId());
                $output .= $option->getHtml();
                $ctrTemp2 ++;
              }
            }
            $output .= "</select>\n";
            $output .= "</div>\n";
            $output .= "<div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
            $hiddenBounty = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, $tournamentBounty->getBounty()->getName() . "Name", null, $tournamentBounty->getBounty()->getName() . "Name", null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
            $output .= $hiddenBounty->getHtml();
            $ctrTemp ++;
          }
        }
        $params = array(Constant::$MODE_MODIFY == $mode ? $tournamentId : 0, true);
        $query = $databaseResult->getResultFinishedByTournamentId($params);
        $queryResult = $databaseResult->getConnection()->query($query);
        if ($mode == Constant::$MODE_CREATE) {
          $rowCount = 1;
        } elseif ($mode == Constant::$MODE_MODIFY) {
          $rowCount = $queryResult->rowCount();
        }
        $hideColIndexes = array(0, 1, 3, 4, 5, 6, 7, 8, 11, 13, 15, 16, 17);
        $output .= "    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display\" id=\"" . Constant::$ID_TABLE_INPUT . "\" style=\"margin: 0;\" width=\"50%\">\n";
        $ctrTemp = 0;
        while ($ctrTemp < $rowCount) {
          if ($ctrTemp == 0) {
            $queryTemp = $databaseResult->getResultPaidByTournamentId($params, true);
            $resultTemp = $databaseResult->getConnection()->query($queryTemp);
            $output .= " <thead>\n";
            $output .= " <tr>\n";
            for ($idx = 0; $idx < $resultTemp->columnCount(); $idx++) {
              if (!in_array($idx, $hideColIndexes)) {
                $output .= "       <th>" . ucwords($resultTemp->getColumnMeta($idx)["name"]) . "</th>\n";
              }
            }
            $output .= "      </tr>\n";
            $output .= "     </thead>\n";
            $output .= "     <tbody>\n";
          }
          $row = $queryResult->fetch(PDO::FETCH_BOTH);
          $ctrTemp++;
          if ($mode == Constant::$MODE_MODIFY) {
            if (0 < strlen($ids)) {
              $ids .= Constant::$DELIMITER_DEFAULT;
            }
            $ids .= $ctrTemp;
          }
          $output .= "      <tr>\n";
          $params = array($tournamentId);
          $resultList7 = $databaseResult->getResultPaidByTournamentId($params, false);
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
            $output .= "       <td class=\"center\">\n";
            $selectPlayer = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLAYER_ID, null, false, TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctrTemp, false, TOURNAMENT_PLAYER_ID_FIELD_NAME . "_" . $ctrTemp, null, false, 1, null, null);
            $output .= $selectPlayer->getHtml();
            $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, DEFAULT_VALUE_BLANK, null, Constant::$TEXT_NONE, $row !== false ? $row[1] : "");
            $output .= $option->getHtml();
            while ($index < count($aryPlayerInfo)) {
              $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $row !== false && $row[1] == $aryPlayerInfo[$index][0] ? $aryPlayerInfo[$index][2] : "", null, $aryPlayerInfo[$index][1], $aryPlayerInfo[$index][2]);
              $output .= $option->getHtml();
              $index ++;
            }
            $output .= "        </select>\n";
            $output .= "       </td>\n";
          }
          $output .= "       <td class=\"center\">\n";
          $booleanString = new BooleanString($row !== false ? $row[8] : "");
          $checkboxRebuy = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, $booleanString->getBoolean(), null, null, $rebuyFlag, TOURNAMENT_REBUY_FIELD_NAME . "_" . $ctrTemp, null, TOURNAMENT_REBUY_FIELD_NAME . "_" . $ctrTemp, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
          $output .= "        " . $checkboxRebuy->getHtml();
          $textBoxRebuyCount = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REBUY_COUNT, null, false, null, null, null, ($row !== false && 0 == $row[9] ? true : false), TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctrTemp, 2, TOURNAMENT_REBUY_COUNT_FIELD_NAME . "_" . $ctrTemp, null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, $row !== false ? $row[9] : "", null);
          $output .= "        " . $textBoxRebuyCount->getHtml();
          $output .= "       </td>\n";
          $output .= "       <td class=\"center\">\n";
         $booleanString = new BooleanString($row !== false ? $row[10] : "");
          $checkboxAddon = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, $booleanString->getBoolean(), null, null, $addonFlag, TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctrTemp, null, TOURNAMENT_ADDON_FIELD_NAME . "_" . $ctrTemp, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, Constant::$FLAG_YES, null);
          $output .= "        " . $checkboxAddon->getHtml();
          $output .= "       </td>\n";
          if ($row === false || "" == $row[1]) {
            $player = 0;
          } else {
            $player = $row[1];
          }
          $output .= "       <td class=\"center\">\n";
          $textBoxPlace = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, null, TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctrTemp, 2, TOURNAMENT_PLACE_FIELD_NAME . "_" . $ctrTemp, null, null, false, null, null, 2, null, FormControl::$TYPE_INPUT_TEXTBOX, isset($row[12]) ? $row[12] : $maxPlayers, null);
          $output .= "        " . $textBoxPlace->getHtml();
          $output .= "       </td>\n";
          if (count($aryPlayerInfo) > 0) {
            $index = 0;
            $output .= "       <td class=\"center\">\n";
            $selectPlayer = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_KNOCKOUT_ID, null, false, TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctrTemp, false, TOURNAMENT_KNOCKOUT_BY_FIELD_NAME . "_" . $ctrTemp, null, false, 1, null, null);
            $output .= $selectPlayer->getHtml();
            $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $row !== false ? $row[13] : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_BLANK);
            $output .= $option->getHtml();
            while ($index < count($aryPlayerInfo)) {
              $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $row !== false && $row[13] == $aryPlayerInfo[$index][0] ? $aryPlayerInfo[$index][2] : "", null, $aryPlayerInfo[$index][1], $aryPlayerInfo[$index][2]);
              $output .= $option->getHtml();
              $index ++;
            }
            $output .= "        </select>\n";
            $output .= "       </td>\n";
          }
          $output .= "      </tr>\n";
        }
        $output .= "     </tbody>\n";
        $output .= "    </table>\n";
        $buttonAddRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADD_ROW, null, false, null, null, null, false, Constant::$TEXT_ADD_ROW, null, Constant::$TEXT_ADD_ROW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_BUTTON, Constant::$TEXT_ADD_ROW, null);
        $output .= $buttonAddRow->getHtml();
        $buttonRemoveRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REMOVE_ROW, null, false, null, null, null, false, Constant::$TEXT_REMOVE_ROW, null, Constant::$TEXT_REMOVE_ROW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_BUTTON, Constant::$TEXT_REMOVE_ROW, null);
        $output .= $buttonRemoveRow->getHtml();
        $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, false, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
        $output .= $buttonSave->getHtml();
        $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_RESET, Constant::$TEXT_RESET, null);
        $output .= $buttonReset->getHtml();
        $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
        $output .= $buttonCancel->getHtml();
      }
    } else {
      $output .= "The tournament selected does not have any entered results to modify.\n";
      $hiddenTournamentId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, TOURNAMENT_ID_FIELD_NAME, null, TOURNAMENT_ID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $tournamentId, null);
      $output .= $hiddenTournamentId->getHtml();
    }
  } else {
    $output .= "No tournaments found with paid buyins and without any results\n";
    $output .= "<br />\n";
    $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
    $output .= $buttonCancel->getHtml();
  }
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenRebuys = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, MAX_REBUYS_FIELD_NAME, null, MAX_REBUYS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenRebuys->getHtml();
    $hiddenAddonAmount = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, ADDON_AMOUNT_FIELD_NAME, null, ADDON_AMOUNT_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenAddonAmount->getHtml();
} elseif ($mode == Constant::$MODE_SAVE_CREATE || $mode == Constant::$MODE_SAVE_MODIFY) {
  $resultList2 = $databaseResult->getBounty();
  if (count($resultList2) > 0) {
    $ctr = 0;
    while ($ctr < count($resultList2)) {
      $aryBountyId[$ctr] = $resultList2[$ctr]->getId();
      $aryBountyName[$ctr] = Base::build($resultList2[$ctr]->getName(), null);
      $ctr ++;
    }
  }
  for ($index = 0; $index < count($aryBountyName); $index ++) {
    if (isset($_POST[$aryBountyName[$index]])) {
      $tournamentBountyPlayerId = $_POST[$aryBountyName[$index]];
      $params = array($tournamentId, $aryBountyId[$index]);
      $rowCount = $databaseResult->deleteTournamentBountyByTournamentIdAndBountyId($params);
      if ("" != $tournamentBountyPlayerId) {
        array_push($params, $tournamentBountyPlayerId);
        $rowCount = $databaseResult->insertTournamentBounty($params);
      }
    }
  }
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  // clear all rows
  $params = array(null, null, null, Constant::$CODE_STATUS_PAID, 0, "null", $tournamentId); // , $maxPlace);
  $rowCount = $databaseResult->updateResultByTournamentIdAndPlace($params);
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
    $rowCount = $databaseResult->updateResult($params);
    for ($index = 0; $index < count($aryBountyName); $index ++) {
      if (isset($_POST[$aryBountyName[$index] . "_" . $ctr]) && Constant::$FLAG_YES == $_POST[$aryBountyName[$index] . "_" . $ctr]) {
        $params = array($tournamentId, $aryBountyId[$index], $tournamentTempPlayerId);
        $rowCount = $databaseResult->tournamentBountyDeleteByPlayerId($params);
        $rowCount = $databaseResult->insertTournamentBounty($params);
      }
    }
    $ctr ++;
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_DELETE || $mode == Constant::$MODE_CONFIRM) {
  if ($mode == Constant::$MODE_CONFIRM) {
    if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
      $params = array($tournamentId);
      $rowCount = $databaseResult->deleteTournamentBountyByTournamentId($params);
      $params = array(0, Constant::$FLAG_NO, Constant::$FLAG_NO, Constant::$CODE_STATUS_PAID, 0, "null", $tournamentId, $ids);
      $rowCount = $databaseResult->updateResult($params);
      $ids = DEFAULT_VALUE_BLANK;
      // $tournamentPayoutIds = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  $params = array(false);
  $resultList = $databaseResult->getTournamentOrdered($params);
  if (0 < count($resultList)) {
    $output .= "    " . TOURNAMENT_ID_FIELD_LABEL . ": \n    ";
    $selectTournament = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TOURNAMENT_ID, null, false, TOURNAMENT_ID_FIELD_NAME, false, TOURNAMENT_ID_FIELD_NAME, null, false, 1, null, null);
    $output .= $selectTournament->getHtml();
    $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentId, null, Constant::$TEXT_NONE, DEFAULT_VALUE_TOURNAMENT_ID);
    $output .= $option->getHtml();
    $cnt = 0;
    while ($cnt < count($resultList)) {
      $tournament = $resultList[$cnt];
      $optionText = $tournament->getDate()->getDisplayDatePickerFormat();
      $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
      $optionText .= " (" . $tournament->getLocation()->getName() . ")";
      $optionText .= " " . $tournament->getLimitType()->getName();
      $optionText .= " " . $tournament->getGameType()->getName();
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 < $tournament->getAddonAmount() ? "+a" : "");
      $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
      $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . " not paid/" . $tournament->getBuyinsPaid() . " paid";
      $optionText .= "+" . $tournament->getRebuysPaid() . "r paid";
      $optionText .= "+" . $tournament->getAddonsPaid() . "a paid";
      $optionText .= "/" . $tournament->getEnteredCount() . " entered)";
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentId, null, $optionText, $tournament->getId());
      $output .= $option->getHtml();
      $cnt ++;
    }
    $output .= "    </select>\n";
    if ($mode == Constant::$MODE_VIEW) {
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_VIEW, null, false, null, null, null, false, Constant::$TEXT_VIEW, null, Constant::$TEXT_VIEW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_VIEW, null);
      $output .= $buttonCancel->getHtml();
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MODIFY, null, false, null, null, null, false, Constant::$TEXT_MODIFY, null, Constant::$TEXT_MODIFY, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_MODIFY, null);
      $output .= $buttonCancel->getHtml();
    if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DELETE, null, false, null, null, null, false, Constant::$TEXT_DELETE, null, Constant::$TEXT_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_DELETE, null);
      $output .= $buttonCancel->getHtml();
    }
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CREATE, null, false, null, null, null, false, Constant::$TEXT_CREATE, null, Constant::$TEXT_CREATE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CREATE, null);
      $output .= $buttonCancel->getHtml();
      }
    if ($mode == Constant::$MODE_DELETE) {
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_DELETE, null, false, null, null, null, false, Constant::$TEXT_CONFIRM_DELETE, null, Constant::$TEXT_CONFIRM_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CONFIRM_DELETE, null);
      $output .= $buttonCancel->getHtml();
      $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
      $output .= $buttonCancel->getHtml();
      $output .= "<br />";
    }
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $hiddenPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
    $output .= $hiddenPlayerId->getHtml();
    $hiddenKnockout = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, null, SELECTED_ROWS_TOURNAMENT_KNOCKOUT_BY_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $tournamentKnockoutBys, null);
    $output .= $hiddenKnockout->getHtml();
  }
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $params = array($tournamentId);
    $resultList = $databaseResult->getTournamentBountyByTournamentId($params);
    if (0 < count($resultList)) {
      $cnt = 0;
      while ($cnt < count($resultList)) {
        $tournamentBounty = $resultList[$cnt];
        if (0 < $cnt) {
          $output .= "     <br />\n";
        }
        $output .= $tournamentBounty->getBounty()->getName() . "(" . $tournamentBounty->getBounty()->getDescription() . "): " . $tournamentBounty->getUser()->getName() . "\n";
        $cnt ++;
      }
    }
    if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_DELETE) {
      $params = array($tournamentId);
      $query = $databaseResult->getResultPaidByTournamentId($params, true);
      if ($mode == Constant::$MODE_DELETE) {
        $query .= " AND playerId IN (" . $ids . ")";
      }
    }
    $colFormats = array(array(9, "number", 0), array(12, "number", 0));
    $hiddenAdditional = array(array("tournamentPlayerId", 1));
    $hideColIndexes = array(0, 1, 3, 4, 6, 7, 8, 11, 13, 15, 16, 17);
    $htmlTable = new HtmlTable(null, array("override50"), null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, $hiddenAdditional, null, $hideColIndexes, null, null, null, true, $query, $ids, null, "50%");
    $output .= $htmlTable->getHtml();
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
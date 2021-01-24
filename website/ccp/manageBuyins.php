<?php
namespace ccp;
use ccp\classes\model\Base;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\HtmlUtility;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TOURNAMENT_ID_FIELD_LABEL", "Tournament id");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentId");
define("SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerIds");
define("HIDDEN_ROW_FIELD_NAME", "rowPlayerId");
define("HIDDEN_ROW_STATUS_FIELD_NAME", "statusName");
define("HIDDEN_ROW_BUYIN_PAID_FIELD_NAME", "buyinPaid");
define("HIDDEN_ROW_REBUY_PAID_FIELD_NAME", "rebuyPaid");
define("HIDDEN_ROW_REBUY_COUNT_FIELD_NAME", "rebuyCount");
define("HIDDEN_ROW_ADDON_PAID_FIELD_NAME", "addonPaid");
define("HIDDEN_ROW_BOUNTY_A_PAID_FIELD_NAME", "bountyA");
define("HIDDEN_ROW_BOUNTY_B_PAID_FIELD_NAME", "bountyB");
define("DEFAULT_VALUE_TOURNAMENT_ID", "-1");
define("PAID_TEXT", "Paid");
define("REBUY_FLAG_FIELD_NAME", "rebuyFlag");
define("ADDON_FLAG_FIELD_NAME", "addonFlag");
$style =
  "<style type=\"text/css\">\n" .
  ".label {\n" .
  "  float: left;\n" .
  "  width: 130px;\n" .
  "  text-align: right;\n" .
  "}\n" .
  ".value {\n" .
  "  float: left;\n" .
  "  text-align: right;\n" .
  "  width: 50px;\n" .
  "}\n" .
  ".valueAfter {\n" .
  "  float: left;\n" .
  "  padding-left: 5px;\n" .
  "  text-align: right;\n" .
  "  width: 160px;\n" .
  "}\n" .
  "p {\n" .
  "  margin: 0;\n" .
  "  padding: 0\n" .
  "}\n" .
  "</style>\n";
$smarty->assign("title", "Chip Chair and a Prayer Manage Buyins");
$smarty->assign("style", $style);
$smarty->assign("script", "<script src=\"scripts/manageBuyins.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Buyins");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageBuyins");
$output = "";
if (isset($_POST[TOURNAMENT_ID_FIELD_NAME])) {
  $tournamentId = $_POST[TOURNAMENT_ID_FIELD_NAME];
} else {
  $tournamentId = DEFAULT_VALUE_TOURNAMENT_ID;
}
$tournamentDate = "CURRENT_DATE";
$tournamentDateMax = "DATE_ADD(t.tournamentDate, INTERVAL 28 DAY)";
$bountyAPaid = isset($_POST["bountyA"]) ? $_POST["bountyA"] : "";
$bountyBPaid = isset($_POST["bountyB"]) ? $_POST["bountyB"] : "";
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
if (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $aryPlayers = explode(Constant::$DELIMITER_DEFAULT, $_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME]);
  $aryBuyins = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_BUYIN_PAID_FIELD_NAME]);
  $aryRebuys = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_REBUY_PAID_FIELD_NAME]);
  $aryRebuyCounts = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_REBUY_COUNT_FIELD_NAME]);
  $aryAddons = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_ADDON_PAID_FIELD_NAME]);
  $aryBountyAs = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_BOUNTY_A_PAID_FIELD_NAME]);
  $aryBountyBs = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_BOUNTY_B_PAID_FIELD_NAME]);
  for ($index = 0; $index < count($aryPlayers); $index ++) {
    if ($aryBuyins[$index] == Constant::$TEXT_TRUE) {
      $statusCode = Constant::$CODE_STATUS_PAID;
      $buyinPaid = Constant::$FLAG_YES;
    } else {
      $statusCode = Constant::$CODE_STATUS_REGISTERED;
      $buyinPaid = Constant::$FLAG_NO;
    }
    if ($aryRebuys[$index] == Constant::$TEXT_TRUE) {
      $rebuyPaid = Constant::$FLAG_YES;
      $rebuyCount = $aryRebuyCounts[$index];
    } else {
      $rebuyPaid = Constant::$FLAG_NO;
      $rebuyCount = 0;
    }
    if ($aryAddons[$index] == Constant::$TEXT_TRUE) {
      $addonPaid = Constant::$FLAG_YES;
    } else {
      $addonPaid = Constant::$FLAG_NO;
    }
    $params = array($statusCode, $buyinPaid, $rebuyPaid, $addonPaid, $rebuyCount, $tournamentId, $aryPlayers[$index]);
    $rowCount = $databaseResult->updateBuyins($params);
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
    $params = array($tournamentId, $aryPlayers[$index], 1);
    $rowCount = $databaseResult->deleteBounty($params);
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
    if ($aryBountyAs[$index] == Constant::$TEXT_TRUE) {
      $params = array($tournamentId, $aryPlayers[$index], 1);
      $rowCount = $databaseResult->insertBounty($params);
      if (!is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
    }
    $params = array($tournamentId, $aryPlayers[$index], 2);
    $rowCount = $databaseResult->deleteBounty($params);
    if (!is_numeric($rowCount)) {
      $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
    }
    if (count($aryBountyBs) > 1 && $aryBountyBs[$index] == Constant::$TEXT_TRUE) {
      $params = array($tournamentId, $aryPlayers[$index], 2);
      $rowCount = $databaseResult->insertBounty($params);
      if (!is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
    }
  }
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW) {
  $params = array($tournamentDate, $tournamentDateMax);
  $resultList = $databaseResult->getTournamentForBuyins($params);
  if (count($resultList) > 0) {
    $output .= "    " . TOURNAMENT_ID_FIELD_LABEL . ": \n    ";
    $selectTournament = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TOURNAMENT_ID, null, false, TOURNAMENT_ID_FIELD_NAME, false, TOURNAMENT_ID_FIELD_NAME, null, false, 1, null, null);
    $output .= $selectTournament->getHtml();
    $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_TOURNAMENT_ID);
    $output .= $option->getHtml();
    $cnt = 0;
    while ($cnt < count($resultList)) {
      $tournament = $resultList[$cnt];
      $optionText = $tournament->getDate()->getDisplayDatePickerFormat();
      $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
      $optionText .= " (" . $tournament->getLocation()->getName() . ")";
      $optionText .= " " . $tournament->getLimitType()->getName();
      $optionText .= " " . $tournament->getGameType()->getName();
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 != $tournament->getAddonAmount() ? "+a" : "");
      $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
      $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . " not paid/" . $tournament->getBuyinsPaid() . " paid";
      $optionText .= "+" . $tournament->getRebuysPaid() . "r paid";
      $optionText .= "+" . $tournament->getAddonsPaid() . "a paid";
      $optionText .= "/" . $tournament->getEnteredCount() . " entered)";
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentId, null, $optionText, $tournament->getId());
      $output .= $option->getHtml();
      $cnt ++;
      if ($tournamentId == $tournament->getId()) {
        $maxRebuys = $tournament->getMaxRebuys();
        $addonAmount = $tournament->getAddonAmount();
      }
      $totalBuyin[$tournament->getId()] = array($tournament->getBuyinsPaid(), -$tournament->getBuyinAmount());
      $totalRebuy[$tournament->getId()] = array($tournament->getRebuysPaid(), $tournament->getRebuysCount(), -$tournament->getRebuyAmount());
      $totalAddon[$tournament->getId()] = array($tournament->getAddonsPaid(), -$tournament->getAddonAmount());
      if (strpos($tournament->getDescription(), "Championship") === false) {
        $championshipFlag[$tournament->getId()] = false;
        $total[$tournament->getId()] = ($totalBuyin[$tournament->getId()][0] * $totalBuyin[$tournament->getId()][1]) + ($totalRebuy[$tournament->getId()][1] * $totalRebuy[$tournament->getId()][2]) + ($totalAddon[$tournament->getId()][0] * $totalAddon[$tournament->getId()][1]);
      } else {
        $championshipFlag[$tournament->getId()] = true;
//         $now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null);
//         $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $now->getCurrentYearFormat() . DateTime::$DATE_START_SEASON);
//         $startDate = $dateTime->getDatabaseFormat();
//         $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $now->getCurrentYearFormat() . DateTime::$DATE_END_SEASON);
//         $endDate = $dateTime->getDatabaseFormat();
//         $params = array($startDate, $endDate);
        $params = array(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat());
        $resultListNested = $databaseResult->getPrizePoolForSeason($params, false);
        if (0 < count($resultListNested)) {
          $total[$tournament->getId()] = str_replace(",", "", number_format($resultListNested[0], 0));
        }
      }
      $rake[$tournament->getId()] = $total[$tournament->getId()] * $tournament->getRakeForCalculation();
      $rakePercent[$tournament->getId()] = $tournament->getRakeForCalculation();
      $tournamentPayouts = $tournament->getGroupPayout()->getPayouts();
      $payouts[$tournament->getId()] = $tournamentPayouts;
    }
    $output .= "    </select>\n";
    $buttonView = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_VIEW, null, false, null, null, null, false, Constant::$TEXT_VIEW, null, Constant::$TEXT_VIEW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_VIEW, null);
    $output .= $buttonView->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME, null, SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_BUYIN_PAID_FIELD_NAME, null, HIDDEN_ROW_BUYIN_PAID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_REBUY_PAID_FIELD_NAME, null, HIDDEN_ROW_REBUY_PAID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_REBUY_COUNT_FIELD_NAME, null, HIDDEN_ROW_REBUY_COUNT_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_ADDON_PAID_FIELD_NAME, null, HIDDEN_ROW_ADDON_PAID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, null, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, REBUY_FLAG_FIELD_NAME, null, REBUY_FLAG_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, (isset($maxRebuys) ? $maxRebuys : ""), null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, ADDON_FLAG_FIELD_NAME, null, ADDON_FLAG_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, (isset($addonAmount) ? $addonAmount : ""), null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
  } else {
    $output .= "No tournaments available to manage buyins";
  }
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $resultList = $databaseResult->getBounty();
    if (count($resultList) > 0) {
      $ctr = 0;
      while ($ctr < count($resultList)) {
        $bounty = $resultList[$ctr];
        $checkboxBountyName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, $bounty->getName() . "CheckAll", null, $bounty->getName() . "CheckAll", null, null, false, null, null, null, Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
        $aryBountyName[$ctr] = $bounty->getName() . "<br />" . $checkboxBountyName->getHtml();
        $checkboxHtml = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, $bounty->getName() . "_?2", null, $bounty->getName() . "_?2", "input.setFormValues(new Array('" . HIDDEN_ROW_FIELD_NAME . "', '" . HIDDEN_ROW_STATUS_FIELD_NAME . "', '" . Base::build($bounty->getName(), null) . "', '" . Constant::$FIELD_NAME_MODE . "'), new Array('?2', '?3', '?3', '" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "'));", null, false, null, null, null, "_?2", FormControl::$TYPE_INPUT_CHECKBOX, "?1", null);
        $aryHtml[$ctr] = "    " . $checkboxHtml->getHtml();
        $params = array($tournamentId, $bounty->getId());
        $aryQueries[$ctr] = $databaseResult->getResultBountyByTournamentIdAndBountyId($params);
        $hiddenBounty = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, $bounty->getName(), null, $bounty->getName(), null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, (0 == $ctr ? $bountyAPaid : 1 == $ctr) ? $bountyBPaid : "", null);
        $output .= $hiddenBounty->getHtml();
        $ctr ++;
      }
    }
    $params = array($tournamentId);
    $query = $databaseResult->getStatusPaid($params, true);
    $checkboxBuyinButton = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$TEXT_BUYIN . "_?2", null, Constant::$TEXT_BUYIN . "_?2", "input.changeState('" . Base::build(Constant::$TEXT_BUYIN, null) . "_?2', new Array(" . (0 == $maxRebuys ? "''" : "'" . Base::build(Constant::$TEXT_REBUY, null) . "_?2'") . (0 == $addonAmount ? "" : ", '" . Base::build(Constant::$TEXT_ADDON, null) . "_?2'") . ", 'bountyA_?2', 'bountyB_?2')); input.setFormValues(new Array('" . HIDDEN_ROW_FIELD_NAME . "', '" . HIDDEN_ROW_STATUS_FIELD_NAME . "', '" . HIDDEN_ROW_BUYIN_PAID_FIELD_NAME . "', '" . Constant::$FIELD_NAME_MODE . "'), new Array('?2', '?3', '?3', '" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "'), false);", null, false, null, null, null, "_?2", FormControl::$TYPE_INPUT_CHECKBOX, "?1", null);
    $textBoxRebuyCount = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REBUY_COUNT, null, false, null, null, null, (0 == $maxRebuys ? true : false), Constant::$TEXT_REBUY_COUNT . "_?2", 2, Constant::$TEXT_REBUY_COUNT . "_?2", null, null, false, null, null, 2, "_?2", FormControl::$TYPE_INPUT_TEXTBOX, "?4", null);
    $checkboxRebuyButton = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, (0 == $maxRebuys ? "disabled" : ""), Constant::$TEXT_REBUY . "_?2", null, Constant::$TEXT_REBUY . "_?2", "input.setFormValues(new Array('" . HIDDEN_ROW_FIELD_NAME . "', '" . HIDDEN_ROW_STATUS_FIELD_NAME . "', '" . HIDDEN_ROW_REBUY_PAID_FIELD_NAME . "', '" . Constant::$FIELD_NAME_MODE . "'), new Array('?2', '?3', '?3', '" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "'), false);", null, false, null, null, null, "_?2", FormControl::$TYPE_INPUT_CHECKBOX, "?1", null);
    $checkboxAddonButton = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, (0 == $addonAmount ? "disabled" : ""), Constant::$TEXT_ADDON . "_?2", null, Constant::$TEXT_ADDON . "_?2", "input.setFormValues(new Array('" . HIDDEN_ROW_FIELD_NAME . "', '" . HIDDEN_ROW_STATUS_FIELD_NAME . "', '" . HIDDEN_ROW_ADDON_PAID_FIELD_NAME . "', '" . Constant::$FIELD_NAME_MODE . "'), new Array('?2', '?3', '?3', '" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "'));", null, false, null, null, null, "_?2", FormControl::$TYPE_INPUT_CHECKBOX, "?1", null);
    $buttons = array("    " . $checkboxBuyinButton->getHtml(), "    " . $checkboxRebuyButton->getHtml() . " " . $textBoxRebuyCount->getHtml(), "    " . $checkboxAddonButton->getHtml());
    $allButtons = array_merge($buttons, $aryHtml);
    $checkboxBuyinColumnName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$TEXT_BUYIN . "CheckAll", null, Constant::$TEXT_BUYIN . "CheckAll", null, null, false, null, null, null, Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
    $checkboxRebuyColumnName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, (0 == $maxRebuys ? "disabled" : ""), Constant::$TEXT_REBUY . "CheckAll", null, Constant::$TEXT_REBUY . "CheckAll", null, null, false, null, null, null, Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
    $checkboxAddonColumnName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, (0 == $addonAmount ? "disabled" : ""), Constant::$TEXT_ADDON . "CheckAll", null, Constant::$TEXT_ADDON . "CheckAll", null, null, false, null, null, null, Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, FormControl::$TYPE_INPUT_CHECKBOX, null, null);
    $columnNames = array(Constant::$TEXT_BUYIN . "<br />" . $checkboxBuyinColumnName->getHtml(), Constant::$TEXT_REBUY . "<br />" . $checkboxRebuyColumnName->getHtml(), Constant::$TEXT_ADDON . "<br />" . $checkboxAddonColumnName->getHtml());
    $allColNames = array_merge($columnNames, $aryBountyName);
    $colIndexes = array(2, 3, 5);
    $allIndexes = array_merge($colIndexes, $aryQueries);
    $html = array($allButtons, $allColNames, $allIndexes, array(array(Constant::$NAME_STATUS_PAID, "Not paid"), array(Constant::$NAME_STATUS_NOT_PAID, "Paid")), array(0, 4));
    $hideColIndexes = array(0, 2, 3, 4, 5);
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $htmlTable = new HtmlTable(null, array("override60"), null, null, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, $hideColIndexes, $html, null, null, true, $query, null, null, "60%");
    $temp = $htmlTable->getHtml();
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    $output .= $temp;
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    if ("" != $temp) {
      $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, false, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, "inputLocal.buildData('" . Constant::$ID_TABLE_DATA . "', '" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_MODIFY . "');", null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
      $output .= "    <div style=\"float: left;\">" . $buttonSave->getHtml() . "</div>\n";
    }
    $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
    if ("" != $temp) {
      if ($championshipFlag[$tournamentId]) {
        $output .= "    <div class=\"label\">Total buyins:</div>\n";
        $output .= "    <div class=\"value\">" . $totalBuyin[$tournamentId][0] . "</div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      } else {
        $output .= "    <div class=\"label\">Total buyins:</div>\n";
        $totalBuyins = $totalBuyin[$tournamentId][0] * $totalBuyin[$tournamentId][1];
        $output .= "    <div class=\"negative value\">$" . $totalBuyins . "</div>\n";
        $output .= "    <div class=\"valueAfter\">(" . $totalBuyin[$tournamentId][0] . " x $" . $totalBuyin[$tournamentId][1] . ")</div>\n";
        $output .= "    <div style=\"clear: both; height: 0px; overflow: hidden;\"></div>\n";
        $output .= "    <div class=\"label\">Total rebuys:</div>\n";
        $totalRebuys = $totalRebuy[$tournamentId][1] * $totalRebuy[$tournamentId][2];
        $output .= "    <div class=\"negative value\">$" . $totalRebuys . "</div>\n";
        $output .= "    <div class=\"valueAfter\">(" . $totalRebuy[$tournamentId][1] . " x $" . $totalRebuy[$tournamentId][2] . ")</div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div class=\"label\">Total addons:</div>\n";
        $totalAddons = $totalAddon[$tournamentId][0] * $totalAddon[$tournamentId][1];
        $output .= "    <div class=\"negative value\">$" . $totalAddons . "</div>\n";
        $output .= "    <div class=\"valueAfter\">(" . $totalAddon[$tournamentId][0] . " x $" . $totalAddon[$tournamentId][1] . ")</div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div class=\"label\">Total paid in:</div>\n";
        $output .= "    <div class=\"negative value\">$" . $total[$tournamentId] . "</div>\n";
        $output .= "    <div class=\"valueAfter\">($" . $totalBuyins . " + $" . $totalRebuys . " + $" . $totalAddons . ")</div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
        $output .= "    <div class=\"label\">Total rake (" . ($rakePercent[$tournamentId] * 100) . "%):</div>\n";
        $output .= "    <div class=\"negative value\">$" . $rake[$tournamentId] . "</div>\n";
        $output .= "    <div class=\"valueAfter\">(" . ($rakePercent[$tournamentId] * 100) . "% x $" . $total[$tournamentId] . ")</div>\n";
        $output .= "    <div style=\"clear: both;\"></div>\n";
      }
      $output .= "    <div class=\"label\">Total paid out:</div>\n";
      $output .= "    <div class=\"positive value\">$" . ($total[$tournamentId] - $rake[$tournamentId]) . "</div>\n";
      if (! $championshipFlag[$tournamentId]) {
        $output .= "    <div class=\"valueAfter\">($" . $total[$tournamentId] . " - $" . $rake[$tournamentId] . ")</div>\n";
      }
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $resultList = $databaseResult->getStatusPaid($params, false);
      $countPaid = 0;
      if (count($resultList) > 0) {
        $ctr = 0;
        while ($ctr < count($resultList)) {
          if ($resultList[$ctr][2] == "Paid") {
            $countPaid ++;
          }
          $ctr ++;
        }
      }
      $structures = "";
      foreach ($payouts[$tournamentId] as $payout) {
        if ($countPaid >= $payout->getMinPlayers() && $countPaid <= $payout->getMaxPlayers()) {
          $structures = $payout->getStructures();
          break;
        }
      }
      if ($structures != "") {
        foreach ($structures as $structure) {
          $output .= "    <div class=\"label" . ($ctr == count($resultList) - 1 ? "Height" : "") . "\">Place " . $structure->getPlace() . " (" . ($structure->getPercentage() * 100) . "%):</div>\n";
          $output .= "    <div class=\"positive value\">$" . - number_format((($total[$tournamentId] - $rake[$tournamentId]) * $structure->getPercentage()), 0, ".", "") . "</div>\n";
          $output .= "    <div class=\"valueAfter\">(" . ($structure->getPercentage() * 100) . "% x $" . - ($total[$tournamentId] - $rake[$tournamentId]) . ")</div>\n";
          $output .= "    <div style=\"clear: both;\"></div>\n";
          $ctr ++;
        }
      }
      $params = array($tournamentId);
      $resultList = $databaseResult->getBountyCountSelectByTournament($params);
      if (count($resultList) > 0) {
        $ctr = 0;
        while ($ctr < count($resultList)) {
          $output .= "    <div class=\"label\">Total " . $resultList[$ctr][0] . "<br />(" . $resultList[$ctr][1] . "):</div>\n";
          $output .= "    <div class=\"positive value\">$" . ($resultList[$ctr][2] * 2) . "</div>\n";
          $output .= "    <div class=\"valueAfter\">(" . $resultList[$ctr][2] . " x $2)</div>\n";
          $output .= "    <div style=\"clear: both;\"></div>\n";
          $ctr ++;
        }
      } else {
        $output .= "    <div class=\"label\">No bounties</div>\n";
      }
    }
  } else {
    if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
      $output .= "No tournaments available to manage buyins";
    }
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
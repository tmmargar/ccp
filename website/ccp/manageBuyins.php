<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Base;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TOURNAMENT_ID_FIELD_LABEL", "Tournament");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentId");
define("HIDDEN_ROW_STATUS_FIELD_NAME", "statusName");
define("HIDDEN_ROW_BUYIN_PAID_FIELD_NAME", "buyinPaid");
define("HIDDEN_ROW_REBUY_PAID_FIELD_NAME", "rebuyPaid");
define("HIDDEN_ROW_REBUY_COUNT_FIELD_NAME", "rebuyCount");
define("HIDDEN_ROW_ADDON_PAID_FIELD_NAME", "addonPaid");
define("DEFAULT_VALUE_TOURNAMENT_ID", "-1");
define("PAID_TEXT", "Paid");
define("REBUY_FLAG_FIELD_NAME", "rebuyFlag");
define("ADDON_FLAG_FIELD_NAME", "addonFlag");
$style = "<style type=\"text/css\">\n" . ".label {\n" . "  float: left;\n" . "  width: 150px;\n" . "  text-align: right;\n" . "}\n" . ".value {\n" . "  float: left;\n" . "  text-align: right;\n" . "  width: 50px;\n" . "}\n" . ".valueAfter {\n" . "  float: left;\n" . "  padding-left: 5px;\n" . "  text-align: right;\n" . "  width: 150px;\n" . "}\n" . "p {\n" . "  margin: 0;\n" . "  padding: 0;\n" . "}\n" . "</style>\n";
$smarty->assign("title", "Manage Buyins");
$smarty->assign("heading", "Manage Buyins");
$smarty->assign("style", "<link href=\"css/manageBuyins.css\" rel=\"stylesheet\">");
$tournamentId = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
if (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $aryPlayers = explode(Constant::$DELIMITER_DEFAULT, $_POST[SELECTED_ROWS_FIELD_NAME]);
  $aryBuyins = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_BUYIN_PAID_FIELD_NAME]);
  $aryRebuys = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_REBUY_PAID_FIELD_NAME]);
  $aryRebuyCounts = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_REBUY_COUNT_FIELD_NAME]);
  $aryAddons = explode(Constant::$DELIMITER_DEFAULT, $_POST[HIDDEN_ROW_ADDON_PAID_FIELD_NAME]);
  $output .= "<script type=\"text/javascript\">\n aryErrors = [];\n";
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
    $rowCount = $databaseResult->updateBuyins(params: $params);
    if (! is_numeric($rowCount)) {
      $output .= "  aryErrors.push(\"" . $rowCount . "\");\n";
    }
  }
  $output .= "  if (aryErrors.length > 0) {display.showErrors(aryErrors);}\n</script>\n";
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW) {
  $params = array("CURRENT_DATE", "DATE_ADD(t.tournamentDate, INTERVAL 28 DAY)");
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList = $databaseResult->getTournamentForBuyins(params: $params, paramsNested: $paramsNested);
  if (count($resultList) > 0) {
    $output .= "<div class=\"responsive responsive--3cols responsive--collapse\">";
    $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ID_FIELD_NAME . "\">" . TOURNAMENT_ID_FIELD_LABEL . ": </label></div>\n";
//     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
    $selectTournament = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TOURNAMENT_ID, class: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, multiple: false, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
    $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectTournament->getHtml();
//     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
    $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_TOURNAMENT_ID);
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
      $option = new FormOption(debug: SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $tournamentId, suffix: null, text: $optionText, value: $tournament->getId());
      $output .= $option->getHtml();
      $cnt ++;
      if ($tournamentId == $tournament->getId()) {
        $maxRebuys = $tournament->getMaxRebuys();
        $addonAmount = $tournament->getAddonAmount();
      }
      $totalBuyin[$tournament->getId()] = array($tournament->getBuyinsPaid(), - $tournament->getBuyinAmount());
      $totalRebuy[$tournament->getId()] = array($tournament->getRebuysPaid(), $tournament->getRebuysCount(), - $tournament->getRebuyAmount());
      $totalAddon[$tournament->getId()] = array($tournament->getAddonsPaid(), - $tournament->getAddonAmount());
      if (strpos($tournament->getDescription(), "Championship") === false) {
        $championshipFlag[$tournament->getId()] = false;
        $total[$tournament->getId()] = ($totalBuyin[$tournament->getId()][0] * $totalBuyin[$tournament->getId()][1]) + ($totalRebuy[$tournament->getId()][1] * $totalRebuy[$tournament->getId()][2]) + ($totalAddon[$tournament->getId()][0] * $totalAddon[$tournament->getId()][1]);
      } else {
        $championshipFlag[$tournament->getId()] = true;
        $params = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat());
        $resultListNested = $databaseResult->getPrizePoolForSeason(params: $params, returnQuery: false);
        if (0 < count($resultListNested)) {
          $total[$tournament->getId()] = str_replace(search: ",", replace: "", subject: number_format((float) $resultListNested[0], 0));
        }
      }
      $rake[$tournament->getId()] = ceil($total[$tournament->getId()] * $tournament->getRakeForCalculation());
      $rakePercent[$tournament->getId()] = $tournament->getRakeForCalculation();
      $tournamentPayouts = $tournament->getGroupPayout()->getPayouts();
      $payouts[$tournament->getId()] = $tournamentPayouts;
    }
    $output .= "   </select>\n";
    $output .= "  </div>\n";
    $output .= " <div class=\"responsive-cell responsive-cell-button\">\n";
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonView = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_VIEW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_VIEW, maxLength: null, name: Constant::$TEXT_VIEW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_VIEW, wrap: null);
    $output .= $buttonView->getHtml();
    $output .= " </div>\n";
    $hiddenSelectedRowsPlayerId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenBuyinPaid = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_BUYIN_PAID_FIELD_NAME, maxLength: null, name: HIDDEN_ROW_BUYIN_PAID_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenBuyinPaid->getHtml();
    $hiddenRebuyPaid = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_REBUY_PAID_FIELD_NAME, maxLength: null, name: HIDDEN_ROW_REBUY_PAID_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenRebuyPaid->getHtml();
    $hiddenRebuyCount = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_REBUY_COUNT_FIELD_NAME, maxLength: null, name: HIDDEN_ROW_REBUY_COUNT_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenRebuyCount->getHtml();
    $hiddenAddonPaid = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_ADDON_PAID_FIELD_NAME, maxLength: null, name: HIDDEN_ROW_ADDON_PAID_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: null, wrap: null);
    $output .= $hiddenAddonPaid->getHtml();
    $hiddenRebuyFlag = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: REBUY_FLAG_FIELD_NAME, maxLength: null, name: REBUY_FLAG_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (isset($maxRebuys) ? (string) $maxRebuys : ""), wrap: null);
    $output .= $hiddenRebuyFlag->getHtml();
    $hiddenAddonFlag = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ADDON_FLAG_FIELD_NAME, maxLength: null, name: ADDON_FLAG_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (isset($addonAmount) ? (string) $addonAmount : ""), wrap: null);
    $output .= $hiddenAddonFlag->getHtml();
  } else {
    $output .= "No tournaments available to manage buyins";
  }
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $params = array($tournamentId);
    $query = $databaseResult->getStatusPaid(params: $params, returnQuery: true);
    $checkboxBuyinButton = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_BUYIN . "_?2", maxLength: null, name: Constant::$TEXT_BUYIN . "_?2", onClick: "input.changeState('" . Base::build(Constant::$TEXT_BUYIN, null) . "_?2', new Array(" . (0 == $maxRebuys ? "''" : "'" . Base::build(Constant::$TEXT_REBUY, null) . "_?2'") . (0 == $addonAmount ? "" : ", '" . Base::build(Constant::$TEXT_ADDON, null) . "_?2'") . ", '', '')); $('#" . HIDDEN_ROW_FIELD_NAME . "').val('?2'); $('#" . HIDDEN_ROW_STATUS_FIELD_NAME . "').val('?3'); $('#" . HIDDEN_ROW_BUYIN_PAID_FIELD_NAME . "').val('?3'); $('#mode').val('" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "');", placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: "_?2", type: FormControl::$TYPE_INPUT_CHECKBOX, value: "?1", wrap: null);
    $textBoxRebuyCount = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REBUY_COUNT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: (0 == $maxRebuys ? true : false), id: Constant::$TEXT_REBUY_COUNT . "_?2", maxLength: 2, name: Constant::$TEXT_REBUY_COUNT . "_?2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: 2, suffix: "_?2", type: FormControl::$TYPE_INPUT_TEXTBOX, value: "?4", wrap: null);
    $checkboxRebuyButton = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: (0 == $maxRebuys ? true : false), id: Constant::$TEXT_REBUY . "_?2", maxLength: null, name: Constant::$TEXT_REBUY . "_?2", onClick: "$('#" . HIDDEN_ROW_FIELD_NAME . "').val('?2'); $('#" . HIDDEN_ROW_STATUS_FIELD_NAME . "').val('?3'); $('#" . HIDDEN_ROW_REBUY_PAID_FIELD_NAME . "').val('?3'); $('#mode').val('" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "');", placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: "_?2", type: FormControl::$TYPE_INPUT_CHECKBOX, value: "?1", wrap: null);
    $checkboxAddonButton = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: (0 == $addonAmount ? true : false), id: Constant::$TEXT_ADDON . "_?2", maxLength: null, name: Constant::$TEXT_ADDON . "_?2", onClick: "$('#" . HIDDEN_ROW_FIELD_NAME . "').val('?2'); $('#" . HIDDEN_ROW_STATUS_FIELD_NAME . "').val('?3'); $('#" . HIDDEN_ROW_ADDON_PAID_FIELD_NAME . "').val('?3'); $('#mode').val('" . Constant::$MODE_SAVE_PREFIX . Constant::$MODE_CREATE . "');", placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: "_?2", type: FormControl::$TYPE_INPUT_CHECKBOX, value: "?1", wrap: null);
    $buttons = array("    " . $checkboxBuyinButton->getHtml(), "    " . $checkboxRebuyButton->getHtml() . " " . $textBoxRebuyCount->getHtml(), "    " . $checkboxAddonButton->getHtml());
    $allButtons = $buttons;
    $checkboxBuyinColumnName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_BUYIN . "CheckAll", maxLength: null, name: Constant::$TEXT_BUYIN . "CheckAll", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, type: FormControl::$TYPE_INPUT_CHECKBOX, value: null, wrap: null);
    $checkboxRebuyColumnName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: (0 == $maxRebuys ? true : false), id: Constant::$TEXT_REBUY . "CheckAll", maxLength: null, name: Constant::$TEXT_REBUY . "CheckAll", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, type: FormControl::$TYPE_INPUT_CHECKBOX, value: null, wrap: null);
    $checkboxAddonColumnName = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: (0 == $addonAmount ? true : false), id: Constant::$TEXT_ADDON . "CheckAll", maxLength: null, name: Constant::$TEXT_ADDON . "CheckAll", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: Constant::$FIELD_NAME_SUFFIX_CHECKBOX_ALL, type: FormControl::$TYPE_INPUT_CHECKBOX, value: null, wrap: null);
    $columnNames = array(Constant::$TEXT_BUYIN . "<br />" . $checkboxBuyinColumnName->getHtml(), Constant::$TEXT_REBUY . "<br />" . $checkboxRebuyColumnName->getHtml(), Constant::$TEXT_ADDON . "<br />" . $checkboxAddonColumnName->getHtml());
    $allColNames = $columnNames;
    $colIndexes = array(2, 3, 5);
    $allIndexes = $colIndexes;
    $html = array($allButtons, $allColNames, $allIndexes, array(array(Constant::$NAME_STATUS_PAID, "Not paid"), array(Constant::$NAME_STATUS_NOT_PAID, "Paid")), array(0, 4));
    $hideColIndexes = array(0, 2, 3, 4, 5);
    $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
    $output .= $hiddenMode->getHtml();
    $output .= "</div>\n";
    //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
    $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: null, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: $hideColIndexes, html: $html, id: null, link: null, note: true, query: $query, selectedRow: null, suffix: null, width: "100%");
    $temp = $htmlTable->getHtml();
    if ("" != $temp) {
      $output .= " <div class=\"buttons center\">\n";
      $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE . "_2", maxLength: null, name: Constant::$TEXT_SAVE . "_2", onClick:"inputLocal.buildData('" . Constant::$ID_TABLE_DATA . "', '" . Constant::$MODE_MODIFY . "');", placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
      $output .= $buttonSave->getHtml() . "</div>\n";
      $output .= $temp;
      $output .= " <div class=\"buttons center\">\n";
      $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_SAVE, maxLength: null, name: Constant::$TEXT_SAVE, onClick:"inputLocal.buildData('" . Constant::$ID_TABLE_DATA . "', '" . Constant::$MODE_MODIFY . "');", placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_SAVE, wrap: null);
      $output .= $buttonSave->getHtml() . "</div>\n";
    }
    if ("" != $temp) {
      $output .= "<div class=\"responsive responsive--3cols responsive--collapse\">";
      if ($championshipFlag[$tournamentId]) {
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total buyins:</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer\">" . $totalBuyin[$tournamentId][0] . "</div>\n";
      } else {
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total buyins:</div>\n";
        $totalBuyins = $totalBuyin[$tournamentId][0] * $totalBuyin[$tournamentId][1];
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer negative\">$" . $totalBuyins . "</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">(" . $totalBuyin[$tournamentId][0] . " x $" . $totalBuyin[$tournamentId][1] . ")</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total rebuys:</div>\n";
        $totalRebuys = $totalRebuy[$tournamentId][1] * $totalRebuy[$tournamentId][2];
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer negative\">$" . $totalRebuys . "</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">(" . $totalRebuy[$tournamentId][1] . " x $" . $totalRebuy[$tournamentId][2] . ")</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total addons:</div>\n";
        $totalAddons = $totalAddon[$tournamentId][0] * $totalAddon[$tournamentId][1];
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer negative\">$" . $totalAddons . "</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">(" . $totalAddon[$tournamentId][0] . " x $" . $totalAddon[$tournamentId][1] . ")</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total paid in:</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer negative\">$" . $total[$tournamentId] . "</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">($" . $totalBuyins . " + $" . $totalRebuys . " + $" . $totalAddons . ")</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total rake (" . ($rakePercent[$tournamentId] * 100) . "%):</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-footer negative\">$" . $rake[$tournamentId] . "</div>\n";
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">(" . ($rakePercent[$tournamentId] * 100) . "% x $" . $total[$tournamentId] . ")</div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Total paid out:</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-value-footer positive\">$" . ceil(($total[$tournamentId]) - ($rake[$tournamentId])) . "</div>\n";
      if (!$championshipFlag[$tournamentId]) {
        $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">($" . ($total[$tournamentId]) . " - $" . ($rake[$tournamentId]) . ")</div>\n";
      }
      $resultList = $databaseResult->getStatusPaid(params: $params, returnQuery: false);
      $countPaid = 0;
      if (count($resultList) > 0) {
        $ctr = 0;
        while ($ctr < count($resultList)) {
          if ($resultList[$ctr][2] == "Paid") {
            $countPaid++;
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
          $output .= " <div class=\"responsive-cell responsive-cell-label-footer responsive-cell--head\">Place " . $structure->getPlace() . " (" . ($structure->getPercentage() * 100) . "%):</div>\n";
          $output .= " <div class=\"responsive-cell responsive-cell-value-footer positive\">$" . number_format((($total[$tournamentId] - $rake[$tournamentId]) * $structure->getPercentage()), 0, ".", "") . "</div>\n";
          $output .= " <div class=\"responsive-cell responsive-cell-value-after-footer\">(" . ($structure->getPercentage() * 100) . "% x $" . ($total[$tournamentId] - $rake[$tournamentId]) . ")</div>\n";
          $ctr ++;
        }
      }
    }
    $output .= "</div>\n";
  } else {
    if (DEFAULT_VALUE_TOURNAMENT_ID != $tournamentId) {
      $output .= "No tournaments available to manage buyins";
    }
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
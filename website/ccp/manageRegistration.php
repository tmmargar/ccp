<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\model\Tournament;
// use ccp\classes\utility\HtmlUtility;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TOURNAMENT_FIELD_LABEL", "Tournament");
define("TOURNAMENT_ID_FIELD_NAME", "tournamentId");
define("SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME", "tournamentPlayerStatus");
define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerId");
define("DEFAULT_VALUE_TOURNAMENT_ID", "-1");
define("REGISTER_TEXT", "Register");
define("UNREGISTER_TEXT", "Un-register");
$smarty->assign("title", "Manage Registration");
$smarty->assign("heading", "Manage Registration");
$smarty->assign("style", "<link href=\"css/manageRegistration.css\" rel=\"stylesheet\">");
$tournamentId = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
$tournamentPlayerStatus = isset($_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME]) ? $tournamentPlayerStatus = $_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME] : DEFAULT_VALUE_BLANK;
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  $aryStatus = explode(Constant::$DELIMITER_DEFAULT, $tournamentPlayerStatus);
  $runOnce = true;
  // get number of registered to determine max number of wait list to process
  $valuesCount = array_count_values($aryStatus);
  $numRows = array_key_exists(Constant::$NAME_STATUS_REGISTERED, $valuesCount) ? $valuesCount[Constant::$NAME_STATUS_REGISTERED] : 0;
  $output .= 
    "<script type=\"module\">\n" .
    "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
    "  let aryMessages = [];\n";
  foreach ($ary as $index => $id) {
    $params = array($id);
    $resultList = $databaseResult->getUserById(params: $params);
    if (count($resultList) > 0) {
      $cnt = 0;
      $userName = $resultList[0]->getName();
      $userEmail = $resultList[0]->getEmail();
    }
    if ($aryStatus[$index] == Constant::$NAME_STATUS_NOT_REGISTERED) {
      $params = array($tournamentId, $id, "N/A");
      $rowCount = $databaseResult->insertRegistration(params: $params);
      if (! is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
      $state = "registering";
    } else {
      $params = array($tournamentId, $id);
      $resultList = $databaseResult->getResultByTournamentIdAndPlayerId(params: $params);
      $registerOrder = $resultList[0]->getRegisterOrder();
      // same parameter list
      $rowCount = $databaseResult->deleteRegistration(params: $params);
      if (! is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
      $state = "cancelling";
    }
    if ($aryStatus[$index] != Constant::$NAME_STATUS_NOT_REGISTERED) {
      if ($runOnce) {
        $params = array($tournamentId, $registerOrder, $numRows);
        $resultList = $databaseResult->getRegistrationWaitList(params: $params);
        // grab information for people moved from wait list to registered to send emails
        if (count($resultList) > 0) {
          $cnt = 0;
          while ($cnt < count($resultList)) {
            $values = $resultList[$cnt];
            // make sure not a wait listed person (register order <= max players)
            if ($registerOrder <= $values[2]) {
              $emailInfo[$cnt] = array($values[0], $values[1]);
            }
            $cnt ++;
          }
        }
        $runOnce = false;
      }
      $params = array($tournamentId, $registerOrder);
      $rowCount = $databaseResult->updateRegistrationCancel(params: $params);
      if (! is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
    }
    // for email ONLY
    $params = array($tournamentId);
    $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
    $resultList = $databaseResult->getTournamentById(params: $params, paramsNested: $paramsNested);
    if (count($resultList) > 0) {
      $tournament = $resultList[0];
      $tournamentAddress = $tournament->getLocation()->getUser()->getAddress();
      $waitListCount = ($tournament->getMaxPlayers() - $tournament->getRegisteredCount()) < 0 ? ($tournament->getRegisteredCount() - $tournament->getMaxPlayers()) : 0;
//       $debug, $fromName, $fromEmail, $toName, $toEmail, $ccName, $ccEmail, $bccName, $bccEmail, $subject, $body
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($userName), toEmail: array($userEmail), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
//       $debug, $id, $address, $city, $state, $zip, $phone) {
      $emailAddress = new Address(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, address: $tournamentAddress->getAddress(), city: $tournamentAddress->getCity(), state: $tournamentAddress->getState(), zip: $tournamentAddress->getZip());
//       $debug, $id, $description, $comment, $limitType, $gameType, $specialType, $chipCount, $location, $date, $startTime, $endTime, $buyinAmount, $maxPlayers, $maxRebuys, $rebuyAmount, $addonAmount, 
//       $addonChipCount, $groupPayout, $rake, $registeredCount, $buyinsPaid, $rebuysPaid, $rebuysCount, $addonsPaid, $enteredCount
      $emailTournament = new Tournament(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: $tournament->getId(), description: null, comment: null, limitType: null, gameType: null, specialType: null, chipCount: 0, location: null, date: $tournament->getDate(), startTime: $tournament->getStartTime(), endTime: null, buyinAmount: 0, maxPlayers: 0, maxRebuys: 0, rebuyAmount: 0, addonAmount: 0, addonChipCount: 0, groupPayout: null, rake: 0, registeredCount: 0, buyinsPaid: 0, rebuysPaid: 0, rebuysCount: 0, addonsPaid: 0, enteredCount: 0);
      if ("cancelling" == $state) {
        $message = $email->sendCancelledEmail(address: $emailAddress, tournament: $emailTournament);
      } else {
        $message = $email->sendRegisteredEmail(address: $emailAddress, tournament: $emailTournament, waitList: $waitListCount);
      }
      $output .= "aryMessages.push(\"" . $message . "\");\n";
    }
  }
  if (isset($emailInfo)) {
    $cnt = 0;
    // send email to people moved from wait list to registered
    while ($cnt < count($emailInfo)) {
      $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($emailInfo[$cnt][0]), toEmail: array($emailInfo[$cnt][1]), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
      $emailAddress = new Address(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, address: $tournamentAddress->getAddress(), city: $tournamentAddress->getCity(), state: $tournamentAddress->getState(), zip: $tournamentAddress->getZip());
      $emailTournament = new Tournament(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: $tournament->getId(), description: null, comment: null, limitType: null, gameType: null, specialType: null, chipCount: 0, location: null, date: $tournament->getDate(), startTime: $tournament->getStartTime(), endTime: null, buyinAmount: 0, maxPlayers: 0, maxRebuys: 0, rebuyAmount: 0, addonAmount: 0, addonChipCount: 0, groupPayout: null, rake: 0, registeredCount: 0, buyinsPaid: 0, rebuysPaid: 0, rebuysCount: 0, addonsPaid: 0, enteredCount: 0);
      $output .= "aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $emailTournament, - 99) . "\");\n";
      $cnt ++;
    }
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}\n</script>\n";
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW) {
  $output .= "<div class=\"responsive responsive--3cols responsive--collapse\">";
  $params = array("CURRENT_DATE", "DATE_ADD(t.tournamentDate, INTERVAL 28 DAY)");
  $paramsNested = array(SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat(), SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
  $resultList = $databaseResult->getTournamentForRegistration(params: $params, paramsNested: $paramsNested);
  if (count($resultList) > 0) {
    $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TOURNAMENT_ID_FIELD_NAME . "\">" . TOURNAMENT_FIELD_LABEL . ": </label></div>\n";
    //     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
    $selectTournament = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TOURNAMENT_ID, class: null, disabled: false, id: TOURNAMENT_ID_FIELD_NAME, multiple: false, name: TOURNAMENT_ID_FIELD_NAME, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
    $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectTournament->getHtml();
    //     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
    $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", suffix: null, text: Constant::$TEXT_NONE, value: DEFAULT_VALUE_TOURNAMENT_ID);
    $output .= $option->getHtml();
    foreach ($resultList as $tournament) {
      $optionText = $tournament->getDate()->getDisplayFormat();
      $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
      $optionText .= " (" . $tournament->getLocation()->getName() . ")";
      $optionText .= " " . $tournament->getLimitType()->getName();
      $optionText .= " " . $tournament->getGameType()->getName();
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 != $tournament->getAddonAmount() ? "+a" : "");
      $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
      $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . "np/" . $tournament->getBuyinsPaid() . "p";
      $optionText .= "+" . $tournament->getRebuysPaid() . "r";
      $optionText .= "+" . $tournament->getAddonsPaid() . "a";
      $optionText .= "/" . $tournament->getEnteredCount() . "ent)";
      $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $tournamentId, suffix: null, text: $optionText, value: $tournament->getId());
      $output .= $option->getHtml();
    }
    $output .= "    </select>\n";
    $output .= "   </div>\n";
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonView = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_VIEW, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_VIEW, maxLength: null, name: Constant::$TEXT_VIEW, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_VIEW, wrap: null);
    $output .= " <div class=\"responsive-cell responsive-cell-button\">" . $buttonView->getHtml() . "</div>\n";
    $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
    $output .= $hiddenMode->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerStatus = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $tournamentPlayerStatus, wrap: null);
    $output .= $hiddenSelectedRowsPlayerStatus->getHtml();
    $output .= "</div>\n";
  } else {
    $output .= "No tournaments available to manage registrations";
  }
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $output .= " <div class=\"buttons center\">\n";
    $buttonRegister = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_REGISTER, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_REGISTER, maxLength: null, name: Constant::$TEXT_REGISTER, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: Constant::$TEXT_REGISTER_UNREGISTER, wrap: null);
    $output .= $buttonRegister->getHtml();
    $output .= " </div>\n";
    $params = array($tournamentId);
    $query = $databaseResult->getTournamentForRegistrationStatus(params: $params);
    $colFormats = array(array(3, "right", 0));
    $hideColIndexes = array(0);
    //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
    $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), delimiter: Constant::$DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: TOURNAMENT_PLAYER_ID_FIELD_NAME, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: null, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
    $output .= $htmlTable->getHtml();
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
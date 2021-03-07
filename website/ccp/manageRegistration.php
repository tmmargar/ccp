<?php
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
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
$tournamentId = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
$tournamentPlayerStatus = isset($_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME]) ? $tournamentPlayerStatus = $_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME] : DEFAULT_VALUE_BLANK;
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  $aryStatus = explode(Constant::$DELIMITER_DEFAULT, $tournamentPlayerStatus);
  $runOnce = true;
  // get number of registered to determine max number of wait list to process
  $valuesCount = array_count_values($aryStatus);
  $numRows = array_key_exists(Constant::$NAME_STATUS_REGISTERED, $valuesCount) ? $valuesCount[Constant::$NAME_STATUS_REGISTERED] : 0;
  $output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
  foreach ($ary as $index => $id) {
    $params = array($id);
    $resultList = $databaseResult->getUserById($params);
    if (count($resultList) > 0) {
      $cnt = 0;
      $userName = $resultList[0]->getName();
      $userEmail = $resultList[0]->getEmail();
    }
    if ($aryStatus[$index] == Constant::$NAME_STATUS_NOT_REGISTERED) {
      $params = array($tournamentId, $id, "null");
      $rowCount = $databaseResult->insertRegistration($params);
      if (!is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
      $state = "registering";
    } else {
      $params = array($tournamentId, $id);
      $resultList = $databaseResult->getResultByTournamentIdAndPlayerId($params);
      $registerOrder = $resultList[0]->getRegisterOrder();
      // same parameter list
      $rowCount = $databaseResult->deleteRegistration($params);
      if (!is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
      $state = "cancelling";
    }
    if ($aryStatus[$index] != Constant::$NAME_STATUS_NOT_REGISTERED) {
      if ($runOnce) {
        $params = array($tournamentId, $registerOrder, $numRows);
        $resultList = $databaseResult->getRegistrationWaitList($params);
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
      $rowCount = $databaseResult->updateRegistrationCancel($params);
      if (!is_numeric($rowCount)) {
        $output .= "  aryMessages.push(\"" . $rowCount . "\");\n";
      }
    }
    // for email ONLY
    $params = array($tournamentId);
    $resultList = $databaseResult->getTournamentById($params);
    if (count($resultList) > 0) {
      $tournament = $resultList[0];
      $tournamentAddress = $tournament->getLocation()->getUser()->getAddress();
      $waitListCount = ($tournament->getMaxPlayers() - $tournament->getRegisteredCount()) < 0 ? ($tournament->getRegisteredCount() - $tournament->getMaxPlayers()) : 0;
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($userName), array($userEmail), null, null, null, null, null, null);
      $emailAddress = new Address();
      $emailAddress->setAddress($tournamentAddress->getAddress());
      $emailAddress->setCity($tournamentAddress->getCity());
      $emailAddress->setState($tournamentAddress->getState());
      $emailAddress->setZip($tournamentAddress->getZip());
      $emailTournament = new Tournament();
      $emailTournament->setDate($tournament->getDate());
      $emailTournament->setStartTime($tournament->getStartTime());
      $emailTournament->setId($tournament->getId());
      if ("cancelling" == $state) {
        $message = $email->sendCancelledEmail($emailAddress, $emailTournament);
      } else {
        $message = $email->sendRegisteredEmail($emailAddress, $emailTournament, $waitListCount);
      }
      $output .= "aryMessages.push(\"" . $message . "\");\n";
    }
  }
  if (isset($emailInfo)) {
    $cnt = 0;
    // send email to people moved from wait list to registered
    while ($cnt < count($emailInfo)) {
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($emailInfo[$cnt][0]), array($emailInfo[$cnt][1]), null, null, null, null, null, null);
      $emailAddress = new Address();
      $emailAddress->setAddress($tournamentAddress->getAddress());
      $emailAddress->setCity($tournamentAddress->getCity());
      $emailAddress->setState($tournamentAddress->getState());
      $emailAddress->setZip($tournamentAddress->getZip());
      $emailTournament = new Tournament();
      $emailTournament->setDate($tournament->getDate());
      $emailTournament->setStartTime($tournament->getStartTime());
      $emailTournament->setId($tournament->getId());
      $output .= "aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $emailTournament, - 99) . "\");\n";
      $cnt++;
    }
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW) {
  $params = array("CURRENT_DATE", "DATE_ADD(t.tournamentDate, INTERVAL 28 DAY)");
  $resultList = $databaseResult->getTournamentForRegistration($params);
  if (count($resultList) > 0) {
    $output .= "    " . TOURNAMENT_FIELD_LABEL . ": \n    ";
    $selectTournament = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TOURNAMENT_ID, null, false, TOURNAMENT_ID_FIELD_NAME, false, TOURNAMENT_ID_FIELD_NAME, null, false, 1, null, null);
    $output .= $selectTournament->getHtml();
    $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, !isset($tournamentId) ? DEFAULT_VALUE_TOURNAMENT_ID : "", null, Constant::$TEXT_NONE, DEFAULT_VALUE_TOURNAMENT_ID);
    $output .= $option->getHtml();
    foreach ($resultList as $tournament) {
      $optionText = $tournament->getDate()->getDisplayDatePickerFormat();
      $optionText .= "@" . $tournament->getStartTime()->getDisplayAmPmFormat();
      $optionText .= " (" . $tournament->getLocation()->getName() . ")";
      $optionText .= " " . $tournament->getLimitType()->getName();
      $optionText .= " " . $tournament->getGameType()->getName();
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 != $tournament->getAddonAmount() ? "+a" : "");
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 != $tournament->getAddonAmount() ? "+a" : "");
      $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
      $optionText .= " (" . $tournament->getRegisteredCount() . ($waitListCnt > 0 ? "+" . $waitListCnt . "wl" : "") . " not paid/" . $tournament->getBuyinsPaid() . " paid";
      $optionText .= "+" . $tournament->getRebuysPaid() . "r paid";
      $optionText .= "+" . $tournament->getAddonsPaid() . "a paid";
      $optionText .= "/" . $tournament->getEnteredCount() . " entered)";
      $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $tournamentId, null, $optionText, $tournament->getId());
      $output .= $option->getHtml();
    }
    $output .= "    </select>\n";
    $buttonView = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_VIEW, null, false, null, null, null, false, Constant::$TEXT_VIEW, null, Constant::$TEXT_VIEW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_VIEW, null);
    $output .= $buttonView->getHtml();
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
    $output .= $hiddenSelectedRowsPlayerId->getHtml();
    $hiddenSelectedRowsPlayerStatus = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME, null, SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $tournamentPlayerStatus, null);
    $output .= $hiddenSelectedRowsPlayerStatus->getHtml();
  } else {
    $output .= "No tournaments available to manage registrations";
  }
  if ($tournamentId != DEFAULT_VALUE_TOURNAMENT_ID) {
    $buttonRegister = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REGISTER, null, false, null, null, null, false, Constant::$TEXT_REGISTER, null, Constant::$TEXT_REGISTER, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_REGISTER_UNREGISTER, null);
    $output .= $buttonRegister->getHtml();
    $params = array($tournamentId);
    $query = $databaseResult->getTournamentForRegistrationStatus($params);
    $caption = "When clicking Register / un-register button above it will act on all rows selected and appropriately register or un-register them";
    $colFormats = array(array(3, "right", 0));
    $hideColIndexes = array(0);
    $htmlTable = new HtmlTable($caption, array("override30"), null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, TOURNAMENT_PLAYER_ID_FIELD_NAME, $hideColIndexes, null, null, null, true, $query, $ids, null, "30%");
    $output .= $htmlTable->getHtml();
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
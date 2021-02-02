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
define("SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerIds");
define("SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME", "tournamentPlayerStatus");
define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("TOURNAMENT_PLAYER_ID_FIELD_NAME", "tournamentPlayerId");
define("DEFAULT_VALUE_TOURNAMENT_PLAYER_IDS", "");
define("DEFAULT_VALUE_TOURNAMENT_PLAYER_STATUS", "");
define("DEFAULT_VALUE_TOURNAMENT_ID", "-1");
define("REGISTER_TEXT", "Register");
define("UNREGISTER_TEXT", "Un-register");
$smarty->assign("title", "Chip Chair and a Prayer Manage Registration");
$smarty->assign("script", "<script src=\"scripts/manageRegistration.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Registration");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageRegistration");
$output = "";
$tournamentPlayerIds = isset($_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME]) ? $_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME] : $tournamentPlayerIds = DEFAULT_VALUE_TOURNAMENT_PLAYER_IDS;
$tournamentPlayerStatus = isset($_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME]) ? $tournamentPlayerStatus = $_POST[SELECTED_ROWS_TOURNAMENT_PLAYER_STATUS_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_PLAYER_STATUS;
$tournamentId = isset($_POST[TOURNAMENT_ID_FIELD_NAME]) ? $_POST[TOURNAMENT_ID_FIELD_NAME] : DEFAULT_VALUE_TOURNAMENT_ID;
$tournamentDate = "CURRENT_DATE";
$tournamentDateMax = "DATE_ADD(t.tournamentDate, INTERVAL 28 DAY)";
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $databaseResult = new DatabaseResult(true);
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $tournamentPlayerIds);
  $aryStatus = explode(Constant::$DELIMITER_DEFAULT, $tournamentPlayerStatus);
  $runOnce = true;
  // get number of registered to determine max number of wait list to process
  $valuesCount = array_count_values($aryStatus);
  $numRows = array_key_exists(Constant::$NAME_STATUS_REGISTERED, $valuesCount) ? $valuesCount[Constant::$NAME_STATUS_REGISTERED] : 0;
  $ctr = 0;
  while ($ctr < count($ary)) {
    $params = array($ary[$ctr]);
    $resultList = $databaseResult->getUserById($params);
    if (count($resultList) > 0) {
      $cnt = 0;
      $userName = $resultList[0]->getName();
      $userEmail = $resultList[0]->getEmail();
    }
    if ($aryStatus[$ctr] == Constant::$NAME_STATUS_NOT_REGISTERED) {
      $params = array($tournamentId, $ary[$ctr], "null");
      $rowCount = $databaseResult->insertRegistration($params);
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $state = "registering";
    } else {
      $params = array($tournamentId, $ary[$ctr]);
      $resultList = $databaseResult->getResultByTournamentIdAndPlayerId($params);
      $registerOrder = $resultList[0]->getRegisterOrder();
      // same parameter list
      $rowCount = $databaseResult->deleteRegistration($params);
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
      }
      $state = "cancelling";
    }
    if ($aryStatus[$ctr] != Constant::$NAME_STATUS_NOT_REGISTERED) {
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
      if (! is_numeric($rowCount)) {
        $output .= "<script type=\"text/javascript\">\n" . "  display.showErrors([ \"" . $rowCount . "\" ]);\n" . "</script>\n";
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
        $output .= $email->sendCancelledEmail($emailAddress, $emailTournament);
      } else {
        $output .= $email->sendRegisteredEmail($emailAddress, $emailTournament, $waitListCount);
      }
    }
    $ctr ++;
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
      $output .= $email->sendRegisteredEmail($emailAddress, $emailTournament, - 99);
      $cnt ++;
    }
  }
  $tournamentPlayerIds = DEFAULT_VALUE_TOURNAMENT_PLAYER_IDS;
  $mode = Constant::$MODE_VIEW;
}
if ($mode == Constant::$MODE_VIEW) {
  $params = array($tournamentDate, $tournamentDateMax);
  $resultList = $databaseResult->getTournamentForRegistration($params);
  if (count($resultList) > 0) {
    $output .= "    " . TOURNAMENT_FIELD_LABEL . ": \n    ";
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
      $optionText .= " " . $tournament->getMaxRebuys() . "r" . (0 != $tournament->getAddonAmount() ? "+a" : "");
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
    $buttonView = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_VIEW, null, false, null, null, null, false, Constant::$TEXT_VIEW, null, Constant::$TEXT_VIEW, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_VIEW, null);
    $output .= $buttonView->getHtml();
    $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
    $output .= $hiddenMode->getHtml();
    $hiddenSelectedRowsPlayerId = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME, null, SELECTED_ROWS_TOURNAMENT_PLAYER_ID_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $tournamentPlayerIds, null);
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
    $htmlTable = new HtmlTable($caption, array("override30"), null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, TOURNAMENT_PLAYER_ID_FIELD_NAME, $hideColIndexes, null, null, null, true, $query, $tournamentPlayerIds, null, "30%");
    $output .= $htmlTable->getHtml();
  }
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
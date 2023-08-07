<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\Phone;
use ccp\classes\model\Tournament;
use DateInterval;
use ccp\classes\model\BooleanString;
require_once "init.php";
define("TOURNAMENT_ID_PARAMETER_NAME", "tournamentId");
define("USER_ID_PARAMETER_NAME", "userId");
define("FOOD_FIELD_NAME", "food");
define("REGISTERED_FIELD_NAME", "registered");
define("REGISTERED_LABEL", "Registered");
define("UPDATE_REGISTER_TEXT", "Update");
define("WAIT_LIST_COUNT_FIELD_NAME", "waitListCount");
$smarty->assign("title", "Chip Chair and a Prayer Registration");
$output = "";
$output2 = "";
$smarty->assign("formName", "frmRegistration");
$tournamentId = (isset($_POST[TOURNAMENT_ID_PARAMETER_NAME]) ? $_POST[TOURNAMENT_ID_PARAMETER_NAME] : isset($_GET[TOURNAMENT_ID_PARAMETER_NAME])) ? $_GET[TOURNAMENT_ID_PARAMETER_NAME] : "";
$urlAction = $_SERVER["SCRIPT_NAME"] . "?tournamentId=" . $tournamentId;
$smarty->assign("action", $urlAction);
$smarty->assign("heading", "Registration");
$output .= 
  "<script type=\"module\">\n" .
  "  import { dataTable, display, input } from \"../scripts/import.js\";\n" .
  "  let aryMessages = [];\n" .
  "  let aryErrors = [];\n" .
  "</script>\n";
//if (!isset($tournamentId) || "" == $tournamentId) {
  //$output .= " aryErrors.push(\"Unable to identify tournament to register for.\");\n";
//} else {
  //$userId = (isset($_POST[USER_ID_PARAMETER_NAME]) ? $_POST[USER_ID_PARAMETER_NAME] : isset($_GET[USER_ID_PARAMETER_NAME])) ? $_GET[USER_ID_PARAMETER_NAME] : "35";
  $mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
  /*$now = new DateTime(debug: false, id: null, time: "now");
  $registerText = Constant::$TEXT_REGISTER;
  $registered = false;
  if (isset($_POST[REGISTERED_FIELD_NAME]) && (1 == $_POST[REGISTERED_FIELD_NAME])) {
    $registered = true;
  }
  $waitListCount = isset($_POST["waitListCount"]) ? $_POST["waitListCount"] : 0;
  if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_SEND_EMAIL) {
    $params = array($tournamentId);
    $paramsNested = array("2023-01-01", "2023-12-31", 8);
    $resultList = $databaseResult->getTournamentById(params: $params, paramsNested: $paramsNested);
    if (0 < count($resultList)) {
      $tournament = $resultList[0];
      $tournamentLocationUser = $tournament->getLocation()->getUser();
      $tournamentAddress = $tournament->getLocation()->getUser()->getAddress();
      $waitListCount = ($tournament->getRegisteredCount() > $tournament->getMaxPlayers()) ? ($tournament->getRegisteredCount() - $tournament->getMaxPlayers()) : 0;
      $output .= "  if (aryErrors.length > 0) {display.showErrors({errors: aryErrors});}\n";
      $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}\n</script>\n";
      if ($tournament->getDescription() == "Championship") {
        $maxPlayers = 36;
      } else {
        $maxPlayers = $tournament->getMaxPlayers();
      }
      $dateTimeRegistrationClose = new DateTime(debug: false, id: null, time: $tournament->getDate()->getDatabaseFormat() . " " . $tournament->getRegistrationClose()->getDisplayAmPmFormat());
      // $registrationCloseDate = $dateTimeRegistrationClose->getDatabaseFormat();
      $tournamentDateClone = clone $tournament->getDate();
      $registrationOpenDate = new DateTime(debug: false, id: null, time: $tournamentDateClone->getDatabaseFormat() . " 12:00:00");
      $interval = new DateInterval(Constant::$INTERVAL_DATE_REGISTRATION_OPEN);
      $registrationOpenDate->getTime()->sub($interval);
      if ($tournament->getDescription() == "Championship") {
        $registeredCount = 0;
      } else {
        if ($now < $dateTimeRegistrationClose) {
        $registeredCount = ($tournament->getRegisteredCount() <= $maxPlayers) ? ($maxPlayers - $tournament->getRegisteredCount()) : 0;
        } else {
        $registeredCount = 0;
        }
      }*/
      //$params = array($tournamentId, false);
      //$resultList = $databaseResult->getResultRegisteredByTournamentId(params: $params);
      // temporary for testing
      //$resultList = $databaseResult->getResultFinishedByTournamentId(params: $params);
      $tournamentDate = isset($_GET["tournamentDate"]) ? $_GET["tournamentDate"] : "";
      $max = $_GET["max"] !== "Y" ? true : false;
      $params = array($tournamentDate, $max);
      // date (YYYY-MM-DD) and true if max false if not
      $resultList = $databaseResult->getRegistrationList(params: $params);
      if (0 < count($resultList)) {
        $count = 0;
        $registered = false;
        $output2 .= " <table id=\"output\">\n <tbody>\n";
        foreach ($resultList as $result) {
          /*if ($userId == $result->getUser()->getId()) {
            $registered = true;
            $registerText = UPDATE_REGISTER_TEXT;
          }
          // wait list goes here
          if ($count == $maxPlayers) {
            $output2 .= " <h3>Wait List</h3>";
          }*/
          $output2 .= "  <tr>\n";
          $output2 .= "   <td>" . $result[0] . " " . $result[1] . "</td>\n";
          $output2 .= "   <td>" . $result[2] . "</td>\n";
          $output2 .= "  </tr>\n";
          $count++;
        }
        $output2 .= "</tbody>\n</table>\n";
      } else {
        $output2 .= "  None\n";
      }
      // if not registered and there is a wait list
      /*if (!$registered && isset($count) && $count >= $maxPlayers) {
        $registerText = "Add to wait list";
      }
      // $params = array($userId, $startDate, $endDate);
      $params = array($userId, "2023-01-01", "2023-12-31");
      $resultList = $databaseResult->getTournamentsPlayedByPlayerIdAndDateRange(params: $params);
      if (0 < count($resultList)) {
        $numPlayed = $resultList[0];
      }
      // check in registration range and not full
      if (($now->getTime() >= $registrationOpenDate->getTime()) && ($now->getTime() <= $dateTimeRegistrationClose->getTime())) {
        if ($tournament->getDescription() == "Championship" && 8 > $numPlayed) {
          $output .= 
            "<script type=\"module\">\n" .
            "  import { dataTable, display, input } from \"../scripts/import.js\";\n" .
            "  aryMessages = [];\n" .
            "  aryErrors = [];\n";
          $output .= "  aryErrors.push(\"You are not allowed to register for the Championship because you only played " . $numPlayed . " tournaments and did not meet the " . 8 . " tournament minimum to qualify.\");\n";
          $output .= "  if (aryErrors.length > 0) {display.showErrors({errors: aryErrors});}\n";
          $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}\n</script>\n";
        }
      }*/
      $output .= $output2;
      /*$hiddenMode = new FormControl(debug: false, accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
      $output .= $hiddenMode->getHtml();
      $hiddenRegistered = new FormControl(debug: false, accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: REGISTERED_FIELD_NAME, maxLength: null, name: REGISTERED_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (string) $registered, wrap: null);
      $output .= $hiddenRegistered->getHtml();
      $hiddenWaitListCount = new FormControl(debug: false, accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: WAIT_LIST_COUNT_FIELD_NAME, maxLength: null, name: WAIT_LIST_COUNT_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: (string) $waitListCount, wrap: null);
      $output .= $hiddenWaitListCount->getHtml();
    }
  }
}*/
$smarty->assign("content", $output);
$smarty->display("registration_svc.tpl");
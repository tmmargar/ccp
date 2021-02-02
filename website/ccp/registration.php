<?php
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\Phone;
use ccp\classes\model\Tournament;
use ccp\classes\utility\SessionUtility;
use DateInterval;
require_once "init.php";
define("TOURNAMENT_ID_PARAMETER_NAME", "tournamentId");
define("USER_ID_PARAMETER_NAME", "userId");
define("FOOD_FIELD_NAME", "food");
define("REGISTERED_FIELD_NAME", "registered");
define("ALREADY_REGISTERED_LABEL", "Already registered");
define("UPDATE_REGISTER_TEXT", "Update registration");
define("WAIT_LIST_COUNT_FIELD_NAME", "waitListCount");
$smarty->assign("title", "Chip Chair and a Prayer Tournament Registration");
$output = "";
$style =
  "<style type=\"text/css\">\n" .
  "  h1, h3 {\n" .
  "    margin: 0;\n" .
  "  }\n" .
  " </style>\n";
$smarty->assign("style", $style);
$smarty->assign("formName", "frmRegistration");
$tournamentId = (isset($_POST[TOURNAMENT_ID_PARAMETER_NAME]) ? $_POST[TOURNAMENT_ID_PARAMETER_NAME] : isset($_GET[TOURNAMENT_ID_PARAMETER_NAME])) ? $_GET[TOURNAMENT_ID_PARAMETER_NAME] : "";
$urlAction = $_SERVER["SCRIPT_NAME"] . "?tournamentId=" . $tournamentId;
$smarty->assign("action", $urlAction);
$smarty->assign("heading", "Tournament Registration");

if (! isset($tournamentId) || "" == $tournamentId) {
  $output .= "Unable to identify tournament to register for";
} else {
  $userId = (isset($_POST[USER_ID_PARAMETER_NAME]) ? $_POST[USER_ID_PARAMETER_NAME] : isset($_GET[USER_ID_PARAMETER_NAME])) ? $_GET[USER_ID_PARAMETER_NAME] : SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID);
  $mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
  $now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
//   $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $now->getCurrentYearFormat() . DateTime::$DATE_START_SEASON);
//   $startDate = $dateTime->getDatabaseFormat();
//   $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $now->getCurrentYearFormat() . DateTime::$DATE_END_SEASON);
//   $endDate = $dateTime->getDatabaseFormat();
  $databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
//   $databaseResult = new DatabaseResult(true);
  $output = "";
  $registerText = Constant::$TEXT_REGISTER;
  $registered = false;
  if (isset($_POST[REGISTERED_FIELD_NAME]) && (1 == $_POST[REGISTERED_FIELD_NAME])) {
    $registered = true;
  }
  $waitListCount = isset($_POST["waitListCount"]) ? $_POST["waitListCount"] : 0;
  if (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
    $food = isset($_POST[FOOD_FIELD_NAME]) ? "\"" . $_POST[FOOD_FIELD_NAME] . "\"" : "NULL";
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      if ($registered) {
        $params = array($food, $tournamentId, $userId);
        $databaseResult->updateRegistration($params);
        $state = "updating your registration";
      } else {
        $params = array($tournamentId, $userId, $food);
        $databaseResult->insertRegistration($params);
        $state = "registering";
      }
    } else {
      $params = array($tournamentId, $userId);
      $resultList = $databaseResult->getResultByTournamentIdAndPlayerId($params);
      $registerOrder = $resultList[0]->getRegisterOrder();
      $databaseResult->deleteRegistration($params);
      $registered = false;
      $state = "cancelling";
    }
    if (Constant::$MODE_SAVE_CREATE != $mode) {
      $params = array($tournamentId, $registerOrder);
      $databaseResult->updateRegistrationCancel($params);
      $waitListEmail = true;
    }
    $mode = Constant::$MODE_SEND_EMAIL;
    $output .= "Thank you for " . $state . ". <a href=\"registrationList.php\">Click here</a> to register for more tournaments.<br>";
  }
  if ($mode == Constant::$MODE_VIEW || $mode == Constant::$MODE_SEND_EMAIL) {
    $params = array($tournamentId);
    $resultList = $databaseResult->getTournamentById($params);
    if (0 < count($resultList)) {
      $tournament = $resultList[0];
      $tournamentAddress = $tournament->getLocation()->getUser()->getAddress();
      $waitListCount = ($tournament->getRegisteredCount() > $tournament->getMaxPlayers()) ? ($tournament->getRegisteredCount() - $tournament->getMaxPlayers()) : 0;
      if ($mode == Constant::$MODE_SEND_EMAIL) {
        // if set means email notification required and need location information from view query
        if (isset($state)) {
          $params = array($userId);
          $resultList = $databaseResult->getUserById($params);
          if (0 < count($resultList)) {
            $user = $resultList[0];
            $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($user->getName()), array($user->getEmail()), null, null, null, null, null, null);
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
          if (isset($waitListEmail)) {
            // send email to person who moved from wait list to registered
            $params = array($tournamentId);
            $resultList = $databaseResult->getWaitListedPlayerByTournamentId($params);
            if (0 < count($resultList)) {
              $waitListName = $resultList[0];
              $waitListEmail = $resultList[1];
              $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($waitListName), array($waitListEmail), null, null, null, null, null, null);
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
              // send email to CCP staff
              $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), null, null, null, null, null, null);
              $emailAddress = new Address();
              $emailAddress->setAddress($tournamentAddress->getAddress());
              $emailAddress->setCity($tournamentAddress->getCity());
              $emailAddress->setState($tournamentAddress->getState());
              $emailAddress->setZip($tournamentAddress->getZip());
              $emailTournament = new Tournament();
              $emailTournament->setDate($tournament->getDate());
              $emailTournament->setStartTime($tournament->getStartTime());
              $emailTournament->setId($tournament->getId());
              $output .= $email->sendRegisteredEmail($emailAddress, $emailTournament, $user->getName() . " un-registered and " . $waitListName);
            }
          }
        }
      } else {
        $output .= "  <div style=\"float: left; width: 350px;\">" . $tournament->getDescription() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 350px;\">" . $tournament->getComment() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 350px;\">Hosted by " . $tournament->getLocation()->getUser()->getName() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "<div style=\"float: left; width: 350px;\">" . $tournament->getLimitType()->getName() . " " . $tournament->getGameType()->getName() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 350px;\">$" . - $tournament->getBuyinAmount() . " for " . $tournament->getChipCount() . " chips</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 350px;\">" . $tournament->getMaxRebuys() . " rebuy(s) in first hour, $" . - $tournament->getRebuyAmount() . " for " . $tournament->getChipCount() . " chips</div>\n";
        if (0 != $tournament->getAddonAmount()) {
          $output .= "  <div style=\"clear: both;\"></div>\n";
          $output .= "  <div style=\"float: left; width: 350px;\">addon, $" . - $tournament->getAddonAmount() . " for " . $tournament->getAddonChipCount() . " chips</div>\n";
        }
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <br />\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Date &amp; Time:</div>\n";
        $output .= "  <div style=\"float: left;\">" . $tournament->getDate()->getDisplayLongFormat() . " " . $tournament->getStartTime()->getDisplayAmPmFormat() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Map:</div>\n";
        $output .= "  <div style=\"float: left;\">" . $tournament->getLocation()->buildMapUrl() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Location:</div>\n";
        $phone = new Phone($tournamentAddress->getPhone());
        $output .= "  <div style=\"float: left;\">" . $tournamentAddress->getAddress() . "<br />" . $tournamentAddress->getCity() . ", " . $tournamentAddress->getState() . " " . $tournamentAddress->getZip() . "<br />" . $phone->getDisplayFormatted() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Registrations available:</div>\n";
        if ($tournament->getDescription() == "Championship") {
        } else {
          $maxPlayers = $tournament->getMaxPlayers();
        }
        $dateTimeRegistrationClose = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournament->getDate()->getDatabaseFormat() . " " . $tournament->getRegistrationClose()->getDisplayAmPmFormat());
//         $registrationCloseDate = $dateTimeRegistrationClose->getDatabaseFormat();
        $tournamentDateClone = clone $tournament->getDate();
        $registrationOpenDate = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournamentDateClone->getDatabaseFormat() . " 12:00:00");
        $interval = new DateInterval(Constant::$INTERVAL_DATE_REGISTRATION_OPEN);
        $registrationOpenDate->getTime()->sub($interval);
        if ($now->getDatabaseFormat() < $dateTimeRegistrationClose->getDatabaseFormat()) {
          $registeredCount = ($tournament->getRegisteredCount() <= $maxPlayers) ? ($maxPlayers - $tournament->getRegisteredCount()) : 0;
        } else {
          $registeredCount = 0;
        }
        $output .= "  <div style=\"float: left;\">" . $registeredCount . " out of " . $maxPlayers . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Wait list count:</div>\n";
        $output .= "  <div style=\"float: left;\">" . $waitListCount . " (if someone un-registers then first person in wait list is automatically moved to registered)</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $output .= "  <div style=\"float: left; width: 175px;\">Registration deadline:</div>\n";
//        $output .= "  <div style=\"float: left;\">" . DateTimeUtility::getDateAndTimeDisplayLongFormat($registrationCloseDate) . "</div>\n";
//         $dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $registrationCloseDate);
        $output .= "  <div style=\"float: left;\">" . $dateTimeRegistrationClose->getDisplayLongTimeFormat() . "</div>\n";
        $output .= "  <div style=\"clear: both;\"></div>\n";
        $params = array($tournamentId, $userId);
        $resultList = $databaseResult->getFoodByTournamentIdAndPlayerId($params);
        $output .= "  <br />\n";
        if (0 < count($resultList)) {
          $output .= "  <div style=\"float: left; width: 175px;\">Full Name:</div>\n";
          $output .= "  <div style=\"float: left;\">" . $resultList[0] . "</div>\n";
          $output .= "  <div style=\"clear: both;\"></div>\n";
          $output .= "  <div style=\"float: left; width: 175px;\">Email:</div>\n";
          $output .= "  <div style=\"float: left;\">" . $resultList[1] . "</div>\n";
          $output .= "  <div style=\"clear: both;\"></div>\n";
          $output .= "  <div style=\"float: left; width: 175px;\">Dish to pass:</div>\n";
          $output .= "  <div style=\"float: left;\">";
          $food = $resultList[2];
          if (($now->getTime() >= $registrationOpenDate->getTime()) && ($now->getTime() <= $dateTimeRegistrationClose->getTime())) {
              $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_FOOD, null, true, null, null, null, false, FOOD_FIELD_NAME, null, FOOD_FIELD_NAME, null, null, false, null, null, 50, null, FormControl::$TYPE_INPUT_TEXTBOX, $food, null);
              $output .= $textBoxName->getHtml();
          } else {
            $output .= $food;
          }
          $output .= "</div>\n";
          $output .= "  <div style=\"clear: both;\"></div>\n";
        }
        $output2 = "  <h3>" . ALREADY_REGISTERED_LABEL . " (displayed in order of registration)</h3>\n";
        $params = array($tournamentId);
        $resultList = $databaseResult->getResultRegisteredByTournamentId($params);
        if (0 < count($resultList)) {
          $count = 0;
          $registered = false;
          foreach ($resultList as $result) {
            if ($userId == $result->getUser()->getId()) {
              $registered = true;
              $registerText = UPDATE_REGISTER_TEXT;
            }
            // wait list goes here
            if ($count == $maxPlayers) {
              $output2 .= " <h3>Wait List (displayed in order of registration)</h3>";
            }
            $output2 .= "  <div style=\"float: left; width: 175px;\">" . $result->getUser()->getName() . "</div>\n";
            $output2 .= "  <div style=\"float: left;\">" . $result->getFood() . "</div>\n";
            $output2 .= "  <div style=\"clear: both; padding-bottom: 2px;\"></div>\n";
            $count ++;
          }
        } else {
          $output2 .= "  None\n";
        }
        // if not registered and there is a wait list
        if (! $registered && isset($count) && $count >= $maxPlayers) {
          $registerText = "Add to wait list";
        }
//         $params = array($userId, $startDate, $endDate);
        $params = array($userId, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat(), SessionUtility::getValue(SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat());
        $resultList = $databaseResult->getTournamentsPlayedByPlayerIdAndDateRange($params);
        if (0 < count($resultList)) {
          $numPlayed = $resultList[0];
        }
        // check in registration range and not full
        if (($now->getTime() >= $registrationOpenDate->getTime()) && ($now->getTime() <= $dateTimeRegistrationClose->getTime())) {
          if ($tournament->getDescription() == "Championship" && 10 > $numPlayed) {
            $output .= "You are not allowed to register for the Championship because you only played " . $numPlayed . " tournaments and did not meet the " . Constant::$COUNT_TOURNAMENT_QUALIFY_CHAMPIONSHIP . " tournament minimum to qualify";
          } else {
            $buttonRegister = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_REGISTER, null, false, null, null, null, (isset($food) ? "" : " disabled"), Constant::$TEXT_REGISTER, null, Constant::$TEXT_REGISTER, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, $registerText, null);
            $output .= $buttonRegister->getHtml();
            $buttonUnregister = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_UNREGISTER, null, false, null, null, null, (!$registered ? "disabled" : ""), Constant::$TEXT_UNREGISTER, null, Constant::$TEXT_UNREGISTER, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_UNREGISTER, null);
            $output .= $buttonUnregister->getHtml();
          }
        }
        $output .= $output2;
        $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
        $output .= $hiddenMode->getHtml();
        $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, REGISTERED_FIELD_NAME, null, REGISTERED_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $registered, null);
        $output .= $hiddenMode->getHtml();
        $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, WAIT_LIST_COUNT_FIELD_NAME, null, WAIT_LIST_COUNT_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $waitListCount, null);
        $output .= $hiddenMode->getHtml();
      }
    }
  }
}
$smarty->assign("content", $output);
$smarty->display("registration.tpl");
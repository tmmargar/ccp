<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Email;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
if (Constant::FLAG_LOCAL()) {
  set_time_limit(240);
}
$now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
$output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
$output .= isset($mode) ? "  aryMessages.push(\"###Run at " . $now->getDisplayLongTimeFormat() . "###\");\n" : "\r";
$days = 14;
$params = array($days);
$resultList = $databaseResult->getUsersForEmailNotifications($params);
$resultList2 = $databaseResult->getTournamentsForEmailNotifications($params);
if (count($resultList2) == 0) {
  $output .= isset($mode) ? "  aryMessages.push(\"No tournaments needing auto email notification for registration open (" . $days . " days before)\");\n" : "\r";
} else {
  foreach ($resultList as $user) {
    foreach ($resultList2 as $tournament) {
      $dt = new \DateTime();
      // echo "<br>" . $user->getName() . " -- " . $dt->getTimestamp();
      $locationUser = $tournament->getLocation()->getUser();
      $tournamentAddress = $locationUser->getAddress();
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($user->getName()), array($user->getEmail()), null, null, null, null, null, null);
      $emailAddress = new Address(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournamentAddress->getAddress(), $tournamentAddress->getCity(), $tournamentAddress->getState(), $tournamentAddress->getZip(), null);
      $output .= isset($mode) ? "  aryMessages.push(\"" . $email->sendReminderEmail($emailAddress, $tournament, 0) . "\");\n" : "\r";
    }
  }
}
$days = 2;
$params = array($days);
$resultList = $databaseResult->getUsersForEmailNotifications($params);
$resultList2 = $databaseResult->getTournamentsForEmailNotifications($params);
if (count($resultList2) == 0) {
  $output .= isset($mode) ? "  aryMessages.push(\"No tournaments needing auto email notification for registration open (" . $days . " days before)\");\n" : "\r";
} else {
  foreach ($resultList as $user) {
    foreach ($resultList2 as $tournament) {
      $locationUser = $tournament->getLocation()->getUser();
      $tournamentAddress = $locationUser->getAddress();
      $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($user->getName()), array($user->getEmail()), null, null, null, null, null, null);
      $emailAddress = new Address(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, $tournamentAddress->getAddress(), $tournamentAddress->getCity(), $tournamentAddress->getState(), $tournamentAddress->getZip(), null);
      $output .= isset($mode) ? "  aryMessages.push(\"" . $email->sendReminderEmail($emailAddress, $tournament, 0) . "\");\n" : "\r";
    }
  }
}
$output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
if (isset($_GET[Constant::$FIELD_NAME_MODE])) {
  $smarty->assign("title", "Chip Chair and a Prayer Auto Reminder");
  $smarty->assign("heading", "Auto Reminder");
  $smarty->assign("mode", Constant::$MODE_VIEW);
  $smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
  $smarty->assign("formName", "frmAutoReminder");
  $smarty->assign("content", $output);
  $smarty->display("base.tpl");
} else {
  echo $output;
}
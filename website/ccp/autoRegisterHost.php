<?php
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Email;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
$now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
$output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
$output .= isset($mode) ? "  aryMessages.push(\"###Run at " . $now->getDisplayLongTimeFormat() . "###\");\n" : "\r";
$dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
$params = array($dateTime->getDatabaseFormat(), $dateTime->getDatabaseFormat());
$resultList = $databaseResult->getAutoRegisterHost($params);
if (count($resultList) == 0) {
  $output .= isset($mode) ? "  aryMessages.push(\"No tournaments needing auto host registration or host is already registered\");\n" : "\r";
} else {
  foreach ($resultList as $tournament) {
    $user = $tournament->getLocation()->getUser();
    $params = array($tournament->getId(), $user->getId(), "NULL");
    $rowCount = $databaseResult->insertRegistration($params);
    if (1 == $rowCount) {
      $output .= isset($mode) ? "  aryMessages.push(\"Successfully registered " . $user->getName() . " for tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat() . "\");\n" : "\r";
    }
    $tournamentAddress = $user->getAddress();
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($user->getName()), array($user->getEmail()), null, null, null, null, null, null);
    $emailAddress = new Address();
    $emailAddress->setAddress($tournamentAddress->getAddress());
    $emailAddress->setCity($tournamentAddress->getCity());
    $emailAddress->setState($tournamentAddress->getState());
    $emailAddress->setZip($tournamentAddress->getZip());
    $output .= (isset($mode) ? "  aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $tournament, 0) . "\");\n" : "\r");
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), null, null, null, null, null, null);
    $emailAddress = new Address();
    $emailAddress->setAddress($tournamentAddress->getAddress());
    $emailAddress->setCity($tournamentAddress->getCity());
    $emailAddress->setState($tournamentAddress->getState());
    $emailAddress->setZip($tournamentAddress->getZip());
    $output .= isset($mode) ? "  aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $tournament, 0, $user->getName()) . "\");\n" : "\r";
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
}
if (isset($_GET[Constant::$FIELD_NAME_MODE])) {
  $smarty->assign("title", "Chip Chair and a Prayer Auto Register Host");
  $smarty->assign("heading", "Auto Register Host");
  $smarty->assign("mode", Constant::$MODE_VIEW);
  $smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
  $smarty->assign("formName", "frmAutoRegisterHost");
  $smarty->assign("content", $output);
  $smarty->display("base.tpl");
} else {
  echo $output;
}
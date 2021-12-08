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
$now = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
$output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
$output .= isset($mode) ? "  aryMessages.push(\"###Run at " . $now->getDisplayLongTimeFormat() . "###\");\n" : "\r";
$dateTime = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
$params = array($dateTime->getDatabaseFormat(), $dateTime->getDatabaseFormat());
$resultList = $databaseResult->getAutoRegisterHost(params: $params);
if (count($resultList) == 0) {
  $output .= isset($mode) ? "  aryMessages.push(\"No tournaments needing auto host registration or host is already registered\");\n" : "\r";
} else {
  foreach ($resultList as $tournament) {
    $user = $tournament->getLocation()->getUser();
    $params = array($tournament->getId(), $user->getId(), null);
    $rowCount = $databaseResult->insertRegistration(params: $params);
    if (1 == $rowCount) {
      $output .= isset($mode) ? "  aryMessages.push(\"Successfully registered " . $user->getName() . " for tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat() . "\");\n" : "\r";
    }
    $tournamentAddress = $user->getAddress();
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($user->getName()), toEmail: array($user->getEmail()), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
    $emailAddress = new Address(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, address: $tournamentAddress->getAddress(), city: $tournamentAddress->getCity(), state: $tournamentAddress->getState(), zip: $tournamentAddress->getZip());
    $output .= (isset($mode) ? "  aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $tournament, 0) . "\");\n" : "\r");
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array(Constant::$NAME_STAFF), toEmail: array(Constant::EMAIL_STAFF()), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: null, body: null);
    $emailAddress = new Address(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, address: $tournamentAddress->getAddress(), city: $tournamentAddress->getCity(), state: $tournamentAddress->getState(), zip: $tournamentAddress->getZip());
    $output .= isset($mode) ? "  aryMessages.push(\"" . $email->sendRegisteredEmail($emailAddress, $tournament, 0, $user->getName()) . "\");\n" : "\r";
  }
}
$output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
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
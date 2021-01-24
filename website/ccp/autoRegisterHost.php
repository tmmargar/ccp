<?php
namespace ccp;
use ccp\classes\model\Address;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Email;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
// php cgi is older and does not support what is needed so just using plain constructor
$output = "";
$mode  = isset($_GET[Constant::$FIELD_NAME_MODE]) ? $_GET[Constant::$FIELD_NAME_MODE] : null;
// $now = DateTimeUtility::createDate(null, null);
$now = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
// $output .= "###Run at " . $now->getDatabaseFormat() . "###\r";
$output .= "###Run at " . $now->getDisplayLongTimeFormat() . "###";
$output .= isset($mode) ? "" : "\r";
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $databaseResult = new DatabaseResult(true);
// $params = array(DateTimeUtility::getDateDatabaseFormat($now), DateTimeUtility::getDateDatabaseTimeFormat($now));
$dateTime = new DateTime(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, "now");
$params = array($dateTime->getDatabaseFormat(), $dateTime->getDatabaseFormat());
$resultList = $databaseResult->getAutoRegisterHost($params);
if (count($resultList) == 0) {
  $output .= isset($mode) ? "<br>" : "\r";
  $output .= "No tournaments needing auto host registration or host is already registered";
  $output .= isset($mode) ? "" : "\r";
} else {
  foreach ($resultList as $tournament) {
    $user = $tournament->getLocation()->getUser();
    $params = array($tournament->getId(), $user->getId(), "NULL");
    $rowCount = $databaseResult->insertRegistration($params);
    if (1 == $rowCount) {
//     echo "<br>\rSuccessfully registered " . $user->getName() . " for tournament on " . DateTimeUtility::getDateDisplayFormat($tournament->getDate()) . " starting at " . DateTimeUtility::getTimeDisplayAmPmFormat($tournament->getStartTime()) . "\r";
      $output .= isset($mode) ? "<br><span class=\"messages\">" : "\r";
      $output .= "Successfully registered " . $user->getName() . " for tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat();
      $output .= isset($mode) ? "</span>" : "\r";
    }
    $tournamentAddress = $user->getAddress();
    $email = new Email();
    $email->setFromEmail(array(Constant::EMAIL_STAFF()));
    $email->setFromName(array(Constant::$NAME_STAFF));
    $email->setToEmail(array($user->getEmail()));
    $email->setToName(array($user->getName()));
    $emailAddress = new Address();
    $emailAddress->setAddress($tournamentAddress->getAddress());
    $emailAddress->setCity($tournamentAddress->getCity());
    // $emailAddress->setId();
    $emailAddress->setState($tournamentAddress->getState());
    $emailAddress->setZip($tournamentAddress->getZip());
    // $ccUser = new User();
    // $ccUser->setName(Constant::$NAME_STAFF);
    // $ccUser->setEmail(Constant::EMAIL_STAFF());
    // echo "<br>" . $email->sendRegisteredEmail($emailAddress, $tournament, 0, $ccUser);
    $output .= isset($mode) ? "<br>" : "\r";
    $output .= $email->sendRegisteredEmail($emailAddress, $tournament, 0);
    $output .= isset($mode) ? "" : "\r";
    $email = new Email();
    $email->setFromEmail(array(Constant::EMAIL_STAFF()));
    $email->setFromName(array(Constant::$NAME_STAFF));
    $email->setToEmail(array(Constant::EMAIL_STAFF()));
    $email->setToName(array(Constant::$NAME_STAFF));
    $emailAddress = new Address();
    $emailAddress->setAddress($tournamentAddress->getAddress());
    $emailAddress->setCity($tournamentAddress->getCity());
    // $emailAddress->setId();
    $emailAddress->setState($tournamentAddress->getState());
    $emailAddress->setZip($tournamentAddress->getZip());
//     $output .= isset($mode) ? "<br>" : "\r";
    $output .= $email->sendRegisteredEmail($emailAddress, $tournament, 0, null, $user->getName());
    $output .= isset($mode) ? "" : "\r";
  }
}
if (isset($_GET[Constant::$FIELD_NAME_MODE])) {
  $smarty->assign("title", "Chip Chair and a Prayer Auto Register Host");
//   $smarty->assign("style", $style);
//   $smarty->assign("script", "<script src=\"scripts/manageBuyins.js\" type=\"text/javascript\"></script>\n");
  $smarty->assign("heading", "Chip Chair and a Prayer Auto Register Host");
  $smarty->assign("mode", Constant::$MODE_VIEW);
  $smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
  $smarty->assign("formName", "frmAutoRegisterHost");
  $smarty->assign("content", $output);
  $smarty->display("base.tpl");
} else {
  echo $output;
}
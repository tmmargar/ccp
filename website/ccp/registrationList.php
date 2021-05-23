<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\utility\SessionUtility;
use DateInterval;
require_once "init.php";
define("LIMIT_COUNT_PARAMETER_NAME", "limitCount");
$smarty->assign("title", "Chip Chair and a Prayer Events");
$smarty->assign("heading", "");
if (! isset($limitCount)) {
  $limitCount = (isset($_POST[LIMIT_COUNT_PARAMETER_NAME]) ? $_POST[LIMIT_COUNT_PARAMETER_NAME] : isset($_GET[LIMIT_COUNT_PARAMETER_NAME])) ? $_GET[LIMIT_COUNT_PARAMETER_NAME] : null;
}
$output = "";
if (null == $limitCount) {
  $style = "<style type=\"text/css\">\n";
  $style .= " a {\n  line-height: 1.5em;\n }\n";
  $style .= " p {\n  padding: 0; margin: 0; float: left; font-size: 1.00em;\n }\n";
  $style .= " div.small {\n  font-size: .75em;\nline-height: 1.5em;\n }\n";
  $style .= "</style>\n";
  $smarty->assign("style", $style);
} else {
  $output .= "<div class=\"title\">Upcoming Events</div>\n";
}
$now = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
$params = array($now->getDatabaseFormat(), $now->getDatabaseTimeFormat());
$resultList = $databaseResult->getTournamentByDateAndStartTime(params: $params, limitCount: $limitCount);
foreach ($resultList as $tournament) {
  $registrationOpenDate = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: $tournament->getDate()->getDatabaseFormat() . " 12:00:00");
  $interval = new DateInterval(Constant::$INTERVAL_DATE_REGISTRATION_OPEN);
  $registrationOpenDateTemp = $registrationOpenDate->getTime();
  $registrationOpenDateTemp->sub($interval);
  $registrationOpen = (($now->getDatabaseFormat() <= $registrationOpenDate->getDatabaseFormat()) == 0);
  $url = "registration.php?tournamentId=" . $tournament->getId();
  $output .= "<p>";
  if ($registrationOpen) {
    $output .= "<a href=\"" . $url . "\">";
  }
  if ($registrationOpen) {
    $output .= "</a>";
  }
  $output .= "</p>";
  $output .= "<p>";
  $description = explode(", ", $tournament->getDescription());
  if (count($description) == 1) {
    $description = explode(" - ", $tournament->getDescription());
    if (count($description) > 1) {
      $description = explode("<br>", $description[1]);
    }
  }
  if ($registrationOpen) {
    $output .= "<a href=\"" . $url . "\">";
  }
  $output .= $description[0];
  if ($registrationOpen) {
    $output .= "</a>";
  }
  $output .= "<br />\n";
  $output .= $tournament->getDate()->getDisplayFormat() ." " . $tournament->getStartTime()->getDisplayAmPmFormat();
  $output .= "</p>\n<div class=\"small\" style=\"clear: both;\">\n";
  if ($registrationOpen) {
    $output .= "<a href=\"" . $url . "\">";
    $output .= $tournament->getLimitType()->getName();
    $output .= " ";
    $output .= $tournament->getGameType()->getName();
    $output .= ($tournament->getRebuyAmount() != 0 ? Constant::$DISPLAY_REBUY : "");
    if ($tournament->getRebuyAmount() == 0 && $tournament->getAddonAmount() != 0) {
      $output .= " ";
    }
    $output .= ($tournament->getAddonAmount() != 0 ? Constant::$DISPLAY_ADDON : "");
    $waitListCnt = $tournament->getRegisteredCount() - $tournament->getMaxPlayers();
    $output .= "<br />\n";
    $output .= $tournament->getLocation()->getName();
    $output .= "<br />\n";
    if ($waitListCnt > 0) {
      $output .= "Seating " . $tournament->getMaxPlayers() . " of " . $tournament->getMaxPlayers();
      $output .= " claimed";
      $output .= "<br />\n";
      $output .= $waitListCnt . " wait listed</a>\n";
    } else {
      $output .= "Seating " . $tournament->getRegisteredCount() . " of " . $tournament->getMaxPlayers() . " claimed</a>\n";
    }
  } else {
    $output .= $tournament->getLimitType()->getName();
    $output .= " ";
    $output .= $tournament->getGameType()->getName();
    $output .= ($tournament->getRebuyAmount() != 0 ? Constant::$DISPLAY_REBUY : "");
    if ($tournament->getRebuyAmount() == 0 && $tournament->getAddonAmount() != 0) {
      $output .= " ";
    }
    $output .= ($tournament->getAddonAmount() != 0 ? Constant::$DISPLAY_ADDON : "");
    $output .= "<br />\n";
    $output .= $tournament->getLocation()->getName();
    $output .= "<br />\n";
    $output .= "Registration Begins " . $registrationOpenDate->getDisplayRegistrationNotOpenFormat() . " @ Noon";
  }
  $output .= "</div>\n<hr />";
}
if (! $resultList) {
  $output .= "No scheduled tournaments";
}
if (isset($parentObjectId)) {
  return $output;
} else {
  $smarty->assign("content", $output);
  $smarty->display("home.tpl");
}
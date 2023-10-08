<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\model\Tournament;
use ccp\classes\model\User;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
//print_r($_POST);
// string - firstName
// array of all values
/*foreach ($_POST as $key => $values) {
  echo "<br>key = " . $key;
  echo " => value = ";
  foreach ($values as $value) {
    echo " / " . $value;
    if ($value == "") {
      break;
    }
  }
}*/
$params = array(Constant::$FLAG_YES_DATABASE);
$resultList = $databaseResult->getSeasonByActive($params);
$season = $resultList[0];
//echo "<br>" . chr(13) . chr(10) . "TD->" . $_POST["tournamentDate"];
//$now = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
//$params = array($now->getDatabaseFormat(), $now->getDatabaseTimeFormat());
$params = array($_POST["tournamentDate"], $_POST["tournamentDate"]);
//print_r($params);
$paramsNested = array($season->getStartDate()->getDatabaseFormat(), $season->getEndDate()->getDatabaseFormat(), $season->getChampionshipQualify());
//print_r($paramsNested);
$resultList = $databaseResult->getTournamentByDateAndStartTime(params: $params, paramsNested: $paramsNested, limitCount: null);
$tournament = $resultList[$_POST["first"]];
$params = array(null, null, null, Constant::$CODE_STATUS_PAID, 0, "null", $tournament->getId()); // , $maxPlace);
$rowCount = $databaseResult->updateResultByTournamentIdAndPlace(params: $params);
echo "<br>" . chr(13) . chr(10) . $rowCount . " rows updated to paid";
//echo "<br>" . chr(13) . chr(10) . "se->".$season;
$index = -1;
foreach ($_POST["firstName"] as $firstName) {
  $index++;
  echo "<br>" . chr(13) . chr(10) . "idx->" . $index;
  //echo "<br>" . chr(13) . chr(10) . $firstName . " " . $_POST["lastName"][$index];
  $fullName = $firstName . " " . $_POST["lastName"][$index];
  $params = array($fullName);
  $resultList = $databaseResult->getUserByName(params: $params);
  if (0 < count($resultList)) {
    $user = $resultList[0];
    //echo "<br>" . chr(13) . chr(10) . "userid for " . $fullName . " is " . $resultList[0]->getId();
  }
  $fullNameKO = $_POST["knockedOut"][$index];
  $params = array($fullNameKO);
  $resultList = $databaseResult->getUserByName(params: $params);
  if (0 < count($resultList)) {
    $userKO = $resultList[0];
    //echo "<br>" . chr(13) . chr(10) . "KO userid for " . $fullNameKO . " is " . $resultList[0]->getId();
  } else {
    $userKO = null;
  }
  if ($firstName == "") {
    break;
  }
  $params = array($tournament->getId(), $user->getId());
  $resultList = $databaseResult->getResultByTournamentIdAndPlayerId(params: $params);
  $userResult = $resultList[0];
  // rebuycount, rebuypaid, addonpaid, statuscode, place, kobyid, playerid
  //$params = array(0, Constant::$FLAG_NO, Constant::$FLAG_NO, Constant::$CODE_STATUS_FINISHED, $_POST["place"][$index], null == $userKO ? "null" : $userKO->getId(), $tournament->getId(), $user->getId());
  $params = array($_POST["rebuyCount"][$index], $_POST["rebuy"][$index], $_POST["addon"][$index], Constant::$CODE_STATUS_FINISHED, $_POST["place"][$index], null == $userKO ? "null" : $userKO->getId(), $tournament->getId(), $user->getId());
  //print_r($params);
  $rowCount = $databaseResult->updateResult(params: $params);
  echo "<br>" . chr(13) . chr(10) . $rowCount . " rows updated to finished for tournament id " . $tournament->getId() . " and user id " . $user->getId();
}
echo "<br>" . chr(13) . chr(10) . "DONE!!!";
die();

<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\DateTime;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
$smarty->assign("title", "Chip Chair and a Prayer Championship Seating");
$smarty->assign("formName", "frmChampionship");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("heading", "Championship Seating");
$smarty->assign("style", "");
$output = "";
$now = new DateTime(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), id: null, time: "now");
$startDate = SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_START_DATE)->getDatabaseFormat();
$endDate = SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_END_DATE)->getDatabaseFormat();
$params = array($startDate, $endDate);
$resultList = $databaseResult->getPrizePoolForSeason(params: $params, returnQuery: false);
if (0 < count($resultList)) {
  $prizePool = $resultList[0];
}
$resultList = $databaseResult->getWinnersForSeason(params: $params, returnQuery: false, limitCount: null);
if (0 < count($resultList)) {
  $ctr = 0;
  while ($ctr < count($resultList)) {
    $aryResult = $resultList[$ctr];
    $ctr ++;
    $aryWinners[$ctr] = $aryResult[1];
  }
  // $caption = "<strong>There are " . $ctr . " winners</strong>";
  // $hideColIndexes = array(0,2);
}
// echo "<BR>winners -> " . print_r($aryWinners);
$countWinners = isset($aryWinners) ? count($aryWinners) : 0;
$aryAbsentIds = array();
$aryAbsentNames = array();
$params = array($now->getYearFormat());
$resultList = $databaseResult->getUserAbsencesByTournamentId(params: $params);
$ctr = - 1;
foreach ($resultList as $values) {
  $ctr ++;
  $aryAbsentIds[$ctr] = $values[0];
  $aryAbsentNames[$ctr] = $values[1];
}
$aryPosition = array();
$aryPosition[0] = 1;
$aryPosition[1] = 9;
$aryPosition[2] = 8;
$aryPosition[3] = 7;
$aryPosition[4] = 6;
$aryPosition[5] = 5;
$aryPosition[6] = 4;
$aryPosition[7] = 3;
$aryPosition[8] = 2;

$params = array($startDate, $endDate, SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY));
$resultList = $databaseResult->getChampionshipQualifiedPlayers(params: $params);
$count = count($resultList) - count($aryAbsentIds);
if (0 < $count) {
  // $numPlayers = $count;
  $ctr = 0;
  $index = 0;
  $allowCtr = 0;
  $absentCtr = 0;
  $additionalPlayers = 36 - $countWinners;
  while ($ctr < count($resultList)) {
    $aryResult = $resultList[$ctr];
//     echo "<br>".$ctr."-->".$index."->".$aryResult[0];
    if (in_array($aryResult[0], $aryAbsentNames)) {
      foreach ($aryAbsentNames as $aryAbsentName) {
//         echo "<Br>" . $aryResult[0] . " == " . $aryAbsentName;
        if ($aryResult[0] == $aryAbsentName) {
//           $aryAbsentSeeds[$absentCtr] = $ctr + 1;
          $aryAbsentSeeds[$aryAbsentName] = $ctr + 1;
          $absentCtr ++;
        }
      }
    } else {
      $index ++;
      // echo "<br>".$allowCtr . " <= " . $additionalPlayers;
      if ($allowCtr <= $additionalPlayers) {
        // if winner add * else increment additional players
        if (in_array($aryResult[0], $aryWinners)) {
          $aryResult[0] = "*" . $aryResult[0];
        } else {
          $allowCtr ++;
        }
      }
      // echo "<br>setting aryNames[" . $index . "] = " . $aryResult[0];
      $aryNames[$index] = $aryResult[0];
      // echo "<br>setting aryAvgPts[" . $index . "] = " . $aryResult[1];
      $aryPts[$index] = $aryResult[1];
    }
    $ctr ++;
  }
  // sort makes array index start at 0 so adjust counter
  // $ctr--;
  $index --;
  array_multisort($aryPts, SORT_DESC, $aryNames, SORT_ASC);
  // echo "<BR>names -> " . print_r($aryNames, true);
  // echo "<BR>pts -> " . print_r($aryPts, true);
  // echo "<br>seeds -> " . print_r($aryAbsentSeeds, true);
  // if (27 >= count($aryNames)) {
  // $numTables = 3;
  // $totalPlayers = 27;
  // } else {
  $numTables = 4;
  $totalPlayers = 36;
  // }
  $playerCount = $totalPlayers;
  $maxIndex = $numTables;
  while ($index < ($totalPlayers - 1)) { // adjust for zero based
    $index ++;
    $playerCount --;
    // echo "<br>setting aryNames[".$index."] = EMPTY";
    $aryNames[$index] = "EMPTY";
    // echo "<br>setting aryMaxPlayers[".$maxIndex."] = " . ($playerCount / $numTables) . " -> " . floor($playerCount / $numTables);
    $aryMaxPlayers[$maxIndex] = floor($playerCount / $numTables);
    if ($maxIndex == 1) {
      $maxIndex = $numTables;
    } else {
      $maxIndex --;
    }
  }
  // echo "<br>maxPlayers -> " . print_r($aryMaxPlayers, true);
  $topThird = ceil($playerCount / 3);
  $topThirdChipCount = 11000;
  $middleThird = floor($playerCount / 3);
  $middleThirdChipCount = 10000;
  $bottomThird = floor($playerCount / 3);
  $bottomThirdChipCount = 9000;
  $ctr = 0;
  while ($ctr < count($aryNames)) {
    if ($ctr < $topThird) {
      $aryNames[$ctr] .= " (" . $topThirdChipCount . " chips)";
    } else if ($ctr < ($topThird + $middleThird)) {
      $aryNames[$ctr] .= " (" . $middleThirdChipCount . " chips)";
    } else {
      if ($aryNames[$ctr] != "EMPTY") {
        $aryNames[$ctr] .= " (" . $bottomThirdChipCount . " chips)";
      }
    }
    $ctr ++;
  }
  $maxPlayers = round(count($aryNames) / $numTables); // ceil(count($aryNames) / $numTables);
                                                      // $numEmpty = $totalPlayers - count($aryNames);
  $tableNumber = 0;
  $index = 1;
  $ctr = 0;
  $table = [];
  while ($ctr < $totalPlayers) {
    $tableNumber ++;
    // echo "<br>Adding " . $aryNames[$ctr] . " at table[" . $tableNumber . "][" . $index . "][0] from overall aryNames[" . $ctr . "]";
    $table[$tableNumber][$index][0] = $aryNames[$ctr];
    if ($tableNumber == $numTables) {
      $tableNumber = 0;
      $index ++;
    }
    $ctr ++;
  }
  // echo print_r($table) . "<br>";
  // skip first entry
  $ctr = 1;
  while ($ctr <= count($table)) {
    // echo "<br>Setting table[" . $ctr . "][1][1] = 1";
    $table[$ctr][1][1] = "1 (Dealer)";
    $position = $maxPlayers;
    $ctr2 = 2;
    $shortTable = false;
    $checkCtr = $ctr2;
    // adjust blinds for empty seat at table
    if ($table[$ctr][count($table[$ctr])][0] == "EMPTY") {
      // echo "<br>Setting short table flag";
      $shortTable = true;
    }
    while ($ctr2 <= count($table[$ctr])) {
      // echo "<br>Setting table[" . $ctr . "][" . $ctr2 . "][1] = " . $position;
      $table[$ctr][$ctr2][1] = $position;
      // if short table adjust check by 1
      if ($shortTable) {
        $checkCtr = $ctr2;
      }
      // echo "<br>Checking " . $checkCtr . " == " . ($maxPlayers - 1);
      // if ($checkCtr == ($maxPlayers - 1)) {
      if ($checkCtr == ($aryMaxPlayers[$ctr] - 1)) {
        $table[$ctr][$ctr2][1] .= " (Small Blind)";
        // } else if ($checkCtr == ($maxPlayers)) {
      } else if ($checkCtr == ($aryMaxPlayers[$ctr])) {
        $table[$ctr][$ctr2][1] .= " (Big Blind)";
      }
      $position --;
      $ctr2 ++;
      $checkCtr ++;
    }
    $ctr ++;
  }
  $output .= "    <h3>Total payout of $" . number_format(num: (float) $prizePool, decimals: 0) . "</h3>\n";
  $output .= "    <h4>Exact amounts below subject to change</h4>\n";
  $output .= "    <div class='column'><strong>Top " . $topThird . "</strong></div>\n";
  $output .= "    <div class='column'><strong>Middle " . $middleThird . "</strong></div>\n";
  $output .= "    <div class='column'><strong>Bottom " . $bottomThird . "</strong></div>\n";
  $output .= "    <div class='clear'></div>\n";
  $output .= "    <div class='column'>" . $topThirdChipCount . " chips</div>\n";
  $output .= "    <div class='column'>" . $middleThirdChipCount . " chips</div>\n";
  $output .= "    <div class='column'>" . $bottomThirdChipCount . " chips</div>\n";
  $output .= "    <div class='clear'></div>\n";
  $output .= "    <div class='column'><strong><i>Position<br />(% of total)</i></strong></div>\n";
  $output .= "    <div class='column'><strong><i>Payout</i></strong></div>\n";
  $output .= "    <div class='clear'></div>\n";
  $params = array(1, 1);
  $resultList = $databaseResult->getGroupPayoutById(params: $params);
  if (0 < count($resultList)) {
    $ctr = 0;
    while ($ctr < count($resultList)) {
      $groupPayout = $resultList[$ctr];
      $payouts = $groupPayout->getPayouts();
      $structures = $payouts[0]->getStructures();
      foreach ($structures as $structure) {
        $output .= "    <div class='column'>" . $structure->getPlace() . " (" . $structure->getPercentage() * 100 . "%)</div>\n";
        $output .= "    <div class='column'>$" . round($prizePool * $structure->getPercentage(), precision: 0, mode: PHP_ROUND_HALF_UP) . "</div>\n";
        $output .= "    <div class='clear'></div>\n";
      }
      $ctr ++;
    }
  }
  $output .= "    <br />\n";
  $output .= "    <div class='heading'><strong>Table Collapse</strong></div>\n";
  $output .= "    <div class='heading'>1 and 4</div>\n";
  $output .= "    <div class='heading'>2 and 3</div>\n";
  $output .= "    <br />\n";
  $output .= "    <div class='heading'><strong>Unable to attend</strong></div>\n";
  $output .= "    <div class='column'><strong><i>Name</i></strong></div>\n";
  $output .= "    <div class='column'><strong><i>Original seat</i></strong></div>\n";
  $output .= "    <div class='clear'></div>\n";
  $ctr = 0;
//   echo "<br>aryAbsentNames " . print_r($aryAbsentNames, true);
//   echo "<br>aryAbsentSeeds " . print_r($aryAbsentSeeds, true);
//   echo print_r($aryPosition, true);
  foreach ($aryAbsentNames as $absentName) {
    $output .= "    <div class='column'>" . $absentName . "</div>\n";
    $tableNum = ($aryAbsentSeeds[$absentName] % $numTables) == 0 ? 4 : ($aryAbsentSeeds[$absentName] % $numTables);
    $positionNum = ($aryAbsentSeeds[$absentName] % $numTables) == 0 ? $aryPosition[($aryAbsentSeeds[$absentName] / $numTables) - 1] : $aryPosition[$aryAbsentSeeds[$absentName] / $numTables];
//     echo "<br>".$absentName ." -> " .$aryAbsentSeeds[$absentName]." --> " . ($aryAbsentSeeds[$absentName] / $numTables);
    $output .= "    <div class='column'>Table " . $tableNum . " Position " . $positionNum . "</div>\n";
    $output .= "    <div class='clear'></div>\n";
    $ctr ++;
  }
  $output .= "    <br />\n";
  $output .= "    <div class='heading'><strong>* represent winners</strong></div>\n";
  $ctr = 0;
  while ($ctr < count($table)) {
    $ctr ++;
    $ctr2 = 0;
    while ($ctr2 < count($table[$ctr])) {
      $ctr2 ++;
      $output .= "    <div class='clear'></div>\n";
      if ($ctr2 == 1) {
        $output .= "    <div class='heading'><strong>Table $ctr</strong></div>\n";
        $output .= "    <div class='column'><strong><i>Position</i></strong></div>\n";
        $output .= "    <div class='column'><strong><i>Name</i></strong></div>\n";
        $output .= "    <div class='clear'></div>\n";
      }
      $output .= "    <div class='column'>" . $table[$ctr][$ctr2][1] . "</div>\n";
      $output .= "    <div class='column'>" . isset($table[$ctr][$ctr2]) ? $table[$ctr][$ctr2][0] : "" . "</div>\n";
      $output .= "    <div class='clear'></div>\n";
    }
  }
} else {
  $output .= "No one has qualified with at least " . SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY) . " tournaments yet or " . SessionUtility::getValue(name: SessionUtility::$OBJECT_NAME_CHAMPIONSHIP_QUALIFY) . " tournaments have not been completed for " . date(format: "Y");
}
$smarty->assign("content", $output);
$smarty->display("championship.tpl");
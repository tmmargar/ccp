<?php
namespace ccp\classes\Test;
use ccp\classes\model\Group;
use ccp\classes\model\GroupPayout;
use ccp\classes\model\Payout;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class GroupPayoutTest extends BaseTest {
  public static function testGetGroupBlank() {
    $groupPayout = new GroupPayout();
    echo "<br>testGetGroupBlank " . (($groupPayout->getGroup() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGroupNotBlank() {
    $groupPayout = new GroupPayout();
    $group = new Group();
    $group->setId(1);
    $groupPayout->setGroup($group);
    echo "<br>testGetGroupNotBlank " . (($groupPayout->getGroup()->getId() == 1) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetGroupException() {
    $groupPayout = new GroupPayout();
    try {
      $groupPayout->setGroup(1);
      echo "<br>testGetGroupException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetGroupException " . self::getPassOutput();
    }
  }
  public static function testGetPayoutsBlank() {
    $groupPayout = new GroupPayout();
    echo "<br>testGetPayoutsBlank " . (($groupPayout->getPayouts() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetPayoutsNotBlank() {
    $groupPayout = new GroupPayout();
    $group = new Group();
    $group->setId(1);
    $group->setName("gn");
    $groupPayout->setGroup($group);
    $payout = new Payout();
    $payout->setBonusPoints(3);
    $payout->setId(2);
    $payout->setName("pn 2");
    $payout->setNumPlayers(22);
    $payout2 = new Payout();
    $payout2->setBonusPoints(4);
    $payout2->setId(3);
    $payout2->setName("pn 3");
    $payout2->setNumPlayers(24);
    $payouts = array($payout, $payout2);
    $groupPayout->setPayouts($payouts);
    $groupPayoutsOut = $groupPayout->getPayouts();
    echo "<br>testGetPayoutsNotBlank " . (($groupPayoutsOut[0]->getId() == 2 && $groupPayoutsOut[1]->getId() == 3) ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testToString() {
    $groupPayout = new GroupPayout();
    $group = new Group();
    $group->setId(1);
    $group->setName("gn");
    $groupPayout->setGroup($group);
    $payout = new Payout();
    $payout->setBonusPoints(3);
    $payout->setId(2);
    $payout->setName("pn 2");
    $payout->setNumPlayers(22);
    $payout2 = new Payout();
    $payout2->setBonusPoints(4);
    $payout2->setId(3);
    $payout2->setName("pn 3");
    $payout2->setNumPlayers(24);
    $payouts = array($payout, $payout2);
    $groupPayout->setPayouts($payouts);
    echo "<br>testToString " . self::getTextOutput(BaseTest::CLASS_NAME_PASS, $groupPayout->toString());
  }
  public static function runAllTests() {
    GroupPayoutTest::testGetGroupBlank();
    GroupPayoutTest::testGetGroupNotBlank();
    GroupPayoutTest::testGetGroupException();
    GroupPayoutTest::testGetPayoutsBlank();
    GroupPayoutTest::testGetPayoutsNotBlank();
    GroupPayoutTest::testToString();
  }
}
GroupPayoutTest::runAllTests();
?>
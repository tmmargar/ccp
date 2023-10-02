<?php
namespace ccp\classes\Test;
use ccp\classes\model\Email;
use Exception;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
class EmailTest extends BaseTest {
  public static function testGetFromNameBlank() {
    $email = new Email();
    echo "<br>testGetFromNameBlank " . (($email->getFromName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFromNameNotBlank() {
    $email = new Email();
    $email->setFromName(array("abc"));
    $emailFromName = $email->getFromName();
    echo "<br>testGetFromNameNotBlank " . (($emailFromName[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFromEmailBlank() {
    $email = new Email();
    echo "<br>testGetFromEmailBlank " . (($email->getFromEmail() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetFromEmailNotBlank() {
    $email = new Email();
    $email->setFromEmail(array("abc"));
    $emailFromEmail = $email->getFromEmail();
    echo "<br>testGetFromEmailNotBlank " . (($emailFromEmail[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetToNameBlank() {
    $email = new Email();
    echo "<br>testGetToNameBlank " . (($email->getToName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetToNameNotBlank() {
    $email = new Email();
    $email->setToName(array("abc"));
    $emailToName = $email->getToName();
    echo "<br>testGetToNameNotBlank " . (($emailToName[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCcNameBlank() {
    $email = new Email();
    echo "<br>testGetCcNameBlank " . (($email->getCcName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCcNameNotBlank() {
    $email = new Email();
    $email->setCcName(array("abc"));
    $emailCcName = $email->getCcName();
    echo "<br>testGetCcNameNotBlank " . (($emailCcName[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBccNameBlank() {
    $email = new Email();
    echo "<br>testGetBccNameBlank " . (($email->getBccName() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBccNameNotBlank() {
    $email = new Email();
    $email->setBccName(array("abc"));
    $emailBccName = $email->getBccName();
    echo "<br>testGetBccNameNotBlank " . (($emailBccName[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetToEmailBlank() {
    $email = new Email();
    echo "<br>testGetToEmailBlank " . (($email->getToEmail() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetToEmailNotBlank() {
    $email = new Email();
    $email->setToEmail(array("abc"));
    $emailToEmail = $email->getToEmail();
    echo "<br>testGetToEmailNotBlank " . (($emailToEmail[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCcEmailBlank() {
    $email = new Email();
    echo "<br>testGetCcEmailBlank " . (($email->getCcEmail() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetCcEmailNotBlank() {
    $email = new Email();
    $email->setCcEmail(array("abc"));
    $emailCcEmail = $email->getCcEmail();
    echo "<br>testGetCcEmailNotBlank " . (($emailCcEmail[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBccEmailBlank() {
    $email = new Email();
    echo "<br>testGetBccEmailBlank " . (($email->getBccEmail() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBccEmailNotBlank() {
    $email = new Email();
    $email->setBccEmail(array("abc"));
    $emailBccEmail = $email->getBccEmail();
    echo "<br>testGetBccEmailNotBlank " . (($emailBccEmail[0] == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetSubjectBlank() {
    $email = new Email();
    echo "<br>testGetSubjectBlank " . (($email->getSubject() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetSubjectNotBlank() {
    $email = new Email();
    $email->setSubject("abc");
    echo "<br>testGetSubjectNotBlank " . (($email->getSubject() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBodyBlank() {
    $email = new Email();
    echo "<br>testGetBodyBlank " . (($email->getBody() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetBodyNotBlank() {
    $email = new Email();
    $email->setBody("abc");
    echo "<br>testGetBodyNotBlank " . (($email->getBody() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testIsLocalBlank() {
    $email = new Email();
    echo "<br>testIsLocalBlank " . (($email->isLocal() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testIsLocalNotBlank() {
    $email = new Email();
    $email->setLocal(true);
    echo "<br>testIsLocalNotBlank " . (($email->isLocal() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetLocalException() {
    $email = new Email();
    try {
      $email->setLocal("abc");
      echo "<br>testGetLocalException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetLocalException " . self::getPassOutput();
    }
  }
  public static function testIsTestBlank() {
    $email = new Email();
    echo "<br>testIsTestBlank " . (($email->isTest() == "") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testIsTestNotBlank() {
    $email = new Email();
    $email->setTest(true);
    echo "<br>testIsTestNotBlank " . (($email->isTest() == "abc") ? self::getPassOutput() : self::getFailOutput());
  }
  public static function testGetTestException() {
    $email = new Email();
    try {
      $email->setTest("abc");
      echo "<br>testGetTestException " . self::getFailOutput();
    } catch (Exception $e) {
      echo "<br>testGetTestException " . self::getPassOutput();
    }
  }
  public static function testSendEmailLocal() {
    $email = new Email();
    $email->setBody("test email worked");
    $fromEmails = array("todd@localhost.com");
    $fromNames = array("Todd Margarita (from localhost)");
    $email->setFromEmail($fromEmails);
    $email->setFromName($fromNames);
    $email->setSubject("testing email functionality");
    $toEmails = array("todd@localhost.com");
    $toNames = array("Todd Margarita (to localhost)");
    $email->setToEmail($toEmails);
    $email->setToName($toNames);
    echo "<br>" . $email->sendEmail();
  }
  public static function testSendEmailServer() {
    $email = new Email();
    $email->setBody("test email worked");
    $fromEmails = array("todd@toddandpatti.com");
    $fromNames = array("Todd Margarita (from google)");
    $email->setFromEmail($fromEmails);
    $email->setFromName($fromNames);
    $email->setSubject("testing email functionality");
    $toEmails = array("todd@toddandpatti.com");
    $toNames = array("Todd Margarita (to google)");
    $email->setToEmail($toEmails);
    $email->setToName($toNames);
    echo "<br>" . $email->sendEmail();
  }
  public static function testToString() {
    $email = new Email();
    $email->setBccEmail(array("test@bcc.com"));
    $email->setBccName(array("bcc nm"));
    $email->setBody("bdy");
    $email->setCcEmail(array("test@cc.com"));
    $email->setCcName(array("cc nm"));
    $email->setFromEmail(array("test@from.com"));
    $email->setFromName(array("fr nm"));
    $email->setLocal(true);
    $email->setSubject("subj");
    $email->setTest(true);
    $email->setToEmail(array("test@to.com"));
    $email->setToName(array("to nm"));
    echo "<br>testToString " . self::getTextOutput(BaseTest::$CLASS_NAME_PASS, $email->toString());
  }
  public static function runAllTests() {
    EmailTest::testGetFromNameBlank();
    EmailTest::testGetFromNameNotBlank();
    EmailTest::testGetFromEmailBlank();
    EmailTest::testGetFromEmailNotBlank();
    EmailTest::testGetToNameBlank();
    EmailTest::testGetToNameNotBlank();
    EmailTest::testGetToEmailBlank();
    EmailTest::testGetToEmailNotBlank();
    EmailTest::testGetCcNameBlank();
    EmailTest::testGetCcNameNotBlank();
    EmailTest::testGetCcEmailBlank();
    EmailTest::testGetCcEmailNotBlank();
    EmailTest::testGetBccNameBlank();
    EmailTest::testGetBccNameNotBlank();
    EmailTest::testGetBccEmailBlank();
    EmailTest::testGetBccEmailNotBlank();
    EmailTest::testGetSubjectBlank();
    EmailTest::testGetSubjectNotBlank();
    EmailTest::testGetBodyBlank();
    EmailTest::testGetBodyNotBlank();
    EmailTest::testIsLocalBlank();
    EmailTest::testIsLocalNotBlank();
    EmailTest::testIsTestBlank();
    EmailTest::testIsTestNotBlank();
    EmailTest::testSendEmailLocal();
    EmailTest::testSendEmailServer();
    EmailTest::testToString();
  }
}
EmailTest::runAllTests();
?>
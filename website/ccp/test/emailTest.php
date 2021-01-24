<?
use ccp\classes\Model\Constant;
use ccp\classes\Model\Email;
// $to = "me@localhost.com";
$to = "todd@toddandpatti.com";
require_once "init.php";
$email = new Email();
$email->setFromEmail(array(Constant::EMAIL_STAFF()));
$email->setFromName(array(Constant::$NAME_STAFF));
$email->setToEmail(array($to));
$email->setToName(array("Todd M"));
$email->setSubject("testing email class");
$email->setBody("registration.php?&tournamentId=350");
echo "<br>" . $email->toString();
echo "<br>" . $email->sendEmail();
?>
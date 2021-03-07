<?php
namespace ccp\classes\model;
use ccp\classes\common\PHPMailer\PHPMailer;
use Exception;
class Email extends Base {
  private static $EMAIL_ADDRESS_LOCAL = "me@localhost.com";
  private $fromName; // array
  private $fromEmail; // array
  private $toName; // array
  private $toEmail; // array
  private $ccName; // array
  private $ccEmail; // array
  private $bccName; // array
  private $bccEmail; // array
  private $subject;
  private $body;
  private $local = false;
  private $localEmail;

  public function __construct11($debug, $fromName, $fromEmail, $toName, $toEmail, $ccName, $ccEmail, $bccName, $bccEmail, $subject, $body) {
    parent::__construct2($debug, null);
    $this->fromName = $fromName;
    $this->fromEmail = $fromEmail;
    $this->toName = $toName;
    $this->toEmail = $toEmail;
    $this->ccName = $ccName;
    $this->ccEmail = $ccEmail;
    $this->bccName = $bccName;
    $this->bccEmail = $bccEmail;
    $this->subject = $subject;
    $this->body = $body;
    $this->local = Constant::FLAG_LOCAL();
  }
  // deprecated and remove once all code is updated
//   public function __construct() {
//     echo "<BR>BAD";
//     $this->setLocal(Constant::FLAG_LOCAL());
//   }
  public function getFromName() {
    return $this->fromName;
  }
  public function getFromEmail() {
    return $this->fromEmail;
  }
  public function getToName() {
    return $this->toName;
  }
  public function getToEmail() {
    $toEmail = $this->toEmail;
    if ($this->isLocal()) {
      $this->setLocalEmail($toEmail);
      foreach ($toEmail as $key => $value) {
        $toEmail[$key] = self::$EMAIL_ADDRESS_LOCAL;
      }
      unset($value);
      $this->setLocalEmail($toEmail);
      $toEmail = $this->getLocalEmail();
    }
    return $toEmail;
  }
  public function getCcName() {
    return $this->ccName;
  }
  public function getCcEmail() {
    return $this->ccEmail;
  }
  public function getBccName() {
    return $this->bccName;
  }
  public function getBccEmail() {
    return $this->bccEmail;
  }
  public function getSubject() {
    return $this->subject;
  }
  public function getBody() {
    return $this->body;
  }
  public function isLocal() {
    return $this->local;
  }
  public function getLocalEmail() {
    return $this->localEmail;
  }
  public function setFromName($fromName) {
    if (is_array($fromName)) {
      $this->fromName = $fromName;
    } else {
      throw new Exception($fromName . " is not a valid array of from names");
    }
  }
  public function setFromEmail($fromEmail) {
    if (is_array($fromEmail)) {
      $this->fromEmail = $fromEmail;
    } else {
      throw new Exception($fromEmail . " is not a valid array of from emails");
    }
  }
  public function setToName($toName) {
    if (is_array($toName)) {
      $this->toName = $toName;
    } else {
      throw new Exception($toName . " is not a valid array of to names");
    }
  }
  public function setToEmail($toEmail) {
    if (is_array($toEmail)) {
      $this->toEmail = $toEmail;
    } else {
      throw new Exception($toEmail . " is not a valid array of to emails");
    }
  }
  public function setCcName($ccName) {
    if (is_array($ccName)) {
      $this->ccName = $ccName;
    } else {
      throw new Exception($ccName . " is not a valid array of cc names");
    }
  }
  public function setCcEmail($ccEmail) {
    if (is_array($ccEmail)) {
      $this->ccEmail = $ccEmail;
      if ($this->isLocal()) {
        $this->setBody("<br>CC to " . print_r($ccEmail, true) . "\n\n" . $this->getBody());
        $ccEmail = array($this->localEmail);
      }
    } else {
      throw new Exception($ccEmail . " is not a valid array of cc emails");
    }
  }
  public function setBccName($bccName) {
    if (is_array($bccName)) {
      $this->bccName = $bccName;
    } else {
      throw new Exception($bccName . " is not a valid array of bcc names");
    }
  }
  public function setBccEmail($bccEmail) {
    if (is_array($bccEmail)) {
      $this->bccEmail = $bccEmail;
    } else {
      throw new Exception($bccEmail . " is not a valid array of bcc emails");
    }
  }
  public function setSubject($subject) {
    $this->subject = $subject;
  }
  public function setBody($body) {
    $this->body = $body;
  }
  public function setLocal($local) {
    if (is_bool($local)) {
      $this->local = $local;
    } else {
      throw new Exception($local . " is not a valid local");
    }
  }
  public function setLocalEmail($localEmail) {
    $this->localEmail = $localEmail;
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= " fromName = ";
    $output .= print_r($this->fromName, true);
    $output .= ", fromEmail = ";
    $output .= print_r($this->fromEmail, true);
    $output .= ", toName = ";
    $output .= print_r($this->toName, true);
    $output .= ", toEmail = ";
    $output .= print_r($this->toEmail, true);
    $output .= ", ccName = ";
    $output .= print_r($this->ccName, true);
    $output .= ", ccEmail = ";
    $output .= print_r($this->ccEmail, true);
    $output .= ", bccName = ";
    $output .= print_r($this->bccName, true);
    $output .= ", bccEmail = ";
    $output .= print_r($this->bccEmail, true);
    $output .= ", subject = '";
    $output .= $this->subject;
    $output .= "', body = '";
    $output .= $this->body;
    $output .= "', local = ";
    $output .= var_export($this->local, true);
    $output .= ", localEmail = '";
    $output .= $this->localEmail;
    $output .= "'";
    return $output;
  }
  // from, to, cc, bcc should comply with
  // user@example.com
  // User <user@example.com>
  // each body line < 70 characters and separated with \n
  public function sendEmail() {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = $this->isDebug(); //SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    //$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
    $mail->Host = Constant::SERVER_EMAIL();
    $mail->isHTML(true);
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $mail->SetFrom($this->getFromEmail()[$idx], $this->getFromName()[$idx]);
      $mail->AddAddress($this->getToEmail()[$idx], $this->getToName()[$idx]);
      if (isset($this->getCcEmail()[$idx]) && isset($this->getCcName()[$idx])) {
        $mail->AddCC($this->getCcEmail()[$idx], $this->getCcName()[$idx]);
      }
      if (isset($this->getBccEmail()[$idx]) && isset($this->getBccName()[$idx])) {
        $mail->AddBCC($this->getBccEmail[$idx], $this->getBccName()[$idx]);
      }
      $mail->Subject = $this->getSubject();
      $mail->Body = $this->getBody();
      $message = "";
        if(!$mail->send()) {
          $message .= "Message could not be sent to " . $this->getToName()[$idx] . " due to " . $mail->ErrorInfo;
        } else {
          $message .= "Message has been sent to " . $this->getToName()[$idx] . " at " . $this->getToEmail()[$idx];
          if (isset($this->getCcEmail()[$idx]) && isset($this->getCcName()[$idx])) {
            $message .= " and cc to " . $this->getCcName()[$idx] . " at " . $this->getCcEmail()[$idx];
          }
        }
    }
    return $message;
  }

  public function sendRegisteredEmail(Address $address, Tournament $tournament, $waitList, $autoRegister = null) {
    $result = "";
    $url = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $url .= Constant::PATH() . "registration.php?tournamentId=" . $tournament->getId();
      if (isset($autoRegister)) {
        $subject = "Auto registration of " . $autoRegister . " was successful for the tournament on ";
      } else {
        $subject = "registration (update) successful for the tournament on ";
      }
      $subject .= $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat();
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      if (is_string($waitList)) {
        $body .= "&nbsp;&nbsp;" . $waitList  . " was successfully moved from the wait list to registered ";
      } else {
        if (isset($autoRegister)) {
          $body .= "&nbsp;&nbsp;Auto registration of " . $autoRegister . " was successful ";
        } else {
          $body .= "&nbsp;&nbsp;Your registration (update) was successful ";
        }
        if ($waitList > 0) {
          $body .= "(you were added to the wait list) ";
        } else if ($waitList == -99) {
          $body .= "(you were moved from the wait list to registered) ";
        }
      }
      $body .= "for the tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat() . " with additional details below:<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getAddress() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getCity() . ", " . $address->getState() . " " . $address->getZip() . "<br />";
      $body .= "&nbsp;&nbsp;If you need to cancel your registration for this tournament, please <a href=\"" . $url . "\">click here</a>";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }

  public function sendReminderEmail(Address $address, Tournament $tournament, $waitListCount) {
    $result = "";
    $url = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $url .= Constant::PATH() . "registration.php?tournamentId=" . $tournament->getId();
      $subject = " registration is open reminder for the tournament on ";
      $subject .= $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat();
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;Registration is open ";
      if ($waitListCount > 0) {
        $body .= "(on the wait list) ";
      }
//       $body .= "for the tournament on " . DateTimeUtility::getDateDisplayFormat($tournament->getDate()) . " starting at " . DateTimeUtility::getTimeDisplayAmPmFormat($tournament->getStartTime()) . " with additional details below:<br />";
      $body .= "for the tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat() . " with additional details below:<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $tournament->getDescription() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;Hosted by " . $tournament->getLocation()->getUser()->getName() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $tournament->getLimitType()->getName() . " " . $tournament->getGameType()->getName() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $tournament->getBuyinAmount() . " for " . $tournament->getChipCount() . " chips<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $tournament->getMaxRebuys() . " rebuy(s) in first hour, $" . $tournament->getRebuyAmount() . " for " .$tournament->getChipCount() . " chips<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getAddress() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getCity() . ", " . $address->getState() . " " . $address->getZip() . "<br />";
      $body .= "&nbsp;&nbsp;If you need to register for this tournament, please <a href=\"" . $url . "\">click here</a>";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }

  public function sendCancelledEmail(Address $address, Tournament $tournament) {
    $result = "";
    $url = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $url .= Constant::PATH() . "registration.php?tournamentId=" . $tournament->getId();
      $subject = "registration cancelled for the tournament on ";
      $subject .= $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat();
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;Your registration was cancelled for the tournament on " . $tournament->getDate()->getDisplayFormat() . " starting at " . $tournament->getStartTime()->getDisplayAmPmFormat()  . " with additional details below:<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getAddress() . "<br />";
      $body .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $address->getCity() . ", " . $address->getState() . " " . $address->getZip() . "<br />";
      $body .= "&nbsp;&nbsp;If you need to re-register for this tournament, please <a href=\"" . $url . "\">click here</a>";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }
  public function sendSignUpEmail() {
    $result = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $subject = "sign up request sent for approval";
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;Your sign up request was sent for approval. Once it has been approved or rejected you will receive an email with further instructions.";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }
  public function sendSignUpApprovalEmail() {
    $result = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $subject = "sign up request needs approval";
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;" . $this->fromName[$idx]  . " sign up request requires your approval. Please <a href=\"" . (Constant::PATH()) . "manageSignupApproval.php\">click here</a> to go to the approval screen.";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }
  public function sendApprovedEmail() {
    $result = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $subject = "sign up request approved";
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;Your request has been approved. Please <a href=\"" . (Constant::PATH()) . "\">click here</a> to login.";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }
  public function sendRejectedEmail() {
    $result = "";
    for ($idx = 0; $idx < count($this->fromName); $idx++) {
      $subject = "sign up request rejected";
      $this->setSubject($subject);
      $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
      $body .= "&nbsp;&nbsp;Your request has been rejected.";
      $this->setBody($body);
      $result .= $this->sendEmail();
    }
    return $result;
  }
  // array of username, email, selector and validator
  public function sendPasswordResetRequestEmail(Array $info, Array $selectorAndToken) {
      $result = "";
      for ($idx = 0; $idx < count($this->fromName); $idx++) {
          $subject = "password reset request";
          $this->setSubject($subject);
          $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
          $url = Constant::PATH() . "resetPassword.php?mode=resetPassword&username=" . $info[0] . "&email=" . $info[1] . "&selector=" . $selectorAndToken[0] . "&validator=" . $selectorAndToken[1];
          $body .= "&nbsp;&nbsp;Your request has been received. Please <a href=\"" . $url . "\">click here</a> to reset your password.";
          $this->setBody($body);
          $result .= $this->sendEmail();
      }
      return $result;
  }
  public function sendPasswordResetSuccessfulEmail() {
      $result = "";
      for ($idx = 0; $idx < count($this->fromName); $idx++) {
          $subject = "password reset successfully";
          $this->setSubject($subject);
          $body = $this->getBody() . "<br />" . $this->toName[$idx] . ",<br />";
          $url = Constant::PATH() . "login.php";
          $body .= "&nbsp;&nbsp;Your password was changed successfully. Please <a href=\"" . $url . "\">click here</a> to login.";
          $this->setBody($body);
          $result .= $this->sendEmail();
      }
      return $result;
  }
}
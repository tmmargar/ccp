<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use ccp\classes\common\PHPMailer\PHPMailer;
use Exception;
class Email extends Base {
  private static string $EMAIL_ADDRESS_LOCAL = "me@localhost.com";

  public function __construct(protected bool $debug, protected array $fromName, protected array $fromEmail, protected array $toName, protected array $toEmail, protected array|null $ccName, protected array|null $ccEmail, protected array|null $bccName, protected array|null $bccEmail, protected string|null $subject, protected string|null $body) {
    parent::__construct($debug, null);
    $this->local = Constant::FLAG_LOCAL();
  }
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
  public function setFromName(array $fromName) {
    $this->fromName = $fromName;
  }
  public function setFromEmail(array $fromEmail) {
    $this->fromEmail = $fromEmail;
  }
  public function setToName(array $toName) {
    $this->toName = $toName;
  }
  public function setToEmail(array $toEmail) {
    $this->toEmail = $toEmail;
  }
  public function setCcName(array $ccName) {
    $this->ccName = $ccName;
  }
  public function setCcEmail(array $ccEmail) {
    $this->ccEmail = $ccEmail;
    if ($this->isLocal()) {
      $this->setBody("<br>CC to " . print_r($ccEmail, true) . "\n\n" . $this->getBody());
      $ccEmail = array($this->localEmail);
    }
  }
  public function setBccName(array $bccName) {
    $this->bccName = $bccName;
  }
  public function setBccEmail(array $bccEmail) {
    $this->bccEmail = $bccEmail;
  }
  public function setSubject(string $subject) {
    $this->subject = $subject;
  }
  public function setBody(string $body) {
    $this->body = $body;
  }
  public function setLocal(bool $local) {
    $this->local = $local;
  }
  public function setLocalEmail(array|null $localEmail) {
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
    $output .= ", localEmail = ";
    $output .= print_r($this->localEmail, true);
    return $output;
  }
  // from, to, cc, bcc should comply with
  // user@example.com
  // User <user@example.com>
  // each body line < 70 characters and separated with \n
  public function sendEmail() {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = $this->isDebug();
    $mail->isSMTP();
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

  public function sendRegisteredEmail(Address $address, Tournament $tournament, string|int $waitList, string $autoRegister = null) {
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

  public function sendReminderEmail(Address $address, Tournament $tournament, int $waitListCount) {
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
  public function sendPasswordResetRequestEmail(array $info, array $selectorAndToken) {
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
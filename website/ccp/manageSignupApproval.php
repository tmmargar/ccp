<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("APPROVE_FIELD_NAME", "approve");
define("REJECT_FIELD_NAME", "reject");
define("SAVE_FIELD_NAME", "save");
define("SAVE_TEXT", "Save");
if (Constant::$MODE_SAVE_VIEW == $mode) {
  $user = array();
  $emailAddress = array();
  $approval = array();
  $rejection = array();
  foreach ($_POST as $key => $value) {
    $userId = count(explode("_", $key)) > 1 ? explode("_", $key)[1] : "";
    if (strpos($key, 'user_') !== false) {
      $user[$userId] = $value;
    } else if (strpos($key, 'email_') !== false) {
      $emailAddress[$userId] = $value;
    } else if (strpos($key, 'approveUser_') !== false) {
      $approval[$userId] = $user[$userId];
    } else if (strpos($key, 'rejectUser_') !== false) {
      $rejection[$userId] = $user[$userId];
    }
  }
  $output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
  // update approval date or rejection date and set active flag
  $params = array();
  //id, first_name, last_name, username, password, email, administrator, registration_date, approval_date, approval_userid, rejection_date, rejection_userid, active, reset_selector, reset_token, reset_expires, remember_selector, remember_token, remember_expires
  foreach ($approval as $key => $value) {
    $params[0] = $key;
    $params[8] = "CURRENT_TIMESTAMP";
    $params[9] = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID);
    $databaseResult->updateUser($params);
    $output .= "  aryMessages.push(\"Successfully approved " . $value . "\");\n";
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($value), array($emailAddress[$key]), null, null, null, null, null, null);
    $output .= "  aryMessages.push(\"" . $email->sendApprovedEmail() . "\");\n";
  }
  foreach ($rejection as $key => $value) {
    $params[0] = $key;
    $params[10] = "CURRENT_TIMESTAMP";
    $params[11] = SessionUtility::getValue(SessionUtility::$OBJECT_NAME_USERID);
    $databaseResult->updateUser($params);
    $output .= "  aryMessages.push(\"Successfully rejected " . $value . "\");\n";
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($value), array($emailAddress[$key]), null, null, null, null, null, null);
    $output .= "  aryMessages.push(\"" . $email->sendRejectedEmail() . "\");\n";
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
}
$query = $databaseResult->getUsersForApproval();
$result = $databaseResult->getConnection()->query($query);
if (0 < $result->rowCount()) {
  $count = $result->columnCount();
  $output .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"dataTbl display override60\" id=\"dataTblSignupApproval\">\n";
  $headerRow = true;
  while ($row = $result->fetch()) {
    if ($headerRow) {
      $output .= " <thead>\n";
      $output .= "  <tr>\n";
      for ($index = 1; $index < $count; $index ++) {
        $output .= "   <th>" . ucwords($result->getColumnMeta($index)["name"]) . "</th>\n";
      }
      $output .= "   <th class=\"center\">Approve\n<br />\n<input id=\"approveUserCheckAll\" name=\"approveUserCheckAll\" type=\"checkbox\" /></th>\n";
      $output .= "   <th class=\"center\">Reject\n<br />\n<input id=\"rejectUserCheckAll\" name=\"rejectUserCheckAll\" type=\"checkbox\" /></th>\n";
      $output .= "  </tr>\n";
      $output .= " </thead>\n";
      $output .= " <tbody>\n";
      $headerRow = false;
    }
    $output .= "  <tr>\n";
    for ($index = 1; $index < $count; $index ++) {
      $hiddenUser = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_USER . "_" . $row[0], null, Constant::$FIELD_NAME_USER . "_" . $row[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $row[1], null);
      $hiddenEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_EMAIL . "_" . $row[0], null, Constant::$FIELD_NAME_EMAIL . "_" . $row[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $row[2], null);
      $hiddenUsername = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_USERNAME . "_" . $row[0], null, Constant::$FIELD_NAME_USERNAME . "_" . $row[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $row[3], null);
      $output .= "   <td>" . $row[$index] . ($index == 1 ? $hiddenUser->getHtml() : ($index == 2 ? $hiddenEmail->getHtml() : ($index == 3 ? $hiddenUsername->getHtml() : ""))) . "</td>\n";
    }
    $output .= "   <td class=\"center\"><input id=\"approveUser_" . $row[0] . "\" name=\"approveUser_" . $row[0] . "\" type=\"checkbox\" /></td>\n";
    $output .= "   <td class=\"center\"><input id=\"rejectUser_" . $row[0] . "\" name=\"rejectUser_" . $row[0] . "\" type=\"checkbox\" /></td>\n";
    $output .= "  </tr>\n";
  }
  $output .= " </tbody>\n";
  $output .= " </table>\n";
  $output .= " <br />\n";
  $output .= "<div class=\"input\">\n";
  $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, true, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
  $output .= $buttonSave->getHtml();
  $output .= "</div>\n";
} else {
  $output .= "<br />\nNo users require approval";
}
$smarty->assign("title", "Chip Chair and a Prayer User Approval");
$style =
  "<style type=\"text/css\">\n" .
  "div.label, div.input {\n" .
  "  height: 17px;\n" .
  "  line-height: 17px;\n" .
  "  margin: 5px;\n" .
  "}\n" .
  "div.label {\n" .
  "  float: left;\n" .
  "  width: 100px;\n" .
  "}\n" .
  "div.input {\n" .
  "  float: left;\n" .
  "  margin: 0;\n" .
   "}\n" .
  "div.clear {\n" .
  "  clear: both;\n" .
  "  height: 0;\n" .
  "  line-height: 0;\n" .
  "}\n" .
  "</style>\n";
$smarty->assign("style", $style);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
$smarty->assign("formName", "frmSignup");
$smarty->assign("heading", "User Approval");
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("manageSignupApproval.tpl");
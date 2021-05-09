<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormSelect;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TO_FIELD_NAME", "to");
define("SUBJECT_FIELD_NAME", "subject");
define("BODY_FIELD_NAME", "body");
define("EMAIL_FIELD_NAME", "email");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$output = "";
if (Constant::$MODE_EMAIL == $mode) {
  $to = isset($_POST[TO_FIELD_NAME]) ? $_POST[TO_FIELD_NAME] : "";
  $subject = isset($_POST[SUBJECT_FIELD_NAME]) ? $_POST[SUBJECT_FIELD_NAME] : "";
  $body = isset($_POST[BODY_FIELD_NAME]) ? $_POST[BODY_FIELD_NAME] : "";
  $output .= "<script type=\"text/javascript\">\n aryMessages = [];\n";
  foreach ($to as $toEach) {
    $toArray = explode(":", $toEach);
    $email = new Email(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), array(Constant::$NAME_STAFF), array(Constant::EMAIL_STAFF()), array($toArray[0]), array($toArray[1]), null, null, null, null, $subject, $body);
    $output .= "  aryMessages.push(\"" . $email->sendEmail() . "\");\n";
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
}
$smarty->assign("title", "Chip Chair and a Prayer Email");
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
$params = array();
$resultList = $databaseResult->getUsersActive($params);
if (count($resultList) == 0) {
  echo "No active users";
} else {
  $script =
    "<script src=\"scripts/selectize.js\" type=\"text/javascript\"></script>\n" .
    "<script type=\"text/javascript\">\n";
  $option = "{\n";
  foreach ($resultList as $user) {
    if ($option != "{\n") {
      $option .= ", \n";
    }
    $option .= "\"" . $user->getName() . "\" : \"" . $user->getEmail() . "\"";
  }
  $option .= "}";
  $script .=
    "  const selectUsers = " . $option . ";\n" .
    "</script>\n" .
    "<script src=\"scripts/manageEmail.js\" type=\"text/javascript\"></script>\n";
}
$smarty->assign("script", $script);
$smarty->assign("heading", "Manage Email");
$style =
  "<link href=\"css/selectize.default.css\" rel=\"stylesheet\" type=\"text/css\">\n" .
  "<style type=\"text/css\">\n" .
  " .form_content {\n" .
  "  width: 45%;\n" .
  " }\n" .
  "</style>\n";
$smarty->assign("style", $style);
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmLogin");
$output .= "<div class=\"form_content\">\n";
$output .= " <div class=\"label\">To:</div>\n";
$output .= " <div class=\"input\">\n";
$selectTo = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TO, null, false, TO_FIELD_NAME, true, TO_FIELD_NAME . "[]", null, false, 5, null, null);
$output .= $selectTo->getHtml();
$output .= "  </select>\n";
$output .= " </div>\n";
$output .= " <div class=\"label\">Subject:</div>\n";
$output .= " <div class=\"input\">\n";
$textBoxEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SUBJECT, null, false, null, null, null, false, SUBJECT_FIELD_NAME, 100, SUBJECT_FIELD_NAME, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, null, null);
$output .= $textBoxEmail->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">Body:</div>\n";
$output .= " <div class=\"textarea\">\n";
$textAreaBody = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_BODY, null, false, null, null, 50, false, BODY_FIELD_NAME, null, BODY_FIELD_NAME, null, null, false, null, 10, null, null, FormControl::$TYPE_INPUT_TEXTAREA, null, "hard");
$output .= $textAreaBody->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">&nbsp;</div>\n";
$output .= " <div class=\"input\">\n";
$buttonEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_EMAIL, null, false, null, null, null, false, EMAIL_FIELD_NAME, null, EMAIL_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(EMAIL_FIELD_NAME), null);
$output .= $buttonEmail->getHtml();
$buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_RESET, Constant::$TEXT_RESET, null);
$output .= $buttonReset->getHtml();
$output .= " </div>\n";
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$output .= "</div>\n";
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
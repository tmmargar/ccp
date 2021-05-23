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
//     $debug, $fromName, $fromEmail, $toName, $toEmail, $ccName, $ccEmail, $bccName, $bccEmail, $subject, $body
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($toArray[0]), toEmail: array($toArray[1]), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: $subject, body: $body);
    $output .= "  aryMessages.push(\"" . $email->sendEmail() . "\");\n";
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages(aryMessages);}\n</script>\n";
}
$smarty->assign("title", "Chip Chair and a Prayer Email");
$params = array();
$resultList = $databaseResult->getUsersActive(params: $params);
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
//     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
$selectTo = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TO, class: null, disabled: false, id: TO_FIELD_NAME, multiple: true, name: TO_FIELD_NAME . "[]", onClick: null, readOnly: false, size: 5, suffix: null, value: null);
$output .= $selectTo->getHtml();
$output .= "  </select>\n";
$output .= " </div>\n";
$output .= " <div class=\"label\">Subject:</div>\n";
$output .= " <div class=\"input\">\n";
// ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
$textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SUBJECT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SUBJECT_FIELD_NAME, maxLength: 100, name: SUBJECT_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: 30, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: null, wrap: null);
$output .= $textBoxEmail->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">Body:</div>\n";
$output .= " <div class=\"textarea\">\n";
$textAreaBody = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_BODY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: 50, disabled: false, id: BODY_FIELD_NAME, maxLength: null, name: BODY_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: null, rows: 10, size: null, suffix: null, type: FormControl::$TYPE_INPUT_TEXTAREA, value: null, wrap: "hard");
$output .= $textAreaBody->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">&nbsp;</div>\n";
$output .= " <div class=\"input\">\n";
$buttonEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: EMAIL_FIELD_NAME, maxLength: null, name: EMAIL_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(EMAIL_FIELD_NAME), wrap: null);
$output .= $buttonEmail->getHtml();
$buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
$output .= $buttonReset->getHtml();
$output .= " </div>\n";
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$output .= "</div>\n";
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
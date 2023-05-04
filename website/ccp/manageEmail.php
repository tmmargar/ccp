<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
use ccp\classes\model\Email;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("TO_FIELD_NAME", "to");
define("SUBJECT_FIELD_NAME", "subject");
define("BODY_FIELD_NAME", "body");
define("EMAIL_FIELD_NAME", "email");
$smarty->assign("title", "Send Email");
$smarty->assign("heading", "Send Email");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$output = "";
if (Constant::$MODE_EMAIL == $mode) {
  $to = isset($_POST[TO_FIELD_NAME]) ? $_POST[TO_FIELD_NAME] : "";
  $subject = isset($_POST[SUBJECT_FIELD_NAME]) ? $_POST[SUBJECT_FIELD_NAME] : "";
  $body = isset($_POST[BODY_FIELD_NAME]) ? $_POST[BODY_FIELD_NAME] : "";
  $output .=
    "<script type=\"module\">\n" .
    "  import { dataTable, display, input } from \"./scripts/import.js\";\n" .
    "  let aryMessages = [];\n";
  foreach ($to as $toEach) {
    $toArray = explode(":", $toEach);
//     $debug, $fromName, $fromEmail, $toName, $toEmail, $ccName, $ccEmail, $bccName, $bccEmail, $subject, $body
    $email = new Email(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), fromName: array(Constant::$NAME_STAFF), fromEmail: array(Constant::EMAIL_STAFF()), toName: array($toArray[0]), toEmail: array($toArray[1]), ccName: null, ccEmail: null, bccName: null, bccEmail: null, subject: $subject, body: $body);
    $output .= "  aryMessages.push(\"" . $email->sendEmail() . "\");\n";
  }
  $output .= "  if (aryMessages.length > 0) {display.showMessages({messages: aryMessages});}\n</script>\n";
}
$params = array();
$resultList = $databaseResult->getUsersActive(params: $params);
if (count($resultList) == 0) {
  echo "No active users";
}
$smarty->assign("script", "<script src=\"https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js\"></script>\n<script src=\"scripts/manageEmail.js\" type=\"module\"></script>\n");
$smarty->assign("style", "<link href=\"https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css\" rel=\"stylesheet\">\n<link href=\"css/manageEmail.css\" rel=\"stylesheet\">");
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmEmail");
$output .= " <div class=\"buttons center\">\n";
$buttonEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: EMAIL_FIELD_NAME . "_2", maxLength: null, name: EMAIL_FIELD_NAME . "_2", onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(EMAIL_FIELD_NAME), wrap: null);
$output .= $buttonEmail->getHtml();
$buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET . "_2", maxLength: null, name: Constant::$TEXT_RESET . "_2", onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
$output .= $buttonReset->getHtml();
$output .= " </div>\n";
$output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
$output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . TO_FIELD_NAME . "\">To:</div>\n";
$output .= " <div class=\"responsive-cell responsive-cell-value\" style=\"overflow: unset;\">";
$output .= "  <a href=\"#\" id=\"selectAll\">Select all</a>&nbsp;<a id=\"deselectAll\">De-select all</a>\n";
//     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
$selectTo = new FormSelect(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_TO, class: array("tom-select"), disabled: false, id: TO_FIELD_NAME, multiple: true, name: TO_FIELD_NAME . "[]", onClick: null, readOnly: false, size: 5, suffix: null, value: null);
$output .= $selectTo->getHtml();
foreach ($resultList as $user) {
  $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: null, suffix: null, text: $user->getName(), value: $user->getName() . ":" . $user->getEmail());
  $output .= $option->getHtml();
}
$output .= "  </select>\n";
$output .= " </div>\n";
$output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . SUBJECT_FIELD_NAME . "\">Subject:</div>\n";
// ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
$textBoxEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_SUBJECT, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SUBJECT_FIELD_NAME, maxLength: 100, name: SUBJECT_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: true, rows: null, size: 41, suffix: null, type: FormControl::$TYPE_INPUT_TEXTBOX, value: null, wrap: null);
$output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxEmail->getHtml() . "</div>\n";
$output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . BODY_FIELD_NAME . "\">Body:</div>\n";
$textAreaBody = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_BODY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: 43, disabled: false, id: BODY_FIELD_NAME, maxLength: null, name: BODY_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: true, rows: 10, size: null, suffix: null, type: FormControl::$TYPE_INPUT_TEXTAREA, value: null, wrap: "hard");
$output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textAreaBody->getHtml() . "</div>\n";
$output .= "</div>\n";
$output .= "<div class=\"buttons center\">\n";
$buttonEmail = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_EMAIL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: EMAIL_FIELD_NAME, maxLength: null, name: EMAIL_FIELD_NAME, onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_SUBMIT, value: ucwords(EMAIL_FIELD_NAME), wrap: null);
$output .= $buttonEmail->getHtml();
$buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: Constant::$ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$TEXT_RESET, maxLength: null, name: Constant::$TEXT_RESET, onClick: null, placeholder:null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_RESET, value: Constant::$TEXT_RESET, wrap: null);
$output .= $buttonReset->getHtml();
$output .= " </div>\n";
$hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::$FIELD_NAME_MODE, maxLength: null, name: Constant::$FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::$TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
$output .= $hiddenMode->getHtml();
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
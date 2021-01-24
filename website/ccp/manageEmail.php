<?php
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
  foreach ($to as $toEach) {
    // echo "<br>" . $toEach . " -> " . explode(":", $toEach)[1] ; die();
    $toArray = explode(":", $toEach);
    $email = new Email();
    $email->setBody($body);
    $email->setFromEmail(array(Constant::EMAIL_STAFF()));
    $email->setFromName(array(Constant::$NAME_STAFF));
    $email->setSubject($subject);
    $email->setToEmail(array($toArray[1]));
    $email->setToName(array($toArray[0]));
    $output .= $email->sendEmail();
  }
//   $output .= "<span class=\"messages\">Successfully sent emails to " . count($to) . "</span>\n";
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
    "<script src=\"scripts/manageEmail.js\" type=\"text/javascript\"></script>\n" .
    "<script type=\"text/javascript\">\n" .
    "$(document).ready(function() {\n" .
    "  $(document).on(\"click\", \"#selectAll\", function(event) {\n" .
  "    return input.selectAllSelectize(\"" . TO_FIELD_NAME . "\");\n" .
  "  });\n" . "  $(document).on(\"click\", \"#deselectAll\", function(event) {\n" .
  "    return input.deselectAllSelectize(\"" . TO_FIELD_NAME . "\");\n" .
  "  });\n";
  $option = "{\n";
  foreach ($resultList as $user) {
    if ($option != "{\n") {
      $option .= ", \n";
    }
    $option .= "\"" . $user->getName() . "\" : \"" . $user->getEmail() . "\"";
  }
  $option .= "}";
  $script .=
    "  var selectValues = " . $option . ";\n" .
    "  var options = [];\n" .
    "  $.each(selectValues, function(key, value) {\n" .
    "    options.push($(\"<option>\", {value : key + \":\" + value}).text(key));\n" .
    "  });\n" .
    "  $(\"#" . TO_FIELD_NAME . "\").append(options);\n" .
    "  var selectizeArray = $(\"#" . TO_FIELD_NAME . "\").selectize({\n" .
    "    valueField: \"email\",\n" . "    labelField: \"name\",\n" .
    "    searchField: [\"name\", \"email\"],\n" . "    plugins: {\n" .
    "      \"drag_drop\": {},\n" . "      \"remove_button\": {},\n" .
    "      \"set_all\": {\"id\": \"" . TO_FIELD_NAME . "\"}\n" .
    "    },\n" .
    "    render: {\n" .
    "      item: function(item, escape) {\n" .
    "        return \"<div>\" + (item.name ? \"<span class='name'>\" + escape(item.name) + \"</span>\" : \"\") + (item.email ? \"<span class='email'> &lt;\" + escape(item.email) + \"&gt;</span>\" : \"\") + \"</div>\";\n" .
    "      },\n" .
    "      option: function(item, escape) {\n" .
    "        var label = item.name || item.email;\n" .
  // " var caption = item.name ? item.email : null;\n" .
  "        var caption = item.name ? item.email.split(':')[1] : null;\n" .
  "        return \"<div><span class='label'>\" + escape(label) + \"</span>\" + (caption ? \"<span class='caption'> &lt;\" + escape(caption) + \"&gt;</span>\" : \"\") + \"</div>\";\n" .
  "      }\n" .
  "    }\n" .
  "  });\n" .
  "});\n" .
  "</script>\n";
}
$smarty->assign("script", $script);
$smarty->assign("heading", "Manage Email");
$style =
  "<style type=\"text/css\">\n" .
  "  @import url(\"css/selectize.default.css\");\n" .
  ".form_content {\n" .
  "  width: 1000px;\n" .
  "}\n" .
"</style>\n";
$smarty->assign("style", $style);
$smarty->assign("mode", $mode);
// $smarty->assign("navigation", "");
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmLogin");
// if (isset($failMessage)) {
// $output .=
// "<script type=\"text/javascript\">\n" .
// " display.showErrors([ \"" . $failMessage . "\" ]);\n" .
// "</script>\n";
// }
$output .= "<div class=\"form_content\">\n";
$output .= " <div class=\"label\">To:</div>\n";
$output .= " <div class=\"input\">\n";
$selectTo = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_TO, null, false, TO_FIELD_NAME, true, TO_FIELD_NAME . "[]", null, false, 5, null, null);
$output .= $selectTo->getHtml();
$output .= "  </select>\n";
$output .= " </div>\n";
// $output .= "<div class=\"clear\"></div>\n";
$output .= " <div class=\"label\">Subject:</div>\n";
$output .= " <div class=\"input\">\n";
$textBoxEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SUBJECT, null, false, null, null, null, false, SUBJECT_FIELD_NAME, 100, SUBJECT_FIELD_NAME, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, null, null);
$output .= $textBoxEmail->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">Body:</div>\n";
$output .= " <div class=\"textarea\">\n";
$textAreaBody = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_BODY, null, false, null, null, 50, false, BODY_FIELD_NAME, null, BODY_FIELD_NAME, null, null, false, null, 10, null, null, FormControl::$TYPE_INPUT_TEXTAREA, null, true);
$output .= $textAreaBody->getHtml();
$output .= " </div>\n";
$output .= " <div class=\"label\">&nbsp;</div>\n";
$output .= " <div class=\"input\">\n";
$buttonEmail = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_EMAIL, null, false, null, null, null, false, EMAIL_FIELD_NAME, null, EMAIL_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, ucwords(EMAIL_FIELD_NAME), null);
$output .= $buttonEmail->getHtml();
$output .= " </div>\n";
$hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
$output .= $hiddenMode->getHtml();
$output .= "</div>\n";
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
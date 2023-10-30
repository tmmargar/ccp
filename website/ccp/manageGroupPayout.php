<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\FormControl;
use ccp\classes\model\FormOption;
use ccp\classes\model\FormSelect;
use ccp\classes\model\HtmlTable;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
define("GROUP_FIELD_LABEL", "Group");
define("PAYOUT_FIELD_LABEL", "Payout");
define("GROUP_ID_FIELD_NAME", "groupId");
define("GROUP_NAME_FIELD_NAME", "groupName");
define("PAYOUT_ID_FIELD_NAME", "payoutId");
define("PAYOUT_NAME_FIELD_NAME", "payoutName");
define("SELECTED_ROW_FIELD_NAME", "tempGroupPayoutId");
define("ORIGINAL_PAYOUT_ID_FIELD_NAME", "payoutIdOriginal");
define("ORIGINAL_GROUP_ID_FIELD_NAME", "groupIdOriginal");
define("DEFAULT_VALUE_GROUP_ID", "-1");
define("DEFAULT_VALUE_PAYOUT_ID", "-1");
$smarty->assign("title", "Manage Group Payout");
$smarty->assign("heading", "Manage Group Payout");
$smarty->assign("style", "<link href=\"css/manageGroupPayout.css\" rel=\"stylesheet\">");
$aryGroupPayoutIds = explode("::", $ids);
if (Constant::MODE_CREATE == $mode || Constant::MODE_MODIFY == $mode) {
  $params = Constant::MODE_MODIFY == $mode ? array($aryGroupPayoutIds[0], $aryGroupPayoutIds[1]) : array(0, 0);
  $resultList = $databaseResult->getGroupPayoutById(params: $params);
  if (Constant::MODE_CREATE == $mode || (Constant::MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $output .= " <div class=\"buttons center\">\n";
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_SAVE . "_2", maxLength: null, name: Constant::TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_RESET . "_2", maxLength: null, name: Constant::TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_RESET, value: Constant::TEXT_RESET, wrap: null, noValidate: true);
    $output .= $buttonReset->getHtml();
    $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CANCEL . "_2", maxLength: null, name: Constant::TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CANCEL, wrap: null, noValidate: true);
    $output .= $buttonCancel->getHtml();
    $output .= " </div>\n";
    $output .= "<div class=\"responsive responsive--2cols responsive--collapse\">";
    $groupId = isset($_POST[GROUP_ID_FIELD_NAME . "_"]) ? $_POST[GROUP_ID_FIELD_NAME . "_"] : DEFAULT_VALUE_GROUP_ID;
    $payoutId = isset($_POST[PAYOUT_ID_FIELD_NAME . "_"]) ? $_POST[PAYOUT_ID_FIELD_NAME . "_"] : DEFAULT_VALUE_PAYOUT_ID;
    $ctr = 0;
    $ary = explode(Constant::DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $arySplit = explode("::", $id);
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . GROUP_ID_FIELD_NAME . "_" . $id . "\">" . GROUP_FIELD_LABEL . ($arySplit[0] != "" ? " " . $arySplit[0] : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getGroupsAll(params: $params);
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-value\">";
        //     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
        $selectGroup = new FormSelect(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_GROUP, class: null, disabled: false, id: GROUP_ID_FIELD_NAME . "_" . $arySplit[0], multiple: false, name: GROUP_ID_FIELD_NAME . "_" . $arySplit[0], onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= $selectGroup->getHtml();
        //     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $groupId, suffix: null, text: Constant::TEXT_NONE, value: "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $group) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getGroup()->getId() : "", suffix: null, text: $group->getName(), value: $group->getId());
          $output .= $option->getHtml();
        }
        $output .= "  </select>\n";
        $output .= " </div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . PAYOUT_ID_FIELD_NAME . "_" . $id . "\">" . PAYOUT_FIELD_LABEL . ($arySplit[0] != "" ? " " . $arySplit[0] : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getPayoutsAll(params: $params); // returns array of Payout objects
      if (count($resultList2) > 0) {
        $output .= " <div class=\"responsive-cell responsive-cell-value\">";
        $selectGroup = new FormSelect(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_PAYOUT, class: null, disabled: false, id: PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], multiple: false, name: PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= $selectGroup->getHtml();
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: $payoutId, suffix: null, text: Constant::TEXT_NONE, value: "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $payout) {
          //TODO: handle array payout
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getPayouts()[0]->getId() : "", suffix: null, text: $payout->getName(), value: $payout->getId());
          $output .= $option->getHtml();
        }
        $output .= "  </select>\n";
        $output .= " </div>\n";
      }
      // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
      $hiddenOriginalGroupId = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0], maxLength: null, name: ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0], onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getGroup()->getId() : ""), wrap: null);
      $output .= $hiddenOriginalGroupId->getHtml();
      $hiddenOriginalPayoutId = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], maxLength: null, name: ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0], onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getPayouts()[0]->getId() : ""), wrap: null);
      $output .= $hiddenOriginalPayoutId->getHtml();
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_FIELD_NAME . "_" . $arySplit[0], maxLength: null, name: HIDDEN_ROW_FIELD_NAME . "_" . $arySplit[0], onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getGroup()->getId() . "::" . $resultList[$ctr]->getPayouts()[0]->getId() : ""), wrap: null);
      $output .= $hiddenRow->getHtml();
      $ctr++;
    }
    $output .= " <div class=\"buttons center\">\n";
    $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_SAVE, maxLength: null, name: Constant::TEXT_SAVE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_SAVE, wrap: null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_RESET, maxLength: null, name: Constant::TEXT_RESET, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_RESET, value: Constant::TEXT_RESET, wrap: null, noValidate: true);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CANCEL, maxLength: null, name: Constant::TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CANCEL, wrap: null, noValidate: true);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::FIELD_NAME_MODE, maxLength: null, name: Constant::FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
  $output .= "</div>\n";
} elseif (Constant::MODE_SAVE_CREATE == $mode || Constant::MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    $arySplit = explode("::", $id);
    $groupId = (isset($_POST[GROUP_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[GROUP_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_GROUP_ID;
    $payoutId = (isset($_POST[PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_PAYOUT_ID;
    $originalGroupId = (isset($_POST[ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[ORIGINAL_GROUP_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_GROUP_ID;
    $originalPayoutId = (isset($_POST[ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]])) ? $_POST[ORIGINAL_PAYOUT_ID_FIELD_NAME . "_" . $arySplit[0]] : DEFAULT_VALUE_PAYOUT_ID;
    if (Constant::MODE_SAVE_CREATE == $mode) {
      $params = array($groupId, $payoutId);
      $databaseResult->insertGroupPayout(params: $params);
    } elseif (Constant::MODE_SAVE_MODIFY == $mode) {
      $params = array($groupId, $payoutId, $originalGroupId, $originalPayoutId);
      $databaseResult->updateGroupPayout(params: $params);
    }
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::MODE_VIEW;
}
if (Constant::MODE_VIEW == $mode || Constant::MODE_DELETE == $mode || Constant::MODE_CONFIRM == $mode) {
  if (Constant::MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($aryGroupPayoutIds[0], $aryGroupPayoutIds[1]);
      $databaseResult->deleteGroupPayout(params: $params);
      $ids = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::MODE_VIEW;
  }
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::MODE_VIEW == $mode) {
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CREATE . "_2", maxLength: null, name: Constant::TEXT_CREATE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG),accessKey:  Constant::ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::TEXT_MODIFY . "_2", maxLength: null, name: Constant::TEXT_MODIFY . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::TEXT_DELETE . "_2", maxLength: null, name: Constant::TEXT_DELETE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CONFIRM_DELETE . "_2", maxLength: null, name: Constant::TEXT_CONFIRM_DELETE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CANCEL . "_2", maxLength: null, name: Constant::TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CANCEL, wrap: null);
    $output .= $buttonDelete->getHtml();
  }
  $output .= "</div>\n";
  $hiddenMode = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::FIELD_NAME_MODE, maxLength: null, name: Constant::FIELD_NAME_MODE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: $mode, wrap: null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: SELECTED_ROWS_FIELD_NAME, maxLength: null, name: SELECTED_ROWS_FIELD_NAME, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: $ids, wrap: null);
  $output .= $hiddenSelectedRows->getHtml();
//   $params = array(null);
  $query = $databaseResult->getGroupPayout();
  if (Constant::MODE_DELETE == $mode) {
    $query .=
      " WHERE gp.groupId IN (" . $aryGroupPayoutIds[0] . ")" .
      " AND gp.payoutId IN (" . $aryGroupPayoutIds[1] . ")";
  }
  //0$href, 1$paramName, 2/3$paramValue, 4$text
//   $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  //$link = array(array(1, 3), array("manageGroup.php", array("groupId", "mode"), 0, "modify", 1), array("managePayout.php", array("payoutId", "mode"), 2, "modify", 3));
  $link = array(array(1, 3), array("manageGroup.php", array("groupId", "mode"), array(0, "modify"), 1), array("managePayout.php", array("payoutId", "mode"), array(2, "modify"), 3));
  //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
  $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: null, debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), delimiter: Constant::DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: null, html: null, id: null, link: $link, note: true, query: $query, selectedRow: $ids, suffix: null, width: "100%");
  $output .= $htmlTable->getHtml();
  $output .= "<div class=\"buttons center\">\n";
  if (Constant::MODE_VIEW == $mode) {
    // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
    $buttonCreate = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CREATE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CREATE, maxLength: null, name: Constant::TEXT_CREATE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CREATE, wrap: null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG),accessKey:  Constant::ACCESSKEY_MODIFY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::TEXT_MODIFY, maxLength: null, name: Constant::TEXT_MODIFY, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_MODIFY, wrap: null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: true, id: Constant::TEXT_DELETE, maxLength: null, name: Constant::TEXT_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CONFIRM_DELETE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CONFIRM_DELETE, maxLength: null, name: Constant::TEXT_CONFIRM_DELETE, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CONFIRM_DELETE, wrap: null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CANCEL, maxLength: null, name: Constant::TEXT_CANCEL, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CANCEL, wrap: null);
    $output .= $buttonDelete->getHtml();
  }
  $output .= "</div>\n";
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
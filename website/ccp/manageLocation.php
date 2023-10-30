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
define("LOCATION_NAME_FIELD_LABEL", "Location name");
define("ADDRESS_FIELD_LABEL", "Address");
define("CITY_FIELD_LABEL", "City");
define("STATE_FIELD_LABEL", "State");
define("ZIP_FIELD_LABEL", "Zip");
define("ACTIVE_FIELD_LABEL", "Active");
define("PLAYER_ID_FIELD_LABEL", "Player name");
define("LOCATION_NAME_FIELD_NAME", "locationName");
define("ADDRESS_FIELD_NAME", "address");
define("CITY_FIELD_NAME", "city");
define("STATE_FIELD_NAME", "states");
define("ZIP_FIELD_NAME", "zipCode");
define("ACTIVE_FIELD_NAME", "active");
define("PLAYER_ID_FIELD_NAME", "playerId");
$smarty->assign("title", "Manage Location");
$smarty->assign("heading", "Manage Location");
$smarty->assign("style", "<link href=\"css/manageLocation.css\" rel=\"stylesheet\">");
if (Constant::MODE_CREATE == $mode || Constant::MODE_MODIFY == $mode) {
  $params = Constant::MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getLocationById(params: $params);
  $output .= " <div class=\"buttons center\">\n";
  $buttonSave = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_SAVE, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_SAVE . "_2", maxLength: null, name: Constant::TEXT_SAVE . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_SAVE, wrap: null);
  $output .= $buttonSave->getHtml();
  $buttonReset = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_RESET, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_RESET . "_2", maxLength: null, name: Constant::TEXT_RESET . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_RESET, value: Constant::TEXT_RESET, wrap: null, noValidate: true);
  $output .= $buttonReset->getHtml();
  $buttonCancel = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CANCEL, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: Constant::TEXT_CANCEL . "_2", maxLength: null, name: Constant::TEXT_CANCEL . "_2", onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_SUBMIT, value: Constant::TEXT_CANCEL, wrap: null, noValidate: true);
  $output .= $buttonCancel->getHtml();
  $output .= " </div>\n";
  $output .= " <div class=\"responsive responsive--2cols responsive--collapse\">";
  if (Constant::MODE_CREATE == $mode || (Constant::MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $ctr = 0;
    $ary = explode(Constant::DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . LOCATION_NAME_FIELD_NAME . "_" . $id . "\">" . LOCATION_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      // ($debug, $accessKey, $autoComplete, $autoFocus, $checked, $class, $cols, $disabled, $id, $maxLength, $name, $onClick, $placeholder, $readOnly, $required, $rows, $size, $suffix, $type, $value, $wrap
      $textBoxName = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_LOCATION_NAME, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: LOCATION_NAME_FIELD_NAME . "_" . $id, maxLength: 30, name: LOCATION_NAME_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: true, required: null, rows: null, size: 30, suffix: null, type: FormControl::TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxName->getHtml() . " (last name - city)</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . PLAYER_ID_FIELD_NAME . "_" . $id . "\">" . PLAYER_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getUsersActive(params: $params);
      if (count($resultList2) > 0) {
        //     $debug, $accessKey, $class, $disabled, $id, $multiple, $name, $onClick, $readOnly, $size, $suffix, $value
        $selectLocation = new FormSelect(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_PLAYER_ID, class: null, disabled: false, id: PLAYER_ID_FIELD_NAME . "_" . $id, multiple: false, name: PLAYER_ID_FIELD_NAME . "_" . $id, onClick: null, readOnly: false, size: 1, suffix: null, value: null);
        $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $selectLocation->getHtml();
        //     $debug, $class, $disabled, $id, $name, $selectedValue, $suffix, $text, $value) {
        $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: null, suffix: null, text: Constant::TEXT_NONE, value: "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $user) {
          $option = new FormOption(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), class: null, disabled: false, id: null, name: null, selectedValue: count($resultList) > 0 ? $resultList[$ctr]->getUser()->getId() : "", suffix: null, text: $user->getName(), value: $user->getId());
          $output .= $option->getHtml();
        }
        $output .= "  </select>\n";
        $output .= " </div>\n";
      }
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . ADDRESS_FIELD_NAME . "_" . $id . "\">" . ADDRESS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxAddress = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_ADDRESS, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ADDRESS_FIELD_NAME . "_" . $id, maxLength: 75, name: ADDRESS_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 75, suffix: null, type: FormControl::TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getAddress() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxAddress->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . CITY_FIELD_NAME . "_" . $id . "\">" . CITY_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxCity = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_CITY, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: CITY_FIELD_NAME . "_" . $id, maxLength: 50, name: CITY_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 30, suffix: null, type: FormControl::TYPE_INPUT_TEXTBOX, value: ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getCity() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxCity->getHtml() . "</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . STATE_FIELD_NAME . "_" . $id . "\">" . STATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      // $output .= " <div style=\"float: left;\">\n " . HtmlUtility::buildStateDropDown($id, count($resultList) ? $resultList[$ctr]->getUser()->getAddress()->getState() : "") . "\n</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-value\"><input id=\"states_" . $id . "\" name=\"states_" . $id . "\" readonly size=\"1\" type=\"text\" value=\"MI\" />\n</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . ZIP_FIELD_NAME . "_" . $id . "\">" . ZIP_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $textBoxZip = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: Constant::ACCESSKEY_ZIP, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: ZIP_FIELD_NAME . "_" . $id, maxLength: 5, name: ZIP_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: true, rows: null, size: 5, suffix: null, type: FormControl::TYPE_INPUT_NUMBER, value: ((count($resultList) > 0) ? (string) $resultList[$ctr]->getUser()->getAddress()->getZip() : ""), wrap: null);
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . $textBoxZip->getHtml() . " (5 digits)\n</div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-label responsive-cell--head\"><label for=\"" . ACTIVE_FIELD_NAME . "_" . $id . "\">" . ACTIVE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= " <div class=\"responsive-cell responsive-cell-value\">" . ((count($resultList) == 0) || Constant::FLAG_YES_DATABASE == $resultList[$ctr]->getActive() ? Constant::TEXT_YES : Constant::TEXT_NO) . "</div>\n";
      $hiddenRow = new FormControl(debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), accessKey: null, autoComplete: null, autoFocus: false, checked: null, class: null, cols: null, disabled: false, id: HIDDEN_ROW_FIELD_NAME . "_" . $id, maxLength: null, name: HIDDEN_ROW_FIELD_NAME . "_" . $id, onClick: null, placeholder: null, readOnly: false, required: null, rows: null, size: null, suffix: null, type: FormControl::TYPE_INPUT_HIDDEN, value: ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), wrap: null);
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
  $ctr = 0;
  $ary = explode(Constant::DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    $locationName = isset($_POST[LOCATION_NAME_FIELD_NAME . "_" . $id]) ? $_POST[LOCATION_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $playerId = (isset($_POST[PLAYER_ID_FIELD_NAME . "_" . $id])) ? $_POST[PLAYER_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $address = (isset($_POST[ADDRESS_FIELD_NAME . "_" . $id])) ? $_POST[ADDRESS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $city = (isset($_POST[CITY_FIELD_NAME . "_" . $id])) ? $_POST[CITY_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $state = (isset($_POST[STATE_FIELD_NAME . "_" . $id])) ? $_POST[STATE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $zipCode = (isset($_POST[ZIP_FIELD_NAME . "_" . $id])) ? $_POST[ZIP_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    if (Constant::MODE_SAVE_CREATE == $mode) {
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode);
      $databaseResult->insertLocation(params: $params);
    } elseif (Constant::MODE_SAVE_MODIFY == $mode) {
      $locationName = (isset($_POST[LOCATION_NAME_FIELD_NAME . "_" . $id])) ? $_POST[LOCATION_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $tempLocationId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode, $tempLocationId);
      $databaseResult->updateLocation(params: $params);
    }
    $ctr ++;
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::MODE_VIEW;
}
if (Constant::MODE_VIEW == $mode || Constant::MODE_DELETE == $mode || Constant::MODE_CONFIRM == $mode) {
  if (Constant::MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($ids);
      $databaseResult->deleteLocation(params: $params);
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
  $params = array(true, false, false);
  $query = $databaseResult->getLocation(params: $params);
  if (Constant::MODE_DELETE == $mode) {
    $query .= " WHERE locationId IN (" . $ids . ")";
  }
  $colFormats = array(array(0, "right", 0), array(7, "right", 0));
  $hideColIndexes = array(2);
  //$link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $link = array(array(3), array("manageUser.php", array("userId", "mode"), array(2, "modify"), 3));
  //     $caption, $class, $colspan, $columnFormat, $debug, $delimiter, $foreignKeys, $header, $hiddenAdditional, $hiddenId, $hideColumnIndexes, $html, $id, $link, $note, $query, $selectedRow, $suffix, $width
  $htmlTable = new HtmlTable(caption: null, class: null, colspan: null, columnFormat: $colFormats, debug: SessionUtility::getValue(SessionUtility::OBJECT_NAME_DEBUG), delimiter: Constant::DELIMITER_DEFAULT, foreignKeys: null, header: true, hiddenAdditional: null, hiddenId: HIDDEN_ROW_FIELD_NAME, hideColumnIndexes: $hideColIndexes, html: null, id: null, link: $link, note: true, query: $query, selectedRow: $ids, suffix: null, width: "90%");
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
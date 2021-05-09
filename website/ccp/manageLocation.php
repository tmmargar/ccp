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
define("PHONE_FIELD_LABEL", "Phone");
define("ACTIVE_FIELD_LABEL", "Active");
define("PLAYER_ID_FIELD_LABEL", "Player name");
define("LOCATION_NAME_FIELD_NAME", "locationName");
define("ADDRESS_FIELD_NAME", "address");
define("CITY_FIELD_NAME", "city");
define("STATE_FIELD_NAME", "states");
define("ZIP_FIELD_NAME", "zipCode");
define("PHONE_FIELD_NAME", "phone");
define("ACTIVE_FIELD_NAME", "active");
define("PLAYER_ID_FIELD_NAME", "playerId");
$smarty->assign("title", "Manage Location");
$smarty->assign("heading", "Manage Location");
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($ids) : array(0);
  $resultList = $databaseResult->getLocationById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $ids != DEFAULT_VALUE_BLANK)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
    foreach ($ary as $id) {
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . LOCATION_NAME_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOCATION_NAME, null, false, null, null, null, false, LOCATION_NAME_FIELD_NAME . "_" . $id, 30, LOCATION_NAME_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . PLAYER_ID_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $params = array(false);
      // $resultList2 = $databaseResult->getUsersAll($params);
      $resultList2 = $databaseResult->getUsersActive($params);
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left;\">\n";
        $selectLocation = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLAYER_ID, null, false, PLAYER_ID_FIELD_NAME . "_" . $id, false, PLAYER_ID_FIELD_NAME . "_" . $id, null, false, 1, null, null);
        $output .= $selectLocation->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, null, null, Constant::$TEXT_NONE, "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $user) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getUser()->getId() : "", null, $user->getName(), $user->getId());
          $output .= $option->getHtml();
        }
        $output .= "        </select>\n";
        $output .= "       </div>\n";
      }
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ADDRESS_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxAddress = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADDRESS, null, false, null, null, null, false, ADDRESS_FIELD_NAME . "_" . $id, 75, ADDRESS_FIELD_NAME . "_" . $id, null, null, false, null, null, 75, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getAddress() : ""), null);
      $output .= $textBoxAddress->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . CITY_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxCity = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CITY, null, false, null, null, null, false, CITY_FIELD_NAME . "_" . $id, 50, CITY_FIELD_NAME . "_" . $id, null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getCity() : ""), null);
      $output .= $textBoxCity->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . STATE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      // $output .= " <div style=\"float: left;\">\n " . HtmlUtility::buildStateDropDown($id, count($resultList) ? $resultList[$ctr]->getUser()->getAddress()->getState() : "") . "\n</div>\n";
      $output .= "    <div style=\"float: left;\">\n     <input id=\"states_" . $id . "\" name=\"states_" . $id . "\" readonly size=\"1\" type=\"text\" value=\"MI\" />\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ZIP_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxZip = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ZIP, null, false, null, null, null, false, ZIP_FIELD_NAME . "_" . $id, 50, ZIP_FIELD_NAME . "_" . $id, null, null, false, null, null, 5, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? (string) $resultList[$ctr]->getUser()->getAddress()->getZip() : ""), null);
      $output .= $textBoxZip->getHtml();
      $output .= " (5 digits)\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . PHONE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxPhone = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PHONE, null, false, null, null, null, false, PHONE_FIELD_NAME . "_" . $id, 10, PHONE_FIELD_NAME . "_" . $id, null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_TELEPHONE, ((count($resultList) > 0) ? (string) $resultList[$ctr]->getUser()->getAddress()->getPhone() : ""), null);
      $output .= $textBoxPhone->getHtml();
      $output .= " (10 digits)\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ACTIVE_FIELD_LABEL . ($id != "" ? " " . $id : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $checkboxActive = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) == 0) || Constant::$FLAG_YES == $resultList[$ctr]->getActive() ? true : false), null, null, false, ACTIVE_FIELD_NAME . "_" . $id, null, ACTIVE_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, (string) Constant::$FLAG_YES_DATABASE, null);
      $output .= "        " . $checkboxActive->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, HIDDEN_ROW_FIELD_NAME . "_" . $id, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
      $output .= $hiddenRow->getHtml();
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $ctr ++;
    }
    $buttonSave = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_SAVE, null, false, null, null, null, true, Constant::$TEXT_SAVE, null, Constant::$TEXT_SAVE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_SAVE, null);
    $output .= $buttonSave->getHtml();
    $buttonReset = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_RESET, null, false, null, null, null, false, Constant::$TEXT_RESET, null, Constant::$TEXT_RESET, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_RESET, Constant::$TEXT_RESET, null);
    $output .= $buttonReset->getHtml();
  }
  $buttonCancel = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
  $output .= $buttonCancel->getHtml();
  $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ctr = 0;
  $ary = explode(Constant::$DELIMITER_DEFAULT, $ids);
  foreach ($ary as $id) {
    $locationName = isset($_POST[LOCATION_NAME_FIELD_NAME . "_" . $id]) ? $_POST[LOCATION_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $playerId = (isset($_POST[PLAYER_ID_FIELD_NAME . "_" . $id])) ? $_POST[PLAYER_ID_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $address = (isset($_POST[ADDRESS_FIELD_NAME . "_" . $id])) ? $_POST[ADDRESS_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $city = (isset($_POST[CITY_FIELD_NAME . "_" . $id])) ? $_POST[CITY_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $state = (isset($_POST[STATE_FIELD_NAME . "_" . $id])) ? $_POST[STATE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $zipCode = (isset($_POST[ZIP_FIELD_NAME . "_" . $id])) ? $_POST[ZIP_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    $phone = (isset($_POST[PHONE_FIELD_NAME . "_" . $id])) ? preg_replace("/[^0-9]/", "", $_POST[PHONE_FIELD_NAME . "_" . $id]) : DEFAULT_VALUE_BLANK;
    $active = (isset($_POST[ACTIVE_FIELD_NAME . "_" . $id])) ? $_POST[ACTIVE_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode, $phone, isset($active) ? $active : 0);
      $databaseResult->insertLocation($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $locationName = (isset($_POST[LOCATION_NAME_FIELD_NAME . "_" . $id])) ? $_POST[LOCATION_NAME_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $tempLocationId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $id] : DEFAULT_VALUE_BLANK;
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode, $phone, isset($active) ? $active : 0, $tempLocationId);
      $databaseResult->updateLocation($params);
    }
    $ctr ++;
  }
  $ids = DEFAULT_VALUE_BLANK;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_BLANK != $ids) {
      $params = array($ids);
      $databaseResult->deleteLocation($params);
      $ids = DEFAULT_VALUE_BLANK;
    }
    $mode = Constant::$MODE_VIEW;
  }
  if (Constant::$MODE_VIEW == $mode) {
    $buttonCreate = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CREATE, null, false, null, null, null, false, Constant::$TEXT_CREATE, null, Constant::$TEXT_CREATE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CREATE, null);
    $output .= $buttonCreate->getHtml();
    $buttonModify = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_MODIFY, null, false, null, null, null, true, Constant::$TEXT_MODIFY, null, Constant::$TEXT_MODIFY, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_MODIFY, null);
    $output .= $buttonModify->getHtml();
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_DELETE, null, false, null, null, null, true, Constant::$TEXT_DELETE, null, Constant::$TEXT_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_DELETE, null);
    $output .= $buttonDelete->getHtml();
  } else if (Constant::$MODE_DELETE == $mode) {
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CONFIRM_DELETE, null, false, null, null, null, false, Constant::$TEXT_CONFIRM_DELETE, null, Constant::$TEXT_CONFIRM_DELETE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CONFIRM_DELETE, null);
    $output .= $buttonDelete->getHtml();
    $buttonDelete = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CANCEL, null, false, null, null, null, false, Constant::$TEXT_CANCEL, null, Constant::$TEXT_CANCEL, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_SUBMIT, Constant::$TEXT_CANCEL, null);
    $output .= $buttonDelete->getHtml();
  }
  $hiddenMode = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, Constant::$FIELD_NAME_MODE, null, Constant::$FIELD_NAME_MODE, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $mode, null);
  $output .= $hiddenMode->getHtml();
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $ids, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(true, false, false);
  $query = $databaseResult->getLocation($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE locationId IN (" . $ids . ")";
  }
  $colFormats = array(array(0, "right", 0), array(7, "right", 0));
  $hideColIndexes = array(2, 10);
  $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $htmlTable = new HtmlTable(null, null, null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, $hideColIndexes, null, null, $link, true, $query, $ids, null, "90%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
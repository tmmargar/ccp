<?php
namespace ccp;
use ccp\classes\model\Constant;
use ccp\classes\model\DatabaseResult;
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
define("SELECTED_ROWS_FIELD_NAME", "locationIds");
define("HIDDEN_ROW_FIELD_NAME", "rowLocationId");
define("SELECT_COLUMN_PREFIX_FIELD_NAME", "select");
define("DEFAULT_VALUE_LOCATION_NAME", "");
define("DEFAULT_VALUE_TEMP_LOCATION_ID", "");
define("DEFAULT_VALUE_ADDRESS_NAME", "");
define("DEFAULT_VALUE_CITY_NAME", "");
define("DEFAULT_VALUE_STATE_NAME", "");
define("DEFAULT_VALUE_ZIP_NAME", "");
define("DEFAULT_VALUE_PHONE_NAME", "");
define("DEFAULT_VALUE_ACTIVE_NAME", "");
define("DEFAULT_VALUE_NUM_ROWS", 20);
$smarty->assign("title", "Chip Chair and a Prayer Manage Location");
$smarty->assign("script", "<script src=\"scripts/manageLocation.js\" type=\"text/javascript\"></script>\n");
$smarty->assign("heading", "Manage Location");
$smarty->assign("style", "");
$mode = isset($_POST[Constant::$FIELD_NAME_MODE]) ? $_POST[Constant::$FIELD_NAME_MODE] : Constant::$MODE_VIEW;
$smarty->assign("mode", $mode);
$smarty->assign("action", $_SERVER["SCRIPT_NAME"]);
$smarty->assign("formName", "frmManageLocation");
$locationIds = isset($_POST[SELECTED_ROWS_FIELD_NAME]) ? $_POST[SELECTED_ROWS_FIELD_NAME] : DEFAULT_VALUE_TEMP_LOCATION_ID;
$locationName = isset($_POST[LOCATION_NAME_FIELD_NAME . "_"]) ? $_POST[LOCATION_NAME_FIELD_NAME . "_"] : DEFAULT_VALUE_LOCATION_NAME;
$playerId = isset($_POST[PLAYER_ID_FIELD_NAME . "_"]) ? $_POST[PLAYER_ID_FIELD_NAME . "_"] : "";
$address = isset($_POST[ADDRESS_FIELD_NAME . "_"]) ? $_POST[ADDRESS_FIELD_NAME . "_"] : DEFAULT_VALUE_ADDRESS_NAME;
$city = isset($_POST[CITY_FIELD_NAME . "_"]) ? $_POST[CITY_FIELD_NAME . "_"] : DEFAULT_VALUE_CITY_NAME;
$state = isset($_POST[STATE_FIELD_NAME . "_"]) ? $_POST[STATE_FIELD_NAME . "_"] : DEFAULT_VALUE_STATE_NAME;
// $zip = isset($_POST[ZIP_FIELD_NAME . "_"]) ? $_POST[ZIP_FIELD_NAME . "_"] : DEFAULT_VALUE_ZIP_NAME;
$phone = isset($_POST[PHONE_FIELD_NAME . "_"]) ? $_POST[PHONE_FIELD_NAME . "_"] : DEFAULT_VALUE_PHONE_NAME;
$active = isset($_POST[ACTIVE_FIELD_NAME . "_"]) ? $_POST[ACTIVE_FIELD_NAME . "_"] : DEFAULT_VALUE_ACTIVE_NAME;
$databaseResult = new DatabaseResult(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG));
// $databaseResult = new DatabaseResult(TRUE);
$output = "";
if (Constant::$MODE_CREATE == $mode || Constant::$MODE_MODIFY == $mode) {
  $params = Constant::$MODE_MODIFY == $mode ? array($locationIds) : array(0);
  $resultList = $databaseResult->getLocationById($params);
  if (Constant::$MODE_CREATE == $mode || (Constant::$MODE_MODIFY == $mode && $locationIds != DEFAULT_VALUE_TEMP_LOCATION_ID)) {
    $ctr = 0;
    $ary = explode(Constant::$DELIMITER_DEFAULT, $locationIds);
    while ($ctr < count($ary)) {
      $output = "    <div style=\"float: left; width: 125px; height: 25px;\">" . LOCATION_NAME_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxName = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_LOCATION_NAME, null, false, null, null, null, false, LOCATION_NAME_FIELD_NAME . "_" . $ary[$ctr], 30, LOCATION_NAME_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getName() : ""), null);
      $output .= $textBoxName->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . PLAYER_ID_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $params = array(false);
      $resultList2 = $databaseResult->getUsersAll($params);
      if (count($resultList2) > 0) {
        $output .= "    <div style=\"float: left;\">\n";
        $selectLocation = new FormSelect(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PLAYER_ID, null, false, PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr], false, PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr], null, false, 1, null, null);
        $output .= $selectLocation->getHtml();
        $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, $playerId, null, Constant::$TEXT_NONE, "");
        $output .= $option->getHtml();
        foreach ($resultList2 as $user) {
          $option = new FormOption(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, false, null, null, count($resultList) > 0 ? $resultList[$ctr]->getUser()->getId() : "", null, $user->getName(), $user->getId());
          $output .= $option->getHtml();
        }
        $output .= "        </select>\n";
        $output .= "       </div>\n";
      }
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ADDRESS_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxAddress = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ADDRESS, null, false, null, null, null, false, ADDRESS_FIELD_NAME . "_" . $ary[$ctr], 75, ADDRESS_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 75, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getAddress() : ""), null);
      $output .= $textBoxAddress->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . CITY_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxCity = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_CITY, null, false, null, null, null, false, CITY_FIELD_NAME . "_" . $ary[$ctr], 50, CITY_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 30, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getCity() : ""), null);
      $output .= $textBoxCity->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . STATE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
//       $output .= "    <div style=\"float: left;\">\n     " . HtmlUtility::buildStateDropDown($ary[$ctr], count($resultList) ? $resultList[$ctr]->getUser()->getAddress()->getState() : "") . "\n</div>\n";
      $output .= "    <div style=\"float: left;\">\n     <input id=\"states_" . $ary[$ctr] . "\" name=\"states_" . $ary[$ctr] . "\" readonly size=\"1\" type=\"text\" value=\"MI\" />\n</div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ZIP_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxZip = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_ZIP, null, false, null, null, null, false, ZIP_FIELD_NAME . "_" . $ary[$ctr], 50, ZIP_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 5, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getZip() : ""), null);
      $output .= $textBoxZip->getHtml();
      $output .= " (5 digits)\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . PHONE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $textBoxPhone = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$ACCESSKEY_PHONE, null, false, null, null, null, false, PHONE_FIELD_NAME . "_" . $ary[$ctr], 10, PHONE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, 10, null, FormControl::$TYPE_INPUT_TEXTBOX, ((count($resultList) > 0) ? $resultList[$ctr]->getUser()->getAddress()->getPhone() : ""), null);
      $output .= $textBoxPhone->getHtml();
      $output .= " (10 digits)\n";
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $output .= "    <div style=\"float: left; width: 125px; height: 25px;\">" . ACTIVE_FIELD_LABEL . ($ary[$ctr] != "" ? " " . $ary[$ctr] : "") . ": </div>\n";
      $output .= "    <div style=\"float: left;\">\n     ";
      $checkboxActive = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, ((count($resultList) == 0) || Constant::$FLAG_YES == $resultList[$ctr]->getActive() ? true : false), null, null, false, ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, ACTIVE_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_CHECKBOX, Constant::$FLAG_YES_DATABASE, null);
      $output .= "        " . $checkboxActive->getHtml();
      $output .= "    </div>\n";
      $output .= "    <div style=\"clear: both;\"></div>\n";
      $hiddenRow = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, ((count($resultList) > 0) ? $resultList[$ctr]->getId() : ""), null);
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $locationIds, null);
  $output .= $hiddenSelectedRows->getHtml();
} elseif (Constant::$MODE_SAVE_CREATE == $mode || Constant::$MODE_SAVE_MODIFY == $mode) {
  $ary = explode(Constant::$DELIMITER_DEFAULT, $locationIds);
  $numRows = count($ary);
  $ctr = 0;
  while ($ctr < $numRows) {
    $playerId = (isset($_POST[PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[PLAYER_ID_FIELD_NAME . "_" . $ary[$ctr]] : "";
    $address = (isset($_POST[ADDRESS_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[ADDRESS_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_ADDRESS_NAME;
    $city = (isset($_POST[CITY_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[CITY_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_CITY_NAME;
    $state = (isset($_POST[STATE_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[STATE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_STATE_NAME;
    $zipCode = (isset($_POST[ZIP_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[ZIP_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_ZIP_NAME;
    $phone = (isset($_POST[PHONE_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[PHONE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_PHONE_NAME;
    $active = (isset($_POST[ACTIVE_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[ACTIVE_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_ACTIVE_NAME;
//     print_r($_POST);
//     echo "<BR>act -> " . $active;
    if (Constant::$MODE_SAVE_CREATE == $mode) {
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode, $phone, isset($active) ? $active : 0);
      $databaseResult->insertLocation($params);
    } elseif (Constant::$MODE_SAVE_MODIFY == $mode) {
      $locationName = (isset($_POST[LOCATION_NAME_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[LOCATION_NAME_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_LOCATION_NAME;
      $tempLocationId = (isset($_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]])) ? $_POST[HIDDEN_ROW_FIELD_NAME . "_" . $ary[$ctr]] : DEFAULT_VALUE_TEMP_LOCATION_ID;
      $params = array($locationName, $playerId, $address, $city, $state, $zipCode, $phone, isset($active) ? $active : 0, $tempLocationId);
//       print_r($params);
      $databaseResult->updateLocation($params);
    }
    $ctr ++;
  }
  $locationIds = DEFAULT_VALUE_TEMP_LOCATION_ID;
  $mode = Constant::$MODE_VIEW;
}
if (Constant::$MODE_VIEW == $mode || Constant::$MODE_DELETE == $mode || Constant::$MODE_CONFIRM == $mode) {
  if (Constant::$MODE_CONFIRM == $mode) {
    if (DEFAULT_VALUE_TEMP_LOCATION_ID != $locationIds) {
      $params = array($locationIds);
      $databaseResult->deleteLocation($params);
      $locationIds = DEFAULT_VALUE_TEMP_LOCATION_ID;
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
  $hiddenSelectedRows = new FormControl(SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), null, null, false, null, null, null, false, SELECTED_ROWS_FIELD_NAME, null, SELECTED_ROWS_FIELD_NAME, null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $locationIds, null);
  $output .= $hiddenSelectedRows->getHtml();
  $params = array(true, false, false);
  $query = $databaseResult->getLocation($params);
  if (Constant::$MODE_DELETE == $mode) {
    $query .= " WHERE locationId IN (" . $locationIds . ")";
  }
  $colFormats = array(array(0, "right", 0), array(7, "right", 0));
  $hideColIndexes = array(2, 10);
  $link = array(array(3), array("manageUser.php", array("userId", "mode"), 2, "modify", 3));
  $htmlTable = new HtmlTable(null, null, null, $colFormats, SessionUtility::getValue(SessionUtility::$OBJECT_NAME_DEBUG), Constant::$DELIMITER_DEFAULT, null, true, null, HIDDEN_ROW_FIELD_NAME, $hideColIndexes, null, null, $link, true, $query, $locationIds, null, "90%");
  $output .= $htmlTable->getHtml();
}
$smarty->assign("content", $output);
$smarty->display("manage.tpl");
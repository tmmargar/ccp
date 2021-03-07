"use strict";
const year = new Date().getFullYear();
const defaultDescription = "Season " + (year - firstYear + 1) + " - Tournament ";
$(document).ready(function() {
  input.initialize();
});
$(document).on("keyup paste", "input[id^='tournamentDescription_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("change", "select[id^='tournamentLimitTypeId_'], select[id^='tournamentGameTypeId_'], select[id^='tournamentLocationId_'], select[id^='tournamentGroupId_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("keyup paste", "input[id^='tournamentChipCount_'], input[id^='tournamentMaxPlayers_']", function(event) {
  input.validateNumberOnlyGreaterZero($(this), event);
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("change keyup paste", "input[id^='tournamentStartDateTime_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("keyup paste", "input[id^='tournamentBuyinAmount_'], input[id^='tournamentRebuyAmount_'], input[id^='tournamentAddonAmount_']", function(event) {
  if ($(this).prop("id").search(/tournamentBuyinAmount_/g) == -1) {
    input.validateNumberOnly($(this), event, false);
  } else {
    input.validateNumberOnlyGreaterZero($(this), event);
  }
  input.validateLength($(this), 1, false);
  if ($(this).prop("id").search(/tournamentRebuyAmount_/g) != -1) {
    input.validateLength($("input[id^='tournamentRebuys_']"), 1, false);
  }
  if ($(this).prop("id").search(/tournamentAddonAmount_/g) != -1) {
    input.validateLength($("input[id^='tournamentAddonChipCount_']"), 1, false);
  }
  input.enable("save", inputLocal.enableSave);
});
$(document).on("keyup paste", "input[id^='tournamentRebuys_'], input[id^='tournamentAddonChipCount_']", function(event) {
  input.validateNumberOnly($(this), event, true);
  input.validateLength($(this), 1, false);
  if ($(this).prop("id").search(/tournamentRebuys_/g) != -1) {
    input.validateLength($("input[id^='tournamentRebuyAmount_']"), 1, false);
  }
  if ($(this).prop("id").search(/tournamentAddonChipCount_/g) != -1) {
    input.validateLength($("input[id^='tournamentAddonAmount_']"), 1, false);
  }
  input.enable("save", inputLocal.enableSave);
});
$(document).on("keyup paste", "input[id^='tournamentRake_']", function(event) {
  input.validatePercentOnly($(this), event);
  input.validateLength($(this), $(this).val().indexOf("$") == -1 ? 1 : 2, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return (($("#tournamentDescription_" + id).val() == "") || ($("#tournamentLimitTypeId_" + id).val() == "") || ($("#tournamentGameTypeId_" + id).val() == "")
    || ($("#tournamentChipCount_" + id).val().length == 0) || ($("#tournamentLocationId_" + id).val() == "")
    || ($("#tournamentStartDateTime_" + id).val().length == 0)
    || ($("#tournamentBuyinAmount_" + id).val().length == 0) || ($("#tournamentMaxPlayers_" + id).val().length == 0) || ($("#tournamentRebuyAmount_" + id).val().length == 0)
    || ($("#tournamentRebuys_" + id).val().length == 0) || ($("#tournamentAddonAmount_" + id).val().length == 0) || ($("#tournamentAddonChipCount_" + id).val().length == 0)
    || ($("#tournamentRake_" + id).val().length == 0) || ($("#tournamentGroupId_" + id).val() == "") || !inputLocal.customValidation(false));
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", 
      [{ "orderSequence": [ "desc", "asc" ], "width": "3%" },
      { "width": "12%",
        className : "textAlignUnset",
        render: function (data, type, row) {
          //console.log(row[18]);
          // row[2] is comment, row[18] is special type
          if (type === 'display') {
            const title = " title=\"" + row[18] + "\"";
            const specialType = "" != row[18] ? " (" + row[18] + ")" : "";
            return "<span" + title + ">" + data + specialType + "</span>";
          }
          return data;
        }
      },
      { "orderable": false, "visible": false, "width": "11%" }, { className : "textAlignUnset", "width": "11%" }, { "width": "7%" },
      { "width": "5%" }, { "orderable": false, "width": "1%" }, { "type": "date", "width": "6%" }, { "type": "time", "width": "4%" }, { "width": "5%" },
      { "width": "4%" }, { "type": "currency", "width": "4%" }, { "width": "4%" }, { "type": "currency", "width": "4%" }, { "type": "currency", "width": "4%" },
      { "type": "number", "width": "4%" }, { "width": "4%" }, { "type": "percentage", "width": "4%" }, { "orderable": false, "visible": false, "width": "3%" }, { "orderable": false, "visible": false }],
    [[ 7, "desc"], [8, "desc" ]]);
  },
  setDefaults : function() {
    input.initializeTimePicker("m/d/Y h:i A", true, [0, 1, 2, 3, 4, 5], ['14:00', '15:00', '17:30', '19:30']);
    if ($("#mode").val() == "create") {
      $("#tournamentDescription_").val(defaultDescription);
      $("#tournamentLimitTypeId_").val(3);
      $("#tournamentGameTypeId_").val(1);
      $("#tournamentChipCount_").val(3000);
      const d = new Date();
      d.setDate(d.getDate() + (6 - d.getDay()));
      $('#tournamentStartDateTime_').val($.datepicker.formatDate("mm/dd/yy", d) + " 02:00");
      $("#tournamentMaxPlayers_").val(27);
      $("#tournamentBuyinAmount_").val("25");
      $("#tournamentMaxRebuys_").val(0);
      $("#tournamentRebuyAmount_").val("25");
      $("#tournamentRebuys_").val(99);
      $("#tournamentAddonAmount_").val("15");
      $("#tournamentAddonChipCount_").val(1500);
      $("#tournamentRake_").val("20");
      $("#tournamentGroupId_").val(2);
    }
  },
  validate : function() {
    input.validateLength($("#tournamentDesc_"), 1, false);
    input.validateLength($("#tournamentLimitTypeId_"), 1, false);
    input.validateLength($("#tournamentGameTypeId_"), 1, false);
    input.validateLength($("#tournamentChipCount_"), 1, false);
    input.validateLength($("#tournamentLocationId_"), 1, false);
    input.validateLength($("#tournamentStartDateTime_"), 1, false);
    input.validateLength($("#tournamentBuyinAmount_"), 1, false);
    input.validateLength($("#tournamentMaxPlayers_"), 1, false);
    input.validateLength($("#tournamentRebuyAmount_"), 1, false);
    input.validateLength($("#tournamentRebuys_"), 1, false);
    input.validateLength($("#tournamentAddonAmount_"), 1, false);
    input.validateLength($("#tournamentAddonChipCount_"), 1, false);
    input.validateLength($("#tournamentGroupId_"), 1, false);
    input.validateLength($("#tournamentRake_"), 1, false);
  },
  customValidation : function(confirmation) {
    let result = true;
    let msg = [];
    const aryId = $("#ids").val().split(", ");
    for (let id of aryId) {
      if ($("#tournamentRebuys_" + id).length > 0) {
        const rebuys = $("#tournamentRebuys_" + id).val();
        const rebuyAmount = $("#tournamentRebuyAmount_" + id).val();
        if ((((rebuyAmount == "$0") || (rebuyAmount == "0")) && (rebuys != "0")) || (((rebuyAmount != "$0") && (rebuyAmount != "0")) && (rebuys == "0"))) {
          msg.push("You must enter either both the rebuy amount and the max rebuys or 0 for both");
          $("#tournamentRebuys_" + id).addClass("errors");
          $("#tournamentRebuyAmount_" + id).addClass("errors");
        }
        const addonAmount = $("#tournamentAddonAmount_" + id).val();
        const addonChipCount = $("#tournamentAddonChipCount_" + id).val();
        if ((((addonAmount == "$0") || (addonAmount == "0")) && (addonChipCount != "0")) || (((addonAmount!= "$0") && (addonAmount != "0")) && (addonChipCount == "0"))) {
          msg.push("You must enter either both the addon amount and the addon chip count or 0 for both");
          $("#tournamentAddonChipCount_" + id).addClass("errors");
          $("#tournamentAddonAmount_" + id).addClass("errors");
        }
        if (confirmation) {
          result = inputLocal.confirmAction();
        }
      }
    }
    if (msg.length > 0) {
      display.showErrors(msg);
      result = false;
    }
    return result;
  },
  confirmAction : function() {
    let result = true;
    if ($("#tournamentResultsExist").val() == "1") {
      result = confirm("There are results entered for this tournament. Do you want to modify?");
    }
    return result;
  },
  save : function(event) {
    let result = true;
    const aryId = $("#ids").val().split(", ");
    for (let id of aryId) {
      if (!inputLocal.customValidation(true)) {
        if (event) {
          event.preventDefault();
          event.stopPropagation();
        }
        result = false;
      }
    }
    return result;
  }  
};
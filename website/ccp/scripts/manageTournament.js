var firstYear = 2006;
var date = new Date();
var year = date.getFullYear();
var defaultDescription = "Season " + (year - firstYear + 1) + " - Tournament ";
$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.enableSave();
  inputLocal.postProcessing();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $("#modify").prop("disabled", false);
    $("#delete").prop("disabled", false);
  } else {
    $("#modify").prop("disabled", true);
    $("#delete").prop("disabled", true);
  }
  if ($(".selected").length > 1) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "tournamentIds" ], [ "create", "" ]);
});
$(document).on("click", "#modify", function(event) {
  var selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else if (selectedRows.length > 1) {
    display.showErrors([ "You must select only 1 row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setTournamentIds(selectedRows);
    input.setFormValues([ "mode" ], [ "modify" ]);
  }
});
$(document).on("click", "#delete", function(event) {
  var selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to delete" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setTournamentIds(selectedRows);
    input.setFormValues([ "mode" ], [ "delete" ]);
  }
});
$(document).on("click", "#confirmDelete", function(event) {
  if (inputLocal.confirmAction()) {
    input.setFormValues([ "mode" ], [ "confirm" ]);
  } else {
    event.preventDefault();
    event.stopPropagation();
  }
});
$(document).on("click", "#cancel", function(event) {
  input.setFormValues([ "mode" ], [ "view" ]);
});
$(document).on("click", "#save", function(event) {
  var ids = $("#tournamentIds").val();
  var aryId = ids.split(", ");
  for (var idx=0; idx < aryId.length; idx++) {
    if ($("#tournamentBuyinAmount_" + aryId[idx]).length > 0) {
      var count = 0;
      var position = $("#tournamentBuyinAmount_" + aryId[idx]).val().indexOf("-");
      if (position != -1) {
        count++;
      }
      position = $("#tournamentBuyinAmount_" + aryId[idx]).val().indexOf("$");
      if (position != -1) {
        count++;
      }
      var buyin = count == 0 ? $("#tournamentBuyinAmount_" + aryId[idx]).val() : $("#tournamentBuyinAmount_" + aryId[idx]).val().substring(count);
      $("#tournamentBuyinAmount_" + aryId[idx]).val(buyin);
      count = 0;
      position = $("#tournamentRebuyAmount_" + aryId[idx]).val().indexOf("-");
      if (position != -1) {
        count++;
      }
      position = $("#tournamentRebuyAmount_" + aryId[idx]).val().indexOf("$");
      if (position != -1) {
        count++;
      }
      var rebuy = count == 0 ? $("#tournamentRebuyAmount_" + aryId[idx]).val() : $("#tournamentRebuyAmount_" + aryId[idx]).val().substring(count);
      $("#tournamentRebuyAmount_" + aryId[idx]).val(rebuy);
      count = 0;
      position = $("#tournamentAddonAmount_" + aryId[idx]).val().indexOf("-");
      if (position != -1) {
        count++;
      }
      position = $("#tournamentAddonAmount_" + aryId[idx]).val().indexOf("$");
      if (position != -1) {
        count++;
      }
      var addon = count == 0 ? $("#tournamentAddonAmount_" + aryId[idx]).val() : $("#tournamentAddonAmount_" + aryId[idx]).val().substring(count);
      $("#tournamentAddonAmount_" + aryId[idx]).val(addon);
    }
    var result = inputLocal.customValidation();
    if (!result) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      input.setFormValues(["mode"], ["save" + $("#mode").val()]);
    }
  }
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode", "tournamentIds" ], [ $("#mode").val(), $("#tournamentIds").val() ]);
});
$(document).on("keyup paste", 'input[id^="tournamentDescription_"]', function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change", 'select[id^="tournamentLimitTypeId_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("change", 'select[id^="tournamentGameTypeId_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentChipCount_"]', function(event) {
  input.validateNumberOnlyGreaterZero($(this), event);
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change", 'select[id^="tournamentLocationId_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="tournamentStartDateTime_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentBuyinAmount_"]', function(event) {
    input.validateCurrencyOnly($(this), event);
  if ($(this).val().indexOf("$") == -1) {
    input.validateLength($(this), 1, false);
  } else {
    input.validateLength($(this), 2, false);
  }
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentMaxPlayers_"]', function(event) {
  input.validateNumberOnlyGreaterZero($(this), event);
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentRebuys_"]', function(event) {
  input.validateNumberOnly($(this), event, true);
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentRebuyAmount_"]', function(event) {
  input.validateCurrencyOnly($(this), event);
  if ($(this).val().indexOf("$") == -1) {
    input.validateLength($(this), 1, false);
  } else {
    input.validateLength($(this), 2, false);
  }
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentAddonAmount_"]', function(event) {
  input.validateCurrencyOnly($(this), event);
  if ($(this).val().indexOf("$") == -1) {
    input.validateLength($(this), 1, false);
  } else {
    input.validateLength($(this), 2, false);
  }
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentAddonChipCount_"]', function(event) {
  input.validateNumberOnly($(this), event, true);
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change", 'select[id^="tournamentGroupId_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("click keyup paste", 'input[id^="tournamentRake_"]', function(event) {
  input.validatePercentOnly($(this), event);
  if ($(this).val().indexOf("%") == -1) {
    input.validateLength($(this), 1, false);
  } else {
    input.validateLength($(this), 2, false);
  }
  inputLocal.enableSave();
});
var inputLocal = {
  enableSave : function() {
    var ids = $("#tournamentIds").val();
    var aryId = ids.split(", ");
    for (var idx=0; idx < aryId.length; idx++) {
      if ($("#tournamentLimitTypeId_" + aryId[idx]).length > 0) {
        if (($("#tournamentDescription_" + aryId[idx]).val() == "") || ($("#tournamentLimitTypeId_" + aryId[idx]).val() == "") || ($("#tournamentGameTypeId_" + aryId[idx]).val() == "")
        || ($("#tournamentChipCount_" + aryId[idx]).val().length == 0) || ($("#tournamentLocationId_" + aryId[idx]).val() == "")
        || ($("#tournamentStartDateTime_" + aryId[idx]).val().length == 0)
        || ($("#tournamentBuyinAmount_" + aryId[idx]).val().length == 0) || ($("#tournamentMaxPlayers_" + aryId[idx]).val().length == 0) || ($("#tournamentRebuyAmount_" + aryId[idx]).val().length == 0)
        || ($("#tournamentRebuys_" + aryId[idx]).val().length == 0) || ($("#tournamentAddonAmount_" + aryId[idx]).val().length == 0) || ($("#tournamentAddonChipCount_" + aryId[idx]).val().length == 0)
        || ($("#tournamentRake_" + aryId[idx]).val().length == 0) || ($("#tournamentGroupId_" + aryId[idx]).val() == "")) {
          $("#save").prop("disabled", true);
        } else {
          $("#save").prop("disabled", false);
          break;
        }
      }
    }
  },
  setTournamentIds : function(selectedRows) {
    var tournamentIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      tournamentIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    tournamentIds = tournamentIds.substring(0, tournamentIds.length - 2);
    $("#tournamentIds").val(tournamentIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns": [
        { "orderSequence": [ "desc", "asc" ], "width": "3%" },
        { "width": "12%",
          className : "textAlignUnset",
          render: function (data, type, row) {
            //console.log(row[18]);
            // row[2] is comment, row[18] is special type
            if (type === 'display') {
              var title = " title=\"" + row[18] + "\"";
              var specialType = "" != row[18] ? " (" + row[18] + ")" : "";
              return "<span" + title + ">" + data + specialType + "</span>";
            }
            return data;
          }
        },
        { "orderable": false, "visible": false, "width": "11%" },
        { className : "textAlignUnset", "width": "11%" },
        { "width": "7%" },
        { "width": "5%" },
        { "orderable": false, "width": "1%" },
        { "type": "date", "width": "6%" },
        { "type": "time", "width": "4%" },
        { "width": "5%" },
        { "width": "4%" },
        { "type": "currency", "width": "4%" },
        { "width": "4%" },
        { "type": "currency", "width": "4%" },
        { "type": "currency", "width": "4%" },
        { "type": "number", "width": "4%" },
        { "width": "4%" },
        { "type": "percentage", "width": "4%" },
        { "orderable": false, "visible": false, "width": "3%" },
        { "orderable": false, "visible": false },
      ],
      "order": [[ 7, "desc"], [8, "desc" ]],
      "paging": false,
      "scrollY": "300px",
      "scrollResize": true,
      "scrollCollapse": true
    });
  },
  setDefaults : function() {
    inputLocal.initializeTimePickerStart();
    if ($("#mode").val() == "create") {
      //TODO: change and move defaults
      $("#tournamentDescription_").val(defaultDescription);
      $("#tournamentLimitTypeId_").val(3);
      $("#tournamentGameTypeId_").val(1);
      $("#tournamentChipCount_").val(3000);
      var d = new Date();
      d.setDate(d.getDate() + (6 - d.getDay()));
      $('#tournamentStartDateTime_').val($.datepicker.formatDate("mm/dd/yy", d) + " 14:00");
      $("#tournamentMaxPlayers_").val(27);
      $("#tournamentBuyinAmount_").val("$25");
      $("#tournamentMaxRebuys_").val(0);
      $("#tournamentRebuyAmount_").val("$25");
      $("#tournamentRebuys_").val(99);
      $("#tournamentAddonAmount_").val("$15");
      $("#tournamentAddonChipCount_").val(1500);
      $("#tournamentRake_").val("20%");
      $("#tournamentGroupId_").val(2);
    }
  },
  initialValidation : function() {
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
  postProcessing : function() {
    $("input[id^='tournamentDescription_']").focus();
  },
  initializeTimePickerStart : function() {
    $(".timePickerStart").datetimepicker({
      allowTimes: ['14:00', '15:00', '17:30', '19:30'],
      disabledWeekDays: [0, 1, 2, 3, 4, 5],
      format: "m/d/Y H:i",
      lastInit: true,
      mask: true,
      yearStart: "2005"
    });
  },
  customValidation : function() {
    var result = true;
    var msg = [];
    var ids = $("#tournamentIds").val();
    var aryId = ids.split(", ");
    for (var idx=0; idx < aryId.length; idx++) {
      if ($("#tournamentRebuys_" + aryId[idx]).length > 0) {
        var rebuys = $("#tournamentRebuys_" + aryId[idx]).val();
        var amount = $("#tournamentRebuyAmount_" + aryId[idx]).val();
        var invalid =  (((amount == "$0") || (amount == "0")) && (rebuys != "0")) || (((amount != "$0") && (amount != "0")) && (rebuys == "0"));
        if (invalid) {
           msg.push("You must enter either both the rebuy amount and the max rebuys or 0 for both");
          $("#tournamentRebuys_" + aryId[idx]).addClass("errors");
          $("#tournamentRebuyAmount_" + aryId[idx]).addClass("errors");
          result = false;
        }
        var chipCount = $("#tournamentAddonChipCount_" + aryId[idx]).val();
        var amount = $("#tournamentAddonAmount_" + aryId[idx]).val();
        var invalid =  (((amount == "$0") || (amount == "0")) && (chipCount != "0")) || (((amount != "$0") && (amount != "0")) && (chipCount == "0"));
        if (invalid) {
          msg.push("You must enter either both the addon amount and the addon chip count or 0 for both");
          $("#tournamentAddonChipCount_" + aryId[idx]).addClass("errors");
          $("#tournamentAddonAmount_" + aryId[idx]).addClass("errors");
          result = false;
        }
        result = inputLocal.confirmAction();
      }
    }
    if (msg.length > 0) {
      display.showErrors(msg);
    }
    return result;
  },
  confirmAction : function() {
    var result = true;
    if ($("#tournamentResultsExist").val() == "1") {
      result = confirm("There are results entered for this tournament. Do you want to modify?");
    }
    return result;
  }  
};
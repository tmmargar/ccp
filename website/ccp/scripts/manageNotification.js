"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("keyup paste", "input[id^='notificationDescription_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("change keyup paste", "input[id^='notificationStartDate_'], input[id^='notificationEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return (($("#notificationDescription_" + id).val() == "") || ($("#notificationStartDate_" + id).val().length == 0) || ($("#notificationEndDate_" + id).val().length == 0) || maskDateTime == $("#notificationStartDate_" + id).val() || maskDateTime == $("#notificationEndDate_" + id).val());
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "10%" }, { "width": "50%" }, { "width": "20%" }, { "width": "20%" }, { "orderable": false, "visible": false }], [[2, "desc"], [3, "desc"]]);
  },
  setDefaults : function() {
    input.initializeTimePicker();
  },
  validate : function() {
    input.validateLength($("input[id^='notificationDescription_']"), 1, false);
    input.validateLength($("#notificationStartDate_"), 1, false);
    input.validateLength($("#notificationEndDate_"), 1, false);
  }
};
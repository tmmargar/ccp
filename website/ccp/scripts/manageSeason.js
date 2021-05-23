"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("keyup paste", "input[id^='seasonDescription_'], input[id^='seasonChampionshipQualify_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("change keyup paste", "input[id^='seasonStartDate_'], input[id^='seasonEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return (($("#seasonDescription_" + id).val() == "") || ($("#seasonStartDate_" + id).val().length == 0) || ($("#seasonEndDate_" + id).val().length == 0) || ($("#seasonChampionshipQualify_" + id).val() <= 0));
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "5%" }, { "width": "30%" }, { "width": "30%" }, { "width": "25%" }, { "width": "5%" }, { "width": "5%" }, { "orderable": false, "visible": false }], [[5, "desc"], [2, "desc"]], true, false, "250px");
  },
  postProcessing : function() {
    dataTable.displayActive("dataTbl", 5);
  },
  setDefaults : function() {
    input.initializeTimePicker("m/d/Y", false);
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#seasonDescription_"), 1, false);
    input.validateLength($("#seasonStartDate_"), 1, false);
    input.validateLength($("#seasonEndDate_"), 1, false);
    input.validateLength($("#seasonChampionshipQualify_"), 1, false);
  }
};
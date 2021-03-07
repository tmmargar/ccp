"use strict";
$(document).ready(function() {
  input.initialize("specialTypeDescription_");
});
$(document).on("keyup paste", "input[id^='specialTypeDescription_'], input[id^='specialTypeStartDate_'], input[id^='specialTypeEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return $("#specialTypeDescription_" + id).val() == "";
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "20%" }, { "width": "80%" }, { "orderable": false, "visible": false } ], [[ 1, "asc"]]);
  },
  validate : function() {
    input.validateLength($("#specialTypeDescription_"), 1, false);
  }
};
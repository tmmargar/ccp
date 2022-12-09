"use strict";
$(document).ready(function() {
  input.initialize("specialTypeDescription_");
});
$(document).on("keyup paste", "[id^='specialTypeDescription_'], [id^='specialTypeStartDate_'], [id^='specialTypeEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return $("#specialTypeDescription_" + id).val() == "";
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "20%" }, { "width": "80%" }, { "orderable": false, "visible": false } ], [[ 1, "asc"]]);
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#specialTypeDescription_"), 1, false);
  }
};
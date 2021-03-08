"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click", "#dataTbl tr", function(event) {
  $("#register").prop("disabled", dataTable.getSelectedRows($("#dataTbl").dataTable()).length == 0);
});
$(document).on("click", "#register", function(event) {
  const selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setPlayerIds();
    $("#mode").val("modify");
  }
});
const inputLocal = {
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "type" : "name" }, null, { "type" : "registerOrder" }, {"searchable": false, "visible": false } ], [ [ 1, "desc" ], [ 2, "asc" ], [ 0, "asc" ] ]);
  },
  postProcessing : function() {
    input.enableView();
  },
  setDefaults : function() {
    input.insertSelectedAfter("Tournament", "tournamentId", "view");
  },
  setPlayerIds : function() {
    let playerIds = "";
    let statuses = "";
    const selectedRows = dataTable.getSelectedRowsData($("#dataTbl").DataTable());
    for (let idx = 0; idx < selectedRows.length; idx++) {
      const selectedRow = selectedRows[idx];
      playerIds += $(selectedRow[3]).val() + ", ";
      statuses += selectedRow[1] + ", ";
    }
    $("#ids").val(playerIds.substring(0, playerIds.length - 2));
    $("#tournamentPlayerStatus").val(statuses.substring(0, statuses.length - 2));
  },
  tableRowClick : function(row, selected) {
    if (!selected) {
      $(row).addClass("selected");
    }
  }
};
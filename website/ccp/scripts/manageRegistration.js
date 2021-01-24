$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($("#dataTbl tr.selected").length > 0) {
    $("#register").prop("disabled", false);
  } else {
    $("#register").prop("disabled", true);
  }
});
$(document).on("click", "#register", function(event) {
  var selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setPlayerIds(selectedRows);
    input.setFormValues([ "mode" ], [ "modify" ]);
  }
});
$(document).on("change", "#tournamentId", function(event) {
  inputLocal.enableView();
});
var inputLocal = {
  setPlayerIds : function(selectedRows) {
    var playerIds = "";
    var statuses = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      var dataTbl = $("#dataTbl").dataTable();
      var aryInput = dataTbl.fnGetData(selectedRows[idx], 3).split(" ");
      for (var ix = 0; ix < aryInput.length; ix++) {
        var aryValues = aryInput[ix].split("=")
        if (aryValues[0] == "id") {
          var aryId = aryValues[1].split("_");
          playerIds += aryId[1].substring(0, aryId[1].length - 1) + ", ";
          statuses += $(selectedRows[idx]).children("td:eq(1)").html() + ", ";
          break;
        }
      }
    }
    playerIds = playerIds.substring(0, playerIds.length - 2);
    $("#tournamentPlayerIds").val(playerIds);
    statuses = statuses.substring(0, statuses.length - 2);
    $("#tournamentPlayerStatus").val(statuses);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns" : [ {
        "type" : "name"
      }, null, {
        "type" : "registerOrder"
      }, {
        "searchable": false,
        "visible": false
      } ],
      "order" : [ [ 1, "desc" ], [ 2, "asc" ], [ 0, "asc" ] ],
      "paging": false,
      "scrollCollapse": true,
      "searching": false
    });
  },
  setDefaults : function() {
    $("<p>Tournament selected: " + $("#tournamentId :selected").text() + "</p>").insertAfter($("#view"));
  },
  initialValidation : function() {
  },
  postProcessing : function() {
    inputLocal.enableView();
  },
  enableView : function() {
    if ($("#tournamentId").val() != -1) {
      $("#view").prop("disabled", false);
    } else {
      $("#view").prop("disabled", true);
    }
  }
};
jQuery.fn.dataTableExt.oSort["registerOrder-asc"]  = function(val1, val2) {
  return display.sortNumber(val1, val2, " ", "asc");
};
jQuery.fn.dataTableExt.oSort["registerOrder-desc"] = function(val1, val2) {
  return display.sortNumber(val1, val2, " ", "desc");
};
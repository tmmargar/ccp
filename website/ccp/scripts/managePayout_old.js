$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $("#modify").prop("disabled", false);
    $("#delete").prop("disabled", false);
  } else {
    $("#modify").prop("disabled", true);
    $("#delete").prop("disabled", true);
  }
  /*if ($(".selected").length > 1) {
    $(this).removeClass("selected");
  }*/
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "payoutIds" ], [ "create", "" ]);
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
    inputLocal.setLocationIds(selectedRows);
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
    inputLocal.setLocationIds(selectedRows);
    input.setFormValues([ "mode" ], [ "delete" ]);
  }
});
$(document).on("click", "#confirmDelete", function(event) {
  input.setFormValues([ "mode" ], [ "confirm" ]);
});
$(document).on("click", "#cancel", function(event) {
  input.setFormValues([ "mode" ], [ "view" ]);
});
$(document).on("click", "#save", function(event) {
  input.setFormValues(["mode"], ["save" + $("#mode").val()]);
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode", "payoutIds" ], [ $("#mode").val(), $("#payoutIds").val() ]);
});
$(document).on("click keyup paste", 'input[id^="payoutName_"]', function(event) {
  input.validateLength($("#payoutName_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
var inputLocal = {
  enableSave : function() {
    var id = $("#payoutIds").val();
    if ($("#payoutName_" + id).length > 0) {
      // if name, player, address, city, state, zip or phone are empty then disable save button otherwise enable save button
      if ($("#payoutName_" + id).val().length == 0) {
        $("#save").prop("disabled", true);
      } else {
        $("#save").prop("disabled", false);
      }
    }
  },
  enableReset : function() {
    var id = $("#payoutIds").val();
    if ($("#payoutName_" + id).length > 0) {
      // if name is not empty then enable save button otherwise disable save button
      if ($("#payoutName_" + id).val().length != 0) {
        $("#reset").prop("disabled", false);
      } else {
        $("#reset").prop("disabled", true);
      }
    }
  },
  setPayoutIds : function(selectedRows) {
    var payoutIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      payoutIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    payoutIds = payoutIds.substring(0, payoutIds.length - 2);
    $("#payoutIds").val(payoutIds);
  },
  //p.payoutId, p.payoutName, p.bonusPoints, p.minPlayers, p.maxPlayers, s.place, s.percentage
  initializeDataTable : function() {
    var counter = -1;
    var aryRowGroup = {
      startRender: null,
      endRender: function ( rows, group, level ) {
        counter++;
        //console.log(rows.data().pluck(2));
        //console.log(rows.data().pluck(2)[0]);
        var bonusPoints = undefined == rows.data().pluck(2)[0] ? 0 : rows.data().pluck(2)[0];
        var minPlayers = undefined == rows.data().pluck(3)[0] ? 0 : rows.data().pluck(3)[0];
        var maxPlayers = undefined == rows.data().pluck(4)[0] ? 0 : rows.data().pluck(4)[0];
        return $('<tr/>').append('<td colspan="4">Payout for ' + group + ' has bonus points ' + bonusPoints + ', min players ' + minPlayers + ' and max players ' + maxPlayers + '</td>\n');
      },
      dataSrc: 1
    };
    $("#dataTbl").DataTable({
      "autoWidth" : false,
      "columns" : [{
    	  "orderSequence": [ "desc", "asc" ],
          "width" : "9%"
      }, {
        "width" : "26%"
      }, {
        "width" : "14%",
        "visible": false
      }, {
        "width" : "14%",
        "visible": false
      }, {
        "width" : "14%",
        "visible": false
      }, {
        "width" : "11%"
      }, {
        "type" : "percentage",
        "width" : "12%"
      }, {
        "searchable": false,
        "visible": false
      }],
      "order" : [ [ 1, "asc" ], [ 5, "asc" ] ],
      "paging": false,
      "scrollCollapse": true,
      "searching": false,
      "rowGroup": aryRowGroup
    });
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#payoutName_"), 1, false);
  },
  postProcessing : function() {
  }
};
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
  if ($(".selected").length > 1) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "locationIds" ], [ "create", "" ]);
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
  $("select[id^='states_']").each(function(index) {
    $(this).prop("disabled", false);
  });
  input.setFormValues(["mode"], ["save" + $("#mode").val()]);
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode", "locationIds" ], [ $("#mode").val(), $("#locationIds").val() ]);
});
$(document).on("click keyup paste", 'input[id^="locationName_"]', function(event) {
  input.validateLength($("#locationName_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("change", 'select[id^="playerId_"]', function(event) {
  input.validateLength($("#playerId_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="address_"]', function(event) {
  input.validateLength($("#address_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="city_"]', function(event) {
  input.validateLetterOnly($(this), event);
  input.validateLength($("#city_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("change", 'select[id^="states_"]', function(event) {
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="zipCode_"]', function(event) {
  input.validateNumberOnly($(this), event, true);
  input.validateLength($(this), 5, true, "You have entered " + $(this).val().length + " of 5 digits for zipCode");
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="phone_"]', function(event) {
  input.validateNumberOnly($(this), event, true);
  input.validateLength($(this), 10, true, "You have entered " + $(this).val().length + " of 10 digits for phone");
  inputLocal.enableSave();
  inputLocal.enableReset();
});
var inputLocal = {
  enableSave : function() {
    var id = $("#locationIds").val();
    if ($("#locationName_" + id).length > 0) {
      // if name, player, address, city, state, zip or phone are empty then disable save button otherwise enable save button
      if (($("#locationName_" + id).val().length == 0) || ($("#playerId_" + id).val() == "") || ($("#address_" + id).val().length == 0)
      || ($("#city_" + id).val().length == 0) || ($("#states_" + id).val() == "") || ($("#zipCode_" + id).val().length < 5) || ($("#phone_" + id).val().length < 10)) {
        $("#save").prop("disabled", true);
      } else {
        $("#save").prop("disabled", false);
      }
    }
  },
  enableReset : function() {
    var id = $("#locationIds").val();
    if ($("#locationName_" + id).length > 0) {
      // if name, player, address, city, state, zip or phone are not empty then enable save button otherwise disable save button
      if (($("#locationName_" + id).val().length != 0) || ($("#playerId_" + id).val() != "") || ($("#address_" + id).val().length != 0)
      || ($("#city_" + id).val().length != 0) || ($("#states_" + id).val() != "MI") || ($("#zipCode_" + id).val().length != 0) || ($("#phone_" + id).val().length != 0)) {
        $("#reset").prop("disabled", false);
      } else {
        $("#reset").prop("disabled", true);
      }
    }
  },
  setLocationIds : function(selectedRows) {
    var locationIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      locationIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    locationIds = locationIds.substring(0, locationIds.length - 2);
    $("#locationIds").val(locationIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").dataTable({
      "autoWidth": false,
      "columns" : [ {
        "width" : "6%"
      },{
        "type" : "locationName",
        "width" : "21%"
      }, {
        "type" : "host",
        "width" : "17%"
      }, {
        "type" : "address",
        "width" : "25%"
      }, {
        "orderable": false,
        "width" : "15%"
      }, {
        "orderable": false,
        "width" : "2%"
      }, {
        "orderable": false,
        "width" : "7%"
      }, {
        "orderable": false,
        "width" : "10%"
      }, {
        "width" : "7%"
      }, null, {
        "searchable": false, "visible": false // needed for hidden table cell for hidden fields
      } ],
      "fixedHeader": true,
      "order" : [ [ 8, "desc" ], [ 2, "asc" ], [ 1, "asc" ] ],
      "paging": false,
      "scrollCollapse": true,
      "searching": false,
      preDrawCallback: function () {
        api = this.api();
        var arr = api.columns(6).data()[0];  //get array of column 6 (zip)
        console.log(arr);
        var sorted = arr.slice().sort(function(a,b){return b-a;});
        var ranks = arr.slice().map(function(v){ return sorted.indexOf(v)+1; });
        //console.log(sorted);
        //console.log(ranks);
        // interate through each row
        api.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
          var data = this.data();
          console.log(data[0], data[6], ranks[arr.indexOf(data[6])]);
          data[9] = ranks[arr.indexOf(data[6])];  //set the rank column = the array index of the zip in the ranked array
        } );
        api.rows().invalidate();
        //var table = $('#dataTbl').DataTable();
        //table.draw();
      }
    });
  },
  setDefaults : function() {
    if ($("#mode").val() == "create") {
      $("#states_").val("MI");
    }
    $("select[id^='states_']").each(function(index) {
      $(this).prop("disabled", true);
    });
  },
  initialValidation : function() {
    input.validateLength($("#locationName_"), 1, false);
    input.validateLength($("#playerId_"), 1, false);
    input.validateLength($("#address_"), 1, false);
    input.validateLength($("#city_"), 1, false);
    input.validateLength($("#zipCode_"), 1, false);
    input.validateLength($("#phone_"), 1, false);
  },
  postProcessing : function() {
//    $("#dataTbl").find("td:nth-child(2)").addClass("highlighted");
//    $("#dataTbl").find("td:nth-child(3)").addClass("highlighted");
  }
};
jQuery.fn.dataTableExt.oSort["locationName-asc"] = function(val1, val2) {
  return display.sort(val1, val2, " - ", "asc");
};
jQuery.fn.dataTableExt.oSort["locationName-desc"] = function(val1, val2) {
  return display.sort(val1, val2, " - ", "desc");
};
jQuery.fn.dataTableExt.oSort["host-asc"] = function(val1, val2) {
  return display.sort(val1, val2, " ", "asc");
};
jQuery.fn.dataTableExt.oSort["host-desc"] = function(val1, val2) {
  return display.sort(val1, val2, " ", "desc");
};
jQuery.fn.dataTableExt.oSort["address-asc"] = function(val1, val2) {
  return display.sort(val1, val2, " ", "asc");
};
jQuery.fn.dataTableExt.oSort["address-desc"] = function(val1, val2) {
  return display.sort(val1, val2, " ", "desc");
};
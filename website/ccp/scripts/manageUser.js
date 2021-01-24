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
  input.setFormValues([ "mode", "userIds" ], [ "create", "" ]);
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
    inputLocal.setUserIds(selectedRows);
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
    inputLocal.setUserIds(selectedRows);
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
	// add username (make sure not already taken), password and email validation
  input.setFormValues(["mode"], ["save" + $("#mode").val()]);
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode", "userIds" ], [ $("#mode").val(), $("#userIds").val() ]);
});
$(document).on("click keyup paste", 'input[id^="firstName_"]', function(event) {
  input.validateLength($("#firstName_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="lastName_"]', function(event) {
  input.validateLength($("#lastName_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="username_"]', function(event) {
  input.validateLength($("#username_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="password_"]', function(event) {
  input.validateLength($("#password_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click keyup paste", 'input[id^="email_"]', function(event) {
  input.validateLength($("#email_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
var inputLocal = {
  enableSave : function() {
    var id = $("#userIds").val();
    if ($("#firstName_" + id).length > 0) {
      // if first name, last name, username or password are empty then disable save button otherwise enable save button
//      if (($("#firstName_" + id).val().length == 0) || ($("#lastName_" + id).val().length == 0) || ($("#username_" + id).val().length == 0) || ($("#mode").val() == "create" && $("#password_" + id).val().length == 0) || ($("#email_" + id).val().length == 0)) {
    	if (($("#firstName_" + id).val().length == 0) || ($("#lastName_" + id).val().length == 0) || ($("#username_" + id).val().length == 0) || ($("#mode").val() == "create" && $("#password_" + id).val().length == 0) || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email_" + id).val()))) {
        $("#save").prop("disabled", true);
      } else {
        $("#save").prop("disabled", false);
      }
    }
  },
  enableReset : function() {
    var id = $("#userIds").val();
    if ($("#firstName_" + id).length > 0) {
      // if first name, last name, username or password are not empty then enable save button otherwise disable save button
    	if (($("#firstName_" + id).val().length != 0) || ($("#lastName_" + id).val().length != 0) || ($("#username_" + id).val().length != 0) || ($("#password_" + id).val().length != 0) || ($("#email_" + id).val().length != 0)) {
        $("#reset").prop("disabled", false);
      } else {
        $("#reset").prop("disabled", true);
      }
    }
  },
  setUserIds : function(selectedRows) {
    var userIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
    	userIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    userIds = userIds.substring(0, userIds.length - 2);
    $("#userIds").val(userIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth" : false,
      "columns" : [{
    	  "orderSequence": [ "desc", "asc" ],
          "width" : "4%"
      }, {
        "type" : "name",
      	"width" : "11%"
      }, {
        "width" : "10%"
      }, {
        "width" : "15%"
      }, {
        "width" : "4%"
      }, {
        "width" : "8%"
      }, {
        "width" : "8%"
      }, {
        "width" : "7%"
      }, {
        "width" : "8%"
      }, {
        "width" : "7%"
      }, {
        "width" : "4%"
      }, {
        "searchable": false,
        "visible": false
      }],
      "order" : [ [ 10, "desc" ], [ 1, "asc" ] ],
      "paging": false,
      "scrollY": "375px",
      "scrollCollapse": true,
      "scrollResize": true,
      "searching": false
    });
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#firstName_"), 1, false);
    input.validateLength($("#lastName_"), 1, false);
    input.validateLength($("#username_"), 1, false);
    input.validateLength($("#password_"), 1, false);
    input.validateLength($("#email_"), 1, false);
  },
  postProcessing : function() {
  	$("#dataTbl tr").each(function(index) {
  		var cell = $(this).find("td:eq(4)"); 
  		cell.addClass(cell.text() == "1" ? "highlight" : "");
  		cell.text(cell.text() == "1" ? "Yes" : "No");
  		cell = $(this).find("td:eq(10)");
  		$(this).addClass(cell.text() == "0" ? "inactive" : "");
  		cell.text(cell.text() == "1" ? "Yes" : "No");
  	});
  }
};
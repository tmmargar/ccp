"use script";
$.fn.setCursorPosition = function(pos) {
  this.each(function(index, elem) {
    if (elem.setSelectionRange) {
      elem.setSelectionRange(pos, pos);
    } else if (elem.createTextRange) {
      var range = elem.createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  });
  return this;
};
$.fn.selectRange = function(start, end) {
    return this.each(function() {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};
// set cursor to end by changing value and then putting back
$(document).on("focus", "form", function(event) {
  const value = $("#" + event.target.id).val();
  $("#" + event.target.id).val("");
  $("#" + event.target.id).val(value);
});
$(document).on("click", "#dataTbl tr", function(event) {
  $("[id^='modify']").prop("disabled", $(this).hasClass("selected"));
  $("[id^='delete']").prop("disabled", $(this).hasClass("selected"));
  const selected = $(this).hasClass("selected");
  // if 1 row is already selected
  if (selected || $("#dataTbl tr.selected").length == 1) {
    $(this).removeClass("selected");
  } else {
    $(this).addClass("selected");
  }
  try {
    inputLocal.tableRowClick(this, selected);
  } catch(error) {
    // ignore function does not exist
    if (!error.message.includes("is not a function")) {
      throw error;
    }
  }
});
$(document).on("click", "[id^='create']", function(event) {
  $("#mode").val(this.value.toLowerCase());
  $("#ids").val("");
});
$(document).on("click", "[id^='modify']", function(event) {
  let result = true;
  try {
    result = inputLocal.modify(this);
  } catch(error) {
    // ignore function does not exist
    if (!error.message.includes("is not a function")) {
      throw error;
    }
  }
  if (result) {
    const selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
    if (selectedRows.length == 0) {
      display.showErrors([ "You must select a row to modify" ]);
      event.preventDefault();
      event.stopPropagation();
    } else if (selectedRows.length > 1) {
      display.showErrors([ "You must select only 1 row to modify" ]);
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#mode").val(this.value.toLowerCase());
      input.setIds(selectedRows);
    }
  } else {
    $("#mode").val(this.value.toLowerCase());
  }
});
$(document).on("click", "[id^='delete']", function(event) {
  let result = true;
  try {
    result = inputLocal.delete(this);
  } catch(error) {
    // ignore function does not exist
    if (!error.message.includes("is not a function")) {
      throw error;
    }
  }
  if (result) {
    const selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
    if (selectedRows.length == 0) {
      display.showErrors([ "You must select a row to delete" ]);
      event.preventDefault();
      event.stopPropagation();
    } else {
      $("#mode").val(this.value.toLowerCase());
      input.setIds(selectedRows);
    }
  } else {
    $("#mode").val(this.value.toLowerCase());
  }
});
$(document).on("click", "[id^='confirmDelete']", function(event) {
  $("#mode").val("confirm");
});
$(document).on("click", "[id^='save']", function(event) {
  let result = true;
  try {
    result = inputLocal.save(event);
  } catch(error) {
    // ignore function does not exist
    if (!error.message.includes("is not a function")) {
      throw error;
    }
  }
  if (result) {
    $("#mode").val("save" + $("#mode").val());
  }
});
$(document).on("click", "[id^='resetButton']", function(event) {
  $("input, select, textarea").each(function(index) {
    $(this).removeClass("errors");
  });
  $("select option").each(function(index) {
    $(this).prop("disabled", false);
  });
  $("#errors").text("");
  $("#messages").text("");
  input.initialize();
  try {
    inputLocal.reset();
  } catch(error) {
    // ignore function does not exist
    if (!error.message.includes("is not a function")) {
      throw error;
    }
  }
  event.preventDefault();
  event.stopPropagation();
  return false;
});
$(document).on("change", "#tournamentId", function(event) {
  input.enableView();
});
$(function() {
  const form = document.getElementById("frmManage");
  //const resetBtn = form.querySelector("button[type=reset]");
  const resetBtn = document.getElementById("resetButton");
  if (null != resetBtn) {
    resetBtn.addEventListener("click", function overrideReset(e) {
        e.preventDefault();
        return new Promise((resolve, reject) => resolve(form.reset())).then(() => {
          try {
            inputLocal.validate();
          } catch(error) {
            // ignore function does not exist
            if (!error.message.includes("is not a function")) {
              throw error;
            }
          }
        });
    });
  }
});
$(document).on("click", "[id^='cancel']", function(event) {
  $("#mode").val("view");
});
/*$(document).on("order.dt", ".dataTable", function(event) {
  const dt = $(this).DataTable();
  console.log(dt.order());
});*/
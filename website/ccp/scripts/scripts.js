"use script";
const firstYear = 2006;
const maskDate = "__/__/____";
const maskDateTime = "__/__/____ __:__";
// set cursor to end by changing value and then putting back
$(document).on("focus", "form", function(event) {
  const value = $("#" + event.target.id).val();
  $("#" + event.target.id).val("");
  $("#" + event.target.id).val(value);
});
$(document).on("click", "#dataTbl tr", function(event) {
  $("#modify").prop("disabled", $(this).hasClass("selected"));
  $("#delete").prop("disabled", $(this).hasClass("selected"));
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
$(document).on("click", "#create", function(event) {
  $("#mode").val(this.value.toLowerCase());
  $("#ids").val("");
});
$(document).on("click", "#modify", function(event) {
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
$(document).on("click", "#delete", function(event) {
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
$(document).on("click", "#confirmDelete", function(event) {
  $("#mode").val("confirm");
});
$(document).on("click", "#save", function(event) {
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
$(document).on("click", "#resetButton", function(event) {
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
$(document).on("click", "#cancel", function(event) {
  $("#mode").val("view");
});
const input = {
  validateNumberOnly : function(jQueryObj, e, storeValue) {
    input.validateCommon(jQueryObj, e, /^-?\d+$/g, null, storeValue);
  },
  validateNumberOnlyGreaterZero : function(jQueryObj, e) {
    input.validateCommon(jQueryObj, e, /^[1-9]\d*$/g);
  },
  validateNumberOnlyLessThanEqualToValue : function(jQueryObj, value, e) {
    input.validateCommon(jQueryObj, e, /^\d+$/g, jQueryObj.val() > value);
  },
  validateCurrencyOnly : function(jQueryObj, e) {
    input.validateCommon(jQueryObj, e, /^\$?\d*$/g);
  },
  validateCurrencyOnlyGreaterZero : function(jQueryObj, e) {
    input.validateCommon(jQueryObj, e, /^\$?[1-9]*\d*$/g);
  },
  validatePercentOnly : function(jQueryObj, e) {
    input.validateCommon(jQueryObj, e, /^[0-9]?[0-9]%?$/g);
  },
  validateLetterOnly : function(jQueryObj, e) {
    input.validateCommon(jQueryObj, e, /^[a-zA-Z]+$/g);
  },
  validateCommon : function(jQueryObj, e, pattern, condition = false, storeValue = true) {
    if ((jQueryObj.val() != "") && (!pattern.test(jQueryObj.val()) || condition)) {
      jQueryObj.val(jQueryObj.data("previousValue"));
      e.preventDefault();
      e.stopPropagation();
    } else {
      if (storeValue) {
        jQueryObj.data("previousValue", jQueryObj.val());
      }
    }
  },
  validateLength : function(jQueryObj, length, focus, msg) {
    let result = "";
    if (jQueryObj.length > 0) {
      if (null == jQueryObj.val() || jQueryObj.val().trim().length < length || maskDate == jQueryObj.val().trim() || maskDateTime == jQueryObj.val().trim()) {
        if (msg) {
          display.showErrors([msg]);
          result = msg;
        }
        jQueryObj.addClass("errors");
        if (focus) {
          jQueryObj.trigger("focus");
        }
      } else {
        display.clearErrorsAndMessages();
        jQueryObj.removeClass("errors");
      }
    }
    return result;
  },
  selectAllToggle : function(inputName, selectAllId) {
    // if at least 1 checkbox and all are checked
    $("#" + selectAllId).prop("checked", ($('input[id^="' + inputName + '"]').length > 0) && ($('input[id^="' + inputName + '"]').length == $('input[id^="' + inputName + '"]:checked').length));
  },
  checkboxToggleAll : function(inputId, checked) {
    // check all inputs starting with same name
    $('input[id^="' + inputId + '"]').prop("checked", checked);
  },
  checkboxToggleSingle : function(inputId, checked) {
    // check all inputs starting with same name
    $("#" + inputId).prop("checked", checked);
  },
  changeState : function(checkId, aryChangeId) {
    const objCheck = $("#" + checkId);
    //for (let index=0; index < aryChangeId.length; index++) {
    for (let changeId of aryChangeId) {
      //const objChange = $("#" + aryChangeId[index]);
      const objChange = $("#" + changeId);
      objChange.prop("disabled", !objCheck.prop("checked"));
      if (!objCheck.checked) {
        objChange.prop("checked", false);
      }
    }
  },
  showDialog : function(name, heightVal, titleVal, positionVal) {
    $("#dialog" + name).dialog({ height: heightVal, modal: true, title: titleVal, position: positionVal });
  },
  showDialogWithWidth : function(name, heightVal, titleVal, widthVal, positionVal) {
    $("#dialog" + name).dialog({ height: heightVal, modal: true, title: titleVal, width: widthVal, position: positionVal });
  },
  ucwords : function(str) {
    return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
      return $1.toUpperCase();
    });
  },
  startsWith : function(data, input) {
    return (data.slice(0, input.length) == input);
  },
  invalid : function(jQueryObj) {
    jQueryObj.addClass("errors");
  },
  toggleCheckboxes : function(id, idAll) {
    let disabled = false;
    // for each checkbox
    $("input[id^='" + id + "_']").each(function(index) {
      // if enabled then set checked state to same as check all checkbox
      if (!$(this).prop("disabled")) {
        $(this).prop("checked", $("#" + idAll + "CheckAll").prop("checked"));
      } else {
        disabled = true;
      }
    });
    // if at least 1 disabled checkbox then uncheck check all checkbox
    if (disabled) {
      $("#" + id + "CheckAll").prop("checked", false);
    }
  },
  toggleCheckAll : function(id, idAll) {
    // if all checkboxes are checked then mark check all checkbox
    $("#" + idAll + "CheckAll").prop("checked", $("input[id^='" + id + "_']:checked").length == $("input[id^='" + id + "_']").length);
  },
  showHideToggle : function(aryId) {
    // does not work for IE 
  	//aryId.forEach(element => {
    Array.prototype.slice.call(aryId).forEach( function(element) {
  		$("#" + element).toggle();
  	});
  },
  selectAllSelectize: function(objId) {
    const selectizes = $("#" + objId).selectize(); // Selectize plugin initialization
    const selectize = selectizes[0].selectize; // Get selectize instance
    selectize.setValue(Object.keys(selectize.options)); // Set all selectize options using setValue() method
    return false;
  },
  deselectAllSelectize : function(objId) {
    const selectizes = $("#" + objId).selectize(); // Selectize plugin initialization
    const selectize = selectizes[0].selectize; // Get selectize instance
    selectize.clear(false);
    //selectize.setValue(-1, false);
    return false;
  },
  countChecked : function(prefix) {
    let count = 0;
    $("input[id^='" + prefix + "_']").each(function(index) {
      if (this.checked) {
        count++;
      }
    });
    if ($("#" + prefix + "CheckAllCount").length == 0) {
      $("#" + prefix + "CheckAll").after("<span id=\"" + prefix + "CheckAllCount\"> (" + count + ")</span>");
    } else {
      $("#" + prefix + "CheckAllCount").text(" (" + count + ")");
    }
  },
  setIds : function(selectedRows) {
    let ids = "";
    for (let selectedRow of selectedRows) {
      ids += inputLocal.setIds(selectedRow) + ", ";
    }
    ids = ids.substring(0, ids.length - 2);
    $("#ids").val(ids);
  },
  enable : function(objId, functionName) {
    if ($("#" + objId).length > 0 &&  $("#ids").length > 0) {
      const aryId = $("#ids").val().split(", ");
      for (let id of aryId) {
        $("#" + objId).prop("disabled", functionName.call(this, id));
      }
    }
  },
  initialize : function(positionFixId) {
    try {
      inputLocal.initializeDataTable();
    } catch(error) {
      // ignore function does not exist
      if (!error.message.includes("is not a function")) {
        throw error;
      }
    }
    try {
      inputLocal.setDefaults();
    } catch(error) {
      // ignore function does not exist
      if (!error.message.includes("is not a function")) {
        throw error;
      }
    }
    try {
      inputLocal.validate();
    } catch(error) {
      // ignore function does not exist
      if (!error.message.includes("is not a function")) {
        throw error;
      }
    }
    try {
      input.enable("save", inputLocal.enableSave);
    } catch(error) {
      // ignore function does not exist
      if (!error.message.includes("is not a function")) {
        throw error;
      }
    }
    try {
      inputLocal.postProcessing();
    } catch(error) {
      // ignore function does not exist
      if (!error.message.includes("is not a function")) {
        throw error;
      }
    }
    if (positionFixId != undefined) {
      try {
        input.cursorPositionFix(positionFixId);
      } catch(error) {
        // ignore function does not exist
        if (!error.message.includes("is not a function")) {
          throw error;
        }
      }
    }
  },
  cursorPositionFix : function(positionFixId) {
    const id = $("#ids").val();
    $("#" + positionFixId + id).setCursorPosition($("#" + positionFixId + id).val().length);
  },
  initializeTimePicker : function(format = "m/d/Y H:i", timePicker = true, disabledWeekDays = [], allowTimes = []) {
    const aryFormatOriginal = format.split(" ");
    let timeFormat = "h:i";
    if (aryFormatOriginal.length > 1) {
      timeFormat = aryFormatOriginal.slice(1).join(" ");
    }
    //$(".timePicker").datetimepicker({allowTimes: allowTimes, disabledWeekDays: disabledWeekDays, format: format, formatDate: aryFormatOriginal[0], formatTime: timeFormat, lazyInit: true, mask: maskDateTime, timepicker: timePicker, validateOnBlur: false, yearStart: firstYear});
    $(".timePicker").datetimepicker({allowTimes: allowTimes, disabledWeekDays: disabledWeekDays, format: format, formatDate: aryFormatOriginal[0], formatTime: timeFormat, lazyInit: true, timepicker: timePicker, validateOnBlur: false, yearStart: firstYear});
  },
  insertSelectedAfter : function(text, objIdSelected, objIdAfter) {
    if ($("#selectedTournamentText").length == 0) {
      $("<p id=\"selectedTournamentText\">" + text + " selected: " + $("#" + objIdSelected + " :selected").text() + "</p>").insertAfter($("#" + objIdAfter));
    }
  },
  toggleCheckAll : function(name) {
    // if all checkboxes are checked then mark check all checkbox
    $("#" + name + "CheckAll").prop("checked", $("input[id^='" + name + "_']:checked").length == $("input[id^='" + name + "_']").length);
  },
  toggleCheckboxes : function(name) {
    $("input[id^='" + name + "_']").each(function(index) {
      // if enabled then set checked state to same as check all checkbox
      if (!$(this).prop("disabled")) {
        $(this).prop("checked", $("#" + name + "CheckAll").prop("checked"));
      }
    });
  },
  enableView : function() {
    $("#view").prop("disabled", $("#tournamentId").val() == -1);
  }
};
const display = {
  showErrors : function(aryErrors) {
    let output = "Errors:<br />";
    //for (let idx = 0; idx < aryErrors.length; idx++) {
    for (let err of aryErrors) {
      //if (idx > 0) {
      if (output.length > 13) {
        output += "<br />";
      }
      //output += aryErrors[idx];
      output += err;
    }
    $("#info").show();
    $("#errors").html(output);
    $("#errors").show();
  },
  showMessages : function(aryMessages) {
    let output = "Messages:<br />";
    //for (let idx = 0; idx < aryMessages.length; idx++) {
    for (let msg of aryMessages) {
      //if (idx > 0) {
      if (output.length > 15) {
        output += "<br />";
      }
      //output += aryMessages[idx];
      output += msg;
    }
    $("#info").show();
    $("#messages").html(output);
    $("#messages").show();
  },
  clearErrorsAndMessages : function() {
    // clear and hide errors and messages
    $("#errors").html("");
    $("#messages").html("");
    $("#errors").hide();
    $("#messages").hide();
    $("#info").hide();
  },
  sort : function(val1, val2, delimiter, direction) {
    const aryVal1 = val1.split(delimiter);
    const aryVal2 = val2.split(delimiter);
    let result = 0;
    if (("asc" == direction) || ("ascending" == direction)) {
      result = (aryVal1[1] < aryVal2[1]) ? -1 : ((aryVal1[1] > aryVal2[1]) ? 1 : 0);
      if (0 == result) {
        result = (aryVal1[0] < aryVal2[0]) ? -1 : ((aryVal1[0] > aryVal2[0]) ? 1 : 0);
      }
    } else {
      result = (aryVal1[1] < aryVal2[1]) ? 1 : ((aryVal1[1] > aryVal2[1]) ? -1 : 0);
      if (0 == result) {
        result = (aryVal1[0] < aryVal2[0]) ? 1 : ((aryVal1[0] > aryVal2[0]) ? -1 : 0);
      }
    }
    return result;
  },
  sortDate : function(val1, val2, direction) {
    let result = 0;
    if (("asc" == direction) || ("ascending" == direction)) {
      result = new Date(val1) - new Date(val2);
    } else {
      result = new Date(val2) - new Date(val1);
    }
    return result;
  },
  sortNumber : function(val1, val2, delimiter, direction) {
    const val1Temp = val1.replace(",", "");
    const val2Temp = val2.replace(",", "");
    const aryVal1 = val1Temp.split(delimiter);
    const aryVal2 = val2Temp.split(delimiter);
    let result = 0;
    if (("asc" == direction) || ("ascending" == direction)) {
      result = (parseFloat(aryVal1[0]) < parseFloat(aryVal2[0])) ? -1 : ((parseFloat(aryVal1[0]) > parseFloat(aryVal2[0])) ? 1 : 0);
    } else {
      result = (parseFloat(aryVal1[0]) < parseFloat(aryVal2[0])) ? 1 : ((parseFloat(aryVal1[0]) > parseFloat(aryVal2[0])) ? -1 : 0);
    }
    return result;
  },
  sortCurrency : function(val1, val2, delimiter, direction) {
    const val1Temp = val1.substring(1, val1.length);
    const val2Temp = val2.substring(1, val2.length);
    return display.sortNumber(val1Temp, val2Temp, delimiter, direction);
  },
  sortPercentage : function(val1, val2, delimiter, direction) {
    const val1Temp = val1.substring(0, val1.length - 1);
    const val2Temp = val2.substring(0, val2.length - 1);
    return display.sortNumber(val1Temp, val2Temp, delimiter, direction);
  },
  formatPhone : function(str) {
    //Filter only numbers from the input
  	cleaned = ('' + str).replace(/\D/g, '');
  	//Check if the input is of correct
  	match = cleaned.match(/^(1|)?(\d{3})(\d{3})(\d{4})$/);
  	if (match) {
  	  //Remove the matched extension code
  	  //Change this to format for any country code.
  	  intlCode = (match[1] ? '+1 ' : '')
  	  return [intlCode, '(', match[2], ') ', match[3], '-', match[4]].join('')
  	}
  	return null;
  }
};
const dataTable = {
  getRowsData : function(objTableApi) {
    return objTableApi.rows().data();
  },
  getSelectedRows : function(objTableJquery) {
    return objTableJquery.$("tr.selected");
  },
  getSelectedRowsData : function(objTableApi) {
    return objTableApi.rows(".selected").data();
  },
  initialize : function(tableId, aryColumns = null, aryOrder = [], searching = true, aryRowGroup = false, scrollY = "300px", autoWidth = false, paging = false, scrollResize = true, scrollCollapse = true) {
    $("#" + tableId).DataTable({ "autoWidth": autoWidth, "columns": aryColumns, "destroy": true, "order": aryOrder, "paging": paging, "rowGroup": aryRowGroup, "scrollY": scrollY, "scrollResize": scrollResize, "scrollCollapse": scrollCollapse, "searching": searching });
  },
  displayActive : function(tableId, index) {
    $("#" + tableId + " tr").each(function(idx) {
      const cell = $(this).find("td").eq(index);
      $(this).addClass(cell.text() == "0" || cell.text() == "N" ? "inactive" : "");
      cell.text(cell.text() == "1" || cell.text() == "Y" ? "Yes" : "No");
    });
  },
  displayHighlight : function(tableId, index) {
    $("#" + tableId + " tr").each(function(idx) {
      const cell = $(this).find("td").eq(index);
      cell.addClass(cell.text() == "1" ? "highlight" : "");
      cell.text(cell.text() == "1" ? "Yes" : "No");
    });
  }
};
$(function() {
  $("#main-menu").smartmenus({ subMenusSubOffsetX: 1, subMenusSubOffsetY: -8 });
});
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
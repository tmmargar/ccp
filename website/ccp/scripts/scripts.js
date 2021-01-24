$(document).on("change", "select[name='dataTbl_length']", function(event) {
  inputLocal.postProcessing();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
  } else {
    $(this).addClass("selected");
  }
});
/*$(document).on("click", "#selectAll", function(event) {
  //var selectizes = $("#user").selectize(); // Selectize plugin initialization
  var selectizes = $(".selectized").selectize(); // Selectize plugin initialization
  var selectize = selectizes[0].selectize; // Get selectize instance
  selectize.setValue(Object.keys(selectize.options)); // Set all selectize options using setValue() method
  event.preventDefault();
  event.stopPropagation();
  return false;
});
$(document).on("click", "#deselectAll", function(event) {
  //var selectizes = $("#user").selectize(); // Selectize plugin initialization
  var selectizes = $(".selectized").selectize(); // Selectize plugin initialization
  var selectize = selectizes[0].selectize; // Get selectize instance
  selectize.clear(false);
  //selectize.setValue(-1, false);
  event.preventDefault();
  event.stopPropagation();
  return false;
});*/
var input = {
  validateNumberOnly : function(jQueryObj, e, storeValue) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^\d+$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      if (storeValue) {
        // store value
        jQueryObj.data("previousValue", jQueryObj.val());
      }
    }
  },
  validateNumberOnlyGreaterZero : function(jQueryObj, e) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^[1-9]\d*$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validateNumberOnlyLessThanEqualToValue : function(jQueryObj, value, e) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^\d+$/g;
    // if not blank and (not a digit or greater than/equal to value provided)
    if ((jQueryObj.val() != "") && (!pattern.test(jQueryObj.val()) || (jQueryObj.val() > value))) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validateCurrencyOnly : function(jQueryObj, e) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^-?\$?\d*$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validateCurrencyOnlyGreaterZero : function(jQueryObj, e) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^\$?[1-9][0-9]*$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validatePercentOnly : function(jQueryObj, e) {
    // regular expression to only contain digits (^ means start and $ means end)
    var pattern = /^[0-9]?[0-9]%?$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validateLetterOnly : function(jQueryObj, e) {
    // regular expression to only contain letters (^ means start and $ means
    // end)
    var pattern = /^[a-zA-Z ]+$/g;
    // if not blank and not a digit
    if ((jQueryObj.val() != "") && !pattern.test(jQueryObj.val())) {
      // restore previous value
      jQueryObj.val(jQueryObj.data("previousValue"));
      // prevent default behavior
      e.preventDefault();
      // stop event propagation
      e.stopPropagation();
    } else {
      // store value
      jQueryObj.data("previousValue", jQueryObj.val());
    }
  },
  validateLength : function(jQueryObj, length, focus, msg) {
    var result = "";
    if (jQueryObj.length > 0) {
      if ($.trim(jQueryObj.val()).length < length) {
        if (msg) {
          display.showErrors([msg]);
          result = msg;
        }
        jQueryObj.addClass("errors");
        if (focus) {
          jQueryObj.focus();
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
    if (($('input[id^="' + inputName + '"]').length > 0) && ($('input[id^="' + inputName + '"]').length == $('input[id^="' + inputName + '"]:checked').length)) {
      // check select all
      $("#" + selectAllId).prop("checked", true);
    } else {
      // uncheck select all
      $("#" + selectAllId).prop("checked", false);
    }
  },
  checkboxToggleAll : function(inputId, checked) {
    // check all inputs starting with same name
    $('input[id^="' + inputId + '"]').prop("checked", checked);
  },
  checkboxToggleSingle : function(inputId, checked) {
    // check all inputs starting with same name
    $("#" + inputId).prop("checked", checked);
  },
  setFormValues : function(aryName, aryValue) {
    if (aryName) {
      for (var x = 0; x < aryName.length; x++) {
        var obj = $("#" + aryName[x]);
        if (obj.length > 0) {
          if ("checkbox" == obj.attr("type")) {
            obj.prop("checked", aryValue[x]);
          } else {
            obj.val(aryValue[x]);
          }
        }
      }
    }
  },
  changeState : function(checkId, aryChangeId) {
    for (var index=0; index < aryChangeId.length; index++) {
      var objCheck = $("#" + checkId);
      var objChange = $("#" + aryChangeId[index]);
      if (objCheck.prop("checked")) {
        objChange.prop("disabled", false);
      } else {
        objChange.prop("disabled", true);
      }
      if (!objCheck.checked) {
        objChange.prop("checked", false);
      }
    }
  },
  getQueryStringIndexed : function() {
    var result = [];
    var queryString = document.URL.split('?')[1];
    if (queryString != undefined) {
      queryString = queryString.split('&');
      for (var i=0; i < queryString.length; i++) {
          var hash = queryString[i].split('=');
          result.push(hash[1]);
          result[i] = [i, hash[1]];
      }
    }
    return result;
  },
  getQueryStringNamed : function() {
    var result = [];
    var queryString = document.URL.split('?')[1];
    if (queryString != undefined) {
      queryString = queryString.split('&');
      for (var i=0; i < queryString.length; i++) {
          var hash = queryString[i].split('=');
          result.push(hash[1]);
          result[i] = [hash[0], hash[1]];
      }
    }
    return result;
  },
  buildQueryStringNamed : function() {
    var result = [];
    var queryString = input.getQueryStringNamed();
    for (var i=0; i < queryString.length; i++) {
        result[i] = queryString[i].join("=");
    }
    return result;
  },
  showDialog : function(name, heightVal, titleVal, positionVal) {
    $("#dialog" + name).dialog({ height: heightVal, modal: true, title: titleVal, position: positionVal });
  },
  showDialogWithWidth : function(name, heightVal, titleVal, widthVal, positionVal) {
    $("#dialog" + name).dialog({ height: heightVal, modal: true, title: titleVal, width: widthVal, position: positionVal });
//    $("#dialog" + name).dialog({ height: heightVal, modal: true, title: titleVal, width: widthVal});
  },
  ucwords : function(str) {
    return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
      return $1.toUpperCase();
    });
  },
  startsWith : function(data, input) {
    //return (data.substring(0, input.length) === input);
    return (data.slice(0, input.length) == input);
  },
  invalid : function(jQueryObj) {
    jQueryObj.addClass("errors");
  },
  toggleCheckboxes : function(id, idAll) {
    var disabled = false;
    // for each checkbox
    $("input[id^='" + id + "_']").each(function(index) {
      // if enabled then set checked state to same as check all checkbox
      if (!$(this).prop("disabled")) {
        var checked = $("#" + idAll + "CheckAll").prop("checked");
        $(this).prop("checked", checked);
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
    if ($("input[id^='" + id + "_']:checked").length == $("input[id^='" + id + "_']").length) {
      $("#" + idAll + "CheckAll").prop("checked", true);
    } else {
      $("#" + idAll + "CheckAll").prop("checked", false);
    }
  },
  showHideToggle : function(aryId) {
    // does not work for IE 
  	//aryId.forEach(element => {
    Array.prototype.slice.call(aryId).forEach( function(element) {
  		$("#" + element).toggle();
  	});
  },
  selectAllSelectize: function(objId) {
    var selectizes = $("#" + objId).selectize(); // Selectize plugin initialization
    var selectize = selectizes[0].selectize; // Get selectize instance
    selectize.setValue(Object.keys(selectize.options)); // Set all selectize options using setValue() method
    event.preventDefault();
    event.stopPropagation();
    return false;
  },
  deselectAllSelectize : function(objId) {
    var selectizes = $("#" + objId).selectize(); // Selectize plugin initialization
    var selectize = selectizes[0].selectize; // Get selectize instance
    selectize.clear(false);
    //selectize.setValue(-1, false);
    event.preventDefault();
    event.stopPropagation();
    return false;
  },
  countChecked : function(prefix) {
    var count = 0;
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
  }
};
var display = {
    showErrorsPersist : function(aryErrors) {
      var output = "Errors:<br />";
      for ( var idx = 0; idx < aryErrors.length; idx++) {
        if (idx > 0) {
          output += "<br />";
        }
        output += aryErrors[idx];
      }
      $("#infoPersist").show();
      $("#errorsPersist").html(output);
      $("#errorsPersist").show();
    },
    showErrors : function(aryErrors) {
      var output = "Errors:<br />";
      for ( var idx = 0; idx < aryErrors.length; idx++) {
        if (idx > 0) {
          output += "<br />";
        }
        output += aryErrors[idx];
      }
      $("#info").show();
      $("#errors").html(output);
      $("#errors").show();
    },
    showMessages : function(aryMessages) {
      var output = "Messages:<br />";
      for ( var idx = 0; idx < aryMessages.length; idx++) {
        output += aryMessages[idx];
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
      var aryVal1 = val1.split(delimiter);
      var aryVal2 = val2.split(delimiter);
      var result = 0;
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
      var result = 0;
      if (("asc" == direction) || ("ascending" == direction)) {
        result = new Date(val1) - new Date(val2);
      } else {
        result = new Date(val2) - new Date(val1);
      }
      return result;
    },
    sortNumber : function(val1, val2, delimiter, direction) {
      var val1Temp = val1.replace(",", "");
      var val2Temp = val2.replace(",", "");
      var aryVal1 = val1Temp.split(delimiter);
      var aryVal2 = val2Temp.split(delimiter);
      var result = 0;
      if (("asc" == direction) || ("ascending" == direction)) {
        result = (parseFloat(aryVal1[0]) < parseFloat(aryVal2[0])) ? -1 : ((parseFloat(aryVal1[0]) > parseFloat(aryVal2[0])) ? 1 : 0);
      } else {
        result = (parseFloat(aryVal1[0]) < parseFloat(aryVal2[0])) ? 1 : ((parseFloat(aryVal1[0]) > parseFloat(aryVal2[0])) ? -1 : 0);
      }
      return result;
    },
    sortCurrency : function(val1, val2, delimiter, direction) {
      var val1Temp = val1.substring(1, val1.length);
      var val2Temp = val2.substring(1, val2.length);
      return display.sortNumber(val1Temp, val2Temp, delimiter, direction);
    },
    sortPercentage : function(val1, val2, delimiter, direction) {
      var val1Temp = val1.substring(0, val1.length - 1);
      var val2Temp = val2.substring(0, val2.length - 1);
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
var dataTable = {
  getSelectedRows : function(objTable) {
    var aReturn = new Array();
    var aTrs = objTable.fnGetNodes();
    for (var i = 0; i < aTrs.length; i++) {
      if ($(aTrs[i]).hasClass("selected")) {
        aReturn.push(aTrs[i]);
      }
    }
    return aReturn;
  }
};
if ($.fn.dataTableExt !== undefined) {
  jQuery.fn.dataTableExt.oSort["name-asc"] = function(val1, val2) {
    return display.sort(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["name-desc"] = function(val1, val2) {
    return display.sort(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["number-asc"] = function(val1, val2) {
    return display.sortNumber(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["number-desc"] = function(val1, val2) {
    return display.sortNumber(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["currency-asc"] = function(val1, val2) {
    return display.sortCurrency(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["currency-desc"] = function(val1, val2) {
    return display.sortCurrency(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["percentage-asc"] = function(val1, val2) {
    return display.sortPercentage(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["percentage-desc"] = function(val1, val2) {
    return display.sortPercentage(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["date-asc"]  = function(val1, val2) {
    return display.sortDate(val1, val2, "asc");
  };
  jQuery.fn.dataTableExt.oSort["date-desc"] = function(val1, val2) {
    return display.sortDate(val1, val2, "desc");
  };
  jQuery.fn.dataTableExt.oSort["time-asc"]  = function(val1, val2) {
    return display.sort(val1, val2, ":", "asc");
  };
  jQuery.fn.dataTableExt.oSort["time-desc"] = function(val1, val2) {
    return display.sort(val1, val2, ":", "desc");
  };
}
$.extend({
  getQueryString: function() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getQueryStringByName: function(name) {
    return $.getQueryString()[name];
  }
});
/*Selectize.define('set_all', function(options) {
  let self = this;
  this.setup = (function(e) {
    const original = self.setup;
    return function(e) {
      original.apply(this, arguments);
      var html = 
        "Ctrl + shift + a to select all<br>\n" +
        "Ctrl + shift + d to de-select all<br>\n" +
        "<a href=\"javascript:void(0);\" id=\"selectAll\">Select all</a>\n" +
        "<a href=\"javascript:void(0);\" id=\"deselectAll\">De-select all</a>\n";
      $("#" + options.id).before(html);
      //$(this).before(html);
    };
  })();
  this.onKeyUp = (function(e) {
    const original = self.onKeyUp;
    return function(e) {
      original.apply(this, arguments);
      const code = e.originalEvent.code;
      if (!(e.ctrlKey == true && e.shiftKey == true && (code == "KeyA" || code == "KeyD"))) {
        return;
      }
      if (code == "KeyA") {
        self.setValue(Object.keys(self.options)); // Set all selectize options using setValue() method
        self.focus();
      } else {
        self.clear();
      }
    };
  })();
  this.onChange = (function(e) {
	const original = self.onChange;
    return function(e) {
      original.apply(this, arguments);
      // accessing items on selectize submits form so cannot use
      if (Object.keys($("#" + options.id).selectize()[0].selectize.options).length == $("#" + options.id).selectize()[0].selectize.items.length) { // if not all selected
        //$("#selectAll").text("De-select all");
        $("#selectAll").hide();
        $("#deselectAll").show();
      } else {
        //$("#selectAll").text("Select all");
    	if ($("#" + options.id).selectize()[0].selectize.items.length == 0) {
          $("#deselectAll").hide();
    	}
        $("#selectAll").show();
      }
      if ($("#" + options.id).selectize()[0].selectize.items.length > 0) {
        $(".selectize-input").removeClass("errors");
      } else {
        $(".selectize-input").addClass("errors");
      }
    }
  })();
});*/
/*(function($) {
  $.fn.listenForChange = function(options) {
    settings = $.extend({
      interval: 200 // in microseconds
    }, options);
    var jquery_object = this;
    var current_focus = null;
    jquery_object.filter(":input").add(":input", jquery_object).focus( function() {current_focus = this;}).blur( function() {current_focus = null;});
    setInterval(function() {
      // allow
      jquery_object.filter(":input").add(":input", jquery_object).each(function() {
        // set data cache on element to input value if not yet set
        if ($(this).data('change_listener') == undefined) {
          $(this).data('change_listener', $(this).val());
          return;
        }
        // return if the value matches the cache
        if ($(this).data('change_listener') == $(this).val()) {
          return;
        }
        // ignore if element is in focus (since change event will fire on blur)
        if (this == current_focus) {
          return;
        }
        // if we make it here, manually fire the change event and set the new value
        $(this).trigger('change');
        $(this).data('change_listener', $(this).val());
      });
    }, settings.interval);
    return this;
  };
})(jQuery);*/
$(function() {
  $("#main-menu").smartmenus({
    subMenusSubOffsetX: 1,
    subMenusSubOffsetY: -8
  });
});
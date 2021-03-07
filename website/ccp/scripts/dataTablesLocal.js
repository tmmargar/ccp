"use script";
if ($.fn.dataTableExt !== undefined) {
  jQuery.fn.dataTableExt.oSort["address-asc"] = function(val1, val2) {
    return display.sort(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["address-desc"] = function(val1, val2) {
    return display.sort(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["currency-asc"] = function(val1, val2) {
    return display.sortCurrency(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["currency-desc"] = function(val1, val2) {
    return display.sortCurrency(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["date-asc"]  = function(val1, val2) {
    return display.sortDate(val1, val2, "asc");
  };
  jQuery.fn.dataTableExt.oSort["date-desc"] = function(val1, val2) {
    return display.sortDate(val1, val2, "desc");
  };
  jQuery.fn.dataTableExt.oSort["host-asc"] = function(val1, val2) {
    const pos1 = val1.indexOf(">");
    const value1 = val1.substring(pos1 + 1, val1.indexOf("<", pos1));
    const pos2 = val2.indexOf(">");
    const value2 = val2.substring(pos2 + 1, val2.indexOf("<", pos2));
    return display.sort(value1, value2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["host-desc"] = function(val1, val2) {
    const pos1 = val1.indexOf(">");
    const value1 = val1.substring(pos1 + 1, val1.indexOf("<", pos1));
    const pos2 = val2.indexOf(">");
    const value2 = val2.substring(pos2 + 1, val2.indexOf("<", pos2));
    return display.sort(value1, value2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["locationName-asc"] = function(val1, val2) {
    return display.sort(val1, val2, " - ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["locationName-desc"] = function(val1, val2) {
    return display.sort(val1, val2, " - ", "desc");
  };
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
  jQuery.fn.dataTableExt.oSort["percentage-asc"] = function(val1, val2) {
    return display.sortPercentage(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["percentage-desc"] = function(val1, val2) {
    return display.sortPercentage(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["registerOrder-asc"]  = function(val1, val2) {
    return display.sortNumber(val1, val2, " ", "asc");
  };
  jQuery.fn.dataTableExt.oSort["registerOrder-desc"] = function(val1, val2) {
    return display.sortNumber(val1, val2, " ", "desc");
  };
  jQuery.fn.dataTableExt.oSort["time-asc"]  = function(val1, val2) {
    return display.sort(val1, val2, ":", "asc");
  };
  jQuery.fn.dataTableExt.oSort["time-desc"] = function(val1, val2) {
    return display.sort(val1, val2, ":", "desc");
  };
}
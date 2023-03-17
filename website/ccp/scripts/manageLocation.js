"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  buildName : function(id) {
    const objPlayer = document.querySelector("#playerId_" + id);
    document.querySelector("#locationName_" + id).value = objPlayer.options[objPlayer.selectedIndex].innerText + " - " + document.querySelector("#city_" + id).value;
  },
  enableSave : function(id) {
    return (document.querySelector("#locationName_" + id).value.length == 0) || (document.querySelector("#playerId_" + id).value == "") || (document.querySelector("#address_" + id).value.length == 0) || (document.querySelector("#city_" + id).value.length == 0) || (document.querySelector("#states_" + id).value == "") || (document.querySelector("#zipCode_" + id).value.length < 5);
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{"orderSequence": [ "desc", "asc" ], "width" : "2%" }, { "width" : "19%" }, { "type" : "host", "width" : "15%" }, { "searchable": false, "width" : "21%" }, { "searchable": false, "width" : "11%" }, { "searchable": false, "width" : "5%" }, { "searchable": false, "width" : "4%" }, { "render" : function (data, type, row, meta) { return display.formatActive({value: data, meta: meta, tableId: "dataTbl"}); },  "width" : "7%" }, { "width" : "7%" }, { "searchable": false, "visible": false }], aryOrder: [[7, "desc"], [2, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: false });
  },
  save : function(event) {
    document.querySelectorAll("[id^='states_']")?.forEach(obj => { obj.disabled = false; });
    return true;
  },
  setDefaults : function() {
    if (document.querySelector("#mode").value == "create") {
      document.querySelector("#states_").value = "MI";
    }
    document.querySelectorAll("[id^='states_']")?.forEach(obj => { obj.disabled = true; });
  },
  setId : function(selectedRow) {
    return selectedRow.children[0].innerHTML;
  },
  setIds : function() {
    const selectedRows = dataTable.getSelectedRows({jQueryTable: $("#dataTbl").dataTable()});
    let ids = "";
    for (let selectedRow of selectedRows) {
      ids += inputLocal.setId(selectedRow) + ", ";
    }
    ids = ids.substring(0, ids.length - 2);
    document.querySelector("#ids").value = ids;
  },
  tableRowClick : function(row) {
    document.querySelectorAll("[id^='delete']")?.forEach(obj => { obj.disabled = !(row.querySelector("td:nth-of-type(9)").innerText == 0); });
  },
  validate : function() {
    input.validateLength({obj: document.querySelector("#locationName_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#playerId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#address_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#city_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#zipCode_"), length: 1, focus: false});
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  document.querySelector("[id^='playerId_']")?.focus();
  input.storePreviousValue({selectors: ["[id^='locationName_']", "[id^='playerId_']", "[id^='address_']", "[id^='city_']", "[id^='states_']", "[id^='zipCode']", "[id^='active']"]});
};
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.querySelectorAll("#dataTbl tbody tr")?.forEach(row => row.addEventListener("click", (event) => {
  const selected = row.classList.contains("selected");
  document.querySelectorAll("[id^='modify']")?.forEach(btn => { btn.disabled = selected; });
  document.querySelectorAll("[id^='delete']")?.forEach(btn => { btn.disabled = selected; });
  // if 1 row is already selected
  if (selected || document.querySelectorAll("#dataTbl tbody tr.selected").length == 1) {
    row.classList.remove("selected");
  } else {
    row.classList.add("selected");
  }
  inputLocal.tableRowClick(row, selected);
}));
document.addEventListener("change", (event) => {
  if (event.target && event.target.id.includes("states")) {
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("click", (event) => {
  if (event.target && (event.target.id.includes("locationName") || event.target.id.includes("playerId") || event.target.id.includes("address"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("city")) {
    input.validateLetterOnly({obj: event.target, event: event});
    input.validateLength({obj: document.querySelector("#city_"), length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("zipCode")) {
    // add check to prevent 5 zeroes and handle leading zeroes
    input.validateNumberOnly({obj: event.target, event: event, storeValue: true});
    input.validateLength({obj: event.target, length: 5, focus: true, msg: "You have entered " + event.target.value.length + " of 5 digits for zipCode"});
    if (result == "") {
      display.clearErrorsAndMessages();
    }
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("active")) {
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='locationName_']", "[id^='playerId_']", "[id^='address_']", "[id^='city_']", "[id^='states_']", "[id^='zipCode']", "[id^='active']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id.includes("locationName") || event.target.id.includes("playerId") || event.target.id.includes("address"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("city")) {
    input.validateLetterOnly({obj: event.target, event: event});
    input.validateLength({obj: document.querySelector("#city_"), length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("zipCode")) {
    // add check to prevent 5 zeroes and handle leading zeroes
    input.validateNumberOnly({obj: event.target, event: event, storeValue: true});
    input.validateLength({obj: event.target, length: 5, focus: true, msg: "You have entered " + event.target.value.length + " of 5 digits for zipCode"});
    if (result == "") {
      display.clearErrorsAndMessages();
    }
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && (event.target.id.includes("locationName") || event.target.id.includes("playerId") || event.target.id.includes("address"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("city")) {
    input.validateLetterOnly({obj: event.target, event: event});
    input.validateLength({obj: document.querySelector("#city_"), length: 1, focus: false});
    inputLocal.buildName(document.querySelector("#ids").value.split(", ")[0]);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("zipCode")) {
    // add check to prevent 5 zeroes and handle leading zeroes
    input.validateNumberOnly({obj: event.target, event: event, storeValue: true});
    input.validateLength({obj: event.target, length: 5, focus: true, msg: "You have entered " + event.target.value.length + " of 5 digits for zipCode"});
    if (result == "") {
      display.clearErrorsAndMessages();
    }
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
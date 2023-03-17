"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableSave : function(id) {
    return document.querySelector("#groupName_" + id).value.length == 0;
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width" : "30%" }, { "width" : "70%" }, { "searchable": false, "visible": false }], aryOrder: [[ 1, "asc" ]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
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
  validate : function() {
    input.validateLength({obj: document.querySelector("#groupName_"), length: 1, focus: false});
  },
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='groupName']"]});
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
}));
document.addEventListener("click", (event) => {
  if (event.target && event.target.id.includes("groupName")) {
    input.validateLength(event.target, 1, false);
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='groupName']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && event.target.id.includes("groupName")) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && event.target.id.includes("groupName")) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
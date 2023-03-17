"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableSave : function(id) {
    return document.querySelector("#specialTypeDescription_" + id).value == "";
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width": "20%" }, { "width": "80%" }, { "orderable": false, "visible": false }], aryOrder: [[ 1, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: false });
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
    input.validateLength({obj: document.querySelector("#specialTypeDescription_"), length: 1, focus: false});
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='specialTypeDescription_']"]});
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
  if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='specialTypeDescription_']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id.includes("specialTypeDescription") || event.target.id.includes("specialTypeStartDate") || event.target.id.includes("specialTypeEndDate"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && (event.target.id.includes("specialTypeDescription") || event.target.id.includes("specialTypeStartDate") || event.target.id.includes("specialTypeEndDate"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
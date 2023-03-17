"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableSave : function(id) {
    const idTemp = id.split("::")[0];
    return document.querySelector("#groupId_" + idTemp).value.length == 0 || document.querySelector("#payoutId_" + idTemp).value.length == 0;
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width" : "15%", "visible": false }, { "width" : "50%" }, { "orderSequence": [ "desc", "asc" ], "width" : "15%", "visible": false }, { "width" : "50%" }, { "searchable": false, "visible": false }], aryOrder: [[1, "asc"], [3, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
  },
  setId : function(selectedRow) {
    //return selectedRow.children[0].innerHTML;
    const htmlGroup = selectedRow.children[0].innerHTML;
    let positionStart = htmlGroup.indexOf("groupId=");
    const groupId = htmlGroup.substring(positionStart + 8, htmlGroup.indexOf("&", positionStart));
    const htmlPayout = selectedRow.children[1].innerHTML;
    positionStart = htmlPayout.indexOf("payoutId=");
    const payoutId = htmlPayout.substring(positionStart + 9, htmlPayout.indexOf("&", positionStart));
    return groupId + "::" + payoutId;
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
    input.validateLength({obj: document.querySelector("#groupId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#payoutId_"), length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='payoutId_'], [id^='groupId']"]});
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
document.addEventListener("change", (event) => {
  if (event.target && (event.target.id.includes("groupId") || event.target.id.includes("payoutId"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("click", (event) => {
  if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='payoutId_'], [id^='groupId_']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
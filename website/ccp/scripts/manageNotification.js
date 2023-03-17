"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableSave : function(id) {
    return ((document.querySelector("#notificationDescription_" + id).value == "") || !input.compareDate({date1: document.querySelector("[id^='notificationStartDate_']").value, date2: document.querySelector("[id^='notificationEndDate_']").value}));
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width": "10%" }, { "width": "50%" }, { "type": "date", "width": "20%" }, { "type": "date", "width": "20%" }, { "orderable": false, "visible": false }], aryOrder: [[3, "desc"], [2, "desc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
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
  setMinMax : function() {
    if (document.querySelector("[id^='notificationStartDate_']")) {
      if (document.querySelector("[id^='notificationEndDate_']:valid")) {
        document.querySelector("[id^='notificationStartDate_']").max = document.querySelector("[id^='notificationEndDate_']").value;
      } else {
        document.querySelector("[id^='notificationStartDate_']").removeAttribute("max");
      }
    }
    if (document.querySelector("[id^='notificationEndDate_']")) {
      if (document.querySelector("[id^='notificationStartDate_']:valid")) {
        document.querySelector("[id^='notificationEndDate_']").min = document.querySelector("[id^='notificationStartDate_']").value;
      } else {
        document.querySelector("[id^='notificationEndDate_']").removeAttribute("min");
      }
    }
  },
  setWidth : function() {
    if (document.querySelector("[id^='notificationStartDate_']")) {
      document.querySelector("[id^='notificationStartDate_']").style.width = "175px";
    }
    if (document.querySelector("[id^='notificationEndDate_']")) {
      document.querySelector("[id^='notificationEndDate_']").style.width = "175px";
    }
  },
  validateField : function(obj) {
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.validateField(document.querySelector("#notificationDescription_"));
  inputLocal.setMinMax();
  inputLocal.setWidth();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='notificationDescription_']", "[id^='notificationStartDate_']", "[id^='notificationEndDate_']"]});
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
    input.restorePreviousValue({selectors: ["[id^='notificationDescription_']", "[id^='notificationStartDate_']", "[id^='notificationEndDate_']"]});
    inputLocal.validateField(document.querySelector("#notificationDescription_"));
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("input", (event) => {
  if (event.target && event.target.classList.contains("timePicker")) {
    input.enable({objId: "save", functionName: inputLocal.enableSave});
    inputLocal.setMinMax();
  }
});
document.addEventListener("keyup", (event) => { if (event.target && event.target.id.includes("notificationDescription")) { inputLocal.validateField(event.target); } });
document.addEventListener("paste", (event) => { if (event.target && event.target.id.includes("notificationDescription")) { inputLocal.validateField(event.target); } });
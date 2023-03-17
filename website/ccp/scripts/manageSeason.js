"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableSave : function(id) {
    return ((document.querySelector("#seasonDescription_" + id).value == "") || (document.querySelector("#seasonChampionshipQualify_" + id).value <= 0) || !input.compareDate({date1: document.querySelector("[id^='seasonStartDate_']").value, date2: document.querySelector("[id^='seasonEndDate_']").value}));
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width": "5%" }, { "width": "25%" }, { "type": "date", "width": "20%" }, { "type": "date", "width": "20%" }, { "width": "20%" }, {"render" : function (data, type, row, meta) { return display.formatActive({value: data, meta: meta, tableId: "dataTbl"}); },  "width": "10%" }, { "orderable": false, "visible": false }], aryOrder: [[5, "desc"], [2, "desc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
  },
  setDefaultsLoad : function() {
    if ("create" == document.querySelector("#mode").value) {
      document.querySelector("[id^='seasonStartDate_']").value = (new Date().getFullYear() + 1) + "-01-01T00:00";
      document.querySelector("[id^='seasonEndDate_']").value = (new Date().getFullYear() + 1) + "-12-31T23:59";
      document.querySelector("#seasonChampionshipQualify_").value = 8;
    }
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
    if (document.querySelector("[id^='seasonStartDate_']")) {
      if (document.querySelector("[id^='seasonEndDate_']:valid")) {
        document.querySelector("[id^='seasonStartDate_']").max = document.querySelector("[id^='seasonEndDate_']").value;
      } else {
        document.querySelector("[id^='seasonStartDate_']").removeAttribute("max");
      }
    }
    if (document.querySelector("[id^='seasonEndDate_']")) {
      if (document.querySelector("[id^='seasonStartDate_']:valid")) {
        document.querySelector("[id^='seasonEndDate_']").min = document.querySelector("[id^='seasonStartDate_']").value;
      } else {
        document.querySelector("[id^='seasonEndDate_']").removeAttribute("min");
      }
    }
  },
  setWidth : function() {
    if (document.querySelector("[id^='seasonStartDate_']")) {
      document.querySelector("[id^='seasonStartDate_']").style.width = "175px";
    }
    if (document.querySelector("[id^='seasonEndDate_']")) {
      document.querySelector("[id^='seasonEndDate_']").style.width = "175px";
    }
  },
  validate : function() {
    input.validateLength({obj: document.querySelector("#seasonDescription_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#seasonStartDate_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#seasonEndDate_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#seasonChampionshipQualify_"), length: 1, focus: false});
  },
  validateField : function(obj) {
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  },
  validateFieldNumber : function(obj, event) {
    input.validateNumberOnlyGreaterZero({obj: obj, event: event, condition: true, storeValue: true});
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.setDefaultsLoad();
  inputLocal.validate();
  inputLocal.setMinMax();
  inputLocal.setWidth();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='seasonDescription_']", "[id^='seasonStartDate_']", "[id^='seasonEndDate_']", "[id^='seasonChampionshipQualify_']"]});
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
    input.restorePreviousValue({selectors: ["[id^='seasonDescription_']", "[id^='seasonStartDate_']", "[id^='seasonEndDate_']", "[id^='seasonChampionshipQualify_']"]});
    inputLocal.validate();
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
document.addEventListener("keyup", (event) => {
  if (event.target && event.target.id.includes("seasonDescription")) {
    inputLocal.validateField(event.target);
  } else if (event.target && event.target.id.includes("seasonChampionshipQualify")) {
    inputLocal.validateFieldNumber(event.target, event);
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && event.target.id.includes("seasonDescription")) {
    inputLocal.validateField(event.target);
  } else if (event.target && event.target.id.includes("seasonChampionshipQualify")) {
    inputLocal.validateFieldNumber(event.target, event);
  }
});
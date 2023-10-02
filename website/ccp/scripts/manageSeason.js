"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width": "5%" }, { "width": "25%" }, { "type": "date", "width": "20%" }, { "type": "date", "width": "20%" }, { "width": "20%" }, { "width": "5%" }, {"render" : function (data, type, row, meta) { return display.formatActive({value: data, meta: meta, tableId: "dataTbl"}); },  "width": "5%" }, { "orderable": false, "visible": false }], aryOrder: [[6, "desc"], [2, "desc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
  },
  setDefaultsLoad : function() {
    if ("create" == document.querySelector("#mode").value || "modify" == document.querySelector("#mode").value) {
      document.querySelector("[id^='seasonChampionshipQualify_']").min = 1;
      document.querySelector("[id^='seasonFee_']").min = 1;
    }
    if ("create" == document.querySelector("#mode").value) {
      document.querySelector("[id^='seasonStartDate_']").value = (new Date().getFullYear() + 1) + "-01-01T00:00";
      document.querySelector("[id^='seasonEndDate_']").value = (new Date().getFullYear() + 1) + "-12-31T23:59";
      document.querySelector("#seasonChampionshipQualify_").value = 8;
      document.querySelector("#seasonFee_").value = 30;
    }
  },
  setId : function({selectedRow} = {}) {
    return selectedRow.children[0].innerHTML;
  },
  setIds : function() {
    const selectedRows = dataTable.getSelectedRows({jQueryTable: $("#dataTbl").dataTable()});
    let ids = "";
    for (let selectedRow of selectedRows) {
      ids += inputLocal.setId({selectedRow: selectedRow}) + ", ";
    }
    ids = ids.substring(0, ids.length - 2);
    document.querySelector("#ids").value = ids;
  },
  setMinMax : function() {
    if (document.querySelector("[id^='seasonChampionshipQualify_']")) {
      document.querySelector("[id^='seasonChampionshipQualify_']").max = 99;
    }
    if (document.querySelector("[id^='seasonStartDate_']")) {
      if (document.querySelector("[id^='seasonEndDate_']:valid")) {
        document.querySelector("[id^='seasonStartDate_']").max = input.formatDate({value: document.querySelector("[id^='seasonEndDate_']").value, field: "minutes", operation: "-", amount: 1});
      } else {
        document.querySelector("[id^='seasonStartDate_']").removeAttribute("max");
      }
    }
    if (document.querySelector("[id^='seasonEndDate_']")) {
      if (document.querySelector("[id^='seasonStartDate_']:valid")) {
        document.querySelector("[id^='seasonEndDate_']").min = input.formatDate({value: document.querySelector("[id^='seasonStartDate_']").value, field: "minutes", operation: "+", amount: 1});
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
    const description = document.querySelectorAll("[id^='seasonDescription_']");
    const startDate = document.querySelectorAll("[id^='seasonStartDate_']");
    const endDate = document.querySelectorAll("[id^='seasonEndDate_']");
    const championshipQualify = document.querySelectorAll("[id^='seasonChampionshipQualify_']");
    const fee = document.querySelectorAll("[id^='seasonFee_']");
    if (description.length > 0) {
      description[0].setCustomValidity(description[0].validity.valueMissing ? "You must enter a description" : "");
      startDate[0].setCustomValidity(startDate[0].validity.valueMissing ? "You must enter a valid start date" : startDate[0].validity.rangeOverflow ? "You must enter a start date before the end date" : "");
      endDate[0].setCustomValidity(endDate[0].validity.valueMissing ? "You must enter a valid end date" : endDate[0].validity.rangeUnderflow ? "You must enter an end date after the start date" : "");
      championshipQualify[0].setCustomValidity(championshipQualify[0].validity.valueMissing ? "You must enter a #" : championshipQualify[0].validity.rangeUnderflow ? "You must enter a # >= " + championshipQualify[0].min : "");
      fee[0].setCustomValidity(fee[0].validity.valueMissing ? "You must enter a #" : fee[0].validity.rangeUnderflow ? "You must enter a # >= " + fee[0].min : "");
    }
  }
};
let documentReadyCallback = () => {
  inputLocal.initializeDataTable();
  inputLocal.setMinMax();
  inputLocal.setDefaultsLoad();
  inputLocal.setWidth();
  input.storePreviousValue({selectors: ["[id^='seasonDescription_']", "[id^='seasonStartDate_']", "[id^='seasonEndDate_']", "[id^='seasonFee_']", "[id^='seasonChampionshipQualify_']"]});
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
  inputLocal.validate();
  if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='seasonDescription_']", "[id^='seasonStartDate_']", "[id^='seasonEndDate_']", "[id^='seasonFee_']", "[id^='seasonChampionshipQualify_']"]});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("input", (event) => {
  inputLocal.validate();
  if (event.target && event.target.classList.contains("timePicker")) {
    inputLocal.setMinMax();
  }
});
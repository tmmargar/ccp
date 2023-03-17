"use strict";
import { dataTable, display, input } from "./import.js";
//import IMask from 'imask';
export const inputLocal = {
  enableSave : function(id) {
    return (document.querySelector("#firstName_" + id).value.length == 0) || (document.querySelector("#lastName_" + id).value.length == 0) || (document.querySelector("#username_" + id).value.length == 0) || (document.querySelector("#mode").value == "create" && document.querySelector("#password_" + id).value.length == 0) || document.querySelector("#email_" + id).classList.contains("errors") || document.querySelector("#phone_" + id).classList.contains("errors");
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width" : "4%" }, { "type" : "name", "width" : "11%" }, { "width" : "10%" }, { "width" : "15%" }, { "render" : function (data) { return display.formatPhone({value: data}); }, "width" : "8%" }, { "render" : function (data, type, row, meta) { return display.formatHighlight({value: data, meta: meta, tableId: "dataTbl"}); }, "width" : "4%" }, { "width" : "8%" }, { "width" : "7%" }, { "width" : "8%" }, { "render" : function (data, type, row, meta) { return display.formatActive({value: data, meta: meta, tableId: "dataTbl"}); },  "width" : "3%" }, { "searchable": false, "visible": false }], aryOrder: [[9, "desc"], [1, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: false });
  },
  setId : function(selectedRow) {
    return selectedRow.children[0].innerHTML;
  },
  setIds : function() {
    const selectedRows = dataTable.getSelectedRows({jQueryTable: $("#dataTbl").dataTable()]);
    let ids = "";
    for (let selectedRow of selectedRows) {
      ids += inputLocal.setId(selectedRow) + ", ";
    }
    ids = ids.substring(0, ids.length - 2);
    document.querySelector("#ids").value = ids;
  },
  validate : function() {
    input.validateLength({obj: document.querySelector("#firstName_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#lastName_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#username_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#password_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#email_"), length: 1, focus: false});
    inputLocal.validateEmail(document.querySelector("#email_"));
  },
  validateEmail : function(obj) {
    if (obj) {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(obj.value)) {
        obj.classList.remove("errors");
      } else {
        obj.classList.add("errors");
      }
    }
  }
};
let documentReadyCallback = () => {
  if (document.querySelector("#mode").value == "create" || document.querySelector("#mode").value == "modify") {
    document.querySelector("body").style.maxWidth = "450px";
  }
  inputLocal.initializeDataTable();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  if (document.querySelector("[id^='phone_']")) {
    const patternMaskPhone = IMask(document.querySelector("[id^='phone_']"), { lazy: false, mask: '(000) 000-0000' });
    patternMaskPhone.on('accept', function() {
      if (patternMaskPhone.unmaskedValue == "") {
        document.querySelector("[id^='phone_']").classList.remove("errors");
      } else {
        document.querySelector("[id^='phone_']").classList.add("errors");
      }
      input.enable({objId: "save", functionName: inputLocal.enableSave});
    });
    patternMaskPhone.on('complete', function() {
      document.querySelector("[id^='phone_']").classList.remove("errors");
      input.enable({objId: "save", functionName: inputLocal.enableSave});
    });
  }
  input.storePreviousValue({selectors: ["[id^='firstName']", "[id^='lastName']", "[id^='username']", "[id^='password']", "[id^='email']", "[id^='phone']", "[id^='administrator']", "[id^='active']"]});
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
  if (event.target && (event.target.id.includes("firstName") || event.target.id.includes("lastName") || event.target.id.includes("username") || event.target.id.includes("password") || event.target.id.includes("email"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("reset")) {
    input.restorePreviousValue({selectors: ["[id^='firstName']", "[id^='lastName']", "[id^='username']", "[id^='password']", "[id^='email']", "[id^='phone']", "[id^='administrator']", "[id^='active']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id.includes("firstName") || event.target.id.includes("lastName") || event.target.id.includes("username") || event.target.id.includes("password"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  } else if (event.target && event.target.id.includes("email")) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    inputLocal.validateEmail(event.target);
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && (event.target.id.includes("firstName") || event.target.id.includes("lastName") || event.target.id.includes("username") || event.target.id.includes("password") || event.target.id.includes("email"))) {
    input.validateLength({obj: event.target, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("submit", (event) => {
  if (event.target && event.target.id.includes("form")) {
    document.querySelector("[id^='phone_']").unmaskedValue;
  }
});
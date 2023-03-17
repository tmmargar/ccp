"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  confirmAction : function() {
    let result = true;
    if (document.querySelector("#tournamentResultsExist").value == "1") {
      result = confirm("There are results entered for this tournament. Do you want to modify?");
    }
    return result;
  },
  customValidation : function(confirmation) {
    let msg = [];
    const aryId = document.querySelector("#ids").value.split(", ");
    for (let id of aryId) {
      if (document.querySelectorAll("#tournamentRebuys_" + id).length > 0) {
        const rebuys = document.querySelector("#tournamentRebuys_" + id).value;
        const rebuyAmount = document.querySelector("#tournamentRebuyAmount_" + id).value;
        if ((((rebuyAmount == "$0") || (rebuyAmount == "0")) && (rebuys != "0")) || (((rebuyAmount != "$0") && (rebuyAmount != "0")) && (rebuys == "0"))) {
          msg.push("You must enter either both the rebuy amount and the max rebuys or 0 for both");
          document.querySelector("#tournamentRebuys_" + id).classList.add("errors");
          document.querySelector("#tournamentRebuyAmount_" + id).classList.add("errors");
        } else {
          display.clearErrorsAndMessages();
          document.querySelector("#tournamentRebuys_" + id).classList.remove("errors");
          document.querySelector("#tournamentRebuyAmount_" + id).classList.remove("errors");
        }
        const addonAmount = document.querySelector("#tournamentAddonAmount_" + id).value;
        const addonChipCount = document.querySelector("#tournamentAddonChipCount_" + id).value;
        if ((((addonAmount == "$0") || (addonAmount == "0")) && (addonChipCount != "0")) || (((addonAmount!= "$0") && (addonAmount != "0")) && (addonChipCount == "0"))) {
          msg.push("You must enter either both the addon amount and the addon chip count or 0 for both");
          document.querySelector("#tournamentAddonChipCount_" + id).classList.add("errors");
          document.querySelector("#tournamentAddonAmount_" + id).classList.add("errors");
        } else {
          display.clearErrorsAndMessages();
          document.querySelector("[id^='tournamentAddonAmount_']").classList.remove("errors");
          document.querySelector("[id^='tournamentAddonChipCount_']").classList.remove("errors");
        }
        if (confirmation) {
          inputLocal.confirmAction();
        }
      }
    }
    if (msg.length > 0) {
      display.showErrors({errors: msg});
    }
  },
  defaultDescription : function() {
    return "S" + (new Date().getFullYear() - input.firstYear() + 1) + " - T";
  },
  enableSave : function(id) {
    return ((document.querySelector("#tournamentDescription_" + id).value == "") || (document.querySelector("#tournamentLimitTypeId_" + id).value == "") || (document.querySelector("#tournamentGameTypeId_" + id).value == "")
    || (document.querySelector("#tournamentChipCount_" + id).value.length == 0) || (document.querySelector("#tournamentLocationId_" + id).value == "") || !document.querySelector("#tournamentStartDateTime_" + id + ":valid")
    || (document.querySelector("#tournamentBuyinAmount_" + id).value.length == 0) || (document.querySelector("#tournamentMaxPlayers_" + id).value.length == 0) || (document.querySelector("#tournamentRebuyAmount_" + id).value.length == 0)
    || (document.querySelector("#tournamentRebuys_" + id).value.length == 0) || (document.querySelector("#tournamentAddonAmount_" + id).value.length == 0) || (document.querySelector("#tournamentAddonChipCount_" + id).value.length == 0)
    || (document.querySelector("#tournamentRake_" + id).value.length == 0) || (document.querySelector("#tournamentGroupId_" + id).value == ""));
  },
  initializeDataTable : function() {
    dataTable.initialize({tableId: "dataTbl", aryColumns: [{ "orderSequence": [ "desc", "asc" ], "width": "3%" },
      { "width": "12%",
        className : "textAlignUnset",
        render: function (data, type, row) {
          // row[2] is comment, row[18] is special type
          if (type === 'display') {
            const title = " title=\"" + row[18] + "\"";
            const specialType = "" != row[18] ? " (" + row[18] + ")" : "";
            return "<span" + title + ">" + data + specialType + "</span>";
          }
          return data;
        }
      },
      { "orderable": false, "visible": false, "width": "11%" }, { className : "textAlignUnset", "width": "11%" }, { "width": "7%" },
      { "width": "5%" }, { "orderable": false, "width": "1%" }, { "type": "date", "width": "6%" }, { "width": "4%" }, { "width": "5%" },
      { "width": "4%" }, { "width": "4%" }, { "width": "4%" }, { "width": "4%" }, { "width": "4%" },
      { "width": "4%" }, { "width": "4%" }, { "width": "4%" }, { "orderable": false, "visible": false, "width": "3%" }, { "orderable": false, "visible": false }], aryOrder: [[7, "desc"], [8, "desc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "400px", searching: true });
  },
  save : function(event) {
    let result = true;
    const aryId = document.querySelector("#ids").value.split(", ");
    for (let id of aryId) {
      if (!inputLocal.customValidation(true)) {
        if (event) {
          event.preventDefault();
          event.stopPropagation();
        }
        result = false;
      }
    }
    return result;
  },
  setDefaults : function() {
    if (document.querySelector("#mode").value == "create") {
      document.querySelector("[id^='tournamentDescription_']").value = inputLocal.defaultDescription();
      document.querySelector("[id^='tournamentLimitTypeId_']").value = 3;
      document.querySelector("[id^='tournamentGameTypeId_']").value = 1;
      document.querySelector("[id^='tournamentChipCount_']").value = 10000;
      document.querySelector("[id^='tournamentStartDateTime_']").value = new Date().toISOString().split("T")[0] + " 17:00";
      document.querySelector("[id^='tournamentMaxPlayers_']").value = 36;
      document.querySelector("[id^='tournamentBuyinAmount_']").value = 25;
      document.querySelector("[id^='tournamentRebuys_']").value = 0;
      document.querySelector("[id^='tournamentRebuyAmount_']").value = 0;
      document.querySelector("[id^='tournamentRebuys_']").value = 0;
      document.querySelector("[id^='tournamentAddonAmount_']").value = 10;
      document.querySelector("[id^='tournamentAddonChipCount_']").value = 1500;
      document.querySelector("[id^='tournamentRake_']").value = 20;
      document.querySelector("[id^='tournamentGroupId_']").value = 2;
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
  validate : function() {
    input.validateLength({obj: document.querySelector("#tournamentDesc_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentLimitTypeId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentGameTypeId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentChipCount_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentLocationId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentBuyinAmount_"), length: 1, focus: false});
    if (document.querySelector("#mode").value == "create" || document.querySelector("#mode").value == "modify") {
      document.querySelector("[id^='tournamentChipCount_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentChipCount_']").value;
      document.querySelector("[id^='tournamentRebuyAmount_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentRebuyAmount_']").value;
      document.querySelector("[id^='tournamentRebuys_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentRebuys_']").value;
      document.querySelector("[id^='tournamentAddonAmount_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentAddonAmount_']").value;
      document.querySelector("[id^='tournamentAddonChipCount_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentAddonChipCount_']").value;
      document.querySelector("[id^='tournamentRake_']").dataset.previousValueValidation = document.querySelector("[id^='tournamentRake_']").value;
    }
    input.validateLength({obj: document.querySelector("#tournamentMaxPlayers_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentRebuyAmount_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentRebuys_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentAddonAmount_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentAddonChipCount_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentGroupId_"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#tournamentRake_"), length: 1, focus: false});
  },
  validateField : function(obj) {
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  },
  validateField2 : function(obj, event) {
    const objSt = document.querySelector("[id^='tournamentSpecialTypeId_']");
    if (objSt.options[objSt.selectedIndex].innerText == "Championship") {
      input.validateNumberOnlyGreaterThanEqualToValue({obj: obj, event: event, value: 0, storeValue: true});
    } else {
      input.validateNumberOnlyGreaterZero({obj: obj, event: event, condition: true, storeValue: true});
    }
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  },
  validateField3 : function(obj, event) {
    if (obj.id.search(/tournamentBuyinAmount_/g) == -1) {
      if (obj.id.search(/tournamentRebuyAmount_/g) != -1 || obj.id.search(/tournamentRebuys_/g) != -1 || obj.id.search(/tournamentAddonAmount_/g) != -1 || obj.id.search(/tournamentAddonChipCount_/g) != -1) {
        input.validateNumberOnlyGreaterThanEqualToValue({obj: obj, event: event, value: 0, storeValue: true});
      } else {
        input.validateNumberOnlyGreaterZero({obj: obj, event: event, condition: true, storeValue: true});
      }
    } else {
      const objSt = document.querySelector("[id^='tournamentSpecialTypeId_']");
      if (objSt.options[objSt.selectedIndex].innerText == "Championship") {
        input.validateNumberOnlyGreaterThanEqualToValue({obj: obj, event: event, value: 0, storeValue: true});
      } else {
        input.validateNumberOnlyGreaterZero({obj: obj, event: event, condition: true, storeValue: true});
      }
    }
    if (obj.id.search(/tournamentRebuyAmount_/g) != -1 || obj.id.search(/tournamentRebuys_/g) != -1) {
      if (document.querySelector("[id^='tournamentRebuyAmount_']").value == "" || document.querySelector("[id^='tournamentRebuys_']").value == "") {
        input.validateLength({obj: document.querySelector("[id^='tournamentRebuyAmount_']"), length: 1, focus: false});
        input.validateLength({obj: document.querySelector("[id^='tournamentRebuys_']"), length: 1, focus: false});
      } else {
        inputLocal.customValidation(false);
      }
    } else if (obj.id.search(/tournamentAddonAmount_/g) != -1 || obj.id.search(/tournamentAddonChipCount_/g) != -1) {
      if (document.querySelector("[id^='tournamentAddonAmount_']").value == "" || document.querySelector("[id^='tournamentAddonChipCount_']").value == "") {
        input.validateLength({obj: document.querySelector("[id^='tournamentAddonAmount_']"), length: 1, focus: false});
        input.validateLength({obj: document.querySelector("[id^='tournamentAddonChipCount_']"), length: 1, focus: false});
      } else {
        inputLocal.customValidation(false);
      }
    } else {
      input.validateLength({obj: obj, length: 1, focus: false});
    }
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  },
  validateField4 : function(obj, event) {
    input.validateNumberOnlyGreaterZero({obj: obj, event: event, condition: true, storeValue: true});
    input.validateLength({obj: obj, length: 1, focus: false});
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
};
let documentReadyCallback = () => {
  if (document.querySelector("#mode").value == "create" || document.querySelector("#mode").value == "modify") {
    document.querySelector("body").style.maxWidth = "500px";
  }
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.validate();
  input.enable({objId: "save", functionName: inputLocal.enableSave});
  input.storePreviousValue({selectors: ["[id^='tournamentDescription_']", "[id^='tournamentComment_']", "[id^='tournamentLimitTypeId_']", "[id^='tournamentGameTypeId_']", "[id^='tournamentSpecialTypeId_']", "[id^='tournamentLocationId_']", "[id^='tournamentStartDateTime_']", "[id^='tournamentBuyinAmount_']", "[id^='tournamentMaxPlayers_']", "[id^='tournamentRebuyAmount_']", "[id^='tournamentRebuys_']", "[id^='tournamentAddonAmount_']", "[id^='tournamentAddonChipCount_']", "[id^='tournamentGroupId_']"]});
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
  if (event.target && (event.target.id.includes("tournamentLimitTypeId") || event.target.id.includes("tournamentGameTypeId") || event.target.id.includes("tournamentLocationId") || event.target.id.includes("tournamentGroupId"))) {
    inputLocal.validateField(event.target);
  } else if (event.target && event.target.id.includes("tournamentSpecialTypeId")) {
    if (event.target.options[event.target.selectedIndex].innerText == "Championship") {
      document.querySelector("[id^='tournamentChipCount_']").value = 0;
      document.querySelector("[id^='tournamentBuyinAmount_']").value = 0;
    } else {
      if (document.querySelector("[id^='tournamentChipCount_']").value == 0) {
        document.querySelector("[id^='tournamentChipCount_']").value = "";
      }
      if (document.querySelector("[id^='tournamentBuyinAmount_']").value == 0) {
        document.querySelector("[id^='tournamentBuyinAmount_']").value = "";
        input.validateLength({obj: document.querySelector("[id^='tournamentBuyinAmount_']"), length: 1, focus: false});
      }
    }
  }
});
document.addEventListener("click", (event) => {
  if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
  } else if (event.target && (event.target.id.includes("reset"))) {
    input.restorePreviousValue({selectors: ["[id^='tournamentDescription_']", "[id^='tournamentComment_']", "[id^='tournamentLimitTypeId_']", "[id^='tournamentGameTypeId_']", "[id^='tournamentSpecialTypeId_']", "[id^='tournamentLocationId_']", "[id^='tournamentStartDateTime_']", "[id^='tournamentBuyinAmount_']", "[id^='tournamentMaxPlayers_']", "[id^='tournamentRebuyAmount_']", "[id^='tournamentRebuys_']", "[id^='tournamentAddonAmount_']", "[id^='tournamentAddonChipCount_']", "[id^='tournamentGroupId_']"]});
    inputLocal.validate();
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("input", (event) => {
  if (event.target && event.target.classList.contains("timePicker")) {
    input.enable({objId: "save", functionName: inputLocal.enableSave});
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id.includes("tournamentDescription") || event.target.id.includes("tournamentStartDateTime"))) {
    inputLocal.validateField(event.target);
  } else if (event.target && (event.target.id.includes("tournamentChipCount") || event.target.id.includes("tournamentBuyinAmount") || event.target.id.includes("tournamentRake"))) {
    inputLocal.validateField2(event.target, event);
  } else if (event.target && (event.target.id.includes("tournamentRebuyAmount") || event.target.id.includes("tournamentRebuys") || event.target.id.includes("tournamentAddonAmount") || event.target.id.includes("tournamentAddonChipCount"))) {
    inputLocal.validateField3(event.target, event);
  } else if (event.target && event.target.id.includes("tournamentMaxPlayers")) {
    inputLocal.validateField4(event.target, event);
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && (event.target.id.includes("tournamentDescription") || event.target.id.includes("tournamentStartDateTime"))) {
    inputLocal.validateField(event.target);
  } else if (event.target && (event.target.id.includes("tournamentChipCount") || event.target.id.includes("tournamentBuyinAmount") || event.target.id.includes("tournamentRake"))) {
    inputLocal.validateField2(event.target, event);
  } else if (event.target && (event.target.id.includes("tournamentRebuyAmount") || event.target.id.includes("tournamentRebuys") || event.target.id.includes("tournamentAddonAmount") || event.target.id.includes("tournamentAddonChipCount"))) {
    inputLocal.validateField3(event.target, event);
  } else if (event.target && event.target.id.includes("tournamentMaxPlayers")) {
    inputLocal.validateField4(event.target, event);
  }
});
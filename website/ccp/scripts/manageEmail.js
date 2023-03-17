"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableEmail : function() {
    document.querySelectorAll("[id^='email']").forEach(obj => { obj.disabled = (document.querySelector("#to").tomselect.items.length == 0 || document.querySelector("#subject").value.length == 0) || (document.querySelector("#body").value.length == 0); });
  },
  initializeTomSelect : function(placeholder) {
    document.querySelectorAll(".tom-select").forEach((el) => {
      const settings = {
      // max items required so isFull() works
        maxItems: el.options.length,
        placeholder: placeholder,
        plugins: {
          "clear_button" : { title: "Remove all selected options" },
          "remove_button" : { title: "Remove this option" }
        },
        render: {
          item: function(data, escape) {
            return "<div title=\"" + escape(data.value) + "\">" + escape(data.text) + "</div>";
          }
        },
        onItemAdd : function() {
          document.querySelector("#to").tomselect.control_input.value = "";
          document.querySelector("#deselectAll").href = "#";
          if (document.querySelector("#to").tomselect.isFull()) { document.querySelector("#selectAll").removeAttribute("href"); }
          if (document.querySelector("#to").tomselect.items.length > 0) { document.querySelector(".ts-control").classList.remove("errors"); }
          inputLocal.enableEmail();
        },
        onItemRemove : function() {
          document.querySelector("#to").tomselect.control_input.value = "";
          document.querySelector("#selectAll").href = "#";
          if (document.querySelector("#to").tomselect.getValue() == "") { document.querySelector("#deselectAll").removeAttribute("href"); }
          if (document.querySelector("#to").tomselect.items.length > 0) {
            document.querySelector(".ts-control").classList.remove("errors");
          } else {
            document.querySelector(".ts-control").classList.add("errors");
          }
          inputLocal.enableEmail();
        }
      };
      const tomSelect = new TomSelect(el, settings);
    });
  },
  reset : function() {
    document.querySelector("#to").tomselect.clear();
  },
  validate : function() {
    input.validateLength({obj: document.querySelector(".ts-control"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#subject"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#body"), length: 1, focus: false});
  },
};
let documentReadyCallback = () => {
  inputLocal.initializeTomSelect("Select user(s)...");
  inputLocal.validate();
  inputLocal.enableEmail();
  input.storePreviousValue({selectors: ["[id^='to']", "[id^='subject']", "[id^='body']"]});
};
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.addEventListener("click", (event) => {
  if (event.target && event.target.id == "selectAll") {
    return input.selectAllTomSelect({objId: "to", event: event});
  } else if (event.target && event.target.id.includes("deselectAll")) {
    return input.deselectAllTomSelect({objId: "to", placeholder: "Select user(s)...", event: event});
  } else if (event.target && event.target.id.includes("email")) {
    document.querySelector("#mode").value = event.target.value.toLowerCase();
    document.querySelector("#body").value = "<pre>" + document.querySelector("#body").value + "</pre>";
  } else if (event.target && event.target.id.includes("reset")) {
    inputLocal.reset();
    input.restorePreviousValue({selectors: ["[id^='to']", "[id^='subject']", "[id^='body']"]});
    inputLocal.validate();
    inputLocal.enableEmail();
  } else if (event.target && (event.target.id.includes("modify") || event.target.id.includes("delete"))) {
    inputLocal.setIds();
   }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id.includes("subject") || event.target.id.includes("body"))) {
    inputLocal.validate();
    inputLocal.enableEmail();
  }
});
document.addEventListener("paste", (event) => {
  if (event.target && (event.target.id.includes("subject") || event.target.id.includes("body"))) {
    inputLocal.validate();
    inputLocal.enableEmail();
  }
});
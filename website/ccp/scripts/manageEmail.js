"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  initializeTomSelect : function({placeholder} = {}) {
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
          inputLocal.validate();
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
          inputLocal.validate();
        }
      };
      const tomSelect = new TomSelect(el, settings);
    });
  },
  reset : function() {
    document.querySelector("#to").tomselect.clear();
  },
  validate : function() {
    let result = true;
    const users = document.querySelectorAll(".ts-control");
    const user = document.querySelector("#to-ts-control");
    const subject = document.querySelector("#subject");
    const body = document.querySelector("#body");
    if (users) {
      user.setCustomValidity(users[0].children[0].textContent == "" ? "You must select a user" : "");
      if (users[0].children[0].textContent == "") {
        document.querySelector(".ts-control").classList.add("errors");
      }
      subject.setCustomValidity(subject.validity.valueMissing ? "You must enter a subject" : "");
      body.setCustomValidity(body.validity.valueMissing ? "You must enter a body" : "");
      if (users[0].children[0].textContent == "" || subject.validity.valueMissing || body.validity.valueMissing) {
        result = false;
      }
    }
    return result;
  },
};
let documentReadyCallback = () => {
  inputLocal.initializeTomSelect({placeholder: "Select user(s)..."});
  inputLocal.validate();
  input.storePreviousValue({selectors: ["[id^='to']", "[id^='subject']", "[id^='body']"]});
};
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.addEventListener("click", (event) => {
  const result = inputLocal.validate();
  if (event.target && event.target.id == "selectAll") {
    return input.selectAllTomSelect({objId: "to", event: event});
  } else if (event.target && event.target.id.includes("deselectAll")) {
    return input.deselectAllTomSelect({objId: "to", placeholder: "Select user(s)...", event: event});
  } else if (event.target && event.target.id.includes("email")) {
    if (result) {
      document.querySelector("#mode").value = event.target.value.toLowerCase();
      document.querySelector("#body").value = "<pre>" + document.querySelector("#body").value + "</pre>";
    }
  } else if (event.target && event.target.id.includes("reset")) {
    inputLocal.reset();
    input.restorePreviousValue({selectors: ["[id^='to']", "[id^='subject']", "[id^='body']"]});
   }
});
document.addEventListener("input", (event) => {
  inputLocal.validate();
});
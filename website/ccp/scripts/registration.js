"use strict";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  validate : function(obj) {
    const result = ("" == input.validateLength({obj: obj, length: 1, focus: true, msg: "You must enter a dish"}));
    document.querySelector("#register").disabled = !result;
    if (result) {
      display.clearErrorsAndMessages();
    }
  }
};
let documentReadyCallback = () => {
  input.validateLength({obj: document.querySelector("#food"), length: 1, focus: true, msg: null});
  if (document.querySelector("#register")) {
    document.querySelector("#register").disabled = document.querySelector("#food")?.classList.contains("errors");
  }
};
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.addEventListener("click", (event) => {
  if (event.target && event.target.id == "register") {
     document.querySelector("#mode").value = "savecreate";
  } else if (event.target && event.target.id == "unregister") {
     document.querySelector("#mode").value = "savemodify";
  }
});
document.addEventListener("keyup", (event) => { if (event.target && event.target.id == "food") { inputLocal.validate(event.target); } });
document.addEventListener("paste", (event) => { if (event.target && event.target.id == "food") { inputLocal.validate(event.target); } });
"use script";
import { dataTable, display, input } from "./import.js";
export const inputLocal = {
  enableLogin : function() {
    const result = document.querySelector("#username").value.length == 0 || document.querySelector("#password").value.length == 0;
    document.querySelector("#login").disabled = result;
  },
  validate : function() {
    input.validateLength({obj: document.querySelector("#username"), length: 1, focus: false});
    input.validateLength({obj: document.querySelector("#password"), length: 1, focus: false});
    inputLocal.enableLogin();
  }
};
let documentReadyCallback = () => { inputLocal.validate(); };
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.addEventListener("click", (event) => {
  if (event.target && (event.target.id == "username" || event.target.id == "password")) {
     inputLocal.validate();
  } else if (event.target && event.target.id == "login") {
    document.querySelector("#mode").value = event.target.innerText.trim().toLowerCase();
    document.querySelector("#frmLogin").submit();
  }
});
document.addEventListener("keyup", (event) => {
  if (event.target && (event.target.id == "username" || event.target.id == "password")) {
    inputLocal.validate();
  }
  if (event.key === "Enter") {
    event.preventDefault();
    document.querySelector("#login").click();
  }
});
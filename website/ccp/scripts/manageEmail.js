"use strict";
$(document).ready(function() {
  // selectUsers set in php
  inputLocal.initializeSelectize(selectUsers);
  inputLocal.validate();
  inputLocal.enableEmail();
});
$(document).on("click", "#selectAll", function(event) {
  return input.selectAllSelectize("to");
});
$(document).on("click", "#deselectAll", function(event) {
  return input.deselectAllSelectize("to");
});
$(document).on("blur click keyup paste", "#subject, #body", function(event) {
  inputLocal.validate();
  inputLocal.enableEmail();
});
$(document).on("click", "[id^='email']", function(event) {
  $("#mode").val(this.value.toLowerCase());
  $("#body").val("<pre>" + $("#body").val() + "</pre>");
});
const inputLocal = {
  enableEmail : function() {
    $("[id^='email']").prop("disabled", ($("#subject").val().length == 0) || ($("#body").val().length == 0));
  },
  initializeSelectize : function(selectValues) {
    let options = [];
    $.each(selectValues, function(key, value) {
      options.push($("<option>", {value : key + ":" + value}).text(key));
    });
    $("#to").append(options);
    $("#to").selectize({
      dropdownParent: 'body',
      valueField: "email",
      labelField: "name",
      searchField: ["name", "email"],
      plugins: {
        "drag_drop": {},
        "remove_button": {},
        "set_all": {"id": "to"}
      },
      render: {
        item: function(item, escape) {
          return "<div class=\"item\">" + (item.name ? "<span class='name'>" + escape(item.name) + "</span>" : "") + (item.email ? "<span class='email'> &lt;" + escape(item.email) + "&gt;</span>" : "") + "</div>";
        },
        option: function(item, escape) {
          const label = item.name || item.email;
          const caption = item.name ? item.email.split(':')[1] : null;
          return "<div><span class='label'>" + escape(label) + "</span>" + (caption ? "<span class='caption'> &lt;" + escape(caption) + "&gt;</span>" : "") + "</div>";
        }
      }
    });
  },
  reset : function() {
    input.deselectAllSelectize("to");
  },
  validate : function() {
    input.validateLength($(".selectize-input"), 1, false);
    input.validateLength($("#subject"), 1, false);
    input.validateLength($("#body"), 1, false);
  },
};
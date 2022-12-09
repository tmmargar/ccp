"use strict";
    Selectize.define('set_all', function(options) {
      let self = this;
      this.setup = (function(e) {
        const original = self.setup;
        return function(e) {
          original.apply(this, arguments);
          var html = 
//            "Ctrl + shift + a to select all<br>\n" +
//            "Ctrl + shift + d to de-select all<br>\n" +
            "<a href=\"javascript:void(0);\" id=\"selectAll\">Select all</a>\n" +
            "<a href=\"javascript:void(0);\" id=\"deselectAll\">De-select all</a>\n";
          $("#" + options.id).before(html);
          //$(this).before(html);
        };
      })();
      this.onKeyUp = (function(e) {
        const original = self.onKeyUp;
        return function(e) {
          original.apply(this, arguments);
          const code = e.originalEvent.code;
          if (!(e.ctrlKey == true && e.shiftKey == true && (code == "KeyA" || code == "KeyD"))) {
            return;
          }
          if (code == "KeyA") {
            self.setValue(Object.keys(self.options)); // Set all selectize options using setValue() method
            self.focus();
          } else {
            self.clear();
          }
        };
      })();
      this.onChange = (function(e) {
        const original = self.onChange;
        return function(e) {
          original.apply(this, arguments);
          // accessing items on selectize submits form so cannot use
          if (Object.keys($("#" + options.id).selectize()[0].selectize.options).length == $("#" + options.id).selectize()[0].selectize.items.length) { // if not all selected
            //$("#selectAll").text("De-select all");
            $("#selectAll").hide();
            $("#deselectAll").show();
          } else {
            //$("#selectAll").text("Select all");
            if ($("#" + options.id).selectize()[0].selectize.items.length == 0) {
              $("#deselectAll").hide();
            } else {
              $("#deselectAll").show();
            }
            $("#selectAll").show();
          }
          if ($("#" + options.id).selectize()[0].selectize.items.length > 0) {
            $(".selectize-input").removeClass("errors");
          } else {
            $(".selectize-input").addClass("errors");
          }
        }
      })();
    });
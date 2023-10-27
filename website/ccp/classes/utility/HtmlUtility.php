<?php
namespace ccp\classes\utility;
use ccp\classes\model\Constant;
class HtmlUtility {
  public static function buildClasses(array $aryClasses, string|int|float $value) {
  $class = "";
  for ($idx = 0; $idx < count(value: $aryClasses); $idx ++) {
    if ($class != "") {
      $class .= " ";
    }
    switch ($aryClasses[$idx]) {
      case "currency":
      case "percentage":
      case "number":
        $class .= "number";
        if ($aryClasses[$idx] == "currency" && isset($value)) {
          if (0 > $value) {
            $class .= " negative";
          } else if (0 < $value) {
            $class .= " positive";
          }
        }
        break;
      // case "positive":
      // $class .= "positive";
      // break;
      // case "negative":
      // $class .= "negative";
      // break;
      // case "center":
      // $class .= "center";
      // break;
      default:
        $class .= $aryClasses[$idx];
        break;
    }
  }
  return $class;
}
  // $format is array of formats (index, type and places)
  // $value is value to format
  // returns formatted value
  //TODO: move to FormBase once change class to array
  public static function formatData(array $format, string|int|float $value) {
    if (isset($format)) {
      $temp = "";
      switch ($format[1]) {
        case "date":
          $temp = $value->getDisplayFormat();
          break;
        case "time":
          $temp .= $value->getDisplayAmPmFormat();
          break;
        case "currency":
        case "percentage":
        case "number":
          $prefix = "";
          $suffix = "";
          if ("currency" == $format[1]) {
            $prefix = Constant::$SYMBOL_CURRENCY_DEFAULT;
          } else if ("percentage" == $format[1]) {
            $suffix = Constant::$SYMBOL_PERCENTAGE_DEFAULT;
            $temp .= $value * 100;
          }
          if (- 1 != $format[2]) {
            $temp .= number_format(num: $value, decimals: $format[2]);
          }
          if ($temp != "") {
            $temp = $prefix . $temp . $suffix;
          }
          break;
      }
    } else {
      $temp = $value;
    }
    return $temp;
  }
}
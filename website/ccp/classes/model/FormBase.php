<?php
namespace ccp\classes\model;
class FormBase extends Base {
  private $class; // array
  private $disabled; // boolean
  private $name;
  private $suffix;
  private $value;
  public function __construct7($debug, $class, $disabled, $id, $name, $suffix, $value) {
    parent::__construct2($debug, $id);
    $this->class = null == $class ? array() : $class;
    $this->disabled = $disabled;
    $this->name = Base::build($name, null);
    $this->suffix = $suffix;
//     $this->value = !isset($value) || $value == "" ? null : $value;
    $this->value = (isset($value) && $value != "") || $value == 0 ? $value : null;
//     echo "<BR>" . $id . " -- " . $value . " -> " . $this->value;
  }
//   public function buildClasses() {
//     $class = "";
//     for ($idx = 0; $idx < count($this->class); $idx ++) {
//       if ($class != "") {
//         $class .= " ";
//       }
//       switch ($this->class[$idx]) {
//         case "currency":
//         case "percentage":
//         case "number":
//           $class .= "number";
//           if ($this->class[$idx] == "currency" && isset($this->value)) {
//             if (0 > $this->value) {
//               $class .= " negative";
//             } else if (0 < $this->value) {
//               $class .= " positive";
//             }
//           }
//           break;
//         case "positive":
//           $class .= "positive";
//           break;
//         case "negative":
//           $class .= "negative";
//           break;
//         case "center":
//           $class .= "center";
//           break;
//       }
//     }
//     return $class;
//   }
//   public function buildId() {
//     return $this->build($this->getId(), $this->suffix);
//   }
//   public function buildName() {
//     return $this->build($this->name, $this->suffix);
//   }
  public function getClass() {
    return $this->class;
  }
  public function getClassAsString() {
    return implode(" ", $this->class);
  }
  public function getName() {
    return $this->name;
  }
  public function getSuffix() {
    return $this->suffix;
  }
  public function getValue() {
    return $this->value;
  }
  public function isDisabled() {
    return $this->disabled;
  }
  public function setClass($class) {
    $this->class = $class;
  }
  public function setDisabled($disabled) {
    $this->disabled = $disabled;
  }
  public function setName($name) {
    $this->name = $name;
  }
  public function setSuffix($suffix) {
    $this->suffix = $suffix;
  }
  public function setValue($value) {
    $this->value = $value;
  }
  public function toString() {
    $output = parent::__toString();
    $output .= ", class = '";
    $output .= print_r($this->class, true);
    $output .= "', disabled = ";
    $output .= $this->disabled;
    $output .= ", name = '";
    $output .= $this->name;
    $output .= ", suffx = '";
    $output .= $this->suffix;
    $output .= "', value = '";
    $output .= $this->value;
    $output .= "'";
    return $output;
  }
}
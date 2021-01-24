<?php
namespace ccp\classes\model;
abstract class Base extends Root {
  private $id; // key // number
  public function __construct2($debug, $id) {
    $this->setDebug($debug);
    $this->id = Base::build($id, null);
  }
  public function getId() {
    return $this->id;
  }
  public function setId($id) {
    $this->id = $this->build($id, null);
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", id = ";
    $output .= $this->id;
    return $output;
  }
  // dynamic way to call constructor based on number of parameters (using naming build#()
//   public static function build() {
//     $arguments = func_get_args();
//     $numberOfArguments = func_num_args();
//     if (method_exists(Base::class, $function = 'build' . $numberOfArguments)) {
// //       $reflection = new \ReflectionClass($this);
// //       echo "<br>Calling __construct" . $numberOfArguments . " on " . $reflection->getName();
//       return call_user_func_array(array(Base::class, $function), $arguments);
//     }
//   }
//   public static function build1($value) {
//     return Base::build2($value, null);
//   }
//   public static function build2($value, $suffix) {
  public static function build($value, $suffix) {
    $idTemp = "";
    $temp = explode(" ", $value);
    if (count($temp) > 1) {
      $counter = 0;
      foreach ($temp as $val) {
        if (0 == $counter) {
          $val = strtolower($val);
        } else {
          $val = ucfirst($val);
        }
        $idTemp .= $val;
        $counter ++;
      }
    } else {
      $idTemp = lcfirst($value);
    }
    if (isset($suffix)) {
      $idTemp .= $suffix;
    }
    return $idTemp;
  }

}
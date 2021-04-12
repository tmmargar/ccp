<?php
namespace ccp\classes\model;
abstract class Base extends Root {
  private string|int|null $id; // key // number
  public function __construct(bool $debug, string|int|null $id) {
//     echo "<BR>BASE -> " . var_dump($debug) . " -- " . $id;
    $this->setDebug($debug);
    $this->id = Base::build($id, null);
  }
  public function getId() {
    return $this->id;
  }
  public function setId(int $id) {
    $this->id = $this->build($id, null);
  }
  public function __toString() {
    $output = parent::__toString();
    $output .= ", id = ";
    $output .= $this->id;
    return $output;
  }
  public static function build(string|int|null $value, string|null $suffix) {
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
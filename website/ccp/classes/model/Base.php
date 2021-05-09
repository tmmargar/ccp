<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class Base extends Root {
  public function __construct(protected bool $debug, private string|int|null $id) {
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
    if (isset($value)) {
      $temp = explode(" ", (string) $value);
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
        $idTemp = lcfirst((string) $value);
      }
      if (isset($suffix)) {
        $idTemp .= $suffix;
      }
    }
    return $idTemp;
  }
}
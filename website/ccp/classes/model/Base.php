<?php
declare(strict_types = 1);
namespace ccp\classes\model;
abstract class Base extends Root {
  public function __construct(protected bool $debug, private string|int|null $id) {
    $this->id = Base::build(value: $id, suffix: null);
  }
  public function getId(): string {
    return $this->id;
  }
  public function setId(int $id) {
    $this->id = $this->build(value: $id, suffix: null);
  }
  public function __toString(): string {
    $output = parent::__toString();
    $output .= ", id = ";
    $output .= $this->id;
    return $output;
  }
  public static function build(string|int|null $value, string|null $suffix): string {
    $idTemp = "";
    if (isset($value)) {
      $temp = explode(separator: " ", string: (string) $value);
      if (count(value: $temp) > 1) {
        $counter = 0;
        foreach ($temp as $val) {
          if (0 == $counter) {
            $val = strtolower(string: $val);
          } else {
            $val = ucfirst(string: $val);
          }
          $idTemp .= $val;
          $counter ++;
        }
      } else {
        $idTemp = lcfirst(string: (string) $value);
      }
      if (isset($suffix)) {
        $idTemp .= $suffix;
      }
    }
    return $idTemp;
  }
}
<?php
namespace ccp\classes\utility;
class FileUtility {
  public static function getFileNames($directory, $excludeFileNames) {
    $validFileNames = array_diff(scandir($directory), $excludeFileNames);
    $result = "";
    foreach ($validFileNames as $fileName) {
      $name = explode(".", $fileName);
      $result .= "<br/><a href=\"" . (is_dir($name[0]) ? $name[0] . "\MainTest.class.php" : $fileName) . "\">" . $name[0] . "</a>";
    }
    return $result;
  }
}
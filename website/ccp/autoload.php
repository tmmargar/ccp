<?php
declare(strict_types = 1);
namespace ccp;
/**
 *
 * @param string $className Class or Interface name automatically
 *              passed to this function by the PHP Interpreter
 */
  spl_autoload_register(function($class_name) {
    $class_name = str_replace("\\", "/", $class_name);
    $rootDir = $_SERVER['HTTP_HOST'] == "www.chipchairprayer.com" ? "/home/chipch5/public_html/demo/" : "";
    $dirs = array($rootDir, $rootDir . "classes/", $rootDir . "classes/test/", $rootDir . "classes/common/PHPMailer/", $rootDir . "classes/common/Psr/", $rootDir . "classes/common/smarty/", $rootDir . "classes/common/smarty/libs/", $rootDir . "classes/utility/", $rootDir . "classes/utility/test/");
    foreach($dirs as $dir) {
//        echo "<br>namespace CCP -->" . $class_name . " -> " . $dir . str_replace("ccp/", "", $class_name) . ".php";
      if (file_exists($dir . str_replace("ccp/", "", $class_name) . ".php")) {
//          echo "<br> found it CCP namespace";
        require_once($dir . str_replace("ccp/", "", $class_name) . ".php");
        return true;
      }
//        echo "<br>namespace other --> " . $class_name . " -> " . $dir . $class_name . ".php";
      if (file_exists($dir . $class_name . ".php")) {
//         echo "<br> found it other namespace";
        require_once($dir . $class_name . ".php");
        return true;
      }
    }
  });
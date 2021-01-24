<?php
namespace ccp;
/**
 *
 * @param string $className Class or Interface name automatically
 *              passed to this function by the PHP Interpreter
 */
// function autoLoader($className) {
//     // TODO: find better way to do this
//     //Directories added here must be relative to the script going to use this file
//     //$directories = array("", "../", "../utility/", "classes/", "classes/utility/", "../classes/", "../classes/utility/");
//     $dirName = dirname(__FILE__) . "/";
// //     $directories = array("", $dirName . "classes/", $dirName . "classes/PHPMailer/", $dirName . "classes/Psr/", $dirName . "classes/utility/", $dirName . "test/", $dirName . "smarty-old/", $dirName . "smarty-old/sysplugins/");
// //     $directories = array("", $dirName . "classes/", $dirName . "classes/PHPMailer/", $dirName . "classes/Psr/", $dirName . "classes/utility/", $dirName . "test/", $dirName . "smarty/", $dirName . "smarty/libs/");
//     $directories = array($dirName . "classes/", $dirName . "classes/PHPMailer/", $dirName . "classes/Psr/", $dirName . "classes/utility/", $dirName . "test/", $dirName . "smarty/", $dirName . "smarty/libs/");
//     //Add your file naming formats here
//     $fileNameFormats = array("%s.class.php", "%s.php");
//     // this is to take care of the PEAR style of naming classes
//     $path = str_ireplace("_", "/", $className);
//     if (@include_once $path . ".php") {
//         return;
//     }
//     echo "<br>directories -> " . print_r($directories, true);
//     foreach ($directories as $directory) {
//         echo "<br>directory -> " . $directory;
//         foreach ($fileNameFormats as $fileNameFormat) {
//           echo "<br>file name format -> " . $fileNameFormat;
//           $path = $directory.sprintf($fileNameFormat, $className);
//           echo "<br>path -> " . $path;
//           if (file_exists($path)) {
//             echo " -> found it";
//             include_once $path;
//             return;
//           } else {
//             $path = strtolower($path);
//             echo "<br>path -> " . $path;
//             if (file_exists($path)) {
//               echo " -> found it";
//               include_once $path;
//               return;
//             }
//           }
//         }
//     }
// }
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
//      echo "<br>" . $dir . $class_name . ".class" . ".php";
//       if (file_exists($dir . $class_name . ".class" . ".php")) {
//        echo "<br> found it";
//         require_once($dir . $class_name . ".class" . ".php");
//         return;
//       }
    }
  });
// spl_autoload_register("autoLoader");
// spl_autoload_extensions(".php"); // comma-separated list
// spl_autoload_register();
// spl_autoload_register(function($class_name) {
//   $fileName = lcfirst(str_replace("\\", "/", str_replace("Ccp\\", "", $class_name))) . ".php";
//   echo "<br>" . $class_name . " -> " . $fileName;
//   if (file_exists($fileName)) {
//     include_once $fileName;
//     return;
//   }
// });
// // instantiate the loader
//  $loader = new Classes\Psr4AutoloaderClass;
//  // register the autoloader
//  $loader->register();
//  // register the base directories for the namespace prefix
//  $loader->addNamespace('ccp\classes', '/classes');
//  $loader->addNamespace('ccp\classes\Common', '/classes/common');
//  $loader->addNamespace('ccp\classes\Common\PHPMailer', '/classes/common/PHPMailer');
//  $loader->addNamespace('ccp\classes\Test', '/classes/test');
//  $loader->addNamespace('ccp\classes\Utility', '/classes/utility');
//  $loader->addNamespace('ccp\classes\utility\Test', '/classes/utility/test');
//  $loader->addNamespace(' ', '/classes');
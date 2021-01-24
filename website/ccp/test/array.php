<?php
$test = "a, b, c";
// print_r(explode(", ", $test));
echo (explode(", ", $test))[0];
die();
$a = array('a' => 'some value a', 'b' => 'some value b', 'c' => 'some value c');
echo "<br>a --> ";
print_r($a);
// echo "<br>var_dump(a) --> ";
// var_dump($a);
// echo "<br>var_export(a) --> ";
// var_export($a);
// die();
$b = array('a' => 'another value a', 'c' => 'another value c');
echo "<br>b --> ";
print_r($b);
//$c = array('b' => 'some more value b', 'c' => 'some more value c');
//$d = array_merge(array_merge($a, $b),$c);
$d = array_merge($a, $b);
echo "<br>d --> ";
print_r($d);
foreach($d as $key=>$value){
    $aN[$key] = isset($a[$key]) ? $a[$key] : '';
    $bN[$key] = isset($b[$key]) ? $b[$key] : '';
    //$cN[$key] = isset($c[$key]) ? $c[$key] : '';
}
// $dN = array_merge($aN, $bN);
echo "<br>aN --> ";
print_r($aN);
echo "<br>bN --> ";
print_r($bN);
//$dN = array($aN, $bN, $cN);
$dN = array($aN, $bN);
echo "<br>dN --> ";
print_r($dN);
?>
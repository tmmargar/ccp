<?php
$config = [
    'indent'         => true,
    'output-xhtml'   => false,
    'show-body-only' => true
];
$tidy = new tidy();
$tidy->parseString("<html><head><title>tidy test</title></head><body>this is the body<br /></body></html>", $config, 'utf8');
$tidy->cleanRepair();
echo $tidy;
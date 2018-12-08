<?php
require __DIR__ . '/vendor/autoload.php';

use Acme\test;
$obj1=new test();
echo $obj1->helloStr;

$testString="test*__123/test";

$regExp='/\W/';

$replacement='';

echo preg_replace($regExp, $replacement, $testString);
?>
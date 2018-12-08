<?php
require __DIR__ . '/vendor/autoload.php';

use Acme\test;
use DataBase\columnDataProperties;
use DataBase\MySQLColumn;

$obj1=new test();
echo $obj1->helloStr;

$testString="test*__123/test";

$regExp='/\W/';

$replacement='';

echo preg_replace($regExp, $replacement, $testString);

echo '\n';

$colProp=new columnDataProperties(true);
$column1=new  MySQLColumn('id','INT',$colProp);
echo $column1->getSQL();

?>
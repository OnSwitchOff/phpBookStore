<?php
require __DIR__ . '/vendor/autoload.php';

use Acme\test;
use DataBase\columnDataProperties;
use DataBase\MySQLColumn;
use DataBase\DB;

$obj1=new test();
echo $obj1->helloStr;

$testString="test*__123/test";

$regExp='/\W/';

$replacement='';

echo preg_replace($regExp, $replacement, $testString);

echo "</br>";

$colProp=new columnDataProperties(true);
$column1=new  MySQLColumn('id','INT',$colProp);
echo $column1->getSQL();
echo '<br>';
$db=new DB();
echo '<br>';
var_dump($db->getDsn());

?>
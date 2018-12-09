<?php
require __DIR__ . '/vendor/autoload.php';

use Acme\test;
use DataBase\columnDataProperties;
use DataBase\MySQLColumn;
use DataBase\DB;
use DataBase\MySqlTable;

$obj1=new test();
echo $obj1->helloStr;

$testString="test*__123/test";

$regExp='/\W/';

$replacement='';

echo preg_replace($regExp, $replacement, $testString);


$colProp=new columnDataProperties(true);
$colProp->isAutoIncrement=true;
$colProp2=new columnDataProperties(false,2, false, false, false,'','');
$column1=new  MySQLColumn('id','INT',$colProp);
echo $column1->getSQL();

$db=new DB();



$column2=new  MySQLColumn('Count','INT',$colProp2);

$columnList=[$column1];
$table=new MySqlTable("Counts",$columnList);

$table->addColumn($column2);

var_dump($table);
echo "<pre>";
var_dump($table->createTableSql());
echo "</pre>";

$db->createTable($table);
$db->dropTable($table);
?>
<?php
/**
 * Created by PhpStorm.
 * User: OnSwitchOff
 * Date: 08.12.2018
 * Time: 20:53
 */

namespace DataBase;


class MySqlTable
{
    public $tableName;
    public $columnList=[];

    public function __construct($tableName,$columnList)
    {
        $this->tableName=$tableName;
        $this->formatTableName();

        foreach ($columnList as $column){
            if($column->isValid){
                array_push($this->columnList,$column);
            }
        }
//        array_filter($columnList, function($col){return $col->isValid;});
//        $this->columnList=$columnList;

        echo "<pre>";
        var_dump($this);
        echo "</pre>";
    }

    private function formatTableName(){
        $regExp='/\W/';
        $replacement='';
        $this->tableName=preg_replace($regExp, $replacement, $this->tableName);
    }

    public function createTableSql(){
        $result="";
        if (count($this->columnList)){
            $result="CREATE TABLE ".$this->tableName." (";
            foreach ( $this->columnList as $column){
                $result=$result.$column->getSQL().', ';
                if ($column->columnDataProperties->ForeignKey)
                    $result=$result."FOREIGN KEY (".$column->columnName.') REFERENCES '.$column->columnDataProperties->ForeignKey.', ';
            }
            $result=substr($result,0,-2).');';
        }
        return $result;
    }

    public function insertRowSql(){
        $result="";
        if (count($this->columnList)){
            $result="INSERT ".$this->tableName." (";
            foreach ( $this->columnList as $column) {

                if (!$column->columnDataProperties->isPrimary) {
                    $result = $result . $column->columnName . ', ';
                }
            }
            $result=substr($result,0,-2).') VALUES (';
            foreach ( $this->columnList as $column) {
                if (!$column->columnDataProperties->isPrimary) {
                    $result = $result .'?, ';
                }
            }
            $result=substr($result,0,-2).');';
        }
        return $result;
    }

    public function dropTableSql(){
        return "DROP TABLE ".$this->tableName.';';
    }

    public function selectAllSql(){
        return "SELECT * FROM ".$this->tableName.';';
    }

    public function addColumn($column){
        array_push($this->columnList,$column);
        var_dump(count($this->columnList));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: OnSwitchOff
 * Date: 08.12.2018
 * Time: 17:38
 */
namespace DataBase {

    class dbMySQLColumn
    {
        public $columnName;
        public $columnDataType;
        private $columnSymDataTypes=['CHAR','VARCHAR','TINYTEXT','TEXT','MEDIUMTEXT','LARGETEXT'];
        private $columnNumDataTypes=['TINYINT','BOOL','TINYINT UNSIGNED', 'SMALLINT', 'SMALLINT UNSIGNED', 'MEDIUMINT', "MEDIUMINT UNSIGNED", "INT",'INT UNSIGNED', 'BIGINT', 'BIGINT UNSIGNED', 'DECIMAL', 'NUMWRIC', 'DEC', 'FIXED', 'FLOAT', 'DOUBLE'];
        private $columnDateDataTypes=['DATE', 'TIME', 'DATETIME', 'TIMESTAMP', 'YEAR'];
        private $columnBinaryDataTypes=['TINYBLOB','BLOB','MEDIUMBLOB','LARGEBLOB'];
        private $isRequiredDataSize=false;

        public $columnDataProperties;

        /*public $columnDataSize;
        public $isPrimary;
        public $isAutoIncrement;
        public $isUnique;
        public $isNull;
        public $Default;
        public $Check;
        public $ForeignKey;*/

        public $isValid=false;

        public function __construct($columnName,$columnDataType,$options)
        {
            $this->columnDataType=$columnDataType;
            $this->columnName=$columnName;
            $this->columnDataProperties=$options;
        }

        private function formatColumnName(){
            $regExp='/\W/';
            $replacement='';
            $this->columnName=preg_replace($regExp, $replacement, $this->columnName);
        }

        private function DataTypeVerification(){
            $result=false;
            if (in_array($this->columnDataType,$this->columnBinaryDataTypes)){
                $result=true;
            }
            elseif (in_array($this->columnDataType,$this->columnSymDataTypes)){
                $result=true;
                $this->isRequiredDataSize=true;
            }
            elseif (in_array($this->columnDataType,$this->columnNumDataTypes)){
                $result=true;
            }
            elseif (in_array($this->columnDataType,$this->columnDateDataTypes)){
                $result=true;
            }
            return $result;
        }
    }
}
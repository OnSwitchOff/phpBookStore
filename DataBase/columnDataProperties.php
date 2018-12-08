<?php
/**
 * Created by PhpStorm.
 * User: OnSwitchOff
 * Date: 08.12.2018
 * Time: 19:12
 */
namespace DataBase {

    class columnDataProperties
    {

        public $isPrimary;
        public $columnDataSize;
        public $isAutoIncrement;
        public $isUnique;
        public $isNull;
        public $Default;
        public $Check;
        public $ForeignKey;

        public function __construct($isPrimary=false,$columnDataSize=0,$isAutoIncrement=false,$isUnique=false,$isNull=true,$Default='',$Check='',$ForeignKey=null)
        {
            $this->isPrimary=$isPrimary;
            $this->columnDataSize=$columnDataSize;
            $this->isAutoIncrement=$isAutoIncrement;
            $this->isUnique=$isUnique;
            $this->isNull=$isNull;
            $this->Default=$Default;
            $this->Check=$Check;
            $this->ForeignKey=$ForeignKey;
        }
    }
}

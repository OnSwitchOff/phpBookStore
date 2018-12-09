<?php
/**
 * Created by PhpStorm.
 * User: OnSwitchOff
 * Date: 08.12.2018
 * Time: 17:27
 */


namespace DataBase {
    use \PDO;
    class DB
    {
        private $user='root';
        private $pass='root';
        private $dsn='mysql:host=127.0.0.1:3306;dbname=test';
        private $dbh;

        function __construct()
        {
            try {
                $this->dbh = new PDO($this->dsn, $this->user, $this->pass);
                echo "connect";
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function createTable($table){
            try{
                $sth = $this->dbh->prepare($table->createTableSql());
                var_dump($sth->execute());
            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function dropTable($table){
            try{
                $sth = $this->dbh->prepare($table->dropTableSql());
                var_dump($sth->execute());
            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function selectAll($table){
            try{
                $sth = $this->dbh->prepare($table->selectAllSql());
                var_dump($sth->execute());
                $result = $sth->fetchAll();
                print_r($result);
            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function insertRow($table,$values){
            try{
                $sth = $this->dbh->prepare($table->insertRowSql());
                var_dump($sth->execute($values));
            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        /**
         * @return string
         */
        public function getDsn()
        {
            return $this->dsn;
        }

        /**
         * @return string
         */
        public function getPass()
        {
            return $this->pass;
        }

        /**
         * @return string
         */
        public function getUser()
        {
            return $this->user;
        }

        /**
         * @param string $dsn
         */
        public function setDsn($dsn)
        {
            $this->dsn = $dsn;
        }

        /**
         * @param string $pass
         */
        public function setPass($pass)
        {
            $this->pass = $pass;
        }

        /**
         * @param string $user
         */
        public function setUser($user)
        {
            $this->user = $user;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: OnSwitchOff
 * Date: 08.12.2018
 * Time: 17:27
 */


namespace DataBase {
    use \PDO;
    use \PDOException;
    class DB
    {
        private $user='root';
        private $pass='root';
        private $dsn='mysql:host=127.0.0.1:3306;dbname=test';
        private $dbh=null;

        function __construct()
        {
            try {
                $this->dbh = new PDO($this->dsn, $this->user, $this->pass);
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "connect";
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        function __destruct()
        {
            $this->dbh=null;
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
                return $result;
            }catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function getAll($sql, $params = [])
        {
            $sth = $this->dbh->prepare($sql);
            $data = [];
            if ($sth->execute($params)) {
                while (($row = $sth->fetch(PDO::FETCH_ASSOC))) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function getObjectsOf($query, $class)
        {
            $tmpResult = $this->dbh>query($query);
            $tmpResult->setFetchMode(PDO::FETCH_CLASS, $class);
            $result = [];

            while ($object = $tmpResult->fetch()) {
                $result[] = $object;
            }

            return $result;
        }

        public function query($query)
        {
            $result = [];
            $sth = $this->dbh->prepare($query);
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_ASSOC);

            while ($row = $sth->fetch()) {
                $result[] = $row;
            }

            return $result;
        }

        public function getOne($query)
        {
            $sth = $this->dbh->prepare($query);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_COLUMN);
            return $result;
        }

        public function getOneObject($query, $class)
        {
            $sth= $this->dbh->prepare($query);
            $sth->execute();
            $sth->setFetchMode(PDO::FETCH_CLASS, $class);
            $result = $sth->fetch();
            return $result;
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
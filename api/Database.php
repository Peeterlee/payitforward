<?php

class Database {
    private $host = "localhost";
    private $db = "payitforward";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        }catch(mysqli_sql_exception $e){
            echo "Connection error: ".$e;
        }

        return $this->conn;

    }

    public function runQuery($sql){
        $run = $this->getConnection()->query($sql);
        return $run;
    }
}



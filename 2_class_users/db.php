<?php
/*
 * Class DBConnection
 */


Class DBConnection {

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "junior";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
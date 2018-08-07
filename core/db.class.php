<?php
/*
class Config 
{
    static $dbHost = 'localhost';
    static $dbUsername = 'root';
    static $dbPassword  = '';
    static $dbname = 'credits_db';
}
*/
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "credits_db";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->con = null;
  
        $this->con = new mysqli($this->host,$this->username,$this->password,$this->db_name);
  
        return $this->con;
    }
}


?>
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
    private $host = "sql306.ezyro.com";
    private $db_name = "ezyro_22454513_creditsdb";
    private $username = "ezyro_22454513";
    private $password = "Passmein07";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->con = null;
  
        $this->con = new mysqli($this->host,$this->username,$this->password,$this->db_name);
  
        return $this->con;
    }
}


?>
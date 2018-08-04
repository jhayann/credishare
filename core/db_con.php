<?php
include_once('db.class.php');
/*
$con = new mysqli(Config::$dbHost,Config::$dbUsername,Config::$dbPassword,Config::$dbname);

 if($con->connect_error){
     die("ERROR CONNECTING TO DATABASE: ". $con->connect_error);
 } */
$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare("INSERT INTO users(username,password) VALUES(?,?)");
$stmt->bind_param("ss",$d1,$d2);
$d1 ="reyjhon";
$d2 =password_hash("passmein07",PASSWORD_BCRYPT);
$stmt->execute();


?>
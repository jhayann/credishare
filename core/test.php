<?php


include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
$user ="jhayB";
$pass ="12345";

  $uservalid = false;
    $auth = $GLOBALS['db']->prepare("SELECT username, password FROM users WHERE username = ? LIMIT 0,1");
    $auth->bind_param("s",$user);
    $auth->execute();
    $res = $auth->get_result();
    $rec = $res->fetch_assoc();
    $userdb = $rec['username'];
var_dump($userdb);
var_dump($rec['password']);
    if(password_verify($pass,$rec['password']) && $user==$userdb)
    {
        echo "valid";
    } else {
        echo "ivalid";
    }
?>
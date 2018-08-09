<?php

include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
$user='jhayB';
$get=$GLOBALS['db']->prepare("SELECT DATE_FORMAT(date_added,'%b %d') as date, amount FROM topup_history WHERE username = ? ORDER by date_added DESC LIMIT 0,10");
$get->bind_param("s",$user);
 $get->execute();
$results = $get->get_result();
    $data = array();
    foreach ($results as $row) {
        $data[] = $row;
        }
   print json_encode($data);
    $GLOBALS['db']->close();

 
  
?>
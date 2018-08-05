<?php
include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
 if(isset($_POST['query'])){
     $user = $_POST['query'];
      $response ='';
     $get = $db->prepare("SELECT username FROM users WHERE username LIKE CONCAT('%',?,'%')");
     $get->bind_param("s",$user);
     $get->execute();
     $result = $get->get_result();
     if($result->num_rows >= 1){
        while($row=$result->fetch_assoc())
        {
            $r = "'".$row['username']."'";
             $response .= '<a href="#" onclick="thisFunction('.$r.')" class="list-group-item list-group-item-action">'.$row['username'].'</a>'; 
        }
     } else {
         $response .= '<a class="list-group-item list-group-item-action">User not found</a>';
     }
     echo $response;
     $result->free_result();
     $db->close();
 }
?>
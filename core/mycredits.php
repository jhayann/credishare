<?php
include('../core/function.php');
if(isset($_POST['action']) && $_POST['action'] == "getcredits") 
{
    $username = $_POST['user'];
    getmyCredits($username);
}
else if(isset($_POST['action']) && $_POST['action'] == "gethistory")  
{
    $username = $_POST['user'];
    getmyHistory($username);
}


?>
<?php
include('function.php');
if(isset($_POST['action']) && $_POST['action'] == "users_chart")
   {
       users_chart();
   
}
?>
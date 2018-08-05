<?php

include('function.php');

if(isset($_POST['action']) && $_POST['action'] == "getrecords")
    {

        getrecords("");
    }
    else if(isset($_POST['action']) && $_POST['action'] == "gethistory")
    {
        getHistory();
    }
    else if(isset($_POST['action']) && $_POST['action'] == "topup")
    {
        $user = $_POST['user'];
        $amount = $_POST['amount'];
        topUp($user,$amount);
    }
    else
    {
        echo "<h1>error</h1>";
    }


?>
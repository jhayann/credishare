<?php

include_once('function.php');

if(isset($_POST['action']) && $_POST['action'] == "getrecords")
    {
        getrecords();
    }
    else 
    {
        echo "<h1>error</h1>";
    }


?>
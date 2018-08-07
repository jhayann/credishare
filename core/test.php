<?php
session_start();
session_unset();
session_destroy();




    if(isset($_SESSION['username']) && $_SESSION['token'])
    {
       echo $_SESSION['username'];
    } else {
        echo "nopt login";
    }
  
?>
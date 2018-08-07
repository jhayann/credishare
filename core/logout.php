<?php
session_start();
session_unset();
session_destroy();
header('location:https://bsit-blog.ezyro.com/index.php');
?>
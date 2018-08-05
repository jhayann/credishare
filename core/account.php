<?php
include('function.php');
if(isset($_POST['action']) && $_POST['action'] == "check" ){
    $user = $_POST['query'];
    if(checkUser($user)==false){
        $message = "Your desire username is not available.";
        $response = '<input type="hidden" value="invalid" id="isvalid">';
        echo  $response .= '<div class="alert alert-danger" role="alert">'.$message.'</div>';
    } else {
        $message = "Your desire username available.";
         $response = '<input type="hidden" value="valid" id="isvalid">';
        echo $response .= '<div class="alert alert-success" role="alert">'.$message.'</div>';
    }
}else if(isset($_POST['action']) && $_POST['action'] == "signup" ){
    
    $username =$_POST['username'];
    $studnum=$_POST['studentnumber'];
    $email=$_POST['email'];
    $password=$_POST['password1'];
    $password_ = password_hash($password, PASSWORD_BCRYPT);
    signUp($username, $studnum, $email, $password_);
    
}else if(isset($_POST['action']) && $_POST['action'] == "auth" ){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(Auth($username,$password) == true)
    {
        echo "true";
    } 
    else 
    {
        echo "false";
    }
}


?>
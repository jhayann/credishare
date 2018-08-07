<?php
include('function.php');
if(isset($_POST['action']) && $_POST['action'] == "check" ){
    $user = $_POST['query'];
    if(checkUser($user)==true){
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
        if($username == "jhayB"){
           echo json_encode(1);
        } else {
          echo json_encode(2);
        }
    } 
    else 
    {
        echo json_encode(3);
    }
}else if(isset($_POST['action']) && $_POST['action'] == "approval_list" ){
    usersList("");
}
?>
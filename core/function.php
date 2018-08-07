<?php
include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
function getrecords($message,$type=null)
{
        $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT * FROM credits");
        $get->execute();
        $result = $get->get_result();
            while($r=$result->fetch_array()) 
            {
            $response_data = $response_data .'
                      <tr>
                        <td>'.$r[1].'</td>
                        <th scope="row">'.$r[2].'</th>
                        <td>'.$r[3].'</td>
                        <td>'.$r[4].'</td>
                      </tr>';   
            }
        $response ="";
        if(strlen($message) > 4 && $type =="success"){
            $response .= '<div class="alert alert-success" role="alert">'.$message.'</div>';
        } 
        if(strlen($message) > 4 && $type==null){
            $response .= '<div class="alert alert-danger" role="alert">'.$message.'</div>';
        }
        $response = $response .'
                    <table class="table">
                     <thead class="thead-light">
                        <tr>
                          <th scope="col">Username</th>
                          <th scope="col">Available Credits</th>
                          <th scope="col">Added on</th>
                          <th scope="col">Added By</th>
                        </tr>
                      </thead>
                      ';
        $response .= $response_data;
        $response .= '</table>';
        echo $response;  
    $result->free_result();
     $GLOBALS['db']->close();
}
function usersList($message)
{
        $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT username, account_no,email,approved,created_at FROM users WHERE approved = false");
        $get->execute();
        $result = $get->get_result();
            while($r=$result->fetch_array()) 
            {
                $usr =  "'".$r[0]."'";
            $response_data = $response_data .'
                      <tr>
                        <td>'.$r[0].'</td>
                        <th scope="row">'.$r[1].'</th>
                        <td>'.$r[2].'</td>
                        <td>'.$r[3].'</td>
                        <td>'.$r[4].'</td>
                        <td>
                        <button onclick="userApprove('.$usr.')" class="btn btn-success">approve</button>
                        <button onclick="userApprove('.$usr.')" class="btn btn-danger">decline</button>
                        </td>
                      </tr>';   
            }
        $response ="";
        if(strlen($message) > 4 && $type =="success"){
            $response .= '<div class="alert alert-success" role="alert">'.$message.'</div>';
        } 
        if(strlen($message) > 4){
            $response .= '<div class="alert alert-danger" role="alert">'.$message.'</div>';
        }
        $response = $response .'
                    <table class="table">
                     <thead class="thead-light">
                        <tr>
                          <th scope="col">Username</th>
                          <th scope="col">Account</th>
                          <th scope="col">Email</th>
                          <th scope="col">type</th>
                          <th scope="col">Signup date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      ';
        $response .= $response_data;
        $response .= '</table>';
        echo $response;  
    $result->free_result();
     $GLOBALS['db']->close();
}
function getmyCredits($user)
{
        $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT username, available_credits FROM credits WHERE username = ?");
        $get->bind_param("s",$user);
        $get->execute();
        $result = $get->get_result();
        $credits = $result->fetch_assoc();
        $credits = $credits['available_credits'];
        echo $response = '<h1 class="display-4" style="font-family:impact;color:green">'.$credits.' Php</h1>';
            $result->free_result();
             $GLOBALS['db']->close();
}
function getmyHistory($user)
{
    $count=0;
        $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT * FROM topup_history WHERE username = ?");
        $get->bind_param("s",$user);
        $get->execute();
        $result = $get->get_result();
            while($r=$result->fetch_array()) 
            {
            $count++;
            $response_data = $response_data .'
                      <tr>
                        <td>'.$r[2].'</td>
                        <td>'.$r[3].'</td>
                        <td>'.$r[4].'</td>
                      </tr>';   
            }
    if($count<=0){
        $response_data = '<tr><td colspan="4"> <div class="alert alert-warning">NO RECORDS FOUND </div></td></tr>';
    }
        $response ="";
        $response = $response .'
                    <table class="table">
                     <thead class="thead-light">
                        <tr>
                          <th scope="col">Amount</th>
                          <th scope="col">Date </th>
                          <th scope="col">By</th>
                        </tr>
                      </thead>
                      ';
        $response .= $response_data;
        $response .= '</table>';
        echo $response;  
    $result->free_result();
     $GLOBALS['db']->close();
}
function getHistory()
{
        $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT * FROM topup_history");
        $get->execute();
        $result = $get->get_result();
            while($r=$result->fetch_array()) 
            {
            $response_data = $response_data .'
                      <tr>
                        <td>'.$r[1].'</td>
                        <td>'.$r[2].'</td>
                        <td>'.$r[3].'</td>
                        <td>'.$r[4].'</td>
                      </tr>';   
            }
        $response ="";
        $response = $response .'
                    <table class="table">
                     <thead class="thead-light">
                        <tr>
                          <th scope="col">Username</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Date deposit</th>
                          <th scope="col">Added By</th>
                        </tr>
                      </thead>
                      ';
        $response .= $response_data;
        $response .= '</table>';
        echo $response;  
    $result->free_result();
     $GLOBALS['db']->close();
}

function topUp($user, $amount)
{
    if($user == "" || $amount < 4)
    {
        getrecords("Something went wrong with your request. You're trying to submit invalid/blank form.");
        exit();
    } else {
        if(checkUser($user) ==false)
        {
            getrecords("The username is invalid or dont have an account yet.");
            exit();
        } else {
              session_start();
                 $data1 =$user;
                $data2 =(int)$amount;
                $data3 = "admin-".$_SESSION['username'];
                $insert = $GLOBALS['db']->prepare("INSERT INTO topup_history(username,amount,added_by) VALUES(?,?,?)");
                $insert->bind_param("sis",$data1,$data2,$data3);
                if($insert->execute()){    
                    $update = $GLOBALS['db']->prepare("UPDATE credits SET available_credits= available_credits + ?, added_by = ? WHERE username = ?");
                    $update->bind_param("iss",$data2,$data3,$data1);
                    if ($update->execute()) {   
                        getrecords("You have successfully topup $data2 to $data1","success");
                    } else {
                         getrecords("Something went wrong with your request. Try again.");
                    }

                } else {
                    getrecords("Something went wrong with your request. Could not add credit");
                }
        }
    }  
}

function signUp($username, $studnum, $email, $password_)
{
     $sign = $GLOBALS['db']->prepare("INSERT INTO users(username,account_no,email,password) VALUES(?,?,?,?)");
    $sign->bind_param("siss",$username, $studnum, $email, $password_);
    $sign->execute();
    $again =  $GLOBALS['db']->prepare("INSERT INTO credits(username) VALUES(?)");
    $again->bind_param("s",$username);
    $again->execute();
    header('location:index.php?notice=signup_success&user='.$username);
    $GLOBALS['db']->close();
}

function Auth($user,$pass)
{
    
    $auth = $GLOBALS['db']->prepare("SELECT username, password, approved FROM users WHERE username = ? LIMIT 0,1");
    $auth->bind_param("s",$user);
    $auth->execute();
    $res = $auth->get_result();
    $rec = $res->fetch_assoc();
    $userdb = $rec['username'];
    if(password_verify($pass,$rec['password']) && $user==$userdb)
    {
        session_start();
        $_SESSION['username'] = $user;
        $_SESSION['token'] = "12345";
        $_SESSION['approved'] = $rec['approved'];   
        return true;
    }
    else 
    {
        return false;
    }
}

function isLogin()
{
    session_start();
    if(isset($_SESSION['username']) && $_SESSION['token'])
    {
       if(checkUser($_SESSION['username']) == true)
       {
           return true;
       } else {
           return false;
       }
    } else {
        return false;
    }
}

function recordLog($user,$activity)
{
    
}

function checkUser($username)
{
    $ch= $GLOBALS['db']->prepare("SELECT count(username) as count FROM users WHERE username = ?");
    $ch->bind_param("s",$username);
    if($ch->execute()){
        $res=$ch->get_result();
        $c= $res->fetch_assoc();
        $count = $c['count'];
        if($count >= 1){
            return true; //user exist
        } else {
        return false; // user not exist
        }
    }
    $c->free_result();
   $GLOBALS['db']->close();
}
?>			
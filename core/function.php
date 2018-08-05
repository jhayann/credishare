<?php
include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
function getrecords($message)
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
        if(strlen($message) > 4){
        $response .= '<div class="alert alert-success" role="alert">'.$message.'</div>';
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
    
    $data1 =$user;
    $data2 =(int)$amount;
    $data3 ="admin";
    $insert = $GLOBALS['db']->prepare("INSERT INTO topup_history(username,amount,added_by) VALUES(?,?,?)");
    $insert->bind_param("sis",$data1,$data2,$data3);
    if($insert->execute()){    
        $update = $GLOBALS['db']->prepare("UPDATE credits SET available_credits = available_credits + ? WHERE username = ?");
        $update->bind_param("is",$data2,$data1);
        if ($update->execute()) {   
            getrecords("You have successfully topup $data2 to $data1");
        } else {
             getrecords("Something went wrong with your request");
        }
    
    } else {
        getrecords("Something went wrong with your request");
    }
    
}

function signUp($username, $studnum, $email, $password_)
{
     $sign = $GLOBALS['db']->prepare("INSERT INTO users(username,account_no,email,password) VALUES(?,?,?,?)");
    $sign->bind_param("siss",$username, $studnum, $email, $password_);
    $sign->execute();
    header('location:../credits/index.php?notice=signup_success&user='.$username);
    $GLOBALS['db']->close();
}

function Auth($user,$pass)
{
    
    $auth = $GLOBALS['db']->prepare("SELECT username, password FROM users WHERE username = ? LIMIT 0,1");
    $auth->bind_param("s",$user);
    $auth->execute();
    $res = $auth->get_result();
    $rec = $res->fetch_assoc();
    $userdb = $rec['username'];
    if(password_verify($pass,$rec['password']) && $user==$userdb)
    {
        return true;
    }
    else 
    {
        return false;
    }
}

function recordLog()
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
            return false;
        } else {
        return true;
        }
    }   
}
?>
<?php

include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
           $response_data="";
        $get = $GLOBALS['db']->prepare("SELECT username, account_no,email,approved FROM users WHERE approved = false");
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
                        <td><button onclick="userApprove('.$usr.')" class="btn btn-success">approve</button></td>
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
                        </tr>
                      </thead>
                      ';
        $response .= $response_data;
        $response .= '</table>';
        echo $response;  
    $result->free_result();
     $GLOBALS['db']->close();
?>
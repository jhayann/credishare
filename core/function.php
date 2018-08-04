<?php
include_once('db.class.php');
$database = new Database();
$db = $database->getConnection();
function getrecords()
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
        $response .= '</table><button onclick="thisFunction()">clickme</button>';
        echo $response;    
}

?>
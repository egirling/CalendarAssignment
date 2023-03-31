<?php
require 'database.php';
global $connection;
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input'); 
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$monthName = htmlentities($json_obj['monthName']);
$year = htmlentities($json_obj['year']);
if(isset($json_obj['userId'])){
$user = htmlentities($json_obj['userId']);
}
if(isset($json_obj['token'])){
$token = htmlentities($json_obj['token']);
}
//echo "user " .$user;
//echo "token " .$token;
if(isset($user)&&isset($token)){
$stmt = $connection->prepare("select eventName, month, hour, minute, ampm, day, tag FROM events WHERE userId = ? and year = ? and month = ?"); 
session_start();
$stmt->bind_param('iis', $user,$year, $monthName);
$worked = $stmt->execute();
//$stmt->bind_result($hour, $minute, $ampm, $day);
$result = $stmt->get_result();
$stmt->fetch();
$stmt->close();

if($worked){
    
    //prints out the title, body, link, and likes of the story 
$arrayToSend = array();
 while($row = $result->fetch_assoc()){
    $arrayToSend[] = $row;
}
echo json_encode($arrayToSend);
}
else{
    json_encode(array(
                "success" => false,
                "message" => "Failed to insert"
            ));
            exit;
}




}
else{
    json_encode(array(
                "success" => false,
                "message" => "Failed to insert"
            ));
            exit;
}
    

?>
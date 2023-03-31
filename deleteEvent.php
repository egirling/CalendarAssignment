<?php
require 'database.php';
global $connection;
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
$json_str = file_get_contents('php://input'); 

$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$name = htmlentities($json_obj['eventName']);
// echo("name  ");
// echo($name);
// echo("  after name");
$month = htmlentities($json_obj['month']);

$day = htmlentities($json_obj['day']);
$year = htmlentities($json_obj['year']);
$hour = htmlentities($json_obj['hour']);
$minute = htmlentities($json_obj['minute']);
$ampm = htmlentities($json_obj['ampm']);
$token = htmlentities($json_obj['token']);




if(!hash_equals($_SESSION['token'], $token)){
    if(isset($token)){
        echo json_encode(array(
            "success" => false,
            "message" => 'token not recieved'
        ));
    }
}
else{




if(isset($_SESSION['userId'])){
$stmt2 = $connection->prepare("delete from events where userId = ? and eventName = ? and month = ? and year =? and hour = ? and minute = ? and ampm = ? and day = ?"); 

if (!$stmt2) {
    printf("Query Prep Failed: %s\n", $connection->error);
    exit;
}


$stmt2->bind_param('issiiisi', $_SESSION['userId'], $name, $month, $year, $hour, $minute, $ampm, $day);




if ($stmt2->execute()) { 
    
    echo json_encode(array(
        "success" => true
    ));
    exit;
    } else {
    echo json_encode(array(
        "success" => false,
        "message" => "Failed to insert"
    ));
    exit;
    
    }

}
else{
    echo json_encode(array(
        "success" => false,
        "message" => "cannot add event if not logged in"
    ));
}
}
?>
<?php
require 'database.php';
global $connection;
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
$json_str = file_get_contents('php://input'); 

$json_obj = json_decode($json_str, true);


$name = htmlentities($json_obj['eventName']);

$month = htmlentities($json_obj['month']);

$day = htmlentities($json_obj['day']);
$year = htmlentities($json_obj['year']);
$hour = htmlentities($json_obj['hour']);
$minute = htmlentities($json_obj['minute']);
$ampm = htmlentities($json_obj['ampm']);
$tag = htmlentities(($json_obj['tag']));
$token = htmlentities($json_obj['token']);

if(!hash_equals($_SESSION['token'], $token)){
	die("Request forgery detected");
}




if(isset($_SESSION['userId'])){
$stmt2 = $connection->prepare("insert into events (userId, eventName, month, year, hour, minute, ampm, day, tag) values (?, ?, ?, ?, ?, ?, ?, ?, ?)"); 

if (!$stmt2) {
    printf("Query Prep Failed: %s\n", $connection->error);
    exit;
}


$stmt2->bind_param('issiiisis', $_SESSION['userId'], $name, $month, $year, $hour, $minute, $ampm, $day, $tag);




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
?>
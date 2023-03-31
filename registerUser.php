<?php
require 'database.php';
global $connection;
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json



$json_str = file_get_contents('php://input'); 
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = htmlentities($json_obj['newUsername']);
$password = htmlentities($json_obj['newPassword']);

$passw= password_hash($password, PASSWORD_DEFAULT);


$stmt = $connection->prepare("INSERT INTO users(userName, pass) VALUES (?, ?)"); 

$stmt->bind_param('ss', $username, $passw);


if ($stmt->execute()) { 
    
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



    

?>
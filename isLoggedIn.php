<?php
ini_set("session.cookie_httponly", 1);
session_start();


if(isset($_SESSION['userId'])){
    echo json_encode(array(
        "success" => true, "token" => $_SESSION['token'], "userId" => $_SESSION["userId"]
    ));
    //send back userId, update global variable, call updateCalendar
}
else{
    echo json_encode(array(
        "success" => false
    ));
}




?>
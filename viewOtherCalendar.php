<?php
require 'database.php';
global $connection;
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json
ini_set("session.cookie_httponly", 1);
session_start();


$json_str = file_get_contents('php://input'); 
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$userToView = htmlentities($json_obj['userToView']);
$currentId = htmlentities($json_obj['currentId']);




if(isset($_SESSION['userId'])){
    $stmt2 = $connection->prepare("select userId from users where (userName = ?)");
    if (!$stmt2) {
        printf("Query Prep Failed: %s\n", $connection->error);
        exit;
    }
    $stmt2->bind_param('s', $userToView);
    $stmt2->execute();
    $stmt2->bind_result($otherID);
    $stmt2->fetch();
    $stmt2->close(); 



if(isset($otherID)){
    $stmt = $connection->prepare("Select ownerId from share where sharedId = ?"); 

    $stmt->bind_param('s', $_SESSION['userId']);


    if ($stmt->execute()) { 
            $result = $stmt->get_result();
            $stmt->close();
            $isShared = false;
            //prints out the title, body, link, and likes of the story 
            while($row = $result->fetch_assoc()){
                if($row['ownerId'] == $otherID){
                    $isShared = true;
                }

            }
            if($isShared){
                echo json_encode(array(
                    "newId" => $otherID,
                    "message" => "success"
                ));
            }
            else{
                echo json_encode(array(
                    "newId" => $currentId,
                    "message" => "failed, not shared with you!"
                ));
            }

    
        } 
    else {
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
        "message" => "failed to get id"
    ));

}
}else{
    echo json_encode(array(
        "success" => false,
        "message" => "cannot share event if not logged in"
    ));
}

    

?>
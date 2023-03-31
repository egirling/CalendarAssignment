
<?php

$connection = new mysqli('localhost', 'calendar', 'calendar', 'calendar');

    if ($connection->connect_errno){
        printf("Connection Failed: %s\n", $connection->connect_error);
        exit;
 }
 
 ?>
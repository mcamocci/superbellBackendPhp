<?php

require_once("Database.php");

$database= new Database();
//echo json_encode($database->getPost(0,5));


echo $database->logUser("mediarose@gmail.com",'haikarose');


//echo $database->registerUser('Haikarose','mediarose@gmail.com','haikarose');










?>

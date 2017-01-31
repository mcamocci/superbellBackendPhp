<?php

    require_once("Database.php");

    //do the listing 
    retrievePosts();


    function retrievePosts(){ 
       
        if(isset($_POST['PAGE']) & isset($_POST['COUNT'])){
        
            $page=$_POST['PAGE'];
            $count=$_POST['COUNT'];
            $database= new Database();
            echo json_encode($database->getPost(0,5));
            
         }
         
    }

?>

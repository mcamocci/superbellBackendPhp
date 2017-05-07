<?php
    require_once("Database.php");
    //do the listing
    retrievePosts();
    function retrievePosts(){

        header("Content-type: application/json");
        $database=new Database();
        echo $database->getAllUPloaders();

    }

    //this is just a comment
?>

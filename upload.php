<?php

    require_once("FileHandler.php");

    //perform the task
    uploadTask();


    function uploadTask(){

        if(isset($_POST['USER_ID']) && isset($_POST['CONTENT']) && isset($_POST['RESOUCES'])){
            $user_id=$_POST['USER_ID'];
            $content=$_POST['CONTENT'];
            $resources=$_POST['RESOUCES'];
            FileHandler::doTheUPload($user_id,$content,$resources);
            
            $database=new Database();
            $database->publish($user_id,$content,$resources);        
            
        }

    }


?>

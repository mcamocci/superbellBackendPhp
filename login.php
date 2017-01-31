<?php

    require_once("Database.php");
    
    //the login process is executed//
    prepare();
    
    
    
    function prepare(){
    
        if(isset($_POST['email']) && isset($_POST['email'])){
        
            $email=$_POST['email'];
            $password=$_POST['password'];
        
            $database=new Database();
            echo $database->logUser($email,$password);
             
         }    
    
    }
    
?>

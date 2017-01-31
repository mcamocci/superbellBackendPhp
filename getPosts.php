<?php
    require_once("Database.php");
    //do the listing 
    retrievePosts();
    function retrievePosts(){ 
       
        if(isset($_POST['page']) & isset($_POST['count'])){
        
            $page=$_POST['page'];
            $count=$_POST['count'];
            $database= new Database();
            echo json_encode($database->getPost(page,count));
            
         }
         
    }
?>

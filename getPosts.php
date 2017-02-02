<?php
    require_once("Database.php");
    //do the listing 
    retrievePosts();
    function retrievePosts(){ 
       
        if(isset($_POST['page']) & isset($_POST['count'])){
        
            $page=$_POST['page'];
            $count=$_POST['count'];
            $post= new Post();
            $post->getAllPosts($page,$count);
            header("Content-type: application/json");
            echo json_encode($post->getAllPosts($page,$count));
            
         }
         
    }
?>

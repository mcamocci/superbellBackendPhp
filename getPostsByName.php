<?php

 require_once("Database.php");
    //do the listing 
    retrievePosts();
    function retrievePosts(){ 
       
        if(isset($_POST['page']) && isset($_POST['count']) && isset($_POST['keyword'])){
        
            $page=$_POST['page'];
            $count=$_POST['count'];
            $keyword=$_POST['keyword'];
            $post= new Post();
            $post->getAllPostByUploader($page,$count,$keyword);
            header("Content-type: application/json");
            echo json_encode($post->getAllPosts($page,$count));
            
         }
         
    }


?>

<?php
    require_once("Database.php");
    //do the listing
    retrievePosts();
    function retrievePosts(){

        if(isset($_POST['page']) && isset($_POST['count'])){

            $page=$_POST['page'];
            $count=$_POST['count'];
            $uploader_id=$_POST['UPLOADER_ID'];

            $post= new Post();
            header("Content-type: application/json");
            echo json_encode($post->getAllPosts($page,$count,$uploader_id));

         }

    }

    //this is just a comment
?>

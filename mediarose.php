<?php

require_once("Database.php");
require_once("Post.php");
require_once("Resource.php");
$database= new Database();
//echo json_encode($database->getPost(0,5));


//echo $database->logUser("mediarose@gmail.com",'haikarose');



$posts=array();

for($i=0;$i<8;$i++){
    
    $post=new Post();
    $post->id=1;
    $post->content="oop is the only option emmanuel";
    $post->uploader="Haikarose";
    $post->date="1 jan 1994";
    $resource1=new Resource("type ha","resource me");
    $resource2=new Resource("type ha","resource me");
    $resource3=new Resource("type ha","resource me");    
    $post->resources=array($resource1,$resource2,$resource3);
    
    $posts[]=$post;
  
}
header("Content-type: application/json");
//print_r($posts);
//echo "<br/>";
echo json_encode($posts);





//echo $database->registerUser('Haikarose','mediarose@gmail.com','haikarose');


?>

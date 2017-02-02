<?php

    require_once("FileHandler.php");
    require_once("Post.php");
    require_once("Resource.php");
    

    uploadTask();


    function uploadTask(){    
        
      if(isset($_POST['USER_ID']) && isset($_POST['CONTENT'])){
            
            $post=new Post();
            
            $user_id=$_POST['USER_ID'];
            $content=$_POST['CONTENT']; 
            $database=new Database();        
                 
            if(isset($_POST['RESOUCES'])){  
                  echo "resources set";
                 $resources=$_POST['RESOUCES']; 
                 $resources=FileHandler::doTheUPload($user_id,$content,$resources); 
                 
                 if($resources[0]!=null){
                    $post->publishPostHasResources($user_id,$content,$resources);
                 }
                  
            }else{       
                             
                 echo $post->publishPostNoResource($user_id,$content); 
                              
            }        
            
      } 
         
    }
 

?>

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
                 
            if(isset($_FILES['RESOURCES'])){  
            
                 $resources=$_FILES['RESOURCES']; 
                 $resources=FileHandler::doTheUPload($user_id,$content,$resources); 
                 
                 if($resources!=null){
                                     
                    $post->publishPostHasResources($user_id,$content,$resources);
                    
                 }
                  
            }else{      
            
                
                 $post->publishPostNoResource($user_id,$content); 
                              
            }        
            
      } 
         
    }
 
?>

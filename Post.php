<?php

    require_once("Database.php");
    require_once("Resource.php");
    

    class Post{
    
        public $uploader;
        public $id;
        public $date;
        public $content;
        public $resources=array();
        
        //this function is for the loading the post for certain page and number of posts
        public function getAllPosts($page,$total){  
        
                $database=new Database();
                $connection=$database->connection;
                
                $querry="SELECT post.id as id ,post.content,post.date,uploader.name FROM post INNER JOIN uploader
                ON post.poster_id=uploader.id ORDER BY post.date DESC LIMIT $page,$total;";   
                                  
                $resultset=$connection->query($querry);            
                $posts;
                            
                while($row=mysqli_fetch_assoc($resultset)){ 
                
                       $post=new Post();
                       $post->id=$row['id'];
                       $post->content=$row['content'];
                       $post->uploader=$row['name'];
                       $post->date=$row['date'];       
                                                
                       $querryTwo="SELECT type , url FROM resource where resource.post_id=$row[id];";
                       $secondResultSet=$connection->query($querryTwo);
                                          
                       $resources=array();
                                          
                       while($rowOne=mysqli_fetch_assoc($secondResultSet)){ 
                            $resources[]=new Resource($rowOne['type'],$rowOne['url']);
                        }  
                        
                        $post->resources=$resources; 
                        $posts[]=$post;                                
                         
                }
                
                return $posts;    
        }
        
        
          public function publishPostNoResource($user_id,$content){      
                
             $database=new Database();
             $connection=$database->connection;
             $sql="INSERT INTO post(poster_id,content) VALUES ('$user_id','$content')";
             
             if($connection->query($sql)){
             
                return 1;
                
             }else{
             
                return 0;
                
             }
             
          }
          
            public function publishPostHasResources($user_id,$content,$resources){      
                
             $database=new Database();
             $connection=$database->connection;
             $sql="INSERT INTO post(poster_id,content) VALUES ('$user_id','$content')";
             
             if($connection->query($sql)){
                          
                    foreach($resources as $resource){
                        $sql="INSERT INTO resource(post_id,type,url) VALUES ('$post_id','$resource->$type','$resource->$url')";
                        $connection->query($sql);
                    }                    
                    return 1;
                                    
             }else{
             
                    return 0;
                
             }
             
          }
        
                
    }
    
    
  


?>

<?php

class Database{


    var $connection;

    function __construct($host="localhost",$username="ville-user",$password="haikarose",$database="MediaroseDb"){    
        $this->connection=new mysqli($host,$username,$password,$database);            
    }
    
      
    
    //this function is for the book searching process
    public function getPost($page,$total){  
          
            $querry="SELECT post.id,post.content,resource.url as resource ,
            resource.type as type,post.date,uploader.name FROM post JOIN uploader 
            ON post.poster_id=uploader.id JOIN resource ON resource.post_id=post.id ORDER BY post.date DESC LIMIT $page,$total;";   
                              
            $resultset=$this->connection->query($querry);            
            $posts;
            
            while($row=$resultset->fetch_assoc()){                
                    $posts[]=$row;            
            }
            
            return $posts;    
    }
    
    
    //this function is for login the media user//
    
    public function logUser($username,$password){
            
            $querry="SELECT * FROM U";
    
    }
    
}




    



?>

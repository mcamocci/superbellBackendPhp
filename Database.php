<?php

class Database{


    var $connection;

    function __construct($host="localhost",$username="root",$password="haikarose",$database="mediaroseDb"){    
        $this->connection=new mysqli($host,$username,$password,$database);            
    }
    
      
    
    //this function is for the loading the post for certain page and number of posts
    public function getPost($page,$total){  
          
            $querry="SELECT post.id,post.content,post.date,uploader.name FROM uploader JOIN post
            ON post.poster_id=uploader.id ORDER BY post.date DESC LIMIT $page,$total;";   
                              
            $resultset=$this->connection->query($querry);            
            $posts;
            
            
            while($row=$resultset->fetch_assoc()){ 
                           
                    $posts[]=$row;       
                    
                    $querryTwo="SELECT type , url FROM resource where resource.post_id=$row[id]";
                    $secondResultSet=$this->connection->query($querryTwo);
                    
                    while($rowOne=$secondResultSet->fetch_assoc()){
                    
                        $posts[$row['id']]["resources"][] =array("type"=>$rowOne['type'],"url"=>$rowOne['url']);
                        
                    } 
                     
            }
            
            return $posts;    
    }
    
    
    //this function is for login the media user//
    
    public function logUser($email,$password){
            
            $querry="SELECT id , password FROM uploader WHERE uploader.email='$email'";
            $resultSet=$this->connection->query($querry);
            
            while($row=$resultSet->fetch_assoc()){                
                 if(password_verify($password,$row['password'])){
                        return $row['id'];
                  }else{
                        return "0";
                  }                
            }            
            return 0;    
    }
    
     //this function is for the user registration in the database    
    public function registerUser($name,$email,$password){   
             
           $hashed_password=password_hash($password,PASSWORD_DEFAULT);;  
           $querrySave="INSERT INTO uploader(name,email,password) values('$name','$email','$hashed_password')";           
           $resultSet=$this->connection->query($querrySave);
         
           if($resultSet){
                return 1;             
           }else{
                return 0;           
           }
           
    }
    
    //this function is for the user registration in the database    
    public function registerUser($name,$email,$password){   
             
           $hashed_password=password_hash($password,PASSWORD_DEFAULT);;  
           $querrySave="INSERT INTO uploader(name,email,password) VALUES ('$name','$email','$hashed_password')";           
           $resultSet=$this->connection->query($querrySave);
         
           if($resultSet){
                return 1;             
           }else{
                return 0;           
           }
           
    }
    
    
    //this for publishing the post from the medial   
    public function publish($user_id,$content,$resources){   
             
             $sql="INSERT INTO post(content,poster_id) VALUES ('$content','$user_id')";
             $result=$this->connection->query($sql);
             if(result){
                    
                    if($resources){
                            
                            $sql="SELECT id FROM post where uploader_id='$user_id' ORDER BY date DESC LIMIT 1";
                            $result=$this->connection->query($sql);
                                
                            while($row=$result->fetch_assoc()){
                                     
                                     foreach($resources as $resource){
                                            $this->$insertResource($row['id'],$resource);
                                     }
                            }                    
                    }
                      
             
             }
          
           
    }    
    
    //adding files to a post
    public void insertResource($id,$value){
        $sql="INSERT INTO resource values(post_id,url) VALUES('$id','$value')";
        $this->connection->query($sql);        
    }
    
    
}




    



?>

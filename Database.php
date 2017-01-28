<?php

class Database{


    var $connection;

    function __construct($host="localhost",$username="root",$password="haikarose",$database="superbell"){    
        $this->connection=new mysqli($host,$username,$password,$database);            
    }
    
      
    
    //this function is for the book searching process
    public function Post($keyword){
        
            $querry="SELECT Book.id,Book.title,Book.copy_count AS count,CONCAT(Author.firstName,
            CONCAT(' ',Author.lastName)) AS author FROM  Author JOIN Book ON
                     Book.author=Author.id AND Author.lastName LIKE '%$keyword%' 
                     OR Author.firstName LIKE '%$keyword%' OR Book.title LIKE '%$keyword';";   
                              
            $resultset=$this->connection->query($querry);            
            $posts;
            
            while($row=$resultset->fetch_assoc()){                
                    $posts[]=$row;            
            }
            
            return $books;
    
    }
}




    



?>

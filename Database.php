<?php

require_once("Post.php");
require_once("Resource.php");

class Database{

  /*  foreach($values as $key=>$value){
        echo $value;
    }

echo 1;*/

    public $connection;

    function __construct($host="localhost",$username="root",$password="haikarose",$database="mediaroseDb"){

        $this->connection=new mysqli($host,$username,$password,$database);

    }

    //this function is for login the media user//
    public function logUser($email,$password){

            $querry="SELECT id , password FROM uploader WHERE uploader.email='$email'";
            $resultSet=$this->connection->query($querry);

            while($row=$resultSet->fetch_assoc()){

                 if(password_verify($password,$row['password'])){

                        return $row['id'];

                  }else{

                        return 0;
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

    //adding files to a post
    public function insertResource($id,$value){

        $sql="INSERT INTO resource values(post_id,url) VALUES('$id','$value')";
        $this->connection->query($sql);

    }


}








?>

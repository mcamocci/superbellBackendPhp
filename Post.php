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
        public function getAllPosts($page,$total,$uploader_id){

                $database=new Database();
                $connection=$database->connection;

                $querry="SELECT post.id as id ,post.content,post.date,uploader.name FROM post INNER JOIN uploader
                ON post.poster_id=uploader.id WHERE post.poster_id='$uploader_id' ORDER BY post.date DESC LIMIT $page,$total;";

                $resultset=$connection->query($querry);
                $posts=array();

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

        //this function is for the loading the post for certain page and number of posts
        public function getAllPostByUploader($page,$count,$keyword){

                $database=new Database();
                $connection=$database->connection;

                $keyword=mysqli_real_escape_string($connection,$keyword);

                $querry="SELECT post.id as id ,post.content,post.date,uploader.name as name FROM post INNER JOIN uploader
                ON post.poster_id=uploader.id WHERE uploader.name LIKE '".$keyword."%' ORDER BY post.date DESC LIMIT $page,$count;";


                $resultset=$connection->query($querry);
                $posts=array();

                while($row=$resultset->fetch_assoc()){

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

             $user_id=mysqli_real_escape_string($connection,$user_id);
             $content=mysqli_real_escape_string($connection,$content);

             $sql="INSERT INTO post(poster_id,content) VALUES ('$user_id','$content');";

             echo $sql;

             if($connection->query($sql)){

                return 1;

             }else{

                echo "failed here apa";

                return 0;

             }

          }

            public function publishPostHasResources($user_id,$content,$resources){

             $database=new Database();
             $connection=$database->connection;

             $user_id=mysqli_real_escape_string($connection,$user_id);
             $content=mysqli_real_escape_string($connection,$content);

             $sql="INSERT INTO post(poster_id,content) VALUES ('$user_id','$content')";


             if($connection->query($sql)){

                    $sqlId="SELECT post.id FROM post WHERE post.poster_id='$user_id'  ORDER BY post.id DESC LIMIT 1;";
                    $resultset=$connection->query($sqlId);

                    while($row=$resultset->fetch_assoc()){

                        $post_id=$row['id'];

                        foreach($resources as $resource){

                            $sqlInsertResource="INSERT INTO resource(post_id,type,url) VALUES ('$post_id','$resource->type','$resource->url')";
                            $connection->query($sqlInsertResource);

                        }
                    }

                    return 1;

             }else{

                    return 0;

             }

          }


    }





?>

<?php 

    require_once("Database.php");

    class FileHandler{
    
            public static function doTheUPload($user_id,$content,$resources){
            
                $resourcesList=array();
                $fileCount=count($_FILE['FILES']['name']);
                $files=$_FILE['FILES'];
                
                $database=new Database();
                
                $directorPath="/mediaUploads/";
                $directorPath=$directorPath.basename($_FILES['file']['name']);
                
                if($file_count>0){              
                      
                        foreach($files as $file){
                        
                             $resource=new Resource();
                             $directorPath=$directorPath.basename($file['name']); 
                                                
                             if(move_uploaded_file($file['tmp_name'],$directoryPath)){
                             
                                     //insert the url to the database.                                      
                                   $ext = pathinfo($file, PATHINFO_EXTENSION);                           
                                   $this->insertFileInfo($ext,$directoryPath);                                     
                                   $resource->$type=$ext;
                                   $resource->$url=$directorPath;    
                                                            
                              }
                              
                             $resourcesList[]=$resource; 
                                                       
                        }                
                        
                }                  
                
                return $resourcesList;         
                
            }
            
            public static function insertFileInfo($type,$url){       
                 
                    $database=new Database();
                    $database->publish($user_id,$content,$resources);
                            $database->insertFileInfo($type,$url);  
                                  
            }


    }
?>

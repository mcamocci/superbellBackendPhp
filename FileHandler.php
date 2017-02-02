<?php 

    require_once("Database.php");
    require_once("Settings.php");

    class FileHandler{
    
            public static function doTheUPload($user_id,$content,$resources){
            
                $resourcesList=array();
                $fileCount=count($resources['name']);
                
                $files=$resources;
                
                $database=new Database();  
                  
                $directoryPath=Setting::$FILE_DIRECTORY;
                                
                if($fileCount>0){              
                      
                       $resource=null;
                       
                       for($i=0;$i<$fileCount;$i++){
                       
                           
                             $directoryPath.=$resources['name'][$i];
                         
                                                
                             if(move_uploaded_file($resources['tmp_name'][$i],$directoryPath)){                             
                             
                                   //insert the url to the database.                                      
                                   $ext = pathinfo($resources['name'][$i], PATHINFO_EXTENSION);                                   
                                   $resource=new Resource(
                                   pathinfo($resources['name'][$i], PATHINFO_EXTENSION),Setting::$DIRECTORY_NAME.$directoryPath);
                                                                      
                                                                                        
                              }else{          
                              
                                                    
                                    return null; 
                                                                 
                              }
                              
                             $resourcesList[]=$resource;                       
                       }
                       
                }         
                
                
                return $resourcesList;         
                
            }
            


    }
?>

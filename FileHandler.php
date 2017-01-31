<?php 


require_once("Database.php");



class FileHandler{

    
        public static void doTheUPload(){
        
            $fileCount=count($_FILE['FILES']['name']);
            $files=$_FILE['FILES'];
            
            $directorPath=$directorPath.basename($_FILES['file']['name']);
            
            if($file_count>0){
                
                    foreach($files as $file){
                        if(){
                                                
                             $directorPath=$directorPath.basename($file['name']);                    
                             if(move_uploaded_file($file['tmp_name'],$directoryPath){
                                 //insert the url to the database. 
                                 $ext = pathinfo($file, PATHINFO_EXTENSION);                           
                                 $this->insertFileInfo($ext,$directoryPath)
                             }                       
                        
                        }
                       
                    }
            
            }            
            
        }
        
        public static void insertFileInfo($type,$url){            
                $database=new Database();
                $database->insertFileInfo($type,$url);        
        }


}
?>

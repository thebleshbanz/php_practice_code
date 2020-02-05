<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $path = "/opt/lampp/htdocs/practice_php/php_code_excution/upload/";
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
	{

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        
        // Verify file size - 1MB maximum
        $maxsize = 1 * 1024 * 1024;
        
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");    
        
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists($path.$_FILES["photo"]["name"])){
                die("Error : ". $_FILES["photo"]["name"] . " is already exists.");
            }else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], $path.$_FILES["photo"]["name"]);
                echo "Your file was uploaded successfully.";
            } 
        }else{
            die("Error: Please select a valid file format.");
        }
    } else{
        echo "please select any image";
    }
}
?>
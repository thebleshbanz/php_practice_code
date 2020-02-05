<?php
if(isset($_POST['submit']))
{
	if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
	{
    	$target_dir  = "/opt/lampp/htdocs/practice_php/php_code_excution/upload/";
    	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $allowed    = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename   = $_FILES["photo"]["name"];
        $filetype   = $_FILES["photo"]["type"];
        $filesize   = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize =  1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed))
		{
            // Check whether file exists before uploading it
            if(file_exists($target_dir.$_FILES["photo"]["name"]))
			{
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else
			{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "$target_dir".$_FILES["photo"]["name"]);
                echo "Your file was uploaded successfully.";
            } 
        } else
		{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
    </form>
</body>
</html>
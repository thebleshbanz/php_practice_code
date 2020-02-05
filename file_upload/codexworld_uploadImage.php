<?php
/**
*
* Author: CodexWorld
* Function Name: cwUpload()
* $field_name => Input file field name.
* $target_folder => Folder path where the image will be uploaded.
* $file_name => Custom thumbnail image name. Leave blank for default image name.
* $thumb => TRUE for create thumbnail. FALSE for only upload image.
* $thumb_folder => Folder path where the thumbnail will be stored.
* $thumb_width => Thumbnail width.
* $thumb_height => Thumbnail height.
*
**/
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = '')
{
    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
	
    $file_ext = pathinfo($_FILES[$field_name]['name'], PATHINFO_EXTENSION);//TO get file extension
	//echo $file_ext;die;
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName); // "/opt/lampp/htdocs/practice_php/php_code_excution/upload/filename.jpeg"
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext)
			{
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}

?>
<?php
if(!empty($_FILES['image']['name']))
{
    $image = 'image';
    $target_folder = "/opt/lampp/htdocs/practice_php/php_code_excution/upload/";
    $file_name = "";
    $thumb = TRUE;  // for create thumbnail. FALSE for only upload image.
    $thumb_folder   = "/opt/lampp/htdocs/practice_php/php_code_excution/upload/thumb/";
    $thumb_width    = "500";
    $thumb_height   = "300";

    //call thumbnail creation function and store thumbnail name
    $upload_img = cwUpload($image, $target_folder,'',TRUE, $thumb_folder, $thumb_width, $thumb_height);
    
    //full path of the thumbnail image
    $thumb_src = '$thumb_folder'.$upload_img;
    
    //set success and error messages
    $message = $upload_img ? "<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";
    
}else{
    //if form is not submitted, below variable should be blank
    $thumb_src = '';
    $message = '';
}
?>

<html>
    <body>

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image"/>
            <input type="submit" name="submit" value="Upload"/>
        </form>
    
        <?php if($thumb_src != ''){ ?>
            <h1>Image thumb display:</h1> 
            <img src="<?php echo $thumb_src; ?>" alt="image">
        <?php } ?>

    </body>
</html>
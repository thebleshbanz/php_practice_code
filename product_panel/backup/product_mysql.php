<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
session_start();
function dbconn()
{
	$host="localhost";
	$username="root";
	$password="";
	$dbname="product_panel";
    @mysql_connect($host,$username,$password) or die(mysql_error());
    $result = @mysql_select_db($dbname);
}

function login($value)
{
	$email = isset($value['email'])?$value['email']:'';
	$password = isset($value['password'])?$value['password']:'';
	$md5pw = md5($password);
	$sql ="SELECT * FROM register WHERE email = '$email' AND password = '$md5pw' ";
	$result = mysql_query($sql) or die('invalid Query'.mysql_error());
	$array = mysql_fetch_assoc($result);
	//echo"<pre>"; print_r($array);die();
	if (!empty($result)) 
	{
		$_SESSION['customer_id'] = $array['customer_id'];
		$_SESSION['usertype']=$array['usertype'];
		return $array;
	}
}

function main_dashboard()
{
	$total_quantity="";
	$total_sale="";
	$remaining="";
	$sql =mysql_query("SELECT * FROM product_add") or die("Invalid Query  ".mysql_error());
	while($row=mysql_fetch_assoc($sql))
	{
?>	<tr>
		<td><input type="checkbox" class="checkthis" /></td>
		<td><?php echo $row['id'];?></td>
		<td><?php echo $row['name'];?></td>
		<td><?php echo $row['description'];?></td>
		<td ><img src="<?php echo "http://localhost/practice_php/product_panel/uploads/".$row['image']; ?>" alt="img" width="200" height="125"</td>
		<td><?php $res = total_quantity($row); echo $TQ= intval(implode('',$res));?></td>
		<td><?php $res = total_sale($row); echo $TS = intval(implode('',$res));?></td>
		<td><?php echo $remain = $TQ-$TS;?></td>
		<td><?php $res =last_update($row); echo implode('',$res); ?></td>
		<td><a href="product_history.php?product_id=<?php echo $row['id'];?>">View</a></td>
		<td>
		<form method="post" action="edit_product.php">
			<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
			<input class="btn btn-info" type="submit" name="edit_product" value="Edit">
		</form>
		</td>
		<td>
		<form method="post" action="delete_product.php">
			<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
			<input class="btn btn-danger" type="submit" name="delete_product" value="Delete">
		</form>
		</td>
	</tr>
<?php		
	}
}

function total_quantity($value)
{
	//echo "product_id ".$value['id'];
	$id=$value['id'];
	$sql = mysql_query("SELECT SUM(quantity) FROM stock WHERE product_id='$id' ");
	$row=mysql_fetch_assoc($sql);
	return $row;
}
function total_sale($value)
{
	//echo "product_id ".$value['id'];
	$id=$value['id'];
	$sql = mysql_query("SELECT SUM(quantity) FROM purchase WHERE product_id='$id' ");
	$row=mysql_fetch_assoc($sql);
	return $row;
}
function last_update($value)
{
	$id=$value['id'];
	$sql = mysql_query("SELECT date(date) FROM stock WHERE product_id='$id' ORDER BY date DESC ") or die("MYSQL ERROR ".mysql_error() );
	$row = mysql_fetch_assoc($sql);
	return $row;
}

function register_value($value)
{
	$first_name= isset($value['first_name'])?$value['first_name']:'';
	$last_name= isset($value['last_name'])?$value['last_name']:'';
	$email= isset($value['email'])?$value['email']:'';
	$mobile= isset($value['mobile'])?$value['mobile']:'';
	$password= isset($value['password'])?$value['password']:'';
	$md5pw =  md5($password);
	$current_date = date("Y-m-d H:i:s");
	
	$insert = mysql_query("INSERT INTO register (`first_name`,`last_name`, `email`,`mobile`,  
		`password`,`date`)VALUES ('$first_name','$last_name','$email','$mobile','$md5pw',
		'$current_date')") or die('Invalid Query'.mysql_error());
	return $insert;
}


function add_product($value)
{
	$product_nm= isset($value['product_nm'])?$value['product_nm']:'';
	$desc= isset($value['desc'])?$value['desc']:'';
	$image= isset($value["photo"])?$value["photo"]:'';
	$insert_info = "INSERT INTO product_add (`name`,`description`,`image`)
					VALUES ('$product_nm','$desc', '$image')";
	$sql = mysql_query($insert_info);
	return $sql;
}

function get_products()
{
	$query = "SELECT id, name from product_add ORDER BY name asc";
	$sql = mysql_query($query) or die("Querry ERROR->> ".mysql_error());
	//$result = mysql_fetch_assoc($sql);
	while($row=mysql_fetch_assoc($sql))
	{
	?>
		<option value="<?php echo $row['id']; ?>"><?php echo $row['id']."-".$row['name']; ?></option>
<?php	
	}
}
function get_product($value)
{
	$id=isset($value['product_id'])?$value['product_id']:'';
	$query="SELECT * FROM product_add WHERE id='$id' ";
	$sql = mysql_query($query) or die("MYSQL ERROR ".mysql_error());
	$row = mysql_fetch_assoc($sql);
	//echo "<pre>";print_r($row);die;
	return $row;
}

function edit_product($value)
{
	//echo "<pre>";print_r($value);die;
	extract($value);
	$query="UPDATE product_add SET name='$product_nm',description='$desc' WHERE id='$product_id' ";
	$sql = mysql_query($query) or die("MYSQL ERROR".mysql_error() ) ;
	return $sql;
}
function delete_product($value)
{
	$product_id=$value['product_id'];
	$query="DELETE FROM product_add WHERE id='$product_id' ";
	$sql = mysql_query($query) or die("MYSQL ERROR->".mysql_error());
	if(!empty($sql))
	{
		header('Location:dashboard.php');
	}
}
function display_data($value)
{
	$query = "SELECT * FROM product_add JOIN stock ON (stock.product_id=product_add.id) WHERE product_id='$value'";
	//echo $query;die;
	$sql = mysql_query($query);
	$row=mysql_fetch_assoc($sql);
	return $row;
}

function history($value)
{
	$id = $value['product_id'];
	$query = "SELECT * FROM stock JOIN product_add ON (stock.product_id=product_add.id) WHERE product_id='$id'";
	//echo $query;die;
	$sql = mysql_query($query) or die("MYSQL ERROR-> ".mysql_error());
	while($row=mysql_fetch_assoc($sql))
	{
?>	  <tr>
        <td><?php echo $row['count']?></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['quantity']?></td>
		<td><?php echo $row['rate']?></td>
		<td><?php echo $row['color']?></td>
		<td><?php echo date($row['date'])?></td>
		<td>
		<form method="post" action="edit_stock.php">
			<input type="hidden" name="stock_id" value="<?php echo $row['count']; ?>">
			<input class="btn btn-info" type="submit" name="edit_history" value="Edit">
		</form>
		</td>
		<td>
		<form method="post" action="delete_stock.php">
			<input type="hidden" name="stock_id" value="<?php echo $row['count']; ?>">
			<input class="btn btn-danger" type="submit" name="delete_history" value="Delete">
		</form>
		</td>
      </tr>
<?php	
	}	
}

function add_stock($value)
{
	$product_id=isset($value['select_product'])?$value['select_product']:'';
	$quantity= isset($value['quantity'])?$value['quantity']:'';
	$rate= isset($value['rate'])?$value['rate']:'';
	$color= isset($value['color'])?$value['color']:'';
	$date = date("Y-m-d H:i:s");
	$sql="INSERT INTO stock (`product_id`, `quantity`, `rate`,`color`,`date`)VALUES ('$product_id','$quantity', '$rate','$color','$date')";
	//echo $sql;die;
	$insert_stock = mysql_query($sql) 
		or die('Invalid Query'.mysql_error());
	return $insert_stock;
}
function get_stock($value)
{
	$id=$value;//echo $id;die;
	$query="SELECT * FROM stock JOIN product_add ON (stock.product_id=product_add.id) WHERE count='$id'";
	//echo $query;die;
	$sql=mysql_query($query) or die("MYSQL ERROR_>".mysql_error());
	$row=mysql_fetch_assoc($sql);
	//echo "<pre>";print_r($row);die;
	return $row;
}
function edit_stock($value)
{
	extract($value);
	$query="UPDATE stock SET quantity=$quantity,rate=$rate,color=$color WHERE count = $stock_id ";
	//echo $query;die;
	$sql = mysql_query($query) or die("MYSQL ERROR-> ".mysql_error());
	//echo "<pre>";print_r($value);die;
	return $sql;
}

function delete_stock($value)
{
	//echo"<pre>";print_r($value);die;
	$stock_id=$value['stock_id'];
	$query="DELETE FROM stock WHERE count='$stock_id' ";
	$sql = mysql_query($query) or die("MYSQL ERROR->".mysql_error());
	if(!empty($sql))
	{
		header('Location:product_history.php?product_id='.$stock_id);
	}
}

function product_display()
{
	$query = "SELECT product_add.id,product_add.name,product_add.description,product_add.image,stock.rate FROM product_add INNER JOIN stock ON product_add.id=stock.product_id";
	$sql = mysql_query($query);
	while($row=mysql_fetch_assoc($sql))
	{
	?>	
		<div class="col-sm-3">
            <article class="col-item">
            	<div class="photo">
        			<div class="options-cart-round">
        				<button class="btn btn-default" title="Add to cart">
        					<span class="fa fa-shopping-cart"></span>
        				</button>
        			</div>
        			<a href="product_purchase.php?product_id=<?php echo $row['id']; ?>&rate=<?php //echo $row['rate'] ?>"> <img src="<?php echo "http://localhost/practice_php/product_panel/uploads/".$row['image']; ?>" class="img-responsive" alt="Product Image" /> </a>
        		</div>
        		<div class="info">
        			<div class="row">
        				<div class="price-details col-md-6">
        					<p class="details">
        						<?php echo $row['description']; ?>
        					</p>
        					<h1><?php echo "id-".$row['id']." ".$row['name']; ?></h1>
        					<span class="price-new"><?php echo "$".$row['rate']; ?></span>
        				</div>
        			</div>
        		</div>
        	</article>
        </div>		
<?php	
	}
}


function purchase($value)
{
	$customer_id='1';
	$product_id=isset($value['product_id'])?$value['product_id']:'';
	$quantity= isset($value['quantity'])?$value['quantity']:'';
	$rate= isset($value['rate'])?$value['rate']:'';
	$color= isset($value['color'])?$value['color']:'';
	$date = date("Y-m-d H:i:s");
	$sql= "INSERT INTO purchase (`customer_id`,`product_id`,`quantity`,`rate`,`color`,`date`)VALUES('$customer_id','$product_id','$quantity','$rate','$color','$date') ";
	//echo $sql;die;
	$purchase_product = mysql_query($sql) or die('Invalid Query'.mysql_error());
	return $purchase_product;	
}

function unique_email($value)
{
	$sql = " SELECT email From register WHERE email ='$value' ";
	//echo $sql; 
	$query = mysql_query($sql);
	$num_rows = mysql_num_rows($query);
	if ($num_rows>0) 
	{
		return true;
	}else
	{
		return false;
	}
}

function unique_product($value)
{
	$sql = " SELECT name From product_add WHERE name ='$value' ";
	//echo $sql; 
	$query = mysql_query($sql);
	$num_rows = mysql_num_rows($query);
	if ($num_rows>0) 
	{
		return true;
	}else
	{
		return false;
	}
}

function logout()
	{
		echo "<h1>Logout Button Triggered</h1>";
		header('Location: index.php');
	}
	
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
    //echo "target Path->>".$target_path."    thumb PATH".$thumb_path;die;
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
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
            switch($file_ext){
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
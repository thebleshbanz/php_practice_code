<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);

function dbconn()
{
	/*$host="localhost";
	$username="root";
	$password="";
	$dbname="erp_php_demo";
    @mysql_connect($host,$username,$password) or die(mysql_error());
    $result = @mysql_select_db($dbname);
    if (isset($result)) {
    	echo "connection succesfull<br>";
    }*/
    $host="localhost";
	$db_nm="erp_php_demo";
	$username="root";
	$password="";
	try 
	{
		$conn = new PDO("mysql:host=$host;dbname=$db_nm", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connected successfully"; 
		return $conn;
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
}

/*function insert_value($value)
{
	//extract($value);
	//print_r($value);
	$education  = implode(',', $value['education']);
	//echo "<pre>";print_r($education);exit();
	//echo $education;//die();
	$fullname= isset($value['fullname'])?$value['fullname']:'';
	$mobile= isset($value['mobile'])?$value['mobile']:'';
	$email= isset($value['email'])?$value['email']:'';
	$password= isset($value['password'])?$value['password']:'';
	$usertype= isset($value['usertype'])?$value['usertype']:'';
	$gender= isset($value['gender'])?$value['gender']:'';
	$address= isset($value['address'])?$value['address']:'';
	$city= isset($value['city'])?$value['city']:'';
	$pincode= isset($value['pincode'])?$value['pincode']:'';
	$md5pw =  md5($password);//exit();
	$current_date = date("Y-m-d H:i:s");
	//echo $current_date;die;
	//echo $md5pw;exit();
	$insert = mysql_query("INSERT INTO signup (`fullname`, `mobile`, `email`,`education`, 
		`password`, `user_type`, `address`,`city`,`pincode`,`date`)VALUES ('$fullname','$mobile', '$email','$education', '$md5pw', '$usertype', '$address','$city','$pincode','$current_date')") 
		or die('Invalid Query'.mysql_error());
	return $insert;
}*/

function insert_value($data, $conn){
	try {
		// prepare sql and bind parameters
		$expArr = explode(' ', $data['fullname']);

		$userArr = array(
			'user_fname' => ($expArr[0]) ? $expArr[0] : '',
			'user_lname' => ($expArr[1]) ? $expArr[1] : '',
			'user_email' => ($data['email']) ? $data['email'] : '',
			'user_mobile' => ($data['mobile']) ? $data['mobile'] : '',
			'user_password' => ($data['password']) ? md5($data['password']) : '',
			'user_role' => 'user',
			'user_city' => ($data['city']) ? $data['city'] : '',
			'user_address' => ($data['address']) ? $data['address'] : '',
			'user_pincode' => ($data['pincode']) ? $data['pincode'] : '',
			'user_status' => 1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		extract($userArr);

		$stmt = $conn->prepare("
			INSERT INTO users 
				(`user_fname`, `user_lname`, `user_email`,  `user_mobile`, `user_password`, `user_role`, `city`, `address`, `pincode`, `user_status`, `created_at`, `updated_at`)
			VALUES 
				(:userfname, :userlname, :useremail, :usermobile, :userpassword, :userrole, :usercity, :useraddress, :userpincode, :userstatus, :createdat, :updatedat)");
		$stmt->bindParam(':userfname', $user_fname);
		$stmt->bindParam(':userlname', $user_lname);
		$stmt->bindParam(':useremail', $user_email);
		$stmt->bindParam(':usermobile', $user_mobile);
		$stmt->bindParam(':userpassword', $user_password);
		$stmt->bindParam(':userrole', $user_role);
		$stmt->bindParam(':usercity', $user_city);
		$stmt->bindParam(':useraddress', $user_address);
		$stmt->bindParam(':userpincode', $user_pincode);
		$stmt->bindParam(':userstatus', $user_status);
		$stmt->bindParam(':createdat', $created_at);
		$stmt->bindParam(':updatedat', $updated_at);
		$stmt->execute();

		/*$query = "INSERT INTO users (`user_fname`, `user_lname`, `user_email`,  `user_mobile`, `user_password`, `user_role`, `city`, `address`, `pincode`, `user_status`, `created_at`, `updated_at`)
			VALUES ('$user_fname', '$user_lname', '$user_email', '$user_mobile', '$user_password', '$user_role', '$user_city', '$user_address', '$user_pincode', '$user_status', '$created_at', '$updated_at')";
		$conn->exec($query);
		$last_id = $conn->lastInsertId();*/

		return true;
	}	
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
		return false;
	}
}


function unique_email($value, $conn){
	$sql = "SELECT user_email From users WHERE user_email ='$value'";
	// $query = mysql_query($sql);
	// $num_rows = mysql_num_rows($query);
	$stmt = $conn->query($sql);
	$num_rows = $stmt->fetch(PDO::FETCH_NUM);
	if ($num_rows>0) {
		return true;
	}else{
		return false;
	}
}

function update_unique_email($id, $value, $conn){
	$sql = "SELECT user_email From users WHERE user_email ='$value' AND user_id != '$id'";
	// $query = mysql_query($sql);
	// $num_rows = mysql_num_rows($query);
	$stmt = $conn->query($sql);
	$num_rows = $stmt->fetch(PDO::FETCH_NUM);
	if ($num_rows>0) {
		return true;
	}else{
		return false;
	}
}


/*function signin_check($value){
	$email = isset($value['email'])?$value['email']:'';
	$password = isset($value['password'])?$value['password']:'';
	$md5pw = md5($password);
	$sql ="SELECT email, password FROM signup WHERE email = '$email' AND password = '$md5pw' ";
	//echo $sql."<br>";
	$result = mysql_query($sql) or die('invalid Query'.mysql_error());
	$array = mysql_fetch_assoc($result);
	if (isset($result)) 
	{
		$query="SELECT id,user_type from signup WHERE email = '$email' AND password = '$md5pw' ";
		$get_auth = mysql_query($query) or die('Invalid Query  '.mysql_error());
		$array_auth = mysql_fetch_assoc($get_auth);
		//echo"<pre>"; print_r($array_auth);die();
		$_SESSION['id'] = $array_auth['id'];
		$_SESSION['user_type']=$array_auth['user_type'];
		//echo $_SESSION['id']; die();
		return $array_auth;
	}
	//print_r($array);die();
}*/

function signin_check($data, $conn){
	$sql = 'SELECT * FROM users WHERE user_email = :email AND  user_password = :password AND user_status=:status';
	$stmt = $conn->prepare($sql);
	$stmt->execute(['email'=>$data['email'], 'password'=>md5($data['password']), 'status'=>1]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($user)){
		return $user;
	}else{
		return null;
	}
}


/*function myprofile(){
	$id = $_SESSION['id'];
	$sql ="SELECT * FROM signup WHERE id = '$id'  ";
	$result = mysql_query($sql);
	$array = mysql_fetch_assoc($result);
	//echo"<pre>";print_r($array);die();
	if (!$result) 
	{
		echo "SQL ERROR<br>". mysql_error();die();
	}
	//echo $sql."<br>" ;//die();
	//echo "myprofile.php par User id from singin.php";die();
	return $array;
	//echo "<pre>".print_r($array)."</pre>";
}*/

function myprofile($id, $conn){
	try{
		/*$sql = 'SELECT * FROM users WHERE user_id=:id AND user_status=:status';
		$stmt = $conn->prepare($sql);
		$stmt->execute(['user_id' => $id, 'status'=>1]);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);*/
		$sql = "SELECT * FROM users WHERE user_id = '$id' AND user_status = 1";
		$stmt = $conn->query($sql);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($user)){
			return $user;
		}else{
			return false;
		}		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
		return false;
	}
}

/*function logout(){
	echo "<h1>Logout Button Triggered</h1>";
	header('Location: sigin.php');
}

function delete($id){
	$sql = "delete from signup where id='$id' ";
	//echo $sql; die();
	$query = mysql_query($sql);
	if (!$query) 
	{
		echo "SQL ERROR->".mysql_error();die();;
	}else
	{
		echo $query;
		return $query;
	}
}*/	

function delete($id, $conn){
	try{
		$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND user_role !='admin' ");
		$stmt->execute([$id]);
		return $stmt->rowCount();
	}catch(PDOException $e ){
		echo "Error :".$e->getMessage();
		return false;
	}
}

/*function edit_profile($value)
{
	$id = $_SESSION['id'];
	$fullname= isset($value['fullname'])?$value['fullname']:'';
	$mobile= isset($value['mobile'])?$value['mobile']:'';
	$edu= isset($value['education'])?$value['education']:'';
	$education = implode(',', $edu);

	$sql = "update signup set fullname='$fullname', mobile='$mobile', education='$education'  where id='$id' ";
	$query = mysql_query($sql);
	if (!$query) 
	{
		echo "SQL ERROR -".mysql_error();die();
	}else
	{
		return $query;
	}
}*/

function edit_profile($id, $data, $conn){
	try {
		// prepare sql and bind parameters
		$expArr = explode(' ', $data['fullname']);

		$userArr = array(
			'user_fname' => ($expArr[0]) ? $expArr[0] : '',
			'user_lname' => ($expArr[1]) ? $expArr[1] : '',
			'user_email' => ($data['email']) ? $data['email'] : '',
			'user_mobile' => ($data['mobile']) ? $data['mobile'] : '',
			'user_city' => ($data['city']) ? $data['city'] : '',
			'user_address' => ($data['address']) ? $data['address'] : '',
			'user_pincode' => ($data['pincode']) ? $data['pincode'] : '',
			'updated_at' => date('Y-m-d H:i:s')
		);

		/*if(!empty($data['password'])){
			$userArr['user_password'] = md5($data['password']);
		}*/
		
		extract($userArr);
		$sql = "UPDATE users SET user_fname=:userfname, user_lname=:userlname, user_email=:useremail, user_mobile=:usermobile, city=:usercity, address=:useraddress, pincode=:userpincode, updated_at=:updatedat WHERE user_id=:userid";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':userfname', $user_fname);
		$stmt->bindParam(':userlname', $user_lname);
		$stmt->bindParam(':useremail', $user_email);
		$stmt->bindParam(':usermobile', $user_mobile);
		$stmt->bindParam(':usercity', $user_city);
		$stmt->bindParam(':useraddress', $user_address);
		$stmt->bindParam(':userpincode', $user_pincode);
		$stmt->bindParam(':updatedat', $updated_at);
		$stmt->bindParam(':userid', $id);
		$stmt->execute();

		return true;
	}	
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
		return false;
	}
}

/*function get_profile($value)
{
	$id = isset($value['id'])?$value['id']:'';
	$sql = "SELECT * from signup WHERE id ='$id' ";
	//echo $sql;die();
	$query = mysql_query($sql);
	$array = mysql_fetch_assoc($query);
	//echo "<pre>";print_r($array);die;
	if (!$query) {
		echo "SQL_ERROR ".mysql_error();die();
	}else
	{
		return $array;
	}
}*/

function get_profile($data, $conn){
	try{

		$sql = "SELECT * FROM users WHERE user_id = '".$data['id']."' AND user_status = 1";
		$stmt = $conn->query($sql);
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		if(!empty($user)){
			return $user;
		}else{
			return false;
		}		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
		return false;
	}
}


/*function edit_dashboard($value)
{
	$id= isset($value['id'])?$value['id']:'';
	$fullname= isset($value['fullname'])?$value['fullname']:'';
	$email= isset($value['email'])?$value['email']:'';
	$password= isset($value['password'])?$value['password']:'';
	$mobile= isset($value['mobile'])?$value['mobile']:'';
	$edu= isset($value['education'])?$value['education']:'';
	$education = implode(',', $edu);
	$usertype= isset($value['usertype'])?$value['usertype']:'';
	$address= isset($value['address'])?$value['address']:'';
	$pincode= isset($value['pincode'])?$value['pincode']:'';

	$sql = "update signup set fullname='$fullname', mobile='$mobile', education='$education'  where id='$id' ";
	//echo $sql;die();
	$query = mysql_query($sql);
	if (!$query) 
	{
		echo "SQL ERROR -".mysql_error();die();
	}else
	{
		return $query;
	}
}*/

function edit_dashboard($data, $conn){
	try {
		// prepare sql and bind parameters
		$expArr = explode(' ', $data['fullname']);

		$userArr = array(
			'id' => ($data['id']) ? $data['id'] : 0,
			'user_fname' => ($expArr[0]) ? $expArr[0] : '',
			'user_lname' => ($expArr[1]) ? $expArr[1] : '',
			'user_email' => ($data['email']) ? $data['email'] : '',
			'user_mobile' => ($data['mobile']) ? $data['mobile'] : '',
			'user_city' => ($data['city']) ? $data['city'] : '',
			'user_address' => ($data['address']) ? $data['address'] : '',
			'user_pincode' => ($data['pincode']) ? $data['pincode'] : '',
			'updated_at' => date('Y-m-d H:i:s')
		);

		/*if(!empty($data['password'])){
			$userArr['user_password'] = md5($data['password']);
		}*/
		extract($userArr);
		
		$sql = "UPDATE users SET user_fname=:userfname, user_lname=:userlname, user_email=:useremail, user_mobile=:usermobile, city=:usercity, address=:useraddress, pincode=:userpincode, updated_at=:updatedat WHERE user_id=:userid";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':userfname', $user_fname);
		$stmt->bindParam(':userlname', $user_lname);
		$stmt->bindParam(':useremail', $user_email);
		$stmt->bindParam(':usermobile', $user_mobile);
		$stmt->bindParam(':usercity', $user_city);
		$stmt->bindParam(':useraddress', $user_address);
		$stmt->bindParam(':userpincode', $user_pincode);
		$stmt->bindParam(':updatedat', $updated_at);
		$stmt->bindParam(':userid', $id);
		$stmt->execute();

		return true;
	}	
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
		return false;
	}
}

function search($value)
{
	$search =  isset($value['search'])?$value['search']:'';
	//echo htmlspecialchars($search);die;
	$sql="SELECT * FROM signup WHERE email or fullname or mobile LIKE '$search' ";
	//echo $sql;die();
	$result = mysql_query($sql);
	$query = mysql_fetch_assoc($result);
	if (!$result) 
	{
		echo "SQL ERROR - ".mysql_error();die();
	}else
	{
		return $query;
	}
}

function dashboard($conn)
{
	$data = [];
	$stmt = $conn->query('SELECT * FROM users where user_role != "admin" ');
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$data[] = $row;
	}
	return $data;
}
?>
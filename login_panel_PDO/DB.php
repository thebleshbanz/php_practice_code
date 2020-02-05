<?php 
//error_reporting(E_ALL ^ E_DEPRECATED);

class db_query
{
	private $conn;

	public	function __construct()
	{
		$host="localhost";
		$username="root";
		$password="";
		$dbname="erp_php_demo";
		try {
			$this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
	
	public	function signin_check($value)
	{
		try{
			$email 		= isset($value['email'])?$value['email']:'';
			$password 	= isset($value['password'])?$value['password']:'';
			$md5pw 		= md5($password);
			$sql ="SELECT user_email, user_password FROM users WHERE user_email = '$email' AND user_password = '$md5pw'";
			$login = $this->conn->prepare($sql);
			$login->execute();		
			$result = $login->fetch(PDO::FETCH_ASSOC);
			if (!empty($result)) {
				$query="SELECT user_id,user_role from users WHERE user_email = '$email' AND user_password = '$md5pw' ";
				$get_auth = $this->conn->prepare($query);
				$get_auth->execute();
				$array_auth = $get_auth->fetch(PDO::FETCH_ASSOC);
				$_SESSION['id'] = $array_auth['user_id'];
				$_SESSION['user_type']=$array_auth['user_role'];
				return $array_auth;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo "Error : ". $e->getMessage();
		}
	}


	function myprofile()
	{		
		try{
			$id = $_SESSION['id'];
			$sql ="SELECT * FROM users WHERE user_id = '$id'  ";
			$login = $this->conn->prepare($sql);
			$login->execute();
			$result=$login->fetch(PDO::FETCH_ASSOC);
			return $result;
		}catch (Exception $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
	
	function edit_profile($id, $data)
	{
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
			
			extract($userArr);
			$sql = "UPDATE users SET user_fname=:userfname, user_lname=:userlname, user_email=:useremail, user_mobile=:usermobile, city=:usercity, address=:useraddress, pincode=:userpincode, updated_at=:updatedat WHERE user_id=:userid";
			$stmt = $this->conn->prepare($sql);

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

	function dashboard()
	{
		$host="localhost";
		$username="root";
		$password="";
		$dbname="erp_php_demo";
		try {
				$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}		
		try
		{
			$sql_select = "SELECT * FROM signup";
			//$result = mysql_query($sql_select);
			$stm = $conn->prepare($sql_select);
			$stm->execute();
		    // output data of each row
		    while($row = $stm->fetch(PDO::FETCH_ASSOC)) 
			{
?>		    <tr>
		        <td><?php echo $row["id"]; ?> </td>
		        <td><?php echo $row["fullname"] ?></td>
		        <td><?php echo $row["mobile"] ?></td>
		        <td><?php echo $row["education"] ?></td> 
		        <td><?php echo $row["email"] ?></td>
		        <td><?php echo $row["password"] ?></td>
		        <td><?php echo $row["user_type"] ?></td>
		        <td><?php echo $row["address"] ?></td> 
		        <td><?php echo $row["city"] ?></td> 
		        <td><?php echo $row["pincode"] ?></td>
		        <td>
		        	<a href="edit.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
		        </td>
		        <td>
		         <a href="dashboard.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
		        </td>
		    </tr>
	<?php 	}
		}catch(Exception $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}
	}	

	function unique_email($value){
		try{
			$sql = "SELECT user_email From users WHERE user_email = :email ";
			$stm = $this->conn->prepare($sql);
			$stm->execute(['email'=>$value]);
			$num_rows=$stm->fetch(PDO::FETCH_NUM);
			if ($num_rows>0) {
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}		
	}

	function update_unique_email($id, $value){
		$sql = "SELECT user_email From users WHERE user_email ='$value' AND user_id != '$id'";
		$stmt = $this->conn->query($sql);
		$num_rows = $stmt->fetch(PDO::FETCH_NUM);
		if ($num_rows>0) {
			return true;
		}else{
			return false;
		}
	}
	
	function insert_value($data)
	{
		
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

			$stmt = $this->conn->prepare("
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

			return true;
		}	
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
			return false;
		}
	}

	function delete($id)
	{
		try
		{
			$sql = "delete from users where user_id='$id'";
			$query = $this->conn->exec($sql);
			return true;
		}
		catch(PDOException $e)
		{
			echo "PDO QUery failed: " . $e->getMessage();
		}
	}	

	function edit_dashboard($data)
	{
		try {
			// prepare sql and bind parameters
			$expArr = explode(' ', $data['fullname']);

			$userArr = array(
				'id' => ($data['id']) ? $data['id'] : 0,
				'user_fname' => ($expArr[0]) ? $expArr[0] : '',
				'user_lname' => ($expArr[1]) ? $expArr[1] : '',
				'user_email' => ($data['email']) ? $data['email'] : '',
				'user_mobile' => ($data['mobile']) ? $data['mobile'] : 0,
				'user_city' => ($data['city']) ? $data['city'] : '',
				'user_address' => ($data['address']) ? $data['address'] : '',
				'user_pincode' => ($data['pincode']) ? $data['pincode'] : 0,
				'updated_at' => date('Y-m-d H:i:s')
			);
			
			extract($userArr);
			$sql = "UPDATE users SET user_fname=:userfname, user_lname=:userlname, user_email=:useremail, user_mobile=:usermobile, city=:usercity, address=:useraddress, pincode=:userpincode, updated_at=:updatedat WHERE user_id=:userid";
			$stmt = $this->conn->prepare($sql);

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
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			return false;
		}
	}
	
	function get_profile($value)
	{
		try
		{		
			$id = isset($value['id'])?$value['id']:'';
			$query = "SELECT * from users WHERE user_id ='$id' ";
			$sql = $this->conn->prepare($query);
			$sql->execute();
			$result = $sql->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}
}
$obj = new db_query();
?>
<?php


function logout()
{
	echo "<h1>Logout Button Triggered</h1>";
	header('Location: sigin.php');
}

/*function search($value)
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
}*/


 ?>
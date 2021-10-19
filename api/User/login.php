<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
if(isset($_POST['email_login'])){
	$user->email = $_POST['email'];
	$user->password = md5($_POST['password']);
	$stmt = $user->login();
	if($stmt->rowCount() > 0){
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		// create array
		$user_arr=array(
			"status" => true,
			"message" => "Successfully Login!",
			"id" => $row['user_id'],
			"email" => $row['email']
		);
		$user_id = $row['user_id'];
		$email = $row['email'];
		$phone = $row['phone'];
		$password = $row['password'];
		echo "<a href='../../update.php?user_id=$user_id&email=$email&password=$password&phone=$phone'>Update Profile</a>";
	}
	else{
		$user_arr=array(
			"status" => false,
			"message" => "Invalid Email or Password!",
		);
	}
}
else{
	$user->mobile = $_POST['mobile'];
	$user->password = md5($_POST['password']);
	$stmt = $user->login_m();
	if($stmt->rowCount() > 0){
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		// create array
		$user_arr=array(
			"status" => true,
			"message" => "Successfully Login!",
			"user_id" => $row['user_id'],
			"mobile" => $row['phone']
		);
		$user_id = $row['user_id'];
		$email = $row['email'];
		$phone = $row['phone'];
		$password = $row['password'];
		echo "<a href='../../update.php?user_id=$user_id&email=$email&password=$password&phone=$phone'>Update Profile</a>";
	}
	else{
		$user_arr=array(
			"status" => false,
			"message" => "Invalid Username or Password!",
		);
	}
}
// read the details of user to be edited

// make it json format
print_r(json_encode($user_arr));
echo "<br><br><br>"."<a href='../../' style='text-decoration: none;'>Home</a>";
?>
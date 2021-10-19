<?php
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$user_arr = null;
 
// implementation for email
if(isset($_POST['email_registration'])){
	$user->email = $_POST['email'];
	$user->password = md5($_POST['password']);
	$user->user_id = rand(1000, 10000000);
	// create the user
	if($user->signup()){
		$user_arr=array(
			"status" => true,
			"message" => "Successfully Signup!",
			"id" => $user->user_id
		);
	}
	else{
		$user_arr=array(
			"status" => false,
			"message" => "Email already exists!"
		);
	}
}
//implementation for mobile number
else{
	$user->user_id = rand(1000, 10000000);
	$user->phone = $_POST['mobile'];
	$user->password = md5($_POST['password']);
	// create the user
	if($user->signup_mobile()){
		$user_arr=array(
			"status" => true,
			"message" => "Successfully Signup!",
			"id" => $user->user_id
		);
	}
	else{
		$user_arr=array(
			"status" => false,
			"message" => "Mobile Number already exists!"
		);
	}
}

print_r(json_encode($user_arr));
echo "<br><br><br>"."<a href='../../' style='text-decoration: none;'>Home</a>";
?>
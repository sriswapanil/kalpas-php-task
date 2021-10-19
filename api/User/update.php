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
if(isset($_POST['update'])){
	$email = null;
	$phone = null;
	if(empty($_POST['email'])){
		$email = null;
	}
	else{
		$email = $_POST['email'];
	}
	if(empty($_POST['phone'])){
		$phone = null;
	}
	else{
		$phone = $_POST['phone'];
	}
	$user->email = $email;
	$user->phone = $phone;
	$user->user_id = $_POST['user_id'];
	
	
	
	$stmt = $user->update();
	if($stmt){
		// get retrieved row
		// create array
		$user_arr=array(
			"status" => true,
			"message" => "Updated Successfully!",
			"user_id" => $email,
			"mobile" => $phone
		);
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
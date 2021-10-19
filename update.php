<?php
$user_id = $_GET['user_id'];
$password = $_GET['password'];
if(empty($_GET['email'])){
	$email = null;
}
else{
	$email = $_GET['email'];
}

if(empty($_GET['phone'])){
	$phone = null;
}
else{
	$phone = $_GET['phone'];
}

?>

<!DOCTYPE html>
<html>
	<head><title>Update Profile Intern Task</title></head>
	<body>
		<center>Update Profile</center>
		<center>
			<form action="./api/User/update.php" method="POST">
				<label>User ID:- </label><input type="text" name="user_id" value="<?php echo $user_id; ?>" readonly><br>
				<label>Email:- </label><input type="email" name="email" value="<?php if(empty($email)){echo "NULL";}else{echo $email;} ?>"><br>
				<label>Phone:- </label><input type="text" name="phone" value="<?php if(empty($phone)){echo "NULL";}else{echo $phone;} ?>"><br>
				<label>Password:- </label><input type="text" name="password" value="<?php echo $password; ?>" readonly><br>
				<input type="submit" name="update" value="Update Profile">
			</form><br><br><br>
			<a href="./" style="text-decoration: none;">Home</a>
		</center>
	</body>
</html>
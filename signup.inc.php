<?php 
if(isset($_POST[' submit']){

include_once 'dbh.inc.php';


$first=mysqli_real_escape_string($cann,$_POST['first'];
$last=mysqli_real_escape_string($cann,$_POST['last'];
	$email=mysqli_real_escape_string($cann,$_POST['email'];
		$uid=mysqli_real_escape_string($cann,$_POST['udi'];
			$pwd=mysqli_real_escape_string($cann,$_POST['pwd'];

//error handlers
// check for empty fields

if(empty($first)|| empty($last) (empty($email)|| (empty($uid)|| (empty($pwd)){

header("Location:../signup.php?signup=empty");
exit();
}
else{

	//check if input characters are valid
if(!preg_match("/^[a-zA-Z]*$/", $first)|| !preg_match("/^[a-zA-Z]*$", $last)|| ){
header("Location:../signup.php?signup=invalid");
exit();
}
else{

//check if email is valid
	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
		header("Location:../signup.php?signup=email");
exit();
	}
	else{

		$sql="SELECT*FROM users WHERE user_uid='$uid'";
		$result=mysql_query($con,$sql);
		$resultCheck=mysqli_num_rows($result);
		if($resultCheck>0)
		{
			header("Location:../signup.php?signup=usertaken");
            exit();
		} else{

			// HASHING THE PASSWORD
			$hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
			//INSERT THE USER INTO THE DATABASE
			$sql="INSERT INTO users(user_first,user_last,user_email,_user_uid,user_pwd) VALUES ('$first','$last','$email','$hashedPwd');";
			mysqli_query($conn,$sql);
			header("Location:../signup.php?signup=success");
            exit();
		}
	}

}
}

} else {


header("Location:../signup.php");
exit();
}



 
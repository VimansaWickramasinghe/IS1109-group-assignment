<?php
include "../db/db.php";
if (isset($_POST['uname']) && isset($_POST['psw'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
    }
    

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['psw']);

	if (empty($uname)) {
		header("Location: login.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: ../index.php");
		        exit();
            }else{
                header("Location: login.php?error=The username is taken try another");
                echo("Incorrect Password");
		        exit();
			}
		}else{
            header("Location: login.php?error=The username is taken try another");
            echo("Incorrect Username or passowrd");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}
?>
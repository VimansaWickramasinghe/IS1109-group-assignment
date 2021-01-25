<?php 
include "../db/db.php";

  if (isset($_POST['email']) && isset($_POST['psw'])
  && isset($_POST['uname']) && isset($_POST['repasw'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
 
     $uname = validate($_POST['uname']);
     $pass = validate($_POST['psw']); 
     $re_pass = validate($_POST['repasw']);
     $email= validate($_POST['email']);

     
     if($pass !== $re_pass){
        header("Location: register.php?error=The confirmation password  does not match");
	    exit();
    }

	    $sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: register.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO users(user_name, password, email) VALUES('$uname', '$pass', '$email')";
           $result2 = mysqli_query($con, $sql2);
           if ($result2) {
                header("Location: ../login/login.php");
                echo("success");
                
	         exit();
           }else {
	           	header("Location: register.php?error=unknown error occurred");
		        exit();
           }
		}


    }else{
        header("Location: register.php");
        exit();
    }


?>  
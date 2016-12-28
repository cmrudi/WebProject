<?php 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 	$username = test_input($_POST["username"]);
	 	$email = test_input($_POST["email"]);
	 	$password = test_input($_POST["password"]);
	 	$signup_time = (new DateTime())->getTimestamp();
	 	$duplicateUsername = 0;
	 	$duplicateEmail = 0;

	 	$dbservername="localhost";
		$dbusername="piknix";
		$dbpassword="piknix";
		$database="piknix_db";

		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

		if (mysqli_connect_errno()) {
			exit();
		}
	
		if($result_username = mysqli_query($conn,"SELECT username FROM user_auth where username = '$username'")){
			$row_username = mysqli_num_rows($result_username);
			
			if ($row_username > 0) {
				echo 'Username has been used by another<br>';
				$duplicateUsername = 1;
			}
			
			mysqli_free_result($result_username);
		}

		if($result_email = mysqli_query($conn,"SELECT email FROM user_auth WHERE email = '$email'")){
			$row_email = mysqli_num_rows($result_email);
			
			if ($row_email > 0) {
				echo 'Email has been used by another<br>';
				$duplicateEmail = 1;
			}
			mysqli_free_result($result_email);
		}

		if (($duplicateEmail !== 1)&&($duplicateUsername !== 1)) {
			$insertquery = "INSERT INTO user_auth(username, email, password, signup_time) VALUES ('$username','$email','$password','$signup_time')";
			if ($result = mysqli_query($conn,$insertquery)) {
				header("Location: /Piknix/index.php");
			}
		}
		else {
			$errorMessage = 'Error on submitting data to database';
		}
		mysqli_close($conn);


	 }

	 function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}


?>
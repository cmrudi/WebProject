<?php 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 	$username = test_input($_POST["username"]);
	 	$password = test_input($_POST["password"]);

	 	$dbservername="localhost";
		$dbusername="piknix";
		$dbpassword="piknix";
		$database="piknix_db";

		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

		if (mysqli_connect_errno()) {
			exit();
		}

		$quer =  "SELECT password,id FROM user_auth WHERE username = '$username'";
		if($login_result = mysqli_query($conn,$quer)){
			$row = $login_result->fetch_assoc(); 
			if($row["password"] == $password) {
				$id = $row["id"];
				header("Location: /Piknix/home.php?id=1");
			}
			else {
				header("Location: /Piknix/index.php");
			}

			mysqli_free_result($login_result);
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
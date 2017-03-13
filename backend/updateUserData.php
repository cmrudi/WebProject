<?php 

	
	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 	$name = test_input($_POST["fullname"]);
	 	$city = test_input($_POST["city"]);
	 	$birthdate = test_input($_POST["birthdate"]);
	 	$id = test_input($_POST["userid"]);
	 	$targetUrl = "http://$_SERVER[HTTP_HOST]/Piknix/home.php?id=".$id."&reach=here";

	 	$dbservername="localhost";
		$dbusername="piknix";
		$dbpassword="piknix";
		$database="piknix_db";

		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

		if (mysqli_connect_errno()) {
			exit();
		}
	
		$updatequery = "UPDATE user_auth SET name = '$name', city = '$city', birth_date = '$birthdate' WHERE id = '$id'";
		if ($result = mysqli_query($conn,$updatequery)) {
			header("Location: ".$targetUrl);
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
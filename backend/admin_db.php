<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//For Thumbnail Image
		$allowedExts = array("gif", "jpeg", "jpg", "png");
	    $temp = explode(".", $_FILES["userfile"]["name"]);
	    $extension = $temp[1];

	    if ((($_FILES["userfile"]["type"] == "image/gif")
	      || ($_FILES["userfile"]["type"] == "image/jpeg")
	      || ($_FILES["userfile"]["type"] == "image/jpg")
	      || ($_FILES["userfile"]["type"] == "image/pjpeg")
	      || ($_FILES["userfile"]["type"] == "image/x-png")
	      || ($_FILES["userfile"]["type"] == "image/png"))
	      && ($_FILES["userfile"]["size"] < 1000000)
	      && in_array($extension, $allowedExts))
	    {
        	if ($_FILES["userfile"]["error"] > 0)
          	{
          		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
          	}
        	else 
          	{
				$newfilename = round(microtime(true)) . '.' . end($temp);
				if (move_uploaded_file($_FILES["userfile"]["tmp_name"], "/var/www/html/Piknix/location_img/" . $newfilename)) {
			  		echo "File uploaded<br>";
			  		$upload = 1;
				} else {
			  		echo "Upload failed<br>";
			  		$upload = 0;
				}
        	}
        }
      	else
        {
        	echo "Invalid file";
        }

        //For Bigger Image
        $temp = explode(".", $_FILES["userfile2"]["name"]);
	    $extension = $temp[1];

	    if ((($_FILES["userfile2"]["type"] == "image/gif")
	      || ($_FILES["userfile2"]["type"] == "image/jpeg")
	      || ($_FILES["userfile2"]["type"] == "image/jpg")
	      || ($_FILES["userfile2"]["type"] == "image/pjpeg")
	      || ($_FILES["userfile2"]["type"] == "image/x-png")
	      || ($_FILES["userfile2"]["type"] == "image/png"))
	      && ($_FILES["userfile2"]["size"] < 1000000)
	      && in_array($extension, $allowedExts))
	    {
        	if ($_FILES["userfile2"]["error"] > 0)
          	{
          		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
          	}
        	else 
          	{
				$newfilename2 = round(microtime(true)) . 'big.' . end($temp);
				if (move_uploaded_file($_FILES["userfile2"]["tmp_name"], "/var/www/html/Piknix/location_img/" . $newfilename2)) {
			  		echo "File uploaded<br>";
			  		$upload = 1;
				} else {
			  		echo "Upload failed<br>";
			  		$upload = 0;
				}
        	}
        }
      	else
        {
        	echo "Invalid file";
        }

       

        if ($upload == 1) {
	        $dbservername="localhost";
			$dbusername="piknix";
			$dbpassword="piknix";
			$database="piknix_db";

			$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

			if (mysqli_connect_errno()) {
				exit();
			}
			$name =  test_input($_POST["name"]);
			$location =  test_input($_POST["location"]);
			$title = test_input($_POST["title"]);
			$description =  $_POST["desc"];
			$image = $newfilename;
			$bigImage = $newfilename2;
			$timestamp = (new DateTime())->getTimestamp();
			$query = "INSERT INTO destination (name, title, location, description, image_file, image_file_big, upload_time) VALUES ('$name', '$title', '$location', '$description', '$image', '$bigImage', '$timestamp')";

			if ($result = mysqli_query($conn,$query)) {
				echo "success";
			}
			mysqli_free_result($result);
			mysqli_close($conn);
		}

	}


	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}



?>
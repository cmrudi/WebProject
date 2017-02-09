<?php include 'landing-header.php';
	  include 'landing-form.php';
		get_landing_header();

	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}

		$id = 0;
		$targetLogin = "http://$_SERVER[HTTP_HOST]/Piknix/backend/login_db.php";
		$targetSignup = "http://$_SERVER[HTTP_HOST]/Piknix/backend/signup_db.php";
		$targetURL = "http://$_SERVER[HTTP_HOST]/Piknix/landing-chatroom.php?loc=";
		$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";	

		$dbservername="localhost";
		$dbusername="piknix";
		$dbpassword="piknix";
		$database="piknix_db";

		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
		
		if (mysqli_connect_errno()) {
				exit();
		}
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$searchText = test_input($_POST["searchText"]);
			$query = "SELECT id, name, title,location,image_file FROM destination WHERE name LIKE '%".$searchText."%'";
		}
		else {
			$query = "SELECT id,title,location,image_file FROM destination";
		}
		$result = mysqli_query($conn,$query);
?>
<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>
  <div class="col-sm-5">
    <div class="picnix-container">
      	<div id="signup-login-form">
			<?php get_landing_form(); ?>
      	</div>
 		<div class="main-content">
	      <?php 
			while($row = $result->fetch_assoc()): ?>
				<a href=<?php echo $targetURL.$row["id"]."&id=".$id; ?>>
					<div id="content-search" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file"]; ?>)">
						<div id="content-search-inside">
							<p><?php echo $row["title"]; ?><p>
							<p class="small-text"><?php echo $row["location"]; ?><p>
						</div>
					</div>
				</a>
			<?php endwhile; ?>
		</div>
    </div>
  </div>
</div>

</body>
</html>

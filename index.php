<?php include 'landing-header.php';
	  include 'login.php';
	  include 'signup.php';
		get_landing_header();

	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}

		$targetLogin = "http://$_SERVER[HTTP_HOST]/Piknix/backend/login_db.php";
		$targetSignup = "http://$_SERVER[HTTP_HOST]/Piknix/backend/signup_db.php";
		$targetURL = "http://$_SERVER[HTTP_HOST]/Piknix/chatroom.php?loc=";
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
			<form class="signup-form" name="signup-form" enctype="multipart/form-data" onsubmit="" method = "POST" action =<?php echo '"'.$targetSignup.'"'; ?>
				<br>
				<h5 class="orange-text">username</h5>
				<input type = "text" name = "username">
				<br><br>
				<h5 class="orange-text">email address</h5>
				<input type = "text" name = "email">
				<br><br>
				<h5 class="orange-text">PIN code</h5>
				<input type = "text" name = "password">
				<br><br>
				<input class="submit-button" type="submit" value="Submit">
				<br>
			</form>
			<form class="login-form" name="login-form" enctype="multipart/form-data" onsubmit="" method = "POST" action = <?php echo '"'.$targetLogin.'"'; ?> >
				<br>
				<h5 class="orange-text">username</h5>
				<input type = "text" name = "username">
				<br><br>
				<h5 class="orange-text">PIN code</h5>
				<input type = "text" name = "password">
				<br><br>
				<input class="submit-button" type="submit" value="Submit">
				<br>
			</form>
      </div>
     		<div class="main-content">
     		<form class="search-form" name="search" action="" method="post">
				<input type="text" id="search" name="searchText" class="center-text" placeholder="Type to Search">
			</form>
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

<script type="text/javascript">
	$('.tab-login').click(function(e){
	    //make all tabs inact
	    $('.login-form').show();
	    $('.signup-form').hide();
	    $('.search-form').hide();
	    $('.main-content').hide();


	});
	$('.tab-signup').click(function(e){
	    //make all tabs inact
	    $('.login-form').hide();
	    $('.signup-form').show();
	    $('.search-form').hide();
	    $('.main-content').hide();

	});

	$('.tab-search').click(function(e){
	    //make all tabs inact
	    $('.login-form').hide();
	    $('.signup-form').hide();
	    $('.search-form').show();
	    $('.main-content').show();

	});


</script>
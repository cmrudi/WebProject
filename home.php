<?php include 'header.php';
	  include 'main-menu.php';
	get_header();

	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	  }
	
	$id = $_GET["id"];
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
	
	if ($result = mysqli_query($conn,$query)) {
		 
	
	?>
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
	<!--Photo Editing -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="imagesloaded.js"></script>
	<link href="jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
	<script src="jquery.drag-n-crop.js"></script>
	<!--Photo Editing -->
	<!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">-->
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<!--<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>

<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <div class="col-sm-5">
    <div class="picnix-container">
    	<div id="signup-login-form">
		<?php 
		get_main_menu($id);
		?>
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
	<?php } ?>

</body>
<script>
	var modal = document.getElementById('photo-modal');
	var btn = document.getElementById("username");
	var exit = document.getElementById("exit");



	btn.onclick = function() {
	    modal.style.display = "block";
	}

	exit.onclick = function() {
	    modal.style.display = "none";
	}


	var howItWorksModal = document.getElementById('how-it-works-modal');
	var howItWorksBtn = document.getElementById("how-it-works");
	var exitHowItWorks = document.getElementById("exit-how-it-works");
	howItWorksBtn.onclick = function() {
		howItWorksModal.style.display = "block";
	}
	exitHowItWorks.onclick = function() {
		howItWorksModal.style.display = "none";
	}

	var aboutUsModal = document.getElementById('about-us-modal');
	var aboutUsBtn = document.getElementById('about-us');
	var exitAboutUs = document.getElementById('exit-about-us');
	aboutUsBtn.onclick = function() {
		aboutUsModal.style.display = "block";
	}
	exitAboutUs.onclick = function() {
		aboutUsModal.style.display = "none";
	}
</script>
<script src="js/modal.js"></script>




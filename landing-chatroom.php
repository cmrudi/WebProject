<?php include 'landing-header.php';
		include 'landing-form.php';
	get_landing_header();

	$id = 0;
	$locationId = $_GET["loc"];
	$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";
	$webInfoURL = "http://$_SERVER[HTTP_HOST]/Piknix/web-info.php?loc=";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT id,title,location,image_file FROM destination WHERE id='$locationId'";
	if ($result = mysqli_query($conn,$query)) {
		$row = $result->fetch_assoc();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/style.js"></script>

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
			<div id="content-search2" class="center-text show-picture" style="background-image: url(<?php echo $imageURL.$row["image_file"]; ?>)">
				<div id="content-search-inside">
					<p><?php echo $row["title"]; ?><p>
					<p class="small-text"><?php echo $row["location"]; ?><p>
				</div>
				<div id="over-image-div">
					<button class="over-image-button" onclick=<?php echo "window.location.href='".$webInfoURL.$locationId."&id=".$id."'"; ?>><span class="glyphicon glyphicon-info-sign"></span></button>
				</div>
			</div>
			<div class="chat-room login-to-view-chat">
				<div id="chat-multi-container">
					<div id="chat-container" class="normal-padding">
						<div class="text-message">Please login to view chat</div>
					</div>
					<input class="show-chat" id="chat-input-text" type="text" ng-model="newmessage.text">
					<button class="show-chat" id = "chat-input-button" ng-click="insert(newmessage)"><span class="glyphicon glyphicon-chevron-right"></span></button>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
	
	<?php } ?>

</body>
</html>


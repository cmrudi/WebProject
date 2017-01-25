<?php include 'header.php';
	  include 'function-menu.php';
	get_header();
	
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
	
	$query = "SELECT id,title,location,image_file FROM destination";
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

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>

<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <div class="col-sm-5">
    <div class="picnix-container">
    	<div id="function-menu">
		</div>
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
	<?php } ?>

</body>
<script src="js/modal.js"></script>



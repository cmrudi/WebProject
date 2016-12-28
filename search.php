<?php include 'header.php';
		get_header();

	$targetURL = "http://$_SERVER[HTTP_HOST]/Piknix/web-info.php?loc=";
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
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>
	<div class="row">
	  <div class="col-sm-7">
	    <div id="map"></div>
    	<div id="capture"></div>
	  </div>
	  <div class="col-sm-5">
	    <div class="picnix-container">
			<div id="search" class="center-text" contenteditable="true">Type to Search</div>
			
			<?php  while($row = $result->fetch_assoc()): ?>
				<a href=<?php echo $targetURL.$row["id"]; ?>>
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
</html>

<?php include 'header.php';
		get_header();
    $locationId = $_GET["loc"];
    $imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";

    $dbservername="localhost";
    $dbusername="piknix";
    $dbpassword="piknix";
    $database="piknix_db";

    $conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

    if (mysqli_connect_errno()) {
      exit();
    }

    $query = "SELECT title, location, image_file_big, description FROM destination WHERE id = '$locationId'";
    if ($result = mysqli_query($conn,$query)) {
        $row = $result->fetch_assoc();

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
		<div id="web-info-picture" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file_big"]; ?>)">
        <span id="left-arrow" class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span id="right-arrow" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <div id="web-info-text-picture">
            <p><?php echo $row["title"]; ?><p>
            <p class="small-text"><?php echo $row["location"]; ?><p>
        </div>  
    </div>
		<div id="web-info-description" class="center-text"><?php echo $row["description"]; ?></div>
    </div>
  </div>
</div>  

  <?php } ?>

</body>
</html>

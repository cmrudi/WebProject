<?php
    $id = $_GET["id"];

    if ($id == 0) {
      include 'landing-header.php';
      include 'landing-form.php';
      get_landing_header();
    }
    else {
      include 'header.php';
		  get_header();
    }
    $locationId = $_GET["loc"];
    $imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";
    $backURL = "http://$_SERVER[HTTP_HOST]/Piknix/landing-chatroom.php?id=0&loc=";

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
    <?php if (id ==0 )  {?>
      <div id="signup-login-form">
        <?php get_landing_form(); ?>
      </div>
      <div class="main-content">
    		<div id="web-info-picture" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file_big"]; ?>)">
            <div class="slide-button-container">
              <a id="back-url" href=<?php echo $backURL.$locationId;  ?>>
                <div class="close-circle">
                  <i class="material-icons md-10 close-icon">close</i>
                </div>
              </a>
            </div>
            <div class="slide-button-container" id="navigation-slide-button">
              <button id="prevClick" class="left-arrow" onclick="prevWebInfo(<?php echo $locationId; ?>)"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
              <button id="nextClick" class="right-arrow" onclick="nextWebInfo(<?php echo $locationId; ?>)"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
            </div>  
            <div id="web-info-text-picture">
                <p id="web-info-title"><?php echo $row["title"]; ?><p>
                <p id="web-info-location" class="small-text"><?php echo $row["location"]; ?><p>
            </div>  
        </div>
        <div id="web-info-description" class="center-text"><?php echo $row["description"]; ?></div>
      </div>
    <?php } else { ?>
      <div id="web-info-picture" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file_big"]; ?>)">
            <div class="slide-button-container">
              <a id="back-url" href=<?php echo $backURL.$locationId;  ?>>
                <div class="close-circle">
                  <i class="material-icons md-10 close-icon">close</i>
                </div>
              </a>
            </div>
            <div class="slide-button-container" id="navigation-slide-button">
              <button id="prevClick" class="left-arrow" onclick="prevWebInfo(<?php echo $locationId; ?>)"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
              <button id="nextClick" class="right-arrow" onclick="nextWebInfo(<?php echo $locationId; ?>)"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
            </div>  
            <div id="web-info-text-picture">
                <p id="web-info-title"><?php echo $row["title"]; ?><p>
                <p id="web-info-location" class="small-text"><?php echo $row["location"]; ?><p>
            </div>  
        </div>
      <div id="web-info-description" class="center-text"><?php echo $row["description"]; ?></div>
    <?php } ?>
    </div>
  </div>
</div>  

  <?php } ?>

</body>
</html>

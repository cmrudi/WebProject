<?php 
	$targetUri = "http://$_SERVER[HTTP_HOST]/Piknix/backend/admin_db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Piknix</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/style.js"></script>
</head>
<body>	
	<form name="addProductForm" enctype="multipart/form-data" onsubmit="" method = "POST" action = <?php echo '"'.$targetUri.'"'; ?>>
		Name <br>
		<input type = "text" name = "name">
		Title <br>
		<input type = "text" name = "title">
		Location <br>
		<input type = "text" name = "location">
		Description <br>
		<textarea name="desc" id="description"  rows="5" cols="127"></textarea><br>
		Small Picture <br>
		<input type="file" name="userfile" id="file">
		Big Picture <br>
		<input type="file" name="userfile2" id="file">
		<input class="button-right-group" type="submit" name="submit" value="ADD">
		<br>
	</form>
</body>
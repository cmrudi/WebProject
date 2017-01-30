<?php

function get_header() {
	$userId = $_GET["id"];
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
	  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
	  <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/map.css">
	  <link rel="stylesheet" href="css/chat.css">
	  <script src="js/google-maps.js"></script>
	  <script src="js/style.js"></script>
	</head>
	<body>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php"><img id="header-logo" src="img/piknix_logo.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li><a onclick="showSearchMenu()"><span class="glyphicon glyphicon-search"></span></a></li>
			<li><a href=<?php if ($userId != null) {echo "active-chat.php?id=".$userId; } else {echo "index.php"; } ?>><span class="glyphicon glyphicon-comment"></span></a></li>
			<li><a onclick="showUserMenu('username')"><span class="glyphicon glyphicon-user"></span></a></li>
			<li><a href=<?php if ($userId != null) {echo "general-menu.php?id=".$userId; } else {echo "general-menu.php"; } ?>><span class="glyphicon glyphicon-align-justify"></span></a></li> 
		  </ul>
		</div>
	  </div>
	</nav>
	<?php
}

?>

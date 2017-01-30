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
    	<div id="function-menu">
    		<div id="function-menu-box">
				<div id="username"><div id="photo-modal-button" class="photo-circle"></div><p class="username-text">username</p> <i class="glyphicon glyphicon-log-out"></i></div>
		  		<div id="bookmark-button"><div class="circle"><i class="glyphicon glyphicon-plane glyp-inside-circle"></i></div><p class="center-text">trip</p></div>
		  		<div id="bookmark-button"><div class="circle"><i class="glyphicon glyphicon-pushpin glyp-inside-circle"></i></div><p class="center-text">bookmarks</p></div>
		  		<div id="photo-modal" class="modal">
					<div class="modal-content">
					 	<div class="modal-header">
		      				<span id="exit" class="close">&times;</span>
		      				<h3>set your profile picture</h3>
		    			</div>
					    <div class="modal-body">
					      	<form name="photo" action="" method="post">
					      		<input type="hidden" name="userId" value=<?php $userId; ?>>
					      		<input type="file" name="file" onchange="readURL(this);" />
					      		<br>
					      		<br>
					      		<div style="width: 200px; height:200px">
					      			<img id="blah" src="#" alt="your image" />
					      		</div>
					      		<br>
					      		<br>
					      		<input type="submit" value="upload">
					  			<br>
					      	</form>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
    		<div id="function-menu-box">
  		    	<div id="how-it-works"><div class="circle"><span class="glyp-inside-circle glyp-about-us"> ?</span></div><p class="center-text">how it works</p></div>
  		    	<div id="about-us"><div class="circle"></div><p class="center-text">about us</p></div>
  		    	<div id="how-it-works-modal" class="modal">
					<div class="wide-modal modal-content">
						<div class="modal-header">
							<span id="exit-how-it-works" class="close">&times;</span>
							<h4>How it Works?</h4>
						</div>
						<div class="modal-body row">
							<div class="col-md-6">
								<h3>Apa Itu Piknix?</h3>
								<p>Tempat kamu mendapatkan pilihan lokasi wisata terbaik.<br>Diskusikan lokasi favoritmu bersama semua orang.</p>
								<br>
								<h3>Cara Kerja</h3>
								<h4>Tentukan Destinasi</h4>
								<p>Pilih destinasi yang kamu inginkan pada Map atau lakukan pencarian di kolom Search.<br> Jika destinasi yang kamu cari belum ada, mungkin memang belum saatnya kamu kesana.</p>
	 
								<h4>Dapatkan informasi</h4>
								<p>Semua informasi yang kamu butuhkan mengenai tempat yang kamu pilih bisa kamu dapatkan.<br> Diskusikan serta berbagi informasi melalui Obrolan bersama pengguna lain.</p>
	 
								<h4>Trip?</h4>
								<p>Setelah semua kamu dapatkan, ini saatnya buat merencanakan dalam sebuah Trip.</p>
							</div>
							<div class="col-md-6">
								<h3>Frequently Asked Questions</h3>
								<br>
								<h4>USER ID</h4>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Bagaimana cara membuat userID?</button>
							  <div id="demo1" class="collapse">
							    Tentukan username yang kamu ingin gunakan<br>
								Masukkan alamat email<br>
								Username dan PIN akan dikirim ke alamat emailmu<br>
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">Apakah userID bisa dirubah?</button>
							  <div id="demo2" class="collapse">
							    UserID tidak dapat dirubah
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo3">Apakah PIN bisa dirubah?</button>
							  <div id="demo3" class="collapse">
							    PIN diberikan unik setiap user dan tidak bisa dirubah
							  </div>

								<h4>MAP</h4>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo4">Apakah Map itu?</button>
							  <div id="demo4" class="collapse">
							    Menampilkan destinasi pariwisata pada suatu daerah yang dipilih
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo5">
								Bagaimana cara menambahkan destinasi baru?</button>
							  <div id="demo5" class="collapse">
							    Pengguna tidak dapat menambahkan destinasi.
							  </div>

								<h4>OBROLAN</h4>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo6">Apakah Obrolan itu?</button>
							  <div id="demo6" class="collapse">
							    Fitur untuk berkomunikasi dengan pengguna lain
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo7">Bagaimana cara mengirim foto dan dokumen lain pada Obrolan?</button>
							  <div id="demo7" class="collapse">
							    Obrolan pada piknix tidak mendukung untuk dilampirkan file baik berupa foto dan dokumen
							  </div>

								<h4>TRIP</h4>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo8">Apakah Trip itu?</button>
							  <div id="demo8" class="collapse">
							    Fitur untuk mempermudah perencanaan perjalanan yang dilakukan pengguna
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo9">Apakah TripID itu?</button>
							  <div id="demo9" class="collapse">
							    TripID adalah identitas setiap trip yang dibuat. Dapat digunakan untuk mencari sebuah Trip secara cepat di kolom Search
							  </div>
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo10">Bagaimana cara membuat Trip?</button>
							  <div id="demo10" class="collapse">
							    Setiap pengguna dapat membuat atau bergabung pada satu Trip. Pengguna dapat bergabung pada Trip lain setelah meninggalkan Trip yang lama atau Trip sebelumnya telah selesai.
							  </div>
							</div>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
				<div id="about-us-modal" class="modal">
					<div class="wide-modal modal-content">
						<div id="about-us-modal-header" class="modal-header">
							<span id="exit-about-us" class="close">&times;</span>
							<h3>About us</h3>
						</div>
						<div class="modal-body row">
							<div id="contact-us-left" class="col-md-6">
								<img id="about-us-logo" src="img/piknix_logo.png" />
								<p>Khaidir Yusuf | Lukman Farera | Cut Meurah Rudi</p>
								<hr class="about-us-hr">
								<h4>Piknix</h4>
								<p>Jalan Tamansari 42/56, Bandung</p>
								<p>e : admin@piknix.co</p>
								<hr class="about-us-hr">
								<a href="https://twitter.com/piknixid"><img id="about-us-tw" class="about-us-social-logo" src="img/ico-tw.png" /></a>
								<a href="https://www.facebook.com/piknixid" ><img id="about-us-fb" class="about-us-social-logo" src="img/ico-fb.png" /></a>
								<a href="https://www.instagram.com/piknixid/"><img id="about-us-ig" class="about-us-social-logo" src="img/ico-ig.png" /></a>
							</div>
							<div class="col-md-6">
								<form name="contact-us" id="contact-us-form" method="POST">
									<h3 id="hubungi-kami-text">Hubungi Kami</h3><br>
									<br><p class="about-us-text">Nama</p>
									<input class="about-us-text-box" type="text" name="name"><br><br>
									<p class="about-us-text">Alamat Email</p>
									<input class="about-us-text-box" type="email" name="email"><br><br>
									<p class="about-us-text">Perihal</p>
									<input class="about-us-text-box" type="text" name="perihal"><br><br>
									<p class="about-us-text">Pesan</p>
									<input class="about-us-text-box" type="text" name="pesan"><br><br>
									<input id="submit-about-us-form" type="submit" name="submit" value="kirim">
								</form>
							</div>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
  		    </div>
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




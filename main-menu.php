<?php

function get_main_menu($userId) { 
	$targetSearch = "http://$_SERVER[HTTP_HOST]/Piknix/home.php?id=".$userId;
	$bookmark = "http://$_SERVER[HTTP_HOST]/Piknix/bookmark.php?id=";
	$updateDataUrl = "http://$_SERVER[HTTP_HOST]/Piknix/backend/updateUserData.php";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT username,name,birth_date,city FROM user_auth WHERE id = '$userId'";
	$result = mysqli_query($conn,$query);
	$row = $result->fetch_assoc();
	$username = $row["username"];
	$name = $row["name"];
	$birthdate = $row["birth_date"];
	$city = $row["city"];



	?>

<div id="function-menu">
    		<!--Function Menu Box for Search -->
			<form class="search-form search-menu" name="search" method="POST" action =<?php echo '"'.$targetSearch.'"'; ?>>
				<input type="text" id="search" name="searchText" class="center-text" placeholder="Type to Search">
			</form>
    		<!--End Of Function Menu Box for User -->
    		<!--Function Menu Box for User -->
    		<div id="function-menu-box" class="user-menu">
				<div id="username">
					<div id="photo-modal-button" class="photo-circle"></div>
					<p class="username-text"><?php echo $username; ?></p>
					<br>
					<p id="logout-text">Log Out</p>
				</div>
		  		<div id="bookmark-button"><div class="circle"><i class="material-icons md-24 glyp-inside-circle">directions_walk</i></div><p class="center-text bookmark-menu-text">trip</p></div>
		  		<a href=<?php echo $bookmark.$userId ?>>
		  			<div id="bookmark-button"><div class="circle"><i class="material-icons md-24 glyp-inside-circle">bookmark</i></div><p class="center-text bookmark-menu-text">bookmarks</p></div>
		  		</a>
		  		<div id="photo-modal" class="modal">
					<div class="modal-content">
					 	<div class="modal-header">
		      				<span id="exit" class="close">&times;</span>
		      				<h3>set your profile picture</h3>
		    			</div>
					    <div class="modal-body">
					      	<form name="photo" action="" method="post">
					      		<div class="uploader">
								    <canvas id="imageCanvas" class="image-canvas"></canvas>
								    <div class="profile-pic-wrap">
								        <div id="demo-basic"></div>
								    </div>
								    <div class="download-button">
								      <input type="file" name="file" id="imageLoader" class="inputfile" />
								      <label for="imageLoader">Choose Photo</label>
								      <a class="basic-result button">Preview</a>
								    </div>
							  	</div>
					      	</form>
					      	<form class="edit-user-data-form" name="edit-user-data" action=<?php echo $updateDataUrl; ?> method="post">
					      		<h3 id="hubungi-kami-text">Edit User Data</h3><br>
					      		<br><p class="about-us-text">Nama</p>
					      		<input class="about-us-text-box" type="text" name="fullname" value=<?php echo $name; ?>><br><br>
					      		<p class="about-us-text">Kota</p>
					      		<input class="about-us-text-box" type="city" name="city" value=<?php echo $city; ?>><br><br>
					      		<p class="about-us-text">Tanggal Lahir</p>
					      		<input class="about-us-text-box" type="date" name="birthdate" value=<?php echo $birthdate; ?>><br><br>
					      		<input type="hidden" name="userid" value=<?php echo $userId;?>>
								<input class="submit-button" type="submit" name="submit" value="Update">
					      	</form>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
			<!--End of Function Menu Box for User -->
			<!--Function Menu Box for HIW and About us -->
    		<div id="function-menu-box" class="more-menu">
  		    	<div id="how-it-works"><i class="material-icons md-36 glyp-about-us">help</i><p class="center-text">how it works</p></div>
  		    	<div id="about-us"><i class="material-icons md-36 glyp-about-us">stars</i><p class="center-text">about us</p></div>
  		    	<div id="how-it-works-modal" class="modal">
					<div class="wide-modal modal-content">
						<div id="how-it-works-modal-header" class="modal-header">
							<span id="exit-how-it-works" class="close">&times;</span>
							<h3>How it Works?</h3>
						</div>
						<div class="modal-body row">
							<div id="how-it-works-left" class="col-md-6">
								<h4 class="orange-text">Apa Itu Piknix?</h4>
								<p>Tempat kamu mendapatkan pilihan lokasi wisata terbaik. Diskusikan lokasi favoritmu bersama semua orang.</p>
								<br>
								<h4 class="orange-text">Cara Kerja</h4>
								<h5 class="how-it-works-title">Tentukan Destinasi</h5>
								<p>Pilih destinasi yang kamu inginkan pada Map atau lakukan pencarian di kolom Search. Jika destinasi yang kamu cari belum ada, mungkin memang belum saatnya kamu kesana.</p>
	 
								<h5 class="how-it-works-title">Dapatkan informasi</h5>
								<p>Semua informasi yang kamu butuhkan mengenai tempat yang kamu pilih bisa kamu dapatkan. Diskusikan serta berbagi informasi melalui Obrolan bersama pengguna lain.</p>
	 
								<h5 class="how-it-works-title">Trip?</h5>
								<p>Setelah semua kamu dapatkan, ini saatnya buat merencanakan dalam sebuah Trip.</p>
							</div>
							<div id="how-it-works-right" class="col-md-6">
								<h4 class="orange-text">Frequently Asked Questions</h4>
								<br>
								<h5>USER ID</h5>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo1">Bagaimana cara membuat userID?</button><br>
							  <div id="demo1" class="collapse faq-answer">
							    Tentukan username yang kamu ingin gunakan<br>
								Masukkan alamat email<br>
								Username dan PIN akan dikirim ke alamat emailmu<br>
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo2">Apakah userID bisa dirubah?</button><br>
							  <div id="demo2" class="collapse faq-answer">
							    UserID tidak dapat dirubah
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo3">Apakah PIN bisa dirubah?</button><br>
							  <div id="demo3" class="collapse faq-answer">
							    PIN diberikan unik setiap user dan tidak bisa dirubah
							  </div>

								<h5>MAP</h5>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo4">Apakah Map itu?</button><br>
							  <div id="demo4" class="collapse faq-answer">
							    Menampilkan destinasi pariwisata pada suatu daerah yang dipilih
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo5">
								Bagaimana cara menambahkan destinasi baru?</button><br>
							  <div id="demo5" class="collapse faq-answer">
							    Pengguna tidak dapat menambahkan destinasi.
							  </div>

								<h5>OBROLAN</h5>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo6">Apakah Obrolan itu?</button><br>
							  <div id="demo6" class="collapse faq-answer">
							    Fitur untuk berkomunikasi dengan pengguna lain
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo7">Bagaimana cara mengirim foto dan dokumen lain pada Obrolan?</button><br>
							  <div id="demo7" class="collapse faq-answer">
							    Obrolan pada piknix tidak mendukung untuk dilampirkan file baik berupa foto dan dokumen
							  </div>

								<h5>TRIP</h5>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo8">Apakah Trip itu?</button><br>
							  <div id="demo8" class="collapse faq-answer">
							    Fitur untuk mempermudah perencanaan perjalanan yang dilakukan pengguna
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo9">Apakah TripID itu?</button><br>
							  <div id="demo9" class="collapse faq-answer">
							    TripID adalah identitas setiap trip yang dibuat. Dapat digunakan untuk mencari sebuah Trip secara cepat di kolom Search
							  </div>
								<button type="button" class="btn btn-info faq-button" data-toggle="collapse" data-target="#demo10">Bagaimana cara membuat Trip?</button><br>
							  <div id="demo10" class="collapse faq-answer">
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
									<input id="submit-button" type="submit" name="submit" value="kirim">
								</form>
							</div>
						</div>
						<div class="modal-footer"></div>
					</div>
				</div>
  		    </div>
  		    <!--End ofFunction Menu Box for HIW and About us -->
		</div>
	<script src="js/jquery.js"></script>
	<script src="js/croppie.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/app.js"></script>
	<script type="text/javascript">
	$('.tab-search').click(function(e){
	    //make all tabs inact
	    $('.search-menu').show();
	    $('.search-form').show();
	    $('.user-menu').hide();
	    $('.more-menu').hide();
	    $('.main-content').height(465);
	});
	$('.tab-user').click(function(e){
	    //make all tabs inact
	    $('.search-menu').hide();
	    $('.search-form').hide();
	    $('.user-menu').show();
	    $('.more-menu').hide();
	    $('.main-content').height(465);
	});
	$('.tab-more').click(function(e){
	    //make all tabs inact
	    $('.search-menu').hide();
	    $('.search-form').hide();
	    $('.user-menu').hide();
	    $('.more-menu').show();
	    $('.main-content').height(465);
	});

</script>

<?php } ?>
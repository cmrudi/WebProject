<?php include 'header.php';
		get_header();
?>
<div class="row">
  <div class="col-sm-7">
    <iframe width="100%" height="510px" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=110069293083852065946.00047e2506156dd8d127b&amp;ll=27.727526,85.310855&amp;spn=0.021197,0.038581&amp;z=14&amp;iwloc=00047e251edcecb28ba7c&amp;output=embed"></iframe>
  </div>
  <div class="col-sm-5">
    <div class="picnix-container">
		<div id="search" class="center-text">Type to Search</div>
		
		<?php 
		for ($i = 0; $i <= 3; $i++) {
			?>
			<div class="row">
				<div id="content-bookmark" class="center-text"> bookmark</div>
				<div id="content-bookmark" class="center-text"> bookmark</div>
				<div id="content-bookmark" class="center-text"> bookmark</div>
			</div>
			
			<?php
		} 
		
		?>
    </div>
  </div>
</div>

</body>
</html>

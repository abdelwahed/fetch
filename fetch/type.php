<?php
session_start();

if(isset($_GET['mapThings'])) {
	if("1" == $_GET['mapThings']) {
		$searchLocation = htmlspecialchars($_GET['searchLocation']);
		$searchType = htmlspecialchars($_GET['type']);
	}
} else if( isset($_GET['type'])) {
	$searchLocation = "Houston";
	switch( $_GET['type'] ) {
		case "food":
		 	$searchType = ['food'];
			break;
		case "bars":
			$searchType = ['bar'];
			break;
		case "coffee":
			$searchType = ['coffee'];
			break;
		case "shops":
			$searchType = ['shopping'];
			break;
		case "parks":
			$searchType = ['park'];
			break;
		case "dogNeeds":
			$searchType = ['dogNeeds'];
			break;
		}
		//use these in an echo statement to call different js files based on the type down in the head link stack
} else {
	$searchLocation = "Houston";
	$searchType = ['food', 'bar', 'coffee', 'shopping', 'park', 'dogNeeds'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fetch | finding dog-friendly places</title>
	<meta name="description" content="Find all the dog-friendly locations in your area, and bring your dog with you wherever you go.">
	<link rel="shortcut icon" href="img/favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mediaqueries.css">
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700|Karla' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="titleBand"><img class="fetchTitle img-responsive center-block" alt="Responsive image" src="img/fetch_title_narrow.png"></div>
	<nav>
		<!-- hamburger on mobile display -->
		<a id="hamburger_icon" href="#menu">
			<span id="hamburger_top" class="hamburger_bar"></span>
			<span id="hamburger_middle" class="hamburger_bar"></span>
			<span id="hamburger_bottom" class="hamburger_bar"></span>
		</a>
		<div class="navbar">
			<ul class="nav navbar-nav">
				<li id="areaNav"><a href="way.php"><h3>FIND YOUR WAY</h3></a></li>
				<li id="logInNav" data-toggle="logInModal" data-target="#logInModal"><a><h3>LOG IN</h3></a></li>
				<li id="tennisball"><a href="index.php"><img class="img-responsive center-block" src="img/tennisball.png"></a></li>
				<li id="signUpNav" data-toggle="signUpModal" data-target="#signUpModal"><a><h3>SIGN UP</h3></a></li>
				<li id="typeNav"><a href="index.php#browseType"><h3>BROWSE BY TYPE</h3></a></li>
			</ul>
		</div>
	</nav>
<!-- MODALS MODALS MODALS MODALS MODALS MODALS MODALS MODALS MODALS --> 
	<div id="signUpModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">SIGN UP</h4>
	      </div>
	      <div class="modal-body">
	      	<form class="form-inline" action="register.php" method="post">
				<div class="form-group form-inline">
					<label for="username"><h4>Username: </h4></label>
					<input type="text" class="form-control" name="username" placeholder="Dog puns preferred.">
				</div>
				</div>
				<div class="form-group form-inline">
					<label for="password"><h4>Password: </h4></label>
					<input type="text" class="form-control" name="password" placeholder="password">
				</div>
				<div class="form-group form-inline">
    				<label for="profilePic"><h4>Upload a Profile Picture: </h4></label>
    				<input type="file" id="profilePic">
 				 </div>
				<button type="submit" class="btn btn-default">JOIN</button>
			</form>
	      </div>
	      <div class="modal-footer"></div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- MODALS MODALS MODALS MODALS MODALS MODALS MODALS MODALS MODALS -->
	<div id="logInModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">LOG IN</h4>
	      </div>
	      <div class="modal-body">
	      	<form class="form-inline" action="login.php" method="post">
				<div class="form-group form-inline">
					<label for="username"><h4>Username: </h4></label>
					<input type="text" class="form-control" name="username" placeholder="username">
				</div>
				</div>
				<div class="form-group form-inline">
					<label for="password"><h4>Password: </h4></label>
					<input type="text" class="form-control" name="password" placeholder="password">
				</div>
				<button type="submit" class="btn btn-default">LOG IN</button>
			</form>
	      </div>
	      <div class="modal-footer"></div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP MAP -->
	<section id="homeType">
		<div class="typeTitleMap"></div>
		<div id="map-canvas">
		</div>
	</section>
<!-- LIST LIST LIST LIST LIST LIST LIST LIST LIST LIST LIST LIST LIST -->
	<section id="typeList">second div
	</section>
<!-- FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER FOOTER -->
	<div id="addNewSmall">
		<div class="whiteTransparentWrapper">
		<div class="submitText">
			<h2>SUBMIT A NEW</h2><br>
			<h1>DOG – FRIENDLY</h1><br>
			<h2>LOCATION</h2><br>
		</div>
		<form id="smallForm" class="form-inline">
			<div class="form-group">
				<label for="newPlaceType"><h4>Type: </h4></label>
					<select id="newPlaceType" class="form-control">
						<option><p>Food</p></option>
						<option><p>Bars</p></option>
						<option><p>Parks</p></option>
						<option><p>Coffee</p></option>
						<option><p>Shopping</p></option>
						<option><p>Dog Needs</p></option>
					</select>
			</div>
			<div class="form-group">
				<label for="newPlaceName"><h4>Name: </h4></label>
				<input type="text" class="form-control" id="newPlaceName" placeholder="What is it called?">
			</div>
			<br>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		</div>
		<footer>
			<div class="leftFoot">
				<h3>ABOUT FETCH</h3><br>
				<h3>CONTACT FETCH</h3><br>
				<h3>CAREERS AT FETCH</h3>
			</div>
			<div class="rightFoot">
				<a href="index.php#browseType"><h3>BROWSE FETCH</h3></a><br>
				<a href="index.php#addNew"><h3>SUBMIT TO FETCH</h3></a><br>
				<h3 class="signUpFoot" data-toggle="signUpModal" data-target="#signUpModal">BECOME A MEMBER OF FETCH</h3>
			</div>
			<div class="middleFoot">
				<h3>TWITTER</h3><br>
				<h3>FACEBOOK</h3><br>
				<h3>INSTAGRAM</h3>
			</div>
		</footer>
	</div>
    <script src="js/jquery-1.11.1.min.js"></script>
<!--     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtkpcLyTqPcP4K64ykd6Gdq7y2rx1aufo"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
	<!-- <?php echo'<script src="js/script-food.js"></script>'?> -->
</body>
</html>
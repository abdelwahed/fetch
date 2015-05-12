<?php
session_start();

include "includes/main.php";

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
				<li id="areaNav"><a href="dashboard.php"><h3>YOUR DASHBOARD</h3></a></li>
				<li id="logInNav" data-toggle="logInModal" data-target="#logInModal"><a><h3>LOG IN</h3></a></li>
				<li id="tennisball"><a href="index.php"><img class="img-responsive center-block" src="img/tennisball.png"></a></li>
				<li id="signUpNav" data-toggle="signUpModal" data-target="#signUpModal"><a><h3>SIGN UP</h3></a></li>
				<li id="typeNav"><a href="index.php#browseType"><h3>BROWSE BY TYPE</h3></a></li>
			</ul>
		</div>
	</nav>
<!-- MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL -->
	<div id="signUpModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">SIGN UP</h4>
	      </div>
	      <div class="modal-body">
	      <div class="container-fluid">
	      	<form class="form-horizontal" action="register.php" method="post">
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label"><h4>Username: </h4></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" placeholder="Dog puns preferred." required autofocus>
					</div>
				</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label"><h4>Password: </h4></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" placeholder="password" required>
					</div>
				</div>
 				<p><input type="hidden" name="submitted" value="1"></p>
 				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">JOIN</button>
				</div>
			</form>
			</div>
	      </div>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>
<!-- MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL -->
	<div id="logInModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">LOG IN</h4>
	      </div>
	      <div class="modal-body">
	      <div class="container-fluid">
	      	<form class="form-horizontal" action="login.php" method="post">
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label"><h4>Username: </h4></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" placeholder="username" required autofocus>
					</div>
				</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label"><h4>Password: </h4></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" placeholder="password" required>
					</div>
				</div>
				<p><input type="hidden" name="submitted" value="1"></p>
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">LOG IN</button>
				</div>
			</form>
	      </div>
	      </div>
	      <div class="modal-footer"></div>
	    </div>
	  </div>
	</div>
<!-- HOME HOME HOME HOME HOME HOME HOME HOME HOME HOME HOME-->
	<section id="home">
		<h2>FIND</h2><br>
		<h1>DOG – FRIENDLY</h1><br>
		<h2>IN THE CITY</h2><br>
		<a id="downArrow" href="#browseType">
			<img class="img-responsive center-block" src="img/down_arrow.png">
		</a>
		<!-- <form class="form-inline" action="type.php" method="get">
			<div class="form-group">
				<label for="formType"><h4>Type: </h4></label>
					<select class="form-control" name="formType">
						<option><p>Food</p></option>
						<option><p>Bars</p></option>
						<option><p>Parks</p></option>
						<option><p>Coffee</p></option>
						<option><p>Shopping</p></option>
						<option><p>Dog Needs</p></option>
						<option><p>All</p></option>
					</select>
			</div>
			<div class="form-group">
				<label for="searchLocation"><h4>City, State: </h4></label>
				<input type="text" class="form-control" name="searchLocation" placeholder="Houston, TX">
			</div><br>
			<button type="submit" class="btn btn-default">Fetch!</button>
		</form> -->
	</section>
	<section id="browseType">
		<div class="browse row">
			<a href="type.php?type=food">
				<div class="typeIcon col-md-4">
					<img id="foodIcon" class="img-responsive center-block" src="img/foodPic.png">
					<div class="typeLabel"><h2>FOOD</h2></div>
				</div>
			</a>
			<a href="type.php?type=bars">
				<div id="barsIcon" class="typeIcon col-md-4">
					<img class="img-responsive center-block" src="img/barsPic.png">
					<div class="typeLabel"><h2>BARS</h2></div>
				</div>
			</a>
			<a href="type.php?type=shops">
				<div id="shopsIcon" class="typeIcon col-md-4">
					<img class="img-responsive center-block" src="img/shopsPic.png"></a>
					<div class="typeLabel"><h2>SHOPS</h2></div>
				</div>
			</a>
		</div>
		<div class="browse row">
			<a href="type.php?type=coffee">
				<div id="coffeeIcon"  class="typeIcon col-md-4">
					<img class="img-responsive center-block" src="img/coffeePic.png">
					<div class="typeLabel"><h2>COFFEE</h2></div>
				</div>
			</a>
			<a href="type.php?type=park">
				<div id="parkIcon" class="typeIcon col-md-4">
					<img class="img-responsive center-block" src="img/parksPic.png">
					<div class="typeLabel"><h2>PARKS</h2></div>
				</div>
			</a>
			<a href="type.php?type=dogNeeds">
				<div id="dogIcon" class="typeIcon col-md-4">
					<img class="img-responsive center-block" src="img/dogPic.png">
					<div class="typeLabel"><h2>DOG NEEDS</h2></div>
				</div>
			</a>
		</div>
	</section>
	<section id="addNew">
		<div class="whiteTransparentWrapper">
		<h2>SUBMIT A NEW</h2><br>
		<h1>DOG – FRIENDLY</h1><br>
		<h2>PLACE IN THE CITY</h2><br>
		<form class="form-inline">
			<div class="form-group">
				<label for="type"><h4>Type: </h4></label>
					<select class="form-control">
						<option><p>Food</p></option>
						<option><p>Bars</p></option>
						<option><p>Parks</p></option>
						<option><p>Coffee</p></option>
						<option><p>Shopping</p></option>
						<option><p>Dog Needs</p></option>
					</select>
			</div>
			<div class="form-group">
				<label for="newPlaceName"><h4>Name of Place: </h4></label>
				<input type="text" class="form-control" id="newPlaceName" placeholder="What is it called?">
			</div>
			<button type="submit" class="btn btn-default">SUBMIT!</button>
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
	</section>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtkpcLyTqPcP4K64ykd6Gdq7y2rx1aufo"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>
<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_messages.php');

	//provide the value of the $title variable for this page
	$title = "Login";

	//retrieve the header
	require('header.php');
?>

<section id="main">

	<?php
		//call user_message() function
		$message = user_message();
	?>

	<div class="container">
		<form class="form-signin" id="loginForm" action="../controller/authentication.php" method="post">
			<h2 class="form-signin-heading">qPulse</h2>
			<label for="inputBadge" class="sr-only">Badge Number</label>
			<input type="text" name="badgeID" id="inputBadgeNumber" class="form-control" placeholder="Enter your Badge Number" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Enter your Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		</form>
	</div>


<?php
	//retrieve the footer
	require('footer.php');
?>
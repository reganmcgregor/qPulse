<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_warrants_arrests.php');

	//retrieve the chargeID from the URL
	$chargeID = $_GET['chargeID'];

	//call the delete_charge() function
	$result = delete_charge($chargeID);
	
	//create user messages
	if($result){
		//if charge is successfully deleted, create a success message to display on the referring page
		$_SESSION['success'] = 'Charge successfully deleted.';
		//redirect to products.php
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}else{
		//if charge is not successfully deleted, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>

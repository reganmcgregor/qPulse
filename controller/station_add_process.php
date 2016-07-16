<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_stations.php');

	//retrieve the station details from the form fields using the $_POST array
	$name = $_POST['name'];
	$division = $_POST['division'];
	$street = $_POST['street'];
	$streetType = $_POST['streetType'];
	$suburb = $_POST['suburb'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phone = $_POST['phone'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	$badgeID = $_POST['badgeID'];

	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if (empty($name) || empty($division) || empty($phone) || empty($email) || empty($badgeID))
	{
		//if required fields are empty initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the stations page to display the message
		header("location:../view/stations.php");
		exit();
	}
	//END SERVER-SIDE VALIDATION
	else
	{
		//call the add_station() function
		$result = add_station($name, $division, $street, $streetType, $suburb, $state, $postcode, $phone, $fax, $email, $badgeID);

		//create user messages
		if($result)
		{
			//if station is successfully added, create a success message to display on the stations page
			$_SESSION['success'] = 'Station successfully added.';
			//redirect to stations.php
			header('location:../view/stations.php');
		}
		else
		{
			//if station is not successfully added, create an error message to display on the stations page
			$_SESSION['error'] = 'An error has occurred. Please try again.';
			//redirect to stations.php
			header('location:../view/stations.php');
		}
	}
?>
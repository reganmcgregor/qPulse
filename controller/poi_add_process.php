<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_pois.php');

	//retrieve the officer details from the form fields using the $_POST array
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$ethnicity = $_POST['ethnicity'];
	$eyes = $_POST['eyes'];
	$height = $_POST['height'];
	$weight = $_POST['weight'];
    $street = $_POST['street'];
	$streetType = $_POST['streetType'];
	$suburb = $_POST['suburb'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phone = $_POST['phone'];
	$mobile = $_POST['mobile'];

	//set default mugshot for person of interest based on gender
	if($gender == 0) {
        $photo = "male.jpg";
    } elseif ($gender == 1) {
        $photo = "female.jpg";
    }

	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	elseif ( empty($firstName) || empty($lastName) || empty($dob))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the registration page to display the message
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_poi() function
	$result = add_poi($firstName, $lastName, $dob, $gender, $ethnicity, $eyes, $height, $weight, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $photo);
    
	//create user messages
	if($result)
	{
		//if person of interest is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Person Of Interest created successfully.';
		//redirect to referring page
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if person of interest is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_officers.php');

	//retrieve the officer details from the form fields using the $_POST array
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$street = $_POST['street'];
	$streetType = $_POST['streetType'];
	$suburb = $_POST['suburb'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phone = $_POST['phone'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$rank = $_POST['rank'];
	$role = $_POST['role'];
	$stationID = $_POST['stationID'];
	$duty = $_POST['duty'];

	//START SERVER-SIDE VALIDATION
	//check if the password is a minimum of 8 characters long
	if (strlen($password) < 8)
	{
		//if password is less than 8 characters intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Password must be 8 characters or more.'; 
		//redirect to the officers page to display the message
		header("location:../view/officers.php");
		exit();
	}
	//check if all required fields have data
	elseif (empty($password) || empty($firstName) || empty($lastName) || empty($email) || empty($stationID))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the officers page to display the message
		header("location:../view/officers.php");
		exit();
	}
	//check if the email is valid
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		//if the email is not valid intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Please enter a valid email address.';
		//redirect to the registration page to display the message
		header("location:../view/officers.php");
		exit();
	}
	
	//call the count_email() function
	$count = count_email($email);
		
	if($count > 0)
	{ 
		//if there are any matching rows intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Email taken. Please retry.'; 
		//redirect to the officers page to display the message
		header("location:../view/officers.php");
		exit();
	}
	//END SERVER-SIDE VALIDATION
	
	//generate a random salt value using the MD5 encryption method and the PHP uniqid() and rand() functions
	$salt = md5(uniqid(rand(), true));
	
	//encrypt the password (with the concatenated salt) using the SHA256 encryption method and the PHP hash() function
	$password = hash('sha256', $password.$salt); //generate the hashed password with the salt value

	//call the add_officer() function
	$result = add_officer($password, $salt, $firstName, $lastName, $dob, $gender, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $email, $rank, $role, $stationID, $duty);

	//create user messages
	if($result)
	{
		//if officer is successfully added, create a success message to display on the officers page
		$_SESSION['success'] = 'Officer created successfully.';
		//redirect to officers.php
		header('location:../view/officers.php');
	}
	else
	{
		//if officer is not successfully added, create an error message to display on the officers page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to officers.php
		header('location:../view/officers.php');
	}
?>
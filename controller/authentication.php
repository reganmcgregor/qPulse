<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_officers.php');
	
	//retrieve the username and password entered into the form fields using the $_POST array
	$badgeID = $_POST['badgeID'];
	$password = $_POST['password']; 
	
	//call the retrieve_salt() function
	$result = retrieve_salt($badgeID);
	
	//retrieve the random salt from the database
	$salt = $result['salt'];
	//generate the hashed password with the salt value
    $password = hash('sha256', $password.$salt); 
	
	//call the login() function
	$count = login($badgeID, $password);
	
	//if there is one matching record
	if($count == 1)
	{ 
		//start the user session to allow authorised access to secured web pages
		//set session variables for use within system
		$_SESSION['user'] = $badgeID;
        //set session role variable for function display options
        $_SESSION['role'] = $result['role'];
		//if login is successful, create a success message to display on the dashboard page
		$_SESSION['success'] = 'Hello ' . $result['rank'] . ' ' . $result['lastName'] . '. Have a great day!';
		//redirect to dashboard.php
		header('location:../view/dashboard.php');
	}
	else
	{
		//if login not successful, create an error message to display on the login page
		$_SESSION['error'] = 'Incorrect username or password. Please try again.';
		//redirect to login.php
		header('location:../view/login_form.php');
	}	
?>
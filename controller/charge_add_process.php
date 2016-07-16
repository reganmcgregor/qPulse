<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_warrants_arrests.php');

	//retrieve the charge details from the form fields using the $_POST array
	$warrantID = $_POST['warrantID'];
	$offenceID = $_POST['offenceID'];

	//check if all required fields have data
	if (empty($warrantID) || empty($offenceID))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_charge() function
    $result = add_charge($warrantID, $offenceID);

	//create user messages
	if($result)
	{
		//if charge is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Charge created successfully.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if charge is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
    require('../model/functions_notes.php');

	//retrieve the person of interest note details from the form fields using the $_POST array
	$poiID = $_POST['poiID'];
    $content = $_POST['note'];

	//check if all required fields have data
	if (empty($poiID) || empty($content))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the registration page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_poi_note() function
	$result = add_poi_note($content, $poiID);

	//create user messages
	if($result)
	{
		//if note is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Note created successfully.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if note is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
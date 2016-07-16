<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_notes.php');

	//retrieve the noteID from the URL
	$noteID = $_GET['noteID'];

	//call the delete_note() function
	$result = delete_note($noteID);
	
	//create user messages
	if($result){
		//if note is successfully deleted, create a success message to display on the referring page
		$_SESSION['success'] = 'Note successfully deleted.';
		//redirect to referring page
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}else{
		//if note is not successfully deleted, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>

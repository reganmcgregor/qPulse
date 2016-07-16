<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_jobs.php');
	require('../model/functions_pois.php');
	require('../model/functions_notes.php');

	//retrieve the poiID and jobID from the URL
	$poiID = $_GET['poiID'];
	$jobID = $_GET['jobID'];

    //call the get_poi_relationship function
    $result = get_poi_relationship();

    $firstName = $result['poiFirstName'];
    $lastName = $result['poiLastName'];
    $relationship = $result['relationship'];

    //create relevant note to add to job
    $content = "<a href=\"poi_update_form.php?poiID=" . $poiID . "\">". $firstName . " " . $lastName . "</a> was removed as " . $relationship . " from job.";

    //START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if (empty($poiID) || empty($jobID) || empty($firstName) || empty($lastName) || empty($relationship))
	{
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the registration page to display the message
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION
	
	//call the delete_poi_job() function
	$result = delete_poi_job($jobID, $poiID);

	//create user messages
	if($result)
	{
		//if person of interest is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Person Of Interest removed successfully.';
		add_job_note($content, $jobID);
		//redirect to referring
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if person of interest is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
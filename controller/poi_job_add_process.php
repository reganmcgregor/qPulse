<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_jobs.php');
    require('../model/functions_pois.php');
    require('../model/functions_offences.php');
    require('../model/functions_notes.php');

	//retrieve the person of interest details from the form fields using the $_POST array
	$poiID = $_POST['poiID'];
	$jobID = $_POST['jobID'];
	$relationship = $_POST['relationship'];

	//call the get_poi_by_poiID function
    $result = get_poi_by_poiID($poiID);

    $firstName = $result['firstName'];
    $lastName = $result['lastName'];

	//create relevant note to add to job
    $content = "<a href=\"poi_update_form.php?poiID=" . $poiID . "\">". $firstName . " " . $lastName . "</a> was added to job as " . $relationship . ".";

    //START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if (empty($poiID) || empty($jobID) || empty($relationship) || empty($firstName) || empty($lastName))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	//call the count_poi_job() function
	$count = count_poi_job($jobID, $poiID);


	if($count > 0)
	{
		//if there are any matching rows intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Person Of Interest already assigned to job. Please retry.';
		//redirect to the referring page to display the message
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the ad_poi_job() function
    $result = add_poi_job($jobID, $poiID, $relationship);

	//create user messages
	if($result)
	{
		//if person of interest is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Person Of Interest added successfully.';
        add_job_note($content, $jobID);
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
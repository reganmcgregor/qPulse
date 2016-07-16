<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_jobs.php');
    require('../model/functions_officers.php');
    require('../model/functions_offences.php');
    require('../model/functions_notes.php');

	//retrieve the badgeID and jobID from the URL
    $badgeID = $_GET['badgeID'];
    $jobID = $_GET['jobID'];

	//call the get_officer_by_badgeID function
    $result = get_officer_by_badgeID($badgeID);

    $firstName = $result['firstName'];
    $lastName = $result['lastName'];
    $rank = $result['rank'];

    //create relevant note to add to job
    $content = $rank . " " . $lastName . ", " . $firstName . " was added to job.";

	//check if all required fields have data
	if (empty($badgeID) || empty($jobID) || empty($firstName) || empty($lastName) || empty($rank))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	//call the count_officer_job() function
	$count = count_officer_job($jobID, $badgeID);

	if($count > 0)
	{
		//if there are any matching rows intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Officer already on job. Please retry.';
		//redirect to the registration page to display the message
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_officer_job() function
    $result = add_officer_job($jobID, $badgeID);

	//create user messages
	if($result)
	{
		//if officer is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Officer added successfully.';
        //call the add_job_note() function
        add_job_note($content, $jobID);
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if officer is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
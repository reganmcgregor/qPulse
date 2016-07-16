<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_fines.php');
    require('../model/functions_officers.php');
    require('../model/functions_offences.php');
    require('../model/functions_notes.php');

	//retrieve the fine details from the form fields using the $_POST array
    $status = 0;
    $offenceID = $_POST['offenceID'];
	$poiID = $_POST['poiID'];
    $jobID = $_POST['jobID'];

    //set jobID to NULL if empty as it is a foreign key and needs to contain number or NULL
    if(empty($jobID)) {
        $jobID = NULL;
    }
    $badgeID = $_POST['badgeID'];

    //call the get_officer_station() function
    $result = get_officer_station($badgeID);
    $stationID = $result['stationID'];

    //call the get_offence_penalty function
    $result = get_offence_penalty($offenceID);
    $penalty = $result['penalty'];

    $content = $_POST['note'];

	//check if all required fields have data
	if (empty($offenceID) || empty($poiID) || empty($badgeID) || empty($stationID))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_fine() function
	$result = add_fine($status, $offenceID, $poiID, $jobID, $stationID, $badgeID, $penalty);


	//create user messages
	if($result)
	{
		//if fine is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Fine created successfully.';
        //if fine contains note call the add_fine_note() with lastInsertId function, create a success message to display on the referring page
        if(!empty($content)){
            $lastId = $conn->lastInsertId();
            add_fine_note($content, $lastId);
            $_SESSION['success'] = 'Fine created successfully. Note created successfully.';
        }
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if fine is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_warrants_arrests.php');
    require('../model/functions_notes.php');

    //retrieve the warrant details from the form fields using the $_POST array and set the status
    $status = 0;
	$poiID = $_POST['poiID'];
    $jobID = $_POST['jobID'];

    //set jobID to NULL if empty as it is a foreign key and needs to contain number or NULL
    if(empty($jobID)) {
        $jobID = NULL;
    }
    $court = $_POST['court'];
    $judge = $_POST['judge'];
    $stationID = $_POST['stationID'];

    $content = $_POST['note'];

	//check if all required fields have data
	if (empty($poiID) || empty($stationID))
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	//END SERVER-SIDE VALIDATION

	//call the add_warrant() function
	$result = add_warrant($status, $poiID, $jobID, $court, $judge, $stationID);

	//create user messages
	if($result)
	{
		//if warrant is successfully added, create a success message to display on the referring page
		$_SESSION['success'] = 'Warrant created successfully.';
        if(!empty($content)){
            $lastId = $conn->lastInsertId();
            add_warrant_note($content, $lastId);
            $_SESSION['success'] = 'Warrant created successfully. Note created successfully.';
        }
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		//if warrant is not successfully added, create an error message to display on the referring page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_jobs.php');
    require('../model/functions_notes.php');

    //retrieve the job details from the form fields using the $_POST array and set status
    $status = 0;
    $priority = $_POST['priority'];
    $jobCodeID = $_POST['jobCodeID'];
    $stationID = $_POST['stationID'];

    $content = $_POST['note'];

    //check if all required fields have data
    if (empty($jobCodeID) || empty($stationID))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the add_job() function
    $result = add_job($status, $priority, $jobCodeID, $stationID);

    //create user messages
    if($result)
    {
        //if job is successfully added, create a success message to display on the job page
        $_SESSION['success'] = 'Job created successfully.';
        //if job is successfully created, create a success message to display on the job page
        $lastId = $conn->lastInsertId();
        //if job contains note call the add_job_note() with lastInsertId function, create a success message to display on the job page
        if(!empty($content)){
            add_job_note($content, $lastId);
            $_SESSION['success'] = 'Job created successfully. Note created successfully.';
        }
        //redirect to job page
        header('location:../view/job.php?jobID=' . $lastId);
    }
    else
    {
        //if job is not successfully added, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>
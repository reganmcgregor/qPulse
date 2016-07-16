<?php
    //start session management
    session_start();
    //include authorisation management
    require('../controller/authorisation.php');
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_jobs.php');

    //retrieve the jobID and status from URL
    $jobID = $_GET['jobID'];
    $status = $_GET['status'];

    //call the update_job_status() function
    $result = update_job_status($jobID, $status);

    //create user messages
    if($result)
    {
        //if status is successfully updated, create a success message to display on the referring page
        $_SESSION['success'] = 'Job status successfully updated.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        //if status is not successfully updated, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>
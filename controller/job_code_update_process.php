<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_job_codes.php');

    //retrieve the job code details from the form fields using the $_POST array
    $jobCodeID = $_POST['jobCodeID'];
    $code = $_POST['code'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($jobCodeID) || empty($code) || empty($category) || empty($description))
    {
        //if required fields are empty initialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the job code page to display the message
        header("location:../view/job_codes.php");
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_job_code() function
    $result = update_job_code($jobCodeID, $code, $category, $description);

    //create user messages
    if($result)
    {
        //if job code is successfully updated, create a success message to display on the job code page
        $_SESSION['success'] = 'Job code updated successfully.';
        //redirect to officers.php
        header('location:../view/job_codes.php');
    }
    else
    {
        //if job code is not successfully updated, create an error message to display on the job code page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to officers.php
        header('location:../view/job_codes.php');
    }


?>
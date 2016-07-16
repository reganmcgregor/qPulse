<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_warrants_arrests.php');
    require('../model/functions_notes.php');

    //retrieve the warrant details from the form fields using the $_POST array and set the status
    $warrantID = $_POST['warrantID'];
    $jobID = $_POST['jobID'];
    if(empty($jobID)) {
        $jobID = NULL;
    }
    $court = $_POST['court'];
    $judge = $_POST['judge'];

    $content = $_POST['note'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($warrantID))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the add_user() function
    $result = update_warrant($warrantID, $jobID, $court, $judge);

    //create user messages
    if($result)
    {
        //if warrant is successfully updated, create a success message to display on the referring page
        $_SESSION['success'] = 'Warrant updated successfully.';
        if(!empty($content)){
            add_warrant_note($content, $warrantID);
            $_SESSION['success'] = 'Warrant updated successfully. Note created successfully.';
        }
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        //if warrant is not successfully updated, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


?>
<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_fines.php');
    require('../model/functions_notes.php');

    //retrieve the fine details from the form fields using the $_POST array
    $fineID = $_POST['fineID'];
    $jobID = $_POST['jobID'];

    //set jobID to NULL if empty as it is a foreign key and needs to contain number or NULL
    if(empty($jobID)) {
        $jobID = NULL;
    }

    $content = $_POST['note'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($fineID))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_fine() function
    $result = update_fine($fineID, $jobID);

    //create user messages
    if($result)
    {
        //if fine is successfully updated, create a success message to display on the referring page
        $_SESSION['success'] = 'Fine updated successfully.';
        //if fine contains note call the add_fine_note() with $fineID function, create a success message to display on the referring page
        if(!empty($content)){
            add_fine_note($content, $fineID);
            $_SESSION['success'] = 'Fine updated successfully. Note created successfully.';
        }
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        //if fine is not successfully updated, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


?>
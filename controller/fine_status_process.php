<?php
    //start session management
    session_start();
    //include authorisation management
    require('../controller/authorisation.php');
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_fines.php');

    //retrieve the fineID and status from URL
    $fineID = $_GET['fineID'];
    $status = $_GET['status'];

    //call the update_fine_status() function
    $result = update_fine_status($fineID, $status);

    //create user messages
    if($result)
    {
        //if fine status is successfully updated, create a success message to display on the referring page
        $_SESSION['success'] = 'Fine status successfully updated.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        //if fine status is not successfully updated, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>
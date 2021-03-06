<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_offences.php');

    //retrieve the offence details from the form fields using the $_POST array
    $offenceID = $_POST['offenceID'];
    $name = $_POST['name'];
    $act = $_POST['act'];
    $section = $_POST['section'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $penalty = $_POST['penalty'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($offenceID) || empty($name) || empty($act) || empty($section) || empty($description))
    {
        //if required fields are empty initialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the referring page to display the message
        header("location:../view/offences.php");
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_offence() function
    $result = update_offence($offenceID, $name, $act, $section, $description, $type, $penalty);

    //create user messages
    if($result)
    {
        //if offence is successfully updated, create a success message to display on the referring page
        $_SESSION['success'] = 'Offence updated successfully.';
        //redirect to referring page
        header('location:../view/offences.php');
    }
    else
    {
        //if offence is not successfully updated, create an error message to display on the referring page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to referring page
        header('location:../view/offences.php');
    }


?>
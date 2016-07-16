<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_officers.php');

    //retrieve the officer details from the form fields using the $_POST array
    $badgeID = $_POST['badgeID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $street = $_POST['street'];
    $streetType = $_POST['streetType'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $rank = $_POST['rank'];
    $role = $_POST['role'];
    $stationID = $_POST['stationID'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if ( empty($firstName) || empty($lastName) || empty($email) || empty($stationID))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the registration page to display the message
        header("location:../view/officers.php");
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_officer() function
    $result = update_officer($badgeID, $firstName, $lastName, $dob, $gender, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile, $email, $rank, $role, $stationID);

    //create user messages
    if($result)
    {
        //if officer is successfully updated, create a success message to display on the officers page
        $_SESSION['success'] = 'Officer updated successfully.';
        //redirect to officers.php
        header('location:../view/officers.php');
    }
    else
    {
        //if officer is not successfully updated, create an error message to display on the officers page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to officers.php
        header('location:../view/officers.php');
    }


?>
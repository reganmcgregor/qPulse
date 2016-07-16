<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_pois.php');

    //retrieve the person of interest details from the form fields using the $_POST array
    $poiID = $_POST['poiID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $ethnicity = $_POST['ethnicity'];
    $eyes = $_POST['eyes'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $street = $_POST['street'];
    $streetType = $_POST['streetType'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];

    //START SERVER-SIDE VALIDATION

    //check if all required fields have data
    if ( empty($firstName) || empty($lastName) || empty($dob))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the current person of interest page to display the message
        header('location:../view/poi_update_form.php?poiID=' . $poiID);
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_poi() function
    $result = update_poi($poiID, $firstName, $lastName, $dob, $gender, $ethnicity, $eyes, $height, $weight, $street, $streetType, $suburb, $state, $postcode, $phone, $mobile);

    //create user messages
    if($result)
    {
        //if person of interest is successfully updated, create a success message to display on the current person of interest page
        $_SESSION['success'] = 'Person Of Interest updated successfully.';
        //redirect to the current person of interest page to display the message
        header('location:../view/poi_update_form.php?poiID=' . $poiID);
    }
    else
    {
        //if person of interest is not successfully updated, create an error message to display on the current person of interest page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to the current person of interest page to display the message
        header('location:../view/poi_update_form.php?poiID=' . $poiID);
    }


?>
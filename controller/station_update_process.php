<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_stations.php');

    //retrieve the station details from the form fields using the $_POST array
    $stationID = $_POST['stationID'];
    $name = $_POST['name'];
    $division = $_POST['division'];
    $street = $_POST['street'];
    $streetType = $_POST['streetType'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];
    $badgeID = $_POST['badgeID'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($name) || empty($division) || empty($phone) || empty($email) || empty($badgeID))
    {
        //if required fields are empty initialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the stations page to display the message
        header("location:../view/stations.php");
        exit();
    }
    //END SERVER-SIDE VALIDATION

    //call the update_station() function
    $result = update_station($stationID, $name, $division, $street, $streetType, $suburb, $state, $postcode, $phone, $fax, $email, $badgeID);

    //create user messages
    if($result)
    {
        //if station is successfully updated, create a success message to display on the stations page
        $_SESSION['success'] = 'Station updated successfully.';
        //redirect to stations.php
        header('location:../view/stations.php');
    }
    else
    {
        //if station is not successfully updated, create an error message to display on the stations page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to stations.php
        header('location:../view/stations.php');
    }


?>
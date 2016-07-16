<?php
    //start session management
    session_start();
    //include authorisation management
    require('../controller/authorisation.php');
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_officers.php');

    //retrieve the badgeID and duty from URL
    $badgeID = $_GET['badgeID'];
    $duty = $_GET['duty'];

    //call the update_duty() function
    $result = update_duty($badgeID, $duty);

    //create user messages
    if($result)
    {
        //if duty is successfully updated, create a success message to display on the officers page
        $_SESSION['success'] = 'Officer duty successfully updated.';
        //redirect to officers page
        header('location:../view/officers.php');
    }
    else
    {
        //if duty is not successfully updated, create an error message to display on the officers page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        //redirect to officers page
        header('location:../view/officers.php');
    }
?>
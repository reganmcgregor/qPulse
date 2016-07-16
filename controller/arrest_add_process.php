<?php
    //start session management
    session_start();
    //connect to the database
    require('../model/database.php');
    //retrieve the functions
    require('../model/functions_warrants_arrests.php');
    require('../model/functions_notes.php');

    //retrieve the arrest details from the form fields using the $_POST array and set status
    $status = 1;
    $poiID = $_POST['poiID'];
    $jobID = $_POST['jobID'];

    //set jobID to NULL if empty as it is a foreign key and needs to contain number or NULL
    if(empty($jobID)) {
        $jobID = NULL;
    }
    $court = $_POST['court'];
    $judge = $_POST['judge'];
    $stationID = $_POST['stationID'];
    $arrestingBadgeID = $_POST['badgeID'];

    // retrieve processing officer from session
    $processingBadgeID = $_SESSION['user'];

    $content = $_POST['note'];

    //START SERVER-SIDE VALIDATION
    //check if all required fields have data
    if (empty($poiID))
    {
        //if required form fields are blank intialise a session called 'error' with an appropriate user message
        $_SESSION['error'] = 'All * fields are required.';
        //redirect to the referring page to display the message
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    //check if mugshot field has data
    if(!empty($_FILES['mugshot']['name']))
    {
        $mugshot = $_FILES['mugshot']['name']; //the PHP file upload variable for a file
        $randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters
        $newPhotoName = strtolower($randomDigit . "_" . $mugshot); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
        $target = "../src/img/mugshots/" . $newPhotoName; //the target for uploaded images

        $allowedExts = array('jpg', 'jpeg', 'gif', 'png'); //create an array with the allowed file extensions
        $tmp = explode('.', $_FILES['mugshot']['name']); //split the file name from the file extension
        $extension = end($tmp); //retrieve the extension of the photo e.g., png

        //check if the file is less than the maximum size of 500kb
        if($_FILES['mugshot']['size'] > 512000)
        {
            //if file exceeds maximum size initialise a session called 'error' with an appropriate user message
            $_SESSION['error'] = 'Your file size exceeds maximum of 500kb.';
            //redirect to the referring page to display the message
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        //check that only accepted image formats are being uploaded
        elseif(($_FILES['mugshot']['type'] == 'image/jpg') || ($_FILES['mugshot']['type'] == 'image/jpeg') || ($_FILES['mugshot']['type'] == 'image/gif') || ($_FILES['mugshot']['type'] == 'image/png') && in_array($extension, $allowedExts))
        {
            move_uploaded_file($_FILES['mugshot']['tmp_name'], $target); //move the image to images folder
        }
        else
        {
            //if a disallowed image format is uploaded initialise a session called 'error' with an appropriate user message
            $_SESSION['error'] = 'Only JPG, GIF and PNG files allowed.';
            //redirect to the referring page to display the message
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        //END SERVER-SIDE VALIDATION


        //call the update_poi_mugshot() function
        update_poi_mugshot($poiID, $newPhotoName);
        $result = add_arrest($status, $poiID, $jobID, $court, $judge, $stationID, $newPhotoName, $arrestingBadgeID, $processingBadgeID);

        //create user messages
        if($result)
        {
            //if arrest is successfully added, create a success message to display on the referring page
            $_SESSION['success'] = 'Arrest added successfully.';
            //if arrest contains note call the add_warrant_note() with lastInsertId function, create a success message to display on the referring page
            if(!empty($content)){
                $lastId = $conn->lastInsertId();
                add_warrant_note($content, $lastId);
                $_SESSION['success'] = 'Arrest updated successfully. Note created successfully.';
            }
            //redirect to referring page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            //if arrest is not successfully added, create an error message to display on the referring page
            $_SESSION['error'] = 'An error has occurred. Please try again.';
            //redirect to referring page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    else
    {
        //if arrest mugshot is not successfully uploaded, create an error message to display on the referring page
        $_SESSION['error'] = 'Error has occurred uploading Mugshot. Please try again.';
        //redirect to referring page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


?>
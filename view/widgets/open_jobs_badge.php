<?php
//start session management
session_start();
//include authorisation management
require('../../controller/authorisation.php');
//connect to the database
require('../../model/database.php');
//retrieve the functions
require('../../model/functions_jobs.php');

?>

    <?php
    $jobcount = count_open_jobs();
    echo $jobcount;
    ?>


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

<h1>
    <?php
    $jobcount = count_open_jobs();
    echo '<a href="jobs.php" style="text-decoration: none;color:#333"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>&nbsp;' . $jobcount . '</a>';
    ?>
</h1>

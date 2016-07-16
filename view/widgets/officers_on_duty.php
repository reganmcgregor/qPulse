<?php
//start session management
session_start();
//include authorisation management
require('../../controller/authorisation.php');
//connect to the database
require('../../model/database.php');
//retrieve the functions
require('../../model/functions_officers.php');

?>

<h1>
    <?php
    $officercount = count_officers();
    echo '<a href="officers.php" style="text-decoration: none;color:#333"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;' . $officercount . '</a>';
    ?>
</h1>

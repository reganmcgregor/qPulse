<?php
//start session management
session_start();
//include authorisation management
require('../../controller/authorisation.php');
//connect to the database
require('../../model/database.php');
//retrieve the functions
require('../../model/functions_warrants_arrests.php');
?>

<h1>
    <?php
    $warrantcount = count_warrants();
    echo '<a href="warrants.php" style="text-decoration: none;color:#333"><span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span>&nbsp;' . $warrantcount . '</a>';
    ?>
</h1>

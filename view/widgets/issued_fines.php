<?php
//start session management
session_start();
//include authorisation management
require('../../controller/authorisation.php');
//connect to the database
require('../../model/database.php');
//retrieve the functions
require('../../model/functions_fines.php');

?>

<h1>
    <?php
    $finecount = count_fines();
    echo '<a href="fines.php" style="text-decoration: none;color:#333"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>&nbsp;' . $finecount . '</a>';
    ?>
</h1>

<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_warrants_arrests.php');
require('../model/functions_jobs.php');
require('../model/functions_pois.php');
require('../model/functions_notes.php');
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

$jobID = $_GET['jobID'];

?>

<h3 class="sub-header">Officers On Job
    <?php
    if (!($_SESSION['role'] == 1)) {
        echo'<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addOfficerModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
    }
    ?>
</h3>
<table class="table table-hover">
    <thead>
    <th>Officer</th>
    <th>Station</th>
    <th></th>
    </thead>
    <?php
    //call the get_officers_by_job() function
    $result = get_officers_by_job($jobID);
    ?>
    <?php foreach($result as $row):?>
    <tr>
        <td><?php echo $row['rank']; ?> <?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td>
            <a href="../controller/officer_job_delete_process.php?badgeID=<?php echo $row['badgeID']; ?>&jobID=<?php echo $jobID; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
if(!$result){
    echo "<div class=\"well well-lg\">There are currently no Officers assigned to this Job.</div>";
}
?>
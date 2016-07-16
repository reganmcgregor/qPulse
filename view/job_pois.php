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

<h3 class="sub-header">Related Person's
    <?php
    if (!($_SESSION['role'] == 1)) {
        echo '<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addPoiJobModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
    }
    ?>
</h3>
<table class="table table-hover">
    <thead>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Relationship</th>
    <th></th>
    </thead>
    <?php
    //call the get_pois_by_job() function
    $result = get_pois_by_job($jobID);
    ?>
    <?php foreach($result as $row):?>
    <tr>
        <td><?php echo $row['poiFirstName']; ?></td>
        <td><?php echo $row['poiLastName']; ?></td>
        <td><?php echo $row['relationship']; ?></td>
        <td>
            <a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a></span>
            <a href="../controller/poi_job_delete_process.php?poiID=<?php echo $row['poiID']; ?>&jobID=<?php echo $jobID; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
if(!$result){
    echo "<div class=\"well well-lg\">There are currently no Persons Of Interest assigned to this Job.</div>";
}
?>
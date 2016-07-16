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
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

?>

<table class="table table-hover">
    <thead>
    <tr>
        <th>Job Number #</th>
        <th>Job Code</th>
        <th>Priority</th>
        <th>Responding Station</th>
        <th>Active Since</th>
        <th>Status</th>
        <th>Last Updated</th>
        <th></th>
    </tr>
    </thead>
    <?php
    //call the get_officers() function
    $result = get_jobs_by_badgeID($_SESSION['user']);
    ?>
    <?php foreach($result as $row):?>
        <tr <?php if(($row['priority']) == 0){echo 'class="danger"';} elseif (($row['priority']) == 1) {echo 'class="warning"';} ?>>
            <td><?php echo $row['jobID']; ?></td>
            <td><b><?php echo $row['jobCode']; ?></b><br /><?php echo $row['jobCodeDescription']; ?></td>
            <td>
                <?php
                if(($row['priority']) == 0){
                    echo '<a href="#" data-toggle="modal" data-target="#code1Modal" title="Code 1 - Very Urgent"><b>Code 1</b> <br />Very Urgent</a>';
                } elseif (($row['priority']) == 1) {
                    echo '<a href="#" data-toggle="modal" data-target="#code2Modal" title="Code 2 - Urgent"><b>Code 2</b> <br />Urgent</a>';
                } elseif (($row['priority']) == 2) {
                    echo '<a href="#" data-toggle="modal" data-target="#code3Modal" title="Code 3 - Routine"><b>Code 3</b> <br />Routine</a>';
                }
                ?>
            </td>
            <td><?php echo $row['stationName']; ?></td>
            <td>
                <?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?>
            </td>
            <td>
                <?php
                if(($row['status']) == 0){
                    echo '<span class="label label-success">Open</span>';
                } elseif (($row['status']) == 1) {
                    echo '<span class="label label-warning">In Progress</span>';
                } elseif (($row['status']) == 2) {
                    echo '<span class="label label-danger">Closed</span>';
                }
                ?>
            </td>
            <td>
                <?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?>
            </td>
            <td style="width: 360px">

                <div class="btn-group">
                    <!-- Link trigger modal -->
                    <a href="job.php?jobID=<?php echo $row['jobID']; ?>" class="btn btn-info">
                        View Job
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
if(!$result){
    echo "<div class=\"well well-lg\">You are currently no Jobs in progress.</div>";
}
?>

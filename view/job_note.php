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

<table class="table table-hover">
    <thead>
    <th>Note #</th>
    <th>Created</th>
    <th></th>
    <th><button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addNoteModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></th>
    </thead>
    <?php
    //call the get_notes_by_job() function
    $result = get_notes_by_job($jobID);
    ?>
    <?php foreach($result as $row):?>
        <tr>
            <td><?php echo $row['noteID']; ?></td>
            <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
            <td><?php echo $row['content']; ?></td>
            <td>
                <?php
                //show note delete button for regional operations only
                if($_SESSION['role'] == 3) {
                    echo "<a href=\"../controller/note_delete_process.php?noteID=". $row['noteID'] . "\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
if(!$result){
    echo "<div class=\"well well-lg\">There are currently no Notes assigned to this Job.</div>";
}
?>
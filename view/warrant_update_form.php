<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_warrants_arrests.php');
require('../model/functions_notes.php');
require('../model/functions_pois.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Update Warrant";

//retrieve the warrantID from the URL
$warrantID = $_GET['warrantID'];

//call the get_warrant() function
$result = get_warrant();
?>



<form id="updateWarrantForm" action="../controller/warrant_update_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="updateWarrantModalLabel">View Warrant #<?php echo $warrantID ?></h4>
    </div>
    <div class="modal-body">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#warrantdetails" aria-controls="warrantdetails" role="tab" data-toggle="tab">Details</a></li>
                <li role="presentation"><a href="#warrantnotes" aria-controls="warrantnotes" role="tab" data-toggle="tab">Notes</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="warrantdetails">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="poiID" class="control-label">Offender</label>
                                <select name="poiID" class="form-control selectpicker" disabled>
                                    <option value="<?php echo $result['poiID'] ?>"><?php echo $result['poiLastName']; ?>, <?php echo $result['poiFirstName']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="jobID" class="control-label">Job</label>
                                <input type="text" name="jobID" class="form-control" id="jobID" maxlength="150" placeholder="Enter Job Number" value="<?php echo $result['jobID'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="court" class="control-label">Issuing Court</label>
                                <input type="text" name="court" id="court" class="form-control" placeholder="Enter Issuing Court" value="<?php echo $result['court'] ?>" <?php if(!($_SESSION['role'] == 1)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="judge" class="control-label">Issuing Judge</label>
                                <input type="text" name="judge" id="judge" class="form-control" placeholder="Enter Issuing Judge" value="<?php echo $result['judge'] ?>" <?php if(!($_SESSION['role'] == 1)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="stationName" class="control-label">Issuing Station</label>
                                <select name="stationName" class="form-control selectpicker" disabled>
                                    <option><?php echo $result['stationName'] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="createdDate" class="control-label">Issued</label>
                                <input type="text" name="createdDate" class="form-control" id="createdDate" value="<?php echo date("d M Y H:i:s", strtotime($result['createdDate'])); ?>" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="warrantnotes">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <th>Note #</th>
                            <th>Created</th>
                            <th></th>
                            <?php
                            //show note delete button for regional operations only
                            if($_SESSION['role'] == 3) {
                                echo "<th></th>";
                            }
                            ?>
                            </thead>
                            <?php
                            //call the get_officers() function
                            $result = get_notes_by_warrant($warrantID);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['noteID']; ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                    <td><?php echo $row['content']; ?></td>
                                    <?php
                                    //show note delete button for regional operations only
                                    if($_SESSION['role'] == 3) {
                                        echo "<td><a href=\"../controller/note_delete_process.php?noteID=". $row['noteID'] . "\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a></td>";
                                    }
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php
                        if(!$result){
                            echo "<div class=\"well well-lg\">There are currently no Notes assigned to this Warrant.</div>";
                        }
                        ?>
                        <div class="form-group">
                            <label for="note" class="control-label">Additional Notes</label>
                            <textarea name="note" class="form-control" id="note" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="warrantID" value="<?php echo $warrantID; ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>




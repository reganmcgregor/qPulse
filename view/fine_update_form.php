<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_fines.php');
require('../model/functions_notes.php');
require('../model/functions_pois.php');
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Update Fine";

//retrieve the fineID from the URL
$fineID = $_GET['fineID'];

//call the get_fine() function
$result = get_fine();
?>



<form id="updateFineForm" action="../controller/fine_update_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addFineModalLabel">View Fine #<?php echo $fineID ?></h4>
    </div>
    <div class="modal-body">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#finedetails" aria-controls="finedetails" role="tab" data-toggle="tab">Details</a></li>
                <li role="presentation"><a href="#finenotes" aria-controls="finenotes" role="tab" data-toggle="tab">Notes</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="finedetails">
                    <br />
                    <div class="form-group">
                        <label for="offenceID" class="control-label">Offence</label>
                        <select name="offenceID" class="form-control selectpicker" disabled>
                            <option value="<?php echo $result['offenceID'] ?>"> <?php echo $result['offenceName'] ?></option>
                        </select>
                    </div>
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
                    <div class="form-group">
                        <label for="badgeID" class="control-label">Issuing Officer</label>
                        <select name="badgeID" class="form-control selectpicker" disabled>
                            <option><?php echo $result['officerRank'] ?> <?php echo $result['officerFirstName'] ?>, <?php echo $result['officerLastName'] ?> #<?php echo $result['badgeID'] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stationName" class="control-label">Issuing Station</label>
                        <select name="stationName" class="form-control selectpicker" disabled>
                            <option><?php echo $result['stationName'] ?></option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="createdDate" class="control-label">Issued</label>
                                <input type="text" name="createdDate" class="form-control" id="createdDate" value="<?php echo date("d M Y H:i:s", strtotime($result['createdDate'])); ?>" disabled/>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="penalty" class="control-label">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input type="text" name="penalty" class="form-control" id="penalty" value="<?php echo $result['penalty'] ?>" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="finenotes">
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
                            //call the get_notes_by_fine() function
                            $result = get_notes_by_fine($fineID);
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
                            echo "<div class=\"well well-lg\">There are currently no Notes assigned to this Fine.</div>";
                        }
                        ?>
                        <div class="form-group">
                            <label for="note" class="control-label">Additional Notes</label>
                            <textarea name="note" class="form-control" id="note" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="fineID" value="<?php echo $fineID; ?>">
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




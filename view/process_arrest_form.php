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
$title = "Process Arrest";

//retrieve the productID from the URL
$warrantID = $_GET['warrantID'];

//call the get_officer() function
$result = get_warrant();
?>



<form id="processArrestForm" action="../controller/process_arrest_process.php" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="processArrestModalLabel">Process Arrest - Warrant #<?php echo $warrantID ?></h4>
    </div>
    <div class="modal-body">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#processarrestdetails" aria-controls="processarrestdetails" role="tab" data-toggle="tab">Details</a></li>
                <li role="presentation"><a href="#processarrestnotes" aria-controls="processarrestnotes" role="tab" data-toggle="tab">Notes</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="processarrestdetails">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="poiID" class="control-label">Offender</label>
                                <select name="poiID" class="form-control selectpicker" disabled>
                                    <option value="<?php echo $result['poiID'] ?>"><?php echo $result['poiLastName']; ?>, <?php echo $result['poiFirstName']; ?></option>
                                </select>
                                <input type="hidden" name="poiID_hidden" value="<?php echo $result['poiID'] ?>" />
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
                                <input type="text" name="court" id="court" class="form-control" placeholder="Enter Issuing Court" value="<?php echo $result['court'] ?>"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="judge" class="control-label">Issuing Judge</label>
                                <input type="text" name="judge" id="judge" class="form-control" placeholder="Enter Issuing Judge" value="<?php echo $result['judge'] ?>"/>
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
                    <div class="form-group">
                        <label for="badgeID" class="control-label">Arresting Officer</label>
                        <select name="badgeID" class="form-control selectpicker" data-live-search="true">
                            <option value="">Please select*</option>
                            <?php
                            //call the get_station_dropdown() function
                            $result = get_officer_dropdown();
                            //display the station data in each row using a foreach loop
                            foreach($result as $row):
                                echo "<option value=" . $row['badgeID'] . ">". $row['rank'] ." " . $row['lastName'] .", "  . $row['firstName'] . " #" . $row['badgeID'] . "</option>";
                            endforeach
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mugshot">Mugshot</label>
                        <input type="file" id="mugshot" name="mugshot">
                        <p class="help-block">* Only JPG, GIF and PNG files. 500kb Max.</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="processarrestnotes">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <th>Note #</th>
                            <th>Created</th>
                            <th></th>
                            <th></th>
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
                                    <td><a href="../controller/note_delete_process.php?noteID=<?php echo $row['noteID']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a></span></td>
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
        <button type="submit" class="btn btn-success">Process Arrest</button>
    </div>
</form>




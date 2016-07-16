<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_job_codes.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Update Job Code";

//retrieve the jobCodeID from the URL
$jobCodeID = $_GET['jobCodeID'];

//call the get_job_code() function
$result = get_job_code();
?>

<form id="updateJobCodeForm" action="../controller/job_code_update_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="updateJobCodeModalLabel">View Job Code #<?php echo $result['code'] ?></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xs-6 col-md-4">
                <div class="form-group">
                    <div class="form-group">
                        <label for="code" class="control-label">Code</label>
                        <input type="text" name="code" class="form-control" value="<?php echo $result['code'] ?>" maxlength="10" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="form-group">
                    <label for="category" class="control-label">Category</label>
                    <select name="category" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                        <option value="<?php echo $result['category'] ?>"><?php echo $result['category'] ?></option>
                        <option value="">Please select*</option>
                        <option value="Offences Against Persons">Offences Against Persons</option>
                        <option value="Sexual Offences">Sexual Offences</option>
                        <option value="Stealing Offences">Stealing Offences</option>
                        <option value="Offences Against Property">Offences Against Property</option>
                        <option value="Prowler Related Offences">Prowler Related Offences</option>
                        <option value="Traffic Incidents">Traffic Incidents</option>
                        <option value="Crisis Situations">Crisis Situations</option>
                        <option value="Disturbances">Disturbances</option>
                        <option value="Fire">Fire</option>
                        <option value="Explosives">Explosives</option>
                        <option value="Spillages/Leaks">Spillages/Leaks</option>
                        <option value="Aviation/Maritime">Aviation/Maritime</option>
                        <option value="Personal Trauma">Personal Trauma</option>
                        <option value="Assist Other Emergency Services">Assist Other Emergency Services</option>
                        <option value="Absconder">Absconder</option>
                        <option value="Miscellaneous">Miscellaneous</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type="text" name="description" class="form-control" id="description" value="<?php echo $result['description'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
        </div>
        <input type="hidden" name="jobCodeID" value="<?php echo $jobCodeID ?>" />
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php
        //submit for regional operations only
        if($_SESSION['role'] == 3) {echo '<button type="submit" class="btn btn-primary">Save changes</button>';}
        ?>
    </div>
</form>




<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_offences.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Update Offence";

//retrieve the offenceID from the URL
$offenceID = $_GET['offenceID'];

//call the get_offence() function
$result = get_offence();
?>

<form id="updateOffenceForm" action="../controller/offence_update_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="updateOffenceModalLabel">View <?php echo $result['name'] ?></h4>
    </div>
    <div class="modal-body">
        <div>
            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" maxlength="255" value="<?php echo $result['name'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="act" class="control-label">Act</label>
                        <input type="text" name="act" class="form-control" id="act" maxlength="255" value="<?php echo $result['act'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="section" class="control-label">Section</label>
                            <input type="text" name="section" class="form-control" value="<?php echo $result['section'] ?>" maxlength="4" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description</label>
                <textarea name="description" class="form-control" id="description" required rows="15" <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>><?php echo $result['description'] ?></textarea>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        <label for="type" class="control-label">Offence Type</label>
                        <select id="type" name="type" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                            <?php
                            if($result['type'] == 0 ) {
                                echo '<option value="0">Criminal Offence</option>
                                  <option value="1">Fineable Offence</option>';
                            } elseif($result['type'] == 1 ) {
                                echo '<option value="1">Fineable Offence</option>
                                  <option value="0">Criminal Offence</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="penalty" class="control-label">Penalty</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" name="penalty" class="form-control" value="<?php echo $result['penalty'] ?>" <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="form-group">
                <input type="hidden" name="offenceID" value="<?php echo $offenceID ?>" />
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php
        //submit for regional operations only
        if($_SESSION['role'] == 3) {echo '<button type="submit" class="btn btn-primary">Save changes</button>';}
        ?>
    </div>
</form>




<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_fines.php');
require('../model/functions_jobs.php');
require('../model/functions_warrants_arrests.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Update Officer";

//retrieve the badgeID from the URL
$badgeID = $_GET['badgeID'];

//call the get_officer() function
$result = get_officer();
?>

<form id="updateOfficerForm" action="../controller/officer_update_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addOfficerModalLabel">View Officer #<?php echo $badgeID ?></h4>
    </div>
    <div class="modal-body">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                <li role="presentation"><a href="#jobs" aria-controls="jobs" role="tab" data-toggle="tab">Jobs</a></li>
                <li role="presentation"><a href="#fines" aria-controls="fines" role="tab" data-toggle="tab">Fines</a></li>
                <li role="presentation"><a href="#arrests" aria-controls="arrests" role="tab" data-toggle="tab">Arrests</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="details">
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="badgeID" class="control-label">Badge Number</label>
                                <input type="text" name="badgeID" class="form-control" id="badgeID" maxlength="50" value="<?php echo $badgeID ?>"  readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName" class="control-label">First Name</label>
                                <input type="text" name="firstName" class="form-control" id="firstName" maxlength="50" value="<?php echo $result['firstName'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName" class="control-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" id="lastName" maxlength="50" value="<?php echo $result['lastName'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" maxlength="256" value="<?php echo $result['email'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="dob" class="control-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" value="<?php echo date('Y-m-d',strtotime($result['dob'])) ?>" readonly/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>
                                <select name="gender" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                                    <?php
                                    if($result['gender'] == 1 ) {
                                        echo '<option value="1">Female</option><option value="0">Male</option>';
                                    } else {
                                        echo '<option value="0">Male</option><option value="1">Female</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="street" class="control-label">Street</label>
                                <input type="text" name="street" class="form-control" id="street" maxlength="50" value="<?php echo $result['street'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="streetType" class="control-label">Street Type</label>
                                <select name="streetType" class="form-control selectpicker" data-live-search="true" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                                    <option value="<?php echo $result['streetType'] ?>"><?php echo $result['streetType'] ?></option>
                                    <option value="">Please select</option>
                                    <option value="ALLEY">ALLEY</option>
                                    <option value="APPROACH">APPROACH</option>
                                    <option value="ARCADE">ARCADE</option>
                                    <option value="AVENUE">AVENUE</option>
                                    <option value="BOULEVARD">BOULEVARD</option>
                                    <option value="BROW">BROW</option>
                                    <option value="BYPASS">BYPASS</option>
                                    <option value="CAUSEWAY">CAUSEWAY</option>
                                    <option value="CIRCUIT">CIRCUIT</option>
                                    <option value="CIRCUS">CIRCUS</option>
                                    <option value="CLOSE">CLOSE</option>
                                    <option value="COPSE">COPSE</option>
                                    <option value="CORNER">CORNER</option>
                                    <option value="COVE">COVE</option>
                                    <option value="COURT">COURT</option>
                                    <option value="CRESCENT">CRESCENT</option>
                                    <option value="DRIVE">DRIVE</option>
                                    <option value="END">END</option>
                                    <option value="ESPLANANDE">ESPLANANDE</option>
                                    <option value="FLAT">FLAT</option>
                                    <option value="FREEWAY">FREEWAY</option>
                                    <option value="FRONTAGE">FRONTAGE</option>
                                    <option value="GARDENS">GARDENS</option>
                                    <option value="GLADE">GLADE</option>
                                    <option value="GLEN">GLEN</option>
                                    <option value="GREEN">GREEN</option>
                                    <option value="GROVE">GROVE</option>
                                    <option value="HEIGHTS">HEIGHTS</option>
                                    <option value="HIGHWAY">HIGHWAY</option>
                                    <option value="LANE">LANE</option>
                                    <option value="LINK">LINK</option>
                                    <option value="LOOP">LOOP</option>
                                    <option value="MALL">MALL</option>
                                    <option value="MEWS">MEWS</option>
                                    <option value="PACKET">PACKET</option>
                                    <option value="PARADE">PARADE</option>
                                    <option value="PARK">PARK</option>
                                    <option value="PARKWAY">PARKWAY</option>
                                    <option value="PLACE">PLACE</option>
                                    <option value="PROMENADE">PROMENADE</option>
                                    <option value="RESERVE">RESERVE</option>
                                    <option value="RIDGE">RIDGE</option>
                                    <option value="RISE">RISE</option>
                                    <option value="ROAD">ROAD</option>
                                    <option value="ROW">ROW</option>
                                    <option value="SQUARE">SQUARE</option>
                                    <option value="STREET">STREET</option>
                                    <option value="STRIP">STRIP</option>
                                    <option value="TARN">TARN</option>
                                    <option value="TERRACE">TERRACE</option>
                                    <option value="THOROUGHFARE">THOROUGHFARE</option>
                                    <option value="TRACK">TRACK</option>
                                    <option value="TRUNKWAY">TRUNKWAY</option>
                                    <option value="VIEW">VIEW</option>
                                    <option value="VISTA">VISTA</option>
                                    <option value="WALK">WALK</option>
                                    <option value="WAY">WAY</option>
                                    <option value="WALKWAY">WALKWAY</option>
                                    <option value="YARD">YARD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                            <div class="form-group">
                                <label for="suburb" class="control-label">Suburb</label>
                                <input type="text" name="suburb" class="form-control" id="suburb" maxlength="50" value="<?php echo $result['suburb'] ?>" required <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-5">
                            <div class="form-group">
                                <label for="state" class="control-label">State</label>
                                <select name="state" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                                    <option value="<?php echo $result['state'] ?>"><?php echo $result['state'] ?></option>
                                    <option value="">Please select</option>
                                    <option value="Queensland">Queensland</option>
                                    <option value="New South Wales">New South Wales</option>
                                    <option value="Australian Capital Territory">Australian Capital Territory</option>
                                    <option value="Northern Territory">Northern Territory</option>
                                    <option value="South Australia">South Australia</option>
                                    <option value="Tasmania">Tasmania</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Western Australia">Western Australia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group">
                                <label for="postcode" class="control-label">Postcode</label>
                                <input type="number" name="postcode" class="form-control" value="<?php echo $result['postcode'] ?>" maxlength="4" <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone-group" maxlength="10" value="<?php echo $result['phone'] ?>" <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="mobile" class="control-label">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control phone-group" maxlength="10" value="<?php echo $result['mobile'] ?>" <?php if(!($_SESSION['role'] == 3)) {echo 'readonly';} ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="rank" class="control-label">Rank</label>
                                <select name="rank" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                                    <option value="<?php echo $result['rank'] ?>"><?php echo $result['rank'] ?></option>
                                    <option value="">Please select</option>
                                    <option value="Constable">Constable</option>
                                    <option value="Senior Constable">Senior Constable</option>
                                    <option value="Sergeant">Sergeant</option>
                                    <option value="Senior Sergeant">Senior Sergeant</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Superintendent">Superintendent</option>
                                    <option value="Chief Superintendent">Chief Superintendent</option>
                                    <option value="Assistant Commissioner">Assistant Commissioner</option>
                                    <option value="Deputy Commissioner">Deputy Commissioner</option>
                                    <option value="Commissioner">Commissioner</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="role" class="control-label">Role</label>
                                <select name="role" class="form-control selectpicker" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                                    <?php
                                    if($result['role'] == 0 ) {
                                        echo '<option value="0">Police Officer</option>
                                  <option value="1">Watchhouse Officer</option>
                                  <option value="2">Police Communications</option>
                                  <option value="3">Regional Operations</option>';
                                    } elseif($result['role'] == 1 ) {
                                        echo '<option value="1">Watchhouse Officer</option>
                                  <option value="0">Police Officer</option>
                                  <option value="2">Police Communications</option>
                                  <option value="3">Regional Operations</option>';
                                    } elseif($result['role'] == 2 ) {
                                        echo '<option value="2">Police Communications</option>
                                  <option value="0">Police Officer</option>
                                  <option value="1">Watchhouse Officer</option>
                                  <option value="3">Regional Operations</option>';
                                    } elseif($result['role'] == 3 ) {
                                        echo '<option value="3">Regional Operations</option>
                                  <option value="0">Police Officer</option>
                                  <option value="1">Watchhouse Officer</option>
                                  <option value="2">Police Communications</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stationID" class="control-label">Station</label>
                        <select name="stationID" class="form-control selectpicker" data-live-search="true" <?php if(!($_SESSION['role'] == 3)) {echo 'disabled';} ?>>
                            <option value="<?php echo $result['stationID'] ?>"> <?php echo $result['name'] ?></option>
                            <option value="">Please select</option>
                            <?php
                            //call the get_station_dropdown() function
                            $result = get_station_dropdown();
                            //display the station data in each row using a foreach loop
                            foreach($result as $row):
                                echo "<option value=" . $row['stationID'] . ">" . $row['name'] . "</option>";
                            endforeach
                            ?>
                        </select>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="jobs">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Job Number #</th>
                                <th>Job Code</th>
                                <th>Priority</th>
                                <th>Responding Station</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_jobs_by_badgeID() function
                            $result = get_jobs_by_badgeID($badgeID);
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
                                    <td>

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
                            echo "<div class=\"well well-lg\">There are currently no Jobs assigned to this officer.</div>";
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="fines">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fine&nbsp;#</th>
                                <th>Offence</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issued</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_fines_by_officer() function
                            $result = get_fines_by_officer($badgeID);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['fineID']; ?></td>
                                    <td><?php echo $row['offenceName']; ?></td>
                                    <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
                                    <td>
                                        <?php
                                        if(!empty($row['jobID'])){
                                            echo "<a href=\"job.php?jobID=" . $row['jobID'] . "\">". $row['jobID'] . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                    <td>$<?php echo $row['penalty']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php
                                            if($row['status'] == 2) {
                                                echo '<button type="button" class="btn btn-danger dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                echo 'Court Elected';
                                                if ($_SESSION['role'] == 3) {
                                                    echo '&nbsp;<span class="caret"></span>';
                                                }
                                                echo '</button>';
                                            } elseif($row['status'] == 1) {
                                                echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                echo 'Paid';
                                                if ($_SESSION['role'] == 3) {
                                                    echo '&nbsp;<span class="caret"></span>';
                                                }
                                                echo '</button>';
                                            } else {
                                                echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                echo 'Unpaid';
                                                if ($_SESSION['role'] == 3) {
                                                    echo '&nbsp;<span class="caret"></span>';
                                                }
                                                echo '</button>';
                                            }
                                            //change fine status for regional operations only
                                            if ($_SESSION['role'] == 3) {
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/fine_status_process.php?fineID=" . $row['fineID'] ."&status=2\">Court Elected</a></li>";
                                                echo "<li><a href=\"../controller/fine_status_process.php?fineID=" . $row['fineID'] ."&status=1\">Paid</a></li>";
                                                echo "<li><a href=\"../controller/fine_status_process.php?fineID=" . $row['fineID'] ."&status=0\">Unpaid</a></li>";
                                                echo '</ul>';
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php
                        if(!$result){
                            echo "<div class=\"well well-lg\">There are currently no Fines assigned to this officer.</div>";
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="arrests">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Processing Officer</th>
                                <th>Arrested</th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_arrests_by_arrestingBadgeID() function
                            $result = get_arrests_by_arrestingBadgeID($badgeID);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><img src="../src/img/mugshots/<?php echo $row['mugshot']; ?>" alt="<?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?>" width="50" height="50" /></td>
                                    <td><?php echo $row['warrantID']; ?></td>
                                    <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
                                    <td>
                                        <?php
                                        if(!empty($row['jobID'])){
                                            echo "<a href=\"job.php?jobID=" . $row['jobID'] . "\">". $row['jobID'] . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        //call the get_officer_by_badgeID() function
                                        $result = get_officer_by_badgeID($row['processingBadgeID']);
                                        //display the processing officer data
                                        echo  $result['rank'] ." " . $result['lastName'] .", "  . $result['firstName'] . " #" . $result['badgeID'];
                                        ?>
                                    </td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php
                    if(!$result){
                        echo "<div class=\"well well-lg\">There are currently no Arrests assigned to this officer.</div>";
                    }
                    ?>
                </div>
            </div>

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




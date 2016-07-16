<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_pois.php');
require('../model/functions_jobs.php');
require('../model/functions_job_codes.php');
require('../model/functions_warrants_arrests.php');
require('../model/functions_fines.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_notes.php');
require('../model/functions_offences.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "View Person Of Interest";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');

//retrieve the poiID from the URL
$poiID = $_GET['poiID'];

//call the get_poi() function
$result = get_poi();
?>


<section>
    <div class="container">
        <br />
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="pois.php">Persons Of Interest</a></li>
            <li class="active"><?php echo $result['lastName'] ?>, <?php echo $result['firstName'] ?>  #<?php echo $result['poiID'] ?></li>
        </ol>
        <h1 class="page-header">
            <?php echo $result['lastName'] ?>, <?php echo $result['firstName'] ?>  #<?php echo $result['poiID'] ?>
        </h1>
        <?php
        //call user_message() function
        $message = user_message();
        ?>
        <div class="row">
            <form id="updatePoiForm" action="../controller/poi_update_process.php" method="post">
                <div class="col-md-3">
                    <img src="../src/img/mugshots/<?php echo $result['photo'] ?>" width="240" height="240" />
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-xs-6">
                            <label for="firstName" class="control-label">First Name*</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $result['firstName'] ?>" placeholder="First name" required>
                        </div>
                        <div class="col-xs-6">
                            <label for="lastName" class="control-label">Last Name*</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $result['lastName'] ?>" placeholder="Last name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label for="gender" class="control-label">Gender</label>
                            <select name="gender" class="form-control selectpicker">
                                <?php
                                if($result['gender'] == 1 ) {
                                    echo '<option value="1">Female</option><option value="0">Male</option>';
                                } else {
                                    echo '<option value="0">Male</option><option value="1">Female</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="dob" class="control-label">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" value="<?php echo date('Y-m-d',strtotime($result['dob'])) ?>" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label for="ethnicity" class="control-label">Ethnicity</label>
                            <select name="ethnicity" class="form-control selectpicker">
                                <option value="<?php echo $result['ethnicity'] ?>"><?php echo $result['ethnicity'] ?></option>
                                <option value="">Please select</option>
                                <option value="Caucasian">Caucasian</option>
                                <option value="Aboriginal">Aboriginal</option>
                                <option value="Torres Strait Islander">Torres Strait Islander</option>
                                <option value="African">African</option>
                                <option value="Asian">Asian</option>
                                <option value="Maori/Polynesian">Maori/Polynesian</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="eyes" class="control-label">Eyes</label>
                            <select name="eyes" class="form-control selectpicker">
                                <?php
                                if(!empty($result['eyes'])) {
                                    echo '<option value="' . $result['eyes'] . '">' . $result['eyes'] . '</option>';
                                }
                                ?>
                                <option value="">Please select</option>
                                <option value="Brown">Brown</option>
                                <option value="Hazel">Hazel</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Silver">Silver</option>
                                <option value="Amber">Amber</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label for="height" class="control-label">Height</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="height" id="height" value="<?php echo $result['height'] ?>" placeholder="Height" maxlength="4">
                                <div class="input-group-addon">cm</div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="weight" class="control-label">Weight</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="weight" value="<?php echo $result['weight'] ?>" placeholder="Weight" maxlength="4">
                                <div class="input-group-addon">kg</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-xs-8">
                            <label for="street" class="control-label">Street</label>
                            <input type="text" name="street" class="form-control" id="street" maxlength="50" value="<?php echo $result['street'] ?>" placeholder="Street"/>
                        </div>
                        <div class="col-xs-4">
                            <label for="streetType" class="control-label">Street Type</label>
                            <select name="streetType" class="form-control selectpicker" data-live-search="true">
                                <?php
                                if(!empty($result['streetType'])) {
                                    echo '<option value="' . $result['streetType'] . '">' . $result['streetType'] . '</option>';
                                }
                                ?>
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

                    <div class="row">
                        <div class="col-xs-5">
                            <label for="suburb" class="control-label">Suburb</label>
                            <input type="text" name="suburb" class="form-control" id="suburb" maxlength="50" value="<?php echo $result['suburb'] ?>" placeholder="Suburb"/>
                        </div>
                        <div class="col-xs-3">
                            <label for="state" class="control-label">State</label>
                            <select name="state" class="form-control selectpicker">
                                <?php
                                if(!empty($result['state'])) {
                                    echo '<option value="' . $result['state'] . '">' . $result['state'] . '</option>';
                                }
                                ?>
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
                        <div class="col-xs-4">
                            <label for="postcode" class="control-label">Postcode</label>
                            <input type="number" name="postcode" class="form-control" value="<?php echo $result['postcode'] ?>" placeholder="Postcode" maxlength="4">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <label for="phone" class="control-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control phone-group" maxlength="10" value="<?php echo $result['phone'] ?>" placeholder="Phone"/>
                        </div>
                        <div class="col-xs-6">
                            <label for="mobile" class="control-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control phone-group" maxlength="10" value="<?php echo $result['mobile'] ?>" placeholder="Mobile"/>
                        </div>
                    </div>
                    <input type="hidden" name="poiID" value="<?php echo $result['poiID'] ?>">
                    <div class="row">
                        <div class="col-xs-12">
                            <br />
                            <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <br />
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
            <li role="presentation"><a href="#jobs" aria-controls="jobs" role="tab" data-toggle="tab">Jobs</a></li>
            <li role="presentation"><a href="#warrants" aria-controls="warrants" role="tab" data-toggle="tab">Warrants</a></li>
            <li role="presentation"><a href="#arrests" aria-controls="arrests" role="tab" data-toggle="tab">Arrests</a></li>
            <li role="presentation"><a href="#fines" aria-controls="fines" role="tab" data-toggle="tab">Fines</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="notes">
                <div class="table">
                    <table class="table table-hover">
                        <thead>
                            <th>Note&nbsp;#</th>
                            <th>Created</th>
                            <th></th>
                            <th><button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addNoteModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></th>
                        </thead>
                        <?php
                        //call the get_notes_by_poi() function
                        $result = get_notes_by_poi($poiID);
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
                        echo "<div class=\"well well-lg\">There are currently no Notes assigned to this Person Of Interest.</div>";
                    }
                    ?>
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
                        <th>Active Since</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>
                            <?php
                            if($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
                                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addJobModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                            }
                            ?>
                        </th>
                    </tr>
                    </thead>
                    <?php
                    //call the get_jobs_by_poi() function
                    $result = get_jobs_by_poi();
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
                            <td style="width: 200px">

                                <div class="btn-group">
                                    <!-- Link trigger modal -->
                                    <a href="job.php?jobID=<?php echo $row['jobID']; ?>" class="btn btn-info">
                                        View Job
                                    </a>
                                    <?php
                                    if($_SESSION['role'] == 0 && $row['status'] == 0) {
                                        echo "<a href=\"../controller/job_accept_process.php?jobID=" . $row['jobID'] . "&badgeID=" . $_SESSION['user'] ."\" class=\"btn btn-success\">" ;
                                        echo "Accept Job";
                                        echo "</a>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                    <?php
                    if(!$result){
                        echo "<div class=\"well well-lg\">There are currently no Jobs assigned to this Person Of Interest.</div>";
                    }
                    ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="warrants">
                <div class="table">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Warrant&nbsp;#</th>
                            <th>Job&nbsp;#</th>
                            <th>Issuing Court</th>
                            <th>Issuing Judge</th>
                            <th>Issuing Station</th>
                            <th>Issued</th>
                            <th>
                                <?php
                                //show add warrant button for watchhouse officers only
                                if($_SESSION['role'] == 1) {
                                    echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addWarrantModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                                }
                                ?>
                            </th>
                        </tr>
                        </thead>
                        <?php
                        //call the get_warrants_by_poi() function
                        $result = get_warrants_by_poi($poiID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['warrantID']; ?></td>
                                <td>
                                    <?php
                                    if(!empty($row['jobID'])){
                                        echo "<a href=\"job.php?jobID=" . $row['jobID'] . "\">". $row['jobID'] . "</a>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['court']; ?></td>
                                <td><?php echo $row['judge']; ?></td>
                                <td><?php echo $row['stationName']; ?></td>
                                <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                <td style="width: 360px">
                                    <div class="btn-group">
                                        <!-- Link trigger modal -->
                                        <a href="warrant_update_form.php?warrantID=<?php echo $row['warrantID']; ?>" data-toggle="modal" data-target="#updateWarrantModal" class="btn btn-info">
                                            View Warrant
                                        </a>
                                        <a href="charges_update_form.php?warrantID=<?php echo $row['warrantID']; ?>" data-toggle="modal" data-target="#updateChargesModal" class="btn btn-warning">
                                            View Charges
                                        </a>
                                        <?php
                                        //show process arrest button for watchhouse officers only
                                        if($_SESSION['role'] == 1) {
                                            echo "<a href=\"process_arrest_form.php?warrantID=". $row['warrantID'] . "\" data-toggle=\"modal\" data-target=\"#processArrestModal\" class=\"btn btn-success\">Process Arrest</a>";
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php
                    if(!$result){
                        echo "<div class=\"well well-lg\">There are currently no Warrants assigned to this Person Of Interest.</div>";
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
                            <th>Job&nbsp;#</th>
                            <th>Arresting Officer</th>
                            <th>Processing Officer</th>
                            <th>Issuing Station</th>
                            <th>Arrested</th>
                            <th>
                                <?php
                                //show add arrest button for watchhouse officers only
                                if($_SESSION['role'] == 1) {
                                    echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addArrestModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                                }
                                ?>
                            </th>
                        </tr>
                        </thead>
                        <?php
                        //call the get_arrests_by_poi() function
                        $result = get_arrests_by_poi($poiID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><img src="../src/img/mugshots/<?php echo $row['mugshot']; ?>" alt="<?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?>" width="50" height="50" /></td>
                                <td><?php echo $row['warrantID']; ?></td>
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
                                    $result = get_officer_by_badgeID($row['arrestingBadgeID']);
                                    //display the officer data
                                    echo  $result['rank'] ." " . $result['lastName'] .", "  . $result['firstName'] . " #" . $result['badgeID'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    //call the get_officer_by_badgeID() function
                                    $result = get_officer_by_badgeID($row['processingBadgeID']);
                                    //display the officer data
                                    echo  $result['rank'] ." " . $result['lastName'] .", "  . $result['firstName'] . " #" . $result['badgeID'];
                                    ?>
                                </td>
                                <td><?php echo $row['stationName']; ?></td>
                                <td><?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?></td>
                                <td style="width: 250px">
                                    <div class="btn-group">
                                        <!-- Link trigger modal -->
                                        <a href="arrest_update_form.php?warrantID=<?php echo $row['warrantID']; ?>" data-toggle="modal" data-target="#updateArrestModal" class="btn btn-info">
                                            View Arrest
                                        </a>
                                        <a href="charges_update_form.php?warrantID=<?php echo $row['warrantID']; ?>" data-toggle="modal" data-target="#updateChargesModal" class="btn btn-warning">
                                            View Charges
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php
                    if(!$result){
                        echo "<div class=\"well well-lg\">There are currently no Arrests assigned to this Person Of Interest.</div>";
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
                            <th>Job&nbsp;#</th>
                            <th>Issuing Officer</th>
                            <th>Issued</th>
                            <th>Amount</th>
                            <th>
                                <?php
                                //show add fine button for police officers only
                                if($_SESSION['role'] == 0) {
                                    echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addFineModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                                }
                                ?>
                            </th>
                        </tr>
                        </thead>
                        <?php
                        //call the get_fines_by_poi() function
                        $result = get_fines_by_poi($poiID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['fineID']; ?></td>
                                <td><?php echo $row['offenceName']; ?></td>
                                <td>
                                    <?php
                                    if(!empty($row['jobID'])){
                                        echo "<a href=\"job.php?jobID=" . $row['jobID'] . "\">". $row['jobID'] . "</a>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                <td>$<?php echo $row['penalty']; ?></td>
                                <td style="width: 220px">
                                    <div class="btn-group">
                                        <!-- Link trigger modal -->
                                        <a href="fine_update_form.php?fineID=<?php echo $row['fineID']; ?>" data-toggle="modal" data-target="#updateFineModal" class="btn btn-info">
                                            View Fine
                                        </a>
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
                        echo "<div class=\"well well-lg\">There are currently no Fines assigned to this Person Of Interest.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Add Note To POI Modal -->
        <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addPoiNoteForm" action="../controller/poi_note_add_process.php" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="addNoteModalLabel">Add Note</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="note" class="control-label">Notes</label>
                                <textarea name="note" class="form-control" id="note" rows="10" placeholder="Enter Note*"></textarea>
                            </div>
                            <input type="hidden" name="poiID" value="<?php echo $poiID; ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Job Modal -->
        <?php
        if($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
            require('job_add_form.php');
        }
        ?>
        <!-- Code 1 modal -->
        <div class="modal fade" id="code1Modal" tabindex="-1" role="dialog" aria-labelledby="code1ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Code 1</b> - Very Urgent – may be assigned in the following circumstances:</h4>
                    </div>
                    <div class="modal-body">
                        <p>(i) when an officer or member of the public is in need of help in circumstances where life is actually and directly threatened and is in immediate danger of death. This includes the need for assistance in similar circumstances when an officer is having problems escorting prisoners, is trying to effect crowd control or is endeavouring to keep law and order at civil disturbances, etc.;</p>
                        <p>(ii) when shots are being fired or an explosion or bombing has occurred and danger to human life is imminent;</p>
                        <p>(iii) at the time of a major incident or serious fire, or in the case of a robbery or any crime in progress where there is danger to human life;</p>
                        <p>(iv) in instances of asphyxiation or electrocution where life may be saved or where a person is attempting suicide or other forms of self-harm likely to cause death or serious injury; or</p>
                        <p>(v) in any other instance where it is known that danger to human life is imminent</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Code 2 modal -->
        <div class="modal fade" id="code2Modal" tabindex="-1" role="dialog" aria-labelledby="code2ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Code 2</b> - Urgent – may be assigned in the following circumstances:</h4>
                    </div>
                    <div class="modal-body">
                        <p>(i) incidents similar to those above and any other urgent situations without the element of imminent danger to human life being apparent;</p>
                        <p>(ii) in any other urgent situation when it is known that danger to human life is not imminent; or</p>
                        <p>(iii) incidents involving injury to a person or present threat of injury to a person or property.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Code 3 modal -->
        <div class="modal fade" id="code3Modal" tabindex="-1" role="dialog" aria-labelledby="code3ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Code 3</b> - Routine – may be assigned in the following circumstances:</h4>
                    </div>
                    <div class="modal-body">
                        <p>(i) all other matters which are considered to be routine and not requiring classification of Code 1 or 2.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Warrant To POI Modal -->
        <?php
        //show add warrant modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('warrant_poi_add_form.php');
        }
        ?>
        <!-- Update Warrant modal -->
        <div class="modal fade" id="updateWarrantModal" tabindex="-1" role="dialog" aria-labelledby="updateWarrantModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- Update Charges modal -->
        <div class="modal fade" id="updateChargesModal" tabindex="-1" role="dialog" aria-labelledby="updateChargesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- Process Arrest modal -->
        <div class="modal fade" id="processArrestModal" tabindex="-1" role="dialog" aria-labelledby="processArrestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- Add Arrest To POI Modal -->
        <?php
        //show add arrest modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('arrest_poi_add_form.php');
        }
        ?>
        <!-- Update Arrest modal -->
        <div class="modal fade" id="updateArrestModal" tabindex="-1" role="dialog" aria-labelledby="updateArrestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- Add Fine To POI Modal -->
        <?php
        //show add fine modal for police officers only
        if($_SESSION['role'] == 0) {
            require('fine_poi_add_form.php');
        }
        ?>
        <!-- Update Fine modal -->
        <div class="modal fade" id="updateFineModal" tabindex="-1" role="dialog" aria-labelledby="updateFineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
    </div>
</section>

<?php
//Debug
echo "user (badgeID): " . $_SESSION["user"] . "<br />";
echo "role: " . $_SESSION["role"];
?>

<?php
//retrieve the footer
require('footer.php');
?>




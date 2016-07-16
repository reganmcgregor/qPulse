<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_pois.php');
require('../model/functions_fines.php');
require('../model/functions_warrants_arrests.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_notes.php');
require('../model/functions_offences.php');
require('../model/functions_jobs.php');
require('../model/functions_job_codes.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "View Job";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');

//retrieve the jobID from the URL
$jobID = $_GET['jobID'];

//call the get_job() function
$result = get_job();
?>


<section>
    <div class="container">
        <br />
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <li class="active">Job #<?php echo $result['jobID'] ?></li>
        </ol>
        <h1 class="page-header">
            Job #<?php echo $result['jobID'] ?>
            <!-- Single button -->
            <div class="btn-group pull-right">
                <?php
                if(!($_SESSION['role'] == 1)) {
                    if($result['status'] == 2) {
                        echo '<button type="button" class="btn btn-danger dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Closed
                                                      <span class="caret"></span>
                                                      </button>';
                    } elseif($result['status'] == 1) {
                        echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      In Progres
                                                      <span class="caret"></span>
                                                      </button>';
                    } else {
                        echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Open
                                                      <span class="caret"></span>
                                                      </button>';
                    }
                }
                ?>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Change Status</li>
                    <li><a href="../controller/job_status_process.php?jobID=<?php echo $result['jobID']; ?>&status=0">Open</a></li>
                    <li><a href="../controller/job_status_process.php?jobID=<?php echo $result['jobID']; ?>&status=1">In Progres</a></li>
                    <li><a href="../controller/job_status_process.php?jobID=<?php echo $result['jobID']; ?>&status=2">Closed</a></li>
                </ul>
            </div>
        </h1>
        <?php
        //call user_message() function
        $message = user_message();
        ?>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" data-toggle="modal"
                        <?php if(($result['priority']) == 0){echo 'data-target="#code1Modal" title="Code 1 - Very Urgent" class="list-group-item active"';} elseif (($result['priority']) == 1) {echo 'data-target="#code2Modal" title="Code 2 - Urgent" class="list-group-item list-group-item-warning"';} elseif (($result['priority']) == 2) {echo 'data-target="#code3Modal" title="Code 3 - Routine" class="list-group-item list-group-item-info"';} ?>>
                        <h4 class="list-group-item-heading">Priority</h4>
                        <p class="list-group-item-text"></p>
                        <?php
                        if(($result['priority']) == 0){
                            echo '<b>Code 1</b> - Very Urgent</a>';
                        } elseif (($result['priority']) == 1) {
                            echo '<b>Code 2</b> - Urgent</a>';
                        } elseif (($result['priority']) == 2) {
                            echo '<b>Code 3</b> - Routine</a>';
                        }
                        ?>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">Job Code</h4>
                        <p class="list-group-item-text">
                            <?php echo $result['jobCodeCategory'] ?><br /><?php echo $result['jobCode'] ?> - <?php echo $result['jobCodeDescription'] ?>
                        </p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">Job Created</h4>
                        <p class="list-group-item-text"><?php echo date("d M Y H:i:s", strtotime($result['createdDate'])); ?></p>
                    </a>
                </div>
            </div>
            <div class="col-md-5" id="jobofficers" data-jobid="<?php echo $jobID ?>">
            </div>
            <div class="col-md-4" id="jobpois" data-jobid="<?php echo $jobID ?>">
            </div>
        </div>

        <br />
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
            <li role="presentation"><a href="#warrants" aria-controls="warrants" role="tab" data-toggle="tab">Warrants</a></li>
            <li role="presentation"><a href="#arrests" aria-controls="arrests" role="tab" data-toggle="tab">Arrests</a></li>
            <li role="presentation"><a href="#fines" aria-controls="fines" role="tab" data-toggle="tab">Fines</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="notes">
                <div class="table" id="jobjobnotes" data-jobid="<?php echo $result['jobID'] ?>">
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="warrants">
                <div class="table">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Warrant&nbsp;#</th>
                            <th>Offender</th>
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
                        //call the get_warrants_by_job() function
                        $result = get_warrants_by_job($jobID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['warrantID']; ?></td>
                                <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
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
                        //call the get_arrests_by_job() function
                        $result = get_arrests_by_job($jobID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><img src="../src/img/mugshots/<?php echo $row['mugshot']; ?>" alt="<?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?>" width="50" height="50" /></td>
                                <td><?php echo $row['warrantID']; ?></td>
                                <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
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
                        //call the get_fines_by_job() function
                        $result = get_fines_by_job($jobID);
                        ?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['fineID']; ?></td>
                                <td><?php echo $row['offenceName']; ?></td>
                                <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
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
                </div>
            </div>
        </div>

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

        <!-- Add Officer To Job Modal -->
        <div class="modal fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addOfficerModalLabel">Add Officer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table">
                            <?php
                            //call the get_officers_by_role_and_duty() function
                            $result = get_officers_by_role_and_duty(0,1);
                            ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Badge Number #</th>
                                    <th>Name</th>
                                    <th>Rank</th>
                                    <th>Station</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <?php foreach($result as $row):?>
                                    <tr>
                                        <td><?php echo $row['badgeID']; ?></td>
                                        <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                        <td><?php echo $row['rank']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <!-- Link trigger modal -->
                                            <a href="../controller/officer_job_add_process.php?badgeID=<?php echo $row['badgeID']; ?>&jobID=<?php echo $jobID; ?>" class="btn btn-success">
                                                Add Officer
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Poi To Job Modal -->
        <div class="modal fade" id="addPoiJobModal" tabindex="-1" role="dialog" aria-labelledby="addPoiJobModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addPoiJobForm" action="../controller/poi_job_add_process.php" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="addPoiJobModalLabel">Add Person Of Interest</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                        <label for="poiID" class="control-label">Person Of Interest</label>
                                        <select name="poiID" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                            <option value="">Please select*</option>
                                            <?php
                                            //call the get_poi_dropdown() function
                                            $result = get_poi_dropdown();
                                            //display the person of interest data in each row using a foreach loop
                                            foreach($result as $row):
                                                echo "<option value=" . $row['poiID'] . ">". $row['lastName'] .", "  . $row['firstName'] . " (" . date("d-m-Y", strtotime($row['dob'])) . ")</option>";
                                            endforeach
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    <div class="form-group">
                                        <label for="relationship" class="control-label">Relationship</label>
                                        <select name="relationship" class="form-control selectpicker">
                                            <option value="">Please select*</option>
                                            <option value="Caller">Caller</option>
                                            <option value="Witness">Witness</option>
                                            <option value="Suspect">Suspect</option>
                                            <option value="Victim">Victim</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="jobID" value="<?php echo $jobID; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPoiModal">Add New Person Of Interest</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add New POI Modal -->
        <?php require('poi_add_form.php'); ?>

        <!-- Add Note To Job Modal -->
        <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addPoiNoteForm" action="../controller/job_note_add_process.php" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="addNoteModalLabel">Add Note</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="note" class="control-label">Notes</label>
                                <textarea name="note" class="form-control" id="note" rows="10" placeholder="Enter Note*"></textarea>
                            </div>
                            <input type="hidden" name="jobID" value="<?php echo $jobID; ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Warrant To Job Modal -->
        <?php
        //show add warrant modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('warrant_job_add_form.php');
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
        <!-- Add Arrest To Job Modal -->
        <?php
        //show add arrest modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('arrest_job_add_form.php');
        }
        ?>
        <!-- Update Arrest modal -->
        <div class="modal fade" id="updateArrestModal" tabindex="-1" role="dialog" aria-labelledby="updateArrestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                </div>
            </div>
        </div>

        <!-- Add Fine To Job Modal -->
        <?php
        //show add fine modal for police officers only
        if($_SESSION['role'] == 0) {
            require('fine_job_add_form.php');
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




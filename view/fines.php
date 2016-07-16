<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_fines.php');
require('../model/functions_pois.php');
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Fines";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Fines
            <?php
            //show add fine button for police officers only
            if($_SESSION['role'] == 0) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addFineModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Fine</button>';
            }
            ?>
        </h1>

        <?php
        //show add fine modal for police officers only
        if($_SESSION['role'] == 0) {
            require('fine_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#allfines" aria-controls="allofficers" role="tab" data-toggle="tab">All Fines</a></li>
                <li role="presentation"><a href="#unpaid" aria-controls="unpaid" role="tab" data-toggle="tab">Unpaid</a></li>
                <li role="presentation"><a href="#paid" aria-controls="paid" role="tab" data-toggle="tab">Paid</a></li>
                <li role="presentation"><a href="#court" aria-controls="court" role="tab" data-toggle="tab">Court Elected</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="allfines">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fine&nbsp;#</th>
                                <th>Offence</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Officer</th>
                                <th>Issued</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_fines() function
                            $result = get_fines();
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
                                <td><?php echo $row['officerRank']; ?> <?php echo $row['officerLastName']; ?>, <?php echo $row['officerFirstName']; ?></td>
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
                <div role="tabpanel" class="tab-pane" id="unpaid">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fine&nbsp;#</th>
                                <th>Offence</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Officer</th>
                                <th>Issued</th>
                                <th>Updated</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_fines_by_status() function
                            $result = get_fines_by_status(0);
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
                                    <td><?php echo $row['officerRank']; ?> <?php echo $row['officerLastName']; ?>, <?php echo $row['officerFirstName']; ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?></td>
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
                <div role="tabpanel" class="tab-pane" id="paid">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fine&nbsp;#</th>
                                <th>Offence</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Officer</th>
                                <th>Issued</th>
                                <th>Updated</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_fines_by_status() function
                            $result = get_fines_by_status(1);
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
                                    <td><?php echo $row['officerRank']; ?> <?php echo $row['officerLastName']; ?>, <?php echo $row['officerFirstName']; ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?></td>
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
                <div role="tabpanel" class="tab-pane" id="court">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fine&nbsp;#</th>
                                <th>Offence</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Officer</th>
                                <th>Issued</th>
                                <th>Updated</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_fines_by_status() function
                            $result = get_fines_by_status(2);
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
                                    <td><?php echo $row['officerRank']; ?> <?php echo $row['officerLastName']; ?>, <?php echo $row['officerFirstName']; ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['createdDate'])); ?></td>
                                    <td><?php echo date("d M Y H:i:s", strtotime($row['updatedDate'])); ?></td>
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
            <!-- Update Fine modal -->
            <div class="modal fade" id="updateFineModal" tabindex="-1" role="dialog" aria-labelledby="updateFineModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                    </div>
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
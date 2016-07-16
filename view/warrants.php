<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_warrants_arrests.php');
require('../model/functions_pois.php');
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Warrants";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');

//call the get_officer_station() function
$result = get_officer_station($_SESSION['user']);
$stationID = $result['stationID'];
$stationName = $result['name'];

?>

<section>
    <div class="container">
        <h1 class="page-header">Warrants
            <?php
            //show add warrant button for watchhouse officers only
            if($_SESSION['role'] == 1) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addWarrantModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Warrant</button>';
            }
            ?>
        </h1>

        <?php
        //show add warrant modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('warrant_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#allwarrants" aria-controls="allwarrants" role="tab" data-toggle="tab">All Warrants</a></li>
                <li role="presentation"><a href="#mystation" aria-controls="mystation" role="tab" data-toggle="tab"><?php echo $stationName; ?> Warrants</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="allwarrants">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Court</th>
                                <th>Issuing Judge</th>
                                <th>Issuing Station</th>
                                <th>Issued</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers() function
                            $result = get_warrants();
                            ?>
                            <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['warrantID']; ?></td>
                                <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
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
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="mystation">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Issuing Court</th>
                                <th>Issuing Judge</th>
                                <th>Issued</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers() function
                            $result = get_warrants_by_station($stationID);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['warrantID']; ?></td>
                                    <td><a href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>"><?php echo $row['poiLastName']; ?>, <?php echo $row['poiFirstName']; ?></a></td>
                                    <td>
                                        <?php
                                        if(!empty($row['jobID'])){
                                            echo "<a href=\"job.php?jobID=" . $row['jobID'] . "\">". $row['jobID'] . "</a>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['court']; ?></td>
                                    <td><?php echo $row['judge']; ?></td>
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
            </div>
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
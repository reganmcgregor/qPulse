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
$title = "Arrests";

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
        <h1 class="page-header">Arrests
            <?php
            //show add arrest button for watchhouse officers only
            if($_SESSION['role'] == 1) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addArrestModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Arrest</button>';
            }
            ?>
        </h1>

        <?php
        //show add arrest modal for watchhouse officers only
        if($_SESSION['role'] == 1) {
            require('arrest_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#allarrests" aria-controls="allarrests" role="tab" data-toggle="tab">All Arrests</a></li>
                <li role="presentation"><a href="#mystation" aria-controls="mystation" role="tab" data-toggle="tab"><?php echo $stationName; ?> Arrests</a></li>
                <li role="presentation"><a href="#myprocessed" aria-controls="myprocessed" role="tab" data-toggle="tab">My Processed</a></li>
                <li role="presentation"><a href="#myarrests" aria-controls="myarrests" role="tab" data-toggle="tab">My Arrests</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="allarrests">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Arresting Officer</th>
                                <th>Processing Officer</th>
                                <th>Issuing Station</th>
                                <th>Arrested</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_arrests() function
                            $result = get_arrests();
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
                <div role="tabpanel" class="tab-pane" id="mystation">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Arresting Officer</th>
                                <th>Processing Officer</th>
                                <th>Arrested</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_arrests_by_station() function
                            $result = get_arrests_by_station($stationID);
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
                <div role="tabpanel" class="tab-pane" id="myprocessed">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Warrant&nbsp;#</th>
                                <th>Offender</th>
                                <th>Job&nbsp;#</th>
                                <th>Arresting Officer</th>
                                <th>Arrested</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_arrests_by_processingBadgeID() function
                            $result = get_arrests_by_processingBadgeID($_SESSION['user']);
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
                                        //display the officer data
                                        echo  $result['rank'] ." " . $result['lastName'] .", "  . $result['firstName'] . " #" . $result['badgeID'];
                                        ?>
                                    </td>
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
                <div role="tabpanel" class="tab-pane" id="myarrests">
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
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_arrests_by_arrestingBadgeID() function
                            $result = get_arrests_by_arrestingBadgeID($_SESSION['user']);
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
                                        //display the officer data
                                        echo  $result['rank'] ." " . $result['lastName'] .", "  . $result['firstName'] . " #" . $result['badgeID'];
                                        ?>
                                    </td>
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
            </div>
            <!-- Update Arrest modal -->
            <div class="modal fade" id="updateArrestModal" tabindex="-1" role="dialog" aria-labelledby="updateArrestModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
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
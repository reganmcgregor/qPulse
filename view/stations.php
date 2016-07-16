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
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Stations";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Stations
            <?php
            //show add station button for regional operations only
            if($_SESSION['role'] == 3) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addStationModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Station</button>';
            }
            ?>
        </h1>

        <?php
        //show add station modal For regional operations only
        if($_SESSION['role'] == 3) {
            require('station_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Division</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php
                    //call the get_stations() function
                    $result = get_stations();
                    ?>
                    <?php foreach($result as $row):?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['division']; ?></td>
                            <td>
                                <?php echo $row['street']; ?>&nbsp;<?php echo $row['streetType']; ?><br />
                                <?php echo $row['suburb']; ?>,&nbsp;<?php echo $row['state']; ?>&nbsp;<?php echo $row['postcode']; ?>
                            </td>
                            <td>
                                <?php echo $row['phone']; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- Link trigger modal -->
                                    <a href="station_update_form.php?stationID=<?php echo $row['stationID']; ?>" data-toggle="modal" data-target="#updateStationModal" class="btn btn-info">
                                        View Station
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- Update Station modal -->
            <div class="modal fade" id="updateStationModal" tabindex="-1" role="dialog" aria-labelledby="updateStationModalLabel" aria-hidden="true">
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
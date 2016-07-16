<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_pois.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Persons Of Interest";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Persons Of Interest
            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addPoiModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Person Of Interest</button>
        </h1>

        <!-- Add Person Of Interest Modal -->
        <?php require('poi_add_form.php'); ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php
                    //call the get_pois() function
                    $result = get_pois();
                    ?>
                    <?php foreach($result as $row):?>
                        <tr>
                            <td><img src="../src/img/mugshots/<?php echo $row['photo']; ?>" alt="<?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?>" width="50" height="50" /></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo date("d M Y", strtotime($row['dob'])); ?></td>
                            <td>
                            <?php
                            if($row['gender'] == 0) {
                                echo "Male";
                            } elseif ($row['gender'] == 1) {
                                echo "Female";
                            }
                            ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="poi_update_form.php?poiID=<?php echo $row['poiID']; ?>" role="button">
                                        View Person Of Interest
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
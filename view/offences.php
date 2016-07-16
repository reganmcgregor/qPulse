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
$title = "Offences";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Offences
            <?php
            //show add offence button for regional operations only
            if($_SESSION['role'] == 3) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addOffenceModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Offence</button>';
            }
            ?>
        </h1>

        <?php
        //show add offence modal For regional operations only
        if($_SESSION['role'] == 3) {
            require('offence_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#criminal" aria-controls="criminal" role="tab" data-toggle="tab">Criminal Offences</a></li>
                <li role="presentation"><a href="#fineable" aria-controls="fineable" role="tab" data-toggle="tab">Fineable Offences</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="criminal">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Section</th>
                                <th>Act</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_offences_by_type() function
                            $result = get_offences_by_type(0);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
                                    <td><?php echo $row['act']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Trigger Update Offence modal -->
                                            <a href="offence_update_form.php?offenceID=<?php echo $row['offenceID']; ?>" data-toggle="modal" data-target="#updateOffenceModal" class="btn btn-info">
                                                View Offence
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="fineable">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Section</th>
                                <th>Act</th>
                                <th>Penalty</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_offences_by_type() function
                            $result = get_offences_by_type(1);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['section']; ?></td>
                                    <td><?php echo $row['act']; ?></td>
                                    <td>$<?php echo $row['penalty']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="offence_update_form.php?offenceID=<?php echo $row['offenceID']; ?>" data-toggle="modal" data-target="#updateOffenceModal" class="btn btn-info">
                                                View Offence
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Update Offence modal -->
            <div class="modal fade" id="updateOffenceModal" tabindex="-1" role="dialog" aria-labelledby="updateOffenceModalLabel" aria-hidden="true">
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
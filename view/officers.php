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
$title = "Officers";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Officers
            <?php
            //show add officer button for regional operations only
            if($_SESSION['role'] == 3) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addOfficerModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Officer</button>';
            }
            ?>
        </h1>

        <?php
        //show add officer modal For regional operations only
        if($_SESSION['role'] == 3) {
            require('officer_add_form.php');
        }
        ?>

        <?php
        //call user_message() function
        $message = user_message();
        ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#allofficers" aria-controls="allofficers" role="tab" data-toggle="tab">All Officers</a></li>
                <li role="presentation"><a href="#onduty" aria-controls="onduty" role="tab" data-toggle="tab">On Duty</a></li>
                <li role="presentation"><a href="#offduty" aria-controls="offduty" role="tab" data-toggle="tab">Off Duty</a></li>
                <li role="presentation"><a href="#police" aria-controls="police" role="tab" data-toggle="tab">Police Officers</a></li>
                <li role="presentation"><a href="#watchhouse" aria-controls="watchhouse" role="tab" data-toggle="tab">Watchhouse Officers</a></li>
                <li role="presentation"><a href="#communications" aria-controls="communications" role="tab" data-toggle="tab">Police Communications</a></li>
                <li role="presentation"><a href="#operations" aria-controls="operations" role="tab" data-toggle="tab">Regional Operations</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="allofficers">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers() function
                            $result = get_officers();
                            ?>
                            <?php foreach($result as $row):?>
                            <tr>
                                <td><?php echo $row['badgeID']; ?></td>
                                <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                <td><?php echo $row['rank']; ?></td>
                                <td>                                    <?php
                                    if($row['role'] == 0 ) {
                                        echo 'Police Officer';
                                    } elseif($row['role'] == 1 ) {
                                        echo 'Watchhouse Officer';
                                    } elseif($row['role'] == 2 ) {
                                        echo 'Police Communications';
                                    } elseif($row['role'] == 3 ) {
                                        echo 'Regional Operations';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Link trigger modal -->
                                        <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                            View Officer
                                        </a>
                                        <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="onduty">
                    <div class="table">
                        <?php
                        //call the get_officers_by_duty() function
                        $result = get_officers_by_duty(1);
                        ?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="offduty">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers_by_duty() function
                            $result = get_officers_by_duty(0);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="police">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers_by_role() function
                            $result = get_officers_by_role(0);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="watchhouse">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers_by_role() function
                            $result = get_officers_by_role(1);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="communications">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers_by_role() function
                            $result = get_officers_by_role(2);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
                <div role="tabpanel" class="tab-pane" id="operations">
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Badge Number #</th>
                                <th>Name</th>
                                <th>Rank</th>
                                <th>Role</th>
                                <th>Station</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            //call the get_officers_by_role() function
                            $result = get_officers_by_role(3);
                            ?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?php echo $row['badgeID']; ?></td>
                                    <td><?php echo $row['lastName']; ?>, <?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['rank']; ?></td>
                                    <td>                                    <?php
                                        if($row['role'] == 0 ) {
                                            echo 'Police Officer';
                                        } elseif($row['role'] == 1 ) {
                                            echo 'Watchhouse Officer';
                                        } elseif($row['role'] == 2 ) {
                                            echo 'Police Communications';
                                        } elseif($row['role'] == 3 ) {
                                            echo 'Regional Operations';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Link trigger modal -->
                                            <a href="officer_update_form.php?badgeID=<?php echo $row['badgeID']; ?>" data-toggle="modal" data-target="#updateOfficerModal" class="btn btn-info">
                                                View Officer
                                            </a>
                                            <?php
                                            //change officer duty for police communications only
                                            if($_SESSION['role'] == 2){
                                                if($row['duty'] == 1) {
                                                    echo '<button type="button" class="btn btn-success dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      On Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-warning dropdown-toggle" id="changeStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Off Duty 
                                                      <span class="caret"></span>
                                                      </button>';
                                                }
                                                echo '<ul class="dropdown-menu">';
                                                echo '<li class="dropdown-header">Change Status</li>';
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=1\">On Duty</a></li>";
                                                echo "<li><a href=\"../controller/duty_process.php?badgeID=" . $row['badgeID'] ."&duty=0\">Off Duty</a></li>";
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
            <!-- Update Officer modal -->
            <div class="modal fade" id="updateOfficerModal" tabindex="-1" role="dialog" aria-labelledby="updateOfficerModalLabel" aria-hidden="true">
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
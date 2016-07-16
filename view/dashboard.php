<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_jobs.php');
require('../model/functions_pois.php');
require('../model/functions_offences.php');
require('../model/functions_officers.php');
require('../model/functions_job_codes.php');
require('../model/functions_stations.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Dashboard";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');

?>

<section>
    <div class="container">
        <h1 class="page-header">Dashboard</h1>
        <?php
        //call user_message() function
        $message = user_message();
        ?>
        <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Open Jobs</h3>
                    </div> 
                    <div class="panel-body" id="openjobswidget">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Issued Fines</h3>
                    </div>
                    <div class="panel-body" id="issuedfinesswidget">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Active Warrants</h3>
                    </div>
                    <div class="panel-body" id="activewarrantswidget">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
                <div class="panel panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Officers On Duty</h3>
                    </div>
                    <div class="panel-body" id="ondutywidget">
                    </div>
                </div>
            </div>
        </div>

        <?php
        if($_SESSION['role'] == 0) {
            echo '<h1 class="page-header">On Job</h1>';
            echo '<div class="table" id="dashboardinprogressjobs">';
            echo '</div>';
        }
        ?>

        <h1 class="page-header">Open Jobs
            <?php
            if($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addJobModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Job</button>';
            }
            ?>
        </h1>


        <!-- Add Job Modal -->
        <?php
            if($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
                require('job_add_form.php');
            }
        ?>

        <div>
            <div class="table" id="dashboardopenjobs">
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
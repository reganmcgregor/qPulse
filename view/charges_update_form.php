<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_warrants_arrests.php');
require('../model/functions_offences.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "View Charges";

//retrieve the warrantID from the URL
$warrantID = $_GET['warrantID'];

?>

<form id="addChargesForm" action="../controller/charge_add_process.php" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="updateChargesModalLabel">View Charges - Warrant #<?php echo $warrantID ?></h4>
    </div>
    <div class="modal-body">
        <div>
            <div class="table">
                <table class="table table-hover">
                    <thead>
                    <th>Charge&nbsp;#</th>
                    <th>Offence</th>
                    <th>Section</th>
                    <th>Act</th>
                    </thead>
                    <?php
                    //call the get_charges() function
                    $result = get_charges();
                    ?>
                    <?php foreach($result as $row):?>
                        <tr>
                            <td><?php echo $row['chargeID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['section']; ?></td>
                            <td><?php echo $row['act']; ?></td>
                            <?php
                            //show charge delete button for watchhouse officers only
                            if($_SESSION['role'] == 1) {
                                echo "<td><a href=\"../controller/charge_delete_process.php?chargeID=". $row['chargeID'] . "\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a></td>";
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                if(!$result){
                    echo "<div class=\"well well-lg\">There are currently no Charges assigned to this Warrant.</div>";
                }
                ?>
                <?php
                if($_SESSION['role'] == 1) {
                    echo '<div class="form-group">';
                    echo '<label for="offenceID" class="control-label">Offence</label>';
                    echo '<select name="offenceID" class="form-control selectpicker" data-live-search="true">';
                    echo '<option value="">Please select*</option>';
                    //call the get_station_dropdown() function
                    $result = get_offence_dropdown_by_type(0);
                    //display the station data in each row using a foreach loop
                    foreach($result as $row):
                        echo "<option value=" . $row['offenceID'] . ">" . $row['name'] . "</option>";
                    endforeach;
                    echo '</select>';
                    echo '</div>';
                }
                ?>
                <input type="hidden" name="warrantID" value="<?php echo $warrantID; ?>">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <?php
        //submit for watchhouse officers only
        if($_SESSION['role'] == 1) {
        echo '<button type="submit" class="btn btn-success">Add Charge</button>';
        }
        ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>




<?php
//start session management
session_start();
//include authorisation management
require('../controller/authorisation.php');
//connect to the database
require('../model/database.php');
//retrieve the functions
require('../model/functions_job_codes.php');
require('../model/functions_messages.php');

//provide the value of the $title variable for this page
$title = "Job Codes";

//retrieve the header
require('header.php');
//retrieve the navigation
require('nav.php');
?>

<section>
    <div class="container">
        <h1 class="page-header">Job Codes
            <?php
            //show add job code button for regional operations only
            if($_SESSION['role'] == 3) {
                echo '<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addJobCodeModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Job Code</button>';
            }
            ?>
        </h1>

        <?php
        //show add job code modal For regional operations only
        if($_SESSION['role'] == 3) {
            require('job_code_add_form.php');
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
                        <th>Code</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php
                    //call the get_job_codes() function
                    $result = get_job_codes();
                    ?>
                    <?php foreach($result as $row):?>
                        <tr>
                            <td><?php echo $row['code']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <!-- Link trigger modal -->
                                    <a href="job_code_update_form.php?jobCodeID=<?php echo $row['jobCodeID']; ?>" data-toggle="modal" data-target="#updateJobCodeModal" class="btn btn-info">
                                        View Job Code
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- Update Job Code modal -->
            <div class="modal fade" id="updateJobCodeModal" tabindex="-1" role="dialog" aria-labelledby="updateJobCodeModalLabel" aria-hidden="true">
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
<div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addJobForm" action="../controller/job_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addJobModalLabel">Add Job</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="priority" class="control-label">Priority Code</label>
                                <select name="priority" class="form-control selectpicker">
                                    <option value="">Please select*</option>
                                    <option value="0">Code 1 - Very Urgent</option>
                                    <option value="1">Code 2 - Urgent</option>
                                    <option value="2">Code 3 - Routine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="jobCodeID" class="control-label">Job Code</label>
                                <select name="jobCodeID" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Please select*</option>
                                    <?php
                                    //call the get_job_code_dropdown() function
                                    $result = get_job_code_dropdown();
                                    //display the station data in each row using a foreach loop
                                    foreach($result as $row):
                                        echo "<option value=" . $row['jobCodeID'] . ">" . $row['code'] . " - " . $row['description'] . "</option>";
                                    endforeach
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stationID" class="control-label">Responding Station</label>
                        <select name="stationID" class="form-control selectpicker" data-live-search="true">
                            <option value="">Please select*</option>
                            <?php
                            //call the get_station_dropdown() function
                            $result = get_station_dropdown();
                            //display the station data in each row using a foreach loop
                            foreach($result as $row):
                                echo "<option value=" . $row['stationID'] . ">" . $row['name'] . "</option>";
                            endforeach
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note" class="control-label">Notes</label>
                        <textarea name="note" class="form-control" id="note" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

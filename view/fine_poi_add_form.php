<div class="modal fade" id="addFineModal" tabindex="-1" role="dialog" aria-labelledby="addFineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addFineForm" action="../controller/fine_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addFineModalLabel">Add Fine</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="offenceID" class="control-label">Offence</label>
                                <select name="offenceID" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Please select*</option>
                                    <?php
                                    //call the get_station_dropdown() function
                                    $array = get_offence_dropdown_by_type(1);
                                    //display the station data in each row using a foreach loop
                                    foreach($array as $row):
                                        echo "<option value=" . $row['offenceID'] . ">" . $row['name'] . "</option>";
                                    endforeach
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="jobID" class="control-label">Job</label>
                                <input type="text" name="jobID" class="form-control" id="jobID" maxlength="150" placeholder="Enter Job Number" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="control-label">Notes</label>
                        <textarea name="note" class="form-control" id="note" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="poiID" value="<?php echo $poiID; ?>" />
                    <input type="hidden" name="badgeID" value="<?php echo $_SESSION["user"]; ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
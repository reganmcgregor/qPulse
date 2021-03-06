<div class="modal fade" id="addWarrantModal" tabindex="-1" role="dialog" aria-labelledby="addWarrantModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addWarrantForm" action="../controller/warrant_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addWarrantModalLabel">Add Warrant</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="poiID" class="control-label">Offender</label>
                                <select name="poiID" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                    <option value="">Please select*</option>
                                    <?php
                                    //call the get_station_dropdown() function
                                    $result = get_poi_dropdown();
                                    //display the station data in each row using a foreach loop
                                    foreach($result as $row):
                                        echo "<option value=" . $row['poiID'] . ">". $row['lastName'] .", "  . $row['firstName'] . " (" . date("d-m-Y", strtotime($row['dob'])) . ")</option>";
                                    endforeach
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="stationID" class="control-label">Issuing Station</label>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="court" class="control-label">Issuing Court</label>
                                <input type="text" name="court" id="court" class="form-control" placeholder="Enter Issuing Court" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="judge" class="control-label">Issuing Judge</label>
                                <input type="text" name="judge" id="judge" class="form-control" placeholder="Enter Issuing Judge" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="control-label">Notes</label>
                        <textarea name="note" class="form-control" id="note" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="jobID" value="<?php echo $jobID; ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

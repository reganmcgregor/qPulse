<div class="modal fade" id="addArrestModal" tabindex="-1" role="dialog" aria-labelledby="addArrestModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addArrestForm" action="../controller/arrest_add_process.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addArrestModalLabel">Add Arrest</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="poiID" class="control-label">Offender</label>
                                <select name="poiID" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                    <option value="">Please select*</option>
                                    <?php
                                    //call the get_poi_dropdown() function
                                    $result = get_poi_dropdown();
                                    //display the person of interest data in each row using a foreach loop
                                    foreach($result as $row):
                                        echo "<option value=" . $row['poiID'] . ">". $row['lastName'] .", "  . $row['firstName'] . " (" . date("d-m-Y", strtotime($row['dob'])) . ")</option>";
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
                    <div class="form-group">
                        <label for="badgeID" class="control-label">Arresting Officer</label>
                        <select name="badgeID" class="form-control selectpicker" data-live-search="true">
                            <option value="">Please select*</option>
                            <?php
                            //call the get_officer_dropdown() function
                            $result = get_officer_dropdown();
                            //display the officer data in each row using a foreach loop
                            foreach($result as $row):
                                echo "<option value=" . $row['badgeID'] . ">". $row['rank'] ." " . $row['lastName'] .", "  . $row['firstName'] . " #" . $row['badgeID'] . "</option>";
                            endforeach
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mugshot">Mugshot</label>
                        <input type="file" id="mugshot" name="mugshot">
                        <p class="help-block">* Only JPG, GIF and PNG files. 500kb Max.</p>
                    </div>
                    <div class="form-group">
                        <label for="note" class="control-label">Notes</label>
                        <textarea name="note" class="form-control" id="note" rows="4"></textarea>
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

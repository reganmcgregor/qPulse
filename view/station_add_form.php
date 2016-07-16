<div class="modal fade" id="addStationModal" tabindex="-1" role="dialog" aria-labelledby="addStationModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addStationForm" action="../controller/station_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addStationModalLabel">Add Station</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="150" placeholder="Enter stations name*" required />
                    </div>
                    <div class="form-group">
                        <label for="division" class="control-label">Division</label>
                        <select name="division" class="form-control selectpicker">
                            <option value="">Please select</option>
                            <option value="Brisbane Region">Brisbane Region</option>
                            <option value="Central Region">Central Region</option>
                            <option value="Northern Region">Northern Region</option>
                            <option value="South Eastern Region">South Eastern Region</option>
                            <option value="Southern Region">Southern Region</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="street" class="control-label">Street</label>
                                <input type="text" name="street" class="form-control" id="street" maxlength="50" placeholder="Enter stations street*" required />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="streetType" class="control-label">Street Type</label>
                                <select name="streetType" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Please select</option>
                                    <option value="ALLEY">ALLEY</option>
                                    <option value="APPROACH">APPROACH</option>
                                    <option value="ARCADE">ARCADE</option>
                                    <option value="AVENUE">AVENUE</option>
                                    <option value="BOULEVARD">BOULEVARD</option>
                                    <option value="BROW">BROW</option>
                                    <option value="BYPASS">BYPASS</option>
                                    <option value="CAUSEWAY">CAUSEWAY</option>
                                    <option value="CIRCUIT">CIRCUIT</option>
                                    <option value="CIRCUS">CIRCUS</option>
                                    <option value="CLOSE">CLOSE</option>
                                    <option value="COPSE">COPSE</option>
                                    <option value="CORNER">CORNER</option>
                                    <option value="COVE">COVE</option>
                                    <option value="COURT">COURT</option>
                                    <option value="CRESCENT">CRESCENT</option>
                                    <option value="DRIVE">DRIVE</option>
                                    <option value="END">END</option>
                                    <option value="ESPLANANDE">ESPLANANDE</option>
                                    <option value="FLAT">FLAT</option>
                                    <option value="FREEWAY">FREEWAY</option>
                                    <option value="FRONTAGE">FRONTAGE</option>
                                    <option value="GARDENS">GARDENS</option>
                                    <option value="GLADE">GLADE</option>
                                    <option value="GLEN">GLEN</option>
                                    <option value="GREEN">GREEN</option>
                                    <option value="GROVE">GROVE</option>
                                    <option value="HEIGHTS">HEIGHTS</option>
                                    <option value="HIGHWAY">HIGHWAY</option>
                                    <option value="LANE">LANE</option>
                                    <option value="LINK">LINK</option>
                                    <option value="LOOP">LOOP</option>
                                    <option value="MALL">MALL</option>
                                    <option value="MEWS">MEWS</option>
                                    <option value="PACKET">PACKET</option>
                                    <option value="PARADE">PARADE</option>
                                    <option value="PARK">PARK</option>
                                    <option value="PARKWAY">PARKWAY</option>
                                    <option value="PLACE">PLACE</option>
                                    <option value="PROMENADE">PROMENADE</option>
                                    <option value="RESERVE">RESERVE</option>
                                    <option value="RIDGE">RIDGE</option>
                                    <option value="RISE">RISE</option>
                                    <option value="ROAD">ROAD</option>
                                    <option value="ROW">ROW</option>
                                    <option value="SQUARE">SQUARE</option>
                                    <option value="STREET">STREET</option>
                                    <option value="STRIP">STRIP</option>
                                    <option value="TARN">TARN</option>
                                    <option value="TERRACE">TERRACE</option>
                                    <option value="THOROUGHFARE">THOROUGHFARE</option>
                                    <option value="TRACK">TRACK</option>
                                    <option value="TRUNKWAY">TRUNKWAY</option>
                                    <option value="VIEW">VIEW</option>
                                    <option value="VISTA">VISTA</option>
                                    <option value="WALK">WALK</option>
                                    <option value="WAY">WAY</option>
                                    <option value="WALKWAY">WALKWAY</option>
                                    <option value="YARD">YARD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                            <div class="form-group">
                                <label for="suburb" class="control-label">Suburb</label>
                                <input type="text" name="suburb" class="form-control selectpicker" id="suburb" maxlength="50" placeholder="Enter stations suburb*" required />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-5">
                            <div class="form-group">
                                <label for="state" class="control-label">State</label>
                                <select name="state" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    <option value="Queensland">Queensland</option>
                                    <option value="New South Wales">New South Wales</option>
                                    <option value="Australian Capital Territory">Australian Capital Territory</option>
                                    <option value="Northern Territory">Northern Territory</option>
                                    <option value="South Australia">South Australia</option>
                                    <option value="Tasmania">Tasmania</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Western Australia">Western Australia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <div class="form-group">
                                <label for="postcode" class="control-label">Postcode</label>
                                <input type="number" name="postcode" class="form-control" maxlength="4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone-group" maxlength="10" placeholder="Enter stations phone number*" required />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="fax" class="control-label">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control" maxlength="10" placeholder="Enter stations fax number" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" maxlength="256" placeholder="Enter stations email*" required />
                    </div>
                    <div class="form-group">
                        <label for="badgeID" class="control-label">Officer In Charge</label>
                        <select name="badgeID" class="form-control selectpicker" data-live-search="true">
                            <option value="">Please select</option>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

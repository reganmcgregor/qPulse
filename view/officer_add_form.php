<div class="modal fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addOfficerForm" action="../controller/officer_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addOfficerModalLabel">Add Officer</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName" class="control-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" maxlength="50" placeholder="Enter officers first name"  />
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="control-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" maxlength="50" placeholder="Enter officers last name" required />
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" maxlength="256" placeholder="Enter officers email*" required />
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" maxlength="64" placeholder="Enter officers password*" required pattern=".{8,}" />
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="dob" class="control-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" required />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>
                                <select name="gender" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label for="street" class="control-label">Street</label>
                                    <input type="text" name="street" class="form-control" id="street" maxlength="50" placeholder="Enter officers street" required />
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
                                    <input type="text" name="suburb" class="form-control" id="suburb" maxlength="50" placeholder="Enter officers suburb" required />
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
                                <input type="text" name="phone" id="phone" class="form-control phone-group" maxlength="10" placeholder="Enter officers phone number" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="mobile" class="control-label">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control phone-group" maxlength="10" placeholder="Enter officers mobile phone number" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="rank" class="control-label">Rank</label>
                                <select name="rank" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    <option value="Constable">Constable</option>
                                    <option value="Senior Constable">Senior Constable</option>
                                    <option value="Sergeant">Sergeant</option>
                                    <option value="Senior Sergeant">Senior Sergeant</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Superintendent">Superintendent</option>
                                    <option value="Chief Superintendent">Chief Superintendent</option>
                                    <option value="Assistant Commissioner">Assistant Commissioner</option>
                                    <option value="Deputy Commissioner">Deputy Commissioner</option>
                                    <option value="Commissioner">Commissioner</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="role" class="control-label">Role</label>
                                <select name="role" class="form-control selectpicker" >
                                    <option value="">Please select</option>
                                    <option value="0">Police Officer</option>
                                    <option value="1">Watchhouse Officer</option>
                                    <option value="2">Police Communications</option>
                                    <option value="3">Regional Operations</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stationID" class="control-label">Station</label>
                        <select name="stationID" class="form-control selectpicker" data-live-search="true">
                            <option value="">Please select</option>
                            <?php
                            //call the get_station_dropdown() function
                            $result = get_station_dropdown();
                            //display the station data in each row using a foreach loop
                            foreach($result as $row):
                                echo "<option value=" . $row['stationID'] . ">" . $row['name'] . "</option>";
                            endforeach
                            ?>
                        </select>
                        <input type="hidden" name="duty" value="0" />
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

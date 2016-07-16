<div class="modal fade" id="addPoiModal" tabindex="-1" role="dialog" aria-labelledby="addPoiModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="addPoiForm" action="../controller/poi_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addPoiModalLabel">Add Person Of Interest</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstName" class="control-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" maxlength="255" placeholder="First name" required />
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="control-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" maxlength="255" placeholder="Last name" required />
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="dob" class="control-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" required/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="gender" class="control-label">Gender</label>
                                <select name="gender" class="form-control selectpicker">
                                    <option value="">Please select*</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="ethnicity" class="control-label">Ethnicity</label>
                                <select name="ethnicity" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    <option value="Caucasian">Caucasian</option>
                                    <option value="Aboriginal">Aboriginal</option>
                                    <option value="Torres Strait Islander">Torres Strait Islander</option>
                                    <option value="African">African</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Maori/Polynesian">Maori/Polynesian</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="eyes" class="control-label">Eyes</label>
                                <select name="eyes" class="form-control selectpicker">
                                    <option value="">Please select</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Hazel">Hazel</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Amber">Amber</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="height" class="control-label">Height</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="height" id="height" placeholder="Height" maxlength="4">
                                    <div class="input-group-addon">cm</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="weight" class="control-label">Weight</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="weight" id="weight" placeholder="Weight" maxlength="4">
                                    <div class="input-group-addon">kg</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label for="street" class="control-label">Street</label>
                                    <input type="text" name="street" class="form-control" id="street" maxlength="50" placeholder="Street" />
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
                                    <input type="text" name="suburb" class="form-control" id="suburb" maxlength="50" placeholder="Suburb" />
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
                                    <input type="number" name="postcode" class="form-control" maxlength="4" placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone-group" maxlength="10" placeholder="Phone number" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="mobile" class="control-label">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control phone-group" maxlength="10" placeholder="Mobile number" />
                            </div>
                        </div>
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

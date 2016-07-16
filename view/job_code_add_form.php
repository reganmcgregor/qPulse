<div class="modal fade" id="addJobCodeModal" tabindex="-1" role="dialog" aria-labelledby="addJobCodeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addJobCodeForm" action="../controller/job_code_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addJobCodeModalLabel">Add Job Code</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="code" class="control-label">Code</label>
                                    <input type="text" name="code" class="form-control" placeholder="Enter job code*" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="category" class="control-label">Category</label>
                                <select name="category" class="form-control selectpicker">
                                    <option value="">Please select*</option>
                                    <option value="Offences Against Persons">Offences Against Persons</option>
                                    <option value="Sexual Offences">Sexual Offences</option>
                                    <option value="Stealing Offences">Stealing Offences</option>
                                    <option value="Offences Against Property">Offences Against Property</option>
                                    <option value="Prowler Related Offences">Prowler Related Offences</option>
                                    <option value="Traffic Incidents">Traffic Incidents</option>
                                    <option value="Crisis Situations">Crisis Situations</option>
                                    <option value="Disturbances">Disturbances</option>
                                    <option value="Fire">Fire</option>
                                    <option value="Explosives">Explosives</option>
                                    <option value="Spillages/Leaks">Spillages/Leaks</option>
                                    <option value="Aviation/Maritime">Aviation/Maritime</option>
                                    <option value="Personal Trauma">Personal Trauma</option>
                                    <option value="Assist Other Emergency Services">Assist Other Emergency Services</option>
                                    <option value="Absconder">Absconder</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" name="description" class="form-control" id="description" placeholder="Enter job code description*" required />
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

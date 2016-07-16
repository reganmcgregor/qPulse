<div class="modal fade" id="addOffenceModal" tabindex="-1" role="dialog" aria-labelledby="addOffenceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addOffenceForm" action="../controller/offence_add_process.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addOffenceModalLabel">Add Offence</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="255" placeholder="Enter offence name*" required />
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="act" class="control-label">Act</label>
                                <input type="text" name="act" class="form-control" id="act" maxlength="255" placeholder="Enter offence act*" required />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="section" class="control-label">Section</label>
                                    <input type="text" name="section" class="form-control" placeholder="Enter offence section*" maxlength="4" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Enter offence description*" required rows="15"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="type" class="control-label">Offence Type</label>
                                <select name="type" id="offenceType" class="form-control selectpicker">
                                    <option value="">Please select*</option>
                                    <option value="0">Criminal Offence</option>
                                    <option value="1">Fineable Offence</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="penalty" class="control-label">Penalty</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input type="number" name="penalty" class="form-control" value="0.00" >
                                    </div>
                                </div>
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

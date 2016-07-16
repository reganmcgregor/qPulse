$(document).ready(function(){

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    $(function(){
        function openJobsBadgeWidgetLoad(){
            $("#openjobsbadgewidget").load("widgets/open_jobs_badge.php");
        }

        openJobsBadgeWidgetLoad();

        setInterval(openJobsBadgeWidgetLoad,2000);
    });

    $(function(){
        function openJobsWidgetLoad(){
            $("#openjobswidget").load("widgets/open_jobs.php");
        }

        openJobsWidgetLoad();

        setInterval(openJobsWidgetLoad,2000);
    });

    $(function(){
        function issuedFinesWidgetLoad(){
            $("#issuedfinesswidget").load("widgets/issued_fines.php");
        }

        issuedFinesWidgetLoad();

        setInterval(issuedFinesWidgetLoad,2000);
    });

    $(function(){
        function activeWarrantWidgetLoad(){
            $("#activewarrantswidget").load("widgets/active_warrants.php");
        }

        activeWarrantWidgetLoad();

        setInterval(activeWarrantWidgetLoad,2000);
    });

    $(function(){
        function onDutyWidgetLoad(){
            $("#ondutywidget").load("widgets/officers_on_duty.php");
        }

        onDutyWidgetLoad();

        setInterval(onDutyWidgetLoad,2000);
    });

    $(function(){
        function openJobsLoad(){
            $("#dashboardopenjobs").load("open_jobs.php");
        }

        openJobsLoad();

        setInterval(openJobsLoad,2000);
    });

    $(function(){
        function inProgressJobsLoad(){
            $("#dashboardinprogressjobs").load("in_progress_jobs.php");
        }

        inProgressJobsLoad();

        setInterval(inProgressJobsLoad,2000);
    });

    $(function(){
        function allJobsLoad(){
            $("#dashboardalljobs").load("all_jobs.php");
        }

        allJobsLoad();

        setInterval(allJobsLoad,2000);
    });

    $(function(){
        function myJobsLoad(){
            $("#dashboardmyjobs").load("my_jobs.php");
        }

        myJobsLoad();

        setInterval(myJobsLoad,2000);
    });

    $(function(){
        function closedJobsLoad(){
            $("#dashboardclosedjobs").load("closed_jobs.php");
        }

        closedJobsLoad();

        setInterval(closedJobsLoad,2000);
    });
    
    $(function(){
        function jobNoteLoad(){
            var jobnoteurl = "job_note.php?jobID=" + $("#jobjobnotes").data("jobid");
            $("#jobjobnotes").load(jobnoteurl);
        }

        jobNoteLoad();

        setInterval(jobNoteLoad,2000);
    });

    $(function(){
        function jobOfficerLoad(){
            var jobofficerurl = "job_officers.php?jobID=" + $("#jobofficers").data("jobid");
            $("#jobofficers").load(jobofficerurl);
        }

        jobOfficerLoad();

        setInterval(jobOfficerLoad,2000);
    });

    $(function(){
        function jobPoiLoad(){
            var jobpoiurl = "job_pois.php?jobID=" + $("#jobpois").data("jobid");
            $("#jobpois").load(jobpoiurl);
        }

        jobPoiLoad();

        setInterval(jobPoiLoad,2000);
    });


    $.validator.setDefaults({
        highlight: function (element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).addClass(errorClass).removeClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
                $(element).closest('.form-group').find('span.glyphicon').remove();
                $(element).closest('.form-group').append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).removeClass(errorClass).addClass(validClass);
            } else {
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                $(element).closest('.form-group').find('span.glyphicon').remove();
                $(element).closest('.form-group').append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
            }
        }
    });

    $('#addOfficerForm').validate(
        {
            rules:
            {
                firstName:
                {
                    required: true
                },
                lastName:
                {
                    required: true
                },
                email:
                {
                    required: true,
                    email: true
                },
                password:
                {
                    required: true,
                    minlength: 8
                },
                dob:
                {
                    required: true
                },
                gender:
                {
                    required: true
                },
                street:
                {
                    required: true
                },
                streetType:
                {
                    required: true
                },
                suburb :
                {
                    required: true
                },
                state :
                {
                    required: true
                },
                postcode :
                {
                    required: true,
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                phone :
                {
                    require_from_group: [1, ".phone-group"],
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                mobile :
                {
                    require_from_group: [1, ".phone-group"],
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                rank :
                {
                    required: true
                },
                role :
                {
                    required: true
                },
                stationID :
                {
                    required: true
                }
            },
            messages:
            {
                firstName:
                {
                    required: "Officers first name is required"
                },
                lastName:
                {
                    required: "Officers last name is required"
                },
                email:
                {
                    required: "Officers email address is required",
                    email: "Officers email address is not valid"
                },
                password:
                {
                    required: "Officers require a password",
                    minlength: "Officers password must be more than 8 characters"
                },
                dob:
                {
                    required: "Officers date of birth is required"
                },
                gender:
                {
                    required: "Officers gender is required"
                },
                street:
                {
                    required: "Officers street is required"
                },
                streetType:
                {
                    required: "Officers street type is required"
                },
                suburb:
                {
                    required: "Officers suburb is required"
                },
                state:
                {
                    required: "Officers state is required"
                },
                postcode :
                {
                    required: "Officers postcode is required",
                    digits: "Officers postcode must only be numbers",
                    minlength: "Officers postcode must be 4 digits",
                    maxlength: "Officers postcode must be 4 digits"
                },
                phone :
                {
                    require_from_group: "Officers require at least 1 contact number",
                    digits: "Officers phone number must only be numbers",
                    minlength: "Officers phone number must be 10 digits",
                    maxlength: "Officers phone number must be 10 digits"
                },
                mobile :
                {
                    require_from_group: "Officers require at least 1 contact number",
                    digits: "Officers mobile number must only be numbers",
                    minlength: "Officers mobile number must be 10 digits",
                    maxlength: "Officers mobile number must be 10 digits"
                },
                rank :
                {
                    required: "Officers rank is required"
                },
                role :
                {
                    required: "Officers role is required"
                },
                stationID :
                {
                    required: "Officers station is required"
                }
            }
        });

    $('#updateOfficerModal').on('shown.bs.modal', function () {
        $(this).find('#updateOfficerForm').validate(
            {
                rules:
                {
                    firstName:
                    {
                        required: true
                    },
                    lastName:
                    {
                        required: true
                    },
                    email:
                    {
                        required: true,
                        email: true
                    },
                    dob:
                    {
                        required: true
                    },
                    gender:
                    {
                        required: true
                    },
                    street:
                    {
                        required: true
                    },
                    streetType:
                    {
                        required: true
                    },
                    suburb :
                    {
                        required: true
                    },
                    state :
                    {
                        required: true
                    },
                    postcode :
                    {
                        required: true,
                        digits: true,
                        minlength: 4,
                        maxlength: 4
                    },
                    phone :
                    {
                        require_from_group: [1, ".phone-group"],
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    mobile :
                    {
                        require_from_group: [1, ".phone-group"],
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    rank :
                    {
                        required: true
                    },
                    role :
                    {
                        required: true
                    },
                    stationID :
                    {
                        required: true
                    }
                },
                messages:
                {
                    firstName:
                    {
                        required: "Officers first name is required"
                    },
                    lastName:
                    {
                        required: "Officers last name is required"
                    },
                    email:
                    {
                        required: "Officers email address is required",
                        email: "Officers email address is not valid"
                    },
                    dob:
                    {
                        required: "Officers date of birth is required"
                    },
                    gender:
                    {
                        required: "Officers gender is required"
                    },
                    street:
                    {
                        required: "Officers street is required"
                    },
                    streetType:
                    {
                        required: "Officers street type is required"
                    },
                    suburb:
                    {
                        required: "Officers suburb is required"
                    },
                    state:
                    {
                        required: "Officers state is required"
                    },
                    postcode :
                    {
                        required: "Officers postcode is required",
                        digits: "Officers postcode must only be numbers",
                        minlength: "Officers postcode must be 4 digits",
                        maxlength: "Officers postcode must be 4 digits"
                    },
                    phone :
                    {
                        require_from_group: "Officers require at least 1 contact number",
                        digits: "Officers phone number must only be numbers",
                        minlength: "Officers phone number must be 10 digits",
                        maxlength: "Officers phone number must be 10 digits"
                    },
                    mobile :
                    {
                        require_from_group: "Officers require at least 1 contact number",
                        digits: "Officers mobile number must only be numbers",
                        minlength: "Officers mobile number must be 10 digits",
                        maxlength: "Officers mobile number must be 10 digits"
                    },
                    rank :
                    {
                        required: "Officers rank is required"
                    },
                    role :
                    {
                        required: "Officers role is required"
                    },
                    stationID :
                    {
                        required: "Officers station is required"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $("#addStationForm").validate(
        {
            rules:
            {
                name:
                {
                    required: true
                },
                division:
                {
                    required: true
                },
                street:
                {
                    required: true
                },
                streetType:
                {
                    required: true
                },
                suburb:
                {
                    required: true
                },
                state:
                {
                    required: true
                },
                postcode:
                {
                    required: true,
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                phone:
                {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                fax :
                {
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                email:
                {
                    required: true,
                    email: true
                },
                badgeID:
                {
                    required: true
                }
            },
            messages:
            {
                name:
                {
                    required: "Stations name is required"
                },
                division:
                {
                    required: "Stations division is required"
                },
                street:
                {
                    required: "Stations street is required"
                },
                streetType:
                {
                    required: "Stations street type is required"
                },
                suburb:
                {
                    required: "Stations suburb is required"
                },
                state:
                {
                    required: "Stations state is required"
                },
                postcode:
                {
                    required: "Stations postcode is required",
                    digits: "Stations postcode must only be numbers",
                    minlength: "Stations postcode must be 4 digits",
                    maxlength: "Stations postcode must be 4 digits"
                },
                phone:
                {
                    required: "Stations phone number is required",
                    digits: "Stations phone number must only be numbers",
                    minlength: "Stations phone number must be 10 digits",
                    maxlength: "Stations phone number must be 10 digits"
                },
                fax:
                {
                    digits: "Stations fax number must only be numbers",
                    minlength: "Stations fax number must be 10 digits",
                    maxlength: "Stations fax number must be 10 digits"
                },
                email:
                {
                    required: "Stations email address is required",
                    email: "Stations email address is not valid"
                },
                badgeID:
                {
                    required: "Officer In Charge (OIC) is required"
                }
            }
        });
    
    $('#updateStationModal').on('shown.bs.modal', function () {
        $(this).find('#updateStationForm').validate(
            {
                rules:
                {
                    name:
                    {
                        required: true
                    },
                    division:
                    {
                        required: true
                    },
                    street:
                    {
                        required: true
                    },
                    streetType:
                    {
                        required: true
                    },
                    suburb:
                    {
                        required: true
                    },
                    state:
                    {
                        required: true
                    },
                    postcode:
                    {
                        required: true,
                        digits: true,
                        minlength: 4,
                        maxlength: 4
                    },
                    phone:
                    {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    fax :
                    {
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email:
                    {
                        required: true,
                        email: true
                    },
                    badgeID:
                    {
                        required: true
                    }
                },
                messages:
                {
                    name:
                    {
                        required: "Stations name is required"
                    },
                    division:
                    {
                        required: "Stations division is required"
                    },
                    street:
                    {
                        required: "Stations street is required"
                    },
                    streetType:
                    {
                        required: "Stations street type is required"
                    },
                    suburb:
                    {
                        required: "Stations suburb is required"
                    },
                    state:
                    {
                        required: "Stations state is required"
                    },
                    postcode:
                    {
                        required: "Stations postcode is required",
                        digits: "Stations postcode must only be numbers",
                        minlength: "Stations postcode must be 4 digits",
                        maxlength: "Stations postcode must be 4 digits"
                    },
                    phone:
                    {
                        required: "Stations phone number is required",
                        digits: "Stations phone number must only be numbers",
                        minlength: "Stations phone number must be 10 digits",
                        maxlength: "Stations phone number must be 10 digits"
                    },
                    fax:
                    {
                        digits: "Stations fax number must only be numbers",
                        minlength: "Stations fax number must be 10 digits",
                        maxlength: "Stations fax number must be 10 digits"
                    },
                    email:
                    {
                        required: "Stations email address is required",
                        email: "Stations email address is not valid"
                    },
                    badgeID:
                    {
                        required: "Officer In Charge (OIC) is required"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $("#addOffenceForm").validate(
        {
            rules:
            {
                name:
                {
                    required: true
                },
                act:
                {
                    required: true
                },
                section:
                {
                    required: true,
                    maxlength: 4
                },
                description:
                {
                    required: true
                },
                type:
                {
                    required: true
                },
                penalty:
                {
                    required: function(element) {
                        return $("#type").val() == 1;
                    }
                }
            },
            messages:
            {
                name:
                {
                    required: "Offence name is required"
                },
                act:
                {
                    required: "Offence division is required"
                },
                section:
                {
                    required: "Offence section is required",
                    maxlength: "Offence section must be no longer than 4"
                },
                description:
                {
                    required: "Offence description is required"
                },
                type:
                {
                    required: "Offence type is required"
                },
                penalty:
                {
                    required: "Penalty is required for fineable offences"
                }
            }
        });

    $('#updateOffenceModal').on('shown.bs.modal', function () {
        $(this).find('#updateOffenceForm').validate(
            {
                rules:
                {
                    name:
                    {
                        required: true
                    },
                    act:
                    {
                        required: true
                    },
                    section:
                    {
                        required: true,
                        maxlength: 4
                    },
                    description:
                    {
                        required: true
                    },
                    type:
                    {
                        required: true
                    },
                    penalty:
                    {
                        required: function(element) {
                            return $("#type").val() == 1;
                        }
                    }
                },
                messages:
                {
                    name:
                    {
                        required: "Offence name is required"
                    },
                    act:
                    {
                        required: "Offence division is required"
                    },
                    section:
                    {
                        required: "Offence section is required",
                        maxlength: "Offence section must be no longer than 4"
                    },
                    description:
                    {
                        required: "Offence description is required"
                    },
                    type:
                    {
                        required: "Offence type is required"
                    },
                    penalty:
                    {
                        required: "Penalty is required for fineable offences"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $("#addJobCodeForm").validate(
        {
            rules:
            {
                code:
                {
                    required: true,
                    digits: true,
                    maxlength: 10
                },
                category:
                {
                    required: true
                },
                description:
                {
                    required: true
                }
            },
            messages:
            {
                code:
                {
                    required: "Job code is required",
                    digits: "Job code must be digits",
                    maxlength: "Job code must be no longer than 10 digits"
                },
                category:
                {
                    required: "Job code category is required"
                },
                description:
                {
                    required: "Job code description is required"
                }
            }
        });

    $('#updateJobCodeModal').on('shown.bs.modal', function () {
        $(this).find('#updateJobCodeForm').validate(
            {
                rules:
                {
                    code:
                    {
                        required: true,
                        digits: true,
                        maxlength: 10
                    },
                    category:
                    {
                        required: true
                    },
                    description:
                    {
                        required: true
                    }
                },
                messages:
                {
                    code:
                    {
                        required: "Job code is required",
                        digits: "Job code must be digits",
                        maxlength: "Job code must be no longer than 10 digits"
                    },
                    category:
                    {
                        required: "Job code category is required"
                    },
                    description:
                    {
                        required: "Job code description is required"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#addPoiForm').validate(
        {
            rules:
            {
                firstName:
                {
                    required: true
                },
                lastName:
                {
                    required: true
                },
                dob:
                {
                    required: true
                },
                gender:
                {
                    required: true
                },
                height:
                {
                    digits: true,
                    maxlength: 4
                },
                weight:
                {
                    digits: true,
                    maxlength: 4
                },
                postcode :
                {
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                phone :
                {
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                mobile :
                {
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages:
            {
                firstName:
                {
                    required: "Person Of Interest's first name is required"
                },
                lastName:
                {
                    required: "Person Of Interest's last name is required"
                },
                dob:
                {
                    required: "Person Of Interest's date of birth is required"
                },
                gender:
                {
                    required: "Person Of Interest's gender is required"
                },
                height:
                {
                    digits: "Person Of Interest's height must only be numbers",
                    maxlength: "Officers postcode must be a max of 4 digits"
                },
                weight:
                {
                    digits: "Person Of Interest's postcode must only be numbers",
                    maxlength: "Officers postcode must be a max 4 digits"
                },
                postcode:
                {
                    digits: "Person Of Interest's postcode must only be numbers",
                    minlength: "Person Of Interest's postcode must be 4 digits",
                    maxlength: "Person Of Interest's postcode must be 4 digits"
                },
                phone:
                {
                    digits: "Person Of Interest's phone number must only be numbers",
                    minlength: "Person Of Interest's phone number must be 10 digits",
                    maxlength: "Person Of Interest's phone number must be 10 digits"
                },
                mobile :
                {
                    digits: "Person Of Interest's mobile number must only be numbers",
                    minlength: "Person Of Interest's mobile number must be 10 digits",
                    maxlength: "Person Of Interest's mobile number must be 10 digits"
                }
            }
        });

    $('#updatePoiForm').validate(
        {
            rules:
            {
                firstName:
                {
                    required: true
                },
                lastName:
                {
                    required: true
                },
                gender:
                {
                    required: true
                },
                dob:
                {
                    required: true
                },
                height:
                {
                    digits: true,
                    maxlength: 4
                },
                weight:
                {
                    digits: true,
                    maxlength: 4
                },
                postcode:
                {
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                phone :
                {
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                mobile :
                {
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages:
            {
                firstName:
                {
                    required: "Person Of Interest's first name is required"
                },
                lastName:
                {
                    required: "Person Of Interest's last name is required"
                },
                gender:
                {
                    required: "Person Of Interest's gender is required"
                },
                dob:
                {
                    required: "Person Of Interest's date of birth is required"
                },
                height:
                {
                    digits: "Person Of Interest's height must only be numbers",
                    maxlength: "Officers postcode must be a max of 4 digits"
                },
                weight:
                {
                    digits: "Person Of Interest's postcode must only be numbers",
                    maxlength: "Officers postcode must be a max 4 digits"
                },
                postcode:
                {
                    digits: "Person Of Interest's postcode must only be numbers",
                    minlength: "Person Of Interest's postcode must be 4 digits",
                    maxlength: "Person Of Interest's postcode must be 4 digits"
                },
                phone:
                {
                    digits: "Person Of Interest's phone number must only be numbers",
                    minlength: "Person Of Interest's phone number must be 10 digits",
                    maxlength: "Person Of Interest's phone number must be 10 digits"
                },
                mobile :
                {
                    digits: "Person Of Interest's mobile number must only be numbers",
                    minlength: "Person Of Interest's mobile number must be 10 digits",
                    maxlength: "Person Of Interest's mobile number must be 10 digits"
                }
            }
        });

    $('#addPoiNoteForm').validate(
        {
            rules:
            {
                note:
                {
                    required: true
                }
            },
            messages:
            {
                note:
                {
                    required: "Note content is required"
                }
            }
        });

    $('#addFineForm').validate(
        {
            rules:
            {
                offenceID:
                {
                    required: true
                },
                poiID:
                {
                    required: true
                },
                jobID:
                {
                    digits: true
                }
            },
            messages:
            {
                offenceID:
                {
                    required: "Offence is required"
                },
                poiID:
                {
                    required: "Offender is required"
                },
                jobID:
                {
                    digits: "Job Number must only be numbers"
                }
            }
        });

    $('#updateFineModal').on('shown.bs.modal', function () {
        $(this).find('#updateFineForm').validate(
            {
                rules:
                {
                    jobID:
                    {
                        digits: true
                    }
                },
                messages:
                {
                    jobID:
                    {
                        digits: "Job Number must only be numbers"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#addWarrantForm').validate(
        {
            rules:
            {
                offenceID:
                {
                    required: true
                },
                poiID:
                {
                    required: true
                },
                jobID:
                {
                    digits: true
                }
            },
            messages:
            {
                offenceID:
                {
                    required: "Offence is required"
                },
                poiID:
                {
                    required: "Offender is required"
                },
                jobID:
                {
                    digits: "Job Number must only be numbers"
                }
            }
        });

    $('#updateWarrantModal').on('shown.bs.modal', function () {
        $(this).find('#updateWarrantForm').validate(
            {
                rules:
                {
                    jobID:
                    {
                        digits: true
                    }
                },
                messages:
                {
                    jobID:
                    {
                        digits: "Job Number must only be numbers"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#updateChargesModal').on('shown.bs.modal', function () {
        $(this).find('#addChargesForm').validate(
            {
                rules:
                {
                    offenceID:
                    {
                        required: true
                    }
                },
                messages:
                {
                    offenceID:
                    {
                        required: "Offence is required"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#processArrestModal').on('shown.bs.modal', function () {
        $(this).find('#processArrestForm').validate(
            {
                rules:
                {
                    badgeID:
                    {
                        required: true
                    },
                    mugshot:
                    {
                        required: true,
                        extension: "jpg|gif|png",
                        accept: "image/*"
                    }
                },
                messages:
                {
                    badgeID:
                    {
                        required: "Arresting Officer is required."
                    },
                    mugshot:
                    {
                        required: "Mugshot is required.",
                        extension: "File type must be .jpg, .gif or .png",
                        accept: "Only images are accepted"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#addArrestForm').validate(
        {
            rules:
            {
                poiID:
                {
                    required: true
                },
                jobID:
                {
                    digits: true
                },
                stationID:
                {
                    required: true
                },
                badgeID:
                {
                    digits: true
                },
                mugshot:
                {
                    required: true,
                    extension: "jpg|gif|png",
                    accept: "image/*"
                }
            },
            messages:
            {
                poiID:
                {
                    required: "Offender is required"
                },
                jobID:
                {
                    digits: "Job Number must only be numbers"
                },
                stationID:
                {
                    required: "Offender is required"
                },
                badgeID:
                {
                    digits: "Arresting Officer is required."
                },
                mugshot:
                {
                    required: "Mugshot is required.",
                    extension: "File type must be .jpg, .gif or .png",
                    accept: "Only images are accepted"
                }
            }
        });

    $('#updateArrestModal').on('shown.bs.modal', function () {
        $(this).find('#updateArrestForm').validate(
            {
                rules:
                {
                    jobID:
                    {
                        digits: true
                    }
                },
                messages:
                {
                    jobID:
                    {
                        digits: "Job Number must only be numbers"
                    }
                }
            });
        $('.selectpicker').selectpicker('refresh');
    });

    $('#addJobForm').validate(
        {
            rules:
            {
                priority:
                {
                    required: true
                },
                jobCodeID:
                {
                    required: true
                },
                stationID:
                {
                    required: true
                }
            },
            messages:
            {
                priority:
                {
                    required: "Job Priority Code is required"
                },
                jobCodeID:
                {
                    required: "Job Code is required"
                },
                stationID:
                {
                    required: "Responding Station is required"
                }
            }
        });

    $('#addPoiJobForm').validate(
        {
            rules:
            {
                poiID:
                {
                    required: true
                },
                relationship:
                {
                    required: true
                }
            },
            messages:
            {
                poiID:
                {
                    required: "Person Of Interest is required"
                },
                relationship:
                {
                    required: "Relationship is required"
                }
            }
        });

});
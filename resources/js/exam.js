jQuery(document).ready(function($){
    
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery("#error").css("display", "none");
        jQuery("#title").removeClass("is-invalid");  
        jQuery("#title-error-message").text(); 
        jQuery('#examForm').trigger("reset");
        jQuery('#ExamModal').modal('show');
        $("#new-exam").show();
        $("#update-exam").hide();
        $("#btn-save").show();
            $("#btn-update").hide();
    });

    // CREATE
    $("#btn-save").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var exam_id = jQuery('#exam_id').val();
        var ajaxurl = 'exam';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var exam = '<tr id="exam' + data.id + '"><td scope="row">' + data.id + '</td><td>' + data.title + '</td>';
                exam += '<td><button type="button" class="btn btn-outline-info btn-sm" id="examView" data-id="'+ data.id +'">view</button>';
                exam += '<button type="button" class="btn btn-outline-secondary btn-sm" id="examEdit" data-id="'+ data.id +'">Edit</button>';
                exam += '<button type="button" class="btn btn-outline-danger btn-sm" id="examDelete" data-id="'+ data.id +'">Delete</button></td></tr>';
                if (state == "add") {
                    jQuery('#exam-lists').append(exam);
                } else {
                    jQuery("#exam" + exam_id).replaceWith(exam);
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#ExamModal').modal('hide')
            },
            error: function (data) {
                // console.log(data.responseJSON.errors);
                jQuery("#title").addClass("is-invalid");   
                jQuery("#title-error-message").text(data.responseJSON.errors.title);
                jQuery("#error").css("display", "block");
            }
        });
    });

    // Update
    $("#btn-update").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
        };
        var state = jQuery('#btn-update').val();
        var type = "PATCH";
        var exam_id = jQuery('#exam_id').val();
        var ajaxurl = 'exam/'+exam_id;
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var exam = '<tr id="exam' + data.id + '"><td scope="row">' + data.id + '</td><td>' + data.title + '</td>';
                exam += '<td><button type="button" class="btn btn-outline-info btn-sm" id="examView" data-id="'+ data.id +'">view</button>';
                exam += '<button type="button" class="btn btn-outline-secondary btn-sm" id="examEdit" data-id="'+ data.id +'">Edit</button>';
                exam += '<button type="button" class="btn btn-outline-danger btn-sm" id="examDelete" data-id="'+ data.id +'">Delete</button></td></tr>';

                if (state == "add") {
                    jQuery('#exam-lists').append(exam);
                } else {
                    jQuery("#exam" + exam_id).replaceWith(exam);
                }

                jQuery('#myForm').trigger("reset");
                jQuery('#ExamModal').modal('hide')
            },
            error: function (data) {
                // console.log(data);
                jQuery("#title").addClass("is-invalid");   
                jQuery("#title-error-message").text(data.responseJSON.errors.title);
                jQuery("#error").css("display", "block");
            }
        });
    });

    // Delete
    $("#btn-delete").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
        };
        var type = "DELETE";
        var exam_id = jQuery('#exam_id').val();
        var ajaxurl = 'exam/'+exam_id;
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                jQuery("#exam" + exam_id).remove();

                jQuery('#myForm').trigger("reset");
                jQuery('#deleteExam').modal('hide');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // remove error message
    $( "#title" ).keydown(function () {
        jQuery("#error").css("display", "none");
        jQuery("#title").removeClass("is-invalid");  
        jQuery("#title-error-message").text(); 
    });

    // edit exam
    $(document).on( "click" ,"#examEdit", function() {
        axios.get('/exam/'+$(this).data("id")).then(({data}) => (
            jQuery('#btn-save').val("add"),
            jQuery("#error").css("display", "none"),
            jQuery("#title").removeClass("is-invalid"),
            jQuery("#title-error-message").text(),
            jQuery('#examForm').trigger("reset"),
            jQuery('#ExamModal').modal('show'),
            $("#new-exam").hide(),
            $("#update-exam").show(),
            $("#new-exam").hide(),
            $("#btn-save").hide(),
            $("#btn-update").show(),
            jQuery('#exam_id').val(data.id),
            jQuery("#title").val(data.title)
        ));
    });

    // delete exam
    $(document).on( "click" ,"#examDelete", function() {
        console.log('Delete me' + $(this).data("id"));
        axios.get('/exam/'+$(this).data("id")).then(({data}) => (
            jQuery('#exam_id').val(data.id),
            jQuery('#deleteExam').modal('show'),
            jQuery("#exam-delete").text("Are you sure you want to delete "+ data.title +"?")
        ));
    });

    // view exam
    $(document).on( "click" ,"#examView", function() {
        // console.log('Hit me');
        window.location.href ="/exam/"+$(this).data("id")+"/edit";
    });

});
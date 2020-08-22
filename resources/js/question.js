jQuery(document).ready(function($){

    //----- Open model CREATE -----//
    jQuery('#btn-add-question').click(function () {
        jQuery("#question").removeClass("is-invalid");  
        jQuery("#question-error-message").text(); 
        jQuery("#points").removeClass("is-invalid");  
        jQuery("#points-error-message").text(); 
        jQuery("#category_id").removeClass("is-invalid");  
        jQuery("#category-error-message").text(); 
        jQuery('#questionForm').trigger("reset");
        jQuery('#QuestionModal').modal('show');
        $("#new-question").show();
        $("#update-question").hide();
        $("#btn-save-question").show();
        $("#btn-update-question").hide();
    });

    // CREATE
    $("#btn-save-question").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            question: jQuery('#question').val(),
            points: jQuery('#points').val(),
            category_id: jQuery('#category_id').val(),
            exam_id: jQuery('#exam_id').val(),
        };
        var state = jQuery('#btn-save-question').val();
        var type = "POST";
        var question_id = jQuery('#question_id').val();
        var url = '/questions';
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var question = '<tr id="question' + data.id + '"><td scope="row">' + data.id + '</td><td>' + data.question + '</td>';
                question += '<td>' + data.points + '</td>';
                question += '<td>' + data.category_id + '</td>';
                question += '<button type="button" class="btn btn-outline-success btn-sm" id="choicesView" data-id="'+ data.id +'">View Options</button>';
                question += '<td><button type="button" class="btn btn-outline-info btn-sm" id="examView" data-id="'+ data.id +'">view</button>';
                question += '<button type="button" class="btn btn-outline-secondary btn-sm" id="examEdit" data-id="'+ data.id +'">Edit</button>';
                question += '<button type="button" class="btn btn-outline-danger btn-sm" id="examDelete" data-id="'+ data.id +'">Delete</button></td>';
                
                if (state == "add") {
                    jQuery('#question-lists').append(question);
                } else {
                    jQuery("#question" + question_id).replaceWith(question);
                }
                jQuery('#questionForm').trigger("reset");
                jQuery('#QuestionModal').modal('hide')
            },
            error: function (data) {
                if (data.responseJSON.errors.question) {
                    jQuery("#question").addClass("is-invalid");  
                    jQuery("#question-error-message").text(data.responseJSON.errors.question); 
                }

                if (data.responseJSON.errors.points) {
                    jQuery("#points").addClass("is-invalid");  
                    jQuery("#points-error-message").text(data.responseJSON.errors.points); 
                }
                
                if (data.responseJSON.errors.category_id) {
                    jQuery("#category_id").addClass("is-invalid");  
                    jQuery("#category-error-message").text(data.responseJSON.errors.category_id);
                }
            }
        });
    });

    // Update
    $("#btn-update-question").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            question: jQuery('#question').val(),
            points: jQuery('#points').val(),
            category_id: jQuery('#category_id').val(),
        };
        var state = jQuery('#btn-update-question').val();
        var type = "PATCH";
        var question_id = jQuery('#question_id').val();
        var url = '/questions/'+question_id;
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var question = '<tr id="question' + data.id + '"><td scope="row">' + data.id + '</td><td>' + data.question + '</td>';
                question += '<td>' + data.points + '</td>';
                question += '<td>' + data.category_id + '</td>';
                question += '<button type="button" class="btn btn-outline-success btn-sm" id="choicesView" data-id="'+ data.id +'">View Options</button>';
                question += '<td><button type="button" class="btn btn-outline-info btn-sm" id="questionView" data-id="'+ data.id +'">view</button>';
                question += '<button type="button" class="btn btn-outline-secondary btn-sm" id="questionEdit" data-id="'+ data.id +'">Edit</button>';
                question += '<button type="button" class="btn btn-outline-danger btn-sm" id="questionDelete" data-id="'+ data.id +'">Delete</button></td>';
                if (state == "add") {
                    jQuery('#question-lists').append(question);
                } else {
                    jQuery("#question" + question_id).replaceWith(question);
                }
                jQuery('#questionForm').trigger("reset");
                jQuery('#QuestionModal').modal('hide')
            },
            error: function (data) {
                if (data.responseJSON.errors.question) {
                    jQuery("#question").addClass("is-invalid");  
                    jQuery("#question-error-message").text(data.responseJSON.errors.question); 
                }

                if (data.responseJSON.errors.points) {
                    jQuery("#points").addClass("is-invalid");  
                    jQuery("#points-error-message").text(data.responseJSON.errors.points); 
                }
                
                if (data.responseJSON.errors.category_id) {
                    jQuery("#category_id").addClass("is-invalid");  
                    jQuery("#category-error-message").text(data.responseJSON.errors.category_id);
                }
                
            }
        });
    });

    // Delete
    $("#btn-delete-question").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            question: jQuery('#question').val(),
            points: jQuery('#points').val(),
            category_id: jQuery('#category_id').val(),
        };
        var type = "DELETE";
        var question_id = jQuery('#question_id').val();
        var url = '/questions/'+question_id;
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                jQuery("#question" + question_id).remove();

                jQuery('#questionForm').trigger("reset");
                jQuery('#deleteQuestion').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // remove error message
    $( "#question" ).keydown(function () {
        jQuery("#question").removeClass("is-invalid");  
        jQuery("#question-error-message").text(); 
    });

    $( "#points" ).keydown(function () {
        jQuery("#points").removeClass("is-invalid");  
        jQuery("#points-error-message").text(); 
    });

    $( "#category_id" ).keydown(function () {
        jQuery("#category_id").removeClass("is-invalid");  
        jQuery("#category-error-message").text(); 
    });

    // edit exam
    $(document).on( "click" ,"#questionEdit", function() {
        axios.get('/questions/'+$(this).data("id")).then(({data}) => (
            jQuery("#question").removeClass("is-invalid"),
            jQuery("#question-error-message").text(),
            jQuery("#points").removeClass("is-invalid"),
            jQuery("#points-error-message").text(),
            jQuery("#category_id").removeClass("is-invalid"),
            jQuery("#category-error-message").text(),
            jQuery('#questionForm').trigger("reset"),
            jQuery('#QuestionModal').modal('show'),
            $("#new-question").hide(),
            $("#update-question").show(),
            $("#btn-save-question").hide(),
            $("#btn-update-question").show(),

            jQuery('#question_id').val(data.id),
            jQuery("#question").val(data.question),
            jQuery("#points").val(data.points),
            jQuery("#cateogry_id").val(data.cateogry_id)
        ));
    });

    // delete exam
    $(document).on( "click" ,"#questionDelete", function() {
        axios.get('/questions/'+$(this).data("id")).then(({data}) => (
            jQuery('#question_id').val(data.id),
            jQuery('#deleteQuestion').modal('show'),
            jQuery("#question-delete").text("Are you sure you want to delete "+ data.question +"?")
        ));
    });

    // view exam
    $(document).on( "click" ,"#examView", function() {
        // console.log('Hit me');
        window.location.href ="/exam/"+$(this).data("id")+"/edit";
    });

});
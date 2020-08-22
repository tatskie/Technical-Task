jQuery(document).ready(function($){

    // View options
    $(document).on( "click" ,"#choicesView", function() {
    	axios.get('/question-options/'+$(this).data("id")).then(({data}) => (
    		jQuery("#editOption").css("display", "none"),
    		jQuery('#viewOptions').modal('show'),
    		jQuery('#option-lists').empty(),
    		$.each(data, function(index, value) {
    			// console.log(value.option)
    			var correctAnswer = "No";
    			if (value.is_correct) {
    				correctAnswer = "Yes";
    			}
    			var option = '<tr id="option' + value.id + '"><td scope="row">' + value.id + '</td><td>' + value.option + '</td>';
                option += '<td>' + correctAnswer + '</td>';
                option += '<td><button type="button" class="btn btn-outline-info btn-sm" id="EditOption" data-id="' + value.id + '">Edit</button></td></tr>';

                jQuery('#option-lists').append(option);
			})
        ));
    });

    // Edit Option
    $(document).on( "click" ,"#EditOption", function() {
        // console.log($(this).data("id"));
        axios.get('/options/'+$(this).data("id")).then(({data}) => (
        	jQuery("#editOption").css("display", "block"),
        	jQuery("#option").removeClass("is-invalid"),
            jQuery("#option-error-message").text(),
            jQuery("#option").val(data.option),
            jQuery("#option_id").val(data.id),
            data.is_correct == true ? jQuery("#is_correct").val("1") : jQuery("#is_correct").val("0"),
            data.is_correct == true ? jQuery("#is_correct").prop("checked", true) : jQuery("#is_correct").prop("checked", false)
        	// console.log(data.is_correct == true ? "Yes" : "No")
        ));
    });

    // Edit Option
    $(document).on( "click" ,"#CancelOption", function() {
        // console.log($(this).data("id"));
        jQuery("#editOption").css("display", "none");
    });

    // Checkbox
    $(document).on( "click" ,"#is_correct", function() {
        $('#is_correct').change(function() {
	        $('#is_correct').val(this.checked);   
	        console.log($('#is_correct').val());     
	    });    
    });

    // Update Option
    $("#UpdateOption").click(function (e) {
        // console.log('imworking');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            option: jQuery('#option').val(),
            is_correct: jQuery('#is_correct').is(":checked") ? 1:0,
        };
        var state = jQuery('#btn-update-question').val();
        var type = "PATCH";
        var option_id = jQuery('#option_id').val();
        var url = '/options/'+option_id;
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
            	// console.log(jQuery('#is_correct').val());
            	var correctAnswer = "No";
    			if (data.is_correct == 1) {
    				correctAnswer = "Yes";
    			}
                var option = '<tr id="option' + data.id + '"><td scope="row">' + data.id + '</td><td>' + data.option + '</td>';
                option += '<td>' + correctAnswer + '</td>';
                option += '<td><button type="button" class="btn btn-outline-info btn-sm" id="EditOption" data-id="' + data.id + '">Edit</button></td></tr>';

                jQuery("#option" + option_id).replaceWith(option);

                jQuery("#editOption").css("display", "none");
                jQuery('#optionForm').trigger("reset");	
            },
            error: function (data) {
                if (data.responseJSON.errors.option) {
                    jQuery("#option").addClass("is-invalid");  
                    jQuery("#option-error-message").text(data.responseJSON.errors.option); 
                }
            }
        });
    });
});
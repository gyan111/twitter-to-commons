$( document ).ready(function() {
	$("#mass_message_form").validate();
	$( "body" ).on( "click", "#post_mass_message_button", function(event) {
		event.preventDefault();
		if ($("#mass_message_form").valid()) {
		
			if (!$('#overlay').length) {
	            $('body').append('<div id="overlay"> </div>')
	        }
			$.ajax({
			  type:"POST",
			  data: $('#mass_message_form').serialize()
			}).done(function(data) {
			  if (typeof(data) == 'object') {
				$( "#overlay" ).fadeOut( "slow", function() {
				    $(this).remove();
				    if(data.error === true) {
				    	swal("Error!", data.message, "error");
				    } else {
				    	swal("Done!", data.message, "success");
				    }
				});
			  }
			});
		}
	});
});
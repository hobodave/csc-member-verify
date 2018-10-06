(function( $ ) {
	'use strict';
	$('#csc_member_verify .spinner').hide();

	$('#csc_member_verify_form').submit(function(event) {
		event.preventDefault();
		$('#csc_notice_bar').hide();
		$('#csc_member_verify .spinner').show();

		var ajax_form_data = $('#csc_member_verify_form').serialize();
		ajax_form_data = ajax_form_data + '&ajaxrequest=true&submit=Verify';

		$.ajax({
			url: params.ajaxurl,
			type: 'post',
			data: ajax_form_data
		})
		.done(function(response) {
			$('#csc_notice_bar').html('<div class="notification success"><div class="icon">Success: results below</div></div>');
			$('#csc_form_response').html('<h2>Results</h2><br>' + response);
		})
		.fail(function() {
			$('#csc_notice_bar').html('<div class="notification error"><div class="icon">Something went wrong.</div></div>');
		})
		.always(function() {
			event.target.reset();
			$('#csc_member_verify .spinner').hide();
		});
	});

})( jQuery );

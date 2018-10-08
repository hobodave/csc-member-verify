(function( $ ) {
	'use strict';
	console.log('Loading: csc-member-verify-public.js');
	$(document).ready(function() {
		$('#csc_member_verify .spinner').removeClass('is-active');

		$('#csc_member_verify_form').submit(function(event) {
			event.preventDefault();
			console.log('CSC-MV: Submitting form');
			$('#csc_notice_bar').hide();
			$('#csc_member_verify .spinner').addClass('is-active');;

			var ajax_form_data = $('#csc_member_verify_form').serialize();
			ajax_form_data = ajax_form_data + '&ajaxrequest=true&submit=Verify';

			$.ajax({
				url: params.ajaxurl,
				type: 'post',
				data: ajax_form_data
			})
			.done(function(response) {
				console.log('CSC-MV: Done');
				console.log(response);
				$('#csc_notice_bar').html('<div class="notification success"><div class="icon">Success: results below</div></div>');
				$('#csc_notice_bar').show();
				$('#csc_form_response textarea').val(response);
			})
			.fail(function() {
				console.log('CSC-MV: Error');
				$('#csc_notice_bar').html('<div class="notification error"><div class="icon">Something went wrong.</div></div>');
				$('#csc_notice_bar').show();
			})
			.always(function() {
				console.log('CSC-MV: Resetting');
				event.target.reset();
				$('#csc_member_verify .spinner').removeClass('is-active');;
			});
		});
	});
})( jQuery );

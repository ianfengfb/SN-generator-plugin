(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).on('click', '#serial_id_validator_btn', (e) => {
		e.preventDefault();
		var sn_tobe_active = $('#serial_id_validator_sn').val();
		var data = ({
			'action': 'sn_check_sn_exist',
			'sn_tobe_check': sn_tobe_active,
		});
		$.post(the_ajax_script.ajaxurl, data, (resp) => {
			console.log('click');
			console.log(resp);
			if (resp == 1) {
				$('#serial_id_validator_message').html('Serial Number validated successfull!');
				setTimeout(function () {
					location.reload();
				}, 1000);
			} else {
				$('#serial_id_validator_message').html('Serial Number validated failed!');
			}

		});
	});

})(jQuery);

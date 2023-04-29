(function( $ ) {
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

	// Add custom field
	$(document).ready(function() {
		// Add custom field


		var counter = 0;
		$(document).on('click', '.add-custom-field', function(e) {
			e.preventDefault();
			counter++;
			var custom_field = $('<div class="custom-field"></div>').html(
				'<h5>Field #' + counter + '</h5>' +
				'<input type="text" class="field-label" name="_custom_fields[' + counter + '][label]" value="" placeholder="Label">' +
				'<textarea class="field-content" name="_custom_fields[' + counter + '][content]" placeholder="Write your content"></textarea>' +
				'<button class="remove-custom-field button">Remove</button>'
			);
		  $('#custom-fields').append(custom_field);
		});
	  
		// Remove custom field
		$(document).on('click', '.remove-custom-field', function(e) {
		  e.preventDefault();
		  $(this).parent().remove();
		});
	  });
	  


})( jQuery );

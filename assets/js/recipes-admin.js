jQuery( document ).ready( function() {

	jQuery( '.ingredients-repeater' ).repeater({
		defaultValues: {
			'quantity': '',
			'ingredient': ''
		},
		show: function() {
			jQuery( this ).slideDown();
		},
		hide: function( deleteElement ) {
			jQuery( this ).slideUp( deleteElement );
		},
		isFirstItemUndeletable: true
	});
});

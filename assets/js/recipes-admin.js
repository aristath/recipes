jQuery( document ).ready( function() {

	jQuery( '.ingredients-repeater' ).repeater({
		defaultValues: {
			'text-input': ''
		},
		show: function() {
			jQuery( this ).slideDown();
		},
		hide: function( deleteElement ) {
			if( confirm( 'Are you sure you want to delete this element?' ) ) {
				jQuery( this ).slideUp( deleteElement );
			}
		},
		isFirstItemUndeletable: true
	});
});

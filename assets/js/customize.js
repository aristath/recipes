// Add a warning message for the custom entry in the intro-style setting.
wp.customize( 'recipes_intro_style', function( setting ) {
	setting.bind( function( value ) {
		var code = 'recipes_intro_style_custom';
		if ( 'custom' === value ) {
			setting.notifications.add( code, new wp.customize.Notification(
				code,
                {
                    type: 'warning',
                    message: '"Custom" mode removes all styles and allows you to add your own custom CSS for the ".recipe-intro" element.'
                }
            ) );
        } else {
            setting.notifications.remove( code );
        }
    } );
} );

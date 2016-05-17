<div id="recipe-ingredients" class="recipe-ingredients-list">
	<div class="ingredients">
		<# _.each( data.value, function( ingredient ) { #>
			<div class="ingredient">
				<input type="text" name="ingredients[]" value="{{ ingredient }}"/>
				<span class="recipe-remove-ingredient dashicons dashicons-dismiss"><span class="screen-reader-text">{{ data.l10n.delete }}</span></span>
			</div>
		<# }); #>
	</div>
	<a class="button add-ingredient button-primary">{{ data.l10n.add }}</a>
</div>
<#
jQuery( document ).ready( function() {
	jQuery( '.add-ingredient' ).click( function() {
		jQuery( '#recipe-ingredients .ingredients' ).append( '<div class="ingredient"><input type="text" name="ingredients[]" value=""/><span class="recipe-remove-ingredient dashicons dashicons-dismiss"><span class="screen-reader-text">' + data.l10n.delete + '</span></span></div>' );
	});
	jQuery( '.recipe-remove-ingredient' ).click( function() {
		jQuery( this ).prev( 'input.ingredient' ).remove();
		jQuery( this ).remove();
	});
});
#>

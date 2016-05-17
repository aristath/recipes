<div class="ingredients-description">{{ data.l10n.description }}</div>
<div id="recipe-ingredients" class="recipe-ingredients-list">
	<div class="ingredients">
		<# _.each( data.value, function( ingredient ) { #>
			<input type="text" name="ingredients[]" value="{{ ingredient }}"/>
		<# }); #>
	</div>
	<a class="button add-ingredient button-primary">{{ data.l10n.add }}</a>
</div>
<#
jQuery( document ).ready( function() {
	jQuery( '.add-ingredient' ).click( function() {
		jQuery( '#recipe-ingredients .ingredients' ).append( '<input type="text" name="ingredients[]" value=""/>');
	});
});
#>

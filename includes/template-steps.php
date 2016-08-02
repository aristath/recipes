<div class="steps-description">{{ data.l10n.description }}</div>

<div id="recipe-steps" class="recipe-steps-list">

	<div class="steps">
		<# _.each( data.value, function( step ) { #>
			<textarea rows="4" name="steps[]">{{ step }}</textarea>
		<# }); #>
	</div>

	<a class="button add-step button-primary">{{ data.l10n.add }}</a>

</div>

<#
jQuery( document ).ready( function() {
	jQuery( '.add-step' ).click( function() {
		jQuery( '#recipe-steps .steps' ).append( '<textarea rows="4" name="steps[]"></textarea>');
	});
});
#>

<div class="recipes general-info fields-wrapper">
	<div class="recipes servings-wrapper">
		<label for="servings_field">{{ data.l10n.servings }}</label>
		<input type="number" id="servings_field" name="servings_field" value="{{ data.value.servings }}" size="25" />
	</div>
	<div class="recipes preparation_time_wrapper">
		<label for="preparation_time">{{ data.l10n.prepTime }}</label>
		<input type="number" id="preparation_time" name="preparation_time" value="{{ data.value.preparation_time }}" size="25" />
	</div>
	<div class="recipes cook_time_wrapper">
		<label for="cook_time">{{ data.l10n.cookTime }}</label>
		<input type="number" id="cook_time" name="cook_time" value="{{ data.value.cook_time }}" size="25" />
	</div>
	<div class="recipes description_wrapper">
		<label for="description">{{ data.l10n.description }}</label>
		<textarea id="description" name="description">{{ data.value.description }}</textarea>
	</div>
</div>
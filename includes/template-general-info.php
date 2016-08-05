<p>{{ data.l10n.label }}</p>
<div class="recipes general-info fields-wrapper">

	<div class="recipes servings-wrapper">
		<label for="servings_field">
			<span class="dashicons dashicons-groups"></span>
			{{ data.l10n.servings }}
		</label>
		<input type="number" id="servings_field" name="servings_field" value="{{ data.value.servings }}" size="25" />
	</div>

	<div class="recipes prep-time-wrapper">
		<label for="prep_time">
			<span class="dashicons dashicons-clock"></span>
			{{ data.l10n.prepTime }}
		</label>
		<input type="number" id="prep_time" name="prep_time" value="{{ data.value.prep_time }}" size="25" />
	</div>

	<div class="recipes cook-time-wrapper">
		<label for="cook_time">
			<span class="dashicons dashicons-clock"></span>
			{{ data.l10n.cookTime }}
		</label>
		<input type="number" id="cook_time" name="cook_time" value="{{ data.value.cook_time }}" size="25" />
	</div>

	<div class="recipes description-wrapper">
		<label for="description">
			<span class="dashicons dashicons-lightbulb"></span>
			{{ data.l10n.description }}
		</label>
		<textarea id="description" name="description">{{ data.value.description }}</textarea>
	</div>

</div>

<div class="recipes general-info fields-wrapper">
	<div class="recipes servings-wrapper">
		<label for="servings_field"><?php _e( 'Servings', 'recipes' ); ?></label>
		<input type="number" id="servings_field" name="servings_field" value="<?php echo absint( $servings ); ?>" size="25" />
	</div>
	<div class="recipes preparation_time_wrapper">
		<label for="preparation_time"><?php _e( 'Preparation Time (minutes)', 'recipes' ); ?></label>
		<input type="number" id="preparation_time" name="preparation_time" value="<?php echo absint( $preparation_time ); ?>" size="25" />
	</div>
	<div class="recipes cook_time_wrapper">
		<label for="cook_time"><?php _e( 'Cook Time (minutes)', 'recipes' ); ?></label>
		<input type="number" id="cook_time" name="cook_time" value="<?php echo absint( $cook_time ); ?>" size="25" />
	</div>
	<div class="recipes description_wrapper">
		<label for="description"><?php esc_attr_e( 'Description', 'recipes' ); ?></label>
		<textarea id="description" name="description"><?php echo esc_textarea( $description ); ?></textarea>
	</div>
</div>

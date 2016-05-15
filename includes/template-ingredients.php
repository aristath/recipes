<div class="ingredients-repeater">
	<table>
		<thead>
			<tr>
				<td class="ingredient"><?php esc_attr_e( 'Ingredient', 'recipes' ); ?></td>
				<td class="remove"></td>
			</tr>
		</thead>
		<tbody data-repeater-list="ingredients">
			<?php foreach ( $ingredients as $key => $ingredient ) : ?>
				<tr data-repeater-item>
					<td class="ingredient">
						<input type="text" name="ingredient" value="<?php echo esc_attr( $ingredient['ingredient'] ); ?>"/>
					</td>
					<td class="remove">
						<span class="recipe-remove-ingredient dashicons dashicons-dismiss" data-repeater-delete>
							<span class="screen-reader-text"><?php esc_attr_e( 'Delete', 'recipes' ); ?></span>
						</span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<input data-repeater-create class="button button-primary" type="button" value="Add"/>
</div>

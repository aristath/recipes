<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_556fa6672a049',
	'title' => 'Recipe - General Info',
	'fields' => array (
		array (
			'key' => 'field_556fa7e0bb054',
			'label' => 'Servings',
			'name' => 'servings',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.3',
				'class' => '',
				'id' => '',
			),
			'default_value' => 2,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 20,
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_556fa81dbb055',
			'label' => 'Preparation time',
			'name' => 'preparation_time',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.3',
				'class' => '',
				'id' => '',
			),
			'default_value' => 15,
			'placeholder' => '',
			'prepend' => '',
			'append' => 'minutes',
			'min' => 0,
			'max' => '',
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_556fa87dbb056',
			'label' => 'Cook Time',
			'name' => 'cook_time',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33.3',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'minutes',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'recipe',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_556fa7f1ebee1',
	'title' => 'Ingredients',
	'fields' => array (
		array (
			'key' => 'field_556fa91b8748b',
			'label' => 'Ingredients',
			'name' => 'ingredients',
			'type' => 'repeater',
			'instructions' => 'Add the ingredients the recipe requires along with their quantities',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_556fa9428748c',
					'label' => 'Quantity',
					'name' => 'quantity',
					'type' => 'number',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 1,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => 1,
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_556fa96d8748d',
					'label' => 'Unit',
					'name' => 'unit',
					'type' => 'select',
					'instructions' => 'Select the measurement unit for this quantity',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'teaspoon' => 'teaspoon',
						'tablespoon' => 'tablespoon',
						'cup' => 'cup',
						'us-gal' => 'gallon (US)',
						'us-quart' => 'quart (US)',
						'us-pint' => 'pint (US)',
						'us-oz' => 'ounce (US)',
						'imp-gal' => 'gallon (Imperial/UK)',
						'imp-quart' => 'quart (Imperial/UK)',
						'imp-pint' => 'pint (Imperial/UK)',
						'imp-oz' => 'ounce (Imperial/UK)',
						'ml' => 'ml',
						'lt' => 'lt',
						'pound' => 'pound',
						'ounce' => 'ounce',
						'gr' => 'gram',
						'kg' => 'kg',
						'mm' => 'mm',
						'cm' => 'cm',
						'm' => 'm',
						'inch' => 'inch',
					),
					'default_value' => array (
						'' => '',
					),
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
				),
				array (
					'key' => 'field_556faa618748e',
					'label' => 'Ingredient',
					'name' => 'ingredient',
					'type' => 'taxonomy',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'taxonomy' => 'ingredient',
					'field_type' => 'select',
					'allow_null' => 0,
					'add_term' => 1,
					'load_save_terms' => 1,
					'return_format' => 'object',
					'multiple' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'recipe',
			),
		),
	),
	'menu_order' => 10,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;

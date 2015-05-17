<?php

if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group( array(
    	'key'    => 'group_55555a1530f8c',
    	'title'  => 'Recipe details',
    	'fields' => array(
    		array(
    			'key'               => 'field_55555a2369fe5',
    			'label'             => __( 'Servings', 'maera-recipes' ),
    			'name'              => 'servings',
    			'type'              => 'number',
    			'instructions'      => __( 'How many servings? (default: 2)', 'maera-recipes' ),
    			'required'          => 1,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => 25,
    				'class' => '',
    				'id'    => '',
    			),
    			'default_value' => 2,
    			'placeholder'   => '',
    			'prepend'       => '',
    			'append'        => 'servings',
    			'min'           => 1,
    			'max'           => '',
    			'step'          => 1,
    			'readonly'      => 0,
    			'disabled'      => 0,
    		),
    		array(
    			'key'               => 'field_55555a6769fe6',
    			'label'             => __( 'Calories', 'maera-recipes' ),
    			'name'              => 'calories',
    			'type'              => 'number',
    			'instructions'      => __( 'Nutritional value', 'maera-recipes' ),
    			'required'          => 0,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => 25,
    				'class' => '',
    				'id'    => '',
    			),
    			'default_value' => '',
    			'placeholder'   => '',
    			'prepend'       => '',
    			'append'        => 'Kcal',
    			'min'           => '',
    			'max'           => '',
    			'step'          => '',
    			'readonly'      => 0,
    			'disabled'      => 0,
    		),
    		array(
    			'key'               => 'field_5555621a6cbbf',
    			'label'             => __( 'Preparation time', 'maera-recipes' ),
    			'name'              => 'prep_time',
    			'type'              => 'number',
    			'instructions'      => __( 'Preparation time', 'maera-recipes' ),
    			'required'          => 0,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => 25,
    				'class' => '',
    				'id'    => '',
    			),
    			'default_value' => '',
    			'placeholder'   => '',
    			'prepend'       => '',
    			'append'        => 'minutes',
    			'min'           => '',
    			'max'           => '',
    			'step'          => 1,
    			'readonly'      => 0,
    			'disabled'      => 0,
    		),
    		array(
    			'key'               => 'field_5557ddda4a367',
    			'label'             => __( 'Cook Time', 'maera-recipes' ),
    			'name'              => 'cook_time',
    			'type'              => 'number',
    			'instructions'      => __( 'Cooking time', 'maera-recipes' ),
    			'required'          => 0,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => 25,
    				'class' => '',
    				'id'    => '',
    			),
    			'default_value' => '',
    			'placeholder'   => '',
    			'prepend'       => '',
    			'append'        => 'minutes',
    			'min'           => '',
    			'max'           => '',
    			'step'          => 1,
    			'readonly'      => 0,
    			'disabled'      => 0,
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param'    => 'post_type',
    				'operator' => '==',
    				'value'    => 'recipe',
    			),
    		),
    	),
    	'menu_order'            => 10,
    	'position'              => 'acf_after_title',
    	'style'                 => 'seamless',
    	'label_placement'       => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen'        => '',
    ) );

    acf_add_local_field_group( array(
    	'key'    => 'group_55555319558f3',
    	'title'  => 'Recipe Ingredients',
    	'fields' => array(
    		array(
    			'key'               => 'field_555554369c304',
    			'label'             => __( 'Ingredients', 'maera-recipes' ),
    			'name'              => 'ingredients',
    			'type'              => 'repeater',
    			'instructions'      => __( 'Add the ingredients the recipe requires along with their quantities', 'maera-recipes' ),
    			'required'          => 1,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => 100,
    				'class' => '',
    				'id'    => '',
    			),
    			'min'          => 1,
    			'max'          => '',
    			'layout'       => 'table',
    			'button_label' => 'Add Ingredient',
    			'sub_fields'   => array(
    				array(
    					'key'               => 'field_55578786df56d',
    					'label'             => 'Quantity',
    					'name'              => 'quantity',
    					'type'              => 'text',
    					'instructions'      => __( 'Please select the quantity of the ingredient. Enter only the value, not the unit. You can select the units next from the dropdown.', 'maera-recipes' ),
    					'required'          => 1,
    					'conditional_logic' => 0,
    					'wrapper'           => array(
    						'width' => 30,
    						'class' => '',
    						'id'    => '',
    					),
    					'default_value' => 1,
    					'placeholder'   => '',
    					'prepend'       => '',
    					'append'        => '',
    					'maxlength'     => '',
    					'readonly'      => 0,
    					'disabled'      => 0,
    				),
    				array(
    					'key'               => 'field_5557897305b35',
    					'label'             => __( 'Unit', 'maera-recipes' ),
    					'name'              => 'unit',
    					'type'              => 'select',
    					'instructions'      => __( 'Select the unit for this quantity', 'maera-recipes' ),
    					'required'          => 0,
    					'conditional_logic' => 0,
    					'wrapper'           => array(
    						'width' => 20,
    						'class' => '',
    						'id'    => '',
    					),
    					'choices' => array(
                            ''           => '',
                            'teaspoon'   => __( 'teaspoon', 'maera-recipes' ),
                            'tablespoon' => __( 'tablespoon', 'maera-recipes' ),
                            'cup'        => __( 'cup', 'maera-recipes' ),
                            'us-gal'     => __( 'gallon (US)', 'maera-recipes' ),
                            'us-quart'   => __( 'quart (US)', 'maera-recipes' ),
                            'us-pint'    => __( 'pint (US)', 'maera-recipes' ),
                            'us-oz'      => __( 'ounce (US)', 'maera-recipes' ),
                            'imp-gal'    => __( 'gallon (Imperial/UK)', 'maera-recipes' ),
                            'imp-quart'  => __( 'quart (Imperial/UK)', 'maera-recipes' ),
                            'imp-pint'   => __( 'pint (Imperial/UK)', 'maera-recipes' ),
                            'imp-oz'     => __( 'ounce (Imperial/UK)', 'maera-recipes' ),
                            'ml'         => __( 'ml', 'maera-recipes' ),
                            'lt'         => __( 'lt', 'maera-recipes' ),
                            'pound'      => __( 'pound', 'maera-recipes' ),
                            'ounce'      => __( 'ounce', 'maera-recipes' ),
                            'gr'         => __( 'gram', 'maera-recipes' ),
                            'kg'         => __( 'kg', 'maera-recipes' ),
                            'mm'         => __( 'mm', 'maera-recipes' ),
                            'cm'         => __( 'cm', 'maera-recipes' ),
                            'm'          => __( 'm', 'maera-recipes' ),
                            'inch'       => __( 'inch', 'maera-recipes' ),
    					),
    					'default_value' => array(
    						''        => '',
    					),
    					'allow_null'  => 0,
    					'multiple'    => 0,
    					'ui'          => 0,
    					'ajax'        => 0,
    					'placeholder' => '',
    					'disabled'    => 0,
    					'readonly'    => 0,
    				),
    				array(
    					'key'               => 'field_555554af9c306',
    					'label'             => __( 'Ingredient', 'maera-recipes' ),
    					'name'              => 'ingredient',
    					'type'              => 'taxonomy',
    					'instructions'      => __( 'Please enter the ingredient', 'maera-recipes' ),
    					'required'          => 1,
    					'conditional_logic' => 0,
    					'wrapper'           => array(
    						'width' => 50,
    						'class' => '',
    						'id'    => '',
    					),
    					'taxonomy'        => 'ingredient',
    					'field_type'      => 'select',
    					'allow_null'      => 0,
    					'add_term'        => 1,
    					'load_save_terms' => 1,
    					'return_format'   => 'id',
    					'multiple'        => 0,
    				),
    			),
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param'    => 'post_type',
    				'operator' => '==',
    				'value'    => 'recipe',
    			),
    		),
    	),
    	'menu_order'            => 20,
    	'position'              => 'acf_after_title',
    	'style'                 => 'seamless',
    	'label_placement'       => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen'        => '',
    ) );

    acf_add_local_field_group( array(
    	'key'    => 'group_55555ce88f23e',
    	'title'  => 'Videos',
    	'fields' => array(
    		array(
    			'key'               => 'field_55555ced24348',
    			'label'             => __( 'Videos', 'maera-recipes' ),
    			'name'              => 'videos',
    			'type'              => 'repeater',
    			'instructions'      => __( 'Have videos? Awesome! Just add them below.', 'maera-recipes' ),
    			'required'          => 0,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => '',
    				'class' => '',
    				'id'    => '',
    			),
    			'min'          => '',
    			'max'          => '',
    			'layout'       => 'row',
    			'button_label' => 'Add Video',
    			'sub_fields'   => array(
    				array(
    					'key'               => 'field_55555d2c24349',
    					'label'             => __( 'Video', 'maera-recipes' ),
    					'name'              => 'video',
    					'type'              => 'oembed',
    					'instructions'      => '',
    					'required'          => 0,
    					'conditional_logic' => 0,
    					'wrapper'           => array(
    						'width' => '',
    						'class' => '',
    						'id'    => '',
    					),
    					'width'  => '',
    					'height' => '',
    				),
    			),
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param'    => 'post_type',
    				'operator' => '==',
    				'value'    => 'recipe',
    			),
    		),
    	),
    	'menu_order'            => 20,
    	'position'              => 'normal',
    	'style'                 => 'seamless',
    	'label_placement'       => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen'        => '',
    ));

    acf_add_local_field_group( array(
    	'key'    => 'group_55555558956b1',
    	'title'  => 'Recipe Photos',
    	'fields' => array(
    		array(
    			'key'               => 'field_5555555f69227',
    			'label'             => __( 'Gallery', 'maera-recipes' ),
    			'name'              => 'gallery',
    			'type'              => 'gallery',
    			'instructions'      => __( 'Please add photos to accompany this recipe', 'maera-recipes' ),
    			'required'          => 0,
    			'conditional_logic' => 0,
    			'wrapper'           => array(
    				'width' => '',
    				'class' => '',
    				'id'    => '',
    			),
    			'min'          => '',
    			'max'          => '',
    			'preview_size' => 'thumbnail',
    			'library'      => 'uploadedTo',
    			'min_width'    => '',
    			'min_height'   => '',
    			'min_size'     => '',
    			'max_width'    => '',
    			'max_height'   => '',
    			'max_size'     => '',
    			'mime_types'   => '',
    		),
    	),
    	'location' => array(
    		array(
    			array(
    				'param'    => 'post_type',
    				'operator' => '==',
    				'value'    => 'recipe',
    			),
    		),
    	),
    	'menu_order'            => 40,
    	'position'              => 'normal',
    	'style'                 => 'seamless',
    	'label_placement'       => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen'        => '',
    ) );

}

add_filter( 'acf/validate_value/name=validate_this_image', 'my_acf_validate_value', 10, 4);

function my_acf_validate_value( $valid, $value, $field, $input ){

	// bail early if value is already invalid
	if( !$valid ) {

		return $valid;

	}


	// load image data
	$data = wp_get_attachment_image_src( $value, 'full' );
	$width = $data[1];
	$height = $data[2];

	if( $width < 960 ) {

		$valid = 'Image must be at least 960px wide';

	}


	// return
	return $valid;


}

<?php if ( have_rows( 'ingredients' ) ) : ?>
    <ul class="recipe-ingredients">
        <?php while ( have_rows( 'ingredients' ) ) : the_row(); ?>
            <?php
                $unit       = Recipes::units( Recipes::convert_units( get_sub_field( 'quantity' ), get_sub_field( 'unit' ), 'unit' ) );
                $ingredient = get_sub_field( 'ingredient' );
                $value      = Recipes::convert_units( get_sub_field( 'quantity' ), get_sub_field( 'unit' ), 'value' );
            ?>
            <li>
                <a class="ingredient" href="<?php echo get_term_link( $ingredient ); ?>"><span itemprop="ingredients"><?php echo $ingredient->name; ?></span></a>:
                <span class="quantity"><?php echo $value; ?> <span class="unit"><?php echo $unit; ?></span></span>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>

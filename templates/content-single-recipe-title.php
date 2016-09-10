<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
<?php if ( (bool) get_theme_mod( 'recipes_show_featured_image', true ) && has_post_thumbnail() ) : ?>
	<?php the_post_thumbnail(); ?>
<?php endif; ?>

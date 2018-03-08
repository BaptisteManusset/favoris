
<?php global $wp_query;
if ( $wp_query->max_num_pages > 1 ) { ?>
	<nav class="nav_below navigation" role="navigation">
		<div class="nav_previous"><?php next_posts_link( 'Précédente' ) ?></div>
		<div class="nav_next"><?php previous_posts_link( 'Suivante' ) ?></div>
	</nav>
<?php } ?>

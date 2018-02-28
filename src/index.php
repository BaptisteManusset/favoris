<?php get_header(); ?>
	<div class="row">
		<div class="col">
			<div class="fav_container ">
					<?php query_posts( 'showposts=30' );
					if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/entry' ); ?>
						<?php //comments_template(); ?>
					<?php endwhile; endif; ?>
					<?php get_template_part( 'template-parts/nav', 'below' ); ?>
			</div>
		</div>
	</div>


	<!--// New Post Form -->
<?php get_template_part( 'template-parts/form', 'post' ); ?>
	<!--// New Post Form -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
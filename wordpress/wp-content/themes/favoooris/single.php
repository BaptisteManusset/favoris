<?php get_header(); ?>
	<section id="content" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php if ( get_post_status() != "private" || current_user_can("administrator") ): ?>
				<?php get_template_part( "template-parts/entry", "single" ) ?>
			<?php endif; ?>
		<?php endwhile; endif; ?>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
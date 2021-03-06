<?php get_header(); ?>
<section id="content" role="main">
<header class="header">
<h1 class="entry-title"><?php _e( 'Tag Archives: ', 'favoooris' ); ?><?php single_tag_title(); ?></h1>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'template-parts/entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'template-parts/nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
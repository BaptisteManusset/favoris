<?php get_header(); ?>
	<section id="content" role="main" class="error_container">
		<article id="post-0" class="post not-found">
			<header class="header">
				<h1 class="entry-title error_title">Not Found</h1>
			</header>
			<section class="entry-content gutter">
				<p>Vous etes perdu ? essayez plutôt de revenir a la
					<a href="<?php echo bloginfo( "url" ); ?>">page d'accueil</a>
				</p>
			</section>
		</article>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
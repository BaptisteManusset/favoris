<?php if ( isset( $_GET["paged"] ) ) {

	get_template_part( "index" );

	return true;
} ?>

<?php get_header(); ?>
	<div class="row home_presentation">
		<div class="col">
			<div class="gutter">
				<div class="row">
					<div class="col2 description">
						<h2 class="subline big">Tu veux partager tes sites préférés <br> avec tout le monde?</h2>
						<p><b><?php bloginfo() ?></b>, est une plateforme qui a pour but de réunir des sites utiles dans
						                             pleins
						                             de domaines, allant du graphisme, en passant par le dev, et la
						                             communication !
						</p>
						<p>Bientôt vous pourrez proposer vos propres favoris pour qu'ils soient ajoutés au site 😃 </p>
					</div>
					<div class="col home_image">
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.svg" alt="logo">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="gutter">
				<h2>les derniers ajouts !</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="fav_container ">
				<?php query_posts( 'showposts=10' );
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/entry' ); ?>
					<?php //comments_template(); ?>
				<?php endwhile; endif; ?>
<!--				--><?php //get_template_part( 'template-parts/nav', 'below' ); ?>
			</div>
		</div>
	</div>
<?php get_template_part( 'template-parts/form', 'post' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
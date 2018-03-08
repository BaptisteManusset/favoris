<?php get_header(); ?>
	<section id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="header">
				<h1 class="entry-title">
					<?php
					echo "Recherche pour :";
					$query_is_fill = ! empty( get_search_query() );
					if ( $query_is_fill ) {
						echo "<span class='search_query'>" . get_search_query() . "</span> ";
					}
					if ( isset( $_GET["cat"] ) == true ) {
						if ( $query_is_fill ) {
							echo " & ";
						}
						$categories = $_GET["cat"];
						$len        = count( $categories );
						$i          = 0;

						$list_category = "";
						foreach ( $categories as $category ) {
							$category_name = get_the_category_by_ID( $category );
							$list_category .= $category_name;
							if ( $i < $len - 1 ) {
								$list_category .= " , ";
							}
							$i ++;
							$category = get_category( $category );
							get_faaav_tag( $category, true );
						}
					} ?>
				</h1>
			</header>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/entry' ); ?>
			<?php endwhile; ?>
			<?php get_template_part( 'template-parts/nav', 'below' ); ?>
		<?php else : ?>
			<article id="post-0" class="post no-results not-found">
				<h2 class="entry-title">Il n'y a rien ici :'(</h2>
				<section class="entry-content">
					<p>Essayez une autre demande</p>
				</section>
			</article>
		<?php endif; ?>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
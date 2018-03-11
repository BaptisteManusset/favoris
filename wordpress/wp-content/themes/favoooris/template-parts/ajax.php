<div class="modal_background  <?php echo get_post_class(); ?>" data-id="<?php the_ID(); ?>"
     id="modal-post-<?php the_ID(); ?>">
	<div class="modal_card">

		<div class="modal_content">
			<div class="modal_header">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/imgnotfound.svg"
					     alt="<?php the_title(); ?>">
				<?php endif; ?>
				<button class="modal_button_close">fermer</button>

			</div>
			<div class="modal_title">
				<h3><?php the_title(); ?></h3>

				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) :
					foreach ( $categories as $category ) {?>

						<a class="tag modal_tag" style="background: <?php echo get_field( "couleur", $category );; ?>;"
						   href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>">
							<?php echo $category->name; ?>
						</a>
						<?php
					} endif; ?>
			</div>
			<div class="modal_description">

				<p><?php the_content(); ?></p>
			</div>
			<div class="modal_footer">
				<?php $lien = get_field( "lien" ); ?>
				<a href="<?php echo $lien ?>" class="modal_permalink" rel="nofollow" target="_blank"><span class="text_reader">Lien du site</span>➥</a>
				<a href="<?php the_permalink(); ?>" class="modal_permalink">Page du favoris</a>
				<?php if ( is_admin() == true ): ?>
					<a href="<?php echo get_edit_post_link(); ?>" class="modal_edit" target="_blank"><span class="text_reader">modifier</span>✎</a>
				<?php endif; ?>

				<a href="https://twitter.com/intent/tweet/?url=<?php the_permalink(); ?>&text=<?php echo urlencode( "regardez ce superbe favoris !" ); ?>"
				   class="modal_partage">twitter</a>
			</div>
		</div>

	</div>
</div>


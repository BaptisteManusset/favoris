<div <?php echo post_class( 'fav_card' ); ?> data-id="<?php the_ID(); ?>" id="post-<?php the_ID(); ?>"
                                             style="border-color: <?php the_category_color(); ?>;">
	<div class="fav_grouper" style="border-color: <?php the_category_color(); ?>;">
		<div class="fav_zone_image">
			<a class="fav_image" href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/imgnotfound.svg"
					     alt="<?php the_title(); ?>">
				<?php endif; ?>
			</a>
		</div>
		<div class="fav_title">
			<h3><?php the_title(); ?></h3>
		</div>
		<div class="fav_content">
			<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) : ?>
				<a class="tag fav_tag" style="background: <?php the_category_color(); ?>;"
				   href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
					<?php echo $categories[0]->name; ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="fav_action">
			<?php $lien = get_field( "lien" ); ?>
			<a href="<?php echo $lien ?>" class="button fav_permalink" rel="nofollow" target="_blank"><span class="text_reader">Lien du site</span>➥</a>
			<button class="button fav_modal_trigger"><span class="text_reader">Voir plus</span>+</button>
		</div>
	</div>
</div>
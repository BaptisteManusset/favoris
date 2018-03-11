<?php $lien = get_fields(); ?>
<div <?php echo post_class( "solo" ); ?> data-id="<?php the_ID(); ?>" id="post-<?php the_ID(); ?>">
	<div class="solo_thumbnail">
		<?php the_post_thumbnail( "medium" ); ?>
	</div>
	<div style="border-color: <?php the_category_color(); ?>;">
		<div>
			<h3><?php the_title(); ?></h3>
			<?php $meta = get_post_meta( get_the_ID() );
			$lien       = $meta['lien']['0'];
			?>
			<a href="<?php echo $lien ?>" class="solo_lien" rel="nofollow" target="_blank"> lien du site ➥</a>
			<?php if ( current_user_can( 'administrator' ) == true ): ?>
				<a href="<?php echo get_edit_post_link(); ?>" class="modal_edit" target="_blank"><span class="text_reader">modifier</span>✎</a>
			<?php endif; ?>

		</div>

		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) : ?>
			<a style="background: <?php the_category_color(); ?>;"
			   href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>"
			   class="solo_tag">
				<?php echo $categories[0]->name; ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="solo_content">
		<?php the_content(); ?>

	</div>
</div>
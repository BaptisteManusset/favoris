<div id="modal_container">
	<!--zone ou se rajoute les modals-->
</div>
<footer class="footer_main">
	<div class="row">
		<div class="col">
			<h2>liste des catégories</h2>
			<ul class="category_list">
				<?php
				//for each category, show all posts
				$cat_args   = array(
					'orderby' => 'name',
					'order'   => 'ASC'
				);
				$categories = get_categories( $cat_args );
				foreach ( $categories as $category ) {
					if ( $category->slug != "non-classe" ):
						$couleur = get_field( 'couleur', $category->taxonomy . '_' . $category->term_id );
						?>
						<li>
							<a class="category_item" style="background: <?php echo $couleur ?>;" href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
						</li>
						<?php
					endif;
				}
				?></ul>
		</div>
		<div class="col info">
			<h2>Information</h2>
			<ul>
				<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
			</ul>
			<input type="checkbox" value="true" name="nightmode" id="nightmode" class="nightmode">
			<label for="nightmode">Mode Nuit</label>
		</div>
		<div class="col info">
			<h2>Site fait ☕ & ❤ par <a href="https://manusset.com/">Baptiste Manusset</a></h2>
			<p>Un problème, un bonne idée ? <a href="https://twitter.com/ItsBaptiste">mon twitter est ouvert :)</a></p>
			<a href="#top" class="button anchor_link footer_top">&#11014;</a>
		</div>
	</div>
</footer>


<?php wp_footer() ?>
</body>

</html>
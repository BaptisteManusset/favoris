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
							<a class="category_item" style="background: <?php echo $couleur ?>;"
							   href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
						</li>
						<?php
					endif;
				}
				?>
			</ul>
		</div>
		<div class="col info">
			<h2>Information</h2>
			<ul>
				<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
			</ul>

		</div>
		<div class="col info">
			<h2>Site par <a href="https://manusset.com/">Baptiste Manusset</a></h2>
			<input type="checkbox" value="true" name="nightmode" id="nightmode" class="nightmode">
			<label for="nightmode">Mode Nuit</label>
		</div>
	</div>
</footer>
<?php wp_footer() ?>
<script>
	jQuery('#submit').click(function (e) {
		jQuery.ajax({
			url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			type: 'POST',
			dataType: "json",
			data: {
				action: 'single_post',
				title: jQuery('#post_title').val(),
				cat: jQuery('#post_category').val(),
				thumbnail: jQuery('#post_thumbnail').val(),
				url: jQuery('#post_url').val(),
				isprivate: function () {
					if (jQuery('#post_private').is(':checked')) {
						return "private";
					}
					return "public";
				},
				content: jQuery('#post_content').val()
			},
			success: function (response) {
				alert('Ajout reussie !');
				jQuery("#post_insert input, #post_insert textarea").val("");
			}
		});
		return false;
	});
</script>
</body>

</html>
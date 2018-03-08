<div class="search_container" style="display: none">
	<form role="search" method="get" class="search_form" action="">
		<div class="search_parts">
			<label class="screen-reader-text" for="s">Search for:</label>
			<input type="text" value="" name="s" class="search_input_main" placeholder="Recherche" data-swplive="true"/>
		</div>
		<div class="search_parts">
			<fieldset>
				<legend>Categories</legend>
				<ul>
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

								<label for="cat-<?php echo $category->term_id . $category->name ?>"
								       style="background: <?php echo $couleur ?>;" class="search_label">
									<input type="checkbox" name="cat[]"
									       id="cat-<?php echo $category->term_id . $category->name ?>"
									       value="<?php echo $category->term_id; ?>" class="search_label"
									       data-swplive="true">
									<?php echo $category->name ?> </label>
							</li>
							<?php
						endif;
					}
					?>
				</ul>
			</fieldset>
		</div>
		<div class="search_parts">
			<input type="submit" id="searchsubmit" value="Rechercher"/>
		</div>
	</form>
</div>
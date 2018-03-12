<?php
$user = wp_get_current_user();
if ( current_user_can( "edit_posts" ) == true ):
	?>

	<div class="row form">
		<div class="col">
			<form method="post" id="post_insert" name="front_end" enctype="multipart/form-data"
			      action="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>">
				<p class="form_title">Ajouter un favoris</p>
				<p>
					<input required type="text" id="post_title" placeholder="Nom du site"/>
				</p>
				<p>
					<input required type="url" id="post_thumbnail" placeholder="Url du logo"/>
				</p>
				<p>
					<input required type="url" id="post_url" placeholder="Url du site"/>
				</p>
				<p>
					<input required type="checkbox" id="post_private" value="private"/>
					<label for="post_private">
						favoris privé
					</label>
				</p>
				<p>
					<textarea required id="post_content" placeholder="Description"></textarea>
				</p>
				<p>
					<?php
					$args = array(
						'show_option_all' => 'Catégories',
						'orderby'         => 'NAME',
						'order'           => 'ASC',
						'show_count'      => false,
						'hide_empty'      => false,
						'child_of'        => false,
						'exclude'         => true,
						'echo'            => true,
						'hierarchical'    => true,
						'name'            => 'post_category',
						'id'              => 'post_category',
						'class'           => 'postform',
						'depth'           => true,
						'tab_index'       => false,
						'taxonomy'        => 'category',
						'hide_if_empty'   => false,
					);
					wp_dropdown_categories( $args );
					?>
				</p>
				<p>
					<button type="button" name="submit" id="submit">Envoyer</button>
				</p>
				<input type="hidden" name="action" value="post"/>
			</form>
		</div>
		<div class="col">
			<div class="fav_card fav_dummy" style="border-color: #81d742;">
				<div class="fav_grouper" style="border-color: #81d742;">
					<div class="fav_zone_image">
						<a class="fav_image" href="#">
							<img src="http://fav.manusset.com/wp-content/themes/favoooris/assets/img/imgnotfound.svg">
						</a>
					</div>
					<div class="fav_title">

						<h3 class="post_title">titre</h3>

					</div>
					<div class="fav_content">

						<a class="tag fav_tag" style="background: #81d742;" href="#">veille </a>
					</div>
					<div class="fav_action">
						<a href="#" class="button fav_permalink">Lien du site</a>
						<button class="button fav_modal_trigger">Voir plus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
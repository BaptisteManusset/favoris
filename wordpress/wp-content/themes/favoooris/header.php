<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head id="top">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width"/>
	<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#49ff78">
	<meta name="msapplication-TileImage" content="<?php echo get_site_icon_url() ?>">
	<meta name="theme-color" content="#49ff78">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
	<!--head-->
	<?php wp_head(); ?>
	<!--end head-->
</head>

<body <?php body_class(); ?> >
<div class="row">
	<div class="col">
		<div class="menu_main">
			<div class="row">
				<div class="col6">
					<h1>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.svg" alt="logo" class="menu_main_logo">
						<a href="<?php echo get_site_url(); ?>"><?php bloginfo( "name" ) ?></a></h1>
					<p class="desc"><?php bloginfo( "description" ) ?></p>
				</div>
				<div class="col menu_right">
					<button class="search_form_toggle menu_button">
						<span class="text_reader">Recherche</span>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/search.svg" alt="">
					</button>
					<button class="menu_category_toggle menu_button">
						<span class="text_reader">Menu</span>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/menu.svg" alt="">
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part( 'template-parts/form', "search" ); ?>

<div class="menu_category_container" style="display: none">
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
			<a href="<?php echo get_category_link( $category->term_id ); ?>" class="menu_category_item" style="color: <?php echo $couleur; ?>">
				<?php echo ucfirst( $category->name ); ?>
			</a>
			<?php
		endif;
	}
	?>
	<button class="menu_category_close">X</button>
</div>

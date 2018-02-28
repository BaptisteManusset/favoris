<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width"/>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_site_icon_url() ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_site_icon_url() ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_site_icon_url() ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_site_icon_url() ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_site_icon_url() ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_site_icon_url() ?>">
	<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#49ff78">
	<meta name="msapplication-TileImage" content="<?php echo get_site_icon_url() ?>">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="row">
	<div class="col">
		<div class="menu_main">
			<div class="row">
				<div class="col6">
					<h1>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.svg" alt="logo"
						     class="menu_main_logo">
						<a href="<?php echo get_site_url(); ?>"><?php bloginfo( "name" ) ?></a></h1>
					<p class="desc"><?php bloginfo( "description" ) ?></p>
				</div>
				<div class="col">
					<button class="menu_category_toggle">Menu</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="menu_category_container" style="display: none">
	<!--	<div class="menu_category_group">-->
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
			<a href="<?php echo get_category_link( $category->term_id ); ?>" class="menu_category_item"
			   style="color: <?php echo $couleur; ?>"><?php echo ucfirst( $category->name ); ?></a>
			<?php
		endif;
	}
	?>
	<!--	</div>-->
	<button class="menu_category_close">X</button>
</div>

<!--HEADER FIN-->

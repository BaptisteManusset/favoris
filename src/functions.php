<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
	load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'card', 175, 175, true );
	set_post_thumbnail_size( 1000, 500 );

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
	);
}

add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts() {
	wp_enqueue_script( 'jquery' );
}

add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Widget Area', 'blankslate' ),
		'id'            => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => "</li>",
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

function blankslate_custom_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php
}

add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );

		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

if ( ! function_exists( 'get_category_color' ) ) {
	function get_category_color() {
		$id    = get_the_ID();
		$zes   = get_the_category( $id );
		$field = get_field( "couleur", $zes[0] );

		return $field;
	}

	function the_category_color() {
		echo get_category_color();
	}
}

if ( ! class_exists( 'Acf' ) ) {
	include_once( 'externe/acf/acf.php' );
}

//ajout du script
add_action( 'wp_enqueue_scripts', 'add_js_scripts' );
function add_js_scripts() {
	wp_enqueue_script( 'script', get_template_directory_uri() . '/script.js', array(), '1.0', true );
	wp_localize_script( 'script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
//definition des requetes ajax
add_action( 'wp_ajax_modal_post', 'modal_post' );
add_action( 'wp_ajax_nopriv_modal_post', 'modal_post' );

function modal_post() {
	if ( isset( $_POST['param'] ) ) {
		if ( ! empty( $_POST['param'] ) ) {
			$args       = array(
				'p'         => $_POST['param'], // ID of a page, post, or custom type
				'post_type' => 'post'
			);
			$ajax_query = new WP_Query( $args );

			if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
				get_template_part( 'template-parts/ajax' );
			endwhile;
			endif;
		}
	}
	die();
}

function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

//-----------------------------------------------------------
function single_post_insert() {
	$post_status = "publish";
	if ( $_POST['isprivate'] === "private" ) {
		$post_status = "private";
	}
	$new_post = array(
		'post_title'    => $_POST['title'],
		'post_content'  => $_POST['content'],
		'post_category' => array( $_POST['cat'] ),
		'post_status'   => $post_status,
		'post_type'     => 'post'
	);
	//insert the the post into database by passing $new_post to wp_insert_post
	//store our post ID in a variable $pid
	$pid = wp_insert_post( $new_post );
//	update_field( "lien", $_POST['url'], $pid );
	add_post_meta( $pid, "lien", $_POST['url'] );
	Generate_Featured_Image( $_POST['thumbnail'], $pid, "logo de " );
	echo json_encode( array( 'flag' => '1' ) );
	die;
}

add_action( 'wp_ajax_single_post', 'single_post_insert' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_single_post', 'single_post_insert' );


/**
 *
 * @return string
 */
function title_format($content) {
	return "<i>🔒</i>%s<i>🔒</i>";
}
add_filter("private_title_format", "title_format");
add_filter("protected_title_format", "title_format");


/**
 * Downloads an image from the specified URL and attaches it to a post as a post thumbnail.
 *
 * @param string $file The URL of the image to download.
 * @param int $post_id The post ID the post thumbnail is to be associated with.
 * @param string $desc Optional. Description of the image.
 *
 * @return string|WP_Error Attachment ID, WP_Error object otherwise.
 */
function Generate_Featured_Image( $file, $post_id, $desc ) {
	// Set variables for storage, fix file filename for query strings.
	preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png|svg)\b/i', $file, $matches );
	if ( ! $matches ) {
		$error = new WP_Error( 'image_sideload_failed', __( 'Invalid image URL' ) );

		return $error;
	}

	$file_array         = array();
	$file_array['name'] = basename( $matches[0] );

	// Download file to temp location.
	$file_array['tmp_name'] = download_url( $file );

	// If error storing temporarily, return the error.
	if ( is_wp_error( $file_array['tmp_name'] ) ) {
		return $file_array['tmp_name'];
	}

	// Do the validation and storage stuff.
	$id = media_handle_sideload( $file_array, $post_id, $desc );

	// If error storing permanently, unlink.
	if ( is_wp_error( $id ) ) {
		@unlink( $file_array['tmp_name'] );

		return $id;
	}

	return set_post_thumbnail( $post_id, $id );
}


add_filter( 'login_errors', create_function( '$a', "return '(✖╭╮✖) Une erreur est survenue';" ) );

function custom_login_logo() {
	echo '<style type="text/css">
        h1 a { background-image:url(' . get_bloginfo( 'template_directory' ) . '/assets/img/logo.svg) !important; }
    </style>';
}

add_action( 'login_head', 'custom_login_logo' );


function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );


//W3C validator

add_filter('style_loader_tag', 'remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'remove_type_attr', 10, 2);

function remove_type_attr($tag, $handle) {
	return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

add_action('get_header', 'remove_adminbar_offset');

function remove_adminbar_offset() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
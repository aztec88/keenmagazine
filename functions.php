<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function site_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/public/dist/css/bootstrap.css', array(), '3.3.7', 'all');
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/public/dist/css/font-awesome.min.css', array(), '4.7.0', 'all');
	wp_enqueue_style('swiper_css', get_template_directory_uri() . '/public/dist/css/swiper.min.css', array(), '3.4.2', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/public/dist/css/app.css', array(), '1.0.0', 'all');



	//js
	wp_enqueue_script('jquery');
	wp_enqueue_script('masonryjs', get_template_directory_uri() . '/public/dist/js/masonry.pkgd.min.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/public/dist/js/bootstrap.js', array(), '3.3.7', true);
	wp_enqueue_script('swiperjs', get_template_directory_uri() . '/public/dist/js/swiper.min.js', array(), '3.4.2', true);
	wp_enqueue_script('globaljs', get_template_directory_uri() . '/public/dist/js/global.js', array(), '1.0.0', true);



}

add_action( 'wp_enqueue_scripts', 'site_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/
function site_theme_setup() {

	add_theme_support('menus');

	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');

}

add_action('init', 'site_theme_setup');


/*
	==========================================
	 Post type
	==========================================
*/
function create_posttype() {
	register_post_type( 'editorial',
	array(
	  'labels' => array(
		'name' => __( 'Editorial' ),
		'singular_name' => __( 'editorial' )
	  ),
	  'public' => true,
	  'has_archive' => true,
	  'menu_icon' => 'dashicons-format-image',
	  'rewrite' => array('slug' => 'editorial'),
	  'supports' => array('title', 'editor', 'thumbnail', 'author', 'custom-fields')
	)
  );
  register_post_type( 'photographers',
    array(
      'labels' => array(
        'name' => __( 'Photographers' ),
        'singular_name' => __( 'Photographer' )
      ),

      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-camera',
      'rewrite' => array('slug' => 'photographer'),
      'supports' => array('title', 'editor', 'thumbnail', 'author', 'custom-fields')
    )
  );
  register_post_type( 'videos',
  array(
	'labels' => array(
	  'name' => __( 'Videos' ),
	  'singular_name' => __( 'Video' )
	),

	'public' => true,
	'has_archive' => true,
	'menu_icon' => 'dashicons-format-video',
	'rewrite' => array('slug' => 'video'),
	'supports' => array('title', 'editor', 'thumbnail', 'author', 'custom-fields')
  )
);

}
add_action( 'init', 'create_posttype' );




/*===================================================================================
 * Add Author Links
 * =================================================================================*/
/*
function add_to_author_profile( $author_work ) {

	$contactmethods['work'] = 'Work';
	$contactmethods['work_url'] = 'Work website';
	$contactmethods['facebook'] = 'Facebook profile URL';
	$contactmethods['twiter'] = 'Twiter username';
	$contactmethods['linkein'] = 'LinkeIn profile URL';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
*/


/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
// add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5', array('search-form'));

/*
	==========================================
	 Secondary featured image
	==========================================
*/
$thumb = new MultiPostThumbnails(array(
	'label' => 'Secondary Image',
	'id' => 'secondary-image',
	'post_type' => array('post', 'videos', 'photographers', 'editorial'),
	)
	);
	add_image_size('post-secondary-image-thumbnail', 300, auto);
/*
	==========================================
	 Sidebar function
	==========================================
*/
/*
function site_widget_setup() {

	register_sidebar(
		array(
			'name'	=> 'Sidebar',
			'id'	=> 'sidebar-1',
			'class'	=> 'custom',
			'description' => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

}
add_action('widgets_init','site_widget_setup');
*/
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}



/*
	==========================================
	 Include Walker file for custom menu
	==========================================
*/
require get_template_directory() . '/inc/walker.php';



# ---------------------------------------------------
# REMOVE SCREEN READER TEXT FROM POST PAGINATION
# ---------------------------------------------------

function sanitize_pagination($content) {
    // Remove h2 tag
    $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
    return $content;
}

add_action('navigation_markup_template', 'sanitize_pagination');



# ---------------------------------------------------
# UPLOAD LIMIT
# ---------------------------------------------------

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );



# ---------------------------------------------------
# EXERPT FOR HOME WITH NEWS
# ---------------------------------------------------

function get_excerpt($limit, $source = null){

	$excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = $excerpt.'...';
	return $excerpt;
}


# ---------------------------------------------------
# NEWS TUMBNAILS
# ---------------------------------------------------
add_image_size( 'news-size', 1000, 500, array( 'center', 'center' ) ); // 220 pixels wide by 180 pixels tall, hard crop mode


# ---------------------------------------------------
# WOOCOMMERCE ENABLE
# ---------------------------------------------------
add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support(){
	add_theme_support('woocommerce');
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}

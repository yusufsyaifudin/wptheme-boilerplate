<?php

/*
 * Add header script in tag <head>
 * written by Yusuf Syaifudin <yusuf.syaifudin@gmail.com>
 */
function header_scripts() {
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', '', '1.1.3');
	wp_register_style('main', get_template_directory_uri() . '/css/main.css', '', '4.3.0');
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '', '3.3.0');
	wp_register_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', '', '3.3.0');
	wp_register_style('style', get_template_directory_uri() . '/style.css', '', '1.0.0');

	wp_enqueue_style(array('normalize', 'main', 'bootstrap', 'bootstrap-theme', 'style'));

	// modernizr
	wp_register_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js');
	wp_enqueue_script(array('modernizr'));
	
}

add_action( 'wp_enqueue_scripts', 'header_scripts' ); 

/*
 * Add footer script before </body>
 * written by Yusuf Syaifudin <yusuf.syaifudin@gmail.com>
 */
function footer_scripts() {
	// true in 5th parameter is to force script print in bottom
	
	wp_register_script('jquery-cdn', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', '', '1.10.2', true);

	wp_register_script('bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', '', '3.3.0', true);
	wp_register_script('plugins-script', get_template_directory_uri() . '/js/plugins.js', '', '0', true);
	wp_register_script('main-script', get_template_directory_uri() . '/js/main.js', '', '0', true);


	wp_enqueue_script(array('jquery-cdn', 'bootstrap-script', 'plugins-script', 'main-script'));
}

add_action( 'wp_enqueue_scripts', 'footer_scripts' ); 


/*
 * Add custom menu feature
 */
function register_menu()
{
	register_nav_menu( 'primary', 'Primary Menu' );
}

add_action('init', 'register_menu');

/**
 * Get List page using $wpdb
 * Written by Yusuf Syaifudin <yusuf.syaifudin@gmail.com>
 * Written at Saturday, November 8, 2014 2:25AM
 */
function getPages($post_type = 'page' )
{
    global $wpdb;
    $where = get_posts_by_author_sql( $post_type, true );
    $pages = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts $where" );

    foreach ($pages as $p) {
    	$response[] = array(
    		'id' => $p->ID,
    		'title' => $p->post_title,
    		'url' => get_site_url() . '?page_id=' . $p->ID
    		);
    }

    return $response;
}

/**
 * Get all menu object as array
 * fallback to getPages()
 * Written by Yusuf Syaifudin <yusuf.syaifudin@gmail.com>
 * Written at Saturday, November 8, 2014 14:05PM
 *
 * --------------------------------------------------------------
 * usage:
 * <?php foreach (getMenu() as $menu) : ?>
 * <a href="<?php echo $menu['url']; ?>" class="item"><?php echo $menu['title']; ?></a>
 * <?php endforeach; ?>
 *
 */
function getMenu()
{
	$menu_name = 'primary';

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

		$menu_items = wp_get_nav_menu_items($menu->term_id);

		if ($menu_items == false) {
			return getPages();
		}

		foreach ( (array) $menu_items as $key => $menu_item ) {
			$menu_list[] = array(
				'id' => $menu_item->ID,
				'title' => $menu_item->title,
				'url' => $menu_item->url
				); 
		}

	} else {
		$menu_list = getPages();
	}
	// $menu_list now ready to output
	return $menu_list;
}
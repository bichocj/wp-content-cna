<?php
/*
    Our portfolio:  http://themeforest.net/user/tagDiv/portfolio
    Thanks for using our theme !
    tagDiv - 2015
*/


/**
 * Load the speed booster framework + theme specific files
 */

// load the deploy mode
require_once('td_deploy_mode.php');

// load the config
require_once('includes/td_config.php');
add_action('td_global_after', array('td_config', 'on_td_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10

// load the wp booster
require_once('includes/wp_booster/td_wp_booster_functions.php');


require_once('includes/td_css_generator.php');
require_once('includes/shortcodes/td_misc_shortcodes.php');
require_once('includes/widgets/td_page_builder_widgets.php'); // widgets





/* ----------------------------------------------------------------------------
 * Woo Commerce
 */

// breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs');
function td_woocommerce_breadcrumbs() {
	return array(
		'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
		'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
		'wrap_after' => '</div>',
		'before' => '',
		'after' => '',
		'home' => _x('Home', 'breadcrumb', 'woocommerce'),
	);
}

// use own pagination
if (!function_exists('woocommerce_pagination')) {
	// pagination
	function woocommerce_pagination() {
		echo td_page_generator::get_pagination();
	}
}

// Override theme default specification for product 3 per row


// Number of product per page 8
add_filter('loop_shop_per_page', create_function('$cols', 'return 4;'));

if (!function_exists('woocommerce_output_related_products')) {
	// Number of related products
	function woocommerce_output_related_products() {
		woocommerce_related_products(array(
			'posts_per_page' => 4,
			'columns' => 4,
			'orderby' => 'rand',
		)); // Display 4 products in rows of 1
	}
}




/* ----------------------------------------------------------------------------
 * bbPress
 */
// change avatar size to 40px
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size) {
	$author_avatar = '';
	if ($size == 14) {
		$size = 40;
	}
	$topic_id = bbp_get_topic_id( $topic_id );
	if ( !empty( $topic_id ) ) {
		if ( !bbp_is_topic_anonymous( $topic_id ) ) {
			$author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
		} else {
			$author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
		}
	}
	return $author_avatar;
}
add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);



//add_action('shutdown', 'test_td');

function test_td () {
    if (!is_admin()){
        td_api_base::_debug_get_used_on_page_components();
    }

}


/**
 * tdStyleCustomizer.js is required
 */
if (TD_DEBUG_LIVE_THEME_STYLE) {
    add_action('wp_footer', 'td_theme_style_footer');
    function td_theme_style_footer() {
        ?>
        <div id="td-theme-settings" class="td-theme-settings-small">
            <div class="td-skin-header">One click demos</div>
            <div class="td-skin-content">
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper/" class="td-set-theme-style-link">DEFAULT</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_fashion/" class="td-set-theme-style-link">FASHION</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_tech/" class="td-set-theme-style-link" data-value="">TECH</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_video/" class="td-set-theme-style-link">VIDEO</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_sport/" class="td-set-theme-style-link">SPORT</a></div>
                <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_classic_blog/" class="td-set-theme-style-link">CLASSIC BLOG</a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_travel/" class="td-set-theme-style-link">TRAVEL<span>New</span></a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_health/" class="td-set-theme-style-link">HEALTH<span>New</span></a></div>
	            <div class="td-set-theme-style"><a href="http://demo.tagdiv.com/newspaper_cars/" class="td-set-theme-style-link">CARS<span>New</span></a></div>
            </div>
            <div class="clearfix"></div>
            <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide">HIDE</a></div>
        </div>
    <?php
    }
}

// register_sidebar( array(
//     'id'          => 'ads-rightside',
//     'name'        => __( 'Anuncio Derecha', $text_domain ),
//     'before_title'  => '',
// 	'after_title'   => '',
// 	'before_widget' => '',
// 	'after_widget'  => '',
// ) );

// register_sidebar( array(
//     'id'          => 'ads-leftside',
//     'name'        => __( 'Anuncio Izquierda', $text_domain ),
//     'before_title'  => '',
// 	'after_title'   => '',
// 	'before_widget' => '',
// 	'after_widget'  => '',
// ) );

require_once('includes/api-try.php');
//td_util::update_option('tdx_remote_http', '');
//die;
//if (!is_admin()) {
//	$result = tdx_remote_http::get_page('http://reddit.com');
//	echo $result;
//	die;
//}


//print_r(td_remote_video::youtube_api_get_videos_info(array('JgI8DyDCESw', 'f5qepzrQm9U', 'UGdRyPN3IRk')));
//
//print_r(td_remote_video::vimeo_api_get_videos_info(array('141710401', '135900733', '135911266')));
//die;

/* Adicion de recursos customizados para CNA*/
function dcms_agregar_nueva_zona_widgets() {

	register_sidebar( array(
		'id'          => 'sidebar-mobile',
		'name'        => __( 'Sidebar Mobile', $text_domain ),
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	register_sidebar( array(
		'id'          => 'sidebar-post',
		'name'        => __( 'Sidebar Post', $text_domain ),
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '',
		'after_widget'  => '',
	) );

	register_sidebar( array(
		'id'          => 'sidebar-mas-visto',
		'name'        => __( 'Sidebar Lo Más Visto', $text_domain ),
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>',
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
	) );

	register_sidebar( array(
		'id'          => 'sidebar-contacte-cna',
		'name'        => __( 'Sidebar Contacto', $text_domain ),
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	
	register_sidebar( array(
		'id'          => 'cna-dollar',
		'name'        => __( 'El dólar en CNA', $text_domain ),
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>',
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
	) );
}

add_action( 'widgets_init', 'dcms_agregar_nueva_zona_widgets' );

function custom_cna_scripts() {
	//
	wp_enqueue_style( 'PT_Serif_font', 'https://fonts.googleapis.com/css?family=PT+Serif:400,700', false );

	// Caragar el JQuery ór defecto de Wp
	wp_enqueue_script("jquery");

	/* JS */
	wp_register_script('cna_script', get_template_directory_uri() . '/js/cna_theme.js', array('jquery'), null, false);
	wp_enqueue_script('cna_script');
}
add_action ('wp_enqueue_scripts', 'custom_cna_scripts');

?>
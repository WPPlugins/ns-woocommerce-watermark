<?
/*
Plugin Name: NS WooCommerce Watermark
Plugin URI: https://wordpress.org/plugins/ns-woocommerce-watermark/
Description: Add a Watermark on woocommerce immage
Version: 2.1.0
Author: NsThemes
Author URI: http://nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! defined( 'WATERMARK_NS_PLUGIN_DIR' ) )
    define( 'WATERMARK_NS_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

if ( ! defined( 'WATERMARK_NS_WW_PLUGIN_DIR' ) )
    define( 'WATERMARK_NS_WW_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

$ns_theme = wp_get_theme();
$ns_theme_name = $ns_theme['Name'];

/* *** include css *** */
function woocommerce_watermark_css( $hook ) {
	wp_enqueue_style('ns-style-watermark', WATERMARK_NS_WW_PLUGIN_DIR . '/css/custom-avada.css');
}
if( $ns_theme_name == 'Avada' || $ns_theme_name == 'Avada Child'){
	add_action( 'wp_enqueue_scripts', 'woocommerce_watermark_css' );
}

/* *** include css admin *** */
function woocommerce_watermark_css_admin( $hook ) {
	wp_enqueue_style('ns-style-watermark-admin', WATERMARK_NS_WW_PLUGIN_DIR . '/css/style.css');
}
add_action( 'admin_enqueue_scripts', 'woocommerce_watermark_css_admin' );



/* *** include js *** */
function woocommerce_watermark_js( $hook ) {
	wp_enqueue_script('ns-custom-script-ww', WATERMARK_NS_WW_PLUGIN_DIR . '/js/custom.js', array('jquery'));
	wp_localize_script( 'ns-custom-script-ww', 'nsdismisswat', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'woocommerce_watermark_js' );

// includere qua if shop
/* *** include loop product watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-loop.php');

/* *** include single product watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-single-product.php');

/* *** include single product gallery watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-product-thumbnails.php');

/* *** include admin option *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-admin.php');

function ns_activate_set_default_options() {
	add_option('woocommerce_watermark_enabled_plugin', '0');
    add_option('woocommerce_watermark_img', WATERMARK_NS_WW_PLUGIN_DIR.'/img/logo-nsthemes-black.png');
	add_option('woocommerce_watermark_notice', 'no');
}
 
register_activation_hook( __FILE__, 'ns_activate_set_default_options');

function woocommerce_watermark_image($image) {
	
	$current_user = wp_get_current_user();
	$not_user = (!isset($current_user->user_email) OR $current_user->user_email == '') ? true : false;
	
	if (get_option('woocommerce_watermark_enabled_plugin') == 0 OR (get_option('woocommerce_watermark_enabled_plugin') == 2 AND $not_user)) {
		$param_img = base64_encode('image_path='.$image.'&wt_path='.get_option('woocommerce_watermark_img').'&other=none');
		return WATERMARK_NS_WW_PLUGIN_DIR.'/ns_image.php?param='.$param_img;
	} else {
		return $image;
	}
}

function woocommerce_watermark_notice() {
	settings_fields('woocommerce_watermark_options');
	$ns_notice_dismissed = '';
	if (get_option('woocommerce_watermark_notice') == 'yes' ) { $ns_notice_dismissed = 'ns-notice-dismissed'; }
   ?>
   <div id="woocommerce-watermark-notice" class="notice is-dismissible notice-success <? echo $ns_notice_dismissed; ?>">
       <p><a href="http://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=3&campaign=bannerone"><img src="<?=WATERMARK_NS_WW_PLUGIN_DIR?>/img/woo-watermark-bennerone.png" style="width: 100%; height: auto;"></a></p>
	   <button class="ns-notice-dismiss" type="button">Dismiss this notice</button>
   </div>
   <?php
}
add_action( 'admin_notices', 'woocommerce_watermark_notice' );

function ns_add_woo_wt_option_page() {
    add_menu_page('Watermark', 'Watermark', 'manage_options', 'ns-woo-wt-options-page', 'ns_update_options_form', WATERMARK_NS_WW_PLUGIN_DIR.'/img/backend-sidebar-icon.png', 60);
}
 
add_action('admin_menu', 'ns_add_woo_wt_option_page');


####################################################################
add_action( 'wp_ajax_ns_dismisswatermark_ajax', 'ns_dismisswatermark_ajax' );
add_action( 'wp_ajax_nopriv_ns_dismisswatermark_ajax', 'ns_dismisswatermark_ajax' );

function ns_dismisswatermark_ajax() {
	update_option( 'woocommerce_watermark_notice', 'yes' );
    die();    
}
?>
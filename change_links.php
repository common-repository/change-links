<?php
/* Plugin Name: Change Links for post content 
 * Author: Annant Srivastava
 * Author URI: http://www.avincos.com
 * Plugin URI: http://www.avincos.com
 * Version: 1.1
 * Description: A Plugin to insert custom font size and font family to your post contents
 */
define('css_directory', WP_PLUGIN_DIR.'/cutom_fonts');
define('css_url', WP_PLUGIN_URL.'/cutom_fonts');

/* including fonts */
include_once 'css.php';
// Activating plugin
register_activation_hook(__FILE__, 'fonts_activate');
function fonts_activate(){
	add_option('font_size', '12');
	add_option('font_color','#ffffff');
	add_option('font_style','normal');
	
}
// Loading css files to site header file
/*add_action('wp_print_scripts', 'js_load_js');
	function js_load_js(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('color_picker', bloginfo('url').'/wp-admin/js/color-picker.js');
	}*/
if(!is_admin()){
	add_action('wp_head', 'font_head');
	function font_head(){
		$out = "<style type='text/css' media='screen'>
		a.link_text{
						font-size:".get_option('font_size')."px;
						color:".get_option('font_color').";
						font-style:".get_option('font_style').";
			}
			</style>";
		echo $out;
	}
}
/**
   * Adds "Settings" link to the plugin overview page
   */

 function plugin_add_settings_link($links) {
	$settings_link = '<a href="admin.php?page=fonts_options">Settings</a>';
  	array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

function autoblank($text) {
	$return = str_replace('<a', '<a class="link_text" target="_blank"', $text);
	return $return;
}
add_filter('the_content', 'autoblank');

?>
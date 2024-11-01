<?php
/*
Plugin Name: SupportAI
Plugin URI: https://supportai.com
Description: Custom ChatGPT trained with your Wordpress content to instantly answer your customers' questions.
Version: 1.0
Author: SupportAI
Author URI: https://supportai.com/app/
Text Domain: supportai
Requires at least: 5.2
Requires PHP: 7.2
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if(!defined('ABSPATH'))exit;
define( 'SUPPORTAI_PLUGIN_DIR_URL', plugin_dir_url(__FILE__) );
define( 'SUPPORTAI_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__) );
define( 'SUPPORTAI_API_URL', 'https://api.supportai.com/');

add_action('admin_menu', 'supportai_admin_menu');
function supportai_admin_menu() {
	add_menu_page(
		'SupportAI', 
		__('SupportAI', 'supportai'), 
		'manage_options', 
		'supportai-menu', 
		'supportai_homepage',
		'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 144.6 131.6" style="enable-background:new 0 0 144.6 131.6;" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M139.8,20.5c-3.2-10.8-11-15.6-18.1-17.7c-7.4-2.1-16.2-2.1-20.8-2.3c-21.2-0.9-58-0.4-67.3,0 C14.3,1.4,7,12.3,4.4,19.1 C4.4,47.5,1.7,95,7.7,105c8.5,17.4,24.9,15.4,24.9,15.4l18.9,0.2v11c0,0,45-8.2,63.3-12.1 c15.3-1.4,22.7-8,24.9-13.1C146.1,88.8,146.3,42.6,139.8,20.5z M123.4,79.4c-0.2,15.5-6.6,20-15.1,21.7 c-7.4,1.5-18.7,3.6-18.7,3.6l-27.7,5.2V99.5c0,0-8.4,0.2-20.5,0.6c-13.5,0-15.9-6.8-17.9-15.9c-3-14.1-1.8-34,0-50.4 c2.6-14.6,11.8-13.6,21.3-14.4c19.9-1.7,49.9-0.3,54.7-0.1c11.3,0.4,17.7,1,20.3,9S124.2,60.5,123.4,79.4z"/><ellipse fill="#FFFFFF" cx="55.2" cy="59.7" rx="11.5" ry="13.1"/><ellipse fill="#FFFFFF" cx="90.8" cy="59.7" rx="11.5" ry="13.1"/></g></g></svg>')
	);
}

function supportai_homepage() {
	if(!empty(get_option('supportai_apikey'))){
		include(SUPPORTAI_PLUGIN_DIR_PATH."inc/signed-in.php");
	}else{
		include(SUPPORTAI_PLUGIN_DIR_PATH."inc/home.php");
	}
}

function supportai_enqueuing_admin_scripts(){
	wp_enqueue_style('supportai-admin-css', SUPPORTAI_PLUGIN_DIR_URL.'/css/admin.css?v='.time());
    wp_enqueue_style('supportai-css', SUPPORTAI_PLUGIN_DIR_URL.'/css/main.css?v='.time());
	wp_enqueue_style('toastify-css', SUPPORTAI_PLUGIN_DIR_URL.'/css/toastify.min.css');
    wp_enqueue_script('supportai-js', SUPPORTAI_PLUGIN_DIR_URL.'/js/main.js?v='.time());
	wp_enqueue_script('toastify-js', SUPPORTAI_PLUGIN_DIR_URL.'/js/toastify-js.js');
	$nonce = wp_create_nonce('supportai_ajax_nonce');
	$localize_array = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
	$api_key = esc_attr(get_option('supportai_apikey'));
	if(!empty($api_key)){
		$localize_array['supportai_api_key'] = $api_key;
	}
	$localize_array['ajax_nonce'] = $nonce;
	wp_localize_script('supportai-js', 'supportai_ajax_object', $localize_array );
}
add_action( 'admin_enqueue_scripts', 'supportai_enqueuing_admin_scripts' );


add_action("wp_ajax_check_supportai_api", "supportai_check_api");
add_action("wp_ajax_nopriv_check_supportai_api", "supportai_check_api");

function supportai_check_api() {
	check_ajax_referer('supportai_ajax_nonce', 'nonce');
	if(empty($_POST['apikey'])){
		wp_send_json_error();
		wp_die();
	}
	$api_key = trim(sanitize_text_field($_POST['apikey']));
	$api_key_length = strlen($api_key);
	if($api_key_length != 32){
		wp_send_json_error();
		wp_die();
	}
	if(!empty($api_key)){
		// call to SupportAI API to verify API key
		$response = wp_remote_get(SUPPORTAI_API_URL.'verifyApiKey?api_key='.$api_key);
		$json_body = wp_remote_retrieve_body($response);
		$json = json_decode($json_body, true);
		if(!empty($json['success']) && $json['success']==true){
			update_option('supportai_apikey', $api_key);
			wp_send_json_success();
		}else{
			wp_send_json_error();
		}
		wp_die();
	}
}

add_action("wp_ajax_load_supportai_chatbots", "supportai_load_chatbots");
add_action("wp_ajax_nopriv_load_supportai_chatbots", "supportai_load_chatbots");

function supportai_load_chatbots() {
	$api_key = esc_attr(get_option('supportai_apikey'));
	if(!empty($api_key)){
		// call to SupportAI API to get chatbots
		$response = wp_remote_get(SUPPORTAI_API_URL.'getMyChatbots?api_key='.$api_key);
		$json_body = wp_remote_retrieve_body($response);
		$json = json_decode($json_body, true);
		if($json['error'] == null){
			wp_send_json_success($json['data']);
		}else{
			wp_send_json_error();
		}
		wp_die();
	}
}

add_action("wp_ajax_integrate_supportai_chatbot", "supportai_integrate_chatbot");
add_action("wp_ajax_nopriv_integrate_supportai_chatbot", "supportai_integrate_chatbot");

function supportai_integrate_chatbot() {
	check_ajax_referer('supportai_ajax_nonce', 'nonce');
	$api_key = esc_attr(get_option('supportai_apikey'));
	if(!empty($api_key)){
		$chatbot_id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
		if(!empty($chatbot_id)){
			update_option('supportai_active_chatbot_id', $chatbot_id);
			wp_send_json_success('Chatbot integration script added.');
		}else{
			wp_send_json_error('Chatbot ID is missing.');
		}
		wp_die();
	}
}

add_action("wp_ajax_delete_supportai_chatbot", "supportai_delete_chatbot");
add_action("wp_ajax_nopriv_delete_supportai_chatbot", "supportai_delete_chatbot");

function supportai_delete_chatbot() {
	check_ajax_referer('supportai_ajax_nonce', 'nonce');
	$api_key = esc_attr(get_option('supportai_apikey'));
	if(!empty($api_key)){
		delete_option('supportai_active_chatbot_id');
		wp_send_json_success('Chatbot integration script deleted.');
		wp_die();
	}
}

function supportai_add_script() {
	$supportai_chatbot_id = get_option('supportai_active_chatbot_id');
    if(!empty($supportai_chatbot_id)) {
        echo "\n<!-- SupportAI.com -->\n";
        echo "<script type='text/javascript'>(function(){var d = document;var s = d.createElement('script');s.src = 'https://widget.supportai.com/" . esc_js($supportai_chatbot_id) . ".js';s.async = 1;d.getElementsByTagName('head')[0].appendChild(s);})();</script>\n";
        echo "<!-- End of SupportAI.com -->\n";
    }
}
add_action('wp_head', 'supportai_add_script');

register_deactivation_hook(__FILE__, 'supportai_deactivate');
function supportai_deactivate() {
    delete_option('supportai_apikey');
}
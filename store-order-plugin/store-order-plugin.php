<?php
/**
 * * @wordpress-plugin
 * Plugin Name:       Store Order Plugin
 * Plugin URI:        https://https://github.com/eleaswebdev
 * Description:       Sends order data to Hub and syncs updates from Hub to Store.
 * Version:           1.0.0
 * Author:            Eleas Kanchon
 * Author URI:        https://https://github.com/eleaswebdev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       store-order-plugin
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
    die;
}    
// Load plugin text domain
add_action('plugins_loaded', 'wppool_load_store_order_plugin_textdomain');
function wppool_load_store_order_plugin_textdomain() {
    load_plugin_textdomain( 'store-order-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

require_once plugin_dir_path(__FILE__) . 'includes/rest-api-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/send-order-to-hub.php';
require_once plugin_dir_path(__FILE__) . 'includes/update-order.php';
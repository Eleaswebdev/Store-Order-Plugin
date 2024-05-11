<?php

// If uninstall is not called from WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

$plugin_options = array(
    'rest_secret_key',
    'rest_base_url',
);
foreach ( $plugin_options as $option_name ) {
    delete_option( $option_name );
}
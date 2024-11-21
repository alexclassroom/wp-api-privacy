<?php
/*
    Plugin Name: WP API Privacy
    Plugin URI: https://github.com/wp-privacy/wp-api-privacy
    Banner: https://github.com/wp-privacy/wp-api-privacy/blob/main/assets/banner.jpg?raw=true
    Description: Strips potentially identifying information from outbound requests to the WordPress.org API
    Author: Duane Storey
    Author URI: https://duanestorey.com
    Version: 1.2.2
    Requires PHP: 6.0
    Requires at least: 6.0
    Tested up to: 6.7
    Update URI: https://github.com/wp-privacy/wp-api-privacy
    Stable: 1.2.1
    Text Domain: wp-api-privacy
    Domain Path: /lang
    GitHub Plugin URI: wp-privacy/wp-api-privacy
    Primary Branch: main

    Copyright (C) 2024 by Duane Storey - All Rights Reserved
    You may use, distribute and modify this code under the
    terms of the GPLv3 license.
*/

namespace WP_Privacy\WP_API_Privacy;

// Prevent direct access
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'PRIVACY_VERSION', '1.2.2' );
define( 'PRIVACY_PATH', dirname( __FILE__ ) );
define( 'PRIVACY_MAIN_FILE', __FILE__ );
define( 'PRIVACY_PATH_SRC', dirname( __FILE__ ) . '/src' );

require_once( dirname( __FILE__ ) . '/src/api-privacy.php' );

function initialize_privacy( $params ) {
    load_plugin_textdomain( 'wp-api-privacy', false, 'wp-api-privacy/lang/' );

    ApiPrivacy::instance()->init(); 
}

function handle_uninstall() {
    // clean up the options table
    Settings::deleteAllOptions();
}

add_action( 'init', __NAMESPACE__ . '\initialize_privacy' );
register_uninstall_hook( __FILE__, __NAMESPACE__ . '\handle_uninstall' );

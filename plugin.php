<?php
  /*
  * Plugin Name: WP REST API - Multisite user plugin
  * Description:  Enables user endpoints required by wp-api-2.0-beta12+
  * Version:  0.1
  * Author: Afrozaar Consulting
  * Plugin URI: https://github.com/Afrozaar/wp-api-v2-multisite-user-plugin
  */
  include_once ABSPATH . 'wp-admin/includes/plugin.php';
  require_once dirname(__FILE__).'/lib/endpoints/user_controller.php';
 
  add_action( 'rest_api_init', function () {
    $controller = new WP_REST_User_Controller();
    $controller->register_routes();
  } );

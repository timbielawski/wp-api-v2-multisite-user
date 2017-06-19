<?php

class Site_DTO {
  public $userblog_id;
  public $blogname;
  public $domain;

  function __construct($userblog_id, $blogname, $domain) {
    $this->userblog_id = $userblog_id;
    $this->blogname = $blogname;
    $this->domain = $domain;
  }
}

class WP_REST_User_Controller extends WP_REST_Controller {

  public function register_routes() {

    $version = '2';
    $namespace = 'wp/v' . $version;

      register_rest_route( $namespace, '/multi-site/email/(?P<email>[\S-]+)', array(
  			'methods'         => WP_REST_Server::READABLE,
  			'callback'        => array( $this, 'get_multisite_by_email' ),
  			'args'            => array(
  				'context'          => $this->get_context_param( array( 'default' => 'embed' ) ),
  			),
  			'schema' => array( $this, 'get_public_item_schema' ),
  		));
  }

  public function get_multisite_by_email( $request ) {
    $email = urldecode($request['email']);

    if (!empty( $email ) ) {
      $user = get_user_by( 'email', $email );
    }

    if ((empty($email) || empty($user->user_login))) {
      return new WP_Error( 'rest_user_invalid_username', __( 'Invalid user name.' ), array( 'status' => 404 ) );
    }

    $user_id = $user->ID;
    $_sites = get_blogs_of_user($user_id);
    $sites = array();
    foreach ( $_sites as $site ) {
      array_push($sites, new Site_DTO($site->userblog_id, $site->blogname, $site->siteurl));
    }
		$response = rest_ensure_response($sites);
		return $response;
	}
}
 ?>

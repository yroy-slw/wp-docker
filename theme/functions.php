<?php register_nav_menus( array(
  'rdv' => __( 'Menu Rdv'),
  'main-fr' => __( 'Main FR')
));

add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );

$subRole = get_role( 'subscriber' ); 
$subRole->add_cap( 'read_private_posts' );
$subRole->add_cap( 'read_private_pages' );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf';
    return $path;
}

function custom_pll_languages_ul_class($args) {
    // Get the current language
    $current_language = pll_current_language();

    // Add a class to the ul element based on the current language
    $args['dropdown_class'] .= ' lang-' . $current_language;

    return $args;
}


// Register Custom Post Type
function custom_footer_post_type() {
    $labels = array(
        'name'                  => _x( 'Footer Items', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Footer Item', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Footer', 'text_domain' ),
        'name_admin_bar'        => __( 'Footer Item', 'text_domain' ),
        'archives'              => __( 'Footer Archives', 'text_domain' ),
        'attributes'            => __( 'Footer Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Footer Item:', 'text_domain' ),
        'all_items'             => __( 'All Footer Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Footer Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Footer Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Footer Item', 'text_domain' ),
        'update_item'           => __( 'Update Footer Item', 'text_domain' ),
        'view_item'             => __( 'View Footer Item', 'text_domain' ),
        'view_items'            => __( 'View Footer Items', 'text_domain' ),
        'search_items'          => __( 'Search Footer Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Footer Item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Footer Item', 'text_domain' ),
        'items_list'            => __( 'Footer Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Footer Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Footer Items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Footer Item', 'text_domain' ),
        'description'           => __( 'Custom post type for footer items', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone', // You can change the icon
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'footer', $args );
}
add_action( 'init', 'custom_footer_post_type', 0 );

// Hook into the filter
add_filter( 'autoptimize_filter_imgopt_linkicon', '__return_false');

add_filter('body_class', 'add_page_slug_to_body_class');

add_filter('body_class', 'add_page_slug_to_body_class');

add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // Wordpress core
wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}

function dm_remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  }
  add_action( 'wp_enqueue_scripts', 'dm_remove_wp_block_library_css' );

  /*  DISABLE GUTENBERG STYLE IN HEADER| WordPress 5.9 */
function wps_deregister_styles() {
  wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

add_filter( 'private_title_format', function ( $format ) {
  return '%s';
} );

add_filter('show_admin_bar', '__return_false');

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => "https://www.csea.ch/espace-membre-csea/",
        'loadingmessage' => __('Contrôle du login...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){

  // First check the nonce, if it fails the function will break
  check_ajax_referer( 'ajax-login-nonce', 'security' );

  // Nonce is checked, get the POST data and sign user on
  $info = array();
  $info['user_login'] = $_POST['username'];
  $info['user_password'] = $_POST['password'];
  $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
      
      echo json_encode(array('loggedin'=>false, 'message'=>__("Mauvais mot de passe ou user.")));
  } else {
      echo json_encode(array('loggedin'=>true, 'message'=>__('Vous êtes maintenant connecté')));
  }

  die();
}

add_action('init','prefix_delete_user');
function prefix_delete_user() {
if(isset($_REQUEST['action']) && $_REQUEST['action']=='prefix_delete_user') {
   //include("./wp-admin/includes/user.php" );
   //check admin permissions.
	require_once(ABSPATH.'wp-admin/includes/user.php');
   if (current_user_can('edit_users')) {
       $user_id = intval($_REQUEST['user_id']);
       wp_delete_user($user_id);
        $location = $_SERVER['HTTP_REFERER'];
        wp_safe_redirect($location);
       exit();
   }
}
}

//Redirect from wp-admin
add_action('admin_init', 'my_admin_redirect');
function my_admin_redirect()
{
    if (!defined('DOING_AJAX'))
    {
        if (current_user_can('subscriber'))
        {
            $refer=wp_get_referer();
            if (!$refer || strpos($refer, 'wp-admin'))
            {
                wp_safe_redirect(home_url());
            }
            else
            {
                wp_safe_redirect($refer);
            }
        }
    }
}


// Delete from Front-End Link
function wp_delete_post_link($link = 'Delete This', $before = '', $after = '')
{
    global $post;
    if ( $post->post_type == 'page' ) {
        if ( !current_user_can( 'edit_page', $post->ID ) )
        return;
    } else {
        if ( !current_user_can( 'edit_post', $post->ID ) )
        return;
    }
    $link = "<a class='supprimer-post' href='" . wp_nonce_url( get_bloginfo('url') . "/wp-admin/post.php?action=delete&amp;post=" . $post->ID, 'delete-post_' . $post->ID) . "'>".$link."</a>";
    echo $before . $link . $after;
}

/*
add_action('init','delete');
function delete() {
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete') {
        $location = $_SERVER['HTTP_REFERER'];
        wp_safe_redirect($location);
    }
}
*/

/*AJOUTER PARTENAIRE*/
add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post_partenaire' );
function tsm_do_pre_save_post_partenaire( $post_id ) {
	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}
	// check if this is to be a new post
	if( $post_id != 'new_post_partenaire' ) {
		return $post_id;
	}
	// Create a new post
	$post_partenaire = array(
		'post_type'     => 'member', // Your post type ( post, page, custom post type )
		'post_status'   => 'publish', // (publish, draft, private, etc.)
		'post_title'    => wp_strip_all_tags($_POST['acf']['field_6488628c86e72']), // Post Title ACF field key
	);
	// insert the post
	$post_id = wp_insert_post( $post_partenaire );
	// Save the fields to the post
	do_action( 'acf/save_post' , $post_id );

	wp_redirect( site_url()."/partenaire/");
	//return $post_id;
}

/*AJOUTER Membre*/
add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post_membre' );
function tsm_do_pre_save_post_membre( $post_id ) {
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}

	if( $post_id != 'new_member' ) {
		return $post_id;
	}
	else {

    $name = wp_strip_all_tags($_POST['acf']['field_64885c579edb7']);
    $password = wp_strip_all_tags($_POST['acf']['field_64885c6b9edb8']);
    $mail = wp_strip_all_tags($_POST['acf']['field_64885c7b9edb9']);
    $user = get_user_by( 'email', $mail );
    if( ! $user ) {
        $user_id = wp_create_user( $name, $password, $mail );
        if( is_wp_error( $user_id ) ) {

            echo( "Error: " . $user_id->get_error_message() );
            exit;
        }
        $user = get_user_by( 'id', $user_id );
    }
    $user->add_role( 'subscriber' );

}
}
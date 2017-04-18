<?php
require_once(get_stylesheet_directory().'/types/members.php');
require_once(get_stylesheet_directory().'/types/enseignes.php');
require_once(get_stylesheet_directory().'/types/publications.php');

add_action('admin_head', 'plugin_header');
function plugin_header() {
        global $post_type;
		$theme_url=get_bloginfo('template_directory');
		
    ?>
    <style>
    <?php if (($_GET['post_type'] == 'publication') || ($post_type == 'publication')) : ?>
    #icon-edit { background:transparent url('<?php echo get_stylesheet_directory_uri().'/images/publications32x32.png';?>) no-repeat;}    
    <?php endif; ?>
    <?php if (($_GET['post_type'] == 'member') || ($post_type == 'member')) : ?>
    #icon-edit { background:transparent url('<?php echo get_template_directory().'/images/member32x32.png';?>') no-repeat;}    
    <?php endif; ?>
    <?php if (($_GET['post_type'] == 'enseigne') || ($post_type == 'enseigne')) : ?>
    #icon-edit { background:transparent url('<?php echo get_template_directory().'/images/enseignes32x32.png';?>') no-repeat;}    
    <?php endif; ?>

        </style>


        <?php
}



// Replaces the excerpt "more" text by a link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
       global $post;
	return '...<br/><a class="moretag" href="'. get_permalink($post->ID) . '">Lire la suite...</a>';
}


/*add_filter('posts_orderby', 'member_alphabetical' );*/
add_filter('post_limits', 'member_limits' );

function member_alphabetical( $orderby )
{
 /* global $gloss_category;*/
if( !is_admin() && is_post_type_archive('member_type') ){
/*  if( is_tax( 'member' )) {
*/     // alphabetical order by custom field 'member_lastname'
     return "member_lastname ASC";
/*  }
*/
  // not in glossary category, return default order by
  return $orderby;
} 
}

function member_limits( $limits )
{
  /*global $gloss_category;*/

if( !is_admin() && is_tax('member_type') ){
     // remove limits
     return "";
  }

  // not in glossary category, return default limits
  return $limits;
}
/**
 * Hide ACF menu item from the admin menu
 */
 
function remove_menus()
{
 
    // provide a list of usernames who can edit custom field definitions here
    $admins = array('admin_AHC');
 
    // get the current user
    $current_user = wp_get_current_user();
 
    // match and remove if needed
    if( !in_array( $current_user->user_login, $admins ) )
    {
		remove_menu_page('themes.php');
		remove_menu_page('tools.php');
		remove_menu_page('plugins.php');
		remove_menu_page('options-general.php');

		remove_menu_page('duplicator.php'); 
		remove_menu_page('edit.php?post_type=page');
        remove_menu_page('edit.php?post_type=acf');
		remove_menu_page('admin.php?page=seo');

    }
 
}
 
/*add_action( 'admin_menu', 'remove_menus', 999 );*/

?>

<?php 
/*Plugin Name: WPTutsPlus Customize the Admin Part 1 - Login Screen
Plugin URI: http://rachelmccollin.co.uk
Description: This plugin supports the tutorial in wptutsplus. It customizes the WordPress login screen.
Version: 1.0
Author: Rachel McCollin
Author URI: http://rachelmccollin.com
License: GPLv2
*/

// add a new logo, background color, and styling to the login page
function wptutsplus_login_logo() {
	$theme_url=get_bloginfo('template_directory'); ?>
	<style type="text/css">
		.login #login h1 a {
			background-image: url('<?php echo get_stylesheet_directory_uri();?>/images/login2.png'  );
			background-size: 300px auto;
			height: 115px;
			width:300px;
			margin-bottom: 5px;
			color:black;
		}
		.login #login a	{color:black;}
		.login #login a:hover {color:white; font-weight:bold;}
		/*body {background-color:#FC0!important;}*/
		body {background-color:#393!important;}
		#loginform {
			/*background-color:#F90;*/ 
			background-color:#6C6;
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius:10px;
			-webkit-box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.6);-moz-box-shadow:7px 7px 5px rgba(50, 50, 50, 0.6);box-shadow:7px 7px 5px rgba(50, 50, 50, 0.6);
			
		}
		#user_login, #user_pass{
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			font-size:1em;
			height:35px; 
			line-height:1.2em;
			width:80%;
			color:#FFF;
			background-color:#666;
		}
	

	</style>
<?php }
add_action( 'login_enqueue_scripts', 'wptutsplus_login_logo' );
?>
<?php
//change the footer text
function wptutsplus_admin_footer_text () {
	$theme_url=get_bloginfo('template_directory');
	echo '<img src="' .get_stylesheet_directory().'/images/favicon-32x32.png'.'" alt=""> &copy; '.date("Y").' | Association pour l\'Histoire du Commerce | Administration du site';
}
add_filter( 'admin_footer_text', 'wptutsplus_admin_footer_text');
?>

<?php
function filter_search($query) {
    if ($query->is_search) {
		
	$query->set('post_type', array('post','page','member','enseigne'));
    };

    return $query;

};
add_filter('pre_get_posts', 'filter_search');
?>

<?php
function my_acf_update_member_name( $value, $post_id, $field ) {
	global $_POST;
// vars
$firstname=$_POST['fields']['field_528af446de43d'];
$new_title = $firstname . ' ' . $value;
$new_slug = sanitize_title( $new_title );

// update post : http://codex.wordpress.org/Function_Reference/wp_update_post
$my_post = array('ID' => $post_id,'post_title' => $new_title,'post_name' => $new_slug);
// Update the post into the database
wp_update_post( $my_post );
return $value;
}
add_filter('acf/update_value/name=member_lastname', 'my_acf_update_member_name', 10, 3);
?>

<?php
function my_acf_update_publication_title( $value, $post_id, $field ) {
	global $_POST;
// vars

$new_title = $value;
$new_slug = sanitize_title( $new_title );

// update post : http://codex.wordpress.org/Function_Reference/wp_update_post
$my_post = array('ID' => $post_id,'post_title' => $new_title,'post_name' => $new_slug);
// Update the post into the database
wp_update_post( $my_post );
return $value;
}
add_filter('acf/update_value/name=publication_titre', 'my_acf_update_publication_title', 10, 3);
?>
<?php
function my_acf_update_enseigne_title( $value, $post_id, $field ) {
	global $_POST;
// vars

$new_title = $value;
$new_slug = sanitize_title( $new_title );

// update post : http://codex.wordpress.org/Function_Reference/wp_update_post
$my_post = array('ID' => $post_id,'post_title' => $new_title,'post_name' => $new_slug);
// Update the post into the database
wp_update_post( $my_post );
return $value;
}
add_filter('acf/update_value/name=enseigne_name', 'my_acf_update_enseigne_title', 10, 3);
?>
<?php
/*function my_acf_save_post( $post_id )
{
	// vars
	// $fields = false;
	// $sql="TRUNCATE TABLE newsletter_users";
	// $query=mysql_query($sql);
	$args = array('post_type'=>'member','tax_query' => array(array('taxonomy' => 'member_type','field' => 'slug','terms' => array('membre','membre-du-bureau', 'membre-honoraire')
     )),  'posts_per_page'    =>  -1,  'meta_key' => 'member_lastname',  'order'             =>  'ASC',  'orderby'           =>  'meta_value');
		$the_query = new WP_Query( $args );

		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        	<!--<div class="resource_masterindex">-->
          		<?php
              	$member_last=get_field('member_lastname');
                $member_first=get_field('member_firstname');
				$member_email=get_field('member_email');
				$user_data = array('email' => $member_email,'firstname' => $member_first,'lastname' => $member_last);
				$data_subscriber = array('user' => $user_data,'user_list' => array('list_ids' => array(4)));
				$helper_user = WYSIJA::get('user','helper');
				$helper_user->addSubscriber($data_subscriber);
		endwhile;
		die;
	// ...
}
 
// run before ACF saves the $_POST['fields'] data
// add_action('acf/save_post', 'my_acf_save_post', 1);
 
// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'my_acf_save_post', 20);*/
 
?>

<?php
require ('wptuts.php');
?>
<?php
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Avis des Membres';
    $submenu['edit.php'][5][0] = 'Tous les Avis';
    $submenu['edit.php'][10][0] = 'Ajouter un Avis';
/*    
	$submenu['edit.php'][15][0] = 'Status'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
*/  
	echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Avis des Membres de l\'AHC';
        $labels->singular_name = 'Avis';
        $labels->add_new = 'Ajouter un Avis';
        $labels->add_new_item = 'Ajouter un Avis';
        $labels->edit_item = 'Editer un Avis';
        $labels->new_item = 'Avis';
        $labels->view_item = 'Visualiser un Avis';
        $labels->search_items = 'Rechercher un / des Avis';
        $labels->not_found = 'Pas d\'avis trouv&eacute;s';
        $labels->not_found_in_trash = 'Pas d\'Avis dans la Corbeille';
    }
/*    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );
*/
?>
<?php
function alter_comment_form_fields($fields){
    //$fields['author'] = ''; //removes name field
    //$fields['email'] = '';  //removes email field
    $fields['url'] = '';  //removes website field
    return $fields;
}

add_filter('comment_form_default_fields','alter_comment_form_fields');

?>
<?php

 
/**
* [list_searcheable_acf list all the custom fields we want to include in our search query]
* @return [array] [list of custom fields]
*/
function list_searcheable_acf(){
$list_searcheable_acf = array("title", "sub_title", "excerpt_short", "excerpt_long", "enseigne_desc", "enseigne_all_denos");
return $list_searcheable_acf;
}
 
 
/**
* [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
* @param [query-part/string] $where [the initial "where" part of the search query]
* @param [object] $wp_query []
* @return [query-part/string] $where [the "where" part of the search query as we customized]
* see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
* credits to Vincent Zurczak for the base query structure/spliting tags section
*/
function advanced_custom_search( $where, &$wp_query ) {
 
global $wpdb;
if ( empty( $where ))
return $where;
// get search expression
$terms = $wp_query->query_vars[ 's' ];
// explode search expression to get search terms
$exploded = explode( ' ', $terms );
if( $exploded === FALSE || count( $exploded ) == 0 )
$exploded = array( 0 => $terms );
// reset search in order to rebuilt it as we whish
$where = '';
// get searcheable_acf, a list of advanced custom fields you want to search content in
$list_searcheable_acf = list_searcheable_acf();
 
foreach( $exploded as $tag ) :
$where .= "
AND (
(wp_posts.post_title LIKE '%$tag%')
OR (wp_posts.post_content LIKE '%$tag%')
OR EXISTS (
SELECT * FROM wp_postmeta
WHERE post_id = wp_posts.ID
AND (";
 
foreach ($list_searcheable_acf as $searcheable_acf) :
if ($searcheable_acf == $list_searcheable_acf[0]):
$where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
else :
$where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
endif;
endforeach;
 
$where .= ")
)
OR EXISTS (
SELECT * FROM wp_comments
WHERE comment_post_ID = wp_posts.ID
AND comment_content LIKE '%$tag%'
)
OR EXISTS (
SELECT * FROM wp_terms
INNER JOIN wp_term_taxonomy
ON wp_term_taxonomy.term_id = wp_terms.term_id
INNER JOIN wp_term_relationships
ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
WHERE (
taxonomy = 'post_tag'

)
AND object_id = wp_posts.ID
AND wp_terms.name LIKE '%$tag%'
)
)";
endforeach;
return $where;
}
add_filter( 'posts_search', 'advanced_custom_search', 500, 2 );
?>

<?php
function wpse28145_add_custom_types( $query ) {
    if( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );


        $query->set( 'post_type', $post_types );
        return $query;
    }
}
add_filter( 'pre_get_posts', 'wpse28145_add_custom_types' );


function est_identifie() {
/* Retourne true si l'utilisateur des identifie */
/*if (isset($_SESSION)) {echo "SES OK<br>";}
if (isset($_SESSION['utilisateur'])) {echo "SES UT OK<br>";}*/
/*echo "Email: ".$_SESSION['utilisateur']['user_email']."<br>";*/
	return isset($_SESSION)
		&& isset($_SESSION['member'])
		&& (!empty($_SESSION['member']));
/*		&& !empty($_SESSION['utilisateur']['user_email'])*/
		/*&& vb($_SESSION['url']) == $_SERVER['HTTP_HOST'];*/
				
}
function vb(&$var, $default="") { // Variable blanche
/* if $var n'est pas défini, retourne $default, sinon retourne $var */

	return isset($var) ? $var : $default;
}

function necessite_identification() {
if(!est_identifie()){
	return false;
} else {
	return true;
}

}
add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

add_action( 'pre_get_posts', 'foo_modify_query_exclude_category' );
function foo_modify_query_exclude_category( $query ) {
	if (!est_identifie()) {
    /*if ( $query->is_main_query() && ! $query->get( 'cat' ) )*/
        $query->set( 'cat', '-43' );
	}
}

/*if (!est_identifie()) {
	add_filter('widget_posts_args','modify_widget');
}*/
function modify_widget() {
  	$r = array( 'cat' => '-43' );
    return $r;
}


?>
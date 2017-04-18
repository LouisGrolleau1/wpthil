<?php
 function CPT_member_init() {
  $labels = array(
    'name'               => 'Membres',
    'singular_name'      => 'Membre',
    'add_new'            => 'Ajouter Nouveau',
    'add_new_item'       => 'Ajouter Nouveau Membre',
    'edit_item'          => 'Editer une fiche',
    'new_item'           => 'Nouveau Membre',
    'all_items'          => 'Tous les Membres',
    'view_item'          => 'Voir une Fiche de Membre',
    'search_items'       => 'Rechercher Membres',
    'not_found'          => 'Aucun membre trouv&eacute;',
    'not_found_in_trash' => 'Pas de membres dans la Corbeille',
    'parent_item_colon'  => '',
    'menu_name'          => 'Membres'
  );
  $theme_url=get_bloginfo('template_directory');
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
	'taxonomies'		 => array('member_type'),
    'rewrite'            => array( 'slug' => 'membre' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
	'menu_icon'			 => get_template_directory(). '/images/member16x16.png',
    'supports'           => array('editor', 'author', 'thumbnail')
  );

  register_post_type( 'member', $args );
}
add_action( 'init', 'CPT_member_init' );

?>
<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_member_taxonomies');

// create two taxonomies, genres and writers for the post type "book"
function create_member_taxonomies() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => 'Types de Membres',
		'singular_name'              => 'Type de Membres',
		'search_items'               => 'Rechercher Type de Membres',
		'popular_items'              => 'Type de Membres les + Populaires',
		'all_items'                  => 'Tous Type de Membres',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Editer Les Types de Membres',
		'update_item'                => 'Modifier les Types de Membres',
		'add_new_item'               => 'Ajouter un Nouveau Type de Membre',
		'new_item_name'              => 'Nouveau Type de Membre',
		'separate_items_with_commas' => 'S&eacute;parer Type de Membres par des virgules',
		'add_or_remove_items'        => 'Ajouter ou Supprimer des Types de Membres',
		'choose_from_most_used'      => 'Choisir parmi les plus utilis&eacute;s',
		'not_found'                  => 'Pas de Type deMembres Trouv&eacute;s',
		'menu_name'                  => 'Type de Membres',
	);

	$args = array(
		'public' => true,
	    'has_archive'        => true,
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => false,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'type_de_membre' ),
	);

	register_taxonomy( 'member_type', 'member', $args );
}
	add_action('admin_menu', 'member_submenu_print');

function member_submenu_print(){
	add_submenu_page('edit.php?post_type=member', 'Membres | Imprimer | ','Print Infos for ONE member', 'manage_options', 'my-custom-submenu-print', 'member_submenu_print_callback' ); 
	add_submenu_page('edit.php?post_type=member', 'Membres | Imprimer | ','Print Infos for a subset of Members', 'manage_options', 'my-custom-submenu-print', 'member_submenu_print_callback' ); 
}



function member_submenu_print_callback() {
	
	echo '<div class="wrap theme-options-page">';
		echo '<div id="icon-edit-pages" class="icon32"></div>';
		echo '<h2>Imprimer</h2>';
	echo '</div>';

}
?>
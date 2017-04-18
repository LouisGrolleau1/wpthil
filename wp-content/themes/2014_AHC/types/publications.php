<?php
 function CPT_publication_init() {
  $labels = array(
    'name'               => 'Publications',
    'singular_name'      => 'Publication',
    'add_new'            => 'Ajouter Nouvelle',
    'add_new_item'       => 'Ajouter une Nouvelle Publication',
    'edit_item'          => 'Editer une fiche',
    'new_item'           => 'Nouvelle Publication',
    'all_items'          => 'Toutes les Publications',
    'view_item'          => 'Voir la fiche d\'une Publication',
    'search_items'       => 'Rechercher Publications',
    'not_found'          => 'Aucune Publication trouv&eacute;e',
    'not_found_in_trash' => 'Pas de Publications dans la Corbeille',
    'parent_item_colon'  => '',
    'menu_name'          => 'Publications'
  );
  $theme_url=get_bloginfo('template_directory');
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
	'taxonomies'		 => array('post_tag','publication_type'),
    'rewrite'            => array( 'slug' => 'publication' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 6,
	'menu_icon'			 => get_stylesheet_directory_uri(). '/images/publications24x24.png',
    'supports'           => array('author', 'editor', 'thumbnail','comments','custom-fields')
  );

  register_post_type( 'publication', $args );
}
add_action( 'init', 'CPT_publication_init' );

?>
<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_publication_taxonomies');

// create two taxonomies, genres and writers for the post type "book"
function create_publication_taxonomies() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => 'Types de Publications',
		'singular_name'              => 'Type de Publications',
		'search_items'               => 'Rechercher Type de Publications',
		'popular_items'              => 'Type de Publications les + Populaires',
		'all_items'                  => 'Tous Type de Publications',
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => 'Editer Les Types de Publications',
		'update_item'                => 'Modifier les Types de Publications',
		'add_new_item'               => 'Ajouter un Nouveau Type de Publication',
		'new_item_name'              => 'Nouveau Type de Publication',
		'separate_items_with_commas' => 'S&eacute;parer Type de Publications par des virgules',
		'add_or_remove_items'        => 'Ajouter ou Supprimer des Types de Publications',
		'choose_from_most_used'      => 'Choisir parmi les plus utilis&eacute;s',
		'not_found'                  => 'Pas de Type de Publications Trouv&eacute;es',
		'menu_name'                  => 'Type de Publications',
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
		'rewrite'               => array( 'slug' => 'type_de_publication' ),
	);

	register_taxonomy( 'publication_type', 'publication', $args );
}


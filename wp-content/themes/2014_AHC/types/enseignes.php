<?php
 function CPT_enseigne_init() {
  $labels = array(
    'name'               => 'Enseignes',
    'singular_name'      => 'Enseignes',
    'add_new'            => 'Ajouter Nouvelle',
    'add_new_item'       => 'Ajouter Nouvelle Enseigne',
    'edit_item'          => 'Editer une fiche',
    'new_item'           => 'Nouvelle Enseigne',
    'all_items'          => 'Toutes les Enseignes',
    'view_item'          => 'Voir une Fiche d\'Enseigne',
    'search_items'       => 'Rechercher Enseignes',
    'not_found'          => 'Aucune enseigne trouv&eacute;e',
    'not_found_in_trash' => 'Pas d\'Enseignes dans la Corbeille',
    'parent_item_colon'  => '',
    'menu_name'          => 'Enseignes'
  );
  $theme_url=get_bloginfo('template_directory');
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
	'taxonomies'		 => array('post_tag'),
    'rewrite'            => array( 'slug' => 'enseigne' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 7,
	'exclude_from_search'=> false,
	'menu_icon'			 =>  get_stylesheet_directory_uri().'/images/enseignes24x24.png',	
    'supports'           => array( 'author', 'editor', 'thumbnail','comments','custom-fields' )
  );

  register_post_type( 'enseigne', $args );
}
add_action( 'init', 'CPT_enseigne_init' );

?>

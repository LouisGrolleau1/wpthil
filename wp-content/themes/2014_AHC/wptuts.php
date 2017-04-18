<?php
add_shortcode( 'recent-posts', 'wptuts_recent_posts' );
function wptuts_recent_posts( $atts ) {
	extract( shortcode_atts( array(
		'numbers' => '5',
	), $atts ) );
	$rposts = new WP_Query(array('posts_per_page' => $numbers, 'orderby' => 'date'));
	if ( $rposts->have_posts() ) {
		$html = "<h3>Recent Posts</h3><ul class='recent-posts'>";
		while( $rposts->have_posts() ) {
			$rposts->the_post();
			$html .= sprintf( 
				"<li><a href='%s' title='%s'>%s</a></li>", 
				get_permalink($rposts->post->ID), 
				get_the_title(), 
				get_the_title() 
			);
		}
		$html .= "</ul>";
	}
	wp_reset_query();
	return $html;
}

/*add_shortcode('youtube','youtube_shortcode');
add_shortcode('vimeo','vimeo_shortcode');
add_shortcode('daily','daily_shortcode');*/

/*function youtube_shortcode($atts) {
$atts=shortcode_atts(array('id'=>'','height'=>'350', 'width'=>'500'),$atts);
extract($atts);
return
'<iframe src="//www.youtube-nocookie.com/embed/'.$id.'?HD=1;rel=0;showinfo=0;autoplay=0;modestbranding=0;controls=0" width="'.$width.'" height="'.$height.'"  frameborder="0" allowfullscreen></iframe>';
}

function vimeo_shortcode($atts) {
$atts=shortcode_atts(array('id'=>'','height'=>'350', 'width'=>'500'),$atts);
extract($atts);
return
'<iframe src="//player.vimeo.com/video/'.$id.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
}

function daily_shortcode($atts) {
$atts=shortcode_atts(array('id'=>'','height'=>'350', 'width'=>'500'),$atts);
extract($atts);
return
'<iframe src="http://www.dailymotion.com/embed/video/x181feh?hideInfos=0&background=d9470a" width="'.$width.'" height="'.$height.'" frameborder="0" ></iframe>';}


add_action( 'init', 'wptuts_buttons' );
function wptuts_buttons() {
	add_filter("mce_external_plugins", "wptuts_add_buttons");
    add_filter('mce_buttons', 'wptuts_register_buttons');
}	
function wptuts_add_buttons($plugin_array) {
	$plugin_array['wptuts'] = get_template_directory_uri() . '/js/wptuts-plugin.js';
	return $plugin_array;
}
function wptuts_register_buttons($buttons) {
	array_push( $buttons, 'youtube','vimeo','daily','lettrine', 'showrecent' ); //'recentposts
	return $buttons;
}*/
?>
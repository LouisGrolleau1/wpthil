<?php 
get_header();
$term=get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));
echo"<h1>Tous les ".$term->name."</h1>";
if(have_posts()) {
while (have_posts()){ 
	the_post();?>
	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2> 
    <div class='clear'></div> 
<?php	
}
}
twentyfourteen_paging_nav();

get_footer();


?>
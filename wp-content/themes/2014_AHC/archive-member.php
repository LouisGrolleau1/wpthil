<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<style>
.hero-unit {
  padding: 60px;
  /*margin:50px;*/
  margin-top:20px;
  margin-bottom:10px;
  /*margin-bottom: 30px;*/
  font-size: 18px;
  font-weight: 200;
  line-height: 30px;
  color:#F93;
  background-color:#e8e5ce;
  /*background-color: #eeeeee;*/
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
}
.hero-unit h1 {
  margin-bottom: 0;
  font-size: 60px;
  line-height: 1;
  color: inherit;
  letter-spacing: -1px;
}

.row-fluid {
  width: 100%;
  *zoom: 1;
  background-color:#f7f5e7;
}
.row-fluid:before,
.row-fluid:after {
  display: table;
  content: "";
  line-height: 0;
}
.row-fluid:after {
  clear: both;
}
.row-fluid [class*="span"] {
  display: block;
  width: 100%;
  min-height: 30px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  float: left;
  margin-left: 2.127659574468085%;
  *margin-left: 2.074468085106383%;
}
.row-fluid [class*="span"]:first-child {
  margin-left: 0;
}
.row-fluid .controls-row [class*="span"] + [class*="span"] {
  margin-left: 2.127659574468085%;
}
.row-fluid .span4 {
  width: 31.914893617021278%;
  *width: 31.861702127659576%;
}
</style>

<section id="primary" class="content-area">
	<div id="content" class="site-content" role="main" style="padding-left:15px;padding-top:0;">
		<h1 style="font-size:2em; font-weight:bold; color:black;padding:0;margin:0;margin-bottom:10px;">MEMBRES DE L'AHC</h1>

        <?php
		$args = array('post_type'=>'member','tax_query' => array(array('taxonomy' => 'member_type','field' => 'slug','terms' => array('membre','membre-du-bureau', 'membre-honoraire')
     )),  'posts_per_page'    =>  -1,  'meta_key' => 'member_lastname',  'order'             =>  'ASC',  'orderby'           =>  'meta_value');
		$the_query = new WP_Query( $args );

		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        	<!--<div class="resource_masterindex">-->
          		<?php
              	$member_last=get_field('member_lastname');
                $member_first=get_field('member_firstname');
                $member_name=$member_last.", &nbsp;".$member_first;
                $member_since=get_field('member_since');
                $member_type=get_field('member_taxo');
 
                ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $member_name; ?></a>

                <br/>                                   

		<?php 

        endwhile;	
        ?>
	
    </div><!-- #content -->
</section><!-- #primary -->
<?php get_sidebar( 'content' );?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
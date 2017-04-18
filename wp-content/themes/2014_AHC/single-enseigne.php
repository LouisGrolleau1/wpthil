

<?php get_header();?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main"  style='padding-left:10px;'>
        	<h1 style="font-size:2em; font-weight:bold; color:black;padding:0;margin:0;margin-bottom:10px;">ENSEIGNE</h1>
        	<?php while ( have_posts() ) : the_post(); ?>

<style>
.nbrcom {background:url(../wp-content/themes/twentythirteen/images/bkg-nbrcom.png)no-repeat;display: block;
width: 28px;
height: 31px;
float: right;
line-height: 20px;
padding-left: 7px;
margin-left:10px;
margin-top: 5px;
}
</style>

			<?php
			$name=get_field('enseigne_name');
			$period=get_field('enseigne_period');
			$founder=get_field('enseigne_founder');
			$owner=get_field('enseigne_owner');
			$other_denos=get_field('enseigne_all_denos');
			$history=get_field('enseigne_desc');
			
			echo "<div style='float:left;width:auto;margin-top:10px;'><h3 style='margin-bottom:5px;padding-bottom:0;display:inline;color:green;'>".$name."</h3>";
			/*comments_popup_link('0','1','%','nbrcom');*/
			echo "</div>";
			echo "<br clear='all'/>";
			echo $period."<br/>";
			/*echo "Enseigne fond&eacute;e par: ".$founder."<br/>";*/
			if(!empty($owner)) {echo "Propri&eacute;taire(s) actuel(s):&nbsp;".$owner."<br/>";}
			if (!empty($other_denos)){ echo "D&eacute;nominations successives, affiliations, etc...:&nbsp;".$other_denos."<br/>";}
			echo "<u><b>Histoire :</b></u><br/>";
			echo $history;
			/*echo "<br/><br/>";*/
			?>
            
            <!--<p class="date">Post&eacute; le <?php the_time('l d F'); ?>  dans <?php echo get_the_category_list(', '); ?></p>-->
   			<hr style="margin-top:0;margin-bottom:5px;">

            <a href="<?php echo site_url();?>/enseigne">Retour &agrave; la liste des enseignes</a>
				<?php comments_template('', true); ?>



            <?php endwhile;?>
            <br clear="all"/>

            <br/>
        </div>
        
    </div>
<?php 
get_sidebar( 'content' );
get_sidebar();
get_footer();
?>

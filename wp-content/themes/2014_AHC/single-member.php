<?php get_header();?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main"  style='padding-left:10px;'>
        	<h1 style="font-size:2em; font-weight:bold; color:black;padding:0;margin:0;margin-bottom:10px;">MEMBRE DE L'AHC</h1>
        	<?php while ( have_posts() ) : the_post(); ?>
				
				<?php 
				$member_last=get_field('member_lastname');
				$member_first=get_field('member_firstname');
				$member_name=$member_last.", &nbsp;".$member_first;
				$member_since=get_field('member_since');
				$member_type=get_field('member_taxo');
/*				echo "<pre>";
				print_r($member_type->name);
				echo "</pre>";*/
				
				$type=str_replace('s','',$member_type->name);
				$member_pix=get_field('member_pix');
				$member_infos_show=get_field('member_infos_show');
				$is_author=get_field('member_author2');
				$PostAuthor=get_field('member_author');
				$PostAuthorID=$PostAuthor['ID'];
				$misc_infos=get_field('misc_infos');
				$publications=get_field('member_publications');

				echo "<h3 style='margin-bottom:5px;padding-bottom:0; color:green; '>".$member_name."</h3>";?>             
                <br/>
				<?php if ($member_infos_show) {?>
                <div id="member_infos">
                <div style="float:left;">
                	<?php 
					if (!empty($member_pix)){?>
                    	<div style="float:left;">
							<img src="<?php echo $member_pix;?>" alt="<?php echo $member_name; ?>" style="margin-right:10px;max-width:100px;border:thin solid black ; "/>
                        </div>					
                    <?php
					}?>               
                    <div style="float:left;">
                		<?php echo $type;
						if (!empty($member_since)) {echo " depuis&nbsp;".year($member_since);}
						echo "<br/>";?>                        
                    </div>
                </div>               
				<?php
                if (!empty($misc_infos)) {?>
					<br clear='all'/>
                	<div style="float:left; margin-top:10px; margin-bottom:0;">
	                	<span style='font-weight:bold; font-size:1.2em;font-variant:small-caps;'>Activit&eacute;s</span>
                        <br/>
                        <?php echo $misc_infos;?>
                   </div>
				<?php 
				}
                if (!empty($publications)) {?>
					<br clear='all'/>
                	<div style="float:left; margin-top:0px;">
	                	<span style='font-weight:bold; font-size:1.2em;font-variant:small-caps;'>Publications</span>
                        <br/>
                        <?php echo $publications;?>
                   </div>
				<?php 
				}
				if ($is_author) {
					// related author posts 
					$arg="author='$PostAuthorID'"; 
					$query = new WP_Query($arg);
					if ( $query->have_posts() ) : ?>
						<br clear='all'/>
                		<div style="float:left; margin-top:0px;">
	                    	<span style='font-weight:bold; font-size:1.2em;font-variant:small-caps;'>Articles sur le site de l'AHC</span>
							<ul style="margin-top:5px;">
					  			<?php 
								while ( $query->have_posts() ) : $query->the_post();?>
    								<li><a href="<?php the_permalink(); ?>" style="text-decoration:none;"><?php the_title(); ?></a></li>
								 <?php endwhile; ?>
							</ul>
	  					</div>
	    			   <?php 
					   wp_reset_postdata();
					endif;?>
				<?php 
				} 
				?>
			</div>
		<?php 
		} 
		?>
		<?php 
		endwhile;?>
        <br clear="all"/>


            <br/>
        </div>
    </div>
    
<?php 
get_sidebar( 'content' );
get_sidebar();
get_footer();?>
<?php
function year($data) {
	$year=substr($data,strrpos($data,'/')+1,4);
	return $year;
}
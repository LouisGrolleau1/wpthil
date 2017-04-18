<?php
/**
 * Template Name: Member Logout Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
if (est_identifie()) {
	myEndSession();
	header('Location:deconnexion');
}
get_header(); ?>

<div id="main-content" class="main-content">


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" style="padding-left:15px;padding-top:0;">
			<h1 style="font-size:2em; font-weight:bold; color:black;padding:0;margin:0;margin-bottom:10px;">DECONNEXION</h1>
			<?php
				echo "Cher Abonn&eacute;,<br/><br/>Vous avez choisi de vous d&eacute;connecter de votre espace 'PREMIUM'.<br/>Si vous souhaitez n&eacute;anmoins continuer &agrave; y avoir acc&egrave;s, vous pouver vous reconnecter en cliquant <a href='logon'>ici</a>.";

			?>
		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

function login_form() {
?>
<br/>
<form action="<?php echo "logon";?>" enctype="application/x-www-form-urlencoded" method="post" >
	<input type="email" required id="member_email"  name="member_email">&nbsp;&nbsp;<input type="submit" value="Envoyer">
</form>	
<?php
}
function check_email($email_to_check){
	$url=site_url();
	$args=array('post_type'=>'member', 'posts_per_page'    =>  -1, 'meta_key' => 'member_email','meta_value'=>$email_to_check);
	$member = new WP_query($args);
	if ($member->have_posts()) { 
		while ( $member->have_posts() ) : $member->the_post(); 
			$member_last=get_field('member_lastname');
	    	$member_first=get_field('member_firstname');
	        $member_name=$member_last.", &nbsp;".$member_first;
		endwhile;
		
		/*session_start();
		if (! isset($_SESSION)) { $_SESSION = array();}*/
		$_SESSION['member'] = $member_first;
/*		$_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];		
		$_SESSION["url"] = $_SERVER['HTTP_HOST'];*/				
		echo "<br/>";
		echo "Bonjour $member_first,<br/>Vous avez d&eacute;sormais acc&egrave;s au contenu exclusif du site de l'AHC<br/>";
		echo "<ul>";
		echo "<li>Les <a href='".$url."/category/newsletter'>Newsletters</a></i>";
		/*echo "<li>Les d&eacute;tails de <a href='#'>vos coordonn&eacutes</a></li>";*/
		/*echo "<li>...</li>";*/
		echo "<ul>";


	} else {
		echo "Oups !<br/>Vous devez &ecirc;tre Membre de l'AHC pour acc&egrave;der aux services '<b/>PREMIUM</b>' (<i><a href='".$url."/adherer-2'>Adh&eacute;rer &agrave; l'AHC</a></i>).<br/>Ou bien vous avez d&ucirc; faire une erreur dans votre adresse mail !";		
		echo "<a href='".$url."/logon'>Recommencer ?</a>";
	}


}

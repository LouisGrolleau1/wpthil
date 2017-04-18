<?php 
require('Connections/wp_posts.php');

?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<title>AHC : Mise à Jour de la Liste Abonnés à la Newsletter</title>
</head>

<body>


<h1>Mise à jour de la base  de données des abonnés à la Newsletters de l'AHC: </h1>

<?php 
if (!isset($_POST['go'])) {?>
<form enctype="application/x-www-form-urlencoded" method="post" />
Cette liste des abonnés ne comprend QUE les membres de l'AHC, et parmi ceux-ci, que ceux qui ont une adresse mail valide.
Le présent programme effectue les tâches suivantes:
<ol>
	<li>Sauvegarde de l'ancienne liste des abonnés - <i>celle qui a servi à l'envoi des NL précédentes</i> - ;</li>
	<li>Re-création d'une nouvelle liste, - <i>qui tiendrait compte des modifications éventuelles  de la base des membres...</i> - ;
	<li>Liste des membres qui n'auraient pas été repris en tant qu'abonnés (pas de mails, ou d'adresse mail valide...)</i>
</ol>
<br/>
<input type="submit" value="On y va ?" id="go" name="go"/>
</form>
<?php
} else {
	echo "<h2>1 - Sauvegarde de la base actuelle des abonnés";
	$table='abonnes'.date("YmdHis");
	$sql_save1="CREATE TABLE ".$table." (
`user_id` int( 10 ) unsigned NOT NULL AUTO_INCREMENT ,
`wpuser_id` int( 10 ) unsigned NOT NULL DEFAULT '0',
`email` varchar( 255 ) NOT NULL ,
`firstname` varchar( 255 ) NOT NULL DEFAULT '',
`lastname` varchar( 255 ) NOT NULL DEFAULT '',
`ip` varchar( 100 ) NOT NULL ,
`confirmed_ip` varchar( 100 ) NOT NULL DEFAULT '0',
`confirmed_at` int( 10 ) unsigned DEFAULT NULL ,
`last_opened` int( 10 ) unsigned DEFAULT NULL ,
`last_clicked` int( 10 ) unsigned DEFAULT NULL ,
`keyuser` varchar( 255 ) NOT NULL DEFAULT '',
`created_at` int( 10 ) unsigned DEFAULT NULL ,
`status` tinyint( 4 ) NOT NULL DEFAULT '0',
`domain` varchar( 255 ) DEFAULT '',
PRIMARY KEY ( `user_id` ) ,
UNIQUE KEY `EMAIL_UNIQUE` ( `email` )
)";
	$query_save1=mysql_query($sql_save1);

	$sql_save2="INSERT INTO ".$table."SELECT *FROM wp_wysija_user";
	$query_save2=mysql_query($sql_save2);
	
	$sql_save3="TRUNCATE TABLE wp_wysija_user";
	$query_save3=mysql_query($sql_save3);
	
	echo " &radic;</h2>";


$sql="SELECT DISTINCT  wp_posts.ID,  wp_postmeta.meta_value FROM wp_postmeta, wp_posts WHERE wp_posts.post_type='member' AND wp_posts.post_status='publish' AND wp_postmeta.post_id=wp_posts.ID AND wp_postmeta.meta_key IN ('member_email', 'member_lastname','member_firstname') ORDER BY wp_posts.ID";
$query=mysql_query($sql);
$req=mysql_fetch_array($query);
$previous=0;
$line=0;
$data=array();
$no_email=0;
$no_email_data=array();
$wrong_email=0;
$wrong_email_data=array();
$correct=0;
echo "<h2>2 - Liste des membres passés en revue:</h2>";
echo "<div style='height:200px;width:500px; color:darkblue; background-color:lightgrey; overflow:auto; border: thin solid darkblue;padding:5px;'> ";
do {

	$data[]=$req['meta_value'];
	$line++;
	if ($line==3) {
		$domain=explode('@',$data[0]);
		if (empty($data[2])) {
			$no_email++;
			$comment="Pas d'adresse mail";
			$format="<span style='font-weight:bold;' >".$data[1]." ".$data[0]."<span style='color:red;'>".$comment."</span></span><br/>";
			$no_email_data[]=$data[1].", ".$data[0];
		}	else {
			if (($domain[1]=="a.com") OR ($domain[1]=="a")){
				$wrong_email++;
				$comment=" Adresse mail erronnée";
				$format="<span style='font-weight:bold;' >".$data[2]." ".$data[1]."<span style='color:red;'>".$comment." :  ".$data[0]."</span></span><br/>";				
				$wrong_email_data[]=$data[2].", ".$data[1].": ".$data[0];
				
			} else {
			 	$correct++;
			 	$comment="";
				$format=$data[2]." ".$data[1]." </span>";
				$sql2="INSERT INTO wp_wysija_user (email, firstname, lastname,domain) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$domain[1]."')";
				/*echo $sql2."<br/>";*/
				$query2=mysql_query($sql2);
				$format.= " <span style='font-weight:bold;color:green; '>&radic;</span><br/>";
			}
		}
		echo $format;
		$line=0;
		unset($data);

	}
} while($req=mysql_fetch_array($query));
echo "</div>";
echo "<h2>3 - Revue</h2>";
 echo "<ul>";
 echo "<li>".$correct." Membres abonnés</li>";
 
 echo "<li>". $no_email." Membres sans adresse mail</li>";
  if ($no_email<>0) {
 	echo "<ul>";
	foreach ($no_email_data as $errors) {
		echo "<li>".$errors."</li>";
	}
	echo "</ul>";
 }

 echo "<li>".$wrong_email." adresses mails erronnées";
 
 if ($wrong_email<>0) {
 	echo "<ul>";
	foreach ($wrong_email_data as $errors) {
		echo "<li>".$errors."</li>";
	}
	echo "</ul>";
 }
 
 }
?>
</body>
</html>
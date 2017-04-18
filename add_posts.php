<?php
require('Connections/wp_posts.php');
?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1">
<title>Saisie 'au Kilometre' des articles anciens</title>
</head>
<style media="all" type="text/css">
body {background-color:#090; color:#FFF;}
form {background-color:#03C;color:#FFF;padding:10px; margin:10px; border-radius:5px;width:50%}
</style>
<body>

<h1>Saisie 'au kilom�tre' des articles anciens</h1>

<?php
if (isset($_POST['submit'])) {
	$name=str_replace(' ','-',strtolower($_POST['post_title']));
	$name=str_replace("'","-",$name);
	$title=str_replace("'","-",$_POST['post_title']);
	$content=$_POST['post_content'];
	$post_date="2006-01-15";
	$sql="INSERT INTO wp_posts_tests (
		post_title, 
		post_name, 
		post_content, 
		post_date,
		post_date_gmt, 
		post_modified, 
		post_modified_gmt,
		post_status,
		post_author
		) VALUES (
		'$title', 
		'$name', 
		'$content', 
		'$post_date', 
		'$post_date', 
		'$post_date', 
		'$post_date', 
		'draft',
		1
		)";
		

	$query=mysql_query($sql) or die(mysql_error());
	$post_id=mysql_insert_id();
	$sql_update_guid="UPDATE wp_posts_tests SET guid='http://ahc-asso.com/?p=".$post_id."' WHERE ID='".$post_id."'";
	$update_query=mysql_query($sql_update_guid) or die(mysql_error());
	$sql_update_cat="INSERT INTO wp_term_relationships_tests (object_id, term_taxonomy_id) VALUES ('$post_id','346')";
	if( $query_update_cat=mysql_query($sql_update_cat)) {
		echo "<br/>L'article <b><i>$_POST[post_title]</i></b>  a bien �t� rajout�<br/>Un autre article � saisir..?<br/>";
		show_form();
	} else {
		echo "Erreur";
	}
} else {
	show_form();?>
	
    <?php
}
?>
</body>
</html>
 <?php
function remove_accent($str)
{
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
                'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
                'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
                'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
                'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
                'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
                'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
                'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
                'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 
                'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 
                'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
                'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
                'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
                'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
                'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
                'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
                'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
                'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
                'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
                's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
                'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
                'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
} 

function show_form() {
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="application/x-www-form-urlencoded" method="post">
		<label for="post_title"><h2>Titre de l'article:</h2>
	    	<input type="text" id="post_title" name="post_title" style="width:50%"/>            
        </label>
        <br/>
		<br/>
    	<label for="post_content"><h2>Article:</h2>
        	<textarea cols="100" rows="10" id="post_content" name="post_content" style="width:90%;" ></textarea>
    	</label>
        <br/>
		<br/>
		<!--		
		<label for="post_name">Post Name: &nbsp;
	    	<input type="text" id="post_name" name="post_name"/>
        </label>
		<br/>		<
		label for="post_date">Post Date: &nbsp;
	    	<input type="date" id="post_date" name="post_date"/>
        </label>
     	-->   
		<br/>
        <br/>
        <input type="submit" id="submit" name="submit" value="Envoyer">
    </form>
<?php

}
?> 
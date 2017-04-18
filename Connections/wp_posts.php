<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"


$host=$_SERVER['REMOTE_ADDR'] ;
if ($host=="127.0.0.1") {
	$hostname_wp_posts = "localhost";
	$database_wp_posts = "ahcasso";
	$username_wp_posts = "root";
	$password_wp_posts = "";
} else {
	$hostname_wp_posts = "sql5";
	$database_wp_posts = "ahcasso";
	$username_wp_posts = "ahcasso";
	$password_wp_posts = "yfyfyf";
}	



$wp_posts = mysql_pconnect($hostname_wp_posts, $username_wp_posts, $password_wp_posts) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_wp_posts);

?>
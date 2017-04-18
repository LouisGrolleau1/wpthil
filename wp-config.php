<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'ahcasso');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7wU6iNzVHmn7rNdg<N+h D|t:lj)Z{31NzT0n(x+|-@8J+b-4O`HK hDR n<3_aZ');
define('SECURE_AUTH_KEY',  'R>{wi$sb|i#@)$X$^<PnjR=<QLw>Sk7;$z@*$VTLSRj137:H9Rp+OhEQC3^}2@%O');
define('LOGGED_IN_KEY',    'O.(`ze;xF0huc|qPu}h)qOt)X5-itOcAEl>wt_2}.f8mvO>b<-z+wkYp!Nl*}r+[');
define('NONCE_KEY',        'B{j&Lbkd-oWVNam*eo$+Ua&%.,?f(+O.p$3ye@-*Y%#*VtWZMW%Qq!EyF<2B|-rh');
define('AUTH_SALT',        'L:E3_~*ZUY19Qw<WW-<01jJG*d4|v4(frU+`/VJI9_#Q1vza2|X%lKD;V:}q6&Zx');
define('SECURE_AUTH_SALT', 'O8;/s*pm+F++f:uEm$et]hUwj?1eKH`<:k]i`Fg)|Ezh;v}7q~N; cDWQWVzXhRI');
define('LOGGED_IN_SALT',   'S9ev4A~%~Plh?[~dlEod9^x%rPZ0}Phpe8d5QI5fr#Zc|!+cXc$i`_T-mIN;65S#');
define('NONCE_SALT',       'Y`1]0|Z&]#GCT/Zy&T5V}zP)X4n{1+5<CaMV6m6DJdTi1A_8)BN>9.B;m8;|PVeE');

define('WP_CACHE', true); // Added by WP Rocket
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

?>
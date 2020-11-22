<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '/nfs/c11/h02/mnt/199427/domains/clothoo.com/html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define( 'DB_NAME', 'dfngroup_designvarsityjackets' );

/** MySQL database username */
define( 'DB_USER', 'dfngroup_main' );

/** MySQL database password */
define( 'DB_PASSWORD', 'R4S1fH+I,WUW' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'IXm(_nRJ-Y^rotc>LM/f*-D;=hvK_hz+wDN=$-tO<0rW+CVdP:RF9d:duZXQ+cF2');
define('SECURE_AUTH_KEY',  '5Fq17eF}6g|^Q[rU@:&f~#kM0-H]&{Tg?!NAM- ;KM*6oQ^gSNXkt3>fC|q?]5.-');
define('LOGGED_IN_KEY',    'V~:@*Cxn)N0*U|Q`A6DY0STqV2a:!:XwxafqwJ|5==|:13?wO$j9k<d,PH<YpSX ');
define('NONCE_KEY',        '#C5R^z4o>,(UR-U[u1j1KQse#?T;wD^b|K(i30swzHFj-U}|CLF>T)jjz<T;vk]g');
define('AUTH_SALT',        'wcHSLN+xvl_M4)fM| DN5o/yK+u.dSZlcp?6`xz&!@/nf//L%h0@,1YQrE/Huo0U');
define('SECURE_AUTH_SALT', 'XZQAP4J[cTjYwFUo8HuE?RUy}=d3i$v-Bi>T6re7jFlt%$.;`tuz?])La|=]:8!!');
define('LOGGED_IN_SALT',   '9^FXHJl(7o+_~F6DVP`(r!Dj*E9<VA.m(}jAv9@-b%I{hY>zVjY3@_!_^tg|K:|9');
define('NONCE_SALT',       ' ]r$wU6F:d?#?NPc]?wMr/HzU^~z6w$7.P!I0K&s~}tfN,gPv*$N,5gO|]Yq?yux');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

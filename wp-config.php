<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'foodorder' );

/** Database username */
define( 'DB_USER', 'huydien' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'f_hJ&d2Dy-U*H&5CDNzG{**jlKU/+k~rceu{ZAD?:9ZV=dvr{w1~ o7)R,rO_Lfh' );
define( 'SECURE_AUTH_KEY',  'yZ6gpfD6^#;4a,+fH%`[EhY_=G=De~}/-@D?$!0Zyym?j:T8KUXnqhUs,5{LS)s8' );
define( 'LOGGED_IN_KEY',    'd4(9@/zYE<Qfuu6j_~FHTS/xY<3W^J#ctGq)^@`& jH-3jK]~PrhPwE%5bxO.X<@' );
define( 'NONCE_KEY',        '.dAj{(cy=NDC_y~=]XVa@``|?/miI4T4@._ffdRA(QJv@ (NU$7dEGD2/aE<3mZs' );
define( 'AUTH_SALT',        '=;+2=FUhK$q[$tMBhtv+bQ_R~-8O/4$l 1U|,u/JzbJ7HxU`I9jE?qsN(oY_KcBG' );
define( 'SECURE_AUTH_SALT', '!r= U$aaA@./#(6AKSc+B=S]EiTpo#5G%}MtL<$`!Cj)lVs4(1*On)+:>{*2C/w^' );
define( 'LOGGED_IN_SALT',   'F,>(UDPH)|nm=Y_qB0.iG;bqC3v)=/FsfHoi2C]4m=2rl]r2nluc8QCII1f/.g%g' );
define( 'NONCE_SALT',       '3vRz(!xpczG78}t1_!g:H/8a8>=!t2%zG-,|(lV:@5kVQkoKa,vt6^~a>sA&$)~b' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

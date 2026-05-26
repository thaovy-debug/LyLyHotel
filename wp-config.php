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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'if0_41936068_lyly_db');

/** Database username */
define('DB_USER', 'if0_41936068');

/** Database password */
define('DB_PASSWORD', 'lylyhotel');

/** Database hostname */
define('DB_HOST', 'sql311.infinityfree.com');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



// --------------------------------------------------------------------------------------
//** Database settings - You can get this info from your web host ** //
// /** The name of the database for WordPress */
// define('DB_NAME', 'lyly_db');

// /** Database username */
// define('DB_USER', 'root');

// /** Database password */
// define('DB_PASSWORD', '');

// /** Database hostname */
// define('DB_HOST', 'localhost');

// /** Database charset to use in creating database tables. */
// define('DB_CHARSET', 'utf8mb4');

// /** The database collate type. Don't change this if in doubt. */
// define('DB_COLLATE', '');



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
define('AUTH_KEY', 'PsNk.GKD/5-fir;j{qPMo:K7Gn5Nhv|cOQ&%^d`/h[ZG1:&v( C97DJdHk<li^yI');
define('SECURE_AUTH_KEY', 'grhVe!~Q)pcW{%#BaWd{n<=JL>+q#Cpe:?W&>B3Qw~?qAQc&j]1}f1U{4wuih8,@');
define('LOGGED_IN_KEY', '%Lw-:<w`{y9.h8Al6.$pU]-[n1*|#*VC4VC (ipz#bJh6#KJIbnDi8GV@~Jy4Lkw');
define('NONCE_KEY', 'ww~%[OxLBW#~nm+CMDgeGK9M+hb1sjX)qa;=l9zfc:EWmj7@.&6T6F_8}ijb1/MQ');
define('AUTH_SALT', 'wy<MZdmzEVfen2!%N1fl?N|SWpiU4u3Xt+}.ZXpu%b%bNphM>-%|oQ%ijHXrN ][');
define('SECURE_AUTH_SALT', 'C64hFs?{b`^eE461)>!Bq?w6`t_UKe$49pS1!_-}YCF8K]=QTT?MWw+kqdkCSLmz');
define('LOGGED_IN_SALT', 'K;{g=Zl*r=[J<dAANe8Z(o8Vs/Qqw]89?32uqGk._Ify#[rcUSvHvTDfwgL^r6Ph');
define('NONCE_SALT', 'Unu;ir$V<^04?,CRVcE7em:5gW^NVrHIB?>:wi@bIMW0,8&,-4*zyK.<&F/Q&vLw');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

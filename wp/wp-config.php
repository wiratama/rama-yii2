<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'grandist_wp_db');

/** MySQL database username */
define('DB_USER', 'grandist_user');

/** MySQL database password */
define('DB_PASSWORD', 'mygrandist_');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '&_wmU-A+?dl=-!tOEd*C`MAQ3h8A{J|1nT(BOHs(/+A%`veFpOyV=.i;aRX^&j h');
define('SECURE_AUTH_KEY',  '[,p=+}-{5rrZV=+;)n+!Lg5msusB#g -KT!^tS]|= l$V&efwa3f=OdNQ&]+GHIW');
define('LOGGED_IN_KEY',    'go]--9/%!K)8k*%5sJyQPp+_bp],}H1ixxG50{]Hk<fP]0/A[S3|x|>~@Q&d39&w');
define('NONCE_KEY',        't.nq+{5][DHI2,GfRe7rsVy+)mi*&Tro<~yHU|aF~](v&iQO*!0_y[h*}9O7w-<,');
define('AUTH_SALT',        'pUE5ioWcZH]@n*/T,c<35c^v0S)l=tQl-2+5K68rlO4/IFA`--7nWo?_Vx15V|1K');
define('SECURE_AUTH_SALT', 'xE|b<Fs,IXU5u+>!Js=$ww9|^:Krn:}?Ulo7&,|!7 YPOW4ZEtv&#N2(Xv.:#xtl');
define('LOGGED_IN_SALT',   'Y+-nd<}W20*A0ei]50&O0`qwv/=Of+|$EQ@NiICMQA2U$8>5B--EpIH&,HDrA@#|');
define('NONCE_SALT',       'YjHahRNze,zSV5^N#[zVF<xZ1QSrw<n:!T?-o+elp7s~ffU|_52w-w75!GB$#;o-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_grandistanarama';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

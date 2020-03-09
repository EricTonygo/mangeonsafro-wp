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
define( 'DB_NAME', 'mangeonsafrowpdb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'unhomme90' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'SDXLLHey5 [/Iqw)[DbYvBe}94<zR>ZJ{wKqC*LEU,%TkH*qd0hAhLcg<XxbwB54' );
define( 'SECURE_AUTH_KEY',  '356C@+S31/C|P Vs$ap_9CKUpua/k*>y&!$o%nI[H1w_gYa,^0QkX6j$m8^V!$-~' );
define( 'LOGGED_IN_KEY',    'EVR@r>Yx|.}TY<eM4pyq5v8|8rs99&laT}h:(=O}EyJp$1st,mVCy^IY~0J5NISe' );
define( 'NONCE_KEY',        'QJ)GOz#R?<@&2:]>A#P)quNU!1E{[ PSM2|TP4At&2+z;:@qEIb}4c[K+CmlquM2' );
define( 'AUTH_SALT',        'NX[h.N:{Y@q?.oq> %hyHl.n[j<bS9e2Evkz^oy^6QU?8007i#Alw#cP 9y+H%KI' );
define( 'SECURE_AUTH_SALT', '}y;H&c@)^+@l=?%pZSSvXw~RS[S<Cw@Rx(&GAJp4sNL/h{T7m`:QsE_T@(y04i@3' );
define( 'LOGGED_IN_SALT',   '1LBmu M^$X=Y7d~1h4wtXbdo^5h(~[iNC#pc4k@<}J(wMM01V*jG8fwrDNP({YIH' );
define( 'NONCE_SALT',       '+(.%^yBBqQ:(?:p=&.9tA;Ga@({}OS51=jb=+9~<7>MJLdR_{TKB+7;wxq+&Si+z' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ma_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

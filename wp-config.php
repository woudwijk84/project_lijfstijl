<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_default');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         ')<gd+;|K=%Z^;6jst+Q8=44]S+6(}<oXz^F.Gf.)f75UoI<b^z*-|f%?iGKT63S^');
define('SECURE_AUTH_KEY',  '*lFOFAS=zG#(gm@&x;&shT{^;bS]m=4_iLcPTdZN[%i_YljP%aJYh)=*t&K-tf9p');
define('LOGGED_IN_KEY',    'GQ<|/bTe:F,=v;i&vJ9fz>$GRg^R)V6~+h^yLPfb=Rw/+R!8z~0bA}@;S{=++R!T');
define('NONCE_KEY',        ':!?G3`Oo}pSq8ItI~pFgl:c!;ZL-DT;Lb&_sW3}oc`,dRz#/+TpMzaEo].X+xX|l');
define('AUTH_SALT',        '_AJ$+m0*4RuY$D+zo&[]!H:BD+2-I<}xU5$5Dyh>l^}n,a)49CSs3dH#=OKsNj%z');
define('SECURE_AUTH_SALT', '+#@1hg-|z}I0 $i`paMF.2M$tzbWA_H}&}*>^3jC?(AJ^) CW|rDJ[pFi1+ml@AT');
define('LOGGED_IN_SALT',   '}VJ-((c$hkk`V>3+ie!+(sQVcr!m[-pZRPMQrs?qL ]GR#+9<@S]H(yjB.uFJ3]K');
define('NONCE_SALT',       'BcatvA9|9R$@rz,}*N3EBAKX]k`-!VA=N??|6Z|hS!^,r|gH&/*.B|I$s8UZOc<4');


$table_prefix = 'wp_';


// Match any requests made via xip.io.
if ( isset( $_SERVER['HTTP_HOST'] ) && preg_match('/^(local.wordpress.)\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(.xip.io)\z/', $_SERVER['HTTP_HOST'] ) ) {
	define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
	define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
}

define( 'WP_DEBUG', false );
// define( 'WP_DEBUG', true );



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

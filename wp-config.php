<?php
/**
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
// define('DB_NAME', 'protony_db');
define('DB_NAME', 'protonyprueba');

/** Tu nombre de usuario de MySQL */
// define('DB_USER', 'root');
define('DB_USER', 'admin9hVe84D');

/** Tu contraseña de MySQL */
// define('DB_PASSWORD', '');
define('DB_PASSWORD', 'HXuiCITcWNi-');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
// define('DB_HOST', 'localhost');
define('DB_HOST', 'http://protonyprueba-protony.rhcloud.com/');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');


/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '3d>fx9%<0)cf,j8=+A_v$uFWu+s[e`-ksS_X=i9OG|9C XB5rV.q}Dzl mF0mfj.');
define('SECURE_AUTH_KEY', '#0AQxz0bZ4N6aZbkXd[MEYV8([z~mV1T?88|ei;bq/s[VLx5,*7|.*kzZLyd(IBt');
define('LOGGED_IN_KEY', '<aOMf>=|o+m)t5Q`|{ [KH&,=*mhX[vR (XV_zk=}]Gp2Z1y,gL7|-?tgH-<)wDD');
define('NONCE_KEY', 'vB:8YxLUeEBdKzaF=-(-4=a-fW`I**m{V5}U_rsenX3{65rB)pFR?](S?mB.K9:l');
define('AUTH_SALT', 'KcJg-e3#LR/u?Qtna!CQ,u6|D$jCf]8qIT`]QyqUV~%&5XdIaRz}1,MD7}s:E-I&');
define('SECURE_AUTH_SALT', '6l3*E.#prZd|G8JCae|<TjG|[;vA^u2otIW]qKk_l47+,ab4FmOI``&JCPKRopX)');
define('LOGGED_IN_SALT', 'FVQ!}D5x`Xj;c^F-aXG!-C^%S@j;l*X.gZ{xxb#X$>+,}mo00OvgXT7vN66X.Ey2');
define('NONCE_SALT', ',axWv)eGYD:jM/hXb4.-i+&e;Z^bI/*IwYI;S#(Q &CPsLkPP|w4JFAw-*|!ql-^');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'prot_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


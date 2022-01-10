<?php 

session_start();

ob_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

$path   = str_replace('\\', '/', realpath(dirname(__FILE__)));
/**
**define __ROOT path
*/
define('__ROOT',$path);
/**
 ** define the site path 
 */
define('__SITE_PATH', realpath(dirname(__FILE__)));
/**
 ** define the modules path
 */
define('__MODULES_PATH', __ROOT . '/modules');
/**
 ** define the systems path
 */
define('__SYSTEMS_PATH', __ROOT . '/systems');



/**
 * include file config
 */
include __SYSTEMS_PATH.'/includes/Configs.php';
/**
 * include file databse
 */
include __SYSTEMS_PATH.'/includes/Database.php';

$DB = new Database($configs['database']);

/**
 * include file common
 */
include __SYSTEMS_PATH.'/includes/Functions.php';



/**
 * set up Error Report
 */
if (defined('ENV') && ENV == 'development') {
    /*
     * Initialize error reporting to a known set of levels.
     *
     * This will be adapted in wp_debug_mode() located in wp-includes/load.php based on WP_DEBUG.
     * @see http://php.net/manual/en/errorfunc.constants.php List of known error levels.
     */
    error_reporting(E_ALL);
}

/**
 * include file Controller
 */
include __SYSTEMS_PATH . '/core/Controller.class.php';

/**
 * include file Model
 */
include __SYSTEMS_PATH . '/core/Model.class.php';

/**
 * include file Router
 */
include __SYSTEMS_PATH . '/core/Request.class.php';

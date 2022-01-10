<?php

/**
 *define hostname ex :localhost 
 */
define('__DB_HOST','localhost');
/**
 *define username ex :root 
 */
define('__DB_USER','root');
/**
 *define password ex : 1234 
 */
define('__DB_PASSWORD','');
/**
 *define name database ex :myblog 
 */
define('__DB_NAME','myblog');

/**
 *define url site ex : http://nam.name.vn 
 */
define('__SITE_URL','http://localhost/myblog');


/**
 *define module default
 * dùng làm controller mặc định
 */
define('DEFAULT_MODULE','post');

/**
 *define ENV: development or deploy
 */
define('ENV','development');


/**
* config database
*/
$configs['database'] = [
    'hostname' => __DB_HOST,
    'user' => __DB_USER,
    'password' => __DB_PASSWORD,
    'dbname' => __DB_NAME
];

/**
* config meta
*/
$configs['meta'] = [
    'title' => 'Blog của tôi',
    'description' => 'Chào mừng bạn đến với blog của tôi',
    'keyword' => '' // Khỏi cần vì SEO giờ k quan tâm đến nó nữa mà quan tâm đến contents is king
];
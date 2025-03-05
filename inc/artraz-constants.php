<?php
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 *  * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'ARTRAZ_DIR_URI' ) ) {
    define('ARTRAZ_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'ARTRAZ_DIR_ASSIST_URI' ) ) {
    define( 'ARTRAZ_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'ARTRAZ_DIR_CSS_URI' ) ) {
    define( 'ARTRAZ_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Js File URI
if (!defined('ARTRAZ_DIR_JS_URI')) {
    define('ARTRAZ_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// Base Directory
if (!defined('ARTRAZ_DIR_PATH')) {
    define('ARTRAZ_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('ARTRAZ_DIR_PATH_INC')) {
    define('ARTRAZ_DIR_PATH_INC', ARTRAZ_DIR_PATH . 'inc/');
}

//ARTRAZ framework Folder Directory
if (!defined('ARTRAZ_DIR_PATH_FRAM')) {
    define('ARTRAZ_DIR_PATH_FRAM', ARTRAZ_DIR_PATH_INC . 'artraz-framework/');
}

//Hooks Folder Directory
if (!defined('ARTRAZ_DIR_PATH_HOOKS')) {
    define('ARTRAZ_DIR_PATH_HOOKS', ARTRAZ_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'ARTRAZ_DEMO_DIR_PATH' ) ){
    define( 'ARTRAZ_DEMO_DIR_PATH', ARTRAZ_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'ARTRAZ_DEMO_DIR_URI' ) ){
    define( 'ARTRAZ_DEMO_DIR_URI', ARTRAZ_DIR_URI.'inc/demo-data/' );
}
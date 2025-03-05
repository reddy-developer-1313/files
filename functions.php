<?php
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 *  * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/artraz-constants.php';

//theme setup
require_once ARTRAZ_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once ARTRAZ_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once ARTRAZ_DIR_PATH_INC . 'woo-hooks/artraz-woo-hooks.php';

// Woo Hooks Functions
require_once ARTRAZ_DIR_PATH_INC . 'woo-hooks/artraz-woo-hooks-functions.php';

// plugin activation
require_once ARTRAZ_DIR_PATH_FRAM . 'plugins-activation/artraz-active-plugins.php';

// theme dynamic css
require_once ARTRAZ_DIR_PATH_INC . 'artraz-commoncss.php';

// meta options
require_once ARTRAZ_DIR_PATH_FRAM . 'artraz-meta/artraz-config.php';

// page breadcrumbs
require_once ARTRAZ_DIR_PATH_INC . 'artraz-breadcrumbs.php';

// sidebar register
require_once ARTRAZ_DIR_PATH_INC . 'artraz-widgets-reg.php';

//essential functions
require_once ARTRAZ_DIR_PATH_INC . 'artraz-functions.php';

// helper function
require_once ARTRAZ_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once ARTRAZ_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once ARTRAZ_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// artraz options
require_once ARTRAZ_DIR_PATH_FRAM . 'artraz-options/artraz-options.php';

// hooks
require_once ARTRAZ_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once ARTRAZ_DIR_PATH_HOOKS . 'hooks-functions.php';


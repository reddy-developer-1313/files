<?php

/**
 * @Packge     : Artraz
 * @Version    : 1.0
 *  * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */


// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

if ( ! is_active_sidebar( 'artraz-blog-sidebar' ) ) {
    return;
}
?>

<div class="col-xxl-4 col-lg-5">
    <aside class="sidebar-area">
	    <?php dynamic_sidebar( 'artraz-blog-sidebar' ); ?>
	</aside>
</div>
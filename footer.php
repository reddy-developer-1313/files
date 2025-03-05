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
    *
    * Hook for Footer Content
    *
    * Hook artraz_footer_content
    *
    * @Hooked artraz_footer_content_cb 10
    *
    */
    do_action( 'artraz_footer_content' );


    /**
    *
    * Hook for Back to Top Button
    *
    * Hook artraz_back_to_top
    *
    * @Hooked artraz_back_to_top_cb 10
    *
    */
    do_action( 'artraz_back_to_top' );

    wp_footer();
    ?>
</body>
</html>
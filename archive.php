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
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook artraz_blog_start_wrap
    *
    * @Hooked artraz_blog_start_wrap_cb 10
    *  
    */
    do_action( 'artraz_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook artraz_blog_col_start_wrap
    *
    * @Hooked artraz_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'artraz_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook artraz_blog_content
    *
    * @Hooked artraz_blog_content_cb 10
    *  
    */
    do_action( 'artraz_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook artraz_blog_pagination
    *
    * @Hooked artraz_blog_pagination_cb 10
    *  
    */
    do_action( 'artraz_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook artraz_blog_col_end_wrap
    *
    * @Hooked artraz_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'artraz_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook artraz_blog_sidebar
    *
    * @Hooked artraz_blog_sidebar_cb 10
    *  
    */
    do_action( 'artraz_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook artraz_blog_end_wrap
    *
    * @Hooked artraz_blog_end_wrap_cb 10
    *  
    */
    do_action( 'artraz_blog_end_wrap' );

    //footer
    get_footer();
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

function artraz_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $artraz_sidebar_widget_title_heading_tag = artraz_opt('artraz_sidebar_widget_title_heading_tag');
    } else {
        $artraz_sidebar_widget_title_heading_tag = 'h3';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'artraz' ),
        'id'            => 'artraz-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'artraz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'artraz' ),
        'id'            => 'artraz-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'artraz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists( 'ReduxFramework' ) ){
        // footer widgets register
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 1', 'artraz' ),
           'id'            => 'artraz-footer-1',
           'before_widget' => '<div class="col-lg-6 col-xl-auto wow fadeInUp" data-wow-delay="0.1s"><div id="%1$s" class="widget footer-widget style2 %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 2', 'artraz' ),
           'id'            => 'artraz-footer-2',
           'before_widget' => '<div class="col-lg-6 col-xl-auto wow fadeInUp"  data-wow-delay="0.2s"><div id="%1$s" class="widget widget_nav_menu footer-widget style2 %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 3', 'artraz' ),
           'id'            => 'artraz-footer-3',
           'before_widget' => '<div class="col-lg-6 col-xl-auto wow fadeInUp"  data-wow-delay="0.3s"><div id="%1$s" class="widget footer-widget style2 %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 4', 'artraz' ),
           'id'            => 'artraz-footer-4',
           'before_widget' => '<div class="col-lg-6 col-xl-auto wow fadeInUp" data-wow-delay="0.4s"><div id="%1$s" class="widget footer-widget style2 %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Offcanvas Sidebar', 'artraz' ),
           'id'            => 'artraz-offcanvas',
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
           'after_widget'  => '</div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
    }
    if( class_exists('woocommerce') ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'artraz' ),
                'id'            => 'artraz-woo-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'artraz' ),
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
            )
        );
    }

}

add_action( 'widgets_init', 'artraz_widgets_init' );
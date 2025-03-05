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
        exit();
    }

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( artraz_meta('page_breadcrumb_area') ) ) {
            $artraz_page_breadcrumb_area  = artraz_meta('page_breadcrumb_area');
        } else {
            $artraz_page_breadcrumb_area = '1';
        }
    }else{
        $artraz_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );
    if( class_exists( 'ReduxFramework' ) ){
        $mt = '';
    }else{
        $mt = 'mt-0';
    }
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $artraz_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            echo '<div class="container th-container2">';
                echo '<div class="breadcumb-wrapper '.esc_attr($mt).'" id="breadcumbwrap">';
                    echo '<div class="breadcumb-content">';
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                            if( !empty( artraz_meta('page_breadcrumb_settings') ) ) {
                                if( artraz_meta('page_breadcrumb_settings') == 'page' ) {
                                    $artraz_page_title_switcher = artraz_meta('page_title');
                                } else {
                                    $artraz_page_title_switcher = artraz_opt('artraz_page_title_switcher');
                                }
                            } else {
                                $artraz_page_title_switcher = '1';
                            }
                        } else {
                            $artraz_page_title_switcher = '1';
                        }

                        if( $artraz_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $artraz_page_title_tag    = artraz_opt('artraz_page_title_tag');
                            }else{
                                $artraz_page_title_tag    = 'h1';
                            }

                            if( defined( 'CMB2_LOADED' )  ){
                                if( !empty( artraz_meta('page_title_settings') ) ) {
                                    $artraz_custom_title = artraz_meta('page_title_settings');
                                } else {
                                    $artraz_custom_title = 'default';
                                }
                            }else{
                                $artraz_custom_title = 'default';
                            }

                            if( $artraz_custom_title == 'default' ) {
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => esc_html( get_the_title( ) ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => esc_html( artraz_meta('custom_page_title') ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }

                        }
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                            if( artraz_meta('page_breadcrumb_settings') == 'page' ) {
                                $artraz_breadcrumb_switcher = artraz_meta('page_breadcrumb_trigger');
                            } else {
                                $artraz_breadcrumb_switcher = artraz_opt('artraz_enable_breadcrumb');
                            }

                        } else {
                            $artraz_breadcrumb_switcher = '1';
                        }

                        if( $artraz_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                            echo '<div class="breadcumb-menu">';
                                artraz_breadcrumbs(
                                    array(
                                        'breadcrumbs_classes' => 'nav',
                                    )
                                );
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
         if( class_exists( 'ReduxFramework' ) ){
            $mt = '';
            if (class_exists( 'woocommerce' ) && is_shop()){
            $breadcumb_bg_class = 'custom-woo-class';
            }elseif(is_404()){
                $breadcumb_bg_class = 'custom-error-class';
            }elseif(is_search()){
                $breadcumb_bg_class = 'custom-search-class';
            }elseif(is_archive()){
                $breadcumb_bg_class = 'custom-archive-class';
            }else{
                $breadcumb_bg_class = '';
            }
        }else{
            $mt = 'mt-0';
            $breadcumb_bg_class = '';
        }
        echo '<div class="container th-container2 z-index-common">';
            echo '<div class="breadcumb-wrapper '. esc_attr($mt . $breadcumb_bg_class).'">';
                    echo '<div class="breadcumb-content">';
                        if( class_exists( 'ReduxFramework' )  ){
                            $artraz_page_title_switcher  = artraz_opt('artraz_page_title_switcher');
                        }else{
                            $artraz_page_title_switcher = '1';
                        }

                        if( $artraz_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $artraz_page_title_tag    = artraz_opt('artraz_page_title_tag');
                            }else{
                                $artraz_page_title_tag    = 'h1';
                            }
                            if( class_exists('woocommerce') && is_shop() ) {
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_archive() ){
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_home() ){
                                $artraz_blog_page_title_setting = artraz_opt('artraz_blog_page_title_setting');
                                $artraz_blog_page_title_switcher = artraz_opt('artraz_blog_page_title_switcher');
                                $artraz_blog_page_custom_title = artraz_opt('artraz_blog_page_custom_title');
                                if( class_exists('ReduxFramework') ){
                                    if( $artraz_blog_page_title_switcher ){
                                        echo artraz_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $artraz_page_title_tag ),
                                                "text"  => !empty( $artraz_blog_page_custom_title ) && $artraz_blog_page_title_setting == 'custom' ? esc_html( $artraz_blog_page_custom_title) : esc_html__( 'Latest News', 'artraz' ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }else{
                                    echo artraz_heading_tag(
                                        array(
                                            "tag"   => "h1",
                                            "text"  => esc_html__( 'Latest News', 'artraz' ),
                                            'class' => 'breadcumb-title',
                                        )
                                    );
                                }
                            }elseif( is_search() ){
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => esc_html__( 'Search Result', 'artraz' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_404() ){
                                echo artraz_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $artraz_page_title_tag ),
                                        "text"  => esc_html__( 'Error Page', 'artraz' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_singular( 'product' ) ){
                                $posttitle_position  = artraz_opt('artraz_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }

                                if( $postTitlePos != true ){
                                    echo artraz_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $artraz_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $artraz_post_details_custom_title  = artraz_opt('artraz_product_details_custom_title');
                                    }else{
                                        $artraz_post_details_custom_title = __( 'Shop Details','artraz' );
                                    }

                                    if( !empty( $artraz_post_details_custom_title ) ) {
                                        echo artraz_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $artraz_page_title_tag ),
                                                "text"  => wp_kses( $artraz_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }else{
                                $posttitle_position  = artraz_opt('artraz_post_details_title_position');
                                $postTitlePos = false;
                                if( is_single() ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }
                                if( is_singular( 'product' ) ){
                                    $posttitle_position  = artraz_opt('artraz_product_details_title_position');
                                    $postTitlePos = false;
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }

                                if( $postTitlePos != true ){
                                    echo artraz_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $artraz_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $artraz_post_details_custom_title  = artraz_opt('artraz_post_details_custom_title');
                                    }else{
                                        $artraz_post_details_custom_title = __( 'Blog Details','artraz' );
                                    }

                                    if( !empty( $artraz_post_details_custom_title ) ) {
                                        echo artraz_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $artraz_page_title_tag ),
                                                "text"  => wp_kses( $artraz_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }
                        }
                        if( class_exists('ReduxFramework') ) {
                            $artraz_breadcrumb_switcher = artraz_opt( 'artraz_enable_breadcrumb' );
                        } else {
                            $artraz_breadcrumb_switcher = '1';
                        }
                        if( $artraz_breadcrumb_switcher == '1' ) {
                            if(artraz_breadcrumbs()){
                            echo '<div class="breadcumb-menu">';
                                artraz_breadcrumbs(
                                    array(
                                        'breadcrumbs_classes' => 'nav',
                                    )
                                );
                            echo '</div>';
                            }
                        }
                    echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }
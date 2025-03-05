<?php
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 *  * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $artraz_post_id = get_the_ID();

            // Get the page settings manager
            $artraz_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $artraz_page_settings_model = $artraz_page_settings_manager->get_model( $artraz_post_id );

            // Retrieve the color we added before
            $artraz_header_style = $artraz_page_settings_model->get_settings( 'artraz_header_style' );
            $artraz_header_builder_option = $artraz_page_settings_model->get_settings( 'artraz_header_builder_option' );

            if( $artraz_header_style == 'header_builder'  ) {

                if( !empty( $artraz_header_builder_option ) ) {
                    $artrazheader = get_post( $artraz_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $artrazheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $artraz_header_builder_trigger = artraz_opt('artraz_header_options');
                if( $artraz_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $artraz_global_header_select = get_post( artraz_opt( 'artraz_header_select_options' ) );
                    $header_post = get_post( $artraz_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    artraz_global_header_option();
                }
            }
        } else {
            $artraz_header_options = artraz_opt('artraz_header_options');
            if( $artraz_header_options == '1' ) {
                artraz_global_header_option();
            } else {
                $artraz_header_select_options = artraz_opt('artraz_header_select_options');
                $artrazheader = get_post( $artraz_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $artrazheader->ID );
                echo '</header>';
            }
        }
    } else {
        artraz_global_header_option();
    }
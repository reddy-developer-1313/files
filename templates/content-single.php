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

    artraz_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?>>
    <?php
        if( class_exists('ReduxFramework') ) {
            $artraz_post_details_title_position = artraz_opt('artraz_post_details_title_position');
        } else {
            $artraz_post_details_title_position = 'header';
        }

        $allowhtml = array(
            'p'         => array(
                'class'     => array()
            ),
            'span'      => array(),
            'a'         => array(
                'href'      => array(),
                'title'     => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'b'         => array(),
        );
        // Blog Post Thumbnail
        do_action( 'artraz_blog_post_thumb' );
        
        echo '<div class="blog-content">';

            // Blog Post Meta
            do_action( 'artraz_blog_post_meta' );

            if( $artraz_post_details_title_position != 'header' ) {
                echo '<h2 class="blog-title">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
            }

            if( get_the_content() ){

                the_content();
                // Link Pages
                artraz_link_pages();
            }
        echo '</div>';

        if( class_exists('ReduxFramework') ) {
            $artraz_post_details_share_options = artraz_opt('artraz_post_details_share_options');
            $artraz_display_post_tags = artraz_opt('artraz_display_post_tags');
            $artraz_author_options = artraz_opt('artraz_post_details_author_desc_trigger');
        } else {
            $artraz_post_details_share_options = false;
            $artraz_display_post_tags = false;
            $artraz_author_options = false;
        }
        
        $artraz_post_tag = get_the_tags();
        
        if( ! empty( $artraz_display_post_tags ) || ( ! empty($artraz_post_details_share_options )) ){
            echo '<div class="share-links clearfix">';
                echo '<div class="row justify-content-between">';
                    if( is_array( $artraz_post_tag ) && ! empty( $artraz_post_tag ) ){
                        if( count( $artraz_post_tag ) > 1 ){
                            $tag_text = __( 'Tags:', 'artraz' );
                        }else{
                            $tag_text = __( 'Tag:', 'artraz' );
                        }
                        if($artraz_display_post_tags){
                            echo '<div class="col-sm-auto">';
                                echo '<span class="share-links-title">'.$tag_text.'</span>';

                                echo '<div class="tagcloud style2">';
                                    foreach( $artraz_post_tag as $tags ){
                                        echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    }

                    /**
                    *
                    * Hook for Blog Details Share Options
                    *
                    * Hook artraz_blog_details_share_options
                    *
                    * @Hooked artraz_blog_details_share_options_cb 10
                    *
                    */
                    do_action( 'artraz_blog_details_share_options' );
                echo '</div>';
            echo '</div>';

            /**
            *
            * Hook for Blog Details author bio
            *
            * Hook artraz_blog_details_author_bio
            *
            * @Hooked artraz_blog_details_author_bio_cb 10
            *
            */
            do_action( 'artraz_blog_details_author_bio' );

            /**
            *
            * Hook for Blog Navigation
            *
            * Hook artraz_blog_details_post_navigation
            *
            * @Hooked artraz_blog_details_post_navigation_cb 10
            *
            */
            do_action( 'artraz_blog_details_post_navigation' );

        }    

        echo '</div>'; 

        /**
        *
        * Hook for Blog Details Comments
        *
        * Hook artraz_blog_details_comments
        *
        * @Hooked artraz_blog_details_comments_cb 10
        *
        */
        do_action( 'artraz_blog_details_comments' );

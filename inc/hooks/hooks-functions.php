<?php
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }


    // preloader hook function
    if( ! function_exists( 'artraz_preloader_wrap_cb' ) ) {
        function artraz_preloader_wrap_cb() {
            $preloader_display  =  artraz_opt('artraz_display_preloader');
            $artraz_preloader_btn_text        =  artraz_opt('artraz_preloader_btn_text');
            ?>
            <div class="th-cursor"></div>
            <?php
            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){?>
                    <div class="preloader">
                        <?php 
                            if( !empty( $artraz_preloader_btn_text ) ){
                                echo '<button class="th-btn style3 preloaderCls">'.esc_html( $artraz_preloader_btn_text ).'</button>';
                            }
                        ?>
                        <div class="preloader-inner">
                            <?php
                            if( ! empty( artraz_opt( 'artraz_preloader_img','url' ) ) ){
                                echo artraz_img_tag( array(
                                    'url'   => esc_url( artraz_opt( 'artraz_preloader_img','url' ) ),
                                    'class' => 'loader-img',
                                ) );  
                            }else{ ?>
                               <span class="loader"></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
            }else{ ?>
                <div class="preloader">
                    <button class="th-btn style3 preloaderCls"><?php echo esc_html__( 'Cancel Preloader', 'artraz' ) ?></button>
                    <div class="preloader-inner">
                        <span class="loader"></span>
                    </div>
                </div>
            <?php }
        }
    }

    // Header Hook function
    if( !function_exists('artraz_header_cb') ) {
        function artraz_header_cb( ) {
            get_template_part('templates/header');
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'artraz_back_to_top_cb' ) ) {
        function artraz_back_to_top_cb( ) {
            $backtotop_trigger = artraz_opt('artraz_display_bcktotop');
            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
                    echo '<div class="scroll-top">';
                        echo '<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
                        </svg>';
                    echo '</div>'; 
                }else{
                    
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('artraz_blog_start_wrap_cb') ) {
        function artraz_blog_start_wrap_cb() { ?>
            <section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">
                <div class="container">
                    <div class="row">
        <?php }
    }

    // Blog End Wrapper Function
    if( !function_exists('artraz_blog_end_wrap_cb') ) {
        function artraz_blog_end_wrap_cb() {?>
                    </div>
                </div>
            </section>
        <?php }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('artraz_blog_col_start_wrap_cb') ) {
        function artraz_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $artraz_blog_sidebar = artraz_opt('artraz_blog_sidebar');
                if( $artraz_blog_sidebar == '2' && is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-lg-8 order-lg-last">';
                } elseif( $artraz_blog_sidebar == '3' && is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('artraz_blog_col_end_wrap_cb') ) {
        function artraz_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('artraz_blog_sidebar_cb') ) {
        function artraz_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_blog_sidebar = artraz_opt('artraz_blog_sidebar');
            } else {
                $artraz_blog_sidebar = 2;
                
            }
            if( $artraz_blog_sidebar != 1 && is_active_sidebar('artraz-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('artraz_blog_details_sidebar_cb') ) {
        function artraz_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_blog_single_sidebar = artraz_opt('artraz_blog_single_sidebar');
            } else {
                $artraz_blog_single_sidebar = 4;
            }
            if( $artraz_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('artraz_blog_pagination_cb') ) {
        function artraz_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('artraz_blog_content_cb') ) {
        function artraz_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_blog_grid = artraz_opt('artraz_blog_grid');
            } else {
                $artraz_blog_grid = '1';
            }

            if( $artraz_blog_grid == '1' ) {
                $artraz_blog_grid_class = 'col-lg-12';
            } elseif( $artraz_blog_grid == '2' ) {
                $artraz_blog_grid_class = 'col-sm-6';
            } else {
                $artraz_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($artraz_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('artraz_footer_content_cb') ) {
        function artraz_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'artraz_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'artraz_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'artraz_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $artraz_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $artraz_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $artraz_footer_builder_trigger = artraz_opt('artraz_footer_builder_trigger');
                            if( $artraz_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $artraz_global_footer_select = get_post( artraz_opt( 'artraz_footer_builder_select' ) );
                                $footer_post = get_post( $artraz_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                artraz_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $artraz_footer_builder_trigger = artraz_opt('artraz_footer_builder_trigger');
                    if( $artraz_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $artraz_global_footer_select = get_post( artraz_opt( 'artraz_footer_builder_select' ) );
                        $footer_post = get_post( $artraz_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        artraz_footer_global_option();
                    }
                }
            } else { ?>
                <div class="footer-layout4 footer-sitcky">
                    <div class="copyright-wrap">
                        <div class="container">
                            <p class="copyright-text text-center"><?php echo sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Artraz.','artraz' ),esc_url('#'),__( 'Themeholy', 'artraz' ) ) ?></p>
                        </div>
                    </div>
                </div>
            <?php }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('artraz_blog_details_wrapper_start_cb') ) {
        function artraz_blog_details_wrapper_start_cb( ) {
            echo '<section class="th-blog-wrapper blog-details space-top space-extra-bottom">';
                echo '<div class="container">';
                    if( is_active_sidebar( 'artraz-blog-sidebar' ) ){
                        $artraz_gutter_class = 'gx-60';
                    }else{
                        $artraz_gutter_class = '';
                    }
                    // echo '<div class="row './/esc_attr( $artraz_gutter_class ).'">';
                    echo '<div class="row">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('artraz_blog_details_col_start_cb') ) {
        function artraz_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_blog_single_sidebar = artraz_opt('artraz_blog_single_sidebar');
                if( $artraz_blog_single_sidebar == '2' && is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-last">';
                } elseif( $artraz_blog_single_sidebar == '3' && is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('artraz-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('artraz_blog_post_meta_cb') ) {
        function artraz_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_display_post_author      =  artraz_opt('artraz_display_post_author');
                $artraz_display_post_tag   =  artraz_opt('artraz_display_post_tag');
                $artraz_display_post_date      =  artraz_opt('artraz_display_post_date');
                $artraz_display_post_comments      =  artraz_opt('artraz_display_post_comments');
            } else {
                $artraz_display_post_author      = '1';
                $artraz_display_post_tag   = '1';
                $artraz_display_post_date      = '1';
                $artraz_display_post_comments      = '0';
            }

            echo '<!-- Blog Meta -->';
                echo '<div class="blog-meta">';
                    if( $artraz_display_post_author ){
                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fas fa-user-circle"></i>'.esc_html__('by ','artraz').esc_html( ucwords( get_the_author() ) ).'</a>';
                    }
                    if( $artraz_display_post_date ){
                        echo '<a href="'.esc_url( artraz_blog_date_permalink() ).'"><i class="fas fa-calendar-alt"></i>';
                            echo '<time datetime="'.esc_attr( get_the_date( DATE_W3C ) ).'">'.esc_html( get_the_date() ).'</time>';
                        echo '</a>';
                    }
                    if( $artraz_display_post_comments ){
                        ?>
                        <a href="#"><i class="fa-solid fa-comment-dots"></i>
                            <?php 
                                if(get_comments_number() == 1){
                                    echo esc_html__('Comment(', 'artraz'); 
                                }else{
                                    echo esc_html__('Comments(', 'artraz'); 
                                }
                                echo get_comments_number(); ?>)</a>
                        <?php
                    }
                    if( $artraz_display_post_tag ){
                        $categories = get_the_category(); 
                        if(!empty($categories)){
                        echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'"><i class="fas fa-tags"></i>'.esc_html( $categories[0]->name ).'</a>';
                        }
                    }
                echo '</div>';
        }
    }

    // blog details share options hook function
    if( !function_exists('artraz_blog_details_share_options_cb') ) {
        function artraz_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_post_details_share_options = artraz_opt('artraz_post_details_share_options');
            } else {
                $artraz_post_details_share_options = false;
            }
            if( function_exists( 'artraz_social_sharing_buttons' ) && $artraz_post_details_share_options ) { ?>
                <div class="col-md-auto text-md-end">
                <span class="share-links-title"><?php echo __( 'Share:', 'artraz' ); ?></span>
                        <ul class="social-links">
                           <?php echo artraz_social_sharing_buttons(); ?>
                        </ul>
                    <!-- End Social Share -->
                </div>
            <?php }
        }
    }
    
    // blog details author bio hook function
    if( !function_exists('artraz_blog_details_author_bio_cb') ) {
        function artraz_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  artraz_opt( 'artraz_post_details_author_desc_trigger' );
            } else {
                $postauthorbox = '1';
            }
            if(  $postauthorbox == '1' ) {

                echo '<div class="blog-author">';
                    echo '<div class="auhtor-img">';
                         echo '<img src="'.esc_url( get_avatar_url( get_the_author_meta('ID') ) ).'" alt="img">';
                    echo '</div>';
                    echo '<div class="media-body">';
                        echo '<h4 class="name"><a class="text-inherit" href="cases.html">'.esc_html( ucwords( get_the_author() )).'</a></h4>';
                        echo '<p class="author-bio">'.get_the_author_meta( 'user_description', get_the_author_meta('ID') ).'</p>';
                        echo ' <ul class="social-links">';
                                $artraz_social_icons = get_user_meta( get_the_author_meta('ID'), '_artraz_social_profile_group',true );
                                if(!empty($artraz_social_icons)){
                                    foreach( $artraz_social_icons as $singleicon ) {
                                        if( ! empty( $singleicon['_artraz_social_profile_icon'] ) ) {
                                            echo '<li><a href="'.esc_url( $singleicon['_artraz_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_artraz_social_profile_icon'] ).'"></i></a></li>';
                                        }
                                    }
                                }
                        echo '</ul>';
                    echo '</div>';
             echo '</div>';

               
            }

        }
    }

     // Blog Details Post Navigation hook function
     if( !function_exists( 'artraz_blog_details_post_navigation_cb' ) ) {
        function artraz_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_post_details_post_navigation = artraz_opt('artraz_post_details_post_navigation');
            } else {
                $artraz_post_details_post_navigation = true;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

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

            if( $artraz_post_details_post_navigation && ! empty( $prevpost ) || !empty( $nextpost ) ) {
                echo '<div class="blog-navigation">';
                    echo '<div>';
                        if( ! empty( $prevpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'" class="nav-btn prev">';
                            if( class_exists('ReduxFramework') ) {
                                if (has_post_thumbnail( $prevpost->ID )) {
                                    echo get_the_post_thumbnail( $prevpost->ID, 'artraz_80X80' );
                                };
                            }
                                echo '<span class="nav-text">'.esc_html__( ' Previous Post', 'artraz' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';

                    echo '<a href="'.get_permalink( get_option( 'page_for_posts' ) ).'" class="blog-btn"><i class="fa-solid fa-grid"></i></a>';

                    echo '<div>';
                        if( ! empty( $nextpost ) ) {
                            echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'" class="nav-btn next">';
                                if( class_exists('ReduxFramework') ) {
                                    if (has_post_thumbnail($nextpost->ID)) {
                                        echo get_the_post_thumbnail( $nextpost->ID, 'artraz_80X80' );
                                    };
                                }
                                echo '<span class="nav-text">'.esc_html__( ' Next Post', 'artraz' ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        }
    }

    // Blog Details Comments hook function
    if( !function_exists('artraz_blog_details_comments_cb') ) {
        function artraz_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo artraz_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'artraz' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('artraz_blog_details_col_end_cb') ) {
        function artraz_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('artraz_blog_details_wrapper_end_cb') ) {
        function artraz_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('artraz_page_start_wrap_cb') ) {
        function artraz_page_start_wrap_cb( ) {
            
            if( is_page( 'cart' ) ){
                $section_class = "th-cart-wrapper space-top space-extra-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "th-checkout-wrapper space-top space-extra-bottom";
            }elseif( is_page('wishlist') ){
                $section_class = "wishlist-area space-top space-extra-bottom";
            }else{
                $section_class = "space-top space-extra-bottom";  
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('artraz_page_end_wrap_cb') ) {
        function artraz_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('artraz_page_col_start_wrap_cb') ) {
        function artraz_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_page_sidebar = artraz_opt('artraz_page_sidebar');
            }else {
                $artraz_page_sidebar = '1';
            }
            if( $artraz_page_sidebar == '2' && is_active_sidebar('artraz-page-sidebar') ) {
                echo '<div class="col-lg-8 order-last">';
            } elseif( $artraz_page_sidebar == '3' && is_active_sidebar('artraz-page-sidebar') ) {
                echo '<div class="col-lg-8">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('artraz_page_col_end_wrap_cb') ) {
        function artraz_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('artraz_page_sidebar_cb') ) {
        function artraz_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $artraz_page_sidebar = artraz_opt('artraz_page_sidebar');
            }else {
                $artraz_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $artraz_page_layoutopt = artraz_opt('artraz_page_layoutopt');
            }else {
                $artraz_page_layoutopt = '3';
            }

            if( $artraz_page_layoutopt == '1' && $artraz_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $artraz_page_layoutopt == '2' && $artraz_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('artraz_page_content_cb') ) {
        function artraz_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                artraz_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    if( !function_exists('artraz_blog_post_thumb_cb') ) {
        function artraz_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $artraz_post_slider_thumbnail = artraz_meta( 'post_format_slider' );

            if( !empty( $artraz_post_slider_thumbnail ) ){
                echo '<div class="blog-img th-blog-carousel">';
                    foreach( $artraz_post_slider_thumbnail as $single_image ){
                        echo artraz_img_tag( array(
                            'url'   => esc_url( $single_image )
                        ) );
                    }
                echo '</div>';
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                    }

                    the_post_thumbnail();

                    if( ! is_single() ){
                        echo '</a>';
                    }
                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && ! empty ( artraz_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-img">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail();
                        if( ! is_single() ){
                            echo '</a>';
                        }
                        echo '<a href="'.esc_url( artraz_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                            echo '<i class="fas fa-play"></i>';
                        echo '</a>';
                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo artraz_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $artraz_audio = artraz_meta( 'post_format_audio' );
                if( ! empty( $artraz_audio ) ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $artraz_audio );
                    echo '</div>';
                }elseif( ! is_single() ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $artraz_audio );
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists('artraz_blog_post_content_cb') ) {
        function artraz_blog_post_content_cb( ) {
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
            if( class_exists( 'ReduxFramework' ) ) {
                $artraz_excerpt_length          = artraz_opt( 'artraz_blog_postExcerpt' );
                $artraz_display_post_category   = artraz_opt( 'artraz_display_post_category' );
            } else {
                $artraz_excerpt_length          = '48';
                $artraz_display_post_category   = '1';
            }

            if( class_exists( 'ReduxFramework' ) ) {
                $artraz_blog_admin = artraz_opt( 'artraz_blog_post_author' );
                $artraz_blog_readmore_setting_val = artraz_opt('artraz_blog_readmore_setting');
                if( $artraz_blog_readmore_setting_val == 'custom' ) {
                    $artraz_blog_readmore_setting = artraz_opt('artraz_blog_custom_readmore');
                } else {
                    $artraz_blog_readmore_setting = __( 'Read Details', 'artraz' );
                }
            } else {
                $artraz_blog_readmore_setting = __( 'Read Details', 'artraz' );
                $artraz_blog_admin = true;
            }
            echo '<!-- blog-content -->';

                do_action( 'artraz_blog_post_thumb' );
                
                echo '<div class="blog-content">';

                    // Blog Post Meta
                    do_action( 'artraz_blog_post_meta' );

                    echo '<!-- Post Title -->';
                    echo '<h2 class="blog-title"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h2>';
                    echo '<!-- End Post Title -->';

                    echo '<!-- Post Summary -->';
                    echo artraz_paragraph_tag( array(
                        "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $artraz_excerpt_length, '' ), $allowhtml ),
                        "class" => 'blog-text',
                    ) );
  
                    if( !empty( $artraz_blog_readmore_setting ) ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn">'.esc_html( $artraz_blog_readmore_setting ).'</a>';
                    }

                    echo '<!-- End Post Summary -->';
                echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }

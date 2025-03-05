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
    exit;
}

 // theme option callback
function artraz_opt( $id = null, $url = null ){
    global $artraz_opt;

    if( $id && $url ){

        if( isset( $artraz_opt[$id][$url] ) && $artraz_opt[$id][$url] ){
            return $artraz_opt[$id][$url];
        }
    }else{
        if( isset( $artraz_opt[$id] )  && $artraz_opt[$id] ){
            return $artraz_opt[$id];
        }
    }
}


// theme logo
function artraz_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo 2" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= artraz_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !artraz_opt('artraz_text_title') && artraz_opt('artraz_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid" src="'.esc_url( artraz_opt('artraz_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'artraz' ).'" />';
        return '<a class="logo 3" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( artraz_opt('artraz_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( artraz_opt('artraz_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function artraz_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_artraz_'.$id, true );
    return $value;
}


// Blog Date Permalink
function artraz_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function artraz_iframe_match() {
    $audio_content = artraz_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function artraz_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function artraz_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'artraz' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'artraz' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function artraz_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function artraz_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function artraz_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function artraz_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'artraz_pingback_header' );


// Excerpt More
function artraz_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'artraz_excerpt_more' );


// artraz comment template callback
function artraz_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('th-comment-item') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="th-post-comment">
            <?php
                if( get_avatar( $comment, 100 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php endif; ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"><i class="far fa-calendar-alt"></i><?php printf( esc_html__('%1$s', 'artraz'), get_comment_date() ); ?> </span>
                <h3 class="name"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h3>

                <?php comment_text(); ?>
                <div class="reply_and_edit">
                    <?php
                        $reply_text = wp_kses_post( '<i class="fas fa-reply"></i> Reply', 'artraz' );

                        $edit_reply_text = wp_kses_post( '<i class="fas fa-pencil-alt"></i> Edit', 'artraz' );

                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 3, 'max_depth' => 5, 'reply_text' => $reply_text ) ) );
                    ?>  
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'artraz' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'artraz_body_class' );
function artraz_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $artraz_blog_single_sidebar = artraz_opt('artraz_blog_single_sidebar');
        if( ($artraz_blog_single_sidebar != '2' && $artraz_blog_single_sidebar != '3' ) || ! is_active_sidebar('artraz-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
        $new_class = is_page() ? artraz_meta('custom_body_class') : null;

        if ( $new_class ) {
            $classes[] = $new_class;
        }
    } else {
        if( !is_active_sidebar('artraz-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }
    return $classes;
}


function artraz_footer_global_option(){

    // Artraz Widget Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $artraz_footer_widget_enable = artraz_opt( 'artraz_footerwidget_enable' );
        $artraz_footer_bottom_active = artraz_opt( 'artraz_disable_footer_bottom' );
    }else{
        $artraz_footer_widget_enable = '';
        $artraz_footer_bottom_active = '1';
    }
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'i'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array(),
            'class'     => array(),
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
    );
    if( $artraz_footer_widget_enable == '1' || $artraz_footer_bottom_active == '1' ){
        $bg = artraz_opt('artraz_footer_background', 'background-image' );
        $footer_bg = $bg ? $bg : '#';

        echo '<footer class="footer-wrapper footer-layout4" data-bg-src="'.esc_url( $footer_bg ).'">';
            if( $artraz_footer_widget_enable == '1' ){
                if( ( is_active_sidebar( 'artraz-footer-1' ) || is_active_sidebar( 'artraz-footer-2' ) || is_active_sidebar( 'artraz-footer-3' ) )) {
                    echo '<div class="container">';
                        echo '<div class="widget-area">';
                                echo '<div class="row justify-content-between">';
                                    if( is_active_sidebar( 'artraz-footer-1' )){
                                    dynamic_sidebar( 'artraz-footer-1' ); 
                                    }
                                    if( is_active_sidebar( 'artraz-footer-2' )){
                                    dynamic_sidebar( 'artraz-footer-2' ); 
                                    }
                                    if( is_active_sidebar( 'artraz-footer-3' )){
                                    dynamic_sidebar( 'artraz-footer-3' ); 
                                    } 
                                    if( is_active_sidebar( 'artraz-footer-4' )){
                                    dynamic_sidebar( 'artraz-footer-4' ); 
                                    }  
                                echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }
            if( $artraz_footer_bottom_active == '1' ){
                echo '<div class="copyright-wrap">';
                    echo '<div class="container">';
                            echo '<p class="copyright-text text-center">'.wp_kses( artraz_opt( 'artraz_copyright_text' ), $allowhtml ).'</p>';
                    echo '</div>';
                echo '</div>';
            }

        echo '</footer>';
    }
}

// Social link
function artraz_social_icon(){
    $artraz_social_icon = artraz_opt( 'artraz_social_links' );
    if( ! empty( $artraz_social_icon ) && isset( $artraz_social_icon ) ){
        foreach( $artraz_social_icon as $social_icon ){
            if( ! empty( $social_icon['title'] ) ){
            $s_icon = '<i class="'.esc_attr( $social_icon['title'] ).'"></i>';
            }else{
                $s_icon = '';
            }
            if( ! empty( $social_icon['description'] ) ){
                echo '<li><a href="'.esc_url( $social_icon['url'] ).'">'.esc_attr( $s_icon ).''.esc_attr( $social_icon['description'] ).'</a></li>';
            }
        }
    }
}

// WP about us widget
function artraz_footer_social_icon(){
    $artraz_social_icon = artraz_opt( 'artraz_social_links2' );
    if( ! empty( $artraz_social_icon ) && isset( $artraz_social_icon ) ){
        foreach( $artraz_social_icon as $social_icon ){
                echo '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i>'.esc_attr( $social_icon['description'] ).'</a>';
            
        }
    }
}

// global header
function artraz_global_header_option() {

    if( class_exists( 'ReduxFramework' ) ){ ?>

        <?php 
        //Search popup
        echo artraz_search_box();
        //Mobile menu 
        echo artraz_mobile_menu();
        ?>

        <header class="th-header header-layout1 prebuilt">
        <?php
        
        if(artraz_opt('artraz_menu_icon')){
            $menu_icon = '';
        }else{
            $menu_icon = 'hide-icon';
        }

        echo artraz_header_menu_topbar();
        ?>
            <div class="sticky-wrapper">
                <div class="sticky-active">
                    <!-- Main Menu Area -->
                    <div class="menu-area">
                        <div class="container">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <?php echo artraz_theme_logo(); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <?php if( has_nav_menu( 'primary-menu' ) ): ?>
                                        <nav class="main-menu  <?php echo esc_attr($menu_icon); ?> d-none d-lg-inline-block">
                                        <?php wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) ); ?>
                                        </nav>
                                    <?php endif; ?> 
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
    <?php
    }else{
        echo artraz_global_header();
    }
}

if( ! function_exists( 'artraz_header_menu_topbar' ) ){
    function artraz_header_menu_topbar(){
        if( class_exists( 'ReduxFramework' ) ){
            $artraz_header_topbar_switcher  = artraz_opt( 'artraz_header_topbar_switcher' );
            $artraz_show_social_icon        = artraz_opt( 'artraz_header_topbar_social_icon_switcher' );
        
        }else{
            $artraz_header_topbar_switcher  = '';
            $artraz_show_search_field        = '';
        }

        if( $artraz_header_topbar_switcher ){
            $allowhtml = array(
                'a'    => array(
                    'href' => array(),
                    'class' => array()
                ),
                'u'    => array(
                    'class' => array()
                ),
                'span' => array(
                    'class' => array()
                ),
                'i'    => array(
                    'class' => array()
                )
            );
            $phone     = artraz_opt( 'artraz_topbar_phone' );

            $replace    = array(' ','-',' - ', '(', ')');
            $with       = array('','','');

            $phoneurl  = str_replace( $replace, $with, $phone );

            if(!empty(artraz_opt( 'artraz_topbar_phone_icon2' ))){
                $phone_icon2     = artraz_opt( 'artraz_topbar_phone_icon2' );
            }else{
                $phone_icon2 = '';
            } 

            ?>
            <div class="header-top">
                <div class="th-container container">
                    <div class="row justify-content-center justify-content-sm-between align-items-center">
                        <?php  if($artraz_show_social_icon ): ?>
                        <div class="col-auto">
                            <div class="header-links">
                                <ul>
                                    <?php echo artraz_social_icon(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( ! empty($phone ) ): ?>
                        <div class="col-auto d-none d-sm-block">
                            <div class="header-links">
                                <ul>
                                    <li><a href="<?php echo esc_attr( 'tel:'.$phoneurl ) ?>" class="header-call"><?php echo wp_kses_post($phone_icon2); ?><?php echo esc_html( $phone ); ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
         
        <?php
        }
    }
}

// artraz woocommerce breadcrumb
function artraz_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'artraz' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'artraz_woo_breadcrumb' );

function artraz_custom_search_form( $class ) {
    echo '<!-- Search Form -->';

    echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo artraz_img_tag( array(
                "url"   => esc_url( get_theme_file_uri( '/assets/img/search-2.svg' ) ),
                "class" => "svg"
            ) );
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'artraz').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'artraz_remove_tagcloud_inline_style',10,1 );
function artraz_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'artraz_cat_count_span' );
function artraz_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'artraz_archive_count_span' );
function artraz_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

//header search box
if(! function_exists('artraz_search_box')){
    function artraz_search_box(){
        echo '<div class="popup-search-box d-none d-lg-block">';
            echo '<button class="searchClose"><i class="fal fa-times"></i></button>';
            echo '<form role="search" method="get" action="'.esc_url( home_url( '/' ) ).'">';
                echo '<input value="'.esc_html( get_search_query() ).'" class="border-theme" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'artraz').'">';
                echo '<button type="submit"><i class="fal fa-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
}


// Artraz Default Header
if( ! function_exists( 'artraz_global_header' ) ){
    function artraz_global_header(){ ?>

        <?php 
        //Search popup
        echo artraz_search_box();
        //Mobile menu 
        echo artraz_mobile_menu();
        ?>

        <!--======== Header ========-->
        <header class="th-header header-layout1 unittest-header">
            <div class="sticky-wrapper">
                <div class="sticky-active">
                    <div class="menu-area">
                        <div class="container">
                            <div class="row gx-20 align-items-center justify-content-between">

                                <div class="col-auto">
                                    <div class="header-logo">
                                       <?php echo artraz_theme_logo(); ?>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <?php
                                    if( has_nav_menu( 'primary-menu' ) ) { ?>
                                        <nav class="main-menu d-none d-lg-inline-block">
                                            <?php
                                            wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) ); ?>
                                        </nav>
                                    <?php } ?>                                   
                                    </nav>
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                                </div>
                                <div class="col-auto d-none d-xl-block">
                                    <div class="header-button">
                                        <button type="button" class="icon-btn searchBoxToggler"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="logo-bg"></div>
                    <div class="menu-bg"></div>
                </div>
            </div>
        </header>
    <?php
    }
}


//header Offcanvas
if( ! function_exists( 'artraz_header_offcanvas' ) ){
    function artraz_header_offcanvas(){
        ?>
    <div class="sidemenu-wrapper d-none d-lg-block ">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
             <?php 
                if(is_active_sidebar('artraz-offcanvas')){
                    dynamic_sidebar( 'artraz-offcanvas' );
                }else{
                    echo '<h4 class="footer-info-title">No Widget Added </h4>';
                    echo '<p>Please add some widget in Offcanvs Sidebar</p>';
                }
            ?>
        </div>
    </div>

<?php
    }
}

//header Mobile Menu
if( ! function_exists( 'artraz_mobile_menu' ) ){
    function artraz_mobile_menu(){
        ?>
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <?php echo artraz_theme_logo(); ?>
            </div>
            <div class="th-mobile-menu">
                <?php 
                    if( has_nav_menu( 'primary-menu' ) ){
                        wp_nav_menu( array(
                            "theme_location"    => 'primary-menu',
                            "container"         => '',
                            "menu_class"        => ''
                        ) );
                    }
                ?>
            </div>

        </div>
    </div>

<?php
    }
}



// Blog post views function
function artraz_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function artraz_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'artraz' );
    }
    return $count;
}


// Add Extra Class On Comment Reply Button
function artraz_custom_comment_reply_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'artraz_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function artraz_custom_edit_comment_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'artraz_custom_edit_comment_link', 99);


function artraz_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        $classes[] = "th-blog blog-single has-post-thumbnail";
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }
    
    return $classes;
}
add_filter( 'post_class', 'artraz_post_classes', 10, 3 );

// Contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');
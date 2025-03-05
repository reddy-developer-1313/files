<?php
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $artraz404title     = artraz_opt( 'artraz_fof_title' );
        $artraz404subtitle     = artraz_opt( 'artraz_fof_subtitle' );
        $artraz404description  = artraz_opt( 'artraz_fof_description' );
        $artraz404btntext      = artraz_opt( 'artraz_fof_btn_text' );
    } else {
        $artraz404title     = __( '404', 'artraz' );
        $artraz404subtitle     = __( 'Sorry we can\'t find that page!', 'artraz' );
        $artraz404description  = __( 'The page you are looking for was moved, removed, renamed or never existed.', 'artraz' );
        $artraz404btntext      = __( ' Back To Home', 'artraz');

    }

    // get header
    get_header(); ?>

    <section class="space ">
        <div class="container">
            <div class="error-content text-center">
                <h2 class="error-number wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html( $artraz404title ); ?></h2>
                <h2 class="error-title wow fadeInUp" data-wow-delay="0.3s"><?php echo esc_html( $artraz404subtitle ); ?></h2>
                <p class="h6 error-text wow fadeInUp" data-wow-delay="0.4s"><?php echo esc_html( $artraz404description ); ?></p>
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="th-btn error-btn wow fadeInUp" data-wow-delay="0.5s"><span class="line left"></span><?php echo esc_html( $artraz404btntext ); ?><span class="line"></span></a>
            </div>
        </div>
    </section>

    <?php
    //footer
    get_footer();
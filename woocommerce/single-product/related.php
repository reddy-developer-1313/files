<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$artraz_woo_relproduct_display = artraz_opt('artraz_woo_relproduct_display');
$artraz_woo_relproduct_slider = artraz_opt('artraz_woo_relproduct_slider');

if(!empty($artraz_woo_relproduct_slider)){
    $slider_class = 'related-products-carousel';
}else{
    $slider_class = 'gy-30';
}

if ( $related_products && $artraz_woo_relproduct_display) : ?>

    <div class="space-top ">

        <div class="row gy-30">
            <?php
            if( class_exists('ReduxFramework') ) {
                $subtitle = artraz_opt('artraz_woo_relproduct_subtitle');
                $title = artraz_opt('artraz_woo_relproduct_title');
            }else{
                $subtitle = esc_html__('Synergistically scale maintainable platforms standards compliant niche markets. Efficiently develop excellent markets for focused networks.','artraz');
                $title = esc_html__('Related Shop','artraz');
            }
            ?>
             <div class="col-lg-12">
                <div class="text-center">
                    <p class=""><?php echo esc_html($subtitle) ?> </p>
                    <h2 class="sec-title"><?php echo esc_html($title) ?></h2>
                </div>
            </div>
        </div>


        <div class="row <?php echo esc_attr($slider_class); ?>" id="productSlide">

        <?php
            
            if( class_exists('ReduxFramework') ) {
                $artraz_woo_related_product_col = artraz_opt('artraz_woo_related_product_col');
                if( $artraz_woo_related_product_col == '2' ) {
                    $artraz_woo_product_col_val = 'col-xl-2 col-lg-4 col-sm-6 mb-30';
                } elseif( $artraz_woo_related_product_col == '3' ) {
                    $artraz_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
                } elseif( $artraz_woo_related_product_col == '4' ) {
                    $artraz_woo_product_col_val = 'col-xl-4 col-lg-4 col-sm-6 mb-30';
                } elseif( $artraz_woo_related_product_col == '6' ) {
                    $artraz_woo_product_col_val = 'col-lg-6 col-sm-6 mb-30';
                }
            } else {
                $artraz_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
            }
        ?>

            <?php foreach ( $related_products as $related_product ) : ?>
                <div class="<?php echo esc_attr($artraz_woo_product_col_val) ?>">
                    <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' );
                    ?>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif;

wp_reset_postdata();
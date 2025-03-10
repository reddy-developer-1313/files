<?php
/**
 * The Template for displaying dialog for message added to wishlist product.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-addedtowishlist-dialogbox.php.
 *
 * @version           2.5.0
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="tinvwl_added_to_wishlist tinv-modal tinv-modal-open">
	<div class="tinv-overlay"></div>
	<div class="tinv-table">
		<div class="tinv-cell">
			<div class="tinv-modal-inner">
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
				<div class="tinv-txt"><?php echo esc_html($msg); // WPCS: xss ok. ?></div>
				<div class="tinvwl-buttons-group tinv-wishlist-clear">
					<?php if ( isset( $wishlist_url ) ) : ?>
						<button class="button tinvwl_button_view tinvwl-btn-onclick th-btn"
								data-url="<?php echo esc_url( $wishlist_url ); ?>" type="button"><i
									class="ftinvwl ftinvwl-heart-o"></i><?php echo esc_html( apply_filters( 'tinvwl_view_wishlist_text', tinv_get_option( 'general', 'text_browse' ) ) ); ?>
						</button>
					<?php endif; ?>
					<?php if ( isset( $dialog_custom_url ) && isset( $dialog_custom_html ) ) : ?>
						<button class="button tinvwl_button_view tinvwl-btn-onclick"
								data-url="<?php echo esc_url( $dialog_custom_url ); ?>"
								type="button"><?php echo esc_html($dialog_custom_html); // WPCS: xss ok. ?></button>
					<?php endif; ?>
					<button class="button tinvwl_button_close th-btn" type="button"><i
								class="ftinvwl ftinvwl-times"></i><?php esc_html_e( 'Close', 'artraz' ); ?>
					</button>
				</div>
				<div class="tinv-wishlist-clear"></div>
			</div>
		</div>
	</div>
</div>

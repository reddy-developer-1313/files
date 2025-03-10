<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 19.9.9
 */

defined( 'ABSPATH' ) || exit;

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
	'img'		=> array(
		'class'		=> array(),
		'alt'		=> array(),
		'src'		=> array(),
		'width'		=> array(),
		'height'	=> array(),
		'srcset'	=> array(),
	),
);

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'artraz' ),
			'shipping' => __( 'Shipping address', 'artraz' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'artraz' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

<p>
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'artraz' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses row">
<?php endif; ?>

<?php
	$artrazcoli = 1;
?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
    
    <?php
		$address = wc_get_account_formatted_address( $name );
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;

		if( $artrazcoli == 2 ) {
			$artrazaddresscol = 'mt-5 mt-sm-0';
		} else {
			$artrazaddresscol = '';
		}
	?>

	<div class="u-column<?php if( count( $get_addresses ) == 2 ) { echo ' col-sm-6'; } else { echo 'col-12'; } ?> woocommerce-Address <?php echo esc_attr($artrazaddresscol); ?>">
		<header class="woocommerce-Address-title title">
			<h3><?php echo esc_html( $address_title ); ?></h3>
		</header>
		<address>
			<?php
				if( $address ) {
					echo wp_kses( $address, $allowhtml );
				} else {
					esc_html_e( 'You have not set up this type of address yet.', 'artraz' );
				}
            ?>
        </address>
        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php if( $address ) { esc_html_e( 'Edit', 'artraz' ); }else { esc_html_e( 'Add', 'artraz' ); } ?></a>
	</div>
<?php
	$artrazcoli++;
?>
<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;

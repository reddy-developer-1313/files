<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Artraz
	* @Version     : 1.0
	*  * @Author     : Themeholy
    * @Author URI : https://themeforest.net/user/themeholy
	*
	*/

	if( ! is_active_sidebar( 'artraz-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-lg-4 col-xl-3">
	<!-- Sidebar Begin -->
	<aside class="sidebar-area shop-sidebar">
		<?php
			dynamic_sidebar( 'artraz-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>
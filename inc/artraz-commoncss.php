<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Artraz
 * @Version    : 1.0
 *  * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// enqueue css
function artraz_common_custom_css(){
	wp_enqueue_style( 'artraz-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = artraz_opt( 'artraz_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";
    
    if( get_header_image() ){
        $artraz_header_bg =  get_header_image();
    }else{
        if( artraz_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( artraz_meta( 'breadcumb_image' ) ) ){
                $artraz_header_bg = artraz_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $artraz_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$artraz_header_bg}')!important;
        }";
    }
    
	// theme color
	$artrazthemecolor = artraz_opt('artraz_theme_color');
    if( !empty( $artrazthemecolor ) ) {
        list($r, $g, $b) = sscanf( $artrazthemecolor, "#%02x%02x%02x");

        $artraz_real_color = $r.','.$g.','.$b;
        if( !empty( $artrazthemecolor ) ) {
            $customcss .= ":root {
            --theme-color: rgb({$artraz_real_color});
            }";
        }
    }
    // Heading  color
    $artrazheadingcolor = artraz_opt('artraz_heading_color');
    if( !empty( $artrazheadingcolor ) ){
        list($r, $g, $b) = sscanf( $artrazheadingcolor, "#%02x%02x%02x");

        $artraz_real_color = $r.','.$g.','.$b;
        if( !empty( $artrazheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$artraz_real_color});
            }";
        }
    }
    // Body color
    $artrazbodycolor = artraz_opt('artraz_body_color');
    if( !empty( $artrazbodycolor ) ){
        list($r, $g, $b) = sscanf( $artrazbodycolor, "#%02x%02x%02x");

        $artraz_real_color = $r.','.$g.','.$b;
        if( !empty( $artrazbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$artraz_real_color});
            }";
        }
    }

    // Body font
    $artrazbodyfont = artraz_opt('artraz_theme_body_font', 'font-family');
    if( !empty( $artrazbodyfont ) ) {
        $customcss .= ":root {
            --para-font: $artrazbodyfont ;
        }";
    }

    // Heading font
    $artrazheadingfont = artraz_opt('artraz_theme_heading_font', 'font-family');
    if( !empty( $artrazheadingfont ) ) {
        $customcss .= ":root {
            --title-font: $artrazheadingfont ;
        }";
    }

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'artraz-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'artraz_common_custom_css', 100 );
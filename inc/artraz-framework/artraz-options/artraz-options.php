<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "artraz_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }


    $alowhtml = array(
        'p' => array(
            'class' => array()
        ),
        'span' => array()
    );


    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        // 'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Artraz Options', 'artraz' ),
        'page_title'           => esc_html__( 'Artraz Options', 'artraz' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'artraz' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'artraz' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'artraz' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'artraz' )
        )
    );
    Redux::set_help_tab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'artraz' );
    Redux::set_help_sidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */


    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'artraz' ),
        'id'               => 'artraz_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'       => 'artraz_theme_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Theme Color', 'artraz' )
            ),
            array(
                'id'       => 'artraz_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Color (H1-H6)', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_body_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Color (Default Text Color)', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'artraz' ),
                'output'   => array( 'color'    =>  'a' ),
            ),
       
        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'artraz' ),
        'id'               => 'artraz_typography',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_theme_body_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font Family', 'artraz' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'       => 'artraz_theme_heading_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading Font Family', 'artraz' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'    => 'info_1',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Heading Fonts', 'artraz'),
            ),
            array(
                'id'       => 'artraz_theme_h1_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h1'),
            ),
            array(
                'id'       => 'artraz_theme_h2_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h2'),
            ),
            array(
                'id'       => 'artraz_theme_h3_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h3'),
            ),
            array(
                'id'       => 'artraz_theme_h4_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h4'),
            ),
            array(
                'id'       => 'artraz_theme_h5_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h5'),
            ),
            array(
                'id'       => 'artraz_theme_h6_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6 Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h6'),
            ),
            array(
                'id'    => 'info_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Paragraph Fonts', 'artraz'),
            ),
            array(
                'id'       => 'artraz_theme_p_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'P Font', 'artraz' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('p'),
            ),
           
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Back To Top', 'artraz' ),
        'id'               => 'artraz_backtotop',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back To Top Button', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'artraz' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'artraz' ),
                'off'      => esc_html__( 'Disabled', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_bcktotop_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'artraz' ),
                'required' => array('artraz_display_bcktotop','equals','1'),
                'output'   => array( 'background' =>'.scroll-top svg' ),
            ),
            array(
                'id'       => 'artraz_bcktotop_border_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Border Color', 'artraz' ),
                'required' => array('artraz_display_bcktotop','equals','1'),
                'output'   => array( 'border-color' =>'.scroll-top:after' ),
            ),
            array(
                'id'       => 'artraz_bcktotop_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Circle Color', 'artraz' ),
                'required' => array('artraz_display_bcktotop','equals','1'),
                'output'   => array( 'stroke' =>'.scroll-top .progress-circle path' ),
            ),
            array(
                'id'       => 'artraz_bcktotop_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Icon Color', 'artraz' ),
                'required' => array('artraz_display_bcktotop','equals','1'),
                'output'   => array( 'color' =>'.scroll-top:after' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Preloader', 'artraz' ),
        'id'               => 'artraz_preloader',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_display_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'artraz' ),
                'subtitle' => esc_html__( 'Switch Enabled to Display Preloader.', 'artraz' ),
                'default'  => true,
                'on'       => esc_html__('Enabled','artraz'),
                'off'      => esc_html__('Disabled','artraz'),
            ),

            array(
                'id'       => 'artraz_preloader_img',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Image', 'artraz' ),
                'subtitle' => esc_html__( 'Set Preloader Image.', 'artraz' ),
                'required' => array( "artraz_display_preloader","equals",true )
            ),
            array(
                'id'       => 'artraz_preloader_btn_text', 
                'type'     => 'text',
                'rows'     => 2,
                'validate' => 'html',
                'default'  => esc_html__( 'Cancel Preloader', 'artraz' ),
                'title'    => esc_html__( 'Preloader Cancel Button Text', 'artraz' ),
                'required' => array( 'artraz_display_preloader', 'equals', '1' ),
            ),
        )
    ));

    /* End General Fields */

    /* Admin Lebel Fields */
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Admin Label', 'artraz' ),
        'id'                => 'artraz_admin_label',
        'customizer_width'  => '450px',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Admin Login Logo', 'artraz' ),
                'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'artraz' ),
                'id'        => 'artraz_admin_login_logo',
                'type'      => 'media',
            ),
            array(
                'title'     => esc_html__( 'Custom CSS For admin', 'artraz' ),
                'subtitle'  => esc_html__( 'Any CSS your write here will run in admin.', 'artraz' ),
                'id'        => 'artraz_theme_admin_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'artraz' ),
        'id'               => 'artraz_header',
        'customizer_width' => '400px',
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'artraz_header_options',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"   => esc_html__('Prebuilt','artraz'),
                    "2"      => esc_html__('Header Builder','artraz'),
                ),
                'title'    => esc_html__( 'Header Options', 'artraz' ),
                'subtitle' => esc_html__( 'Select header options.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_header_select_options',
                'type'     => 'select',
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'artraz_header'
                ),
                'title'    => esc_html__( 'Header', 'artraz' ),
                'subtitle' => esc_html__( 'Select header.', 'artraz' ),
                'required' => array( 'artraz_header_options', 'equals', '2' )
            ),

            array(
                'id'       => 'artraz_header_topbar_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'artraz' ),
                'off'      => esc_html__( 'Hide', 'artraz' ),
                'title'    => esc_html__( 'Header Topbar?', 'artraz' ),
                'subtitle' => esc_html__( 'Control Header Topbar By Show Or Hide System.', 'artraz'),
                'required' => array( 'artraz_header_options', 'equals', '1' )
            ),         
            array(
                'id'       => 'artraz_header_topbar_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Topbar Background Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Topbar Background Color', 'artraz' ),
                'output'   => array( 'background-color'    =>  '.prebuilt .header-top' ),
                'required' => array( 'artraz_header_topbar_switcher', 'equals', '1' )
            ),
             array(
                'id'       => 'artraz_topbar_phone_icon2',
                'type'     => 'text',
                // 'validate' => 'html',
                'title'    => esc_html__( 'Phone Icon :', 'artraz' ),
                'default'  => '',
                'required' => array( 'artraz_header_topbar_switcher', 'equals', '1' )
            ),              
            array(
                'id'       => 'artraz_topbar_phone',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Phone Number :', 'artraz' ),
                'default'  => esc_html__( '(+187) 565-425-46', 'artraz' ),
                'required' => array( 'artraz_header_topbar_switcher', 'equals', '1' )
            ), 
            array(
                'id'       => 'artraz_header_topbar_social_icon_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'artraz' ),
                'off'      => esc_html__( 'Hide', 'artraz' ),
                'title'    => esc_html__( 'Header Social Icon?', 'artraz' ),
                'subtitle' => esc_html__( 'Click Show To Display Social Icon?', 'artraz'),
                'required' => array( 'artraz_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'artraz_header_social_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Content Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Header Content Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .header-links li a' ),
                'required' => array( 'artraz_header_topbar_social_icon_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'artraz_header_social_icon_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Content Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Header Content Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .header-links li a:hover' ),
                'required' => array( 'artraz_header_topbar_social_icon_switcher', 'equals', '1' )
            ),

        ),
    ) );
    // -> START Header Logo
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Logo', 'artraz' ),
        'id'               => 'artraz_header_logo_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'artraz' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_site_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'artraz'),
                'output'   => array('.header-logo .logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_site_logomargin_dimensions',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'output'   => array('.header-logo .logo img'),
                'units_extended' => 'false',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Top and Bottom Margin.', 'artraz'),
                'left'     => false,
                'right'    => false,
                'subtitle' => esc_html__('Set logo top and bottom margin.', 'artraz'),
                'default'            => array(
                    'units'           => 'px'
                )
            ),
            array(
                'id'       => 'artraz_text_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'artraz' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'artraz' ),
            )
        )
    ) );
    // -> End Header Logo

    // -> START Header Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Menu', 'artraz' ),
        'id'               => 'artraz_header_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_menu_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Menu Icon Hide/Show', 'artraz' ),
                'subtitle' => esc_html__( 'Hide / Show menu icon ( Default settings SHOW ).', 'artraz' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'artraz_header_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Menu Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a' ),
            ),
            array(
                'id'       => 'artraz_header_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Menu Hover Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a:hover' ),
            ),
            array(
                'id'       => 'artraz_header_submenu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Submenu Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a' ),
            ),
            array(
                'id'       => 'artraz_header_submenu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Submenu Hover Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:hover' ),
            ),
            array(
                'id'       => 'artraz_header_submenu_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Icon Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Submenu Icon Color', 'artraz' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:before' ),
            ),
        )
    ) );
    // -> End Header Menu

     // -> START Mobile Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Offcanvas', 'artraz' ),
        'id'               => 'artraz_offcanvas_panel',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'artraz_offcanvas_panel_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Offcanvas Panel Background', 'artraz' ),
                'output'   => array('.sidemenu-wrapper .sidemenu-content'),
                'subtitle' => esc_html__( 'Set Offcanvas Panel Background Color', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_offcanvas_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Offcanvas Title Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Offcanvas Title color.', 'artraz' ),
                'output'   => array( '.sidemenu-content h3.sidebox-title' )
            ),
        )
    ) );
    // -> End Mobile Menu

    // -> START Blog Page
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'artraz' ),
        'id'         => 'artraz_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(

            array(
                'id'       => 'artraz_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'artraz' ),
                'subtitle' => esc_html__( 'Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Left Sidebar Layour ). ', 'artraz' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'artraz_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Column', 'artraz' ),
                'subtitle' => esc_html__( 'Select your blog post column from here. If you use this option then you will able to select three type of blog post layout ( Default Two Column ).', 'artraz' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/1column.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2column.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3column.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'artraz_blog_page_title_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__('Show','artraz'),
                'off'      => esc_html__('Hide','artraz'),
                'title'    => esc_html__('Blog Page Title', 'artraz'),
                'subtitle' => esc_html__('Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).', 'artraz'),
            ),
            array(
                'id'       => 'artraz_blog_page_title_setting',
                'type'     => 'button_set',
                'title'    => esc_html__('Blog Page Title Setting', 'artraz'),
                'subtitle' => esc_html__('Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).', 'artraz'),
                'options'  => array(
                    "predefine"   => esc_html__('Default','artraz'),
                    "custom"      => esc_html__('Custom','artraz'),
                ),
                'default'  => 'predefine',
                'required' => array("artraz_blog_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'artraz_blog_page_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Custom Title', 'artraz'),
                'subtitle' => esc_html__('Set blog page custom title form here. If you use this option then you will able to set your won title text.', 'artraz'),
                'required' => array('artraz_blog_page_title_setting','equals','custom')
            ),
            array(
                'id'            => 'artraz_blog_postExcerpt',
                'type'          => 'slider',
                'title'         => esc_html__('Blog Posts Excerpt', 'artraz'),
                'subtitle'      => esc_html__('Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here ( Default show 10 ).', 'artraz'),
                "default"       => 46,
                "min"           => 0,
                "step"          => 1,
                "max"           => 100,
                'resolution'    => 1,
                'display_value' => 'text',
            ),
            array(
                'id'       => 'artraz_blog_readmore_setting',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Text Setting', 'artraz' ),
                'subtitle' => esc_html__( 'Control read more text from here.', 'artraz' ),
                'options'  => array(
                    "default"   => esc_html__('Default','artraz'),
                    "custom"    => esc_html__('Custom','artraz'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'artraz_blog_custom_readmore',
                'type'     => 'text',
                'title'    => esc_html__('Read More Text', 'artraz'),
                'subtitle' => esc_html__('Set read moer text here. If you use this option then you will able to set your won text.', 'artraz'),
                'required' => array('artraz_blog_readmore_setting','equals','custom')
            ),
            array(
                'id'       => 'artraz_blog_title_color',
                'output'   => array( '.th-blog .blog-title a'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Blog Title Color.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_blog_title_hover_color',
                'output'   => array( '.th-blog .blog-title a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Blog Title Hover Color.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_blog_contant_color',
                'output'   => array( '.blog-content p'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Excerpt / Content Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Blog Excerpt / Content Color.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_blog_read_more_button_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Read More Button Color.', 'artraz' ),
                'output'   => array( '--theme-color' => '.blog-single .blog-content .th-btn' ),
            ),
            array(
                'id'       => 'artraz_blog_read_more_button_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Color.', 'artraz' ),
                'output'   => array( '--title-color' => '.blog-single .blog-content .th-btn:hover' ),
            ),
            array(
                'id'       => 'artraz_blog_pagination_color',
                'output'   => array( '.th-pagination a'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Color', 'artraz'),
                'subtitle' => esc_html__('Set Blog Pagination Color.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_blog_pagination_bg_color',
                'output'   => array( '--smoke-color' => '.th-pagination a'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Background', 'artraz'),
                'subtitle' => esc_html__('Set Blog Pagination Backgorund Color.', 'artraz'),
            ),
            // array(
            //     'id'       => 'artraz_blog_pagination_active_color',
            //     'output'   => array( '.pagination li span.current'),
            //     'type'     => 'color',
            //     'title'    => esc_html__('Blog Pagination Active Color', 'artraz'),
            //     'subtitle' => esc_html__('Set Blog Pagination Active Color.', 'artraz'),
            //     'required'  => array('artraz_blog_pagination', '=', '1')
            // ),
            array(
                'id'       => 'artraz_blog_pagination_hover_color',
                'output'   => array( '.th-pagination a:hover, .th-pagination a.active'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Hover & Active Color', 'artraz'),
                'subtitle' => esc_html__('Set Blog Pagination Hover & Active Color.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_blog_pagination_bg_hover_color',
                'output'   => array( '--theme-color' => '.th-pagination a:hover, .th-pagination a.active'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Hover & Active Background', 'artraz'),
                'subtitle' => esc_html__('Set Blog Pagination Background Hover & Active Color.', 'artraz'),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Blog Page', 'artraz' ),
        'id'         => 'artraz_post_detail_styles',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'artraz_blog_single_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'artraz' ),
                'subtitle' => esc_html__( 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Left Sidebar Layour ). ', 'artraz' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'artraz_post_details_title_position',
                'type'     => 'button_set',
                'default'  => 'header',
                'options'  => array(
                    'header'        => esc_html__('On Header','artraz'),
                    'below'         => esc_html__('Below Thumbnail','artraz'),
                ),
                'title'    => esc_html__('Blog Post Title Position', 'artraz'),
                'subtitle' => esc_html__('Control blog post title position from here.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_post_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Details Custom Title', 'artraz'),
                'subtitle' => esc_html__('This title will show in Breadcrumb title.', 'artraz'),
                'required' => array('artraz_post_details_title_position','equals','below')
            ),
            array(
                'id'       => 'artraz_display_post_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display Tags.', 'artraz' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
            array(
                'id'       => 'artraz_post_details_share_options',
                'type'     => 'switch',
                'title'    => esc_html__('Share Options', 'artraz'),
                'subtitle' => esc_html__('Control post share options from here. If you use this option then you will able to show or hide post share options.', 'artraz'),
                'on'        => esc_html__('Show','artraz'),
                'off'       => esc_html__('Hide','artraz'),
                'default'   => '0',
            ),
            array(
                'id'       => 'artraz_post_details_author_desc_trigger',
                'type'     => 'switch',
                'title'    => esc_html__('Author Options', 'artraz'),
                'subtitle' => esc_html__('Switch On to Display Author Box', 'artraz'),
                'on'        => esc_html__('Show','artraz'),
                'off'       => esc_html__('Hide','artraz'),
                'default'   => '0',
            ),
            array(
                'id'       => 'artraz_post_details_post_navigation',
                'type'     => 'switch',
                'title'    => esc_html__('Post Navigation', 'artraz'),
                'subtitle' => esc_html__('Control post navigation from here. If you use this option then you will able to show or hide post navigation ( Default setting Show ).', 'artraz'),
                'on'        => esc_html__('Show','artraz'),
                'off'       => esc_html__('Hide','artraz'),
                'default'   => true,
            ),
           
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Meta Data', 'artraz' ),
        'id'         => 'artraz_common_meta_data',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'artraz_blog_meta_icon_color',
                'output'   => array( '.blog-meta a i'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Meta Icon Color', 'artraz'),
                'subtitle' => esc_html__('Set Blog Meta Icon Color.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_blog_meta_text_color',
                'output'   => array( '.blog-meta a,.blog-meta span'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Text Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Blog Meta Text Color.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_blog_meta_text_hover_color',
                'output'   => array( '.blog-meta a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Hover Text Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Blog Meta Hover Text Color.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_display_post_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post author', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Author.', 'artraz' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
            array(
                'id'       => 'artraz_display_post_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Date', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Date.', 'artraz' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
            array(
                'id'       => 'artraz_display_post_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comment', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Comment Number.', 'artraz' ),
                'default'  => false,
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
            array(
                'id'       => 'artraz_display_post_tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Category', 'artraz' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Category.', 'artraz' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
        )
    ));

    /* End blog Page */

    // -> START Page Option
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page & Breadcrumb', 'artraz' ),
        'id'         => 'artraz_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
            array(
                'id'       => 'artraz_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select layout', 'artraz' ),
                'subtitle' => esc_html__( 'Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ). ', 'artraz' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'artraz_page_layoutopt',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Settings', 'artraz'),
                'subtitle' => esc_html__('Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).', 'artraz'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'Page Sidebar', 'artraz' ),
                    '2' => esc_html__( 'Blog Sidebar', 'artraz' )
                 ),
                'default' => '1',
                'required'  => array('artraz_page_sidebar','!=','1')
            ),
            array(
                'id'       => 'artraz_page_title_switcher',
                'type'     => 'switch',
                'title'    => esc_html__('Title', 'artraz'),
                'subtitle' => esc_html__('Switch enabled to display page title. Fot this option you will able to show / hide page title.  Default setting Enabled', 'artraz'),
                'default'  => '1',
                'on'        => esc_html__('Enabled','artraz'),
                'off'       => esc_html__('Disabled','artraz'),
            ),
            array(
                'id'       => 'artraz_page_title_tag',
                'type'     => 'select',
                'options'  => array(
                    'h1'        => esc_html__('H1','artraz'),
                    'h2'        => esc_html__('H2','artraz'),
                    'h3'        => esc_html__('H3','artraz'),
                    'h4'        => esc_html__('H4','artraz'),
                    'h5'        => esc_html__('H5','artraz'),
                    'h6'        => esc_html__('H6','artraz'),
                ),
                'default'  => 'h1',
                'title'    => esc_html__( 'Title Tag', 'artraz' ),
                'subtitle' => esc_html__( 'Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )', 'artraz' ),
                'required' => array("artraz_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'artraz_allHeader_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Title Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Title Color', 'artraz' ),
                'output'   => array( 'color' => '.breadcumb-title' ),
                'required' => array("artraz_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'artraz_allHeader_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'artraz' ),
                'subtitle' => esc_html__( 'Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.', 'artraz' ),
                'output'   => array( 'background' => '.breadcumb-wrapper' ),
            ),
             array(
                'id'       => 'artraz_shoppage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Shop Pages', 'artraz' ),
                'output'   => array( 'background' => '.custom-woo-class' ),
            ),
            array(
                'id'       => 'artraz_archivepage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Archive Pages', 'artraz' ),
                'output'   => array( 'background' => '.custom-archive-class' ),
            ),
            array(
                'id'       => 'artraz_searchpage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Search Pages', 'artraz' ),
                'output'   => array( 'background' => '.custom-search-class' ),
            ),
            array(
                'id'       => 'artraz_errorpage_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background For Error Pages', 'artraz' ),
                'output'   => array( 'background' => '.custom-error-class' ),
            ),
            array(
                'id'       => 'artraz_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'artraz' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all pages and posts ( Default settings hide ).', 'artraz' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'artraz_allHeader_breadcrumbtextcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Color', 'artraz' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.', 'artraz' ),
                'required' => array("artraz_page_title_switcher","equals","1"),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li a' ),
            ),
            array(
                'id'       => 'artraz_allHeader_breadcrumbtextactivecolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Active Color', 'artraz' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.', 'artraz' ),
                'required' => array( "artraz_page_title_switcher", "equals", "1" ),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li:last-child' ),
            ),
            array(
                'id'       => 'artraz_allHeader_dividercolor',
                'type'     => 'color',
                'output'   => array( 'color'=>'.breadcumb-wrapper .breadcumb-content ul li:after' ),
                'title'    => esc_html__( 'Breadcrumb Divider Color', 'artraz' ),
                'subtitle' => esc_html__( 'Choose breadcrumb divider color.', 'artraz' ),
            ),
        ),
    ) );
    /* End Page option */

    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'artraz' ),
        'id'         => 'artraz_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'artraz_fof_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'artraz' ),
                'subtitle' => esc_html__( 'Set Page title ', 'artraz' ),
                'default'  => esc_html__( '404', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_fof_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Subtitle', 'artraz' ),
                'subtitle' => esc_html__( 'Set Page Subtitle ', 'artraz' ),
                'default'  => esc_html__( 'Oops! That page can\'t be found.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_fof_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Description', 'artraz' ),
                'subtitle' => esc_html__( 'Set Page Subtitle ', 'artraz' ),
                'default'  => esc_html__( 'Unfortunately, something went wrong and this page does not exist. Try using the search or return to the previous page.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_fof_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'artraz' ),
                'subtitle' => esc_html__( 'Set Button Text ', 'artraz' ),
                'default'  => esc_html__( 'Return To Home', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_fof_title_color',
                'type'     => 'color',
                'output'   => array( '.error-number' ),
                'title'    => esc_html__( 'Title Color', 'artraz' ),
                'subtitle' => esc_html__( 'Pick a subtitle color', 'artraz' ),
                'validate' => 'color'
            ),      
            array(
                'id'       => 'artraz_fof_subtitle_color',
                'type'     => 'color',
                'output'   => array( '.error-title' ),
                'title'    => esc_html__( 'Subtitle Color', 'artraz' ),
                'subtitle' => esc_html__( 'Pick a subtitle color', 'artraz' ),
                'validate' => 'color'
            ),      
            array(
                'id'       => 'artraz_fof_desc_color',
                'type'     => 'color',
                'output'   => array( '.error-text' ),
                'title'    => esc_html__( 'Description Color', 'artraz' ),
                'subtitle' => esc_html__( 'Pick a description color', 'artraz' ),
                'validate' => 'color'
            ),
            array(
                'id'       => 'artraz_fof_btn_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Color', 'artraz' ),
                'subtitle' => esc_html__( 'Button Color.', 'artraz' ),
                'output'   => array( '--title-black' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'artraz_fof_btn_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background', 'artraz' ),
                'subtitle' => esc_html__( 'Button Color.', 'artraz' ),
                'output'   => array( '--theme-color' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'artraz_fof_btn_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Button Hover Color.', 'artraz' ),
                'output'   => array( '--title-black' => '.th-btn.error-btn:hover',  ),
            ),
            array(
                'id'       => 'artraz_fof_btn_hover_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Color', 'artraz' ),
                'subtitle' => esc_html__( 'Set Button Hover Color.', 'artraz' ),
                'output'   => array( 'background-color' => '.th-btn.error-btn:hover::before',  ),
            ),
        ),
    ) );

    /* End 404 Page */
    // -> START Woo Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce Page', 'artraz' ),
        'id'         => 'artraz_woo_page_page',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'artraz_woo_shoppage_sidebar', 
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Shop Page Sidebar.', 'artraz' ),
                'subtitle' => esc_html__( 'Choose shop page sidebar (Note: must add widget in woocommerce sidebar)', 'artraz' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'artraz_woo_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Column', 'artraz' ),
                'subtitle' => esc_html__( 'Set your woocommerce product column.', 'artraz' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '2' => array(
                        'alt' => esc_attr__('2 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('3 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '4' => array(
                        'alt' => esc_attr__('4 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '6' => array(
                        'alt' => esc_attr__('6 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),),
                'default'  => '4'
            ),
            array(
                'id'       => 'artraz_woo_product_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Per Page', 'artraz' ),
                'default' => '12'
            ),
            array(
                'id'       => 'artraz_woo_singlepage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Single Page sidebar', 'artraz' ),
                'subtitle' => esc_html__( 'Choose product single page sidebar.', 'artraz' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'artraz_product_details_title_position',
                'type'     => 'button_set',
                'default'  => 'below',
                'options'  => array(
                    'header'        => esc_html__('On Header','artraz'),
                    'below'         => esc_html__('Below Thumbnail','artraz'),
                ),
                'title'    => esc_html__('Product Details Title Position', 'artraz'),
                'subtitle' => esc_html__('Control product details title position from here.', 'artraz'),
            ),
            array(
                'id'       => 'artraz_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'artraz' ),
                'default'  => esc_html__( 'Shop Details', 'artraz' ),
                'required' => array('artraz_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'artraz_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'artraz' ),
                'default'  => esc_html__( 'Shop Details', 'artraz' ),
                'required' => array('artraz_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'artraz_woo_relproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related product Hide/Show', 'artraz' ),
                'subtitle' => esc_html__( 'Hide / Show related product in single page (Default Settings Show)', 'artraz' ),
                'default'  => '1',
                'on'       => esc_html__('Show','artraz'),
                'off'      => esc_html__('Hide','artraz')
            ),
            array(
                'id'       => 'artraz_woo_relproduct_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products Subtitle', 'artraz' ),
                'default'  => esc_html__( 'Some Others Product', 'artraz' ),
                'required' => array('artraz_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'artraz_woo_relproduct_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Products Title', 'artraz' ),
                'default'  => esc_html__( 'Related products', 'artraz' ),
                'required' => array('artraz_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'artraz_woo_relproduct_slider',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Product Slider?', 'artraz' ),
                'subtitle' => esc_html__( 'Slider related product in single page (Default Slider Acive)', 'artraz' ),
                'default'  => '1',
                'on'       => esc_html__('Show','artraz'),
                'off'      => esc_html__('Hide','artraz'),
                'required' => array('artraz_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'artraz_woo_relproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products number', 'artraz' ),
                'subtitle' => esc_html__( 'Set how many related products you want to show in single product page.', 'artraz' ),
                'default'  => 5,
                'required' => array('artraz_woo_relproduct_slider','equals',false),
            ),

            array(
                'id'       => 'artraz_woo_related_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Related Product Column', 'artraz' ),
                'subtitle' => esc_html__( 'Set your woocommerce related product column.', 'artraz' ),
                'required' => array('artraz_woo_relproduct_slider','equals',false),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'artraz_woo_upsellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Upsell product Hide/Show', 'artraz' ),
                'subtitle' => esc_html__( 'Hide / Show upsell product in single page (Default Settings Show)', 'artraz' ),
                'default'  => '1',
                'on'       => esc_html__('Show','artraz'),
                'off'      => esc_html__('Hide','artraz'),
            ),
            array(
                'id'       => 'artraz_woo_upsellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells products number', 'artraz' ),
                'subtitle' => esc_html__( 'Set how many upsells products you want to show in single product page.', 'artraz' ),
                'default'  => 3,
                'required' => array('artraz_woo_upsellproduct_display','equals',true),
            ),

            array(
                'id'       => 'artraz_woo_upsell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Upsells Product Column', 'artraz' ),
                'subtitle' => esc_html__( 'Set your woocommerce upsell product column.', 'artraz' ),
                'required' => array('artraz_woo_upsellproduct_display','equals',true),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'artraz_woo_crosssellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross sell product Hide/Show', 'artraz' ),
                'subtitle' => esc_html__( 'Hide / Show cross sell product in single page (Default Settings Show)', 'artraz' ),
                'default'  => '1',
                'on'       => esc_html__( 'Show', 'artraz' ),
                'off'      => esc_html__( 'Hide', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_woo_crosssellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross sell products number', 'artraz' ),
                'subtitle' => esc_html__( 'Set how many cross sell products you want to show in single product page.', 'artraz' ),
                'default'  => 3,
                'required' => array('artraz_woo_crosssellproduct_display','equals',true),
            ),

            array(
                'id'       => 'artraz_woo_crosssell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Cross sell Product Column', 'artraz' ),
                'subtitle' => esc_html__( 'Set your woocommerce cross sell product column.', 'artraz' ),
                'required' => array( 'artraz_woo_crosssellproduct_display', 'equals', true ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','artraz'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','artraz'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
        ),
    ) );

    /* End Woo Page option */
    // -> START Gallery
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Gallery', 'artraz' ),
        'id'         => 'artraz_gallery_widget',
        'icon'       => 'el el-gift',
        'fields'     => array(
            array(
                'id'          => 'artraz_gallery_image_widget',
                'type'        => 'slides',
                'title'       => esc_html__('Add Gallery Image', 'artraz'),
                'subtitle'    => esc_html__('Add gallery Image and url.', 'artraz'),
                'show'        => array(
                    'title'          => false,
                    'description'    => false,
                    'progress'       => false,
                    'icon'           => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => true,
                ),
            ),
        ),
    ) );
    // -> START Subscribe
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'artraz' ),
        'id'         => 'artraz_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(

            array(
                'id'       => 'artraz_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'artraz' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'artraz' ),
            ),
            array(
                'id'       => 'artraz_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'artraz' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'artraz' ),
            ),
        ),
    ) );

    /* End Subscribe */

    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'artraz' ),
        'id'         => 'artraz_social_media',
        'icon'      => 'el el-globe',
        'desc'      => esc_html__( 'Social', 'artraz' ),
        'fields'     => array(
            array(
                'id'          => 'artraz_social_links',
                'type'        => 'slides',
                'title'       => esc_html__('Social Profile Links', 'artraz'),
                'subtitle'    => esc_html__('Add social icon and url.', 'artraz'),
                'show'        => array(
                    'title'          => true,
                    'description'    => true,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'icon'          => esc_html__( 'Icon (example: fa fa-facebook) ','artraz'),
                    'title'         => esc_html__( 'Social Icon Class', 'artraz' ),
                    'description'   => esc_html__( 'Social Icon Title', 'artraz' ),
                ),
            ),
            array(
                'id'          => 'artraz_social_links2',
                'type'        => 'slides',
                'title'       => esc_html__('Footer About widget - Social Links', 'artraz'),
                'subtitle'    => esc_html__('Add social icon and url.', 'artraz'),
                'show'        => array(
                    'title'          => true,
                    'description'    => true,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'icon'          => esc_html__( 'Icon (example: fa fa-facebook) ','artraz'),
                    'title'         => esc_html__( 'Social Icon Class', 'artraz' ),
                    'description'   => esc_html__( 'Social Icon Title', 'artraz' ),
                ),
            ),
        ),
    ) );

    /* End social Media */


    // -> START Footer Media
    Redux::setSection( $opt_name , array(
       'title'            => esc_html__( 'Footer', 'artraz' ),
       'id'               => 'artraz_footer',
       'desc'             => esc_html__( 'artraz Footer', 'artraz' ),
       'customizer_width' => '400px',
       'icon'              => 'el el-photo',
   ) );

   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Pre-built Footer / Footer Builder', 'artraz' ),
       'id'         => 'artraz_footer_section',
       'subsection' => true,
       'fields'     => array(
            array(
               'id'       => 'artraz_footer_builder_trigger',
               'type'     => 'button_set',
               'default'  => 'prebuilt',
               'options'  => array(
                   'footer_builder'        => esc_html__('Footer Builder','artraz'),
                   'prebuilt'              => esc_html__('Pre-built Footer','artraz'),
               ),
               'title'    => esc_html__( 'Footer Builder', 'artraz' ),
            ),
            array(
               'id'       => 'artraz_footer_builder_select',
               'type'     => 'select',
               'required' => array( 'artraz_footer_builder_trigger','equals','footer_builder'),
               'data'     => 'posts',
               'args'     => array(
                   'post_type'     => 'artraz_footer_build'
               ),
               'on'       => esc_html__( 'Enabled', 'artraz' ),
               'off'      => esc_html__( 'Disable', 'artraz' ),
               'title'    => esc_html__( 'Select Footer', 'artraz' ),
               'subtitle' => esc_html__( 'First make your footer from footer custom types then select it from here.', 'artraz' ),
            ),
            
            array(
               'id'       => 'artraz_footerwidget_enable',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Widget', 'artraz' ),
               'default'  => 1,
               'on'       => esc_html__( 'Enabled', 'artraz' ),
               'off'      => esc_html__( 'Disable', 'artraz' ),
               'required' => array( 'artraz_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
               'id'       => 'artraz_footer_background',
               'type'     => 'background',
               'title'    => esc_html__( 'Footer Widget Background', 'artraz' ),
               'subtitle' => esc_html__( 'Set footer background.', 'artraz' ),
               'output'   => array( '.footer-layout4' ),
               'required' => array( 'artraz_footerwidget_enable','=','1' ),
            ),
            array(
               'id'       => 'artraz_footer_widget_title_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Title Color', 'artraz' ),
               'required' => array('artraz_footerwidget_enable','=','1'),
               'output'   => array( '.footer-widget .widget_title' ),
            ),
            array(
               'id'       => 'artraz_footer_widget_anchor_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Anchor Color', 'artraz' ),
               'required' => array('artraz_footerwidget_enable','=','1'),
               'output'   => array( '.footer-widget.widget_nav_menu a' ),
            ),
            array(
               'id'       => 'artraz_footer_widget_anchor_hov_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Widget Anchor Hover Color', 'artraz' ),
               'required' => array('artraz_footerwidget_enable','=','1'),
               'output'   => array( '.footer-widget.widget_nav_menu a:hover,.footer-layout1 .footer-wid-wrap .widget-links ul li a:hover' ),
            ),


            array(
               'id'       => 'artraz_disable_footer_bottom',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Bottom?', 'artraz' ),
               'default'  => 1,
               'on'       => esc_html__('Enabled','artraz'),
               'off'      => esc_html__('Disable','artraz'),
               'required' => array('artraz_footer_builder_trigger','equals','prebuilt'),
            ),

             array(
               'id'       => 'artraz_footer_bottom_background2',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Bottom Background Color', 'artraz' ),
               'required' => array( 'artraz_disable_footer_bottom','=','1' ),
               'output'   => array( 'background-color'   =>   '.footer-layout1 .copyright-wrap' ),
            ),
            array(
               'id'       => 'artraz_copyright_text',
               'type'     => 'text',
               'title'    => esc_html__( 'Copyright Text', 'artraz' ),
               'subtitle' => esc_html__( 'Add Copyright Text', 'artraz' ),
               'default'  => sprintf( 'Copyright <i class="fal fa-copyright"></i> 2023 By <a href="#">Artraz</a>. All Rights Reserved.',date('Y'),esc_url('#'),__( 'Artraz.','artraz' ) ),
               'required' => array( 'artraz_disable_footer_bottom','equals','1' ),
            ),
            array(
               'id'       => 'artraz_footer_copyright_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Text Color', 'artraz' ),
               'subtitle' => esc_html__( 'Set footer copyright text color', 'artraz' ),
               'required' => array( 'artraz_disable_footer_bottom','equals','1'),
               'output'   => array( '.copyright-wrap .copyright-text' ),
            ),
            array(
               'id'       => 'artraz_footer_copyright_acolor',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Color', 'artraz' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor color', 'artraz' ),
               'required' => array( 'artraz_disable_footer_bottom','equals','1'),
               'output'   => array( '.copyright-wrap .copyright-text a' ),
            ),
            array(
               'id'       => 'artraz_footer_copyright_a_hover_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Hover Color', 'artraz' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor Hover color', 'artraz' ),
               'required' => array( 'artraz_disable_footer_bottom','equals','1'),
               'output'   => array( '.copyright-wrap .copyright-text a:hover' ),
            ),

       ),
   ) );


    /* End Footer Media */

    // -> START Custom Css
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Css', 'artraz' ),
        'id'         => 'artraz_custom_css_section',
        'icon'  => 'el el-css',
        'fields'     => array(
            array(
                'id'       => 'artraz_css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('CSS Code', 'artraz'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'artraz'),
                'mode'     => 'css',
                'theme'    => 'monokai',
            )
        ),
    ) );

    /* End custom css */



    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'artraz' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'artraz' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'artraz' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }
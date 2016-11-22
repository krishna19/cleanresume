<?php
/**
 * CleanResume Theme Customizer.
 *
 * @package CleanResume
 */

/**
 * Add the theme configuration
 */
cleanresume_Kirki::add_config( 'cleanresume-lite', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
));


/**
 * Removing Pre-Existing Options for the Theme Customizer.
**/
function cleanresume_customize_remove_sections($wp_customize) {
	$wp_customize->remove_control("header_image");
	$wp_customize->remove_control("display_header_text");
	$wp_customize->remove_panel( 'nav_menus' );
	$wp_customize->remove_panel("widgets");
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("static_front_page");
	
	// Removing Nav Menus
	remove_action( 'customize_controls_enqueue_scripts', array( $wp_customize->nav_menus, 'enqueue_scripts' ) );
	remove_action( 'customize_register', array( $wp_customize->nav_menus, 'customize_register' ), 11 );
	remove_filter( 'customize_dynamic_setting_args', array( $wp_customize->nav_menus, 'filter_dynamic_setting_args' ) );
	remove_filter( 'customize_dynamic_setting_class', array( $wp_customize->nav_menus, 'filter_dynamic_setting_class' ) );
	remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'print_templates' ) );
	remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'available_items_template' ) );
	remove_action( 'customize_preview_init', array( $wp_customize->nav_menus, 'customize_preview_init' ) );
	
	$wp_customize->get_section( 'title_tagline' )->title = __( 'General Settings', 'cleanresume-lite' );
	$wp_customize->get_section( 'background_image' )->title = __( 'Background Settings', 'cleanresume-lite' );
	$wp_customize->get_section( 'background_image' )->panel = 'appearance_panel';
	$wp_customize->get_control( 'blogname' )->title = __( 'Profile Image', 'cleanresume-lite' );
}
add_action( "customize_register", "cleanresume_customize_remove_sections" );



function cleanresume_customize_register($wp_customize) {

	//  ==============================================
    //  = Adding Additional Fields to General Settings
    //  ==============================================
	
	// Adding Phone Number Field
	cleanresume_Kirki::add_field( 'admin_email', array(
		'type'     => 'text',
		'settings' => 'admin_email',
		'label'    => __( 'Email Address', 'cleanresume-lite' ),
		'section'  => 'title_tagline',
		'help'     => __( 'Add your email address which will appear on your resume. If no email enter here then admin email will be show up', 'cleanresume-lite' ),
		'priority' => 10,
	) );

	// Adding Phone Number Field
	cleanresume_Kirki::add_field( 'phone_number', array(
		'type'     => 'text',
		'settings' => 'phone_number',
		'label'    => __( 'Phone Number', 'cleanresume-lite' ),
		'section'  => 'title_tagline',
		'help'     => __( 'Add contact number which will appear on your resume.', 'cleanresume-lite' ),
		'priority' => 11,
	) );

	// Adding Phone Number Field
	cleanresume_Kirki::add_field( 'admin_url', array(
		'type'     => 'text',
		'settings' => 'admin_url',
		'label'    => __( 'Website URL', 'cleanresume-lite' ),
		'section'  => 'title_tagline',
		'help'     => __( 'Add website url which will appear on resume. If no url enter then actual website url will show up.', 'cleanresume-lite' ),
		'priority' => 12,
	) );

	cleanresume_Kirki::add_field( 'hr_spacing01', array(
		'type'        => 'custom',
		'settings'    => 'hr_spacing01',
		'label'       => __( '&nbsp;', 'cleanresume-lite' ),
		'section'     => 'title_tagline',
		'default'     => '<hr></hr>',
		'priority'    => 15,
	) );
	
	// Adding Custom Avatar Image Field
	cleanresume_Kirki::add_field( 'avatar_image', array(
		'type'        => 'image',
		'settings'    => 'avatar_image',
		'label'       => __( 'Profile Image', 'cleanresume-lite' ),
		'description' => __( 'The profile image is used as a avatar image for your site. Image must be square, and at least <strong>512</strong> pixels wide and tall.', 'cleanresume-lite' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 20,
	) );

	cleanresume_Kirki::add_field( 'hr_spacing02', array(
		'type'        => 'custom',
		'settings'    => 'hr_spacing02',
		'label'       => __( '&nbsp;', 'cleanresume-lite' ),
		'section'     => 'title_tagline',
		'default'     => '<hr></hr>',
		'priority'    => 25,
	) );

	cleanresume_Kirki::add_field( 'hr_spacing03', array(
		'type'        => 'custom',
		'settings'    => 'hr_spacing03',
		'label'       => __( '&nbsp;', 'cleanresume-lite' ),
		'section'     => 'title_tagline',
		'default'     => '<hr></hr>',
		'priority'    => 135,
	) );

	// Adding PDF Resume CV Field
	cleanresume_Kirki::add_field( 'avatar_resume', array(
		'type'        => 'image',
		'settings'    => 'avatar_resume',
		'label'       => __( 'Upload Resume (PDF)', 'cleanresume-lite' ),
		'description' => __( 'Please upload resume document file in pdf format, so others can download it on need.', 'cleanresume-lite' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 140,
	) );

    
    //  =============================
    //  = Appearance Panel          =
    //  =============================
	cleanresume_Kirki::add_panel( 'appearance_panel', array(
	    'priority'    => 25,
	    'title'       => __( 'Appearance', 'cleanresume-lite' ),
	    'description' => __( 'Color Scheme, Layout & Theme Settings for website', 'cleanresume-lite' ),
	) );
    
	    //  =============================
	    //  = Color Scheme Section      =
	    //  =============================
	    cleanresume_Kirki::add_section( 'color_scheme', array(
		    'title'          => __( 'Color Scheme', 'cleanresume-lite' ),
		    'description'    => __( 'Color Scheme Settings', 'cleanresume-lite' ),
		    'panel'          => 'appearance_panel', // Not typically needed.
		    'priority'       => 20,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
	  
			//  Body Text Color (General)
			cleanresume_Kirki::add_field( 'primary_color_scheme', array(
				'type'        => 'color',
				'settings'    => 'primary_color_scheme',
				'label'       => __( 'Primary Color Scheme', 'cleanresume-lite' ),
				'section'     => 'color_scheme',
				'default'     => '#0099cc',
				'priority'    => 10,
				'alpha'       => false,
			) );

	  
			//  Body Text Color (General)
			cleanresume_Kirki::add_field( 'theme_body_color', array(
				'type'        => 'color',
				'settings'    => 'theme_body_color',
				'label'       => __( 'Body Color', 'cleanresume-lite' ),
				'section'     => 'color_scheme',
				'default'     => '#252525',
				'priority'    => 20,
				'alpha'       => false,
			) );

			//  Heading Color (Title)
			cleanresume_Kirki::add_field( 'theme_heading_color', array(
				'type'        => 'color',
				'settings'    => 'theme_heading_color',
				'label'       => __( 'Heading Color (Title)', 'cleanresume-lite' ),
				'section'     => 'color_scheme',
				//'default'     => '#252525',
				'priority'    => 30,
				'alpha'       => false,
			) );

			//  Link Color
			cleanresume_Kirki::add_field( 'theme_link_color', array(
				'type'        => 'color',
				'settings'    => 'theme_link_color',
				'label'       => __( 'Link Color', 'cleanresume-lite' ),
				'section'     => 'color_scheme',
				'default'     => '#0099cc',
				'priority'    => 40,
				'alpha'       => false,
			) );

			//  Link Hover Color
			cleanresume_Kirki::add_field( 'theme_link_hover_color', array(
				'type'        => 'color',
				'settings'    => 'theme_link_hover_color',
				'label'       => __( 'Link Hover Color', 'cleanresume-lite' ),
				'section'     => 'color_scheme',
				'default'     => '#252525',
				'priority'    => 50,
				'alpha'       => false,
			) );

	    //  =============================
	    //  = Themes Section            =
	    //  =============================
	    cleanresume_Kirki::add_section( 'layouts_themes', array(
		    'title'          => __( 'Layouts & Themes', 'cleanresume-lite' ),
		    'description'    => __( 'Theme and Layout Settings', 'cleanresume-lite' ),
		    'panel'          => 'appearance_panel', // Not typically needed.
		    'priority'       => 30,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );

		    // Adding Layouts Select Option
			cleanresume_Kirki::add_field( 'template_layouts', array(
				'type'        => 'radio-image',
				'settings'    => 'template_layouts',
				'label'       => esc_html__( 'Layouts', 'cleanresume-lite' ),
				'section'     => 'layouts_themes',
				'default'     => 'fixed',
				'priority'    => 10,
				'choices'     => array(
					'fixed'   => get_template_directory_uri() . '/assets/images/layouts/layout-boxed.png',
					'fullwidth' => get_template_directory_uri() . '/assets/images/layouts/layout-full-width.png',
				),
			) );	
		  
		    // Adding Themes Select Option
			cleanresume_Kirki::add_field( 'template_themes', array(
				'type'        => 'radio-image',
				'settings'    => 'template_themes',
				'label'       => esc_html__( 'Themes', 'cleanresume-lite' ),
				'section'     => 'layouts_themes',
				'default'     => 'theme-light',
				'priority'    => 20,
				'choices'     => array(
					'theme-light'   => get_template_directory_uri() . '/assets/images/themes/theme-light-screenshot.png',
					'theme-dark' => get_template_directory_uri() . '/assets/images/themes/theme-dark-screenshot.png',
				),
			) );	

		// ====================================
		// Typography Section
		// ====================================
	    cleanresume_Kirki::add_section( 'typography_section', array(
		    'title'          => __( 'Typography', 'cleanresume-lite' ),
		    'description'    => __( 'font settings for website', 'cleanresume-lite' ),
		    'panel'          => 'appearance_panel', // Not typically needed.
		    'priority'       => 40,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );

		// Body Font Size (General)
		cleanresume_Kirki::add_field( 'body_font_size', array(
			'type'        => 'slider',
			'settings'    => 'body_font_size',
			'label'       => esc_attr__( 'Body Font Size', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'priority'    => 10,
			'default'     => 16,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
		) );
		
		// Title Font Size (Headings)
		cleanresume_Kirki::add_field( 'title_font_size', array(
			'type'        => 'slider',
			'settings'    => 'title_font_size',
			'label'       => esc_attr__( 'Title Font Size', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'priority'    => 20,
			'default'     => 24,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
		) );
		
		// Name Font Size (Headings)
		cleanresume_Kirki::add_field( 'name_font_size', array(
			'type'        => 'slider',
			'settings'    => 'name_font_size',
			'label'       => esc_attr__( 'Avatar Name Font Size', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'priority'    => 30,
			'default'     => 48,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
		) );

		cleanresume_Kirki::add_field( 'hr_spacing1', array(
			'type'        => 'custom',
			'settings'    => 'hr_spacing1',
			'label'       => __( '&nbsp;', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'default'     => '<hr></hr>',
			'priority'    => 40,
		) );

		// Body Font Family
		cleanresume_Kirki::add_field( 'body_font_family', array(
			'type'        => 'typography',
			'settings'    => 'body_font_family',
			'label'       => esc_attr__( 'Body Font Family', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				//'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'subset'         => array( 'latin-ext' ),
				//'color'          => '#333333',
				'text-transform' => 'none',
				'text-align'     => 'left'
			),
			'priority'    => 50,
			'output'      => array(
				array(
					'element' => 'body',
				),
			),
		) );

		cleanresume_Kirki::add_field( 'hr_spacing2', array(
			'type'        => 'custom',
			'settings'    => 'hr_spacing2',
			'label'       => __( '&nbsp;', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'default'     => '<hr></hr>',
			'priority'    => 60,
		) );
		
		// Headings Font Family
		cleanresume_Kirki::add_field( 'title_font_family', array(
			'type'        => 'typography',
			'settings'    => 'title_font_family',
			'label'       => esc_attr__( 'Title Font Family', 'cleanresume-lite' ),
			'section'     => 'typography_section',
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				//'font-size'      => '16px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				//'subset'         => array( 'latin-ext' ),
				//'color'          => '#333333',
				'text-transform' => 'none',
				'text-align'     => 'left'
			),
			'priority'    => 70,
			'output'      => array(
				array(
					'element' => 'body',
				),
			),
		) );

	
	
    //  ====================================
	// 	Social Media Section
    //  ====================================
    cleanresume_Kirki::add_section( 'social_settings', array(
	    'title'          => __( 'Social Media Icons', 'cleanresume-lite' ),
	    'description'    => __( 'Add social icons for resume and share buttons for blog', 'cleanresume-lite' ),
	    'panel'          => '', // Not typically needed.
	    'priority'       => 80,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
	
		// Header Social Section 
		cleanresume_Kirki::add_field( 'active_social', array(
			'type'        => 'toggle',
			'settings'    => 'active_social',
			'label'       => __( 'Show Social Icons', 'cleanresume-lite' ),
			'section'     => 'social_settings',
			'default'     => '0',
			'priority'    => 1,
		) );

		// Facebook
		cleanresume_Kirki::add_field( 'facebook_icon', array(
			'type'     => 'text',
			'settings' => 'facebook_icon',
			'label'    => __( 'Facebook URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 2,
		) );

		// Google Plus
		cleanresume_Kirki::add_field( 'googleplus_icon', array(
			'type'     => 'text',
			'settings' => 'googleplus_icon',
			'label'    => __( 'Google Plus URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 3,
		) );

		// Twitter
		cleanresume_Kirki::add_field( 'twitter_icon', array(
			'type'     => 'text',
			'settings' => 'twitter_icon',
			'label'    => __( 'Twitter URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 4,
		) );

		// LinkedIn
		cleanresume_Kirki::add_field( 'linkedin_icon', array(
			'type'     => 'text',
			'settings' => 'linkedin_icon',
			'label'    => __( 'LinkedIn URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 5,
		) );

		// Instagram
		cleanresume_Kirki::add_field( 'instagram_icon', array(
			'type'     => 'text',
			'settings' => 'instagram_icon',
			'label'    => __( 'Instagram URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 6,
		) );

		// Pinterest
		cleanresume_Kirki::add_field( 'pinterest_icon', array(
			'type'     => 'text',
			'settings' => 'pinterest_icon',
			'label'    => __( 'Pinterest URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 8,
		) );

		// Flickr
		cleanresume_Kirki::add_field( 'flickr_icon', array(
			'type'     => 'text',
			'settings' => 'flickr_icon',
			'label'    => __( 'Flickr URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 7,
		) );

		// Tumblr
		cleanresume_Kirki::add_field( 'tumblr_icon', array(
			'type'     => 'text',
			'settings' => 'tumblr_icon',
			'label'    => __( 'Tumblr URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 9,
		) );

		// Behance
		cleanresume_Kirki::add_field( 'behance_icon', array(
			'type'     => 'text',
			'settings' => 'behance_icon',
			'label'    => __( 'Behance URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 10,
		) );

		// Dribbble
		cleanresume_Kirki::add_field( 'dribbble_icon', array(
			'type'     => 'text',
			'settings' => 'dribbble_icon',
			'label'    => __( 'Dribbble URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 11,
		) );

		// 500px
		cleanresume_Kirki::add_field( 'fivehundred_icon', array(
			'type'     => 'text',
			'settings' => 'fivehundred_icon',
			'label'    => __( '500 URL', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 12,
		) );

		// Github
		cleanresume_Kirki::add_field( 'github_icon', array(
			'type'     => 'text',
			'settings' => 'github_icon',
			'label'    => __( 'Github', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 13,
		) );

		// Skype
		cleanresume_Kirki::add_field( 'skype_icon', array(
			'type'     => 'text',
			'settings' => 'skype_icon',
			'label'    => __( 'Skype ID', 'cleanresume-lite' ),
			'section'  => 'social_settings',
			'priority' => 14,
		) );


    // ====================================
	// Portfolio Section Setting
    // ====================================
	// Add Portfolio Section
	cleanresume_Kirki::add_section( 'portfolio_section', array(
	    'title'          => __( 'Portfolio', 'cleanresume-lite' ),
	    'description'    => __( 'Portfolio settings', 'cleanresume-lite' ),
	    'panel'          => '', // Not typically needed.
	    'priority'       => 99,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );
	
	// Show Portfolio Check
	cleanresume_Kirki::add_field( 'active_portfolio', array(
		'type'        => 'toggle',
		'settings'    => 'active_portfolio',
		'label'       => __( 'Show Portfolio', 'cleanresume-lite' ),
		'section'     => 'portfolio_section',
		'default'     => '0',
		'priority'    => 1,
	) );

	// Portfolio Section Title
	cleanresume_Kirki::add_field( 'portfolio_section_title', array(
		'type'     => 'text',
		'settings' => 'portfolio_section_title',
		'label'    => __( 'Portfolio Section Title', 'cleanresume-lite' ),
		'section'  => 'portfolio_section',
		'default'  => esc_attr__( 'My Portfolio', 'cleanresume-lite' ),
		'priority' => 10,
	) );

	// Number of Portfolio posts to show
	cleanresume_Kirki::add_field( 'portfolio_post_count', array(
		'type'        => 'slider',
		'settings'    => 'portfolio_post_count',
		'label'       => esc_attr__( 'Number of Portfolio posts to show', 'cleanresume-lite' ),
		'help'        => esc_attr__( 'Please slide through set of number of posts to show on website', 'cleanresume-lite' ),
		'section'     => 'portfolio_section',
		'default'     => 12,
		'choices'     => array(
			'min'  => '4',
			'max'  => '40',
			'step' => '4',
		),
		'priority' => 20,
	) );

	// Sorting of displaying portfolio posts 
	cleanresume_Kirki::add_field( 'portfolio_post_sortorder', array(
		'type'        => 'select',
		'settings'    => 'portfolio_post_sortorder',
		'label'       => __( 'Sort Order', 'cleanresume-lite' ),
		'section'     => 'portfolio_section',
		'default'     => 'ASC',
		'priority'    => 30,
		'multiple'    => 0,
		'choices'     => array(
			'ASC' => esc_attr__( 'Ascending', 'cleanresume-lite' ),
			'DESC' => esc_attr__( 'Descending', 'cleanresume-lite' ),
		),
	) );


    // ====================================
	// Miscellaneous Section Setting
    // ====================================

	// Add Miscellaneous Section
	cleanresume_Kirki::add_section( 'misc_section', array(
	    'title'          => __( 'Miscellaneous', 'cleanresume-lite' ),
	    'description'    => __( 'Miscellaneous settings for better user experience', 'cleanresume-lite' ),
	    'priority'       => 102,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '', // Rarely needed.
	) );

		// Show Preloader Check
		cleanresume_Kirki::add_field( 'active_preloader', array(
			'type'        => 'toggle',
			'settings'    => 'active_preloader',
			'label'       => __( 'Enable Preloader Animation', 'cleanresume-lite' ),
			'section'     => 'misc_section',
			'default'     => '1',
			'priority'    => 10,
		) );
						
		// Show Goto Top button
		cleanresume_Kirki::add_field( 'active_top', array(
			'type'        => 'toggle',
			'settings'    => 'active_top',
			'label'       => __( 'Show Go to Top Button', 'cleanresume-lite' ),
			'section'     => 'misc_section',
			'default'     => '1',
			'priority'    => 20,
		) );


    // ====================================
	// Content Sections & Titles Panel
    // ====================================
	
	cleanresume_Kirki::add_panel( 'content_sections_titles', array(
	    'priority'    => 26,
	    'title'       => __( 'Content Sections & Titles', 'cleanresume-lite' ),
	    'description' => __( 'Add/Edit text & titles for sections', 'cleanresume-lite' ),
	) );

		// ====================================
		// Identity Information Section Text
		// ====================================
		cleanresume_Kirki::add_section( 'identity_info_section', array(
		    'title'          => __( 'Identity Information Section', 'cleanresume-lite' ),
		    'description'    => __( 'Customize your Identity Information Section Text', 'cleanresume-lite' ),
		    'panel'          => 'content_sections_titles',
		    'priority'       => 10,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
		
			// Section Title Text
			cleanresume_Kirki::add_field( 'identity_info_section_title', array(
				'type'     => 'text',
				'settings' => 'identity_info_section_title',
				'label'    => __( 'Section Title', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'default'  => esc_attr__( 'Identity Information', 'cleanresume-lite' ),
				'priority' => 10,
			) );

			cleanresume_Kirki::add_field( 'hr_spacing20', array(
				'type'        => 'custom',
				'settings'    => 'hr_spacing20',
				'label'       => __( '&nbsp;', 'cleanresume-lite' ),
				'section'     => 'identity_info_section',
				'default'     => '<hr></hr>',
				'priority'    => 20,
			) );

			// Full Name Text
			cleanresume_Kirki::add_field( 'identity_info_fathername', array(
				'type'     => 'text',
				'settings' => 'identity_info_fathername',
				'label'    => __( 'Full Name', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				//'default'  => esc_attr__( 'Umair Razzaq', 'cleanresume-lite' ),
				'priority' => 30,
			) );
		
			// DOB 
			cleanresume_Kirki::add_field( 'identity_info_dob', array(
				'type'     => 'text',
				'settings' => 'identity_info_dob',
				'label'    => __( 'Date of Birth', 'cleanresume-lite' ),
				'help'    => __( 'Please enter your birth month, date and year. The format is MM/DD/YYYY', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 40,
			) );

			// Company-Organization
			cleanresume_Kirki::add_field( 'identity_info_company', array(
				'type'     => 'text',
				'settings' => 'identity_info_company',
				'label'    => __( 'Company / Organization', 'cleanresume-lite' ),
				'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 50,
			) );
		
			// Occupation 
			cleanresume_Kirki::add_field( 'identity_info_occupation', array(
				'type'     => 'text',
				'settings' => 'identity_info_occupation',
				'label'    => __( 'Occupation / Passion', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 60,
			) );

			// Nationl ID Number 
			cleanresume_Kirki::add_field( 'identity_info_id', array(
				'type'     => 'text',
				'settings' => 'identity_info_id',
				'label'    => __( 'National ID Number', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 70,
			) );

			// Passport Number 
			cleanresume_Kirki::add_field( 'identity_info_passport', array(
				'type'     => 'text',
				'settings' => 'identity_info_passport',
				'label'    => __( 'Passport Number', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 80,
			) );

			// Driving License Number 
			cleanresume_Kirki::add_field( 'identity_info_license', array(
				'type'     => 'text',
				'settings' => 'identity_info_license',
				'label'    => __( 'Driving License Number', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 90,
			) );

			// Social Security Number 
			cleanresume_Kirki::add_field( 'identity_info_social', array(
				'type'     => 'text',
				'settings' => 'identity_info_social',
				'label'    => __( 'Social Security Number', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 100,
			) );

			// City 
			cleanresume_Kirki::add_field( 'identity_info_city', array(
				'type'     => 'text',
				'settings' => 'identity_info_city',
				'label'    => __( 'City', 'cleanresume-lite' ),
				//'help'    => __( 'Please enter the name of your company or organization', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				'priority' => 110,
			) );

			// Show Countery Check
			cleanresume_Kirki::add_field( 'active_country', array(
				'type'        => 'toggle',
				'settings'    => 'active_country',
				'label'       => __( 'Show Country', 'cleanresume-lite' ),
				'section'     => 'identity_info_section',
				'default'     => '0',
				'priority'    => 120,
			) );
		
				// Country (Location) 
			cleanresume_Kirki::add_field( 'identity_info_country', array(
				'type'        => 'select',
				'settings'    => 'identity_info_country',
				'label'       => __( 'Country', 'cleanresume-lite' ),
				'section'     => 'identity_info_section',
				//'default'     => 'United States of America',
				'priority'    => 130,
				'multiple'    => 0,
				'choices'    => array(
					'Afganistan' => esc_attr__( 'Afghanistan', 'cleanresume-lite' ),
					'Albania' => esc_attr__( 'Albania', 'cleanresume-lite' ),
					'Algeria' => esc_attr__( 'Algeria', 'cleanresume-lite' ),
					'American Samoa' => esc_attr__( 'American Samoa', 'cleanresume-lite' ),
					'Andorra' => esc_attr__( 'Andorra', 'cleanresume-lite' ),
					'Angola' => esc_attr__( 'Angola', 'cleanresume-lite' ),
					'Anguilla' => esc_attr__( 'Anguilla', 'cleanresume-lite' ),
					'Antigua &amp; Barbuda' => esc_attr__( 'Antigua &amp; Barbuda', 'cleanresume-lite' ),
					'Argentina' => esc_attr__( 'Argentina', 'cleanresume-lite' ),
					'Armenia' => esc_attr__( 'Armenia', 'cleanresume-lite' ),
					'Aruba' => esc_attr__( 'Aruba', 'cleanresume-lite' ),
					'Australia' => esc_attr__( 'Australia', 'cleanresume-lite' ),
					'Austria' => esc_attr__( 'Austria', 'cleanresume-lite' ),
					'Azerbaijan' => esc_attr__( 'Azerbaijan', 'cleanresume-lite' ),
					'Bahamas' => esc_attr__( 'Bahamas', 'cleanresume-lite' ),
					'Bahrain' => esc_attr__( 'Bahrain', 'cleanresume-lite' ),
					'Bangladesh' => esc_attr__( 'Bangladesh', 'cleanresume-lite' ),
					'Barbados' => esc_attr__( 'Barbados', 'cleanresume-lite' ),
					'Belarus' => esc_attr__( 'Belarus', 'cleanresume-lite' ),
					'Belgium' => esc_attr__( 'Belgium', 'cleanresume-lite' ),
					'Belize' => esc_attr__( 'Belize', 'cleanresume-lite' ),
					'Benin' => esc_attr__( 'Benin', 'cleanresume-lite' ),
					'Bermuda' => esc_attr__( 'Bermuda', 'cleanresume-lite' ),
					'Bhutan' => esc_attr__( 'Bhutan', 'cleanresume-lite' ),
					'Bolivia' => esc_attr__( 'Bolivia', 'cleanresume-lite' ),
					'Bonaire' => esc_attr__( 'Bonaire', 'cleanresume-lite' ),
					'Bosnia &amp; Herzegovina' => esc_attr__( 'Bosnia &amp; Herzegovina', 'cleanresume-lite' ),
					'Botswana' => esc_attr__( 'Botswana', 'cleanresume-lite' ),
					'Brazil' => esc_attr__( 'Brazil', 'cleanresume-lite' ),
					'British Indian Ocean Ter' => esc_attr__( 'British Indian Ocean Ter', 'cleanresume-lite' ),
					'Brunei' => esc_attr__( 'Brunei', 'cleanresume-lite' ),
					'Bulgaria' => esc_attr__( 'Bulgaria', 'cleanresume-lite' ),
					'Burkina Faso' => esc_attr__( 'Burkina Faso', 'cleanresume-lite' ),
					'Burundi' => esc_attr__( 'Burundi', 'cleanresume-lite' ),
					'Cambodia' => esc_attr__( 'Cambodia', 'cleanresume-lite' ),
					'Cameroon' => esc_attr__( 'Cameroon', 'cleanresume-lite' ),
					'Canada' => esc_attr__( 'Canada', 'cleanresume-lite' ),
					'Canary Islands' => esc_attr__( 'Canary Islands', 'cleanresume-lite' ),
					'Cape Verde' => esc_attr__( 'Cape Verde', 'cleanresume-lite' ),
					'Cayman Islands' => esc_attr__( 'Cayman Islands', 'cleanresume-lite' ),
					'Central African Republic' => esc_attr__( 'Central African Republic', 'cleanresume-lite' ),
					'Chad' => esc_attr__( 'Chad', 'cleanresume-lite' ),
					'Channel Islands' => esc_attr__( 'Channel Islands', 'cleanresume-lite' ),
					'Chile' => esc_attr__( 'Chile', 'cleanresume-lite' ),
					'China' => esc_attr__( 'China', 'cleanresume-lite' ),
					'Christmas Island' => esc_attr__( 'Christmas Island', 'cleanresume-lite' ),
					'Cocos Island' => esc_attr__( 'Cocos Island', 'cleanresume-lite' ),
					'Colombia' => esc_attr__( 'Colombia', 'cleanresume-lite' ),
					'Comoros' => esc_attr__( 'Comoros', 'cleanresume-lite' ),
					'Congo' => esc_attr__( 'Congo', 'cleanresume-lite' ),
					'Cook Islands' => esc_attr__( 'Cook Islands', 'cleanresume-lite' ),
					'Costa Rica' => esc_attr__( 'Costa Rica', 'cleanresume-lite' ),
					'Cote DIvoire' => esc_attr__( 'Cote DIvoire', 'cleanresume-lite' ),
					'Croatia' => esc_attr__( 'Croatia', 'cleanresume-lite' ),
					'Cuba' => esc_attr__( 'Cuba', 'cleanresume-lite' ),
					'Curaco' => esc_attr__( 'Curacao', 'cleanresume-lite' ),
					'Cyprus' => esc_attr__( 'Cyprus', 'cleanresume-lite' ),
					'Czech Republic' => esc_attr__( 'Czech Republic', 'cleanresume-lite' ),
					'Denmark' => esc_attr__( 'Denmark', 'cleanresume-lite' ),
					'Djibouti' => esc_attr__( 'Djibouti', 'cleanresume-lite' ),
					'Dominica' => esc_attr__( 'Dominica', 'cleanresume-lite' ),
					'Dominican Republic' => esc_attr__( 'Dominican Republic', 'cleanresume-lite' ),
					'East Timor' => esc_attr__( 'East Timor', 'cleanresume-lite' ),
					'Ecuador' => esc_attr__( 'Ecuador', 'cleanresume-lite' ),
					'Egypt' => esc_attr__( 'Egypt', 'cleanresume-lite' ),
					'El Salvador' => esc_attr__( 'El Salvador', 'cleanresume-lite' ),
					'Equatorial Guinea' => esc_attr__( 'Equatorial Guinea', 'cleanresume-lite' ),
					'Eritrea' => esc_attr__( 'Eritrea', 'cleanresume-lite' ),
					'Estonia' => esc_attr__( 'Estonia', 'cleanresume-lite' ),
					'Ethiopia' => esc_attr__( 'Ethiopia', 'cleanresume-lite' ),
					'Falkland Islands' => esc_attr__( 'Falkland Islands', 'cleanresume-lite' ),
					'Faroe Islands' => esc_attr__( 'Faroe Islands', 'cleanresume-lite' ),
					'Fiji' => esc_attr__( 'Fiji', 'cleanresume-lite' ),
					'Finland' => esc_attr__( 'Finland', 'cleanresume-lite' ),
					'France' => esc_attr__( 'France', 'cleanresume-lite' ),
					'French Guiana' => esc_attr__( 'French Guiana', 'cleanresume-lite' ),
					'French Polynesia' => esc_attr__( 'French Polynesia', 'cleanresume-lite' ),
					'French Southern Ter' => esc_attr__( 'French Southern Ter', 'cleanresume-lite' ),
					'Gabon' => esc_attr__( 'Gabon', 'cleanresume-lite' ),
					'Gambia' => esc_attr__( 'Gambia', 'cleanresume-lite' ),
					'Georgia' => esc_attr__( 'Georgia', 'cleanresume-lite' ),
					'Germany' => esc_attr__( 'Germany', 'cleanresume-lite' ),
					'Ghana' => esc_attr__( 'Ghana', 'cleanresume-lite' ),
					'Gibraltar' => esc_attr__( 'Gibraltar', 'cleanresume-lite' ),
					'Great Britain' => esc_attr__( 'Great Britain', 'cleanresume-lite' ),
					'Greece' => esc_attr__( 'Greece', 'cleanresume-lite' ),
					'Greenland' => esc_attr__( 'Greenland', 'cleanresume-lite' ),
					'Grenada' => esc_attr__( 'Grenada', 'cleanresume-lite' ),
					'Guadeloupe' => esc_attr__( 'Guadeloupe', 'cleanresume-lite' ),
					'Guam' => esc_attr__( 'Guam', 'cleanresume-lite' ),
					'Guatemala' => esc_attr__( 'Guatemala', 'cleanresume-lite' ),
					'Guinea' => esc_attr__( 'Guinea', 'cleanresume-lite' ),
					'Guyana' => esc_attr__( 'Guyana', 'cleanresume-lite' ),
					'Haiti' => esc_attr__( 'Haiti', 'cleanresume-lite' ),
					'Hawaii' => esc_attr__( 'Hawaii', 'cleanresume-lite' ),
					'Honduras' => esc_attr__( 'Honduras', 'cleanresume-lite' ),
					'Hong Kong' => esc_attr__( 'Hong Kong', 'cleanresume-lite' ),
					'Hungary' => esc_attr__( 'Hungary', 'cleanresume-lite' ),
					'Iceland' => esc_attr__( 'Iceland', 'cleanresume-lite' ),
					'India' => esc_attr__( 'India', 'cleanresume-lite' ),
					'Indonesia' => esc_attr__( 'Indonesia', 'cleanresume-lite' ),
					'Iran' => esc_attr__( 'Iran', 'cleanresume-lite' ),
					'Iraq' => esc_attr__( 'Iraq', 'cleanresume-lite' ),
					'Ireland' => esc_attr__( 'Ireland', 'cleanresume-lite' ),
					'Isle of Man' => esc_attr__( 'Isle of Man', 'cleanresume-lite' ),
					'Israel' => esc_attr__( 'Israel', 'cleanresume-lite' ),
					'Italy' => esc_attr__( 'Italy', 'cleanresume-lite' ),
					'Jamaica' => esc_attr__( 'Jamaica', 'cleanresume-lite' ),
					'Japan' => esc_attr__( 'Japan', 'cleanresume-lite' ),
					'Jordan' => esc_attr__( 'Jordan', 'cleanresume-lite' ),
					'Kazakhstan' => esc_attr__( 'Kazakhstan', 'cleanresume-lite' ),
					'Kenya' => esc_attr__( 'Kenya', 'cleanresume-lite' ),
					'Kiribati' => esc_attr__( 'Kiribati', 'cleanresume-lite' ),
					'Korea North' => esc_attr__( 'Korea North', 'cleanresume-lite' ),
					'Korea Sout' => esc_attr__( 'Korea South', 'cleanresume-lite' ),
					'Kuwait' => esc_attr__( 'Kuwait', 'cleanresume-lite' ),
					'Kyrgyzstan' => esc_attr__( 'Kyrgyzstan', 'cleanresume-lite' ),
					'Laos' => esc_attr__( 'Laos', 'cleanresume-lite' ),
					'Latvia' => esc_attr__( 'Latvia', 'cleanresume-lite' ),
					'Lebanon' => esc_attr__( 'Lebanon', 'cleanresume-lite' ),
					'Lesotho' => esc_attr__( 'Lesotho', 'cleanresume-lite' ),
					'Liberia' => esc_attr__( 'Liberia', 'cleanresume-lite' ),
					'Libya' => esc_attr__( 'Libya', 'cleanresume-lite' ),
					'Liechtenstein' => esc_attr__( 'Liechtenstein', 'cleanresume-lite' ),
					'Lithuania' => esc_attr__( 'Lithuania', 'cleanresume-lite' ),
					'Luxembourg' => esc_attr__( 'Luxembourg', 'cleanresume-lite' ),
					'Macau' => esc_attr__( 'Macau', 'cleanresume-lite' ),
					'Macedonia' => esc_attr__( 'Macedonia', 'cleanresume-lite' ),
					'Madagascar' => esc_attr__( 'Madagascar', 'cleanresume-lite' ),
					'Malaysia' => esc_attr__( 'Malaysia', 'cleanresume-lite' ),
					'Malawi' => esc_attr__( 'Malawi', 'cleanresume-lite' ),
					'Maldives' => esc_attr__( 'Maldives', 'cleanresume-lite' ),
					'Mali' => esc_attr__( 'Mali', 'cleanresume-lite' ),
					'Malta' => esc_attr__( 'Malta', 'cleanresume-lite' ),
					'Marshall Islands' => esc_attr__( 'Marshall Islands', 'cleanresume-lite' ),
					'Martinique' => esc_attr__( 'Martinique', 'cleanresume-lite' ),
					'Mauritania' => esc_attr__( 'Mauritania', 'cleanresume-lite' ),
					'Mauritius' => esc_attr__( 'Mauritius', 'cleanresume-lite' ),
					'Mayotte' => esc_attr__( 'Mayotte', 'cleanresume-lite' ),
					'Mexico' => esc_attr__( 'Mexico', 'cleanresume-lite' ),
					'Midway Islands' => esc_attr__( 'Midway Islands', 'cleanresume-lite' ),
					'Moldova' => esc_attr__( 'Moldova', 'cleanresume-lite' ),
					'Monaco' => esc_attr__( 'Monaco', 'cleanresume-lite' ),
					'Mongolia' => esc_attr__( 'Mongolia', 'cleanresume-lite' ),
					'Montserrat' => esc_attr__( 'Montserrat', 'cleanresume-lite' ),
					'Morocco' => esc_attr__( 'Morocco', 'cleanresume-lite' ),
					'Mozambique' => esc_attr__( 'Mozambique', 'cleanresume-lite' ),
					'Myanmar' => esc_attr__( 'Myanmar', 'cleanresume-lite' ),
					'Nambia' => esc_attr__( 'Nambia', 'cleanresume-lite' ),
					'Nauru' => esc_attr__( 'Nauru', 'cleanresume-lite' ),
					'Nepal' => esc_attr__( 'Nepal', 'cleanresume-lite' ),
					'Netherland Antilles' => esc_attr__( 'Netherland Antilles', 'cleanresume-lite' ),
					'Netherlands' => esc_attr__( 'Netherlands (Holland, Europe)', 'cleanresume-lite' ),
					'Nevis' => esc_attr__( 'Nevis', 'cleanresume-lite' ),
					'New Caledonia' => esc_attr__( 'New Caledonia', 'cleanresume-lite' ),
					'New Zealand' => esc_attr__( 'New Zealand', 'cleanresume-lite' ),
					'Nicaragua' => esc_attr__( 'Nicaragua', 'cleanresume-lite' ),
					'Niger' => esc_attr__( 'Niger', 'cleanresume-lite' ),
					'Nigeria' => esc_attr__( 'Nigeria', 'cleanresume-lite' ),
					'Niue' => esc_attr__( 'Niue', 'cleanresume-lite' ),
					'Norfolk Island' => esc_attr__( 'Norfolk Island', 'cleanresume-lite' ),
					'Norway' => esc_attr__( 'Norway', 'cleanresume-lite' ),
					'Oman' => esc_attr__( 'Oman', 'cleanresume-lite' ),
					'Pakistan' => esc_attr__( 'Pakistan', 'cleanresume-lite' ),
					'Palau Island' => esc_attr__( 'Palau Island', 'cleanresume-lite' ),
					'Palestine' => esc_attr__( 'Palestine', 'cleanresume-lite' ),
					'Panama' => esc_attr__( 'Panama', 'cleanresume-lite' ),
					'Papua New Guinea' => esc_attr__( 'Papua New Guinea', 'cleanresume-lite' ),
					'Paraguay' => esc_attr__( 'Paraguay', 'cleanresume-lite' ),
					'Peru' => esc_attr__( 'Peru', 'cleanresume-lite' ),
					'Phillipines' => esc_attr__( 'Philippines', 'cleanresume-lite' ),
					'Pitcairn Island' => esc_attr__( 'Pitcairn Island', 'cleanresume-lite' ),
					'Poland' => esc_attr__( 'Poland', 'cleanresume-lite' ),
					'Portugal' => esc_attr__( 'Portugal', 'cleanresume-lite' ),
					'Puerto Rico' => esc_attr__( 'Puerto Rico', 'cleanresume-lite' ),
					'Qatar' => esc_attr__( 'Qatar', 'cleanresume-lite' ),
					'Republic of Montenegro' => esc_attr__( 'Republic of Montenegro', 'cleanresume-lite' ),
					'Republic of Serbia' => esc_attr__( 'Republic of Serbia', 'cleanresume-lite' ),
					'Reunion' => esc_attr__( 'Reunion', 'cleanresume-lite' ),
					'Romania' => esc_attr__( 'Romania', 'cleanresume-lite' ),
					'Russia' => esc_attr__( 'Russia', 'cleanresume-lite' ),
					'Rwanda' => esc_attr__( 'Rwanda', 'cleanresume-lite' ),
					'St Barthelemy' => esc_attr__( 'St Barthelemy', 'cleanresume-lite' ),
					'St Eustatius' => esc_attr__( 'St Eustatius', 'cleanresume-lite' ),
					'St Helena' => esc_attr__( 'St Helena', 'cleanresume-lite' ),
					'St Kitts-Nevis' => esc_attr__( 'St Kitts-Nevis', 'cleanresume-lite' ),
					'St Lucia' => esc_attr__( 'St Lucia', 'cleanresume-lite' ),
					'St Maarten' => esc_attr__( 'St Maarten', 'cleanresume-lite' ),
					'St Pierre &amp; Miquelon' => esc_attr__( 'St Pierre &amp; Miquelon', 'cleanresume-lite' ),
					'St Vincent &amp; Grenadines' => esc_attr__( 'St Vincent &amp; Grenadines', 'cleanresume-lite' ),
					'Saipan' => esc_attr__( 'Saipan', 'cleanresume-lite' ),
					'Samoa' => esc_attr__( 'Samoa', 'cleanresume-lite' ),
					'Samoa American' => esc_attr__( 'Samoa American', 'cleanresume-lite' ),
					'San Marino' => esc_attr__( 'San Marino', 'cleanresume-lite' ),
					'Sao Tome &amp; Principe' => esc_attr__( 'Sao Tome &amp; Principe', 'cleanresume-lite' ),
					'Saudi Arabia' => esc_attr__( 'Saudi Arabia', 'cleanresume-lite' ),
					'Senegal' => esc_attr__( 'Senegal', 'cleanresume-lite' ),
					'Serbia' => esc_attr__( 'Serbia', 'cleanresume-lite' ),
					'Seychelles' => esc_attr__( 'Seychelles', 'cleanresume-lite' ),
					'Sierra Leone' => esc_attr__( 'Sierra Leone', 'cleanresume-lite' ),
					'Singapore' => esc_attr__( 'Singapore', 'cleanresume-lite' ),
					'Slovakia' => esc_attr__( 'Slovakia', 'cleanresume-lite' ),
					'Slovenia' => esc_attr__( 'Slovenia', 'cleanresume-lite' ),
					'Solomon Islands' => esc_attr__( 'Solomon Islands', 'cleanresume-lite' ),
					'Somalia' => esc_attr__( 'Somalia', 'cleanresume-lite' ),
					'South Africa' => esc_attr__( 'South Africa', 'cleanresume-lite' ),
					'Spain' => esc_attr__( 'Spain', 'cleanresume-lite' ),
					'Sri Lanka' => esc_attr__( 'Sri Lanka', 'cleanresume-lite' ),
					'Sudan' => esc_attr__( 'Sudan', 'cleanresume-lite' ),
					'Suriname' => esc_attr__( 'Suriname', 'cleanresume-lite' ),
					'Swaziland' => esc_attr__( 'Swaziland', 'cleanresume-lite' ),
					'Sweden' => esc_attr__( 'Sweden', 'cleanresume-lite' ),
					'Switzerland' => esc_attr__( 'Switzerland', 'cleanresume-lite' ),
					'Syria' => esc_attr__( 'Syria', 'cleanresume-lite' ),
					'Tahiti' => esc_attr__( 'Tahiti', 'cleanresume-lite' ),
					'Taiwan' => esc_attr__( 'Taiwan', 'cleanresume-lite' ),
					'Tajikistan' => esc_attr__( 'Tajikistan', 'cleanresume-lite' ),
					'Tanzania' => esc_attr__( 'Tanzania', 'cleanresume-lite' ),
					'Thailand' => esc_attr__( 'Thailand', 'cleanresume-lite' ),
					'Togo' => esc_attr__( 'Togo', 'cleanresume-lite' ),
					'Tokelau' => esc_attr__( 'Tokelau', 'cleanresume-lite' ),
					'Tonga' => esc_attr__( 'Tonga', 'cleanresume-lite' ),
					'Trinidad &amp; Tobago' => esc_attr__( 'Trinidad &amp; Tobago', 'cleanresume-lite' ),
					'Tunisia' => esc_attr__( 'Tunisia', 'cleanresume-lite' ),
					'Turkey' => esc_attr__( 'Turkey', 'cleanresume-lite' ),
					'Turkmenistan' => esc_attr__( 'Turkmenistan', 'cleanresume-lite' ),
					'Turks &amp; Caicos Is' => esc_attr__( 'Turks &amp; Caicos Is', 'cleanresume-lite' ),
					'Tuvalu' => esc_attr__( 'Tuvalu', 'cleanresume-lite' ),
					'Uganda' => esc_attr__( 'Uganda', 'cleanresume-lite' ),
					'Ukraine' => esc_attr__( 'Ukraine', 'cleanresume-lite' ),
					'United Arab Erimates' => esc_attr__( 'United Arab Emirates', 'cleanresume-lite' ),
					'United Kingdom' => esc_attr__( 'United Kingdom', 'cleanresume-lite' ),
					'United States of America' => esc_attr__( 'United States of America', 'cleanresume-lite' ),
					'Uraguay' => esc_attr__( 'Uruguay', 'cleanresume-lite' ),
					'Uzbekistan' => esc_attr__( 'Uzbekistan', 'cleanresume-lite' ),
					'Vanuatu' => esc_attr__( 'Vanuatu', 'cleanresume-lite' ),
					'Vatican City State' => esc_attr__( 'Vatican City State', 'cleanresume-lite' ),
					'Venezuela' => esc_attr__( 'Venezuela', 'cleanresume-lite' ),
					'Vietnam' => esc_attr__( 'Vietnam', 'cleanresume-lite' ),
					'Virgin Islands (Brit)' => esc_attr__( 'Virgin Islands (Brit)', 'cleanresume-lite' ),
					'Virgin Islands (USA)' => esc_attr__( 'Virgin Islands (USA)', 'cleanresume-lite' ),
					'Wake Island' => esc_attr__( 'Wake Island', 'cleanresume-lite' ),
					'Wallis &amp; Futana Is' => esc_attr__( 'Wallis &amp; Futana Is', 'cleanresume-lite' ),
					'Yemen' => esc_attr__( 'Yemen', 'cleanresume-lite' ),
					'Zaire' => esc_attr__( 'Zaire', 'cleanresume-lite' ),
					'Zambia' => esc_attr__( 'Zambia', 'cleanresume-lite' ),
					'Zimbabwe' => esc_attr__( 'Zimbabwe', 'cleanresume-lite' ),
				),
			) );
		
			// Address 
			cleanresume_Kirki::add_field( 'identity_info_address', array(
				'type'     => 'textarea',
				'settings' => 'identity_info_address',
				'label'    => __( 'Address', 'cleanresume-lite' ),
				'section'  => 'identity_info_section',
				//'default'  => esc_attr__( 'This is a defualt value', 'cleanresume-lite' ),
				'priority' => 140,
			) );


		// ====================================
		// About Content Section
		// ====================================
		cleanresume_Kirki::add_section( 'about_content_section', array(
		    'title'          => __( 'About Section', 'cleanresume-lite' ),
		    'description'    => __( 'Add/Edit text for about sections', 'cleanresume-lite' ),
		    'panel'          => 'content_sections_titles',
		    'priority'       => 20,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );

			// About Section Title 
			cleanresume_Kirki::add_field( 'about_section_title', array(
				'type'     => 'text',
				'settings' => 'about_section_title',
				'label'    => __( 'About Section Title', 'cleanresume-lite' ),
				'section'  => 'about_content_section',
				'default'  => esc_attr__( 'Short About Me', 'cleanresume-lite' ),
				'priority' => 10,
			) );

			// About Content Excerpt
			cleanresume_Kirki::add_field( 'about_content_excerpt', array(
				'type'        => 'toggle',
				'settings'    => 'about_content_excerpt',
				'label'       => __( 'Show Content Excerpt', 'cleanresume-lite' ),
				'help'       => __( 'Show read more collapsing button with fewer text and click on button will expand complete content', 'cleanresume-lite' ),
				'section'     => 'about_content_section',
				'default'     => '0',
				'priority'    => 20,
			) );

			// About Section Content 
			cleanresume_Kirki::add_field( 'about_section_content', array(
			    'type'        => 'editor',
			    'setting'     => 'about_section_content',
			    'label'       => __( 'About Section Content', 'cleanresume-lite' ),
			    'section'     => 'about_content_section',
			    'priority'    => 30,
			) );


		// ====================================
		// Experience Content Section
		// ====================================
		cleanresume_Kirki::add_section( 'experience_content_section', array(
		    'title'          => __( 'Experience Section', 'cleanresume-lite' ),
		    'description'    => __( 'Add/Edit text for experience sections', 'cleanresume-lite' ),
		    'panel'          => 'content_sections_titles',
		    'priority'       => 30,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );

			// Experience Section Title 
			cleanresume_Kirki::add_field( 'experience_section_title', array(
				'type'     => 'text',
				'settings' => 'experience_section_title',
				'label'    => __( 'Experience Section Title', 'cleanresume-lite' ),
				'section'  => 'experience_content_section',
				'default'  => esc_attr__( 'Professional Experience', 'cleanresume-lite' ),
				'priority' => 10,
			) );

			// Experience Content Excerpt
			cleanresume_Kirki::add_field( 'experience_content_excerpt', array(
				'type'        => 'toggle',
				'settings'    => 'experience_content_excerpt',
				'label'       => __( 'Show Content Excerpt', 'cleanresume-lite' ),
				'help'       => __( 'Show read more collapsing button with fewer text and click on button will expand complete content', 'cleanresume-lite' ),
				'section'     => 'experience_content_section',
				'default'     => '0',
				'priority'    => 20,
			) );

			// Number of experience posts to show 
			cleanresume_Kirki::add_field( 'experience_post_count', array(
				'type'        => 'number',
				'settings'    => 'experience_post_count',
				'label'       => esc_attr__( 'Number of experience posts to show', 'cleanresume-lite' ),
				'section'     => 'experience_content_section',
				'default'     => 4,
				'priority'    => 30,
			) );

			// Sorting of displaying experience posts 
			cleanresume_Kirki::add_field( 'experience_post_sortorder', array(
				'type'        => 'select',
				'settings'    => 'experience_post_sortorder',
				'label'       => __( 'Sort Order', 'cleanresume-lite' ),
				'section'     => 'experience_content_section',
				'default'     => 'ASC',
				'priority'    => 40,
				'multiple'    => 0,
				'choices'     => array(
					'ASC' => esc_attr__( 'Ascending', 'cleanresume-lite' ),
					'DESC' => esc_attr__( 'Descending', 'cleanresume-lite' ),
				),
			) );


		// ====================================
		// Education Content Section
		// ====================================
		cleanresume_Kirki::add_section( 'education_content_section', array(
		    'title'          => __( 'Education Section', 'cleanresume-lite' ),
		    'description'    => __( 'Add/Edit text for education sections', 'cleanresume-lite' ),
		    'panel'          => 'content_sections_titles',
		    'priority'       => 40,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );

			// Experience Section Title 
			cleanresume_Kirki::add_field( 'education_section_title', array(
				'type'     => 'text',
				'settings' => 'education_section_title',
				'label'    => __( 'Education Section Title', 'cleanresume-lite' ),
				'section'  => 'education_content_section',
				'default'  => esc_attr__( 'Education History', 'cleanresume-lite' ),
				'priority' => 10,
			) );

			// Experience Content Excerpt
			cleanresume_Kirki::add_field( 'education_content_excerpt', array(
				'type'        => 'toggle',
				'settings'    => 'education_content_excerpt',
				'label'       => __( 'Show Content Excerpt', 'cleanresume-lite' ),
				'help'       => __( 'Show read more collapsing button with fewer text and click on button will expand complete content', 'cleanresume-lite' ),
				'section'     => 'education_content_section',
				'default'     => '0',
				'priority'    => 20,
			) );

			// Number of expereince posts to show 
			cleanresume_Kirki::add_field( 'education_post_count', array(
				'type'        => 'number',
				'settings'    => 'education_post_count',
				'label'       => esc_attr__( 'Number of posts to show', 'cleanresume-lite' ),
				'section'     => 'education_content_section',
				'default'     => 3,
				'priority'    => 30,
			) );

			// Sorting of displaying posts 
			cleanresume_Kirki::add_field( 'education_post_sortorder', array(
				'type'        => 'select',
				'settings'    => 'education_post_sortorder',
				'label'       => __( 'Sort Order', 'cleanresume-lite' ),
				'section'     => 'education_content_section',
				'default'     => 'ASC',
				'priority'    => 40,
				'multiple'    => 0,
				'choices'     => array(
					'ASC' => esc_attr__( 'Ascending', 'cleanresume-lite' ),
					'DESC' => esc_attr__( 'Descending', 'cleanresume-lite' ),
				),
			) );



		// ====================================
		// Sidebar Titles (Headings) Section
		// ====================================
		cleanresume_Kirki::add_section( 'sidebar_section_titles', array(
		    'title'          => __( 'Sidebar Section Titles & Content', 'cleanresume-lite' ),
		    'description'    => __( 'Add/Edit title text for sidebar sections', 'cleanresume-lite' ),
		    'panel'          => 'content_sections_titles',
		    'priority'       => 50,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
				
			// Skills Heading Text 
			cleanresume_Kirki::add_field( 'skills_section_title', array(
				'type'     => 'text',
				'settings' => 'skills_section_title',
				'label'    => __( 'Skills Section Title', 'cleanresume-lite' ),
				'section'  => 'sidebar_section_titles',
				'default'  => esc_attr__( 'My Skills', 'cleanresume-lite' ),
				'priority' => 10,
			) );

			cleanresume_Kirki::add_field( 'hr_spacing012', array(
				'type'        => 'custom',
				'settings'    => 'hr_spacing012',
				'label'       => __( '&nbsp;', 'cleanresume-lite' ),
				'section'     => 'sidebar_section_titles',
				'default'     => '<hr></hr>',
				'priority'    => 15,
			) );

			// Services Heading Text (What i do)
			cleanresume_Kirki::add_field( 'services_section_title', array(
				'type'     => 'text',
				'settings' => 'services_section_title',
				'label'    => __( 'Services Section Title', 'cleanresume-lite' ),
				'section'  => 'sidebar_section_titles',
				'default'  => esc_attr__( 'What I Do', 'cleanresume-lite' ),
				'priority' => 20,
			) );

			// Interest & Hobbies Section Content 
			cleanresume_Kirki::add_field( 'services_section_content', array(
			    'type'        => 'textarea',
			    'setting'     => 'services_section_content',
			    'label'       => __( 'Services Section Content', 'cleanresume-lite' ),
			    'section'     => 'sidebar_section_titles',
			    'description'     => __( 'Please add Services text per line.', 'cleanresume-lite' ),
			    'priority'    => 30,
			) );

			cleanresume_Kirki::add_field( 'hr_spacing010', array(
				'type'        => 'custom',
				'settings'    => 'hr_spacing010',
				'label'       => __( '&nbsp;', 'cleanresume-lite' ),
				'section'     => 'sidebar_section_titles',
				'default'     => '<hr></hr>',
				'priority'    => 35,
			) );

			// Interest & Hobbies Heading Text
			cleanresume_Kirki::add_field( 'interest_section_title', array(
				'type'     => 'text',
				'settings' => 'interest_section_title',
				'label'    => __( 'Interest Section Title', 'cleanresume-lite' ),
				'section'  => 'sidebar_section_titles',
				'default'  => esc_attr__( 'Interests & Hobbies', 'cleanresume-lite' ),
				'priority' => 40,
			) );

			// Interest & Hobbies Section Content 
			cleanresume_Kirki::add_field( 'interest_section_content', array(
			    'type'        => 'textarea',
			    'setting'     => 'interest_section_content',
			    'label'       => __( 'Interest Section Content', 'cleanresume-lite' ),
			    'section'     => 'sidebar_section_titles',
			    'description'     => __( 'Please add Interest or Hobbies text per line.', 'cleanresume-lite' ),
			    'priority'    => 50,
			) );

			cleanresume_Kirki::add_field( 'hr_spacing011', array(
				'type'        => 'custom',
				'settings'    => 'hr_spacing011',
				'label'       => __( '&nbsp;', 'cleanresume-lite' ),
				'section'     => 'sidebar_section_titles',
				'default'     => '<hr></hr>',
				'priority'    => 55,
			) );

			// Language Heading Text
			cleanresume_Kirki::add_field( 'language_section_title', array(
				'type'     => 'text',
				'settings' => 'language_section_title',
				'label'    => __( 'Language Section Title', 'cleanresume-lite' ),
				'section'  => 'sidebar_section_titles',
				'default'  => esc_attr__( 'What i Speak', 'cleanresume-lite' ),
				'priority' => 60,
			) );

	

	
    // ====================================
	// Custom Styles & Scripts Panel
    // ====================================
	
	cleanresume_Kirki::add_panel( 'styles_scripts_panel', array(
	    'priority'    => 160,
	    'title'       => __( 'Custom Styles & Scripts', 'cleanresume-lite' ),
	    'description' => __( 'Add Custom CSS Styles and Javascripts', 'cleanresume-lite' ),
	) );

		// ====================================
		// Custom CSS Section
		// ====================================
		cleanresume_Kirki::add_section( 'custom_css_section', array(
		    'title'          => __( 'Custom CSS', 'cleanresume-lite' ),
		    'description'    => __( 'Add custom CSS here', 'cleanresume-lite' ),
		    'panel'          => 'styles_scripts_panel',
		    'priority'       => 60,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
			cleanresume_Kirki::add_field( 'custom_css', array(
				'type'        => 'code',
				'settings'    => 'custom_css',
				'label'       => __( 'Custom CSS Styling', 'cleanresume-lite' ),
				'section'     => 'custom_css_section',
				//'default'     => 'body { background: #fff; }',
				'priority'    => 60,
				'choices'     => array(
					'language' => 'css',
					'theme'    => 'monokai',
					'height'   => 500,
				),
			) );
			
		// ====================================
		// Custom Javascript Section
		// ====================================
		cleanresume_Kirki::add_section( 'custom_javascript_section', array(
		    'title'          => __( 'Custom Javascript', 'cleanresume-lite' ),
		    'description'    => __( 'Add custom javascript (jquery) code here', 'cleanresume-lite' ),
		    'panel'          => 'styles_scripts_panel',
		    'priority'       => 60,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
			cleanresume_Kirki::add_field( 'custom_javascript', array(
				'type'        => 'code',
				'settings'    => 'custom_javascript',
				'label'       => __( 'Custom Javascript', 'cleanresume-lite' ),
				'section'     => 'custom_javascript_section',
				//'default'     => 'body { background: #fff; }',
				'priority'    => 60,
				'choices'     => array(
					'language' => 'css',
					'theme'    => 'monokai',
					'height'   => 500,
				),
			) );

		// ====================================
		// Analytics Script Section
		// ====================================
		cleanresume_Kirki::add_section( 'analytics_javascript', array(
		    'title'          => __( 'Analytic Scripts', 'cleanresume-lite' ),
		    'description'    => __( 'Add custom CSS here', 'cleanresume-lite' ),
		    'panel'          => 'styles_scripts_panel',
		    'priority'       => 60,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '', // Rarely needed.
		) );
			cleanresume_Kirki::add_field( 'analytics_javascript', array(
				'type'        => 'code',
				'settings'    => 'analytics_javascript',
				'label'       => __( 'Analytic Scripts', 'cleanresume-lite' ),
				'section'     => 'analytics_javascript',
				//'default'     => 'body { background: #fff; }',
				'priority'    => 60,
				'choices'     => array(
					'language' => 'css',
					'theme'    => 'monokai',
					'height'   => 500,
				),
			) );


    //  ====================================
	// Get Customizer Setting for Javascript
    //  ====================================
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
}
add_action('customize_register', 'cleanresume_customize_register');



// Add Sanitize Features for Types
function cleanresume_sanitize( $input ) {}


//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function cleanresume_no_sanitize( $input ) {}


/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function cleanresume_add_customizer_css() { ?>

<!-- cleanresume customizer CSS -->
<style>
	<?php
	$body_font = get_theme_mod( 'body_font_family', array() );
	$headings_font = get_theme_mod( 'title_font_family', array() );
	$body_font_size = get_theme_mod('body_font_size');
	$heading_font_size = get_theme_mod('title_font_size');
	$avatar_name_font_size = get_theme_mod('name_font_size');
	$primary_color_scheme = get_theme_mod('primary_color_scheme');
	$body_color_scheme = get_theme_mod('theme_body_color');
	$heading_color_scheme = get_theme_mod('theme_heading_color');
	$links_color = get_theme_mod('theme_link_color');
	$links_hover_color = get_theme_mod('theme_link_hover_color');
	$theme_type = get_theme_mod('template_themes');
	$theme_layout = get_theme_mod('template_layouts');
	?>
	
	<?php if ( $body_font ) { ?>
	/* Body Font Family */
	body, button, input, textarea, p {
		<?php
		if ( isset( $body_font['font-family'] ) ) { echo 'font-family: ' . $body_font['font-family'] . ' !important;'; }
		if ( isset( $body_font['variant'] ) ) { echo 'font-variant: ' . $body_font['variant']; }
		if ( isset( $body_font['line-height'] ) ) { echo 'line-height: ' . $body_font['line-height']; }
		if ( isset( $body_font['letter-spacing'] ) ) { echo 'letter-spacing: ' . $body_font['letter-spacing']; }
		if ( isset( $body_font['text-transform'] ) ) { echo 'text-transform: ' . $body_font['text-transform']; }
		if ( isset( $body_font['text-align'] ) ) { echo 'text-align: ' . $body_font['text-align']; }
		?>
	}
	<?php } ?>

	<?php if ( $headings_font ) { ?>
	/* Heading Font Family */
	h1, h2, h3, h4, h5, h6, .title, .say-hello {
		<?php
		if ( isset( $headings_font['font-family'] ) ) { echo 'font-family: ' . $headings_font['font-family'] . ' !important;'; }
		if ( isset( $headings_font['variant'] ) ) { echo 'font-variant: ' . $headings_font['variant']; }
		if ( isset( $headings_font['line-height'] ) ) { echo 'line-height: ' . $headings_font['line-height']; }
		if ( isset( $headings_font['letter-spacing'] ) ) { echo 'letter-spacing: ' . $headings_font['letter-spacing']; }
		if ( isset( $headings_font['text-transform'] ) ) { echo 'text-transform: ' . $headings_font['text-transform']; }
		if ( isset( $headings_font['text-align'] ) ) { echo 'text-align: ' . $headings_font['text-align']; }
		?>
	}
	<?php } ?>

	<?php if ( $body_font_size ) { ?>
/* Body Font Size */
	body, p { font-size: <?php echo $body_font_size ?>px; }
	.avatar-information td, .content-wrapper .box p { font-size: calc(<?php echo $body_font_size ?>px - 3px); }
	<?php } ?>
	
	<?php if ( $heading_font_size ) { ?>
/* Title (Heading) Font Size */
	.title { font-size: <?php echo $heading_font_size ?>px; }
	<?php } ?>
	
	<?php if ( $avatar_name_font_size ) { ?>
/* Avatar Name Font Size */
	.avatar-name { font-size: <?php echo $avatar_name_font_size ?>px; }
	<?php } ?>

	<?php if ( $primary_color_scheme ) { ?>
/* Primary Color Scheme Styling */
	body {border-top-color: <?php echo $primary_color_scheme ?>;}
	.resume-options .btn-print {background-color: <?php echo $primary_color_scheme ?>;}
	.tooltip.top .tooltip-arrow {border-top-color: <?php echo $primary_color_scheme ?> !important;}
	.tooltip.left .tooltip-arrow {border-left-color: <?php echo $primary_color_scheme ?> !important;}
	.tooltip.right .tooltip-arrow {border-right-color: <?php echo $primary_color_scheme ?> !important;}
	.tooltip.bottom .tooltip-arrow {border-bottom-color: <?php echo $primary_color_scheme ?> !important;}
	.tooltip .tooltip-inner {background-color: <?php echo $primary_color_scheme ?> !important;}
	.title, .avatar-contact-info a, .avatar-information td:first-child:after {color: <?php echo $primary_color_scheme ?>}
	.avatar-services li:hover, .list-tags li:hover {background-color: <?php echo $primary_color_scheme ?>;}
	.avatar-interests li:hover:before {color: <?php echo $primary_color_scheme ?>;}
	.has-timeline > .row > div:last-child:before, .has-timeline > .row > div:last-child:after {background-color: <?php echo $primary_color_scheme ?> !important;}
	.language-skills span {color: <?php echo $primary_color_scheme ?>;}
	.sidebar-wrapper .list-border li:hover:before {color: <?php echo $primary_color_scheme ?>;}
	#portfolio .portfolio-thumb .overlay {background-color: <?php echo $primary_color_scheme ?>;}
	<?php } ?>
	
	<?php if ( $body_color_scheme ) { ?>
/* Body Color */
	body {color: <?php echo $body_color_scheme ?>;}
	<?php } ?>
		
	<?php if ( $theme_type == 'theme-dark' ) { ?>
/* Dark Theme Styling */
	body {color: #cccccc;}
	#main {box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.1); background-color: #202020;}
	.theme-dark #main {background-color: #202020 !important;}
	hr.clearfix {border-color: #444444; opacity: 0.6;}
	.avatar-thumbnail a {border-color: #555555; background-color: #555555;}
	.avatar-name {color: #ffffff;}
	.avatar-name::before {color: rgba(255,255,255,0.55);}
	.avatar-designation {color: #999999;}
	.avatar-contact-info span {color: #cccccc;}
	.avatar-contact-info a:hover, .avatar-contact-info a:hover span {color: #ffffff;}
	.avatar-social a:hover, .avatar-social a:active:hover, .avatar-social a:active:focus {background: #ffffff; color: #202020}
	.avatar-social a:hover:before, .avatar-social a:active:hover:before, .avatar-social a:active:focus:before {border-bottom-color: #ffffff;}
	.avatar-social a:hover:after, .avatar-social a:active:hover:after, .avatar-social a:active:focus:after {border-top-color: #ffffff;}
	.content-wrapper .box p {color: #999999;}
	.content-wrapper .box strong {color: #999999;}
	.has-timeline > .row > div:last-child:after {border-color: #202020 !important;}
	.sidebar-wrapper .list-border li, .avatar-interests li {border-color: #444444;}
	.avatar-services li ,.list-tags li {text-shadow: none; color: #202020; background-color: #cccccc;}
	#footer {opacity: 0.4;}
	<?php } ?>
	<?php if ( $theme_type == 'theme-dark' && $theme_layout == 'fullwidth' ) { ?>
/* Dark Theme Styling with Full Width Layout */
	hr.clearfix {opacity: 3.5;}
	.has-timeline > .row > div:last-child:after {border-color: #111111 !important;}
	<?php } ?>
		
	<?php if ( $theme_layout == 'fullwidth' ) { ?>
/* Full Width Layout Styling */
	body {background-image: none !important; background-color: #f5f5f5; border-top: solid 2px <?php echo $primary_color_scheme ?>;}
	/*body.theme-dark {background-color: #202020 !important; border-top-color: <?php echo $primary_color_scheme ?>;}*/
	.resume-options {top: 0; z-index: 9;}
	#main {background-color: transparent; border-radius: 0; box-shadow: none; margin-top: 70px; margin-bottom: 45px;}
	.wrapper {position: static; padding: 0;}
	<?php } ?>
	
	<?php if ( $heading_color_scheme ) { ?>
/* Title Color */
	.title {color: <?php echo $heading_color_scheme ?>;}
	<?php } ?>
		
	<?php if ( $links_color ) { ?>
/* Anchor Color */
	a {color: <?php echo $links_color ?>;}
	.avatar-contact-info a {color: <?php echo $links_color ?>;}
	<?php } ?>
		
	<?php if ( $links_hover_color ) { ?>
/* Anchor Hover Color */
	a:hover {color: <?php echo $links_hover_color ?>;}
	.avatar-contact-info a:hover {color: <?php echo $links_hover_color ?>;}
	<?php } ?>		
</style>

<?php } 
add_action( 'wp_head', 'cleanresume_add_customizer_css' );  



/* Add Custom CSS in <head> */
function cleanresume_custom_css() { ?>
	<?php $custom_css_style = esc_attr(get_theme_mod('custom_css')); ?>

	<?php if ( $custom_css_style ) { ?>
	<!-- cleanresume Custom CSS -->
	<style>
		<?php echo $custom_css_style ?>
	</style>
	<?php } ?>

<?php } 
add_action( 'wp_head', 'cleanresume_custom_css' );  


/* Add Custom Scripts in <footer> */
function cleanresume_custom_javascript() { ?>
	<?php
	$custom_javascript = get_theme_mod('custom_javascript');
	$active_portfolio = get_theme_mod('active_portfolio');
	$about_content_excerpt = get_theme_mod('about_content_excerpt');
	$experience_content_excerpt = get_theme_mod('experience_content_excerpt');
	$education_content_excerpt = get_theme_mod('education_content_excerpt');
	?>
	
	<?php if ( $active_portfolio == '1' || $about_content_excerpt == '1' || $experience_content_excerpt == '1' || $education_content_excerpt == '1' || $custom_javascript ) { ?>
	<!-- cleanresume Custom Javascript -->
	<script type="text/javascript">
		jQuery.noConflict();
		(function($) {
		
		<?php if( $active_portfolio == '1') { ?>
			// Iniating HoverDirection Animation on Portfolio Thumbnails
			$('#portfolio .portfolio-thumbs > div').each( function() {
				$(this).hoverdir();
			});
		<?php } ?>
		
		<?php if( $about_content_excerpt == '1') { ?>
			// Text Expander for About Content
			$('.about-content').expander({
				slicePoint: 1000,
				userCollapseText: '<small>read less</small>'
			});
		<?php } ?>
		
		<?php if( $experience_content_excerpt == '1' || $education_content_excerpt == '1') { ?>
			// Text Expander for Education History & Professional Expereice
			$('.box .job-description').expander({
				slicePoint: 200,
				userCollapseText: '<small>read less</small>'
			});
		<?php } ?>
		
		<?php if ( $custom_javascript ) { ?>
			<?php echo $custom_javascript ?>
		<?php } ?>
		
		})(jQuery);
	</script>

	<?php } ?>

<?php } 
add_action( 'wp_footer', 'cleanresume_custom_javascript', 100 );  


/* Add Analytic Scripts in <footer> */
function cleanresume_analytic_script() { ?>
	<?php $analytics_javascript = get_theme_mod('analytics_javascript'); ?>

	<?php if ( $analytics_javascript ) { ?>
	<!-- cleanresume Analytic Scripts -->
	<script type="text/javascript">
		<?php echo $analytics_javascript ?>
	</script>
	<?php } ?>

<?php } 
add_action( 'wp_footer', 'cleanresume_analytic_script' );  



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cleanresume_customize_preview_js() {
	wp_enqueue_script( 'cleanresume_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'cleanresume_customize_preview_js' );
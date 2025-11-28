<?php
/**
 * Sweety High GeneratePress Child functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom fonts with GeneratePress Font Manager
 */
add_action( 'after_setup_theme', 'sh_register_fonts', 20 );
function sh_register_fonts() {
	if ( function_exists( 'generate_register_font' ) ) {
		// Register Poppins font
		generate_register_font( 'Poppins', array(
			'variants' => array( '400', '600', '700' ),
			'category' => 'sans-serif',
		) );
		
		// Register Roboto Condensed font
		generate_register_font( 'Roboto Condensed', array(
			'variants' => array( '400', '700' ),
			'category' => 'sans-serif',
		) );
	}
}

/**
 * Set GeneratePress default typography settings
 */
add_filter( 'generate_set_defaults', 'sh_set_generatepress_defaults' );
function sh_set_generatepress_defaults( $defaults ) {
	// Body font defaults
	$defaults['body_font_family'] = 'Poppins';
	$defaults['body_font_size'] = '13';
	$defaults['body_font_weight'] = '400';
	$defaults['body_line_height'] = '1';
	$defaults['body_color'] = '#595959';
	
	// Heading font defaults
	$defaults['heading_font_family'] = 'Roboto Condensed';
	$defaults['heading_font_weight'] = '700';
	$defaults['heading_line_height'] = '1.2';
	
	// Link defaults
	$defaults['link_color'] = '#f09';
	$defaults['link_color_hover'] = '#cc007a';
	
	return $defaults;
}

/**
 * Enqueue child styles AFTER GeneratePress dynamic CSS loads.
 * This ensures our CSS loads last and overrides everything.
 */
add_action( 'wp_enqueue_scripts', 'sh_child_enqueue_styles', 999 );
function sh_child_enqueue_styles() {
	// Load AFTER GeneratePress dynamic CSS
	wp_enqueue_style(
		'sh-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'generate-style' ), // Dependency ensures it loads after GP base styles
		filemtime( get_stylesheet_directory() . '/style.css' ) // Cache busting
	);
}

/**
 * Add CSS AFTER GeneratePress dynamic CSS output.
 * GeneratePress outputs dynamic CSS via wp_head.
 * We use priority 9999 to ensure our CSS loads AFTER GP's dynamic CSS.
 * Also try GeneratePress-specific hooks if available.
 */
add_action( 'wp_head', 'sh_add_css_after_gp_dynamic', 9999 );

// Try GeneratePress-specific hook if it exists
if ( function_exists( 'generate_after_main_css' ) ) {
	add_action( 'generate_after_main_css', 'sh_add_css_after_gp_dynamic' );
}

function sh_add_css_after_gp_dynamic() {
	// Prevent double output if both hooks fire
	static $output = false;
	if ( $output ) {
		return;
	}
	$output = true;
	$css = '
	/* CSS Variables - Complete SweetyHigh Design System */
	:root {
		--font-poppins: "__Poppins_7c73c7","__Poppins_Fallback_7c73c7";
		--font-roboto-condensed: "__Roboto_Condensed_30398f","__Roboto_Condensed_Fallback_30398f";
		
		/* Bootstrap Color System */
		--bs-blue: #0d6efd;
		--bs-indigo: #6610f2;
		--bs-purple: #6f42c1;
		--bs-pink: #d63384;
		--bs-red: #dc3545;
		--bs-orange: #fd7e14;
		--bs-yellow: #ffc107;
		--bs-green: #198754;
		--bs-teal: #20c997;
		--bs-cyan: #0dcaf0;
		--bs-black: #000;
		--bs-white: #fff;
		--bs-gray: #6c757d;
		--bs-gray-dark: #343a40;
		--bs-gray-100: #f8f9fa;
		--bs-gray-200: #e9ecef;
		--bs-gray-300: #dee2e6;
		--bs-gray-400: #ced4da;
		--bs-gray-500: #adb5bd;
		--bs-gray-600: #6c757d;
		--bs-gray-700: #495057;
		--bs-gray-800: #343a40;
		--bs-gray-900: #212529;
		--bs-primary: #f09;
		--bs-secondary: #6c757d;
		--bs-success: #198754;
		--bs-info: #0dcaf0;
		--bs-warning: #ffc107;
		--bs-danger: #dc3545;
		--bs-light: #f8f9fa;
		--bs-dark: #212529;
		--bs-persian-rose: #f09;
		--bs-primary-rgb: 255,0,153;
		--bs-secondary-rgb: 108,117,125;
		--bs-success-rgb: 25,135,84;
		--bs-info-rgb: 13,202,240;
		--bs-warning-rgb: 255,193,7;
		--bs-danger-rgb: 220,53,69;
		--bs-light-rgb: 248,249,250;
		--bs-dark-rgb: 33,37,41;
		--bs-persian-rose-rgb: 255,0,153;
		--bs-white-rgb: 255,255,255;
		--bs-black-rgb: 0,0,0;
		--bs-primary-text-emphasis: #66003d;
		--bs-secondary-text-emphasis: #2b2f32;
		--bs-success-text-emphasis: #0a3622;
		--bs-info-text-emphasis: #055160;
		--bs-warning-text-emphasis: #664d03;
		--bs-danger-text-emphasis: #58151c;
		--bs-light-text-emphasis: #495057;
		--bs-dark-text-emphasis: #495057;
		--bs-primary-bg-subtle: #ffcceb;
		--bs-secondary-bg-subtle: #e2e3e5;
		--bs-success-bg-subtle: #d1e7dd;
		--bs-info-bg-subtle: #cff4fc;
		--bs-warning-bg-subtle: #fff3cd;
		--bs-danger-bg-subtle: #f8d7da;
		--bs-light-bg-subtle: #fcfcfd;
		--bs-dark-bg-subtle: #ced4da;
		--bs-primary-border-subtle: #ff99d6;
		--bs-secondary-border-subtle: #c4c8cb;
		--bs-success-border-subtle: #a3cfbb;
		--bs-info-border-subtle: #9eeaf9;
		--bs-warning-border-subtle: #ffe69c;
		--bs-danger-border-subtle: #f1aeb5;
		--bs-light-border-subtle: #e9ecef;
		--bs-dark-border-subtle: #adb5bd;
		--bs-font-sans-serif: system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
		--bs-font-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
		--bs-body-font-family: var(--font-poppins);
		--bs-body-font-size: 0.8125rem;
		--bs-body-font-weight: 400;
		--bs-body-line-height: 1;
		--bs-body-color: #212529;
		--bs-body-color-rgb: 33,37,41;
		--bs-body-bg: #fff;
		--bs-body-bg-rgb: 255,255,255;
		--bs-emphasis-color: #000;
		--bs-emphasis-color-rgb: 0,0,0;
		--bs-secondary-color: rgba(33,37,41,.75);
		--bs-secondary-color-rgb: 33,37,41;
		--bs-secondary-bg: #e9ecef;
		--bs-secondary-bg-rgb: 233,236,239;
		--bs-tertiary-color: rgba(33,37,41,.5);
		--bs-tertiary-color-rgb: 33,37,41;
		--bs-tertiary-bg: #f8f9fa;
		--bs-tertiary-bg-rgb: 248,249,250;
		--bs-heading-color: inherit;
		--bs-link-color: #f09;
		--bs-link-color-rgb: 255,0,153;
		--bs-link-decoration: none;
		--bs-link-hover-color: #cc007a;
		--bs-link-hover-color-rgb: 204,0,122;
		--bs-link-hover-decoration: none;
		--bs-code-color: #d63384;
		--bs-highlight-bg: #fff3cd;
		--bs-gradient: linear-gradient(180deg,hsla(0,0%,100%,.15),hsla(0,0%,100%,0));
		--bs-border-width: 1px;
		--bs-border-style: solid;
		--bs-border-color: #dee2e6;
		--bs-border-color-translucent: rgba(0,0,0,.175);
		--bs-border-radius: 0.375rem;
		--bs-border-radius-sm: 0.25rem;
		--bs-border-radius-lg: 0.5rem;
		--bs-border-radius-xl: 1rem;
		--bs-border-radius-xxl: 2rem;
		--bs-border-radius-2xl: var(--bs-border-radius-xxl);
		--bs-border-radius-pill: 50rem;
		--bs-box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
		--bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(0,0,0,.075);
		--bs-box-shadow-lg: 0 1rem 3rem rgba(0,0,0,.175);
		--bs-box-shadow-inset: inset 0 1px 2px rgba(0,0,0,.075);
		--bs-focus-ring-width: 0.25rem;
		--bs-focus-ring-opacity: 0.25;
		--bs-focus-ring-color: rgba(255,0,153,.25);
		--bs-form-valid-color: #198754;
		--bs-form-valid-border-color: #198754;
		--bs-form-invalid-color: #dc3545;
		--bs-form-invalid-border-color: #dc3545;
		--bs-breakpoint-xs: 0;
		--bs-breakpoint-sm: 576px;
		--bs-breakpoint-md: 768px;
		--bs-breakpoint-lg: 992px;
		--bs-breakpoint-xl: 1200px;
		--bs-breakpoint-xxl: 1400px;
		--bs-gutter-x: 1.5rem;
		--bs-gutter-y: 0;
	}
	
	/* CRITICAL: Override GeneratePress body styles - MUST come after GP dynamic CSS */
	body {
		font-family: var(--font-poppins) !important;
		color: #595959 !important;
		font-size: 13px !important;
		font-weight: 400 !important;
		line-height: 1 !important;
		background-color: #fff !important;
	}
	
	/* Override GeneratePress headings */
	h1, h2, h3, h4, h5, h6 {
		font-family: var(--font-roboto-condensed) !important;
	}
	
	/* Override GeneratePress links */
	a {
		color: var(--bs-link-color) !important;
		text-decoration: none !important;
	}
	
	a:hover {
		color: var(--bs-link-hover-color) !important;
	}
	';
	
	echo '<style id="sh-sweetyhigh-overrides" type="text/css">' . $css . '</style>';
}

/**
 * Add image sizes for hero / cards (adjust as needed).
 */
add_action( 'after_setup_theme', 'sh_child_image_sizes' );
function sh_child_image_sizes() {
	add_image_size( 'sh-hero', 1200, 675, true );   // 16:9 hero
	add_image_size( 'sh-card', 600, 400, true );    // card/thumb
}

/**
 * Helper: get first post of a query and then rewind.
 */
function sh_get_first_post( $query ) {
	if ( ! $query->have_posts() ) {
		return null;
	}

	$query->the_post();
	$first_post = get_post();
	rewind_posts();

	return $first_post;
}


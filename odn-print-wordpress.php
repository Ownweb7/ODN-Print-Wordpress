<?php
/**
 * Plugin Name: ODN Prints
 * Plugin URI:  https://odnprint.com
 * Description: ODN Prints storefront skin — dark glass + amber look, interactive effects (cursor glow, tilt cards, black-to-colour product images) and the [odn_wiper] before/after shortcode. Works on top of any theme.
 * Version:     1.0.0
 * Author:      ODN & Sons
 * License:     GPL-2.0-or-later
 * Text Domain: odn-prints
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'ODN_PRINTS_VER', '1.0.0' );

add_action( 'wp_enqueue_scripts', function () {
	$base = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'odn-prints', $base . 'odn-style.css', array(), ODN_PRINTS_VER );
	wp_enqueue_script( 'odn-interactions', $base . 'odn-interactions.js', array(), ODN_PRINTS_VER, true );
}, 20 );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
} );

/**
 * Full-page "ODN Prints app" template.
 *
 * Renders the original single-page ODN Prints site (templates/odn-app.php)
 * with its own <html>, CSS and JS — no theme header/footer — so it looks
 * identical to the standalone design. A page uses it when either:
 *   - its Template is set to "ODN Prints — Full App", or
 *   - its slug is "odn-app".
 */
const ODN_PRINTS_TEMPLATE = 'odn-app';

// Expose the template in the page editor's Template dropdown.
add_filter( 'theme_page_templates', function ( $templates ) {
	$templates[ ODN_PRINTS_TEMPLATE ] = 'ODN Prints — Full App';
	return $templates;
} );

function odn_prints_wants_app_template() {
	if ( ! is_page() ) { return false; }
	if ( get_page_template_slug() === ODN_PRINTS_TEMPLATE ) { return true; }
	$page = get_queried_object();
	return ( $page instanceof WP_Post && $page->post_name === ODN_PRINTS_TEMPLATE );
}

// Serve the standalone template instead of the theme's.
add_filter( 'template_include', function ( $template ) {
	if ( odn_prints_wants_app_template() ) {
		$custom = plugin_dir_path( __FILE__ ) . 'templates/odn-app.php';
		if ( file_exists( $custom ) ) { return $custom; }
	}
	return $template;
}, 99 );

/**
 * Before/after wiper shortcode.
 * [odn_wiper before="IMG_URL" after="IMG_URL" before_label="Your photo" after_label="The print" pos="55"]
 */
add_shortcode( 'odn_wiper', function ( $atts ) {
	$a = shortcode_atts( array(
		'before'       => '',
		'after'        => '',
		'before_label' => 'Your photo',
		'after_label'  => 'The print',
		'pos'          => '55',
	), $atts );
	if ( empty( $a['before'] ) || empty( $a['after'] ) ) { return ''; }
	return '<div class="odn-wiper" data-pos="' . esc_attr( $a['pos'] ) . '">'
		. '<img class="odn-wiper-after" src="' . esc_url( $a['after'] ) . '" alt="" />'
		. '<img class="odn-wiper-before" src="' . esc_url( $a['before'] ) . '" alt="" />'
		. '<span class="odn-wiper-lbl l">' . esc_html( $a['before_label'] ) . '</span>'
		. '<span class="odn-wiper-lbl r">' . esc_html( $a['after_label'] ) . '</span>'
		. '<div class="odn-wiper-divider"></div>'
		. '<div class="odn-wiper-handle">&#8596;</div>'
		. '</div>';
} );

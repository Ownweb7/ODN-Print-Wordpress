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

<?php
/**
 * Plugin Name:       Ocean Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            Sakib
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ocean-blocks
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function ocean_blocks_enqueue_assets() {
	// Frontend CSS
	if (file_exists(plugin_dir_path(__FILE__) . 'src/assets/style.css')) {
		wp_enqueue_style(
			'ocean-blocks-access-style',
			plugin_dir_url(__FILE__) . 'src/assets/style.css',
			array(),
			filemtime(plugin_dir_path(__FILE__) . 'src/assets/style.css') // Cache busting
		);
	}

	// Frontend JS
	if (file_exists(plugin_dir_path(__FILE__) . 'src/assets/script.js')) {
		wp_enqueue_script(
			'ocean-blocks-access-script',
			plugin_dir_url(__FILE__) . 'src/assets/script.js',
			array('jquery'), // Add dependencies if required
			filemtime(plugin_dir_path(__FILE__) . 'src/assets/script.js'), // Cache busting
			true // Load in footer
		);
	}
}
add_action('wp_enqueue_scripts', 'ocean_blocks_enqueue_assets');


function create_block_ocean_blocks_block_init() {
	register_block_type(__DIR__ . '/build/blocks/default-block');
}
add_action('init', 'create_block_ocean_blocks_block_init');

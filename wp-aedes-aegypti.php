<?php
/*
Plugin Name: Aedes aegypti
Plugin URI: https://github.com/redelivre/wp-aedes-aegypti
Description: Adiciona uma animação flutuante do <em>Aedes aegypti</em> na capa do site. Baseado no <a href="http://hackerativismo.github.io/viral-aedes-aegypti/">viral para combate aos mosquitos</a>.
Version: 0.1
Author: Rede Livre
Author URI: http://redelivre.org
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: 
Domain Path: /languages
*/


function wp_aedes_aegypti() {
	wp_enqueue_script( 'wp_aedes_aegypti', plugin_dir_url(__FILE__) . 'aedes.js', array( 'jquery') );
	wp_localize_script('wp_aedes_aegypti', 'wp_aedes_aegypti', array( 'pluginUrl' => plugin_dir_url( __FILE__ )));
	wp_enqueue_style('wp_aedes_aegypti', plugin_dir_url(__FILE__) . 'aedes.css');
}
add_action( 'wp_enqueue_scripts', 'wp_aedes_aegypti' );


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
	wp_localize_script('wp_aedes_aegypti', 'wp_aedes_aegypti', array(
			'pluginUrl' => plugin_dir_url( __FILE__ ),
			'destUrl' => 'http://combateaedes.saude.gov.br/',
			'title' => __('Faça sua parte', 'wp_aedes_aegypti'),
			'text1' => __('Não Adianta Apenas<br/>matar o mosquito','wp_aedes_aegypti'),
			'text2' => __('Não podemos deixar ele nascer.<br/>E isso depende de todos nós.','wp_aedes_aegypti'),
			'text3' => __('Saiba como fazer sua parte','wp_aedes_aegypti'),
			'text4' => __('#ZicaZero','wp_aedes_aegypti'),
			'lang' => get_locale(),
			'close' => __('Fechar', 'wp_aedes_aegypti'),
	));
	
	wp_enqueue_style('wp_aedes_aegypti', plugin_dir_url(__FILE__) . 'aedes.css');
}
add_action( 'wp_enqueue_scripts', 'wp_aedes_aegypti' );


/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function wp_aedes_aegypti_load_textdomain()
{
	load_plugin_textdomain( 'wp_aedes_aegypti', false,  '/wp-aedes-aegypti/languages' );
}
add_action( 'plugins_loaded', 'wp_aedes_aegypti_load_textdomain' );
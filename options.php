<?php

class WPAedesAegyptiSettingsPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_theme_page()
	{
		// This page will be under "Settings"
		$page_hook = add_submenu_page( 'options-general.php', 
			__('WP Aedes Aegypti','wp_aedes_aegypti'),
			__('WP Aedes Aegypti','wp_aedes_aegypti'),
			'edit_plugins',
			'wp-aedes-aegypti',
			array(&$this, 'create_admin_page')
		);
		//add_action('load-' . $page_hook, array(&$this, 'admin_load'));
		
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'wp-aedes-aegypti', array() );
		?>
        <div class="wrap">
            <h2><?php _e('Página de configuração do plugin wp-aedes-aegypti', 'wp_aedes_aegypti') ?></h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wp-aedes-aegypti' ); 
                do_settings_sections( 'wp-aedes-aegypti' );
                ?>
                <table class="form-table">
                	<tr valign="top">
                		<th scope="row"><?php _e('Url de destino da campanha', 'wp_aedes_aegypti') ?></th>
                		<td><input type="text" name="wp-aedes-aegypti" value="<?php echo esc_attr( get_option('wp-aedes-aegypti', 'http://combateaedes.saude.gov.br/') ); ?>" /></td>
                	</tr>
                </table><?php
                submit_button(); 
            ?>
            </form>
            <div id="result">
            </div>
        </div>
        <?php
    }

    function wp_aedes_aegypti_urldest_callback()
    {
    	$label = __('Url de destino da campanha', 'wp_aedes_aegypti');
    	echo '<label id="wp_aedes_aegypti_urldest_label" for="wp_aedes_aegypti_urldest" class="wp_aedes_aegypti_urldest_label" >'.$label.'</label';
    	echo '<input type="text" id="wp_aedes_aegypti_urldest" name="wp_aedes_aegypti_urldest" class="wp_aedes_aegypti_urldest" />';
    }
    
    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'wp-aedes-aegypti', // Option group
            'wp-aedes-aegypti', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        
        add_settings_section(
        		'wp-aedes-aegypti', // ID
        		__('Url de destino da campanha', 'wp_aedes_aegypti'), // Title
        		function () { }, // Callback
        		'wp-aedes-aegypti' // Page
        		);
        
        add_settings_field(
            'desturl', // ID
            __('Url de destino da campanha', 'wp_aedes_aegypti'), // Title 
            array( $this, 'wp_aedes_aegypti_urldest_callback' ), // Callback
            'general',
        	'wp-aedes-aegypti'
        );
        
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = esc_url_raw($input);
        
        return $new_input;
    }

}

if( is_admin() )
    $wp_aedes_aegypti = new WPAedesAegyptiSettingsPage();

<?php

/*
 * Plugin constants
 */
if(!defined('REDCASE_PLUGIN_VERSION'))
	define('REDCASE_PLUGIN_VERSION', '1.1.0');
if(!defined('REDCASE_URL'))
	define('REDCASE_URL', plugin_dir_url( __FILE__ ));
if(!defined('REDCASE_PATH'))
	define('REDCASE_PATH', plugin_dir_path( __FILE__ ));
if(!defined('REDCASE_ENDPOINT'))
	define('REDCASE_ENDPOINT', 'lg1d7f7jia.execute-api.us-east-1.amazonaws.com/stg/api/offer');
if(!defined('REDCASE_PROTOCOL'))
	define('REDCASE_PROTOCOL', 'https');
 
/*
 * Main class
 */
/**
 * Class Feedier
 *
 * This class creates the option page and add the web app script
 */
class Redcase
{
	/**
	 * The security nonce
	 *
	 * @var string
	 */
	private $_nonce = 'redcase_admin';
	/**
	 * The option name
	 *
	 * @var string
	 */
	private $option_name = 'redcase_data';
	/**
	 * Feedier constructor.
     *
     * The main plugin actions registered for WordPress
	 */
	public function __construct()
    {
		// Admin page calls
		add_action('admin_menu',                array($this,'addAdminMenu'));
		add_action('wp_ajax_store_admin_data',  array($this,'storeAdminData'));
		add_action('admin_enqueue_scripts',     array($this,'addAdminScripts'));
	}


	/**
	 * Adds Admin Scripts for the Ajax call
	 */
	public function addAdminScripts()
    {
	    wp_enqueue_style('redcase-admin', REDCASE_URL. 'assets/css/admin.css', false, 1.0);
		wp_enqueue_script('redcase-admin', REDCASE_URL. 'assets/js/admin.js', array(), 1.0);
		$admin_options = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'_nonce'   => wp_create_nonce( $this->_nonce ),
		);
		wp_localize_script('redcase-admin', 'redcase_exchanger', $admin_options);
	}
	
	/**
	 * Adds the Feedier label to the WordPress Admin Sidebar Menu
	 */
	public function addAdminMenu()
    {
		add_menu_page(
			__( 'Config Redcase', 'redcase' ),
			__( 'Config Redcase', 'redcase' ),
			'manage_options',
			'redcase',
			array($this, 'adminLayout'),
			'dashicons-testimonial'
		);
	}

	/**
	 * Outputs the Admin Dashboard layout containing the form with all its options
     *
     * @return void
	 */
	public function adminLayout()
	{

			        
		
		?>
	 
		<div class="wrap">
		    <h3><?php _e('Redcase API Settings', 'redcase'); ?></h3>
	 
	            <p>
		        <?php _e('You can get your Redcase API settings from your <b>Integrations</b> page.', 'redcase'); ?>

	            </p>
	 
	            <hr>
	            
	            <?php
		
					if (isset($_POST['redcase_key'])) {
						$default = sanitize_text_field($_POST['redcase_key']);
						update_site_option( "redcase_key", $default );
						
						$option_key = get_site_option('redcase_key');
						
						if($option_key) {
							echo '<div id="message" class="updated notice is-dismissible">
											<p>Private key updated!</p>
											<button type="button" class="notice-dismiss">
												<span class="screen-reader-text">Dismiss this notice.</span>
											</button>
										</div>';
						}else{
							echo '<div id="message" class="error notice is-dismissible">
											<p>Private key not updated!</p>
											<button type="button" class="notice-dismiss">
												<span class="screen-reader-text">Dismiss this notice.</span>
											</button>
										</div>';
						}
					}
		           
		        ?>    
	 
	            <form method="POST">
	 
			<table class="form-table">
	                    <tbody>
	                        <tr>
	                            <td scope="row">
	                                <label><?php _e( 'Private key', 'redcase' ); ?></label>
	                            </td>
	                            <td>
	                                <input name="redcase_key"
	                                       id="redcase_key"
	                                       class="regular-text"
	                                       value="<?php echo get_site_option('redcase_key') ? get_site_option('redcase_key') : ''; ?>"/>
	                            </td>
	                        </tr>
	                         
	 
	                        <tr>
	                            <td colspan="2">
	                                <button class="button button-primary" id="redcase-admin-save" type="submit"><?php _e( 'Save', 'redcase' ); ?></button>
	                            </td>
	                        </tr>
	                    </tbody>
	                </table>
	 
	            </form>
	 
		</div>
	 
		<?php
			
	 
	}

}
/*
 * Starts our plugin class, easy!
 */
new Redcase();

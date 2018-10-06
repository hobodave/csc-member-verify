<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/public
 * @author     David Abdemoulaie <dave@chicagosc.com>
 */
class Csc_Member_Verify_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $csc_member_verify    The ID of this plugin.
	 */
	private $csc_member_verify;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $csc_member_verify       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $csc_member_verify, $version ) {

		$this->csc_member_verify = $csc_member_verify;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csc_Member_Verify_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csc_Member_Verify_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->csc_member_verify, plugin_dir_url( __FILE__ ) . 'css/csc-member-verify-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csc_Member_Verify_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csc_Member_Verify_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->csc_member_verify, plugin_dir_url( __FILE__ ) . 'js/csc-member-verify-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->csc_member_verify, 'params', array('ajaxurl' => admin_url('admin-ajax.php')));

	}

	/**
	 * Shortcode to display member verification form
	 */
	public function register_shortcodes() {
		add_shortcode('csc_member_verify_form', array($this, 'csc_member_verify_form'));
	}

	public function csc_member_verify_form() {
		ob_start();
		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/csc-member-verify-public-display.php';

		return ob_get_clean();
	}

}

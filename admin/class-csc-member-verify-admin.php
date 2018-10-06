<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/admin
 * @author     David Abdemoulaie <dave@chicagosc.com>
 */
class Csc_Member_Verify_Admin {

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
	 * @param      string    $csc_member_verify       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $csc_member_verify, $version ) {

		$this->csc_member_verify = $csc_member_verify;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->csc_member_verify, plugin_dir_url( __FILE__ ) . 'css/csc-member-verify-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->csc_member_verify, plugin_dir_url( __FILE__ ) . 'js/csc-member-verify-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * 
	 * @since   1.0.0
	 */
	public function form_response() {
		var_dump('wut'); die;
		if (isset($_POST['csc_member_verify_nonce']) && wp_verify_nonce($_POST['csc_member_verify_nonce'], 'csc_member_verify_form_nonce')) {
			$csc_member_text = sanitize_textarea_field($_POST['csc_member_ids']);
			$csc_member_ids = explode("\n", $csc_member_text);

			$results = [];

			foreach ($csc_member_ids as $key => $value) {
				if ($user = get_userdata(intval($value))) {
					$member_status = in_array('member', (array) $user->roles) ? 'member' : 'NOT MEMBER';
					$results[] = array($value, $user->display_name, $member_status);
				} elseif ($user = reset(get_users(array('meta_key' => 'mepr_previous_member_id', 'meta_value' => $value, 'number' => 1, 'count_total' => false)))) {
					$member_status = in_array('member', (array) $user->roles) ? 'member' : 'NOT MEMBER';
					$results[] = array($value, $user->display_name, $member_status);
				} else {
					$results[] = array($value, 'USER NOT FOUND');
				}
			}

			if (isset($_POST['ajaxrequest']) && $_POST['ajaxrequest'] = 'true') {
				echo '<pre>';
				print_r($_POST);
				echo '</pre>';
				wp_die();
			}
		} else {
			wp_die(__('Invalid nonce specified', $this->plugin_name), __('Error', $this->plugin_name), array(
				'response' => 403,
				'back_link' => true,
			));
		}
	}

}

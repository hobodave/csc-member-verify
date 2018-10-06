<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/includes
 * @author     David Abdemoulaie <dave@chicagosc.com>
 */
class Csc_Member_Verify_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_role('member', 'Member', [
			'read' => true,
		]);
		add_role('director', 'Meet Director', [
			'read' => true,
		]);

		$director = get_role('director');
		$director->add_cap('verify_members', true);
	}

}

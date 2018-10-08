<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Csc_Member_Verify
 * @subpackage Csc_Member_Verify/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php if (current_user_can('verify_members')): ?>
	<?php $csc_member_verify_nonce = wp_create_nonce( 'csc_member_verify_form_nonce' ); ?>
	<h2><?= __('Bulk Member Verification', $this->plugin_name) ?></h2>
	<div class="csc_member_verify_form" id="csc_member_verify">
		<form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="post" id="csc_member_verify_form">
			<div style="display: none;">
				<input type="hidden" name="action" value="csc_member_verify_form_response">
				<input type="hidden" name="csc_member_verify_nonce" value="<?= $csc_member_verify_nonce ?>">
			</div>
			<p>
				<textarea autofocus required name="csc_member_ids" cols="15" rows="10" placeholder="Paste Member IDs here. One per line ..."></textarea>
			</p>
			<p>
				<input type="submit" name="submit" value="Verify"><span class="spinner"></span>
			</p>
		</form>
	</div>
	<div id="csc_notice_bar"></div>
	<div id="csc_form_response">
		<h2>Results</h2>
		<p>Copy paste results into your spreadsheet when ready.</p>
		<textarea readonly cols="15" rows="15" placeholder="Results will appear here..."></textarea>
	</div>
<?php else: ?>
	<p><?= __("You are not authorized to perform this operation.", $this->plugin_name); ?></p>
<?php endif ?>
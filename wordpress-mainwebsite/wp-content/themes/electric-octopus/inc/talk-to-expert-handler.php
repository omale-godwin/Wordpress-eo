<?php
/**
 * Talk to Expert Form Handler
 * Handles form submissions and admin dashboard for Talk to Expert forms
 *
 * @package Electric_Octopus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom post type for form submissions
 */
function eo_register_form_submission_post_type() {
	$args = array(
		'label'                 => __( 'Talk to Expert - Submissions', 'electric-octopus' ),
		'description'           => __( 'Talk to Expert form submissions', 'electric-octopus' ),
		'supports'              => array( 'title', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => false,
		'show_in_admin_bar'     => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-email-alt',
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'eo_form_submission', $args );

	// Register meta fields
	register_post_meta( 'eo_form_submission', 'eo_form_data', array(
		'type'          => 'object',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_email', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_phone', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_company', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_first_name', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_last_name', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_b2b_stage', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_form_qualified', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );

	register_post_meta( 'eo_form_submission', 'eo_resume_token', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'eo_register_form_submission_post_type' );

/**
 * AJAX handler for form submission
 */
function eo_handle_form_submission() {
	// Log the request for debugging
	error_log('EO Form Submission - AJAX called');
	
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'eo_form_nonce' ) ) {
		error_log('EO Form Submission - Nonce verification failed');
		wp_send_json_error( 'Security verification failed. Please refresh and try again.' );
	}

	// Get form data
	$form_data = isset( $_POST['formData'] ) ? json_decode( stripslashes( $_POST['formData'] ), true ) : array();

	error_log('EO Form Submission - Raw POST formData: ' . print_r( $_POST['formData'] ?? 'NOT SET', true ) );
	error_log('EO Form Submission - Decoded form_data type: ' . gettype( $form_data ) );
	error_log('EO Form Submission - Form data keys: ' . implode(', ', array_keys( (array)$form_data ) ) );
	error_log('EO Form Submission - Full form data: ' . json_encode( $form_data, JSON_PRETTY_PRINT ) );

	if ( empty( $form_data ) ) {
		error_log('EO Form Submission - No form data provided');
		wp_send_json_error( 'No form data provided' );
	}

	// Extract email, phone, company from form data
	// Check step 8 (confirmation/last step) first, then fallback
	error_log('EO Form Submission - Checking for email data...');
	error_log('EO Form Submission - Isset($form_data[8]): ' . ( isset( $form_data[8] ) ? 'yes' : 'no' ) );
	error_log('EO Form Submission - Isset($form_data["8"]): ' . ( isset( $form_data['8'] ) ? 'yes' : 'no' ) );
	
	// Try to find email in any step - check all available data
	$email = '';
	$phone = '';
	$company = '';
	$firstName = '';
	$lastName = '';
	
	// Search through all form data for email field
	foreach ( $form_data as $step_id => $step_data ) {
		if ( is_array( $step_data ) ) {
			if ( isset( $step_data['email'] ) && empty( $email ) ) {
				$email = sanitize_email( $step_data['email'] );
				error_log("EO Form Submission - Found email in part $step_id: $email");
			}
			if ( isset( $step_data['phone'] ) && empty( $phone ) ) {
				$phone = sanitize_text_field( $step_data['phone'] );
				error_log("EO Form Submission - Found phone in part $step_id: $phone");
			}
			if ( isset( $step_data['company'] ) && empty( $company ) ) {
				$company = sanitize_text_field( $step_data['company'] );
				error_log("EO Form Submission - Found company in part $step_id: $company");
			}
			// Check for firstName (assessment form) or fname (talk to expert form)
			if ( ( isset( $step_data['firstName'] ) || isset( $step_data['fname'] ) ) && empty( $firstName ) ) {
				$firstName = sanitize_text_field( $step_data['firstName'] ?? $step_data['fname'] );
				error_log("EO Form Submission - Found firstName in part $step_id: $firstName");
			}
			// Check for lastName (assessment form) or lname (talk to expert form)
			if ( ( isset( $step_data['lastName'] ) || isset( $step_data['lname'] ) ) && empty( $lastName ) ) {
				$lastName = sanitize_text_field( $step_data['lastName'] ?? $step_data['lname'] );
				error_log("EO Form Submission - Found lastName in part $step_id: $lastName");
			}
		}
	}
	
	$b2b_stage = isset( $_POST['b2bStage'] ) ? sanitize_text_field( $_POST['b2bStage'] ) : 'launching';
	$is_qualified = isset( $_POST['isQualified'] ) ? sanitize_text_field( $_POST['isQualified'] ) : 'no';
	$resume_token = isset( $_POST['resumeToken'] ) ? sanitize_text_field( $_POST['resumeToken'] ) : '';

	error_log("EO Form Submission - Extracted data - Email: '$email', Phone: '$phone', Company: '$company', FirstName: '$firstName', LastName: '$lastName', Stage: '$b2b_stage', Qualified: '$is_qualified'");
	error_log("EO Form Submission - Email is_email(): " . ( is_email( $email ) ? 'yes' : 'no' ) . ", empty(): " . ( empty( $email ) ? 'yes' : 'no' ) );

	// Validate email
	if ( empty( $email ) || ! is_email( $email ) ) {
		error_log("EO Form Submission - VALIDATION FAILED - Invalid or empty email");
		wp_send_json_error( 'Invalid email address' );
	}

	// Create post title from company and email
	$post_title = ! empty( $company ) ? $company : 'Form - ' . $email;

	// Prepare post data
	$post_id = wp_insert_post( array(
		'post_type'    => 'eo_form_submission',
		'post_title'   => $post_title,
		'post_status'  => 'publish',
		'post_date'    => current_time( 'mysql' ),
	) );

	if ( is_wp_error( $post_id ) ) {
		error_log( 'EO Form Submission - WP Error: ' . $post_id->get_error_message() );
		wp_send_json_error( 'Error saving form submission: ' . $post_id->get_error_message() );
	}

	error_log( "EO Form Submission - Post created with ID: $post_id" );

	// Save meta data
	update_post_meta( $post_id, 'eo_form_data', $form_data );
	update_post_meta( $post_id, 'eo_form_email', $email );
	update_post_meta( $post_id, 'eo_form_phone', $phone );
	update_post_meta( $post_id, 'eo_form_company', $company );
	update_post_meta( $post_id, 'eo_form_first_name', $firstName );
	update_post_meta( $post_id, 'eo_form_last_name', $lastName );
	update_post_meta( $post_id, 'eo_b2b_stage', $b2b_stage );
	update_post_meta( $post_id, 'eo_form_qualified', $is_qualified );
	update_post_meta( $post_id, 'eo_resume_token', $resume_token );

	/**
	 * Action hook for form submission
	 * Allows plugins/theme to perform additional actions
	 */
	do_action( 'eo_form_submitted', $post_id, $form_data );

	// Send email notification
	eo_send_form_notification( $post_id, $form_data );

	wp_send_json_success( array(
		'message' => 'Form submitted successfully',
		'post_id' => $post_id,
	) );
}
add_action( 'wp_ajax_eo_submit_form', 'eo_handle_form_submission' );
add_action( 'wp_ajax_nopriv_eo_submit_form', 'eo_handle_form_submission' );

/**
 * Send email notification to admin
 */
function eo_send_form_notification( $post_id, $form_data ) {
	$email   = get_post_meta( $post_id, 'eo_form_email', true );
	$phone   = get_post_meta( $post_id, 'eo_form_phone', true );
	$company = get_post_meta( $post_id, 'eo_form_company', true );
	$first_name = get_post_meta( $post_id, 'eo_form_first_name', true );
	$last_name = get_post_meta( $post_id, 'eo_form_last_name', true );
	$stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );

	$admin_email = get_option( 'admin_email' );

	$subject = sprintf( 'New Form Submission: %s', $company ? $company : $email );

	$message = sprintf(
		'A new Talk to Expert form has been submitted.

Name: %s
Company: %s
Email: %s
Phone: %s
B2B Stage: %s

View submission: %s

Full Form Data:
%s',
		trim( $first_name . ' ' . $last_name ) ?: '(Not provided)',
		$company ? $company : '(Not provided)',
		$email,
		$phone ? $phone : '(Not provided)',
		$stage,
		admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
		wp_json_encode( $form_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES )
	);

	wp_mail( $admin_email, $subject, $message );
}

/**
 * Customize admin columns for form submissions
 */
function eo_customize_form_submission_columns( $columns ) {
	unset( $columns['date'] );

	$columns['name']     = __( 'Name', 'electric-octopus' );
	$columns['email']    = __( 'Email', 'electric-octopus' );
	$columns['company']  = __( 'Company', 'electric-octopus' );
	$columns['phone']    = __( 'Phone', 'electric-octopus' );
	$columns['stage']    = __( 'B2B Stage', 'electric-octopus' );
	$columns['date']     = __( 'Submitted', 'electric-octopus' );

	return $columns;
}
add_filter( 'manage_eo_form_submission_posts_columns', 'eo_customize_form_submission_columns' );

/**
 * Populate custom columns
 */
function eo_populate_form_submission_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'name':
			$first_name = get_post_meta( $post_id, 'eo_form_first_name', true );
			$last_name = get_post_meta( $post_id, 'eo_form_last_name', true );
			echo esc_html( trim( $first_name . ' ' . $last_name ) ?: '(Not provided)' );
			break;

		case 'email':
			echo esc_html( get_post_meta( $post_id, 'eo_form_email', true ) );
			break;

		case 'company':
			echo esc_html( get_post_meta( $post_id, 'eo_form_company', true ) );
			break;

		case 'phone':
			echo esc_html( get_post_meta( $post_id, 'eo_form_phone', true ) );
			break;

		case 'stage':
			echo esc_html( get_post_meta( $post_id, 'eo_b2b_stage', true ) );
			break;
	}
}
add_action( 'manage_eo_form_submission_posts_custom_column', 'eo_populate_form_submission_columns', 10, 2 );

/**
 * Make custom columns sortable
 */
function eo_sortable_form_submission_columns( $columns ) {
	$columns['email']   = 'eo_form_email';
	$columns['company'] = 'eo_form_company';
	$columns['phone']   = 'eo_form_phone';
	$columns['stage']   = 'eo_b2b_stage';

	return $columns;
}
add_filter( 'manage_edit-eo_form_submission_sortable_columns', 'eo_sortable_form_submission_columns' );

/**
 * Add custom metabox for displaying form data
 */
function eo_add_form_data_metabox() {
	add_meta_box(
		'eo_form_data_box',
		__( 'Form Data', 'electric-octopus' ),
		'eo_form_data_metabox_callback',
		'eo_form_submission',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'eo_add_form_data_metabox' );

/**
 * Metabox callback
 */
function eo_form_data_metabox_callback( $post ) {
	$form_data = get_post_meta( $post->ID, 'eo_form_data', true );

	?>
	<div id="eo-form-data">
		<style>
			#eo-form-data {
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
			}
			#eo-form-data .eo-section {
				margin-bottom: 30px;
				padding: 15px;
				background: #f5f5f5;
				border-left: 4px solid #0073aa;
				border-radius: 3px;
			}
			#eo-form-data .eo-section h3 {
				margin-top: 0;
				color: #0073aa;
				text-transform: uppercase;
				font-size: 12px;
				font-weight: 600;
			}
			#eo-form-data .eo-field {
				margin-bottom: 15px;
			}
			#eo-form-data .eo-field label {
				display: block;
				font-weight: 600;
				margin-bottom: 5px;
				color: #333;
			}
			#eo-form-data .eo-field-value {
				background: white;
				padding: 10px;
				border-radius: 3px;
				border: 1px solid #ddd;
				word-break: break-word;
			}
			#eo-form-data .eo-array {
				list-style: none;
				padding: 0;
				margin: 0;
			}
			#eo-form-data .eo-array li {
				background: white;
				padding: 8px;
				margin-bottom: 5px;
				border-left: 3px solid #0073aa;
				padding-left: 12px;
			}
		</style>

		<?php if ( $form_data ) : ?>
			<?php foreach ( $form_data as $part_key => $part_value ) : ?>
				<div class="eo-section">
					<h3><?php echo esc_html( strtoupper( str_replace( 'part', 'Part ', $part_key ) ) ); ?></h3>
					<?php eo_display_form_field( $part_value ); ?>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No form data available', 'electric-octopus' ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Helper function to display form fields recursively
 */
function eo_display_form_field( $data ) {
	if ( is_array( $data ) ) {
		?>
		<div class="eo-field">
			<?php foreach ( $data as $key => $value ) : ?>
				<?php if ( is_array( $value ) ) : ?>
					<label><?php echo esc_html( ucwords( str_replace( '_', ' ', $key ) ) ); ?></label>
					<ul class="eo-array">
						<?php foreach ( $value as $item ) : ?>
							<li><?php echo esc_html( is_array( $item ) ? wp_json_encode( $item ) : $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<label><?php echo esc_html( ucwords( str_replace( '_', ' ', $key ) ) ); ?></label>
					<div class="eo-field-value"><?php echo esc_html( $value ); ?></div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php
	} else {
		?>
		<div class="eo-field-value"><?php echo esc_html( $data ); ?></div>
		<?php
	}
}

/**
 * AJAX handler to send resume link via email
 */
function eo_send_resume_link_email() {
	error_log('=== EO Resume Email AJAX Called ===');
	error_log('POST data received: ' . print_r($_POST, true));

	// Get email and resume URL (don't require nonce for old form)
	$user_email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
	$resume_url = isset( $_POST['resumeUrl'] ) ? esc_url_raw( $_POST['resumeUrl'] ) : '';
	$form_data = isset( $_POST['formData'] ) ? json_decode( stripslashes( $_POST['formData'] ), true ) : array();

	error_log('Email: ' . $user_email);
	error_log('Resume URL: ' . $resume_url);
	error_log('Resume URL exists: ' . ( !empty($resume_url) ? 'Yes' : 'No' ));
	error_log('Form data: ' . print_r($form_data, true));

	if ( empty( $user_email ) || ! is_email( $user_email ) ) {
		error_log('EO Resume Email - Invalid email: ' . ( $user_email ?: 'empty' ) );
		wp_send_json_error( 'Invalid email address' );
	}

	if ( empty( $resume_url ) ) {
		error_log('EO Resume Email - No resume URL provided' );
		wp_send_json_error( 'No resume URL provided' );
	}
	
	error_log('EO Resume Email - Validation passed, preparing email...');

	// Extract user info from form data
	$first_name = '';
	$last_name = '';
	$company = '';

	foreach ( $form_data as $step_data ) {
		if ( is_array( $step_data ) ) {
			if ( isset( $step_data['firstName'] ) || isset( $step_data['fname'] ) ) {
				$first_name = sanitize_text_field( $step_data['firstName'] ?? $step_data['fname'] );
			}
			if ( isset( $step_data['lastName'] ) || isset( $step_data['lname'] ) ) {
				$last_name = sanitize_text_field( $step_data['lastName'] ?? $step_data['lname'] );
			}
			if ( isset( $step_data['company'] ) ) {
				$company = sanitize_text_field( $step_data['company'] );
			}
		}
	}

	// Build email content
	$user_name = trim( $first_name . ' ' . $last_name ) ?: 'there';
	$subject = 'Resume Your Talk to Expert Form';

	$message = sprintf(
		"Hi %s,

Thanks for starting the Talk to Expert form! We noticed you stepped away before completing it.

No problem—we've saved your progress. You can resume right where you left off using the link below:

%s

This link will restore all your answers, so you won't lose any information.

Just click the link above and continue filling out your information.

Best regards,
The Electric Octopus Team",
		esc_html( $user_name ),
		esc_html( $resume_url )
	);

	// Add HTML version
	$message_html = sprintf(
		"<html><body style=\"font-family: Arial, sans-serif; color: #333; line-height: 1.6;\">
<p>Hi %s,</p>

<p>Thanks for starting the Talk to Expert form! We noticed you stepped away before completing it.</p>

<p><strong>No problem—we've saved your progress.</strong> You can resume right where you left off using the button below:</p>

<p style=\"text-align: center; margin: 30px 0;\">
	<a href=\"%s\" style=\"
		display: inline-block;
		padding: 12px 30px;
		background-color: #0073aa;
		color: white;
		text-decoration: none;
		border-radius: 3px;
		font-weight: bold;
	\">
		Resume Your Form
	</a>
</p>

<p style=\"margin-top: 30px; color: #666; font-size: 12px;\">
	If you can't click the button above, copy and paste this link in your browser:
	<br>%s
</p>

<p>Best regards,<br>The Electric Octopus Team</p>
</body></html>",
		esc_html( $user_name ),
		esc_attr( $resume_url ),
		esc_html( $resume_url )
	);

	// Set up email headers for HTML
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );

	// Send email
	$email_sent = wp_mail( $user_email, $subject, $message_html, $headers );

	// Log detailed information for debugging
	error_log( "EO Resume Email - Attempting to send email to: $user_email" );
	error_log( "EO Resume Email - Subject: $subject" );
	error_log( "EO Resume Email - Resume URL: $resume_url" );
	error_log( "EO Resume Email - wp_mail result: " . ($email_sent ? 'true' : 'false') );

	// Check WordPress mail settings
	global $phpmailer;
	if ( isset( $phpmailer ) ) {
		error_log( "EO Resume Email - PHPMailer Host: " . $phpmailer->Host );
		error_log( "EO Resume Email - PHPMailer Port: " . $phpmailer->Port );
		error_log( "EO Resume Email - PHPMailer SMTPAuth: " . ($phpmailer->SMTPAuth ? 'true' : 'false') );
	}

	if ( $email_sent ) {
		error_log( "EO Resume Email - SUCCESS: Email sent to: $user_email" );
		wp_send_json_success( array(
			'message' => 'Resume link email sent successfully',
			'email' => $user_email,
			'resume_url' => $resume_url
		) );
	} else {
		error_log( "EO Resume Email - FAILURE: Could not send email to: $user_email" );
		error_log( "EO Resume Email - WordPress last error: " . (isset($phpmailer->ErrorInfo) ? $phpmailer->ErrorInfo : 'No error info') );
		wp_send_json_error( array(
			'message' => 'Failed to send email',
			'email' => $user_email,
			'error' => isset($phpmailer->ErrorInfo) ? $phpmailer->ErrorInfo : 'Unknown error'
		) );
	}
}
add_action( 'wp_ajax_eo_send_resume_link_email', 'eo_send_resume_link_email' );
add_action( 'wp_ajax_nopriv_eo_send_resume_link_email', 'eo_send_resume_link_email' );


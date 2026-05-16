<?php
/**
 * Talk to Expert Admin Dashboard
 * Custom admin page for viewing and managing form submissions
 *
 * @package Electric_Octopus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add admin menu for form submissions dashboard
 * Creates hierarchical workflow: Forms → Submissions → Details
 */
function eo_add_admin_menu() {
	// Main Forms menu
	add_menu_page(
		__( 'Forms', 'electric-octopus' ),                    // Page title
		__( 'Forms', 'electric-octopus' ),                    // Menu title
		'manage_options',                                     // Capability
		'eo-forms',                                           // Menu slug
		'eo_render_form_dashboard',                           // Callback
		'dashicons-clipboard-alt',                            // Icon
		3                                                     // Position
	);

	// Submissions submenu (shows submissions list)
	add_submenu_page(
		'eo-forms',                                           // Parent slug
		__( 'Submissions', 'electric-octopus' ),              // Page title
		__( 'Submissions', 'electric-octopus' ),              // Menu title
		'manage_options',                                     // Capability
		'eo-forms',                                           // Menu slug (same as parent to show on main page)
		'eo_render_form_dashboard'                            // Callback
	);

	// Analytics submenu
	add_submenu_page(
		'eo-forms',                                           // Parent slug
		__( 'Analytics', 'electric-octopus' ),                // Page title
		__( 'Analytics', 'electric-octopus' ),                // Menu title
		'manage_options',                                     // Capability
		'eo-form-analytics',                                  // Menu slug
		'eo_render_form_analytics'                            // Callback
	);

	// Settings submenu (for future use)
	add_submenu_page(
		'eo-forms',                                           // Parent slug
		__( 'Settings', 'electric-octopus' ),                 // Page title
		__( 'Settings', 'electric-octopus' ),                 // Menu title
		'manage_options',                                     // Capability
		'eo-form-settings',                                   // Menu slug
		'eo_render_form_settings'                             // Callback
	);
}
add_action( 'admin_menu', 'eo_add_admin_menu' );

/**
 * Render settings page (placeholder for future features)
 */
function eo_render_form_settings() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Form Settings', 'electric-octopus' ); ?></h1>
		<p><?php esc_html_e( 'Form settings and configuration options coming soon.', 'electric-octopus' ); ?></p>
	</div>
	<?php
}

/**
 * Render main dashboard
 */
function eo_render_form_dashboard() {
	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'electric-octopus' ) );
	}

	// Get submissions
	$args = array(
		'post_type'      => 'eo_form_submission',
		'posts_per_page' => 50,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) {
		$args['s'] = sanitize_text_field( wp_unslash( $_GET['s'] ) );
	}

	$query = new WP_Query( $args );
	$total = $query->found_posts;

	?>
	<div class="wrap">
		<!-- Workflow Breadcrumb -->
		<div style="margin-bottom:20px;padding:10px;background:#f5f5f5;border-left:4px solid #0073aa;border-radius:3px;">
			<nav style="font-size:13px;color:#666;">
				<strong><?php esc_html_e( 'Workflow:', 'electric-octopus' ); ?></strong>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=eo-forms' ) ); ?>" style="color:#0073aa;text-decoration:none;">
					<?php esc_html_e( 'Forms', 'electric-octopus' ); ?>
				</a>
				<span style="margin:0 8px;">→</span>
				<strong><?php esc_html_e( 'Submissions', 'electric-octopus' ); ?></strong>
				<span style="margin:0 8px;color:#999;">→</span>
				<span style="color:#999;"><?php esc_html_e( 'Details (click row to view)', 'electric-octopus' ); ?></span>
			</nav>
		</div>

		<h1><?php esc_html_e( 'Form Submissions', 'electric-octopus' ); ?></h1>
		<p class="description">
			<?php esc_html_e( 'View all Talk to Expert form submissions. Click on any submission to view full details and form responses.', 'electric-octopus' ); ?>
		</p>

		<!-- Search Form -->
		<div class="tablenav top">
			<div class="alignleft actions">
				<form method="get" style="display:inline-block;margin-right:20px;">
					<input type="hidden" name="page" value="eo-forms">
					<input type="text" name="s" placeholder="Search by email or company..." value="<?php echo isset( $_GET['s'] ) ? esc_attr( wp_unslash( $_GET['s'] ) ) : ''; ?>" style="padding:8px;width:300px;">
					<button type="submit" class="button"><?php esc_html_e( 'Search', 'electric-octopus' ); ?></button>
					<?php if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) : ?>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=eo-forms' ) ); ?>" class="button" style="margin-left:10px;">
							<?php esc_html_e( 'Clear', 'electric-octopus' ); ?>
						</a>
					<?php endif; ?>
				</form>
			</div>
			<div class="alignright">
				<span class="displaying-num"><?php printf( esc_html__( '%d submissions', 'electric-octopus' ), intval( $total ) ); ?></span>
			</div>
		</div>

		<!-- Submissions Table -->
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th style="width:200px;"><?php esc_html_e( 'Company', 'electric-octopus' ); ?></th>
					<th style="width:200px;"><?php esc_html_e( 'Email', 'electric-octopus' ); ?></th>
					<th style="width:150px;"><?php esc_html_e( 'Phone', 'electric-octopus' ); ?></th>
					<th style="width:120px;"><?php esc_html_e( 'B2B Stage', 'electric-octopus' ); ?></th>
					<th style="width:150px;"><?php esc_html_e( 'Submitted', 'electric-octopus' ); ?></th>
					<th style="width:100px;"><?php esc_html_e( 'Action', 'electric-octopus' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_id = get_the_ID();
						$email   = get_post_meta( $post_id, 'eo_form_email', true );
						$phone   = get_post_meta( $post_id, 'eo_form_phone', true );
						$company = get_post_meta( $post_id, 'eo_form_company', true );
						$stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );
						?>
						<tr style="cursor:pointer;" onclick="window.location='<?php echo esc_url( admin_url( 'post.php?post=' . $post_id . '&action=edit' ) ); ?>';">
							<td><strong><?php echo esc_html( $company ? $company : '—' ); ?></strong></td>
							<td>
								<a href="mailto:<?php echo esc_attr( $email ); ?>" onclick="event.stopPropagation();">
									<?php echo esc_html( $email ); ?>
								</a>
							</td>
							<td><?php echo esc_html( $phone ? $phone : '—' ); ?></td>
							<td>
								<span class="dashicons dashicons-badge" style="color:#0073aa;"></span>
								<?php echo esc_html( ucfirst( $stage ) ); ?>
							</td>
							<td><?php echo esc_html( get_the_date( 'M d, Y H:i' ) ); ?></td>
							<td>
								<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $post_id . '&action=edit' ) ); ?>" class="button button-small button-primary">
									<?php esc_html_e( 'View', 'electric-octopus' ); ?>
								</a>
							</td>
						</tr>
						<?php
					}
				} else {
					?>
					<tr>
						<td colspan="6" style="text-align:center;padding:20px;">
							<?php esc_html_e( 'No submissions found.', 'electric-octopus' ); ?>
						</td>
					</tr>
					<?php
				}
				wp_reset_postdata();
				?>
			</tbody>
		</table>
	</div>

	<style>
		.eo-dashboard-stats {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}

		.eo-stat-box {
			background: white;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
			border-top: 4px solid #0073aa;
		}

		.eo-stat-box h3 {
			margin: 0 0 10px 0;
			font-size: 14px;
			font-weight: 600;
			color: #666;
			text-transform: uppercase;
		}

		.eo-stat-box .number {
			font-size: 32px;
			font-weight: bold;
			color: #0073aa;
		}
	</style>
	<?php
}

/**
 * Render analytics page
 */
function eo_render_form_analytics() {
	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'electric-octopus' ) );
	}

	// Get statistics
	$total_submissions = wp_count_posts( 'eo_form_submission' )->publish;

	// Get B2B stage breakdown
	$stages = array(
		'launching' => 0,
		'growing'   => 0,
		'scaling'   => 0,
	);

	$args = array(
		'post_type'      => 'eo_form_submission',
		'posts_per_page' => -1,
	);
	$query = new WP_Query( $args );

	while ( $query->have_posts() ) {
		$query->the_post();
		$stage = get_post_meta( get_the_ID(), 'eo_b2b_stage', true );
		if ( isset( $stages[ $stage ] ) ) {
			$stages[ $stage ]++;
		}
	}
	wp_reset_postdata();

	// Get submissions by date (last 30 days)
	$submissions_by_date = array();
	for ( $i = 30; $i >= 0; $i-- ) {
		$date  = date( 'Y-m-d', strtotime( "-$i days" ) );
		$count = new WP_Query( array(
			'post_type'      => 'eo_form_submission',
			'posts_per_page' => -1,
			'date_query'     => array(
				array(
					'year'  => date( 'Y', strtotime( $date ) ),
					'month' => date( 'm', strtotime( $date ) ),
					'day'   => date( 'd', strtotime( $date ) ),
				),
			),
		) );
		$submissions_by_date[ $date ] = $count->found_posts;
	}

	?>
	<div class="wrap">
		<!-- Workflow Breadcrumb -->
		<div style="margin-bottom:20px;padding:10px;background:#f5f5f5;border-left:4px solid #0073aa;border-radius:3px;">
			<nav style="font-size:13px;color:#666;">
				<strong><?php esc_html_e( 'Workflow:', 'electric-octopus' ); ?></strong>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=eo-forms' ) ); ?>" style="color:#0073aa;text-decoration:none;">
					<?php esc_html_e( 'Forms', 'electric-octopus' ); ?>
				</a>
				<span style="margin:0 8px;">→</span>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=eo-forms' ) ); ?>" style="color:#0073aa;text-decoration:none;">
					<?php esc_html_e( 'Submissions', 'electric-octopus' ); ?>
				</a>
				<span style="margin:0 8px;">→</span>
				<strong><?php esc_html_e( 'Analytics', 'electric-octopus' ); ?></strong>
			</nav>
		</div>

		<h1><?php esc_html_e( 'Form Submission Analytics', 'electric-octopus' ); ?></h1>
		<p class="description">
			<?php esc_html_e( 'Overview of form submissions, conversion metrics, and B2B stage distribution.', 'electric-octopus' ); ?>
		</p>

		<div class="eo-dashboard-stats">
			<div class="eo-stat-box">
				<h3><?php esc_html_e( 'Total Submissions', 'electric-octopus' ); ?></h3>
				<div class="number"><?php echo intval( $total_submissions ); ?></div>
			</div>

			<div class="eo-stat-box">
				<h3><?php esc_html_e( 'Launching Stage', 'electric-octopus' ); ?></h3>
				<div class="number"><?php echo intval( $stages['launching'] ); ?></div>
			</div>

			<div class="eo-stat-box">
				<h3><?php esc_html_e( 'Growing Stage', 'electric-octopus' ); ?></h3>
				<div class="number"><?php echo intval( $stages['growing'] ); ?></div>
			</div>

			<div class="eo-stat-box">
				<h3><?php esc_html_e( 'Scaling Stage', 'electric-octopus' ); ?></h3>
				<div class="number"><?php echo intval( $stages['scaling'] ); ?></div>
			</div>
		</div>

		<div style="background:white;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1);margin-bottom:30px;">
			<h2><?php esc_html_e( 'Submissions Last 30 Days', 'electric-octopus' ); ?></h2>
			<canvas id="eo-submissions-chart" height="80"></canvas>
		</div>

		<div style="background:white;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1);">
			<h2><?php esc_html_e( 'Stage Distribution', 'electric-octopus' ); ?></h2>
			<div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:center;max-width:600px;">
				<div>
					<ul style="list-style:none;padding:0;">
						<li style="padding:10px 0;border-bottom:1px solid #eee;">
							<span style="display:inline-block;width:16px;height:16px;background:#0073aa;border-radius:3px;margin-right:10px;vertical-align:middle;"></span>
							Launching: <strong><?php echo intval( $stages['launching'] ); ?></strong>
						</li>
						<li style="padding:10px 0;border-bottom:1px solid #eee;">
							<span style="display:inline-block;width:16px;height:16px;background:#007cba;border-radius:3px;margin-right:10px;vertical-align:middle;"></span>
							Growing: <strong><?php echo intval( $stages['growing'] ); ?></strong>
						</li>
						<li style="padding:10px 0;">
							<span style="display:inline-block;width:16px;height:16px;background:#0085ca;border-radius:3px;margin-right:10px;vertical-align:middle;"></span>
							Scaling: <strong><?php echo intval( $stages['scaling'] ); ?></strong>
						</li>
					</ul>
				</div>
				<canvas id="eo-stage-chart"></canvas>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Submissions Line Chart
			const lineCtx = document.getElementById('eo-submissions-chart').getContext('2d');
			new Chart(lineCtx, {
				type: 'line',
				data: {
					labels: <?php echo wp_json_encode( array_keys( $submissions_by_date ) ); ?>,
					datasets: [{
						label: 'Submissions',
						data: <?php echo wp_json_encode( array_values( $submissions_by_date ) ); ?>,
						borderColor: '#0073aa',
						backgroundColor: 'rgba(0, 115, 170, 0.1)',
						tension: 0.4,
						fill: true,
					}]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: false,
						}
					},
					scales: {
						y: {
							beginAtZero: true,
						}
					}
				}
			});

			// Stage Distribution Pie Chart
			const pieCtx = document.getElementById('eo-stage-chart').getContext('2d');
			new Chart(pieCtx, {
				type: 'doughnut',
				data: {
					labels: ['Launching', 'Growing', 'Scaling'],
					datasets: [{
						data: [
							<?php echo intval( $stages['launching'] ); ?>,
							<?php echo intval( $stages['growing'] ); ?>,
							<?php echo intval( $stages['scaling'] ); ?>
						],
						backgroundColor: [
							'#0073aa',
							'#007cba',
							'#0085ca'
						],
						borderColor: '#fff',
						borderWidth: 2,
					}]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: false,
						}
					}
				}
			});
		});
	</script>

	<style>
		.eo-dashboard-stats {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}

		.eo-stat-box {
			background: white;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
			border-top: 4px solid #0073aa;
		}

		.eo-stat-box h3 {
			margin: 0 0 10px 0;
			font-size: 14px;
			font-weight: 600;
			color: #666;
			text-transform: uppercase;
		}

		.eo-stat-box .number {
			font-size: 32px;
			font-weight: bold;
			color: #0073aa;
		}
	</style>
	<?php
}

/**
 * Register admin styles and scripts
 */
function eo_enqueue_admin_styles_scripts( $hook_suffix ) {
	if ( strpos( $hook_suffix, 'eo-form' ) !== false ) {
		wp_enqueue_style( 'eo-admin-styles', get_template_directory_uri() . '/css/admin.css', array(), '1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'eo_enqueue_admin_styles_scripts' );

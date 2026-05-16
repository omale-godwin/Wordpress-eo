<?php
/**
 * Template part for displaying results in Hero section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package our_work
 */

?>
<div class="ourwork-hero-section">
	<div class="hero-section-left">
	<?php
        $image_id = get_field('hero_image');
        if ($image_id) {
            // Fetch full image URL + alt text
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            // Get image dimensions
            $image_meta = wp_get_attachment_metadata($image_id);
            $width = $image_meta['width'];
            $height = $image_meta['height'];

            echo '<img src="' . esc_url($image_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt="' . esc_attr($alt) . '" decoding="async" />';
        }
        ?>

	</div>
	<div class="hero-section-right">
		<h1 class="hero-head">We Transform Data Into <br/>
		Revenu,Client Success Stories</h1>
		<p class="hero-para">Explore how our programmatic approach delivers measurable growth for businesses like yours . Enhance your digital presence with our data-driven, results-focused approach</p>
		<div class="hero-data">
            <?php
                // Dynamic stats (can use ACF or a WordPress customizer setting)
                $valStats = [
                    ['value' => '64.3%', 'text' => 'Lead qualification rates'],
                    ['value' => '3.1x', 'text' => 'Marketing ROI'],                    
                ];

                foreach ($valStats as $stat) : ?>
                <div>
                    <p class="hero-data-val"><?php echo esc_html($stat['value']); ?></p>
                    <p class="hero-data-txt"><?php echo esc_html($stat['text']); ?></p>
                </div>
                              
            <?php endforeach; ?> 
			
		</div>
		<!-- Subscription Box -->
		<div class="hero-subscription">
            <p class="hero-text2">Subscribe For Success Blueprints in your Box </p>
            <form action="<?php echo esc_url(site_url('/subscribe')); ?>" method="post">
                <div class="hero-subscription-box">
                    <input class="hero-input" type="email" name="email" placeholder=" Work Email" required autofill="off">
                    <button class="msg-button maxw-124" type="submit">Subscribe</button>
                </div>
            </form>
            <p class="hero-text">
				Weekly inbox delivery of our latest client wins, complete with actionable insights
            </p>
        </div>
		<div class="footer-partner-left">
            <h3 class="partner-heading">OUR OFFICIAL PARTNER</h3>
            <div class="partner-flex">
            <?php
                // Dynamic stats (can use ACF or a WordPress customizer setting)
                $stats = [
                    ['value' => 'https://cdn.electricoctopus.agency/electric-octopus/meta-logo.png', 'text' => 'Business PARTNER'],
                    ['value' => 'https://cdn.electricoctopus.agency/electric-octopus/google-logo.png', 'text' => 'GOOGLE PARTNER'],
                    ['value' => 'https://cdn.electricoctopus.agency/electric-octopus/tiktok-logo.png', 'text' => 'MARKETING PARTNER'],
                    
                ];

                foreach ($stats as $stat) : ?>
                <div class="partner-item">
                    <div class="partner-logo">
                        <img src="<?php echo esc_html($stat['value']); ?>" alt="logo" loading="lazy">
                    </div>
                    <p class="partner-head-text"><?php echo esc_html($stat['text']); ?></p>
                </div>                  
                <?php endforeach; ?>                   
            </div>

        </div>
    </div>
</div>
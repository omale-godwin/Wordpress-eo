<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OC-theme
 */

?>

<div class="newsletter-section" id="blog">
        <div class="newsletter-left">
            <p class="newsletter-head-text">Revenue-Focused Marketing Insights In Your Inbox</p>
            <div class="css-jmbq56">
                <div class="flex justify-space-between align-item-center">
                <form id="subscriptionForm" class="subscriptionForm">
                    <div class="flex align-item-center gap-16 w-100">
                        <div class="newsletter-input">
                            <input type="text" placeholder="Full name" class="chakra-input css-1rc0ayy" id="full-name" autocomplete="off"/>
                            <span class="error-message" id="name-error"></span>
                        </div>
                        <div class="newsletter-input">
                            <input type="email" placeholder="Work email" class="chakra-input css-1rc0ayy" id="email" autocomplete="off"/>
                            <span class="error-message" id="email-error"></span>
                        </div>
                        <button type="submit" class="subscribe-button">Subscribe</button>
                    </div>
                </form>

                </div>
            </div>
            <p class="newsletter-bottom-text">Subscribe for our integrated framework that solves fragmented systems and missed opportunities</p>
        </div>
        <div class="newsletter-right">
            <p class="newsletter-head-text">Follow Us On</p>
            <div class="flex align-item-center gap-16">
                <!-- Social Media Links -->
                <?php
                    // Get the ID of the homepage (if it's a static page)
                    $homepage_id = get_option('page_on_front');

                    // Retrieve the custom fields (social media links) from the homepage
                    $linkedin = get_field('linkedin', $homepage_id);
                    $twitter = get_field('twitter', $homepage_id);
                    $youtube = get_field('youtube', $homepage_id);
                    $pinterest = get_field('pinterest', $homepage_id);
                    $instagram = get_field('instagram', $homepage_id);
                    $tiktok = get_field('tiktok', $homepage_id);
                    $facebook = get_field('facebook', $homepage_id);
                    ?>

                    <?php if ($linkedin): ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_linkedin.png" alt="linkedin" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>

                    <?php if ($twitter): ?>
                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_twitter.png" alt="twitter" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>

                    <?php if ($youtube): ?>
                        <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_youtube.png" alt="youtube" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>

                    <?php if ($pinterest): ?>
                        <a href="<?php echo esc_url($pinterest); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_pinterest.png" alt="pinterest" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>

                    <?php if ($instagram): ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_instagram.png" alt="instagram" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>

                    <?php if ($tiktok): ?>
                        <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_tiktok.png" alt="tiktok" loading="lazy" width="32" height="32"> 
                        </a>
                    <?php endif; ?>

                    <?php if ($facebook): ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/electricOctopus_facebook.png" alt="facebook" loading="lazy" width="32" height="32">
                        </a>
                    <?php endif; ?>
                <!-- Additional icons here... -->
            </div>
        </div>
</div>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OC-theme
 */

?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="lazy-bg footer-section" data-bg="https://cdn.electricoctopus.agency/electric-octopus/foo_bg.webp">
        <div class="footer-container">
            <div class="foo-flex align-start">
                <!-- Left Section (Widget Area) -->
                <div class="footer-left">
                    <?php if (is_active_sidebar('footer-left')) : ?>
                        <?php dynamic_sidebar('footer-left'); ?>
                    <?php endif; ?>
                </div>

                <!-- Right Section (Dynamic Menus) -->
                <div class="footer-right">
                    <?php
                      function render_footer_menu($location, $title, $extra_class = '') {
                          echo '<div' . ($extra_class ? ' class="' . esc_attr($extra_class) . '"' : '') . '>';
                          echo '<h3 class="footer-heading">' . esc_html($title) . '</h3>';
                          wp_nav_menu([
                              'theme_location' => $location,
                              'container' => false,
                              'menu_class' => 'list-item',
                          ]);
                          echo '</div>';
                      }
                      ?>

                      <div class="foo-flex">

                          <div class="mb-flex">
                              <?php
                              render_footer_menu('footer-agency', 'Agency');
                              // Add extra classes for Support to keep existing styling
                              render_footer_menu('footer-support', 'Support', 'foo-mt d-mb-none');
                              ?>
                          </div>

                          <div>
                              <?php
                              render_footer_menu('footer-platform', 'PLATFORM');
                              render_footer_menu('footer-client-management', 'Client Management', 'foo-mt d-mb-none');
                              ?>
                          </div>

                          <?php
                          render_footer_menu('footer-solutions', 'Solutions');
                          render_footer_menu('footer-resources', 'Resources');
                          render_footer_menu('footer-hubs', 'Hubs');
                          ?>

                      </div>                   
                </div>
            </div>
            <div class="footer-partner foo-flex">
              <div class="footer-partner-left partner-section">
            
                    <h3 class="partner-heading">OUR OFFICIAL PARTNER</h3>
                    <div class="partner-flex">
                      <!-- Loop through partner items -->
                      <div class="partner-item">
                        <div class="partner-logo">
                          <img src="https://cdn.electricoctopus.agency/electric-octopus/meta-logo.png" alt="meta logo" loading="lazy">
                        </div>
                        <p class="partner-text">Business PARTNER</p>
                      </div>
                      <div class="partner-item">
                        <div class="partner-logo">
                          <img src="https://cdn.electricoctopus.agency/electric-octopus/google-logo.png" alt="google logo" loading="lazy">
                        </div>
                        <p class="partner-text">GOOGLE PARTNER</p>
                      </div>
                      <div class="partner-item">
                        <div class="partner-logo">
                          <img src="https://cdn.electricoctopus.agency/electric-octopus/tiktok-logo.png" alt="tiktok logo" loading="lazy">
                        </div>
                        <p class="partner-text">MARKETING PARTNER</p>
                      </div>
                      <!-- LinkedIn Marketing Labs Section -->
                      <div class="linkedin-section">
                        <p class="linkedin-text">LinkedIn Marketing Labs</p>
                        <div class="linkedin-certified">
                          <div class="linkedin-logo">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/linkedin-logo.png" alt="linkedin" loading="lazy">
                          </div>
                          Certified Marketing Insider
                        </div>
                        <p class="linkedin-text">LinkedIn Marketing Labs</p>
                      </div>
                      <div class="partner-item">
                        <div class="partner-logo">
                          <img src="https://cdn.electricoctopus.agency/electric-octopus/agency-partner.png" alt="agency partner" loading="lazy">
                        </div>
                        
                      </div>
                      <div class="partner-item">
                        <div class="partner-logo">
                          <img src="https://cdn.electricoctopus.agency/electric-octopus/aws.png" alt="aws logo" loading="lazy">
                        </div>
                        
                      </div>
                    </div>
                  

              </div>
              <div class="footer-partner-right">
                  <!-- Subscription Box -->
                  <div class="blog-subscription">
                        <div style="text-align: left; max-width: 510px; margin-top: 24px;">
                            <p class="footer-text2">The Strategic Targeting Digest in your inbox</p>
                            <form action="<?php echo esc_url(site_url('/subscribe')); ?>" method="post">
                            <div class="subscription-box">
                                
                                    <input class="input" type="email" name="email" placeholder="Work Email" required>
                                    <button class="white-button maxw-124" type="submit">Subscribe</button>
                                
                            </div>
                            </form>
                            <p class="footer-text" style="font-size: 11px; line-height: 130%;">
                            Transform B2B leads to revenue with weekly data insights that drive measurable results
                            </p>
                        </div>
                    </div>
              </div>
            </div>
            <div class="payment-sect">
              <div class="paymnt-logo">
              <img src="https://cdn.electricoctopus.agency/electric-octopus/master.png" alt="master card" loading="lazy">
              <img src="https://cdn.electricoctopus.agency/electric-octopus/american.png" alt="american express" loading="lazy">
              <img src="https://cdn.electricoctopus.agency/electric-octopus/visa.png" alt="visa" loading="lazy">
              <img src="https://cdn.electricoctopus.agency/electric-octopus/discover.png" alt="discover" loading="lazy">
              <img src="https://cdn.electricoctopus.agency/electric-octopus/paypal2.png" alt="paypal" loading="lazy">
              </div>
              <div class="flex align-iten-center gap-6">Powered by: <img src="https://cdn.electricoctopus.agency/electric-octopus/stripe2.png" alt="stripe" loading="lazy"></div>
            </div>
            <!-- Footer Bottom Section -->
            <div class="footer-bottom">
                <span>Copyright 2025  Electric Octopus (Element Zero Labs Limited). All Rights Reserved | 
                    <a href="https://electricoctopus.agency/terms_conditions">Terms and Conditions</a> | 
                    <a href="https://electricoctopus.agency/privacy_policy">Privacy Policy</a> | 
                    <a href="https://electricoctopus.agency/copyright_policy">Copyright Policy</a>
                </span>
                <div class="foo-social-links" id="sicial-media">
                <?php if (is_active_sidebar('sicial-media')) : ?>
                        <?php dynamic_sidebar('sicial-media'); ?>
                    <?php endif; ?>
              </div>
            </div>
            <p class="foo-btm">Element Zero Labs Ltd (EZL) (13262910). All rights reserved. EZL and its associated logos are trademarks or registered trademarks of Element Zero Labs Ltd.  <span>Electric Octopus®, Social Octopus®, Yellow Octopus®</span>  and 
            <span>Genious Octopus®</span> are trademark or registered trademark of EZL in the United Kingdom and other jurisdictions. All other trademarks and copyrights belong to their respective owners.<p>
        </div>
    </div>
</footer>

</div><!-- #page -->
<!-- <button id="scrollToTop" aria-label="Scroll to top"><img src="<?php //echo get_stylesheet_directory_uri(); ?>/assets/images/scroll-top.webp" alt="Scroll to top" style="width: 40px; height: auto;"></button> -->

<?php wp_footer(); ?>
<?php
$exit_popup = [
  'description' => 'Our data-forward approach has resonated with organizations worldwide, delivering measurable growth at scale. Each dot on our map.',
  'cta_text' => 'Talk to Expert',
  'cta_url' => 'https://electricoctopus.agency/schedule-a-call',
  'blocks' => [
    [
      'img' => 'https://cdn.electricoctopus.agency/ourwork/popup-img1.webp',
      'alt' => 'Share your project needs',
      'text' => 'Share your project needs',
    ],
    [
      'img' => 'https://cdn.electricoctopus.agency/ourwork/popup-img2.webp',
      'alt' => 'Book a meeting',
      'text' => 'Book a meeting with one of our digital transformation expert',
    ],
    [
      'img' => 'https://cdn.electricoctopus.agency/ourwork/popup-img3.webp',
      'alt' => 'Receive a proposal',
      'text' => 'Receive a proposal within 2 days',
    ],
  ],
];
?>

<div id="exitPopup" class="exit-popup" style="display: none;">
  <div class="exit-popup-content">
    <span id="exitPopupClose" class="exit-popup-close">&times;</span>

    <h2 class="popup-heading"><span>Transforming businesses</span> across<br/> 35+ countries with programmatic precision</h2>
    <p class="popup-para"><?php echo esc_html($exit_popup['description']); ?></p>

    <div class="exitPopup-img">
      <?php foreach ($exit_popup['blocks'] as $block) : ?>
        <div class="exitPopup-block">
          <div class="exit-img-block">
            <img 
              src="<?php echo esc_url($block['img']); ?>" 
              alt="<?php echo esc_attr($block['alt']); ?>" 
              class="wp-image"
            />
          </div>
          <p><?php echo esc_html($block['text']); ?></p>
        </div>
      <?php endforeach; ?>
      <div class="back-line"><img src="https://cdn.electricoctopus.agency/ourwork/back-line.png" alt="backline"></div>
    </div>

    <div class="schedule-call-button popup-button">
      <a href="<?php echo esc_url($exit_popup['cta_url']); ?>">
        <?php echo esc_html($exit_popup['cta_text']); ?>
      </a>
    </div>
  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    // More flexible homepage check
    const isHomepage = location.pathname === '/ourwork/' || location.pathname === '/';
    if (!isHomepage) return;

    const popup = document.getElementById('exitPopup');
    if (!popup) return;

    const closeBtn = document.getElementById('exitPopupClose');
    
    let headerEntryCount = 0;
    let hasClosedPopup = sessionStorage.getItem('exitPopupClosed') === 'true';
    let lastYPosition = window.innerHeight; // Start assuming mouse is at bottom
    
    // Reset for debugging
    // sessionStorage.removeItem('exitPopupClosed');
    // hasClosedPopup = false;

    function handleMouseMove(e) {
      const currentY = e.clientY;
      
      // Only count when moving upward into header area (from below 209px)
      if (currentY <= 209 && lastYPosition > 209 && !hasClosedPopup) {
        headerEntryCount++;
        console.log('Header entry #' + headerEntryCount);
        
        if (headerEntryCount >= 2) {
          showPopup();
        }
      }
      
      lastYPosition = currentY;
    }

    function showPopup() {
      popup.style.display = 'block';
      document.documentElement.classList.add('no-scroll');
      document.body.classList.add('no-scroll');
      document.removeEventListener('mousemove', handleMouseMove);
    }

    function closePopup() {
      popup.style.display = 'none';
      document.documentElement.classList.remove('no-scroll');
      document.body.classList.remove('no-scroll');
      sessionStorage.setItem('exitPopupClosed', 'true');
      hasClosedPopup = true;
    }

    if (!hasClosedPopup) {
      // Add slight delay before starting to track mouse movements
      setTimeout(() => {
        document.addEventListener('mousemove', handleMouseMove);
      }, 1000);
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', closePopup);
    }

    // Check if we need to show popup immediately (if it was showing before reload)
    if (popup.style.display === 'block') {
      showPopup();
    }
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-toggle");
    const groups = document.querySelectorAll(".testimonial-tab-group");

    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const index = this.dataset.index;

            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            groups.forEach(group => {
                group.classList.remove("active");
                if (group.dataset.index === index) {
                    group.classList.add("active");
                }
            });
        });
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const showMoreBtn = document.getElementById('showMoreBtn');
  const hiddenRows = document.querySelectorAll('.hidden-row');

  function slideDown(el) {
    el.style.display = 'flex';
    el.style.maxHeight = '0';
    el.style.overflow = 'hidden';
    el.style.transition = 'max-height 0.4s ease-out';
    requestAnimationFrame(() => {
      el.style.maxHeight = el.scrollHeight + 'px';
    });
  }

  function slideUp(el) {
    el.style.maxHeight = el.scrollHeight + 'px';
    requestAnimationFrame(() => {
      el.style.maxHeight = '0';
    });
    setTimeout(() => {
      el.style.display = 'none';
    }, 400);
  }

  if (showMoreBtn) {
    let expanded = false;
    showMoreBtn.addEventListener('click', function () {
      hiddenRows.forEach(row => {
        if (!expanded) {
          slideDown(row);
        } else {
          slideUp(row);
        }
      });

      expanded = !expanded;
      showMoreBtn.innerHTML = expanded ? 'Show Less <span class="toggle-icon">−</span>' : 'Show More <span class="toggle-icon">+</span>';
    });
  }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqButtons = document.querySelectorAll('.faq-question');

    faqButtons.forEach(button => {
        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
            const answer = document.getElementById(button.getAttribute('aria-controls'));
            const icon = button.querySelector('.toggle-icon polyline');

            // Toggle answer visibility
            button.setAttribute('aria-expanded', !expanded);
            answer.hidden = expanded;

            // Change polyline direction (down ↕ up)
            icon.setAttribute('points', expanded ? '6 9 12 15 18 9' : '6 15 12 9 18 15');

            // Toggle background color
            if (!expanded) {
                button.classList.add('active-faq');
            } else {
                button.classList.remove('active-faq');
            }
        });
    });
});
 </script>

</body>
</html>
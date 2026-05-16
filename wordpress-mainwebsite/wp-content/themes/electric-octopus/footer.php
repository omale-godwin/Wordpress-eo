<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Electric_Octopus
 */

?>

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="lazy-bg footer-section" data-bg="https://cdn.electricoctopus.agency/electric-octopus/foo_bg.webp">
        <div class="footer-container">
            <div class="foo-flex align-start">
                <!-- Left Section (Widget Area) -->
                <div class="footer-left">
					<a href="/">
          <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/foo-logo.png" alt="logo">
        </a>
        <p class="footer-text">
          Bridging the gap between marketing innovation and measurable business impact.
        </p>
        <div class="foo-buttons">
          <a href="https://electricoctopus.agency/nexusportal/authentication/new_business" class="custom-button disabled" target="_blank">Create Account</a>
          <a href="https://electricoctopus.agency/talk-to-expert/" class="msg-button" target="_blank">Talk to EXPERT</a>
   </div>
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
<!-- <div class="invite-banner" id="inviteBanner">
  <div class="custom-maxW invite-banner-inner">
    <div class="invite-left">
        <div class="invite-logo">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/invite-icon.webp" alt="">
        </div>

        <div class="invite-title">Electric Octopus Invite & Earn</div>

        <div class="invite-subtext">
            Earn rewards with every warm lead that converts to revenue. No limits apply.
        </div>
    </div>

    <a href="#" class="invite-btn">JOIN NOW</a>
    </div>
     <button class="invite-close" id="inviteClose">✕</button>
</div> -->

<button id="scrollToTop" class="scroll-top" aria-label="Scroll to top"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/scroll-top.webp" alt="Scroll to top" style="width: 40px; height: auto;"></button>
<?php wp_footer(); ?>
<!-- cookie -->
 <div id="cookie-banner1" class="cookie-banner" role="dialog" aria-live="polite" aria-labelledby="cookie-banner-heading" aria-hidden="false" style="display: block;">
    <div class="cookie-content">
        <h3 id="cookie-banner-heading">
            We have cookies!
            <img src="https://cdn.prismos.finance/cookie-icon.png" alt="cookies">
        </h3>
        <p>
            We use cookies on our website to give you the most relevant experience by remembering your preferences and repeat visits. By clicking “Accept”, you consent to the use of all the cookies. However, you may visit Cookie settings to provide a controlled consent.
        </p>
        <p class="flex gap-16">
            <a href="/cookies-policy" class="cookie-link">Cookies Policy</a>
            <a href="/privacy-policy" class="cookie-link">Privacy Policy</a>
        </p>
        <div class="cookie-actions">
          <button class="purple-button accept">Accept All</button>
            <button class="solid-button reject">Reject All</button>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    // Correct homepage check for rubicon.click
    const isHomepage = location.pathname === '/' || location.pathname === '';
    if (!isHomepage) return;

    const popup = document.getElementById('exitPopup');
    if (!popup) return;

    const closeBtn = document.getElementById('exitPopupClose');
    
    let headerEntryCount = 0;
    let hasClosedPopup = sessionStorage.getItem('exitPopupClosed') === 'true';
    let lastYPosition = window.innerHeight;

    function handleMouseMove(e) {
      const currentY = e.clientY;
      
      // Detect upward motion into top 209px
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
      setTimeout(() => {
        document.addEventListener('mousemove', handleMouseMove);
      }, 1000);
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', closePopup);
    }

    // If popup was open before reload
    if (popup.style.display === 'block') {
      showPopup();
    }
  });
</script>

<!-- consultancy popup -->
 <script>
  document.addEventListener('DOMContentLoaded', function () {
    // More flexible homepage check
   const isHomepage =
      location.pathname === '/prospecting-consultancy/' ||
      location.pathname === '/prospecting-consultancy';
    if (!isHomepage) return;

    const popup = document.getElementById('exitConsultPopup');
    if (!popup) return;

    const closeBtn = document.getElementById('exitConsultPopupClose');
    
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
<!-- scroll to top -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const scrollBtn = document.getElementById("scrollToTop");

    if (!scrollBtn) return;

    // Show button when user scrolls down
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            scrollBtn.classList.add("visible");
        } else {
            scrollBtn.classList.remove("visible");
        }
    });

    // Scroll smoothly to top when clicked
    scrollBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("cookie-banner1");
    const acceptBtn = document.querySelector("#cookie-banner1 .accept");
    const rejectBtn = document.querySelector("#cookie-banner1 .reject");

    if (!banner) return;

    // Check if user already made a choice
    const cookieChoice = localStorage.getItem("cookieConsent");

    if (cookieChoice === "accepted" || cookieChoice === "rejected") {
        banner.style.display = "none";
        banner.setAttribute("aria-hidden", "true");
        return;
    }

    // Accept
    acceptBtn.addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "accepted");
        hideBanner();
    });

    // Reject
    rejectBtn.addEventListener("click", function () {
        localStorage.setItem("cookieConsent", "rejected");
        hideBanner();
    });

    function hideBanner() {
        banner.style.opacity = "0";
        setTimeout(() => {
            banner.style.display = "none";
            banner.setAttribute("aria-hidden", "true");
        }, 300);
    }
});
</script>
<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const closeBtn = document.getElementById("inviteClose");
    const banner = document.getElementById("inviteBanner");

    if (closeBtn && banner) {
        closeBtn.addEventListener("click", function () {
            banner.style.display = "none";
        });
    }
});
</script> -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
const phoneInput = document.querySelector("#phone");

const iti = window.intlTelInput(phoneInput, {
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    fetch("https://ipapi.co/json/")
      .then(res => res.json())
      .then(data => callback(data.country_code))
      .catch(() => callback("us"));
  },
  separateDialCode: true,
  utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js"
});
</script>

</body>
</html>

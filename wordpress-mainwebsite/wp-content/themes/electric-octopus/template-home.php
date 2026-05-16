<?php
/* 
Template Name: Home Page
*/

get_header(); 
?>

<div class="main-body-container">
    <h1 class="visually-hidden">Welcome to Electric Octopus — Discover how to thrive online with creative excellence and smart strategy</h1>
    <!-- hero Section -->
    <?php get_template_part('template-parts/home/home-hero-section'); ?>
    <!-- tech slider -->
    <?php get_template_part('template-parts/home/home-tech-slider'); ?>
    <!-- platform -->
    <?php get_template_part('template-parts/home/home-platform-section'); ?>
    <!-- Datasource -->
    <?php get_template_part('template-parts/home/home-data-source'); ?>
    <!-- about us -->
    <?php get_template_part('template-parts/home/home-aboutus'); ?>
    <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/strip-1.webp" alt="stripe" width="100%"></div>
    <!-- what we do -->
    <?php get_template_part('template-parts/home/home-what-do'); ?>
   <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/strip-2.png" alt="stripe" width="100%"></div>
   <!-- industry-->
    <?php get_template_part('template-parts/home/home-industries'); ?>
    <!-- empower -->
     <?php get_template_part('template-parts/home/home-empower'); ?>
     <!-- casestudy -->
     <?php get_template_part('template-parts/home/home-casestudy'); ?>
     <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/strip-3.webp" alt="stripe" width="100%"></div>
     <!-- who we help -->
     <?php get_template_part('template-parts/home/home-who-we-help'); ?>
     <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/strip-4.webp" alt="stripe" width="100%"></div>
     <!-- client testimonial -->
     <?php get_template_part('template-parts/home/home-testimonial'); ?>
     <!-- clients -->
     <?php get_template_part('template-parts/home/home-clients'); ?>
     <div class="stripe"><img src="https://cdn.electricoctopus.agency/electric-octopus/strip-5.webp" alt="stripe" width="100%"></div>
      <!-- Events -->
     <?php get_template_part('template-parts/home/home-events'); ?>
     <!-- community -->
     <?php get_template_part('template-parts/home/home-community'); ?>
     <!-- meet the team -->
     <?php get_template_part('template-parts/home/home-meet-team'); ?>
     <!-- podcast-->
     <?php get_template_part('template-parts/home/home-podcast'); ?>
     <!-- digital transformation-->
     <?php get_template_part('template-parts/home/home-digital-transformation'); ?>
     <!-- talk to expert-->
     <?php get_template_part('template-parts/home/home-talk-to-expert'); ?>
</div>
<!-- Popup Modal -->
<div id="exitPopup" class="exit-popup" style="display: none;">
  <div class="exit-popup-content">
    <span id="exitPopupClose" class="exit-popup-close">&times;</span>
    <div class="popup-body">
            <div class="popup-left">

                <h2 class="popup-small-title">Unlock Your Digital Potential!</h2>

                <h3 class="popup-big-title">
                    Get a Comprehensive B2B Digital Marketing Report ($2500 Value)
                </h3>

                <ul class="popup-list">
                    <li><span>✓</span> In-depth analysis of your online presence</li>
                    <li><span>✓</span> Actionable insights to boost your ROI</li>
                    <li><span>✓</span> Personalized strategy recommendations</li>
                    <li class="popup-link">[Get a Market Positioning Report Now]</li>
                </ul>

                <a href="#" class="purple-button">Create a report</a>
            </div>

            <div class="popup-right">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/wbnr-img.webp"
                     alt="webinar image">
            </div>
        </div>
  </div>
</div>
<?php get_footer(); ?>

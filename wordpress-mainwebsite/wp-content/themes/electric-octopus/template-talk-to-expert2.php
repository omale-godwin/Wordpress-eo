<?php
/* 
Template Name: Talk To Expert 2
*/

get_header(); 
?>

<div class="main-body-container">
    <div id="assessment-form" class="assessment-wrapper">
        <div class="assessment-inner">
            <header class="assessment-header">
                <h1 id="assessment-title">
                    GET 3 RESOURCES TO OVERCOME YOUR BIGGEST OBSTACLE
                </h1>
                <p id="assessment-desc" class="assessment-desc">
                    Based on the information you provided on the form, it doesn’t look like look like we’d be a good fit for you as our minimum client engagement begins at $6,000 per month.
                </p>
            </header>
            <div class="assessment-card">
                <!-- STEP CONTENT (JS injects here) -->
                <div id="step-content" class="step-content"></div>           
            </div>
        </div>
        <!-- FOOTER -->
        <div class="assessment-footer">
            <div class="assessment-footer-inner white"><span id="step-indicator">1 /</span></div>
            <div class="nav-buttons">
                <button id="prev-step" disabled><img src="https://cdn.electricoctopus.agency/electric-octopus/arrow_right_a.png" alt="prev step" loading="lazy" width="24" height="24"></button>
                <button id="next-step"><img src="https://cdn.electricoctopus.agency/electric-octopus/arrow_right_a.png" alt="next step" loading="lazy" width="24" height="24"></button>
            </div>
        </div>
    </div>
    <section>
        <div class="talk-wrapper">
            <div class="talk-container">
                <div class="talk-flex">
                    
                    <!-- LEFT SECTION -->
                    <div class="talk-left">

                        <div class="talk-btn-box">
                            <a href="https://electricoctopus.agency/talk-to-expert/" class="talk-outline-btn"> Talk to Expert</a>
                        </div>

                        <h2 class="talk-heading-1">LETS JOIN FORCES TO CREATE</h2>

                        <h3 class="talk-heading-2">
                            <span class="talk-highlight">SOMETHING</span> EXTRAORDINARY
                        </h3>

                    </div>

                    <!-- RIGHT IMAGE -->
                    <a href="#" class="talk-img-link">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/touch-btn.png" alt="contact">
                    </a>

                </div>
            </div>
        </div>
    </section>        
</div>

<?php get_footer(); ?>

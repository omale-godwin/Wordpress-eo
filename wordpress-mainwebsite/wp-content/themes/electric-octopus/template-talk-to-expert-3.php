<?php
/* 
Template Name: talk to expert 3
*/

get_header(); 
?>

<div class="main-body-container">
<section class="part3-wrapper">
    <div class="part3-inner-wrapper">
        <div class="part3-head-wrapper">
            <h2>GET 3 resources to overcome your
            biggest obstacle</h2>
            <p>You are one step away from receiving your free business audit.
            Please provide the following information to see your audit results and learn more about achieving frictionless  compliance and higher opt-in rates.
            </p>
        </div>
        <div class="part3-body-wrap">
             <h2 class="part3-subheading">Your current <br/>B2B business stage is:</h2>
            <div class="b2b-stage-wrapper">  
                <!-- LEFT -->
                <div class="b2b-stages">
                    <div class="b2b-stage active" data-stage="launching">
                    <h3>Launching</h3>
                    <p>
                        You are one step away from receiving your complimentary B2B Business Audit. Ideal for businesses entering B2B markets and establishing their first enterprise partnerships, processes, and go-to-market frameworks.
                    </p>
                    </div>

                    <div class="b2b-stage" data-stage="growing">
                    <h3>Growing</h3>
                    <p>
                        You are one step away from receiving your complimentary B2B Business Audit. Perfect for businesses expanding their client base, improving conversion cycles, and strengthening sales, marketing, and delivery operations across B2B channels.
                    </p>
                    </div>

                    <div class="b2b-stage" data-stage="scaling">
                    <h3>Scaling</h3>
                    <p>
                        You are one step away from receiving your complimentary B2B Business Audit.Designed for businesses ready to scale aggressively by systemizing operations, expanding into new regions, and unlocking enterprise-level growth opportunities.
                    </p>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="b2b-stage-image-wrapper">
                    <img
                    id="b2b-stage-image"
                    src="https://cdn.electricoctopus.agency/electric-octopus/launching.webp"
                    alt="B2B Stage"
                    />
                </div>

            </div>
        </div>
    </div>
    <div class="part3-continue-btn">
        <button id="part3-continue" class="custom-button">
            Continue
        </button>
    </div>

</section>
<div id="assessment-form3" class="part3-wrapper">
        <div class="assessment-inner">
            <header class="assessment-header mt-0">
                <h1 id="assessment-title" class="mt-0">
                    Let’s Bring Your Vision to Life.
                </h1>
                <p id="assessment-desc" class="assessment-desc">
                    Submit your project details and let our experts craft the perfect solution tailored for you.
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
    
</div>

<?php get_footer(); ?>

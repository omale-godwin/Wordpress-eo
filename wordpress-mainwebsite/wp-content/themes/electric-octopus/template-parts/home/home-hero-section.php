<section id="section-1" class="hero-custom-maxW">
    <div class="hero-section">

        <!-- Hero Image -->
        <div class="hero-image-wrapper">
            <img 
                src="https://cdn.electricoctopus.agency/electric-octopus/new-banner-img2.webp"
                alt="Marketing Growth Banner"
                class="hero-image"
                loading="lazy"
                decoding="async"
            >
        </div>

        <div class="hero-content-wrapper">
            <div class="hero-content">

                <h2 class="hero-title-small">Unlock Revenue Growth with</h2>
                <h3 class="hero-title-large mb-24">Data-Driven Marketing Strategies</h3>

                <p class="hero-description mb-24">
                    Imagine Outperforming Your Competitors in Just 90 Days. Ready to Achieve Key Performance Metrics Targets ? 
                    Discover <a href="#" class="hero-link">who do we offer services for !!</a>
                </p>

                <p class="hero-note mb-16">
                    We’re launching a <span>community for B2B Marketing &amp; Sales</span>
                </p>

                <p class="hero-note-2 mb-16">
                    Join <a href="#">Marketer Nostalgia</a> B2B Talk Show to listen to industry experts 
                </p>

                <a href="#" class="hero-button">
                    Join Waitlist Now
                    <img 
                        src="https://cdn.electricoctopus.agency/electric-octopus/right-arrow-line.png"
                        alt="arrow"
                        class="hero-button-icon"
                    >
                </a>

            </div>

            <!-- Partners Section -->
            <?php
                $partners = [
                    [
                        "logo" => "meta-logo",
                        "name" => "Meta",
                        "label" => "BUSINESS PARTNER"
                    ],
                    [
                        "logo" => "google-logo",
                        "name" => "Google",
                        "label" => "GOOGLE PARTNER"
                    ],
                    [
                        "logo" => "tiktok-logo",
                        "name" => "TikTok",
                        "label" => "MARKETING PARTNER"
                    ],
                ];
            ?>

            <div class="hero-partners mt-24">
                <h3 class="partners-heading">OUR OFFICIAL PARTNERS</h3>

                <div class="partners-list">

                    <?php foreach ($partners as $partner): ?>
                        <div class="partner-item">
                            <div class="partner-logo">
                                <img 
                                    src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo $partner['logo']; ?>.png"
                                    alt="<?php echo $partner['name']; ?>"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <p class="partner-label"><?php echo $partner['label']; ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
</section>

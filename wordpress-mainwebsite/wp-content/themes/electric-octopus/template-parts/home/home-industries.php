<section id="industries">
    <div class="custom-maxW pt-110">
        <div class="common-wrapper">
            <div class="head-block">
                <div class="head-block-left">
                    <h2 class="top-heading mb-16">industries</h2>
                    <h3 class="top-sub-heading mb-16">Industries we cover </h3>
                </div>
                <a href="#" class="head-block-right">View All <img src="https://cdn.electricoctopus.agency/electric-octopus/industry-link.png" alt="industry" loading="lazy"></a>
            </div>
            <p class="common-para">We’re a results-focused B2B marketing system builder specializing in driving growth through sustainable sales funnels ,  paid Ads,  and engaging email campaigns. We build high-converting AI-powered B2B marketing engine and automate your multi channel outreach to generate revenue .</p>
        </div>
        <div class="industry-content">
            <?php
            $industrySliderData = [
                "https://cdn.electricoctopus.agency/electric-octopus/ind-6.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-1.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-2.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-7.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-5.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-12.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-4.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-8.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-9.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-11.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-10.webp",
                "https://cdn.electricoctopus.agency/electric-octopus/ind-3.webp",
            ];

            $industryCatData = [
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-1.png", "Telecom"],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-2.png", "Energy"],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-3.png", "Manufacturing"],
                ["https://cdn.electricoctopus.agency/electric-octopus/capital-industry.png", "Capital Markets "],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-5.png", "Logistics "],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-6.png", "High Tech "],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-7.png", "Healthcare"],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-8.png", "Agriculture"],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-9.png", "Construction"],
                ["https://cdn.electricoctopus.agency/electric-octopus/ind-cat-10.png", "Defense & Space"],
                ["https://cdn.electricoctopus.agency/electric-octopus/diagnosis.png", "Insurance "],
                ["https://cdn.electricoctopus.agency/electric-octopus/ambulance.png", "Automative"],
                ["https://cdn.electricoctopus.agency/electric-octopus/mining.png", "Mining"],
                ["https://cdn.electricoctopus.agency/electric-octopus/life-science.png", "Life Sciences"],
                ["https://cdn.electricoctopus.agency/electric-octopus/pharma.png", "Life Science & Pharma"],
                ["https://cdn.electricoctopus.agency/electric-octopus/local_gas_station.png", "Oil & Gas "],
            ];
            ?>

            <div class="industry-section">

                <!-- Title + description -->
                <div class="industry-header">
                    <div>
                        <h3 class="green-title">INDUSTRIES</h3>
                        <h2 class="industry-heading">Industries we cover</h2>
                        <p class="industry-desc">
                            We're a results-focused B2B marketing system builder specializing in driving growth through 
                            sustainable sales funnels, paid Ads, and email automation.
                        </p>
                    </div>

                    <a href="#" class="industry-viewall">View All →</a>
                </div>

                <!-- TOP SLIDER -->
                <div class="slider-for industry-top-slider">
                    <?php foreach ($industrySliderData as $slide): ?>
                        <div class="slide-item">
                            <img src="<?php echo esc_url($slide); ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- CATEGORY NAV SLIDER -->
                <div class="slider-nav industry-grid">
                    <?php foreach ($industryCatData as $cat): ?>
                        <div class="category-box">
                            <div class="icon-wrap">
                                <img src="<?php echo esc_url($cat[0]); ?>" alt="">
                            </div>
                            <p><?php echo esc_html($cat[1]); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>

        </div>
    </div>
</section>
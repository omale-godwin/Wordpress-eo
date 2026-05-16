<?php
$testimonials = [
    [
        "img" => "https://cdn.electricoctopus.agency/electric-octopus/testi_user1.png",
        "name" => "Lynda Gomes",
        "designation" => "Executive Director, NanoCircuits",
        "text" => "Electric Octopus product launch strategy for our new semiconductor line exceeded all expectations, generating 200% more pre-orders than projected."
    ],
    [
        "img" => "https://cdn.electricoctopus.agency/electric-octopus/testi_user5.png",
        "name" => "Rachel Lewis",
        "designation" => "Head of Customer Acquisition, LeapWallet",
        "text" => "Electric Octopus customer journey mapping and optimization for our new website increased our customer retention rate by 125% and boosted staking by 60% & swap 100+ tokens on 50+ chains."
    ],
    [
        "img" => "https://cdn.electricoctopus.agency/electric-octopus/testi_user4.png",
        "name" => "Richard Chen",
        "designation" => "Marketing Ops Manager, Uptime",
        "text" => "The marketing automation workflows implemented by Electric Octopus team have saved countless hours and improved our lead nurturing process, resulting in a 35% increase in qualified opportunities."
    ],
    [
        "img" => "https://cdn.electricoctopus.agency/electric-octopus/testi_user3.png",
        "name" => "Alex Nolan",
        "designation" => "IR Director, Zira",
        "text" => "The email nurturing & outbound automation campaigns Electric Octopus executed improved our investor relations, leading to a 40% increase in capital commitments."
    ],
    [
        "img" => "https://cdn.electricoctopus.agency/electric-octopus/testi_user2.png",
        "name" => "Olivia Green",
        "designation" => "General Manager, Kenetic Capital",
        "text" => "Electric Octopus supported our paid Ads campaign, optimized UX/UI of our sales funnels, reduced churn by 20%, increased high-net-worth investors by 170%, and completed our funding in 3 months."
    ],
];
?>
<section id="testimonial">
    <div class="testimonial-section custom-maxW pt-110">

        <div class="testimonial-wrapper">
            <h2 class="top-heading text-center mb-24">Testimonial</h2>
            <h3 class="top-sub-heading text-center">Clients Testimonial</h3>
            <p class="common-para text-center mt-16">
                Discover how I have transformed businesses across industries with data-driven marketing strategies that deliver real results. Read my clients' success stories and see how partnering with me can elevate your business to new heights!
            </p>
        </div>

        <div class="testimonial-box testomonial-slick-slider mt-48">
            <?php foreach ($testimonials as $item): ?>
                <div class="testimonial-inner">
                    <div class="testimonial-content">

                        <img src="<?php echo esc_url($item['img']); ?>" class="testimonial-user-img" alt="client">

                        <div class="testimonial-stars mb-16">
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/rate_full.png" alt="star">
                        </div>

                        <h3 class="testimonial-name"><?php echo esc_html($item['name']); ?></h3>

                        <p class="testimonial-designation"><?php echo esc_html($item['designation']); ?></p>

                        <p class="testimonial-text">
                            "<?php echo esc_html($item['text']); ?>"
                        </p>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

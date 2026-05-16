<?php 
$techData = [
    "https://cdn.electricoctopus.agency/electric-octopus/t-1.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-2.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-3.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-4.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-5.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-6.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-7.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-8.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-9.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-10.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-11.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-12.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-13.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-14.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-15.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-16.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-17.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-18.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-19.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-20.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-21.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-22.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-23.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-24.png",
    "https://cdn.electricoctopus.agency/electric-octopus/t-25.png",
];
?>
<section id="section-2">
    <div class="tech-section">
        <div class="tech-title-wrapper">
            <h2 class="top-heading text-center mb-24">Tech</h2>
            <h3 class="top-sub-heading text-center">Tech Stack We Work With</h3>
        </div>

        <div class="tech-slider tech-slick-slider">
            <?php foreach ($techData as $logo): ?>
                <div>
                    <img src="<?php echo esc_url($logo); ?>" alt="tech-logo">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

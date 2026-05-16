<section id="section-4">
    <div class="custom-maxW pt-110">
        
        <!-- Heading -->
        <div class="common-wrapper text-center">
            <h2 class="top-heading mb-16">Data Sources</h2>
            <h3 class="top-sub-heading mb-16">Easily Connect and Integrate Data in a Single Report</h3>
            <p class="common-para">Create your first audit report today in less than 10 minutes</p>
        </div>

        <?php 
            // Array of all image filenames
            $data_sources = [
                "resource_slide1",
                "resource_slide2",
                "resource_slide3",
                "resource_slide4",
                "resource_slide5",
                "resource_slide6",
                "resource_slide7",
                "resource_slide8",
                "resource_slide9",
                "resource_slide10",

                // Old file name included
                "logo-white11",

                "resource_slide12",
                "resource_slide13",
                "resource_slide14",
                "resource_slide15"
            ];
        ?>

        <!-- Slider -->
        <div class="tech-slider tech-logo-slider mt-48">
            
            <?php foreach ($data_sources as $item): ?>
                <div>
                    <img 
                        src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo $item; ?>.png" 
                        alt="Data Source Logo"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>

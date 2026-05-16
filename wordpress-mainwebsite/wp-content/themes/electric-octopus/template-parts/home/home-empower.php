<section id="section-8" class="empower-section mt-110">
    
    <div class="empower-container custom-maxW">

        <div class="empower-top">

            <div class="empower-heading">
                Since our founding in 2012, Electric Octopus has helped 770+ clients achieve:
            </div>

            <?php 
                // Empower top stats (icon, number, text)
                $empower_stats = [
                    [
                        "icon" => "money-dollar-circle-fill",
                        "number" => "$1.35 BILLION",
                        "text" => "Generated in Revenue",
                    ],
                    [
                        "icon" => "movie-2-ai-line",
                        "number" => "3X",
                        "text" => "PURCHASE VOLUME",
                    ],
                    [
                        "icon" => "trending_down",
                        "number" => "26%",
                        "text" => "Decreased CPA & CAC",
                    ],
                ];
            ?>

            <div class="empower-stats">

                <?php foreach ($empower_stats as $item): ?>
                    <div class="empower-item">
                        <div class="empower-icon-box">
                            <img 
                                src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo $item['icon']; ?>.png" 
                                alt=""
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <div>
                            <h3 class="empower-number"><?php echo $item['number']; ?></h3>
                            <p class="empower-text"><?php echo $item['text']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <?php 
        // Bottom logos array (em-1 to em-13)
        $empower_logos = [];
        for ($i = 1; $i <= 13; $i++) {
            $empower_logos[] = "em-" . $i;
        }
    ?>

    <div class="empower-bottom">

        <?php foreach ($empower_logos as $logo): ?>
            <div class="empower-logo">
                <img 
                    src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo $logo; ?>.png" 
                    alt="Logo"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        <?php endforeach; ?>

    </div>

</section>

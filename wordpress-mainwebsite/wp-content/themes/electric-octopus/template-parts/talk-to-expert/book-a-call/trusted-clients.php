<section id="clients" class="client-wrapper">
    <div class="custom-maxW">

        <!-- Heading Section -->
        <div class="trusted-heading text-center">
            <h2 class="top-heading mb-16">Trusted by growth-obsessed brands</h2>
            <h3 class="top-sub-heading">Trusted by enterprises for mission-critical growth since 2012</h3>

        </div>

        <?php
        $clients = [
            "t-company1","t-company2","t-company3","t-company4","t-company5",
            "t-company16","t-company7","t-company8","t-company9","t-company10",
            "t-company11","t-company12","t-company13","t-company14","t-company1","t-company16",
            "t-company17","t-company18","t-company19","t-company20","t-company21","t-company22","t-company23",
        ];

        // Define row structure
        $rows = [
            array_slice($clients, 0, 5),   // Row 1 → 5 items
            array_slice($clients, 5, 6),   // Row 2 → 6 items
            array_slice($clients, 11, 6),  // Row 3 → 6 items
            array_slice($clients, 17, 6),  // Row 4 → 6 items
        ];
        ?>
        <div class="trusted-logos-block">
            <?php foreach ($rows as $index => $row): ?>
                <div class="trusted-logos trusted-client-row-<?php echo $index + 1; ?> <?php echo $index > 0 ? 'mt-32' : ''; ?>">
                    
                    <?php foreach ($row as $client): ?>
                        <div class="client-img-block">
                            <div class="client-logo-block">
                                <img 
                                    src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo esc_attr($client); ?>.png" 
                                    class="client-logo" 
                                    alt="Client Logo"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <span>Food & Beverage</span>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

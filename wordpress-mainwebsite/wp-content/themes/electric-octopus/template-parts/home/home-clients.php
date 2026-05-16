<section id="clients" class="client-wrapper">
    <div class="custom-maxW">

        <!-- Heading Section -->
        <div class="client-heading text-center">
            <h2 class="top-heading mb-16">Clients</h2>
            <h3 class="top-sub-heading mb-24">Awesome Clients</h3>
            <p class="common-para">
                See why top companies trust us to deliver transformative marketing results. Explore the logos of our satisfied clients and read above their success stories to discover the impact of my proven strategies!
            </p>
        </div>

        <?php 
            // Single array of client logo names (1 to 15)
            $clients = [
                "c-3","c-2","c-1","c-4","c-5",
                "c-6","c-7","c-8","c-9","c-10",
                "c-11","c-12","c-13","c-14","c-15"
            ];

            // Break into rows of 5 automatically
            $client_rows = array_chunk($clients, 5);
        ?>

        <?php foreach ($client_rows as $index => $row): ?>
            <div class="client-row-<?php echo $index + 1; ?> <?php echo $index > 0 ? 'mt-32' : ''; ?>">
                
                <?php foreach ($row as $client): ?>
                    <div class="client-img-block">
                        <div class="client-logo-block">
                            <img 
                                src="https://cdn.electricoctopus.agency/electric-octopus/<?php echo $client; ?>.png" 
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

        <!-- Button -->
        <div class="client-button">
            <a href="#" class="purple-button">SEE OUR WORK</a>
        </div>

    </div>
</section>

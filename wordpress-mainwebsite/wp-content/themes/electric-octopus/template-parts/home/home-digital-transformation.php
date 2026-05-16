<section id="digital-transformation" class="mt-110">
    <?php
$companyData = [
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-1.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-2.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-3.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-4.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-5.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-6.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-7.png" ],
    [ "industryImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-8.png" ],
];

$UserData = [
    [ "userImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-u-1.png" ],
    [ "userImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-u-2.png" ],
    [ "userImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-u-3.png" ],
    [ "userImg" => "https://cdn.electricoctopus.agency/electric-octopus/digi-u-4.png" ],
];
?>

    <div class="digital-wrapper">
    <div class="custom-maxW pt-110 pb-110">
        <div class="digital-flex">

            <!-- Left Section -->
            <div class="digital-left">

                <h2 class="heading-1">Digital transformation</h2>
                <h3 class="heading-2">How we help with digital transformation ?</h3>

                <p class="desc">
                    Take the first step today—schedule a call with one of our transformation experts.
                </p>

                <div class="btn-box">
                    <a class="purple-button" href="https://electricoctopus.agency/talk-to-expert/">Talk To Expert</a>
                </div>

                <div class="industry-logos">
                    <?php foreach ($companyData as $item): ?>
                        <img src="<?php echo esc_url($item['industryImg']); ?>" alt="industry">
                    <?php endforeach; ?>
                </div>

                <div class="user-wrapper">
                    <ul class="user-list">
                        <?php foreach ($UserData as $u): ?>
                        <li>
                            <img src="<?php echo esc_url($u['userImg']); ?>" alt="user">
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <span>Join 770 + Happy Clients</span>
                </div>

            </div>

            <!-- Right Section -->
            <div class="digital-right">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/digi-banner-4.webp" 
                     alt="digital" class="digital-image">
            </div>

        </div>
    </div>
</div>

</section>
<div class="side-banner-section">
    <div class="side-banner-wrapper">
        <div class="side-banner-top">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/tag-bg-1.png" alt="bg" loading="lazy">
            <div class="sidebar-cat-tag">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/tech-ico.png" alt="map" loading="lazy">
                <span><?php echo $term_name; ?></span>
            </div>
        </div>
        <div class="side-banner-body">
            <div class="body-content-place" style="background-image: url('<?php echo esc_url($background_image); ?>');">
                <h2><?php echo esc_html($title); ?></h2>
                <h3><?php echo esc_html($subtitle); ?></h3>
                <p><?php echo esc_html($description); ?></p>
                <div><a href="<?php echo esc_url($button_link); ?>" class="custom-button"><?php echo esc_html($button_text); ?></a></div>
                <div class="buyers-block">
                    <ul>
                        <?php //foreach ($buyer_images as $buyer_image) : ?>
                            <?php //if (!empty(trim($buyer_image))) : ?>
                                <!-- <li><img src="<?php //echo esc_url(trim($buyer_image)); ?>" alt="buyer"/></li> -->
                            <?php //endif; ?>
                        <?php //endforeach; ?>
                        <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer1.png" alt="buyer"/></li>
                                <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer2.png" alt="buyer2" loading="lazy"></li>
                                <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer3.png" alt="buyer3" loading="lazy"></li>
                                <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer4.png" alt="buyer4" loading="lazy"></li>
                                <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer5.png" alt="buyer5" loading="lazy"></li>
                                <li><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/buyer6.png" alt="buyer6" loading="lazy"></li>
                    </ul>
                    <span>500+ satisfied buyer</span>
                </div>
            </div>
        </div>
    </div>
</div>

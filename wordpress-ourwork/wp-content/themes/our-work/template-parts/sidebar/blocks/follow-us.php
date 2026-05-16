<!-- follow us -->
<div class="followus-block mt-24">
    <h3>Follow us on</h3>
    <div class="foo-social-links mt-24">
        <?php
        $icons = ['media_ico11.png', 'media_ico22.png', 'media_ico33.png', 'media_ico44.png', 'media_ico55.png', 'media_ico66.png', 'media_ico77.png'];
        foreach ($icons as $icon) {
            echo '<a href="#"><img src="https://cdn.electricoctopus.agency/electric-octopus/' . esc_attr($icon) . '" alt="icon" width="24" height="24" loading="lazy"></a>';
        }
        ?>
    </div>
</div>

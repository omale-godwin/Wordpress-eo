<?php
/**
 * Template part for displaying Body banner3
 */

// Fetch the entire cloned group
$banner3_fields = get_query_var('banner_3_fields');

if (!$banner3_fields) {
    $banner3_fields = get_field('banner_3_fields');
}
$bg_color    = $banner3_fields['background_color'] ?? 'linear-gradient(100.11deg, #5B02FE 26.39%, #6F2EE7 116.96%)';
$headline    = $banner3_fields['headline_text'] ?? '770+ Businesses successfully served !!';
$button_text = $banner3_fields['button_text'] ?? 'Talk to EXPERT';
$button_link = $banner3_fields['button_link'] ?? '#';

// Client logos (hardcoded)
$client_images = [
    'u-img1.png', 'u-img2.png', 'u-img3.png', 'u-img4.png', 'u-img5.png',
];
?>

<div class="mt-24 body-tmp-01" style="background: <?php echo esc_attr($bg_color); ?>;">
    <div class="flex gap-16 mt-16 align-center">
        <ul>
            <?php foreach ($client_images as $image_name): ?>
                <li>
                    <img 
                        src="https://cdn.electricoctopus.agency/electric-octopus/blog/<?php echo esc_attr($image_name); ?>" 
                        alt="client logo" 
                        loading="lazy"
                        width="48" 
                        height="48"
                    >
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <h3 class="mt-16"><?php echo esc_html($headline); ?></h3>

    <?php if (!empty($banner3_fields['business_values'])): ?>
        <div class="business-val">
            <?php foreach ($banner3_fields['business_values'] as $row): ?>
                <div class="val-inner">
                    <h3><?php echo esc_html($row['value'] ?? ''); ?></h3>
                    <p class="mt-0"><?php echo esc_html($row['text_line'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-16">
        <a 
            href="<?php echo esc_url($button_link); ?>" 
            class="msg-button" 
            target="_blank" 
            rel="noopener noreferrer"
        >
            <?php echo esc_html($button_text); ?>
        </a>
    </div>
</div>

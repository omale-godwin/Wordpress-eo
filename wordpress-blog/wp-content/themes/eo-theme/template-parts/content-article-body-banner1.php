<?php
/**
 * Template part for displaying Body Banner 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package OC-theme
 */

// First, try to fetch from new grouped field
$banner1_fields = get_query_var('banner_1_fields');

if (!$banner1_fields) {
    $banner1_fields = get_field('banner_1_fields');
}


if ($banner1_fields) {
    // New Grouped Fields
    $bg_color       = $banner1_fields['background_color'] ?? 'linear-gradient(100.11deg, #5B02FE 26.39%, #6F2EE7 116.96%)';
    $headline       = $banner1_fields['headline_text'] ?? 'Ready for consistent $100K+ Months?';
    $sub_text       = $banner1_fields['sub_text'] ?? 'We Will Install A Custom, Done-For-You Marketing System In 25 Days or Less';
    $button_text    = $banner1_fields['button_text'] ?? 'Talk to EXPERT';
    $button_link    = $banner1_fields['button_link'] ?? '#';
    $business_count = $banner1_fields['business_count'] ?? '770+ Businesses Successfully Served';
} else {
    // Fallback: Old individual fields
    $bg_color       = get_field('background_color') ?: 'linear-gradient(100.11deg, #5B02FE 26.39%, #6F2EE7 116.96%)';
    $headline       = get_field('headline_text') ?: 'Ready for consistent $100K+ Months?';
    $sub_text       = get_field('sub_text') ?: 'We Will Install A Custom, Done-For-You Marketing System In 25 Days or Less';
    $button_text    = get_field('button_text') ?: 'Talk to EXPERT';
    $button_link    = get_field('button_link') ?: '#';
    $business_count = get_field('business_count') ?: '770+ Businesses Successfully Served';
}

// Static client images
$client_images = [
    'u-img1.png',
    'u-img2.png',
    'u-img3.png',
    'u-img4.png',
    'u-img5.png'
];
?>

<div class="mt-24 body-tmp-01" style="background: <?php echo esc_attr($bg_color); ?>;">
    <h3><?php echo esc_html($headline); ?></h3>
    <p><?php echo esc_html($sub_text); ?></p>

    <div class="mt-16">
        <a href="<?php echo esc_url($button_link); ?>" class="xpert-button" target="_blank" rel="noopener noreferrer">
            <?php echo esc_html($button_text); ?>
        </a>
    </div>

    <div class="flex gap-16 mt-16 align-center">
        <ul class="client-logos">
            <?php foreach ($client_images as $image): ?>
                <li>
                    <img 
                        src="https://cdn.electricoctopus.agency/electric-octopus/blog/<?php echo esc_attr($image); ?>" 
                        alt="Client logo" 
                        width="48" 
                        height="48" 
                        loading="lazy"
                    >
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="business-c"><?php echo esc_html($business_count); ?></p>
    </div>
</div>
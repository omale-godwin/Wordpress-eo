<?php
$banner_group = get_field('case_study_banner_library');

// 1. CTA Banner
if (!empty($banner_group['cta_banner']['enable'])) {
    get_template_part('template-parts/body-banners/cta/cta-banner');
}

// 2. Quote Banner
if (!empty($banner_group['quote_banner']['enable'])) {
    get_template_part('template-parts/body-banners/quote/quotes-banner');
}

// 3. Podcast Banner
if (!empty($banner_group['podcast_banner']['enable'])) {
    get_template_part('template-parts/body-banners/podcast/podcast-banner');
}

// 4. Image Placeholder
if (!empty($banner_group['image_placeholder']['enable'])) {
    get_template_part('template-parts/body-banners/image-placeholder/image-placeholder-banner');
}

// 5. Values Visual
if (!empty($banner_group['values_visual']['enable'])) {
    get_template_part('template-parts/body-banners/values-visual/values-banner');
}
?>

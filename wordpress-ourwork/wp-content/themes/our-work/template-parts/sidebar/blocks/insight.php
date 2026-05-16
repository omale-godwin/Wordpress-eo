<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group   = get_field("sidebar_{$variant}_group");

if (!$group) return;

$insight = $group['insights'] ?? [];

$heading     = $insight['insight_industry'] ?? '';
$image       = $insight['insight_image'] ?? '';
$title       = $insight['insight_title'] ?? '';
$description = $insight['insight_description'] ?? '';
$button_text = $insight['insight_button_text'] ?? '';
$button_url  = $insight['insight_button_url'] ?? '';

?>
<div class="insight-tech mt-24">
        <h2>Insights - <?php echo esc_html($heading); ?></h2>

        <?php if (!empty($image['url'])): ?>
            <div class="fav-img">
                <img src="<?php echo esc_url($image['url']); ?>"
                     alt="<?php echo esc_attr($image['alt'] ?? 'Insight'); ?>"
                     loading="lazy">
            </div>
        <?php endif; ?>

        <h3><?php echo esc_html($title); ?></h3>
        <p><?php echo esc_html($description); ?></p>

        <?php if ($button_text): ?>
            <div class="insight-learnMore">
                <a href="<?php echo esc_url($button_url); ?>" class="custom-button">
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

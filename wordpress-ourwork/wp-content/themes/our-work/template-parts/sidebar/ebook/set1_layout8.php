<?php
$heading       = $ebook['ebook_banner_heading'] ?? '';
$cta_text      = $ebook['ebook_banner_cta_text'] ?? '';
$cta_url       = $ebook['ebook_banner_cta_url'] ?? '';
$layout_class  = basename(__FILE__, '.php'); // e.g. set2_layout1
$image_url     = get_template_directory_uri() . '/assets/images/ebook/ebook-set1-img6.webp';
$list_items    = $ebook['ebook_list_items'] ?? []; // repeater inside clone
?>

<div class="ebook-banner <?php echo esc_attr($layout_class); ?> mt-24">
    <div class="content-wrapper">
        <div class="left-img">
            <img src="<?php echo esc_url($image_url); ?>" alt="ebook" loading="lazy">
        </div>

        <?php if (!empty($heading)): ?>
            <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if (!empty($list_items)): ?>
            <ul class="ebook-list">
                <?php foreach ($list_items as $item): ?>
                    <?php if (!empty($item['list_item_text'])): ?>
                        <li>✓ <?php echo esc_html($item['list_item_text']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($cta_text)): ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="sub-button">
                <?php echo esc_html($cta_text); ?>
            </a>
        <?php endif; ?>
    </div>
</div>

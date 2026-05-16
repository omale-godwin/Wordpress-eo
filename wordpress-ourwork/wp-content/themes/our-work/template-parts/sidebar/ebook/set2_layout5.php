<?php
$heading    = $ebook['ebook_banner_heading'] ?? '';
$desc       = $ebook['ebook_banner_desc'] ?? '';
$cta_text   = $ebook['ebook_banner_cta_text'] ?? '';
$layout_class  = basename(__FILE__, '.php'); // e.g. set2_layout1
$image_url = get_template_directory_uri() . '/assets/images/ebook/ebook-set1-img4.webp';
?>

<div class="ebook-banner <?php echo esc_attr($layout_class); ?> mt-24">
    <div class="content-wrapper">
        <div class="subscribe-img"><img src="<?php echo esc_url($image_url); ?>" alt="ebook"></div>
        <?php if ($heading): ?><h2><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($desc): ?><p><?php echo esc_html($desc); ?></p><?php endif; ?>
        <form class="subcsribe-form">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="work_email" placeholder="Work Email" required>
            <?php if ($cta_text): ?>
                <button type="submit" class="ebook-button"><?php echo esc_html($cta_text); ?></button>
            <?php endif; ?>
        </form>
    </div>
</div>

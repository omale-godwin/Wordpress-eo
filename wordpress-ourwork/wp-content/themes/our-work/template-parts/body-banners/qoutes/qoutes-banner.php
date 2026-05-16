<?php
$banner_group = get_field('case_study_banner_library'); // Top-level ACF Group

$quote_group = $banner_group['quote_banner_group'] ?? []; // ✅ Correct field key

if (!empty($quote_group['enable_quote_banner'])) {
    $quote = $quote_group['quote_banner_block'] ?? [];

    $template_variant     = $quote['select_quotes_template'] ?? '1';
    $quotes_text          = $quote['quotes_text'] ?? '';
    $writer_picture       = $quote['writer_picture'] ?? '';
    $writer_picture_alt   = $writer_picture['alt'] ?? 'Writer';
    $writer_name          = $quote['writer_name'] ?? '';
    $writer_description   = $quote['writer_description'] ?? '';
    ?>
    <div class="quotes-banner-template-<?php echo esc_attr($template_variant); ?> quotes-banner"
         style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/quotes-img/Quote-bg{$template_variant}.webp"); ?>'); background-repeat: no-repeat; background-size: cover;">
        
        <div class="quotes-des">
            <?php if ($quotes_text): ?>
                <p><?php echo esc_html($quotes_text); ?></p>
            <?php endif; ?>

            <div class="name-cls">
                <?php if (!empty($writer_picture)): ?>
                    <?php echo wp_get_attachment_image($writer_picture, 'medium', false, [
                        'loading' => 'lazy',
                        'class'   => 'author-img',
                        'alt'     => esc_attr($writer_picture_alt),
                    ]); ?>
                <?php endif; ?>

                <div>
                    <?php if ($writer_name): ?>
                        <p class="w-name"><?php echo esc_html($writer_name); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($writer_description): ?>
                        <p class="w-des"><?php echo esc_html($writer_description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

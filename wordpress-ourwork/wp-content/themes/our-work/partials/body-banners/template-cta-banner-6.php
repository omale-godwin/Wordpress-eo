<?php 
/* Template Name: cta-banner-6 */
/* Template Post Type: articles */
?>

<?php
$group = get_field('cta_banner_layout_2');
?>
<div class="banner-template-1 cta-bdy-cls" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/template-previews/cta-banner/cta-img6.webp')">
    <div class="cta-bnner-left">
        <h2><?php echo esc_html($group['banner_title']); ?></h2>
        <p><?php echo esc_html($group['banner_description']); ?></p>
        <a href="<?php echo esc_url($group['cta_link']); ?>" class="msg-button">
            <?php echo esc_html($group['cta_text']); ?>
        </a>
    </div>
</div>
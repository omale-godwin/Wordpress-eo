<?php 
/* Template Name: banner template 1 */
/* Template Post Type: case_studies */
?>
<?php
$library   = get_field('case_study_banner_library', get_the_ID()) ?? [];
$cta_group = $library['cta_banner_group'] ?? [];
$cta       = $cta_group['cta_banner_block'] ?? [];

// Enable check
$enabled   = !empty($cta_group['enable_cta_banner']) && $cta_group['enable_cta_banner'] == 1;

// Banner content
$heading   = $cta['cta_heading'] ?? '';
$desc      = $cta['cta_desc'] ?? '';
$image     = $cta['cta_image']['url'] ?? '';
$cta_url   = $cta['cta_button_url'] ?? '';
$cta_text  = $cta['cta_cta_text'] ?? '';

// Repeater for category 3
$repeater_items = $cta_group['list_item'] ?? [];
?>

<?php if ($enabled): ?>
<div class="banner-template-cat-4 cta-bdy-cls" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/cta-banner-cat4/cat4-banner-bg1.webp')">
    
    <!-- Left graphic -->
    <div>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cta-banner-cat4/cat4-img1.webp" alt="graph" loading="lazy">
    </div>
    
    <!-- Banner content -->
    <div class="cta-bnner-4-left">
        <?php if ($heading): ?>
            <h2 class="white-color"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($desc): ?>
            <p><?php echo esc_html($desc); ?></p>
        <?php endif; ?>

        <!-- Repeater Items -->
        <?php if (!empty($repeater_items)): ?>
            <ul class="cta-list">
                <?php foreach ($repeater_items as $item): ?>
                    <li> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/grn-tick.png" alt="tick" loading="lazy"><?php echo esc_html($item['item']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <!-- CTA Button -->
        <?php if ($cta_text): ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="preview-audit-button green-bg">
                <?php echo esc_html($cta_text); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

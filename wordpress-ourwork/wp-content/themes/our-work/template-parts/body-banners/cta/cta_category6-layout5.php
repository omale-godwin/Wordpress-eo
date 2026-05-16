
<?php 
/* Template Name: banner template 1 */
/* Template Post Type: case_studies */
?>
<?php
$library   = get_field('case_study_banner_library', get_the_ID()) ?? [];
$cta_group = $library['cta_banner_group'] ?? [];
$cta       = $cta_group['cta_banner_block'] ?? [];

// Fix for True/False field
$enabled   = !empty($cta_group['enable_cta_banner']) && $cta_group['enable_cta_banner'] == 1;

$heading   = $cta['cta_heading'] ?? '';
$desc      = $cta['cta_desc'] ?? '';
$image     = $cta['cta_image']['url'] ?? '';
$cta_url   = $cta['cta_button_url'] ?? '';
$cta_text  = $cta['cta_cta_text'] ?? '';
?>

<?php if ($enabled): ?>
<div class="banner-template-2 common-bdy-cls"
     style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/template-previews/temp-bg5.png')">
    
    <div class="bdy-bnner-left"></div>
    <div class="bdy-bnner-right">
        <?php if ($heading): ?>
            <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($desc): ?>
            <p><?php echo esc_html($desc); ?></p>
        <?php endif; ?>
        
        <?php if ($cta_text): ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="btn-download mt-24">
                <?php echo esc_html($cta_text); ?> <img src="https://ourwork.electricoctopus.agency/wp-content/themes/our-work/assets/images/btn-arw.png" alt="→" loading="lazy">
            </a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>


<?php 
$author_id = get_the_author_meta('ID');

// Check if "Show Author Widget" is enabled
$show_author_widget = get_field('show_author_widget', 'user_' . $author_id);

if ($show_author_widget): 
    // Pull ACF fields from user meta
    $author_image = get_field('author_image', 'user_' . $author_id);
    $author_name = get_field('author_name', 'user_' . $author_id);
    $author_description_1 = get_field('author_description_1', 'user_' . $author_id);
    $author_description_2 = get_field('author_description_2', 'user_' . $author_id);
    $social_links = get_field('social_links', 'user_' . $author_id);
    $selected_bg = get_field('select_author_background', 'user_' . $author_id);
    $author_type = get_field('author_type', 'user_' . $author_id) ?: 'Staff';

    // Background image sets
    $contributor_backgrounds = [
        'bg1' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg1.webp',
        'bg2' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg2.webp',
        'bg3' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg3.webp',
        'bg4' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg4.webp',
        'bg5' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg5.webp',
        'bg6' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/contributor-bg6.webp',
    ];

    $staff_backgrounds = [
        'bg1' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg1.png',
        'bg2' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg2.png',
        'bg3' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg3.png',
        'bg4' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg4.png',
        'bg5' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg5.png',
        'bg6' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/Staff-bg6.png',
    ];

    // Choose background based on author type
    if ($author_type === 'Staff') {
        $background_image = $staff_backgrounds[$selected_bg] ?? $staff_backgrounds['bg1'];
    } else {
        $background_image = $contributor_backgrounds[$selected_bg] ?? $contributor_backgrounds['bg1'];
    }

    // Assign background class
    $bg_class = 'bg-style-default';
    switch ($selected_bg) {
        case 'bg1': $bg_class = 'bg-style-1'; break;
        case 'bg2': $bg_class = 'bg-style-2'; break;
        case 'bg3': $bg_class = 'bg-style-3'; break;
        case 'bg4': $bg_class = 'bg-style-4'; break;
        case 'bg5': $bg_class = 'bg-style-5'; break;
        case 'bg6': $bg_class = 'bg-style-6'; break;
    }
?>

<div class="author-widget">
    <div class="side-first-block mt-24" style="
        background: url('<?php echo esc_url($background_image); ?>') no-repeat center center;
        background-size: cover;
        padding: 24px;
        border-radius: 8px;
    ">
        <div class="author-head-section">
            <h2 class="abt-author">ABOUT THE AUTHOR</h2>

            <div class="flex gap-8 author-social">
                <?php if (!empty($social_links['linkedin'])): ?>
                    <a href="<?php echo esc_url($social_links['linkedin']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/linkedin.png" alt="LinkedIn" loading="lazy">
                    </a>
                <?php endif; ?>
                <?php if (!empty($social_links['x'])): ?>
                    <a href="<?php echo esc_url($social_links['x']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/x.png" alt="X (Twitter)" loading="lazy">
                    </a>
                <?php endif; ?>
                <?php if (!empty($social_links['facebook'])): ?>
                    <a href="<?php echo esc_url($social_links['facebook']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/facebook.png" alt="Facebook" loading="lazy">
                    </a>
                <?php endif; ?>
                <?php if (!empty($social_links['instagram'])): ?>
                    <a href="<?php echo esc_url($social_links['instagram']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/instagram.png" alt="Instagram" loading="lazy">
                    </a>
                <?php endif; ?>
                <?php if (!empty($social_links['youtube'])): ?>
                    <a href="<?php echo esc_url($social_links['youtube']); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/youtube.png" alt="YouTube" loading="lazy">
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex gap-24 author-content-sect">
            <?php if ($author_image): ?>
                <div class="author-media-section <?php echo esc_attr($bg_class . ' ' . strtolower($author_type)); ?>">
                    <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" loading="lazy">
                    <span class="staff-contributor-tag"><?php echo esc_html($author_type); ?></span>
                </div>
            <?php endif; ?>

            <div class="author-section">
                <?php if ($author_name): ?>
                    <h3><?php echo esc_html($author_name); ?></h3>
                <?php endif; ?>
                <?php if ($author_description_1): ?>
                    <p class="p1"><?php echo esc_html($author_description_1); ?></p>
                <?php endif; ?>
                <?php if ($author_description_2): ?>
                    <p class="p2"><?php echo esc_html($author_description_2); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; // End if $show_author_widget 
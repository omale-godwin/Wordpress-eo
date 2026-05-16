<?php
$banner_group = get_field('case_study_banner_library'); // ✅ Top-level group

$podcast_group = $banner_group['podcast_banner_group'] ?? []; // ✅ Nested group

if (!empty($podcast_group['enable_podcast_banner'])) {
    $audio = $podcast_group['podcast_banner_block'] ?? [];

    $audio_image       = $audio['audio_image'] ?? '';
    $audio_heading     = $audio['audio_heading'] ?? '';
    $audio_file        = $audio['audio_file'] ?? '';
    $audio_category    = $audio['audio_category'] ?? '';
    ?>
    <div class="audio-player-sect">
        <?php if ($audio_image): ?>
            <div class="audio-image">
                <img src="<?php echo esc_url($audio_image); ?>" loading="lazy" alt="<?php echo esc_attr($audio_heading); ?> thumbnail">
            </div>
        <?php endif; ?>

        <div class="player-section">
            <?php if ($audio_heading): ?>
                <h3 class="audio-title"><?php echo esc_html($audio_heading); ?></h3>
            <?php endif; ?>

            <?php if ($audio_category): ?>
                <div class="audio-detail">
                    <span class="audio-date"><?php echo date_i18n('M j'); ?></span> · <span><?php echo esc_html($audio_category); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($audio_file): ?>
                <audio id="audio-player" preload="metadata" controls>
                    <source src="<?php echo esc_url($audio_file); ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            <?php endif; ?>

            <div class="audio-track">
                <span class="backward">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/audio/backward.png" alt="rewind" />15
                </span>
                <div class="track">
                    <input type="range" id="seek-bar" value="0" step="0.1">
                </div>
                <div class="play-track">
                    <span class="forward">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/audio/forward.png" alt="fast-forward" />15
                    </span>
                    <span class="duration">00:00</span>
                    <span class="play-btn">
                        <img
                            id="custom-play-toggle"
                            src="<?php echo get_template_directory_uri(); ?>/assets/audio/play-btn.png"
                            data-play="<?php echo get_template_directory_uri(); ?>/assets/audio/play-btn.png"
                            data-pause="<?php echo get_template_directory_uri(); ?>/assets/audio/play-btn.png"
                            alt="play"
                        >
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

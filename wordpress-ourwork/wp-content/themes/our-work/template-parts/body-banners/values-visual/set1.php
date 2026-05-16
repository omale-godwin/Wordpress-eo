<?php
$vv = get_query_var('value_banner_data', []);
$set = $vv['set'] ?? 'set1';
$layout_class = $vv['layout'] ?? 'layout1';

// Use actual data key (no prefix needed here)
$value_items = $vv['values_data']['value_content'] ?? [];
?>

<div class="value-banner <?php echo esc_attr("value-banner-template-{$layout_class}"); ?>">
    <?php if (!empty($value_items) && is_array($value_items)) : ?>
        <?php foreach ($value_items as $item) :
            $value       = $item['value'] ?? '';
            $context     = $item['context'] ?? '';
            $value_color = $item['value_color'] ?? '#000';
        ?>
            <div class="val-inner">
                <h3 style="color: <?php echo esc_attr($value_color); ?>;"><?php echo esc_html($value); ?></h3>
                <p><?php echo esc_html($context); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No value banner data found for <?php echo esc_html($set); ?>.</p>
    <?php endif; ?>
</div>

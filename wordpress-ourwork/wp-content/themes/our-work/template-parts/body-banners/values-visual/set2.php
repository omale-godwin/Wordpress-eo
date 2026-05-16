<?php
$vv = get_query_var('value_banner_data', []);
$set = $vv['set'] ?? 'set2';
$layout_class = $vv['layout'] ?? 'layout1';

// Try both keys, depending on your clone field settings
$value_items = $vv['values_data']['value_content_set2'] ?? $vv['values_data']['value_content'] ?? [];
?>

<div class="value-banner <?php echo esc_attr("set2-banner-template-{$layout_class}"); ?>">
    <?php if (!empty($value_items) && is_array($value_items)) : ?>
        <?php foreach ($value_items as $item) :
            $value       = $item['set2_value'] ?? '';
            $context     = $item['set2_context'] ?? '';
            $description = $item['set2_description'] ?? '';
            $value_color = $item['set2_value_color'] ?? '#000';
        ?>
            <div class="val-inner">
                <h3 style="color: <?php echo esc_attr($value_color); ?>;"><?php echo esc_html($value); ?></h3>
                <p><?php echo esc_html($context); ?></p>

                <?php if ($layout_class === 'layout1' && !empty($description)) : ?>
                    <p class="desc"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No value banner data found for <?php echo esc_html($set); ?>.</p>
    <?php endif; ?>
</div>

<pre>
<?php //print_r($vv); ?>
</pre>
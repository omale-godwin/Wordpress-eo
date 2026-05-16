<?php
$banner_group = get_field('case_study_banner_library');
$vv = $banner_group['values_visual'] ?? [];

if (!empty($vv['values_visual_enable'])) {
    $set    = $vv['set'] ?? 'set1';
    $layout = ($set === 'set1') ? $vv['layout_set1'] ?? 'layout1' : $vv['layout_set2'] ?? 'layout1';

    // Unified data key for template
    $values_data = [];

    if ($set === 'set1' && !empty($vv['values_data_set1']['value_content'])) {
        $values_data = [
            'value_content' => $vv['values_data_set1']['value_content']
        ];
    } elseif ($set === 'set2' && !empty($vv['values_data_set2']['value_content_set2'])) {
        $values_data = [
            'value_content' => $vv['values_data_set2']['value_content_set2']
        ];
    }

    // Pass data to shared template
    set_query_var('value_banner_data', [
        'set'         => $set,
        'layout'      => $layout,
        'values_data' => $values_data,
    ]);

    get_template_part("template-parts/body-banners/values-visual/{$set}");
}
?>

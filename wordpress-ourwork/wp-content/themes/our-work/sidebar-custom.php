<?php
$sidebar_variant = get_field('select_sidebar_variant');
if (!in_array($sidebar_variant, ['default', 'variant1', 'variant2', 'variant3'])) {
    $sidebar_variant = 'default';
}
get_template_part('template-parts/sidebar/variants/sidebar', $sidebar_variant);

?>

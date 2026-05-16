<?php
$gartner = get_field('gartner_block');

if (!$gartner || !is_array($gartner)) return;

$heading     = $gartner['heading'] ?? '';
$description = $gartner['description'] ?? '';
?>

<?php if (!empty($heading)) : ?>
    <h2 class="detail-content-heading mt-24">
        <?php echo wp_kses_post($heading); ?>
    </h2>
<?php endif; ?>

<?php if (!empty($description)) : ?>
    <div class="detail-para mt-24">
        <?php echo wp_kses_post($description); ?>
</div>
<?php endif; ?>

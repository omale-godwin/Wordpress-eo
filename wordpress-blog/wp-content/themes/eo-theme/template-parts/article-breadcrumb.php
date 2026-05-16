<div class="breadcrumbs detail-cat-tag flex align-item-center gap-16">
        <a href="<?php echo home_url(); ?>">Blog</a> <span class="dot-seperate"></span>
        
        <?php
        $post_type = get_post_type_object(get_post_type());
        if ($post_type) {
            echo '<span class="post-type-label white">' . esc_html($post_type->labels->name) . '</span> <span class="dot-seperate"></span> ';
        }
        ?>
        
        <span class="post-title"><?php the_title(); ?></span>
    </div>
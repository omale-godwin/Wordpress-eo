<div class="author-widget">
    <div class="staff-authors">
        <h3>Staff</h3>
        <ul>
            <?php foreach ($staff_authors as $author): ?>
                <li class="staff"><?php echo esc_html($author->display_name); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="contributor-authors">
        <h3>Contributors</h3>
        <ul>
            <?php foreach ($contributor_authors as $author): ?>
                <li class="contributor"><?php echo esc_html($author->display_name); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
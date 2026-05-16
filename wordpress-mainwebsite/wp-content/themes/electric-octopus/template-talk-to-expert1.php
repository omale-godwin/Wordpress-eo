
<?php
/* 
Template Name: Talk To Expert 1
*/

get_header(); 
?>

<div class="main-body-container">
    <h1 class="visually-hidden">Welcome to Electric Octopus — Discover how to thrive online with creative excellence and smart strategy</h1>
   

    <!-- hero Section -->
    <?php //get_template_part('template-parts/talk-to-expert/talk-to-expert-form'); ?>
    
   <div class="talk-expert-page">
        <?php get_template_part('template-parts/talk-to-expert/sidebar'); ?>
        <?php get_template_part('template-parts/talk-to-expert/part1-layout'); ?>
    </div>
    
    <?php get_template_part('template-parts/talk-to-expert/form/results'); ?>
</div>
<?php get_footer(); ?>

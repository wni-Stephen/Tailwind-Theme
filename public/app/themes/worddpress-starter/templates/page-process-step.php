<?php
/* Template Name: Process Step Template */
get_header();

// TODO : Use these values below across blocks to control colour etc 
$parent_id = wp_get_post_parent_id(get_the_ID());
$colour = get_field('colour', $parent_id);
$parent_colour = 'transform-' . $colour;
$icon = get_field('icon', $parent_id);
// echo '<p class="text-deepgreen text-3xl">' . $parent_id . '</p>';
// echo '<p class="text-deepgreen text-3xl">' . $colour . '</p>';
// echo '<p class="text-deepgreen text-3xl">' . $parent_colour . '</p>';
// echo '<p class="text-deepgreen text-3xl">' . $icon . '</p>';
?>
<?php $theme_colour = get_field('theme');?>
<div class="main-content process-child-template  <?php if($parent_colour) : echo $parent_colour; endif; ?> <?php if($theme_colour) : echo $theme_colour; endif; ?>">
    <?php get_template_part('templates/dev/block-render'); ?>
</div>
<?php get_footer(); ?>
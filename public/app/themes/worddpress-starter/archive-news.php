<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>
<?php get_template_part( 'templates/partials/header', 'news' ); ?>

<section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

    <?php
    $args = array(
      'type' => 'news',
      'taxonomy' => 'news',
      'orderby' => 'date',
      'order' => 'ASC'
    );

    $i = 0;
    $count = count($posts);
    if (have_posts()) : ?>

      <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
       <?php 
         while ( have_posts() ) : the_post();
         get_template_part( 'templates/partials/post-card-news');
         endwhile;
         ?>
      </div>
      <div class="mt-16">
        <?php numeric_pagination(); ?>
      </div>
    <?php else: ?>
      <p>No posts found. :(</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    
  </div>
  <!-- <?php get_template_part('templates/blocks/contact-form'); ?> -->
</section>
<?php
get_footer();
?>
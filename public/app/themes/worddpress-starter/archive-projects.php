<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>
<?php get_template_part( 'templates/partials/header', 'projects' ); ?>

<section class="py-4 md:pb-8 lg:pb-16 lg:pt-4 bg-white relative">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative">

    <?php
    if (have_posts()) : ?>

      <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-10">
       <?php 
         while ( have_posts() ) : the_post();
         get_template_part( 'templates/partials/post-card-project');
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
</section>
<?php
get_footer();
?>
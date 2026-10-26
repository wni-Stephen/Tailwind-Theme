<?php
get_header();
?>
<div class="main-content">
  <?php get_template_part('templates/dev/block-render'); ?>
  <section class="relative py-8 lg:py-12 text-block bg-transparent">
    <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
      <div id="cookie-list"></div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<?php get_template_part('templates/blocks/breadcrumbs'); ?>

<section class="relative text-block bg-transparent">
  <div class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto relative text-left">
    <h1 class="fluid-3xl font-sora font-medium mb-6 lg:max-w-[90%] block dark:text-white"><?php the_title(); ?></h1>
    <div class="flex flex-row items-center justify-start gap-1 mt-6 lg:mt-10">
      <?php $category = get_the_terms(get_the_ID(), 'resource_category'); ?>
      <?php if ($category) : ?>
        <?php $category_link = get_category_link($category[0]->term_id); ?>
        <a href="<?php echo esc_url($category_link) ?>"> <span class="text-deepgreen font-medium font-manrope block text-sm"><?php echo $category[0]->name; ?> </span></a>
        <?php if ($category[0]->name != "Case Study") : ?>
          <span>|</span>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($category[0]->name != "Case Study") : ?>
        <span class="text-deepgreen font-medium font-manrope block text-sm"><?php echo  get_the_date('F j, Y') ?></span>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php get_template_part('templates/dev/block-render'); ?>


<?php get_footer(); ?>